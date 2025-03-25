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
     * Les mappages de policies pour l'application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Liez ici vos modèles aux policies correspondantes.
        Profile::class => ProfilePolicy::class,
    ];

    /**
     * Enregistrez tous les services d’authentification/autorisation.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::policy(Comment::class, CommentPolicy::class);

    }
}
