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

        // Get users inactive for at least 90 days
        $users = User::whereNotNull('last_login')
            ->where('last_login', '<=', Carbon::now()->subDays(90))
            ->where('id', '!=', $userIdToExclude)
            ->get();

        foreach ($users as $u) {

            try {

                $lastLogin = Carbon::parse($u->last_login);

                // Calculate total inactive days
                $totalDays = $lastLogin->diffInDays(now());

                $toEmailAddress = "info@isoonline.com";

                $clientName = $u->name;
                $clientEmail = $u->email;

                $notificationSent = false;

                /*
                |--------------------------------------------------------------------------
                | Send Notifications
                |--------------------------------------------------------------------------
                | Using ranges instead of exact equality avoids timezone/cron issues.
                */

                // 90 Days Notification
                if ($totalDays >= 90 && $totalDays < 91) {

                    Notification::route('mail', $toEmailAddress)
                        ->notify(new ThreeMonthNotification(
                            $clientName,
                            $totalDays,
                            $clientEmail
                        ));

                    $notificationSent = true;

                }

                // 180 Days Notification
                elseif ($totalDays >= 180 && $totalDays < 181) {

                    Notification::route('mail', $toEmailAddress)
                        ->notify(new SixMonthNotification(
                            $clientName,
                            $totalDays,
                            $clientEmail
                        ));

                    $notificationSent = true;

                }

                // 300 Days Notification
                elseif ($totalDays >= 300 && $totalDays < 301) {

                    Notification::route('mail', $toEmailAddress)
                        ->notify(new TenMonthNotification(
                            $clientName,
                            $totalDays,
                            $clientEmail
                        ));

                    $notificationSent = true;

                }

                /*
                |--------------------------------------------------------------------------
                | Save Notification Record
                |--------------------------------------------------------------------------
                */

                if ($notificationSent) {

                    $randomBytes = random_bytes(4);
                    $randomInt = unpack('L', $randomBytes)[1];

                    DB::table('send_notification')->insert([
                        'title' => 'You haven`t signed in for the last ' . $totalDays . ' Days',
                        'send_by' => 1011,
                        'send_to' => $u->id,
                        'unique_id' => intval(microtime(true) + $randomInt),
                        'total_days' => $totalDays,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    echo "Email Sent Successfully for User ID: " . $u->id . " | Days: " . $totalDays . "<br>";

                } else {

                    echo "No notification needed for User ID: " . $u->id . " | Days: " . $totalDays . "<br>";

                }

            } catch (\Exception $e) {

                Log::error('Login Notification Error: ' . $e->getMessage());

                echo "Error for User ID: " . $u->id . " => " . $e->getMessage() . "<br>";

            }

        }

        return 0;
    }
}