<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //
    protected $fillable= ['region'];
    
    public function sampleTable()
    {
    	return $this->hasMany('\App\Models\SampleTable', 'ID', 'RegionID');
    }
}
