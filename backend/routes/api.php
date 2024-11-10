<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\{
    TemplateController,
    CampaignController,
    EmailStatusController,
    WebhookController,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::apiResource('templates', TemplateController::class);
    Route::apiResource('campaigns', CampaignController::class);
    Route::post('campaigns/{campaign}/send', EmailStatusController::class);
});

Route::post('/email/webhook', WebhookController::class);


