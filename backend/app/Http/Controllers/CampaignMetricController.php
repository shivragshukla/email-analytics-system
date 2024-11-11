<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\CampaignMetricRepositoryInterface;
use App\Http\Resources\CampaignMetricResource;
use Illuminate\Http\Request;

class CampaignMetricController extends Controller
{
    protected $metricRepository;

    public function __construct(CampaignMetricRepositoryInterface $metricRepository)
    {
        $this->metricRepository = $metricRepository;
    }

    // Display all campaign metrics
    public function index()
    {
        $metrics = $this->metricRepository->getAllCampaignMetrics();
        return CampaignMetricResource::collection($metrics);
    }

    // Display metrics for a specific campaign
    public function show($campaignId)
    {
        $metric = $this->metricRepository->getMetricsByCampaignId($campaignId);
        if (!$metric) {
            return response()->json(['message' => 'Campaign not found'], 404);
        }
        return new CampaignMetricResource($metric);
    }
}
