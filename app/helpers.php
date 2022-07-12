<?php

use App\Models\Invoice;

if (! function_exists('invoice_number')) {
    function invoice_number()
    {
        return Invoice::select('Id', 'Inv_No')->pluck('Id', 'Inv_No');
    }
}
