<?php

namespace App;

class Channel extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }

    public function editable(){
        if(!auth()->check()) return false;
        return $this->user_id === auth()->user()->id;
    }
}
