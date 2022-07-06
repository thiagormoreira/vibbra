<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreinviteRequest;
use App\Http\Requests\UpdateinviteRequest;
use App\Models\invite;

class InviteController extends Controller
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
     * @param  \App\Http\Requests\StoreinviteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreinviteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function show(invite $invite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function edit(invite $invite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateinviteRequest  $request
     * @param  \App\Models\invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateinviteRequest $request, invite $invite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function destroy(invite $invite)
    {
        //
    }
}
