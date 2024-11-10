<?php

namespace App\Repositories\Interfaces;

interface WebhookRepositoryInterface
{
    public function trackEmailStatus(array $data);
}
