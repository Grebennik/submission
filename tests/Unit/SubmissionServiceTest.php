<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\SubmissionService;
use App\Repositories\SubmissionRepository;
use App\DTOs\SubmissionData;
use Mockery;

class SubmissionServiceTest extends TestCase
{
    public function testStore()
    {
        $submissionData = new SubmissionData(['name' => 'John Doe', 'email' => 'john.doe@example.com', 'message' => 'This is a test message.']);
        $submissionRepository = Mockery::mock(SubmissionRepository::class);
        $submissionRepository->shouldReceive('create')->once()->with([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.'
        ])->andReturn(new \App\Models\Submission());

        $submissionService = new SubmissionService($submissionRepository);
        $submissionService->store($submissionData);

        $this->assertTrue(true);
    }
}
