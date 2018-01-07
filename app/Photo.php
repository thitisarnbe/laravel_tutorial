<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    public $photo_dir = "/images/";

    protected $fillable = ['file'];


    public function getFileAttribute($value){
        return $this->photo_dir.$value; 
    }
}
