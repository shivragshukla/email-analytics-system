<?php

namespace App\Repositories\Interfaces;

interface CampaignMetricRepositoryInterface
{
    public function getAllCampaignMetrics();
    public function getMetricsByCampaignId($id);
}
