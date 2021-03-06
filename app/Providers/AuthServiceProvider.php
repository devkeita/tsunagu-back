<?php

namespace App\Providers;

use App\Group;
use App\Policies\GroupPolicy;
use App\Services\Auth\LiffVerificationService;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Group::class => GroupPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::viaRequest('liff', function (Request $request) {
            $verificationService = new LiffVerificationService();
            return $verificationService->verify($request->bearerToken());
        });
    }
}
