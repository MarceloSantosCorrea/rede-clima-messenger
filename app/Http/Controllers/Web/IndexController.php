<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

//use Berkayk\OneSignal\OneSignalClient;

class IndexController extends Controller
{
    public function index()
    {
//        \OneSignal::sendNotificationToAll(
//            "Assista Rede Clima TV",
//            $url = 'https://redeclima.tv.br',
//            $data = null,
//            $buttons = null,
//            $schedule = null
//        );
        \OneSignal::sendNotificationToUser(
            "Teste Rede Clima TV",
            '07483f99-3f22-415e-bcb7-fef70fe0f04c',
//            'c3c62ca9-d777-4c4d-8b53-dae88a167e65',
            null,
            null,
            null,
            null,
            null,
            'TTTTTT'
        );

//        $oneSignal = new OneSignalClient();
//        $oneSignal->sendNotificationToUser(
//            "Some Message",
//            'c3c62ca9-d777-4c4d-8b53-dae88a167e65',
//            );


        return view('pages.index.index');
    }
}
