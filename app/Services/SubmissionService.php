<?php

namespace App\Services;

use App\Repositories\SubmissionRepository;
use App\DTOs\SubmissionData;
use \App\Events\SubmissionSaved;

class SubmissionService
{
    protected SubmissionRepository $submissionRepository;

    public function __construct(SubmissionRepository $submissionRepository)
    {
        $this->submissionRepository = $submissionRepository;
    }

    public function store(SubmissionData $data): void
    {
        $submission = $this->submissionRepository->create([
            'name' => $data->name,
            'email' => $data->email,
            'message' => $data->message,
        ]);

        event(new SubmissionSaved($submission));
    }
}
