<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorebidRequest;
use App\Http\Requests\UpdatebidRequest;
use App\Models\bid;

class BidController extends Controller
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
     * @param  \App\Http\Requests\StorebidRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorebidRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function show(bid $bid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function edit(bid $bid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatebidRequest  $request
     * @param  \App\Models\bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatebidRequest $request, bid $bid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function destroy(bid $bid)
    {
        //
    }
}
