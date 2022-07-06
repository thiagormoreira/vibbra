<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoredealRequest;
use App\Http\Requests\UpdatedealRequest;
use App\Models\deal;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoredealRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoredealRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function show(deal $deal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function edit(deal $deal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatedealRequest  $request
     * @param  \App\Models\deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatedealRequest $request, deal $deal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function destroy(deal $deal)
    {
        //
    }
}
