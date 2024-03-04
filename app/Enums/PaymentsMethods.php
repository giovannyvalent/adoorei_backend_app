<?php

namespace App\Enums;

enum PaymentsMethods: string
{
    case CD = 'DÉBITO';
    case CC = 'CRÉDITO';
    case PP = 'PIX';
    case BT = 'BOLETO';
}