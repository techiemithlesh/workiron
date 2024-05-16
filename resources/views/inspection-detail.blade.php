@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h3 class="col-md-8 my-1">Vehicle Inspection Report</h3>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('report-vehicle-inspection', [$inspection->id]) }}" class="btn btn-primary"><i class="bi bi-file-earmark-check"></i> Report</a>
                            <a href="{{ route('vehicle-inspections') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>INSPECTION DETAILS</h4>
                            <table class="table w-100" width="100%">
                                <tr>
                                    <td width="50%">Report Number</td>
                                    <td width="50%">{{ $inspection->report_no }}</td>
                                </tr>
                                <tr>
                                    <td width="50%">Location</td>
                                    <td width="50%">{{ $inspection->location }}</td>
                                </tr>
                                <tr>
                                    <td width="50%">Inspection Date</td>
                                    <td width="50%">{{ $inspection->inspection_date }}</td>
                                </tr>
                                <tr>
                                    <td width="50%">Inspector Name</td>
                                    <td width="50%">{{ $inspection->inspector_name }}</td>
                                </tr>
                                <tr>
                                    <td width="50%">Addition Notes</td>
                                    <td width="50%">{{ $inspection->additional_notes }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4>EQUIPMENT INFORMATION</h4>
                            <table class="table w-100" width="100%">
                                <tr>
                                    <td width="50%">Vehicle Type</td>
                                    <td width="50%">{{ $inspection->vehicle_type }}</td>
                                </tr>
                                <tr>
                                    <td width="50%">Vehicle Make</td>
                                    <td width="50%">{{ $inspection->vehicle_make }}</td>
                                </tr>
                                <tr>
                                    <td width="50%">Unit Number</td>
                                    <td width="50%">{{ $inspection->vehicle_no }}</td>
                                </tr>
                                <tr>
                                    <td width="50%">VIN</td>
                                    <td width="50%">{{ $inspection->vin_no }}</td>
                                </tr>
                                <tr>
                                    <td width="50%">Meter Reading</td>
                                    <td width="50%">{{ $inspection->meter_reading }}</td>
                                </tr>
                                <tr>
                                    <td width="50%">Model/Year</td>
                                    <td width="50%">{{ $inspection->model_year }}</td>
                                </tr>
                                <tr>
                                    <td width="50%">ECM Reading</td>
                                    <td width="50%">{{ $inspection->ecm_reading }}</td>
                                </tr>
                                <tr>
                                    <td width="50%">ECM Hours</td>
                                    <td width="50%">{{ $inspection->ecm_hours }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text-center">Performance/ Safety/ Quality/ Functionality Inspection Checklist</h4>
                            <div class="table-responsive">
                                <table class="table w-100 bordered" width="100%">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th width="5%">&nbsp;</th>
                                            <th width="35%">Inspection Checklist</th>
                                            <th width="20%">Note</th>
                                            <th width="10%">Good</th>
                                            <th width="10%">Repair Needs</th>
                                            <th width="10%">Replace</th>
                                            <th width="10%">NA</th>
                                            <th width="10%">Images</th>
                                        </tr>
                                    </thead>
                                    @foreach($inspection->checklist as $k => $checklist)
                                        <tr>
                                            <td>{{ $k + 1 }}</td>
                                            <td>{{ $checklist->name }}</td>
                                            <td>{{ $checklist->note }}</td>
                                            <td>{!! !empty($checklist->good) ? '<i class="bi bi-check-square text-success"></i>' : '<i class="bi bi-x-square text-danger"></i>' !!}</td>
                                            <td>{!! !empty($checklist->repair) ? '<i class="bi bi-check-square text-success"></i>' : '<i class="bi bi-x-square text-danger"></i>' !!}</td>
                                            <td>{!! !empty($checklist->replace) ? '<i class="bi bi-check-square text-success"></i>' : '<i class="bi bi-x-square text-danger"></i>' !!}</td>
                                            <td>{!! !empty($checklist->na) ? '<i class="bi bi-check-square text-success"></i>' : '<i class="bi bi-x-square text-danger"></i>' !!}</td>
                                            <td>
                                                @if(!empty($checklist->images))
                                                    @foreach(explode(",", $checklist->images) as $img)
                                                        <a href="{{ $img }}" target="_blank">
                                                            <img src="{{ $img }}" alt="check-image" width="100" />
                                                        </a>
                                                    @endforeach
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection