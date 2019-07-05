<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $guarded = ['id'];

    public function contactUser(){
        return $this->belongsTo('App\Models\User', 'contact_user');
    }

    public function addedUser(){
        return $this->belongsTo('App\Models\User', 'added_by');
    }

    public function fee()
    {
        return $this->hasMany('App\Models\Fee', 'channel_id');
    }
}
