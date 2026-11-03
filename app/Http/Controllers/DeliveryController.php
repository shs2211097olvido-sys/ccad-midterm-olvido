<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Services\DeliveryService;
use Illuminate\Http\Request;
use Inertia\Controller;

class DeliveryController extends Controller
{
    // Display all deliveries
    public function index()
    {
        return Delivery::with([
            'mother',
            'obstetrician',
            'room',
            'newbornRecord'
        ])->get();
    }

    // Store delivery
    public function store(Request $request, Delivery $service)
    {
        $data = $request->validate([
            'mother_name' => 'required|string|max:255',
            'mother_id_card' => 'required|string|max:50',
            'obstetrician_id' => 'required|exists:obstetricians,id',
            'room_number' => 'required|string|max:50',
            'delivery_type' => 'required|string',
            'birth_datetime' => 'required|date',
            'delivery_fee' => 'required|numeric|min:0',
            'discharge_status' => 'required|string',
            'baby_gender' => 'required|string',
            'birth_weight_kg' => 'required|numeric|between:0.3,7',
            'birth_height_cm' => 'required|numeric|between:20,65'
        ]);

        $delivery = $service->save($data);

        return response()->json([
            'message' => 'Delivery created successfully!',
            'data' => $delivery
        ], 201);
    }

    // Show delivery
    public function show(Delivery $delivery)
    {
        return $delivery->load([
            'mother',
            'obstetrician',
            'room',
            'newbornRecord'
        ]);
    }

    // Update delivery
    public function update(Request $request, Delivery $delivery)
    {
        $data = $request->validate([
            'delivery_type' => 'sometimes|required|string',
            'birth_datetime' => 'sometimes|required|date',
            'delivery_fee' => 'sometimes|required|numeric|min:0',
            'discharge_status' => 'sometimes|required|string'
        ]);

        $delivery->update($data);

        return response()->json([
            'message' => 'Delivery updated successfully!',
            'data' => $delivery
        ]);
    }

    // Delete delivery
    public function destroy(Delivery $delivery)
    {
        $delivery->delete();

        return response()->json([
            'message' => 'Delivery deleted successfully!'
        ]);
    }
}