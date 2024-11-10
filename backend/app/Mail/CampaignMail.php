<?php

namespace App\Mail;

use App\Models\Campaign;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CampaignMail extends Mailable
{
    use Queueable, SerializesModels;

    public $campaign;
    public $template;
    public $messageId;

    public function __construct(Campaign $campaign, $template)
    {
        $this->campaign = $campaign;
        $this->template = $template;
        $this->messageId = uniqid('campaign_', true);
    }

    public function build()
    {
        return $this->view('emails.campaign')
            ->subject($this->campaign->subject)
            ->from($this->campaign->from_email, $this->campaign->from_name)
            ->with([
                'content' => $this->template->content,
                'emailStatusId' => $this->messageId,
            ])
            ->withSwiftMessage(function ($message) {
                $message->getHeaders()->addTextHeader('X-Message-ID', $this->messageId);
                $message->setId($this->messageId);
                return $message;
            });
    }
}
