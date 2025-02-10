<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateApiRoutes extends Command
{
    // Define the command signature
    protected $signature = 'make:api-file';

    // Description of the command
    protected $description = 'Generate the routes/api.php file if missing';

    // The logic for handling the command execution
    public function handle()
    {
        $filePath = base_path('routes/api.php');

        if (File::exists($filePath)) {
            $this->info('The api.php file already exists.');
            return;
        }

        $defaultContent = "<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request \$request) {
    return \$request->user();
});

// Example API route
Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});
";

        File::put($filePath, $defaultContent);
        $this->info('The api.php file has been generated successfully!');
    }
}
