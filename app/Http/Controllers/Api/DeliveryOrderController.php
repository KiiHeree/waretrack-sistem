<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeliveryOrder;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DeliveryOrderController extends Controller
{
    public function get_order_by_driver($id)
    {
        $orders = DeliveryOrder::with(['driver', 'items', 'warehouse'])
            ->orderByRaw("CASE 
        WHEN status = 'picked_up' THEN 1
        WHEN status = 'in_transit' THEN 2
        WHEN status = 'assigned' THEN 3
        WHEN status = 'delivered' THEN 4
        ELSE 5 END")
            ->whereNotNull('assigned_driver_id')
            ->where('assigned_driver_id', $id)
            // ->where('status','!=','delivered')
            ->whereDate('created_at', Carbon::today()) // cuma ambil order hari ini
            ->orderBy('created_at', 'desc')
            ->get();

        if ($orders->isEmpty()) {
            return response()->json([
                'status'  => false,
                'message' => 'No orders found for this driver',
                'data'    => []
            ], 404);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Orders fetched successfully',
            'data'    => $orders
        ]);
    }

    public function get_order_detail($id)
    {
        $orders = DeliveryOrder::with(['driver', 'items.item', 'warehouse'])
            ->whereNotNull('assigned_driver_id')
            ->where('id', $id)
            ->first();

        if (!$orders) {
            return response()->json([
                'status'  => false,
                'message' => 'No orders found',
                'data'    => []
            ], 404);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Orders fetched successfully',
            'data'    => $orders
        ]);
    }

    public function getOrderDelivered(Request $request, $id)
    {
        $start = Carbon::parse($request->start_date)->startOfDay();
        $end   = Carbon::parse($request->end_date)->endOfDay();
        $orders = [];
        if ($request->start_date && $request->end_date) {
            $orders = DeliveryOrder::with(['driver', 'items', 'warehouse'])
                ->orderByRaw("CASE 
        WHEN status = 'picked_up' THEN 1
        WHEN status = 'in_transit' THEN 2
        WHEN status = 'assigned' THEN 3
        WHEN status = 'delivered' THEN 4
        ELSE 5 END")
                ->whereBetween('created_at', [$start, $end])
                ->whereNotNull('assigned_driver_id')
                ->where('assigned_driver_id', $id)
                ->where('status', 'delivered')
                ->get();
        } else {
            $orders = DeliveryOrder::with(['driver', 'items', 'warehouse'])
                ->orderByRaw("CASE 
            WHEN status = 'picked_up' THEN 1
            WHEN status = 'in_transit' THEN 2
            WHEN status = 'assigned' THEN 3
            WHEN status = 'delivered' THEN 4
            ELSE 5 END")
                ->whereNotNull('assigned_driver_id')
                ->where('assigned_driver_id', $id)
                ->where('status', 'delivered')
                ->whereDate('created_at', Carbon::today()) // cuma ambil order hari ini
                ->orderBy('created_at', 'desc')
                ->limit(10)->get();
        }

        if ($orders->isEmpty()) {
            return response()->json([
                'status'  => false,
                'message' => 'No orders found for this driver',
                'data'    => []
            ], 404);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Orders fetched successfully',
            'data'    => $orders
        ]);
    }

    public function updateStatusOrder(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $update = DeliveryOrder::where('id', $id)->first();

        switch ($request->status) {
            case 'picked_up':
                $update->update([
                    'status' => $request->status
                ]);
                break;

            case 'in_transit':
                $update->update([
                    'status' => $request->status
                ]);
                break;

            case 'delivered':
                $update->update([
                    'status' => $request->status
                ]);
                break;

            default:
                return response()->json([
                    'status'  => false,
                    'message' => 'Status error',
                    'data'    => []
                ], 404);
                break;
        }

        if (!$update) {
            return response()->json([
                'status'  => false,
                'message' => 'Update Error',
                'data'    => []
            ], 404);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Update successfully',
            'data'    => $update
        ]);
    }
}
