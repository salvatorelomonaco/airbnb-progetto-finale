<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    //
    public function apartment() {
        return $this->belongsToMany('App\Apartment')->withPivot('start_date');
    }
}
