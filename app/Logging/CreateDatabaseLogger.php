namespace App\Logging;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use Illuminate\Support\Facades\DB;

class CreateDatabaseLogger extends AbstractProcessingHandler
{
    protected function write(array $record): void
    {
        DB::table('logs')->insert([
            'level' => $record['level_name'],
            'message' => $record['message'],
            'context' => json_encode($record['context']),
            'created_at' => now(),
        ]);
    }
}
