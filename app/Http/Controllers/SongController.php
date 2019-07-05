<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SongController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $username = env('API_USERNAME', 'Hacker');
        $password = Hash::make(env('API_PASSWORD', 'TheHacker'));

        $user = $request->input('username');
        $pass = $request->input('password');

        if ($username == $user && Hash::check($pass, $password) ){
            $id = $request->input('id');
            if ($request->hasFile('song_file')){
                $file = $request->file('song_file');
                $file_name = $id.".".$file->getClientOriginalExtension();
                $file->storeAs('public/songs', $file_name);

                return response("Successfully Uploaded the song", 200);
            }
            else{
                return response("No Song File was received", 403);
            }
        }
        else{
            return response("Unauthorized request", 401);
        }
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
