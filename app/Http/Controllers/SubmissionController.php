<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmissionRequest;
use App\Jobs\ProcessSubmission;
use App\Http\Responses\ApiResponse;
use App\DTOs\SubmissionData;
use Illuminate\Http\JsonResponse;

class SubmissionController extends Controller
{
    public function submit(SubmissionRequest $request): JsonResponse
    {
        $data = new SubmissionData($request->validated());
        ProcessSubmission::dispatch($data->all());

        return ApiResponse::success(['message' => 'Submission queued for processing'], 202);
    }
}
