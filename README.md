# Laravel API Demo

## Setup Instructions

### 1. Clone the Repository
```bash
git clone <repository-url>
cd laravel-api-demo
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Set Up Environment Variables
Copy `.env.example` to `.env` and update the database credentials.
```bash
cp .env.example .env
```
Update the `.env` file with your database credentials:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Run Migrations
```bash
php artisan migrate
```

### 5. Queue Setup
Ensure you have a queue driver set up (e.g., database, Redis). Update `.env` accordingly:
```
QUEUE_CONNECTION=database
```
Run the queue worker:
```bash
php artisan queue:work
```

## API Usage

### Endpoint: Submit a Submission

**URL:** `/api/submit`

**Method:** `POST`

**Request Payload:**
```json
{
    "name": "John Doe",
    "email": "john.doe@example.com",
    "message": "This is a test message."
}
```

**Response:**
```json
{
    "status": "success",
    "message": "Submission queued for processing",
    "data": []
}
```

### Testing the API

1. Start the server:
```bash
php artisan serve
```

2. Make a POST request to `/api/submit` with the following JSON payload:
```json
{
    "name": "John Doe",
    "email": "john.doe@example.com",
    "message": "This is a test message."
}
```

## Running Tests

### Unit Tests
To run unit tests:
```bash
php artisan test --testsuite=Unit
```

### Example Unit Test: `tests/Unit/SubmissionServiceTest.php`
```php
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
```

## Project Structure

```
laravel-api-demo
├── app
│   ├── DTOs
│   │   └── SubmissionData.php
│   ├── Events
│   │   └── SubmissionSaved.php
│   ├── Exceptions
│   │   └── Handler.php
│   ├── Http
│   │   ├── Controllers
│   │   │   └── SubmissionController.php
│   │   ├── Requests
│   │   │   └── SubmissionRequest.php
│   │   └── Responses
│   │       └── ApiResponse.php
│   ├── Jobs
│   │   └── ProcessSubmission.php
│   ├── Listeners
│   │   └── LogSubmissionSaved.php
│   ├── Models
│   │   └── Submission.php
│   ├── Providers
│   │   └── EventServiceProvider.php
│   ├── Repositories
│   │   └── SubmissionRepository.php
│   └── Services
│       └── SubmissionService.php
├── database
│   ├── migrations
│   │   └── xxxx_xx_xx_create_submissions_table.php
├── routes
│   └── api.php
└── tests
    └── Unit
        └── SubmissionServiceTest.php
```

## Additional Information

This project demonstrates a simple Laravel API using job queues, database operations, event handling, services, DTOs with Spatie DataTransferObject, and custom exception handling. The API allows for the submission of data, which is processed in the background using a job queue and events.

For any questions or further assistance, please contact the project maintainer.
