<?php
require_once('../../../vendor/autoload.php');
/* pusher */
        $options = array(
            'cluster' => 'eu',
            'encrypted' => true
        );
        $pusher = new Pusher(
            'fb3191e3b80fc4a2076b',
            'e557d927dbe92d8dd449',
            '291479',
            $options
        );
        $data['message'] = "Cambiado";
        $pusher->trigger('my-channel', 'my-event', $data);
        /* pusher */
        ?>