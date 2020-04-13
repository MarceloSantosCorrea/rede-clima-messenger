<?php

namespace App\Observers;

use App\Models\Setting;

class SettingObserver
{
    public function creating(Setting $setting)
    {
        $setting->id = \App\Helpers\Models::generateUid($setting, 'id');
    }
}
