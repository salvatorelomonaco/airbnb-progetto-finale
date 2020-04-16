<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    //

    protected $fillable = [
     'title', 'state', 'city', 'street', 'number', 'zip', 'lat', 'lon'
    ];


    public function info() {
        // ho una relazione 1 a 1 con la tabella info (la parte dipendente che ha FK)
        // questa è la parte che comanda
        return $this->hasOne('App\Info');

    }

    // relazione 1 a n tra apartments e messages
    public function messages() {
        // ho una relazione 1 a n con la tabella messages (la parte dipendente che ha FK)
        // questa è la parte che comanda
        return $this->hasMany('App\Message');

    }

    public function user() {
        // ho una relazione 1 a n con la tabella users (1 utente, molti appartamenti)
        // la tabella users comanda
        return $this->belongsTo('App\User');

    }

    public function sponsorships() {
        // ho una relazione n a n con la tabella sponsorship
        return $this->belongsToMany('App\Sponsorship')->withPivot('start_date');

    }

    public function services() {
        // relazione molti a molti con la tabella services
        return $this->belongsToMany('App\Service');
    }

    use SoftDeletes;
}
