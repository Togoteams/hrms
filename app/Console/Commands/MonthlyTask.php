<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Traits\GolobalTraits;
class MonthlyTask extends Command
{
    use GolobalTraits;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute a task once per month';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Your logic to execute once per month
        // For example:
        // YourMethod::execute();
        $result = $this->updateCurrentLeaveOfEachEmployee();

        $this->info('Monthly task executed successfully.');
    }
}