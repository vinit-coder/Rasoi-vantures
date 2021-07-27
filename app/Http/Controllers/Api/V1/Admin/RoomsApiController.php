<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Http\Resources\Admin\RoomResource;
use App\Models\Room;
use App\Models\RoomCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoomsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
         

        return new RoomResource(Room::all());
    }

    public function store(StoreRoomRequest $request)
    {
        $Room = Room::create($request->all());

        if ($request->input('photo', false)) {
            $Room->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return (new RoomResource($Room))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Room $Room)
    {
        

        return new RoomResource($Room);
    }

    public function update(UpdateRoomRequest $request, Room $Room)
    {
        $Room->update($request->all());

        if ($request->input('photo', false)) {
            if (!$Room->photo || $request->input('photo') !== $Room->photo->file_name) {
                $Room->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($Room->photo) {
            $Room->photo->delete();
        }

        return (new RoomResource($Room))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Room $Room)
    {
        abort_if(Gate::denies('Room_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Room->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
