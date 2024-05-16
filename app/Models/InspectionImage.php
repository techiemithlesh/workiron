<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function inspectionDetails(){
        return $this->belongsTo(InspectionDetail::class);
    }
}
