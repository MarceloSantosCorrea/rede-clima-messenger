<?php

namespace App\Observers;

use App\Events\SendMessagePusher;

class CalendarObserver
{
    public function saved()
    {
        $data['action'] = 'change-programation';
        event(new SendMessagePusher($data));
    }

    public function deleted()
    {
        $data['action'] = 'change-programation';
        event(new SendMessagePusher($data));
    }
}
