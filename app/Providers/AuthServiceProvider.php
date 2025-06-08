<?php

namespace App\Providers;

use App\Models\Comment;
use App\Policies\CommentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Profile;
use App\Policies\ProfilePolicy;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * Os mapeamentos de policies da aplicação.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Vincule aqui seus modelos às policies correspondentes.
        Profile::class => ProfilePolicy::class,
    ];

    /**
     * Registre todos os serviços de autenticação/autorização.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::policy(Comment::class, CommentPolicy::class);

    }
}
