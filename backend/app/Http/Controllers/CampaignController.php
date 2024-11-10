<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\CampaignRepositoryInterface;
use App\Http\Requests\StoreCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Http\Resources\CampaignResource;

class CampaignController extends Controller
{

    protected $campaignRepository;

    public function __construct(CampaignRepositoryInterface $campaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CampaignResource::collection($this->campaignRepository->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCampaignRequest $request)
    {
        $campaign = $this->campaignRepository->create($request->validated());
        return new CampaignResource($campaign);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return new CampaignResource($this->campaignRepository->findById($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCampaignRequest $request, int $id)
    {
        $campaign = $this->campaignRepository->update($id, $request->validated());
        return new CampaignResource($campaign);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->campaignRepository->delete($id);
        return response()->json(['message' => 'Campaign deleted successfully.']);
    }
}
