<?php

namespace App\Http\Controllers;

use App\Models\DeliveryOrder;
use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function show($id)
    {
        $order = DeliveryOrder::findOrFail($id);
        return view('pages.qr_page.index', compact('order'));
    }
}
