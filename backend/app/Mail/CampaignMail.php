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

    public function __construct(Campaign $campaign, $template)
    {
        $this->campaign = $campaign;
        $this->template = $template;
    }

    public function build()
    {
        return $this->view('emails.campaign')
            ->subject($this->campaign->subject)
            ->from($this->campaign->from_email, $this->campaign->from_name)
            ->with([
                'content' => $this->template->content,
        ]);
    }
}
