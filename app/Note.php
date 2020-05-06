<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //Table name
    protected $table='notes';

    //primary key
    public $primaryKey='id';

    //Timestamps
    public $timestamps=true;


public function user(){
    return $this->belongsTo('App\User');
}
}
