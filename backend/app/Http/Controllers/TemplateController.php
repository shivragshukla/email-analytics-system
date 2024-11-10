<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTemplateRequest;
use App\Http\Requests\UpdateTemplateRequest;
use App\Repositories\Interfaces\TemplateRepositoryInterface;
use App\Http\Resources\TemplateResource;

class TemplateController extends Controller
{
    protected $templateRepository;

    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->templateRepository = $templateRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TemplateResource::collection($this->templateRepository->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTemplateRequest $request)
    {
        $template = $this->templateRepository->create($request->validated());
        return new TemplateResource($template);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return new TemplateResource($this->templateRepository->findById($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTemplateRequest $request, int $id)
    {
        $template = $this->templateRepository->update($id, $request->validated());
        return new TemplateResource($template);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->templateRepository->delete($id);
        return response()->json(['message' => 'Template deleted successfully.']);
    }
}
