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
        // Create a new instance of CampaignMail
        $mail = new CampaignMail($this->campaign, $this->campaign->template);

       // Store EmailStatus with message_id
        EmailStatus::create([
            'campaign_id' => $this->campaign->id,
            'recipient_email' => $this->recipientEmail,
            'message_id' => $mail->messageId,
            'user_id' => $this->campaign->user_id
        ]);

        // Send the email
        Mail::to($this->recipientEmail)->send($mail);
    }
}
