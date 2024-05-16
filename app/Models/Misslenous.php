<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Misslenous extends Model
{
    use HasFactory;

	protected $table ='misslenouses';

    protected $guarded = [];

    public function inspection_details(){
        return $this->belongsTo(InspectionDetail::class);
    }
}
