<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;
use App\User;
use Carbon\Carbon;
use DB;

class LoginNotificationSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Notification:Login';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send login inactivity notifications';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userIdToExclude = 1011;

        // Highest threshold first so a user past 300 days is recorded once at the 10-month
        // level, not duplicated at 3-month and 6-month for the same inactivity period.
        $thresholds = [300, 180, 90];

        $users = User::whereNotNull('last_login')
            ->where('last_login', '<=', Carbon::now()->subDays(90))
            ->where('id', '!=', $userIdToExclude)
            ->get();

        foreach ($users as $u) {
            try {
                $totalDays = (int) Carbon::parse($u->last_login)->diffInDays(now());

                foreach ($thresholds as $days) {
                    if ($totalDays < $days) {
                        continue;
                    }

                    // Dedup within the current inactivity period only — if the user
                    // logs in again and goes inactive a second time, they will
                    // receive each threshold's notification again for the new period.
                    $alreadySent = DB::table('send_notification')
                        ->where('send_to', $u->id)
                        ->where('total_days', $days)
                        ->where('created_at', '>', $u->last_login)
                        ->exists();

                    if ($alreadySent) {
                        echo "Already sent {$days}-day notification for User ID: {$u->id}<br>";
                        break;
                    }

                    $randomInt = unpack('L', random_bytes(4))[1];

                    DB::table('send_notification')->insert([
                        'title'      => 'You haven`t signed in for the last ' . $totalDays . ' Days',
                        'send_by'    => 1011,
                        'send_to'    => $u->id,
                        'unique_id'  => intval(microtime(true) + $randomInt),
                        'total_days' => $days,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    echo "Notification Recorded for User ID: {$u->id} | Threshold: {$days} | Inactive: {$totalDays} days<br>";
                    break;
                }
            } catch (\Exception $e) {
                Log::error('Login Notification Error: ' . $e->getMessage());
                echo "Error for User ID: {$u->id} => {$e->getMessage()}<br>";
            }
        }

        return 0;
    }
}