<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeliveryOrder;
use Illuminate\Http\Request;

class DeliveryOrderController extends Controller
{
    public function get_order_by_driver($id)
    {
        $orders = DeliveryOrder::with(['driver', 'items', 'warehouse'])
            ->whereNotNull('assigned_driver_id')
            ->where('assigned_driver_id', $id)
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

    public function getOrderDelivered($id)
    {
        $orders = DeliveryOrder::with(['driver', 'items', 'warehouse'])
            ->whereNotNull('assigned_driver_id')
            ->where('assigned_driver_id', $id)
            ->where('status', 'delivered')
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
