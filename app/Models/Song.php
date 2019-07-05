<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $guarded = ['id'];

    public function addedUser(){
        return $this->belongsTo('App\Models\User', 'added_by');
    }

    public function approvedUser(){
        return $this->belongsTo('App\Models\User', 'added_by');
    }

    public function artists(){
        return $this->belongsToMany('App\Models\Artist', 'song_artists')->withPivot('type');
    }

    public function singers(){
        return $this->artists()->wherePivot('type', '=', '1')->get();
    }

    public function musicians(){
        return $this->artists()->wherePivot('type', '=', '2')->get();
    }


    public function writers(){
        return $this->artists()->wherePivot('type', '=', '3')->get();
    }

    public function producers(){
        return $this->artists()->wherePivot('type', '=', '4')->get();
    }


    /*public function getStatus()
    {
        if ($this->status == 1){
            return "Active (Added by Admin)";
        }
        elseif ($this->status == 2){
            return "Approved (Added by Artist)";
        }
        elseif ($this->status == 3){
            return "Pending";
        }
        elseif ($this->status == 4){
            return "Rejected";
        }
        else{
            return "Undefined";
        }
    }*/

}
