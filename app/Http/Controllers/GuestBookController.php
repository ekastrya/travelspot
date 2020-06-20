<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GuestBook;

class GuestBookController extends Controller
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
        return view('pages.guestbook.create',[
            'guests' => GuestBook::paginate(10)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'fullname'  => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'rating'    => 'required',
            'opinion'   => 'sometimes',
            'commit'    => 'required',
            'role'      => 'required'
        ]);
        GuestBook::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'rating' => $request->rating,
            'opinion' => ($request->has('opinion')?$request->opinion:null),
            'role' => $request->role
        ]);

        return redirect()->route('guestbook.create')->withMessage(sprintf("Terima kasih, %s, Anda telah terdaftar sebagai tamu di TravelSpot", $request->fullname));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
