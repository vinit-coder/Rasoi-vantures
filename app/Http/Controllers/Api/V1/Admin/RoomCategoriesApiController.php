<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\RoomCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomCategoryRequest;
use App\Http\Requests\UpdateRoomCategoryRequest;
use App\Http\Resources\Admin\RoomCategoryResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoomCategoriesApiController extends Controller
{
    public function index()
    {
         

        return new RoomCategoryResource(RoomCategory::all());
    }

    public function store(StoreRoomCategoryRequest $request)
    {
        $RoomCategory = RoomCategory::create($request->all());

        return (new RoomCategoryResource($RoomCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RoomCategory $RoomCategory)
    {
         

        return new RoomCategoryResource($RoomCategory);
    }

    public function update(UpdateRoomCategoryRequest $request, RoomCategory $RoomCategory)
    {
        $RoomCategory->update($request->all());

        return (new RoomCategoryResource($RoomCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RoomCategory $RoomCategory)
    {
        abort_if(Gate::denies('roomcategory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $RoomCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
