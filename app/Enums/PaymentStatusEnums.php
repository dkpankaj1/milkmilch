<?php
namespace App\Enums;

enum PaymentStatusEnums
{
    const PENDING = "pending";
    const PAID = "paid";
    const PARTIAL = "partial";
    const GENERATED = "generated";
}
