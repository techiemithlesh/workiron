<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionOutside extends Model
{
    use HasFactory;

    protected $fillable = [
        'inspection_detail_id',
        'condition_name',
        'status',
        'inspection_img',
        'condition_comments',
    ];

    public function inspectionDetails(){
        return $this->belongsTo(InspectionDetail::class);
    }

 
    public function inspectionDetail()
    {
        return $this->belongsTo(InspectionDetail::class, 'inspection_detail_id');
    }
}
