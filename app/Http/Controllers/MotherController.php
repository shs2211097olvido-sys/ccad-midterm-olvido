<?php

namespace App\Http\Controllers;

use App\Models\Mother;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Controller;

class MotherController extends Controller
{
     public function index()
    {
        return Mother::with('deliveries')->paginate(10);
    }

    public function create()
    {
        return response()->json([
            'message' => 'Ready to create a mother record.'
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mother_name' => 'required|string|max:255',
            'mother_id_card' => 'required|string|max:50|unique:mothers,mother_id_card',
        ]);

        $data['mother_id_card'] = strtoupper(
            preg_replace('/[^A-Za-z0-9]/', '', $data['mother_id_card'])
        );

        $mother = Mother::create($data);

        return response()->json($mother, 201);
    }

    public function update(Request $request, Mother $mother)
    {
        $data = $request->validate([
            'mother_name' => 'sometimes|required|string|max:255',
            'mother_id_card' => [
                'sometimes',
                'required',
                'string',
                'max:50',
                Rule::unique('mothers', 'mother_id_card')
                    ->ignore($mother->id),
            ],
        ]);

        if (isset($data['mother_id_card'])) {
            $data['mother_id_card'] = strtoupper(
                preg_replace('/[^A-Za-z0-9]/', '', $data['mother_id_card'])
            );
        }

        $mother->update($data);

        return response()->json($mother, 200);
    }
}

