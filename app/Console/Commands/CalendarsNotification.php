<?php

namespace App\Console\Commands;

use App\Models\Calendar;
use App\Models\Setting;
use Illuminate\Console\Command;

class CalendarsNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:calendars-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notificação da Grade de Programação';

    /**
     * @throws \Exception
     */
    public function handle()
    {
        $notify_time_before = null;
        try {
            $notify_time_before = Setting::get('notify_time_before');
        } catch (\Exception $e) {
            $notify_time_before = 0;
        }

        $dayOfWeek = date('w');
        $date      = new \DateTime();
        $interval  = new \DateInterval("PT{$notify_time_before}M");
        $date->add($interval);

        $calendars = Calendar::where(['week_day' => $dayOfWeek, 'start_at' => $date->format('H:i:00')])->get();

        if ($calendars->count()) {
            /** @var Calendar $calendar */
            foreach ($calendars as $calendar) {
                \OneSignal::sendNotificationToAll(
                    "Assista agora na Rede Clima TV - {$calendar->program->name}",
                    $url = null, //'https://redeclima.tv.br',
                    $data = null,
                    $buttons = null,
                    $schedule = null,
                    $headings = null
                );
            }
        }
    }
}
