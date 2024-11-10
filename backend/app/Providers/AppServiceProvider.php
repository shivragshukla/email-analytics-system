<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

use App\Repositories\Interfaces\{
    TemplateRepositoryInterface,
    CampaignRepositoryInterface,
    EmailStatusRepositoryInterface,
    WebhookRepositoryInterface
};
use App\Repositories\Eloquent\{
    EloquentTemplateRepository,
    EloquentCampaignRepository,
    EloquentEmailStatusRepository,
    EloquentWebhookRepository
};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TemplateRepositoryInterface::class, EloquentTemplateRepository::class);
        $this->app->bind(CampaignRepositoryInterface::class, EloquentCampaignRepository::class);
        $this->app->bind(EmailStatusRepositoryInterface::class, EloquentEmailStatusRepository::class);
        $this->app->bind(WebhookRepositoryInterface::class, EloquentWebhookRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
    }
}
