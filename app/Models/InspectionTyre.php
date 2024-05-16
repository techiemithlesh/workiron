<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionTyre extends Model
{
    use HasFactory;
	
	protected $table ='vehicle_tires';
	 
    protected $guarded = [];

    public function inspectionTyreDetails(){
        return $this->belongsTo(InspectionDetail::class);
    }
}
