<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function get_driver($id) {
        $driver = User::with('driver')->where('role','driver')->where('id',$id)->first();

        if (!$driver) {
            return response()->json([
                'status'  => false,
                'message' => 'driver not found',
                'data'    => []
            ], 404);
        }

        return response()->json([
            'status'  => true,
            'message' => 'driver fetched successfully',
            'data'    => $driver
        ]);
    }
}
