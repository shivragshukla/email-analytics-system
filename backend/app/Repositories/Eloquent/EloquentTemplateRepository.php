<?php

namespace App\Repositories\Eloquent;

use App\Models\Template;
use App\Repositories\Interfaces\TemplateRepositoryInterface;

class EloquentTemplateRepository implements TemplateRepositoryInterface
{
    public function all()
    {
        return Template::all();
    }

    public function findById($id)
    {
        return Template::findOrFail($id);
    }

    public function create(array $data)
    {
        return Template::create($data);
    }

    public function update($id, array $data)
    {
        $template = Template::findOrFail($id);
        $template->update($data);
        return $template;
    }

    public function delete($id)
    {
        Template::destroy($id);
    }
}
