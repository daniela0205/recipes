<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //

    //relation 1 to 1 with User
  
    public function user(){
        
        return $this->belongsTo(User::class,'user_id');
    }
}
