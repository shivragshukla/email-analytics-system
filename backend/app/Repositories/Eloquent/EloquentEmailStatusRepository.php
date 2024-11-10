<?php

namespace App\Repositories\Eloquent;

use App\Models\Campaign;
use App\Jobs\SendCampaignEmailJob;
use App\Repositories\Interfaces\EmailStatusRepositoryInterface;

class EloquentEmailStatusRepository implements EmailStatusRepositoryInterface
{
    public function sendEmails($campaignId, array $data)
    {
        $recipients = explode(',', $data['recipients']) ?? [];
        $campaign = Campaign::with('template')->findOrFail($campaignId);

        foreach ($recipients as $email) {
            // Dispatch a job for each email recipient
            SendCampaignEmailJob::dispatch($campaign, $email);
        }
    }
}
