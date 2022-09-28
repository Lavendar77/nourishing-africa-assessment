<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Spatie\QueryBuilder\QueryBuilder;

class CountryController extends Controller
{
    /**
     * Create a new controller instance
     *
     * @param \App\Models\Country $country
     */
    public function __construct(public Country $country)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function __invoke(Request $request)
    {
        $countries = QueryBuilder::for($this->country)
            ->select([
                'id',
                'name',
            ])
            ->allowedFields([
                'id',
                'name',
            ])
            ->defaultSort('name')
            ->allowedSorts([
                'name',
            ])
            ->allowedFilters([
                'name',
            ]);

        $countries = (bool) $request->do_not_paginate
            ? $countries->get()
            : $countries->paginate($request->per_page)->withQueryString();

        return ResponseBuilder::asSuccess()
            ->withMessage('Countries fetched successfully.')
            ->withData([
                'countries' => $countries,
            ])
            ->build();
    }
}
