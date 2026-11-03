<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Controller;

class RoomController extends Controller
{
     public function index()
    {
        return Room::with('deliveries')->paginate(10);
    }

    public function create()
    {
        return response()->json([
            'message' => 'Ready to create a room record.'
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'room_number' => 'required|string|max:20|unique:rooms,room_number',
        ]);

        $data['room_number'] = strtoupper(
            preg_replace('/[^A-Za-z0-9-]/', '', trim($data['room_number']))
        );

        $room = Room::create($data);

        return response()->json($room, 201);
    }

    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'room_number' => [
                'sometimes',
                'required',
                'string',
                'max:20',
                Rule::unique('rooms', 'room_number')->ignore($room->id),
            ],
        ]);

        if (isset($data['room_number'])) {
            $data['room_number'] = strtoupper(
                preg_replace('/[^A-Za-z0-9-]/', '', trim($data['room_number']))
            );
        }

        $room->update($data);

        return response()->json($room, 200);
    }
}