<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewbornRecordRequest;
use App\Http\Requests\UpdateNewbornRecordRequest;
use App\Models\Delivery;
use App\Models\NewbornRecord;
use Illuminate\Http\Request;
use Inertia\Controller;

class NewbornRecordController extends Controller
{
     public function index()
    {
        return NewbornRecord::with('delivery')->paginate(10);
    }

    public function create()
    {
        return response()->json(Delivery::select('id')->get());
    }

    public function store(
        StoreNewbornRecordRequest $request,
        Delivery $service
    ) {
        return response()->json(
            $service->createNewborn($request->validated()),
            201
        );
    }

    public function update(
        UpdateNewbornRecordRequest $request,
        NewbornRecord $newbornRecord,
        Delivery  $service
    ) {
        return $service->updateNewborn(
            $newbornRecord,
            $request->validated()
        );
    }
}