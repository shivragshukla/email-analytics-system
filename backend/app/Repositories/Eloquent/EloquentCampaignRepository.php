<?php

namespace App\Repositories\Eloquent;

use App\Models\Campaign;
use App\Repositories\Interfaces\CampaignRepositoryInterface;

class EloquentCampaignRepository implements CampaignRepositoryInterface
{
    public function all()
    {
        return Campaign::with('template')->where('user_id', auth()->user()->id)->get();
    }

    public function findById($id)
    {
        return Campaign::with('template')->findOrFail($id);
    }

    public function create(array $data)
    {
        $data['user_id'] = auth()->user()->id;
        $campaign = Campaign::create($data);
        return Campaign::with('template')->findOrFail($campaign->id);
    }

    public function update($id, array $data)
    {
        $campaign = Campaign::with('template')->findOrFail($id);
        $campaign->update($data);
        return $campaign;
    }

    public function delete($id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->delete($id);
    }
}
