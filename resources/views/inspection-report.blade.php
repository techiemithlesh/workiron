<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <title>{{ config('app.name', 'Vehicle Inspection') }}</title>

    <style>
        @page { margin: auto 55px; }
        .page-break { page-break-after: always; }
        body { margin-top: 35px; font-size: 18px }
        .main-div{ border: 0; position: relative; height: 1050px; }
        .text-center{ text-align: center; }
        .pr-30{ padding-right: 30px }
        .pl-30{ padding-left: 30px }
        .underline { border-bottom: 1px solid #000; }
        .no-underline { padding-right: 10px; border-bottom: 2px solid #FFF !important; margin-bottom: 1px; background: #FFF; }
        .bg-dark{ background: #CCC }
        .checklist th, td{ padding: 5px; }
    </style>
</head>
<body>
    <div class="main-div">
        <h2 class="text-center">VEHICLE INSPECTION REPORT</h2>
        <table width="100%">
            <tr>
                <td width="50%" valign="top" class="pr-30">
                    <h3>INSPECTION DETAILS</h3>
                    <p class="underline"><span class="no-underline">Report Number: </span><strong>{{ $data->report_no }}</strong></p>
                    <p class="underline"><span class="no-underline">Location: </span>{{ $data->location }}</p>
                    <p class="underline"><span class="no-underline">Inspection Date: </span><strong>{{ $data->inspection_date }}</strong></p>
                    <p class="underline"><span class="no-underline">Inspector Name: </span><strong>{{ $data->inspector_name }}</strong></p>
                    <p>Additional Notes: <span style="text-decoration: underline; display: block; text-align: justify; text-justify: inter-word;">{!! $data->additional_notes !!}</span></p>
                </td>
                <td width="50%" valign="top" class="pl-30">
                    <h3>EQUIPMENT INFORMATION</h3>
                    <p class="underline"><span class="no-underline">Vehicle Type: </span><strong>{{ $data->vehicle_type }}</strong></p>
                    <p class="underline"><span class="no-underline">Vehicle Make: </span>{{ $data->vehicle_make }}</p>
                    <p class="underline"><span class="no-underline">Unit Number: </span><strong>{{ $data->vehicle_no }}</strong></p>
                    <p class="underline"><span class="no-underline">VIN: </span>{{ $data->vin_no }}</p>
                    <p class="underline"><span class="no-underline">Meater Reading: </span>{{ $data->meter_reading }}</p>
                    <p class="underline"><span class="no-underline">Model/Year: </span>{{ $data->model_year }}</p>
                    <p class="underline"><span class="no-underline">ECM Reading: </span>{{ $data->ecm_reading }}</p>
                    <p class="underline"><span class="no-underline">ECM Hours: </span>{{ $data->ecm_hours }}</p>
                </td>
            </tr>
        </table>
        <h4 class="text-center">Performance/ Safety/ Quality/ Functionality Inspection Checklist</h4>
        <table class="checklist" width="100%" border="1" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="bg-dark">
                    <th width="8%">&nbsp;</th>
                    <th width="31%">Inspection Checklist</th>
                    <th width="31%">Note</th>
                    <th width="10%">Good</th>
                    <th width="10%">Repair Needs</th>
                    <th width="10%">Replace</th>
                    <th width="10%">NA</th>
                </tr>
            </thead>
            @foreach($data->checklist as $k => $checklist)
                <tr>
                    <td align="center">{{ $k + 1 }}</td>
                    <td>{{ $checklist->name }}</td>
                    <td>{{ $checklist->note }}</td>
                    <td align="center">
                        @if(!empty($checklist->good))
                            <img src="{{ __DIR__ }}/../../../public/check-square.png" />
                        @else
                            <img src="{{ __DIR__ }}/../../../public/x-square.png" />
                        @endif
                    </td>
                    <td align="center">
                        @if(!empty($checklist->repair))
                            <img src="{{ __DIR__ }}/../../../public/check-square.png" />
                        @else
                            <img src="{{ __DIR__ }}/../../../public/x-square.png" />
                        @endif
                    </td>
                    <td align="center">
                        @if(!empty($checklist->replace))
                            <img src="{{ __DIR__ }}/../../../public/check-square.png" />
                        @else
                            <img src="{{ __DIR__ }}/../../../public/x-square.png" />
                        @endif
                    </td>
                    <td align="center">
                        @if(!empty($checklist->na))
                            <img src="{{ __DIR__ }}/../../../public/check-square.png" />
                        @else
                            <img src="{{ __DIR__ }}/../../../public/x-square.png" />
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>

        @if($images->count())
            <h4 class="text-center">Images</h4>
            @foreach($images as $record)
                @foreach(explode(',', $record->images) as $img)
                {{-- "{{ __DIR__ }}/../../../public{{ str_replace(env('APP_URL'), '', $img) }}" --}}
                    <img src="{{ __DIR__ }}/../../../public{{ str_replace(env('APP_URL'), '', $img) }}" width="100%" />
                @endforeach
            @endforeach
        @endif
    </div>
</body>
</html>