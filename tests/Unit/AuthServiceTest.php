<?php

namespace Tests\Unit;

use App\Repositories\Interfaces\AdminRepositoryInterface;
use Tests\TestCase;
use App\Services\AuthService;
use App\Models\Admin;
use Mockery;
use Illuminate\Support\Facades\Auth;

class AuthServiceTest extends TestCase
{
    protected AuthService $authService;
    protected AdminRepositoryInterface $adminRepoMock;

    public function test_register_creates_admin_and_returns_token()
    {
        // Données d'entrée pour l'enregistrement
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'password123'
        ];

        // Création du mock Admin
        $adminMock = Mockery::mock(Admin::class);
        $adminMock->shouldReceive('createToken')
            ->once()
            ->with('auth_token')
            ->andReturn((object)['plainTextToken' => 'test_token']);

        // Mock du repository pour créer l'admin
        $this->adminRepoMock->shouldReceive('createAdmin')
            ->once()
            ->with([
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'password' => 'password123'
            ])
            ->andReturn($adminMock);

        // Appel du service pour l'enregistrement
        $result = $this->authService->register($data);

        // Vérification que le token est correctement retourné
        $this->assertEquals('test_token', $result['token']);
        $this->assertEquals($adminMock, $result['admin']);
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Création du mock de AdminRepositoryInterface
        $this->adminRepoMock = Mockery::mock(AdminRepositoryInterface::class);
        $this->authService = new AuthService($this->adminRepoMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
