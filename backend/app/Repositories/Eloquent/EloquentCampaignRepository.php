<?php

namespace App\Repositories\Eloquent;

use App\Models\Campaign;
use App\Repositories\Interfaces\CampaignRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentCampaignRepository implements CampaignRepositoryInterface
{
    public function all()
    {
        return Campaign::with('template')->get();
    }

    public function findById($id)
    {
        return Campaign::with('template')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Campaign::create($data);
    }

    public function update($id, array $data)
    {
        $template = Campaign::findOrFail($id);
        $template->update($data);
        return $template;
    }

    public function delete($id)
    {
        Campaign::destroy($id);
    }
}
