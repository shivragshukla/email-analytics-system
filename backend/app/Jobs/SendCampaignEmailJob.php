<?php

namespace App\Jobs;

use App\Mail\CampaignMail;
use App\Models\EmailStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendCampaignEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $campaign;
    protected $recipientEmail;

    public function __construct($campaign, $recipientEmail)
    {
        $this->campaign = $campaign;
        $this->recipientEmail = $recipientEmail;
    }

    public function handle()
    {
        // Send the email
        Mail::to($this->recipientEmail)->send(new CampaignMail($this->campaign, $this->campaign->template));

        // Update email status to "delivered"
        EmailStatus::create([
            'campaign_id' => $this->campaign->id,
            'recipient_email' => $this->recipientEmail,
            'status' => 'delivered',
        ]);
    }
}
