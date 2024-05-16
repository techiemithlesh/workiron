<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimates extends Model
{
    use HasFactory;
	protected $table = 'estimates';
	protected $guarded = [];

    public function inspectionDetail()
    {
        return $this->belongsTo(InspectionDetail::class, 'inspection_detail_id');
    }

}
