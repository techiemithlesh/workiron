<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionChecklist extends Model
{
    use HasFactory;

    protected $table = 'inspection_checklist';

    protected $fillable = [
        'inspection_detail_id',
        'name',
        'note',
        'good',
        'repair',
        'replace',
        'na',
        'images',
    ];

    public function user() {
        return $this->belongsTo(InspectionDetail::class);
    }
}
