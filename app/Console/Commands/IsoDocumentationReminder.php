<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use App\User;

class IsoDocumentationReminder extends Command
{
    protected $signature = 'Reminder:IsoDocumentation';

    protected $description = 'Insert an ISO Documentation reminder in send_notification for every user';

    private const TITLE = 'Reminder ISO Documentation.';

    public function handle()
    {
        $userIdToExclude = 1011;

        $users = User::where('id', '!=', $userIdToExclude)->where('email' , 'user@isoonline.com')->get();

        foreach ($users as $u) {
            try {
                $randomInt = unpack('L', random_bytes(4))[1];

                $messageHtml = View::make('mails.isoDocumentationReminder', [
                    'clientName' => $u->name,
                ])->render();

                DB::table('send_notification')->insert([
                    'title'      => self::TITLE,
                    'message'    => $messageHtml,
                    'send_by'    => 1011,
                    'send_to'    => $u->id,
                    'unique_id'  => intval(microtime(true) + $randomInt),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                echo "ISO Reminder Recorded for User ID: {$u->id}<br>";
            } catch (\Exception $e) {
                Log::error('ISO Documentation Reminder Error: ' . $e->getMessage());
                echo "Error for User ID: {$u->id} => {$e->getMessage()}<br>";
            }
        }

        return 0;
    }
}
