<?php

namespace KupelikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Lopi\Bundle\PusherBundle;

class PusherController extends Controller
{
    
    /**
     * Actualiza likes en la kupela
     */
     
    public function getIndex()
    {
        return view('notification');
    }

    public function updateLikeAction(Request $request)
    {
        
        $text = $request['clave'];
        $pusher = App::make('pusher');
        $pusher->trigger('my-channel', 'my-event', $text); 

    }
}
?>