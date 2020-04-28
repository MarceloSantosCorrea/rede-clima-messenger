<?php

namespace App\Observers;

use App\Events\SendMessagePusher;
use App\Models\Setting;

class SettingObserver
{
    public function creating(Setting $setting)
    {
        $setting->id = \App\Helpers\Models::generateUid($setting, 'id');
    }

    public function saved()
    {
        $data['action'] = 'change-settings';
        event(new SendMessagePusher($data));
    }
}
