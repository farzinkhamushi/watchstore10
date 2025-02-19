<?php

namespace App\Enums;

enum PaymentStatus:string{

    case Draft = 'draft';

    case Success = 'success';

    case Failed = 'failed';
}

?>
