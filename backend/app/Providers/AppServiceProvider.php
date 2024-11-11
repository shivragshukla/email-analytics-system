<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

use App\Repositories\Interfaces\{
    TemplateRepositoryInterface,
    CampaignRepositoryInterface,
    EmailStatusRepositoryInterface,
    WebhookRepositoryInterface,
    CampaignMetricRepositoryInterface
};
use App\Repositories\Eloquent\{
    EloquentTemplateRepository,
    EloquentCampaignRepository,
    EloquentEmailStatusRepository,
    EloquentWebhookRepository,
    EloquentCampaignMetricRepository
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
        $this->app->bind(CampaignMetricRepositoryInterface::class, EloquentCampaignMetricRepository::class);

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
