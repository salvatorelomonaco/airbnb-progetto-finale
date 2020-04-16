<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    public function apartments() {
        // dichiaro una relazione 'a molti' verso il model Apartment
        // c'è una relazione molti a molti tra i model Apartment e Service
        // non c'è una tabella che 'comanda' e una che è 'dipendente' come nelle relazioni '1 a molti',
        // in entrambi i Model uso il metodo "belongsToMany"
        return $this->belongsToMany('App\Apartment');
    }
}
