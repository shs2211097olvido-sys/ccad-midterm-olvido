<?php

namespace App\Http\Controllers;

use App\Models\Obstetrician;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Controller;

class ObstetricianController extends Controller
{
    public function index()
    {
        return Obstetrician::with('deliveries')->paginate(10);
    }

    public function create()
    {
        return response()->json([
            'message' => 'Ready to create an obstetrician record.'
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'license_number' => 'required|string|max:100|unique:obstetricians,license_number',
            'is_active' => 'sometimes|boolean',
            'schedule_start' => 'required|date_format:H:i',
            'schedule_end' => 'required|date_format:H:i|after:schedule_start',
        ]);

        return response()->json(
            Obstetrician::create($data),
            201
        );
    }

    public function update(Request $request, Obstetrician $obstetrician)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'license_number' => [
                'sometimes',
                'required',
                'string',
                'max:100',
                Rule::unique('obstetricians', 'license_number')
                    ->ignore($obstetrician->id),
            ],
            'is_active' => 'sometimes|boolean',
            'schedule_start' => 'sometimes|required|date_format:H:i',
            'schedule_end' => 'sometimes|required|date_format:H:i|after:schedule_start',
        ]);

        $obstetrician->update($data);

        return response()->json($obstetrician);
    }
}