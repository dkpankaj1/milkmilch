<?php
namespace App\Enums;

enum OrderStatusEnums
{
    const PENDING = "pending";
    const ORDERED = "orderd";
    const COMPLETE = "complete";
    const REJECT = "reject";
    const PROCESSED = "PROCESSED";
    const CANCELLED = "CANCELLED";
    const DELIVERED = "DELIVERED";
    const RETURNED = "RETURNED";
    const RECEIVED = "RECEIVED";
    const UNKNOWN = "UNKNOWN";

}
