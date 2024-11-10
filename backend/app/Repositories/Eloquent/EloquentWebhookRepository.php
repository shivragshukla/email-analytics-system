<?php

namespace App\Repositories\Eloquent;

use App\Models\EmailStatus;
use App\Repositories\Interfaces\WebhookRepositoryInterface;

class EloquentWebhookRepository implements WebhookRepositoryInterface
{
    public function trackEmailStatus(array $data)
    {
        $event = $data['event'];
        $messageId = $data['message_id'];

        $emailStatus = EmailStatus::where('message_id', $messageId)->firstOrFail();

        switch ($event) {
            case 'open':
                $emailStatus->status = 'opened';
                break;
            case 'delivery':
                $emailStatus->status = 'delivered';
                break;
        }
        $emailStatus->save();
    }
}
