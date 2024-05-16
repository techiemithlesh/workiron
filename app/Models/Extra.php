<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    use HasFactory;

    protected $table ='vehicle_inspection_extras_details';

    protected $guarded = [];

    public function inspection_details(){
        return $this->belongsTo(InspectionDetail::class);
    }
}
