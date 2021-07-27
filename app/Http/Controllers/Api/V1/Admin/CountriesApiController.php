<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Http\Resources\Admin\CountryResource;
use App\Models\Country;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CountriesApiController extends Controller
{
    public function index()
    {
        

         
        return new CountryResource(Country::all());
    }

    public function store(StoreCountryRequest $request)
    {
        $Country = Country::create($request->all());

        return (new CountryResource($Country))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Country $Country)
    {
        

        return new CountryResource($Country);
    }

    public function update(UpdateCountryRequest $request, Country $Country)
    {
        $Country->update($request->all());

        return (new CountryResource($Country))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Country $Country)
    {
        abort_if(Gate::denies('country_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Country->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
