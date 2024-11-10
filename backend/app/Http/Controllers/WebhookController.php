<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\WebhookRepositoryInterface;
use App\Http\Requests\WebhookRequest;

class WebhookController extends Controller
{

    protected $webookRepository;

    public function __construct(WebhookRepositoryInterface $webookRepository)
    {
        $this->webookRepository = $webookRepository;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(WebhookRequest $request)
    {
         // Mailtrap webhook payload example:
        // {
        //   "event": "open",
        //   "message_id": "12345",
        //   "email": "user@example.com",
        //   "user_variables": {
        //     "campaign_id": "1"
        //   },
        //   "timestamp": 1672639453
        // }

        $this->webookRepository->trackEmailStatus($request->validated());
        return response()->json(['message' => 'Email status updated successfully']);
    }
}
