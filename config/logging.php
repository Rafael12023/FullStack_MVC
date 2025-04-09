'database' => [
    'driver' => 'custom',
    'via' => App\Logging\CreateDatabaseLogger::class,
    'level' => env('LOG_LEVEL', 'debug'),
],
