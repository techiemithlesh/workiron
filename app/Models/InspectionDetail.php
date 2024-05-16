<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDF;

class InspectionDetail extends Model
{
    use HasFactory;

    protected $table = 'inspection_details';

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function checklist() {
        return $this->hasMany(InspectionChecklist::class, 'inspection_detail_id', 'id');
    }

    public function conditions(){
        return $this->hasMany(Condition::class, 'inspection_detail_id', 'id');
    }

    public function extras(){
        return $this->hasOne(Extra::class, 'inspection_detail_id', 'id');
    }

    public function inspectionTyre(){
        return $this->hasOne(InspectionTyre::class, 'inspection_detail_id', 'id');
    }

	public function misslenous(){
        return $this->hasOne(Misslenous::class, 'inspection_detail_id', 'id');
    }

    public function operational(){
        return $this->hasMany(InspectionOperationalTest::class, 'inspection_detail_id', 'id');
    }

    public function incabInspectionTest(){
        return $this->hasMany(InspectionInCab::class, 'inspection_detail_id', 'id');
    }

    public function outsideInspection(){
        return $this->hasMany(InspectionOutside::class, 'inspection_detail_id', 'id');
    }

    public function underInspection(){
        return $this->hasMany(UnderVehicleInspectionTest::class, 'inspection_detail_id', 'id');
    }

    public function tyreInspectionTest(){
        return $this->hasMany(TyreInspectionTest::class, 'inspection_detail_id', 'id');
    }

    public function estimates(){
        return $this->hasMany(Estimates::class, 'inspection_detail_id', 'id');
    }
}
