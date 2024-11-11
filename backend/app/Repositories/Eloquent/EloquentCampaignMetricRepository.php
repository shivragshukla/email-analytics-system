<?php

namespace App\Repositories\Eloquent;

use App\Models\Campaign;
use App\Models\EmailStatus;
use App\Repositories\Interfaces\CampaignMetricRepositoryInterface;

class EloquentCampaignMetricRepository implements CampaignMetricRepositoryInterface
{
    // Get metrics for all campaigns
    public function getAllCampaignMetrics()
    {
        return Campaign::withCount([
            'emailStatuses as emails_sent' => function ($query) {
                $query->where('status', 'sent');
            },
            'emailStatuses as emails_delivered' => function ($query) {
                $query->where('status', 'delivered');
            },
            'emailStatuses as emails_opened' => function ($query) {
                $query->where('status', 'opened');
            }
        ])->where('user_id', auth()->user()->id)
        ->get();
    }

    // Get metrics for a specific campaign by ID
    public function getMetricsByCampaignId($campaignId)
    {
        return Campaign::where('id', $campaignId)
            ->withCount([
                'emailStatuses as emails_sent' => function ($query) {
                    $query->where('status', 'sent');
                },
                'emailStatuses as emails_delivered' => function ($query) {
                    $query->where('status', 'delivered');
                },
                'emailStatuses as emails_opened' => function ($query) {
                    $query->where('status', 'opened');
                }
            ])->where('user_id', auth()->user()->id)
            ->firstOrFail();
    }
}
