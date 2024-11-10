<?php

namespace App\Repositories\Interfaces;

interface EmailStatusRepositoryInterface
{
    public function sendEmails($campaignId, array $data);
}
