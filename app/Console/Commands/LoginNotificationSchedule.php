<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;
use App\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ThreeMonthNotification;
use App\Notifications\SixMonthNotification;
use App\Notifications\TenMonthNotification;
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
        $toEmailAddress  = "info@isoonline.com";

        // Highest threshold first so a user past 300 days gets the 10-month email,
        // not a duplicate 3-month one.
        $thresholds = [
            300 => TenMonthNotification::class,
            180 => SixMonthNotification::class,
            90  => ThreeMonthNotification::class,
        ];

        $users = User::whereNotNull('last_login')
            ->where('last_login', '<=', Carbon::now()->subDays(90))
            ->where('id', '!=', $userIdToExclude)
            ->get();

        foreach ($users as $u) {
            try {
                $totalDays = Carbon::parse($u->last_login)->diffInDays(now());

                foreach ($thresholds as $days => $notificationClass) {
                    if ($totalDays < $days) {
                        continue;
                    }

                    // Dedup within the current inactivity period only — if the user
                    // logs in again and goes inactive a second time, they will
                    // receive each threshold's email again for the new period.
                    $alreadySent = DB::table('send_notification')
                        ->where('send_to', $u->id)
                        ->where('total_days', $days)
                        ->where('created_at', '>', $u->last_login)
                        ->exists();

                    if ($alreadySent) {
                        echo "Already sent {$days}-day notification for User ID: {$u->id}<br>";
                        break;
                    }

                    Notification::route('mail', $toEmailAddress)
                        ->notify(new $notificationClass($u->name, $totalDays, $u->email));

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

                    echo "Email Sent for User ID: {$u->id} | Threshold: {$days} | Inactive: {$totalDays} days<br>";
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