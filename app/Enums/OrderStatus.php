<?php

namespace App\Enums;

enum OrderStatus:string{
    case Received = 'received';
    case Rejected = 'rejected';
    case Proccessing = 'proccessing';
    case Sent = 'sent';

}

?>
