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
    protected $description = 'Command description';

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
        $user = User::where('last_login', '<=', Carbon::now()->subDays(90))
        ->where('id', '!=', $userIdToExclude)
        ->get();    
        foreach($user as $u){
            $lastLogin = Carbon::parse($u->last_login);
            $totalDays = now()->diffInDays($lastLogin);
            $toEmailAddress = "info@isoonline.com";
                if ($totalDays == 90 || $totalDays == 180 || $totalDays == 300) {
                    if($totalDays == 90){
                        Notification::route('mail', $toEmailAddress)->notify(new SixMonthNotification());
                    }elseif($totalDays == 180){
                        Notification::route('mail', $toEmailAddress)->notify(new SixMonthNotification());
                    }elseif($totalDays == 300){
                        Notification::route('mail', $toEmailAddress)->notify(new SixMonthNotification());
                    }else{
                        print_r("No email template Found");
                    }
                    $randomBytes = random_bytes(4); 
                    $randomInt = unpack('L', $randomBytes)[1];
                    DB::table('send_notification')->insert([
                        'title' => 'You haven`t SignIn for the last ' . $totalDays . ' Days',
                        'send_by' => 1011,
                        'send_to' => $u->id,
                        'unique_id' => intval(microtime(true) + $randomInt),
                        'total_days' => $totalDays,
                    ]);
                    echo "Email Send Successfully " . $totalDays . " <br>";
                } else {
                    print_r("Days are not matching to 90, 180 or 300. Days are " . $totalDays);
                    echo "<br>";
                }
        }
        // info("Cron is working fine");

    }
}
