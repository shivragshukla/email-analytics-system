<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\EmailStatusRepositoryInterface;
use App\Http\Requests\EmailStatusRequest;

class EmailStatusController extends Controller
{
    protected $emailStatusRepository;

    public function __construct(EmailStatusRepositoryInterface $emailStatusRepository)
    {
        $this->emailStatusRepository = $emailStatusRepository;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(EmailStatusRequest $request, $campaignId)
    {
        $this->emailStatusRepository->sendEmails($campaignId, $request->validated());
        return response()->json(['message' => 'Emails queued successfully']);
    }
}
