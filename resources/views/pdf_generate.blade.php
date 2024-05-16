<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<title>{{ config('app.name', 'Vehicle Inspection') }}</title>
	</head>
	<body>
		<div style="font-family: Nunito, sans-serif;max-width: 960px;margin: 0 auto;">
			<table style="font-family: Nunito, sans-serif; max-width: 960px;border: 1px solid gray; padding: 5px;border-radius: 5px; margin-bottom: 5px; width:100%">
				<tr>
					<td style="width: 30%;border-right: 2px solid gray;">
						<div class="logo_container " style="font-weight:700; text-transform: capitalize; font-size: 12px; line-height: 6px; margin-bottom:0;">
							<img src="{{ asset('pdflogo.png') }}" alt="Vehicle Inspections" style="max-width:180px;"/>
							<p class="mt-8 font-xl">A F OHAB Company Inc</p>
							<p class="font-xl">Customer Service 317 225 4740</p>
						</div>
					</td>
					<td  style="width: 68%; padding-left:15px;">
					    <table style="width:100%">
					        <tr>
					            <td>
									<div class="upper_information_content">
										<p style="font-weight:700; font-size: 12px; line-height: 6px; margin-bottom:0;">{{$data->vehicle_type ?? 'NA'}}</p>
										<span style="font-weight:400; font-size: 10px; line-height: 6px; margin-bottom:0;">CLIENT</span>
										<p style="font-weight:400; font-size: 10px; line-height: 6px; margin-bottom:0;">397 - A F OHAB</p>
									</div>
								</td>
					            <td style="text-align:right;">
									<div class="vehicle_information">
										<p class="inspector_id" style="font-size: 12px; font-weight: 700; line-height: 2px;">INSPECTOR: <span class="" style="font-family: Nunito, sans-serif; line-height: 2px;">{{ $data->inspector_name }}</span> </p>
										<p class="inspection_id" style=" font-size: 10px; margin-left: 10px; line-height: 2px;">INSPECTION ID: <span>{{ $data->id }}</span> </p>
									</div>
								</td>
							</tr>
						</table>
					    <table  style="width:100%">
					        <tr>
					            <td><div class="insp_date" style=" margin-right: 5px;border-left: 2px solid gray; padding: 15px 5px 5px 0; border-left: none;">
									<p style="font-size: 8px; line-height: 4px;">INSP DATE</p>
									<span style="font-size: 12px; line-height: 6px;">{{ $data->inspection_date }}</span>
								</div></td>
								<td>
								    <div class="fleet_name" style=" margin-right: 5px;border-left: 2px solid gray; padding: 15px 5px 5px;">
										<p style="font-size: 8px; line-height: 4px;">FLEET NAME</p>
										<span style="font-size: 12px; line-height: 6px;">{{ $data->fleet_no }}</span>
									</div>
								</td>
								<td>
								    <div class="unit_number" style=" margin-right: 5px;border-left: 2px solid gray; padding: 15px 5px 5px;">
										<p style="font-size: 8px; line-height: 4px;">UNIT NUMBER</p>
										<span style="font-size: 12px; line-height: 6px;">{{ $data->unit_number }}</span>
									</div>
								</td>
								<td>
									<div class="vin_last" style=" margin-right: 5px;border-left: 2px solid gray; padding: 15px 5px 5px;">
										<p style="font-size: 8px; line-height: 4px;">VIN (LAST 8)</p>
										<span style="font-size: 12px; line-height: 6px;">{{ $data->vin_no }}</span>
									</div>
								</td>
								<td>
									<div class="vin_last" style=" margin-right: 5px;border-left: 2px solid gray; padding: 15px 5px 5px;">
										<p style="font-size: 8px; line-height: 4px;">PO NUMBER</p>
										<span style="font-size: 12px; line-height: 6px;">{{ $data->po_no }}</span>
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<table style="border: 1px solid gray; padding: 5px;border-radius: 5px; margin-bottom: 5px; width:100%">
			    <tr>
			        <td style="padding: 0 10px 5px 0;">
			            <p style="margin: 0;margin-top: 5px; margin-right: 50px; font-weight: 700; font-size: 12px;">YEAR <span style="font-weight: 400;">{{ $data->model_year }}</span></p>
						<p style="margin: 0;margin-top: 5px; margin-right: 50px; font-weight: 700; font-size: 12px;">MODEL <span style="font-weight: 400;">{{ $data->model_year }}</span></p>
					</td>
			        <td style="padding: 0 0 5px 10px;">
			            <p style=" margin: 0;margin-top: 5px; margin-right: 50px; font-weight: 700; font-size: 12px;">MAKE <span style=" font-weight: 400;">{{ $data->model_make }}</span></p>
						<p style=" margin: 0;margin-top: 5px; margin-right: 50px; font-weight: 700; font-size: 12px;">VIN <span style=" font-weight: 400;">{{ $data->vin_no }}</span></p>
					</td>
				</tr>
			</table>
			{{-- SPECIFICATION WORKSHEET START HERE --}}
			<section class="worksheet" style="border: 1px solid gray; padding: 0 5%;border-radius: 5px; margin-bottom: 5px; width: 90%">
				<div class="worksheet_container">
					<p style="font-size: 18px;font-weight: 700;text-align: center; text-transform: uppercase;">SPECIFICATION WORKSHEET</p>
				</div>
			</section>
			{{-- SPECIFICATION WORKSHEET START END --}}
			<table style="border: 1px solid gray; font-size:12px; width: 100%;margin-top: 10px;">
			    <tr>
			        <td style="width:50%">
			            <table style=" width: 100%;border: 1px solid gray; border-spacing: 0px;">
							<tr>
								<th colspan="2" style="background-color: #ccc;font-weight: 700; padding: 5px; text-align: left;">Interior Options</th>
							</tr>
							<tr>
								<td style="font-weight: 700; padding: 5px; text-align: left;">Interior Color:</td>
								<td style="padding: 5px; text-align: right;">{{ $data->interior_color }}</td>
							</tr>
						</table>
					</td>
			        <td style="width:50%">
			            <table style=" width: 100%; border: 1px solid gray; border-spacing: 0px;">
							<tr style="border: 1px solid gray;">
								<th colspan="2" style="background-color: #ccc;font-weight: 700; padding: 5px; text-align: left;">Steering Options</th>
							</tr>
							<tr style="border: 1px solid gray;">
								<td style="font-weight: 700; padding: 5px; text-align: left;">Power Steering?:</td>
								<td style="padding: 5px; text-align: right;">
								@if($data->powr_steering == 0)
								No
                               @else
                                 Yes
                              @endif
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<table style="font-size:12px; margin-top: 10px; width: 100%;">
                <tr>
                    <td style="vertical-align: baseline; width: 50%;">
						<table style="border: 1px solid gray; border-spacing: 1px; width:100%">
							<tr><th style="background-color: #ccc;border: 1px solid gray;font-weight: 700; padding: 5px; text-align: left;">Engine Options A</th></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Eng Make: <span style="font-weight: 400; float: right;">{{ $data->engine_make }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray;font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Eng Model: <span style="font-weight: 400; float: right;">{{ $data->engine_model }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray;font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Eng Serial: <span style="font-weight: 400; float: right;">{{ $data->engine_serial }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray;font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Eng HP: <span style="font-weight: 400; float: right;">{{ $data->engine_hp }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray;font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Cruise: <span style="font-weight: 400; float: right;">{{ $data->cruise }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray;font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Clean air idle: <span style="font-weight: 400; float: right;">{{ $data->clean_air_idle }}</span></p></td> </tr>
						</table>
						<table style="border: 1px solid gray; border-spacing: 1px;width:100%">
							<tr><th style="background-color: #ccc;border: 1px solid gray;font-weight: 700; padding: 5px; text-align: left;">Engine Options B</th></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Odometer: <span style="font-weight: 400; float: right;">{{ $data->odometer }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Hub odometer:: <span style="font-weight: 400; float: right;">{{ $data->hub_odometer }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">ECU HP: <span style="font-weight: 400; float: right;">{{ $data->ecu_hp }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">ECU Miles: <span style="font-weight: 400; float: right;">{{ $data->ecu_miles }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;">	<p style="padding: 0; margin: 0;">Eng Hours: <span style="font-weight: 400; float: right;">{{ $data->ecu_hours }}</span></p></td></tr>
						</table>
						<table style="border: 1px solid gray; border-spacing: 1px;width:100%">
							<tr><th style="background-color: #ccc;border: 1px solid gray;font-weight: 700; padding: 5px; text-align: left;">Engine Options C</th></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Eng Brake: <span style="font-weight: 400; float: right;">{{ $data->engine_brake }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Fuel: <span style="font-weight: 400; float: right;">{{ $data->fuel }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">FT1 Capac (Gal): <span style="font-weight: 400; float: right;">{{ $data->ft1 }}</span></p></td></tr>
						</table>
					</td>
					<td style="vertical-align: baseline; width: 50%;">
						<table style="border: 1px solid gray; border-spacing: 1px;width:100%">
							<tr><th style="background-color: #ccc;border: 1px solid gray;font-weight: 700; padding: 5px; text-align: left;">Exterior Options A</th></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Air Horns: <span style="font-weight: 400; float: right;">@if($data->air_horns == 0)
            No
@else
    Yes
@endif
</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Mirrors: <span style="font-weight: 400; float: right;">{{ $data->mirrors }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Exterior Color: <span style="font-weight: 400; float: right;">{{ $data->exterior_color }}</span></p></td></tr>
						</table>
						<table style="border: 1px solid gray; border-spacing: 1px;width:100%">
							<tr><th style="background-color: #ccc;border: 1px solid gray;font-weight: 700; padding: 5px; text-align: left;">Overall Condition</th></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Overall Length: <span style="font-weight: 400; float: right;">{{ $data->ov_length }}"</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Overall Height: <span style="font-weight: 400; float: right;">{{ $data->ov_height }}"</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Overall Width: <span style="font-weight: 400; float: right;">{{ $data->ov_width }}"</span></p></td></tr>
						</table>
						<table style="border: 1px solid gray; border-spacing: 1px;width:100%">
							<tr><th style="background-color: #ccc;border: 1px solid gray;font-weight: 700; padding: 5px; text-align: left;">Axle / Susp Options</th></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">WheelBase (In): <span style="font-weight: 400; float: right;">{{ $data->wheelbase }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Rear Ratio: <span style="font-weight: 400; float: right;">{{ $data->rear_ratio }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">F Axle (lbs): <span style="font-weight: 400; float: right;">{{ $data->f_axle }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">R Axle (lbs): <span style="font-weight: 400; float: right;">{{ $data->r_axle }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">GVWR (lbs): <span style="font-weight: 400; float: right;">{{ $data->gvwr }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Suspension: <span style="font-weight: 400; float: right;">{{ $data->suspension }}</span></p></td></tr>
						</table>
					</td>
				</tr>
			</table>
            <table style="font-size:12px; margin-top: 10px; width: 100%;">
                <tr>
                    <td style="width: 50%; vertical-align: baseline;">
						<table style="border: 1px solid gray; border-spacing: 1px;width:100%">
							<tr><th style="background-color: #ccc;border: 1px solid gray;font-weight: 700; padding: 5px; text-align: left;">Transmission Options</th></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Trans Make: <span style="font-weight: 400; float: right;">{{ $data->trans_make }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Trans Model: <span style="font-weight: 400; float: right;">{{ $data->trans_model }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Trans Speed: <span style="font-weight: 400; float: right;">{{ $data->trans_speed ?? 'NA' }}</span></p></td></tr>
						</table>
						<table style="border: 1px solid gray; border-spacing: 1px;width:100%">
							<tr><th style="background-color: #ccc;border: 1px solid gray;font-weight: 700; padding: 5px; text-align: left;">Brakes Options</th></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">ABS: <span style="font-weight: 400; float: right;">{{ $data->extras->abs == 1 ? 'YES' : 'NO' }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">HYD: <span style="font-weight: 400; float: right;">{{ $data->extras->hyd == 1 ? 'YES' : 'NO' }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">AIR: <span style="font-weight: 400; float: right;">{{ $data->extras->air == 1 ? 'YES' : 'NO' }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">DISK: <span style="font-weight: 400; float: right;">{{ $data->extras->disk == 1 ? 'YES' : 'NO' }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">DRUM: <span style="font-weight: 400; float: right;">{{ $data->extras->drum == 1 ? 'YES' : 'NO' }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Break Plates: <span style="font-weight: 400; float: right;">{{ $data->extras->break_plates }}</span></p></td></tr>
						</table>
						<table style="border: 1px solid gray; border-spacing: 1px;width:100%">
							<tr><th style="background-color: #ccc;border: 1px solid gray;font-weight: 700; padding: 5px; text-align: left;">Tires [Front]</th></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Size: <span style="font-weight: 400; float: right;">{{ $data->extras->tyre_size_f }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Wheels: <span style="font-weight: 400; float: right;">{{ $data->extras->wheels }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Brand: <span style="font-weight: 400; float: right;">{{ $data->extras->detail_f }}</span></p></td></tr>
						</table>
						<table style="border: 1px solid gray; border-spacing: 1px;width:100%">
							<tr><th style="background-color: #ccc;border: 1px solid gray;font-weight: 700; padding: 5px; text-align: left;">Tires [Rear]</th></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Size <span style="font-weight: 400; float: right;">{{ $data->extras->tyre_size_r }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Wheels: <span style="font-weight: 400; float: right;">{{ $data->extras->wheels }}</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Brand: <span style="font-weight: 400; float: right;">{{ $data->extras->detail_r }}</span></p></td></tr>
						</table>
						<table style="border: 1px solid gray; border-spacing: 1px;width:100%">
							<tr><th style="background-color: #ccc;border: 1px solid gray;font-weight: 700; padding: 5px; text-align: left;">Brakes</th></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Steer Axle Brakes: <span style="font-weight: 400; float: right;">{{ $data->inspectionTyre->steer_brake_left ? $data->inspectionTyre->steer_brake_left : 'NA' }}% {{ $data->inspectionTyre->steer_brake_right ? $data->inspectionTyre->steer_brake_right : 'NA' }}% (1)</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Drive Axle Brakes: <span style="font-weight: 400; float: right;">{{ $data->inspectionTyre->drive_axle_brake_left ? $data->inspectionTyre->drive_axle_brake_left : 'NA'  }}% {{ $data->inspectionTyre->drive_axle_brake_right ? $data->inspectionTyre->drive_axle_brake_right : 'NA' }}% (2)</span></p></td></tr>
							<tr><td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;"> &nbsp;<span style="font-weight: 400; float: right;">(3)</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;"> &nbsp;<span style="font-weight: 400; float: right;">(4)</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;"> &nbsp;<span style="font-weight: 400; float: right;">(5)</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;"> &nbsp;<span style="font-weight: 400; float: right;">(6)</span></p></td></tr>
						</table>
					</td>
                    <td style="width: 50%;vertical-align: baseline;">
						<table style="border: 1px solid gray; border-spacing: 1px;width:100%">
							<tr> <th style="background-color: #ccc;border: 1px solid gray;font-weight: 700; padding: 5px; text-align: left;">Miscellaneous</th></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Seating Capacity: <span style="font-weight: 400; float: right;">{{ $data->misslenous->seating_capacity ? $data->misslenous->seating_capacity : 'NA' }}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Electronic Engine Controls: <span style="font-weight: 400; float: right;">{{$data->misslenous->elect_eng_control? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Full Gauge Package: <span style="font-weight: 400; float: right;">{{$data->misslenous->full_gause? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Wraparound Dash: <span style="font-weight: 400; float: right;">{{$data->misslenous->wraparound? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Power Mirrors: <span style="font-weight: 400; float: right;">{{$data->misslenous->power_mirror? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Tilt / Telescopic Steering Wheel: <span style="font-weight: 400; float: right;">{{$data->misslenous->tilt? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">AirRide Driver's Seat: <span style="font-weight: 400; float: right;">{{$data->misslenous->air_ride? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Restroom: <span style="font-weight: 400; float: right;">{{$data->misslenous->restroom? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">PA System: <span style="font-weight: 400; float: right;">{{$data->misslenous->pa_syst? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Audio - Video System: <span style="font-weight: 400; float: right;">{{$data->misslenous->aud_vid_syst? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Number of Video Monitors: <span style="font-weight: 400; float: right;">{{$data->misslenous->video_m_no? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Multi-Disc CD Changer:: <span style="font-weight: 400; float: right;">{{$data->misslenous->cd_charger? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Individual multi-Channel Audio System: <span style="font-weight: 400; float: right;">{{$data->misslenous->ind_aud_syst? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Global Positioning System: <span style="font-weight: 400; float: right;">{{$data->misslenous->gps? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">In Motion Satellite TV System: <span style="font-weight: 400; float: right;">{{$data->misslenous->satelite_tv_syst? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Road Viewing Monitor System: <span style="font-weight: 400; float: right;">{{$data->misslenous->road_viewing_m_syst? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Wheelchair Lift: <span style="font-weight: 400; float: right;"></span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Underfloor Storage with Lift: <span style="font-weight: 400; float: right;">{{$data->misslenous->under_floor? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Parcel Rack Storage with Lift: <span style="font-weight: 400; float: right;">{{$data->misslenous->parcel_rack? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Traction Control: <span style="font-weight: 400; float: right;">{{$data->misslenous->tracon_control? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Power Windshield Sun Visors: <span style="font-weight: 400; float: right;">{{$data->misslenous->sun_visors? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Tour Guide Seat <span style="font-weight: 400; float: right;">{{$data->misslenous->tour_guide_seat? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Other: <span style="font-weight: 400; float: right;">{{$data->misslenous->other? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Was Unit driven In ?: <span style="font-weight: 400; float: right;">{{$data->misslenous->unit_driven_in? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Did Unit need to be jump started ?:  <span style="font-weight: 400; float: right;">{{$data->misslenous->jump_started? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Was Unit towed in ?:   <span style="font-weight: 400; float: right;">{{$data->misslenous->unit_tower_in? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Did Unit start and run ?:   <span style="font-weight: 400; float: right;">{{$data->misslenous->unit_start_run? 'Yes': 'No'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Unit Condition:    <span style="font-weight: 400; float: right;">{{$data->misslenous->unit_condition ? $data->misslenous->unit_condition : 'NA'}}</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">If Unit is not driveable or will not start, Explain:    <span style="font-weight: 400; float: right;">&nbsp;</span></p></td></tr>
							<tr> <td style="border: 1px solid gray; font-weight: 700; padding: 5px; text-align: left;"><p style="padding: 0; margin: 0;">Any extra options or features not listed on front page and any additional comments:    <span style="font-weight: 400; float: right;">{{$data->misslenous->not_listend_comment ? $data->misslenous->not_listend_comment : 'NA'}}</span></p></td></tr>
						</table>
					</td>
				</tr>
			</table>
			@if($data->inspectionTyre->no_of_axle <= 4)
			<table style="width:100%">
				<tr style="width: 100%;vertical-align: baseline;">
					<td style="width:100%;vertical-align: baseline;">
						<table style="width:100%;border:1px solid gray;">
							<tr>
								<td style="border: 1px solid gray;font-size:12px;" colspan="2">STEER AXLE</td>
								@for($i = 1; $i < $data->inspectionTyre->no_of_axle; $i++)
									<td style="border: 1px solid gray;font-size:12px;">DRIVE AXLE #{{$i}}</td>
								@endfor
							</tr>
							<tr>
								<td style="border: 1px solid gray;font-size:12px;">RIGHT</td>
								<td style="font-size:12px;">{{$data->inspectionTyre->axl1}}<br><img src="https://codewithmithlesh.com/public/tiryer.png" alt="" /></td>
								@for($i = 1; $i < $data->inspectionTyre->no_of_axle; $i++)
									@php
									$key = $i+1;
									$key = 'axr'.$key;
									@endphp
									<td style="font-size:12px;">@php echo  $data->inspectionTyre->{$key}; @endphp<br><img src="https://codewithmithlesh.com/public/tiryer.png" alt="" /><br><img src="https://codewithmithlesh.com/public/tiryer.png" alt="" /><br>@php echo  $data->inspectionTyre->{$key}; @endphp</td>
									@endfor
							</tr>
							<tr>
								<td colspan="{{$data->inspectionTyre->no_of_axle + 2}}" style="padding-top:25px;padding-bottom:25px;width:100%">
									<table style="width:100%">
										<tr>
											<td style="width:10%;font-size:12px;">FRONT</td>
											<td style="width:90%"><hr></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid gray;font-size:12px;">LEFT</td>
								<td style="font-size:12px;"><img src="https://codewithmithlesh.com/public/tiryer.png" alt="" /><br>{{$data->inspectionTyre->axr1}}</td>
								@for($i = 1; $i < $data->inspectionTyre->no_of_axle; $i++)
									@php
									$key = $i+1;
									$key = 'axl'.$key;
									@endphp
								<td style="font-size:12px;">@php echo $data->inspectionTyre->{$key}; @endphp<br><img src="https://codewithmithlesh.com/public/tiryer.png" alt="" /><br><img src="https://codewithmithlesh.com/public/tiryer.png" alt="" /><br>@php echo $data->inspectionTyre->{$key}; @endphp</td>
								@endfor
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<table style="width:100%">
				<tr style="width: 100%;vertical-align: baseline;">
					<td style="width: 33%;vertical-align: baseline;">
						<table style="width:100%;border:1px solid gray;">
							<tr> <td style="border: 1px solid gray;text-align:center;"><p style="font-size: 12px; margin-top: 10px;">Brake Legend</p><h5 style="font-size: 10px;margin: 2px;">BD = DRUM HAS MORE THAN 1/16 INCH LIP</h5><h5 style="font-size: 10px;margin: 2px;">CL = CRACKED LINING</h5><h5 style="font-size: 10px;margin: 2px;">LS = LEAKING SEAL(S)</h5></td></tr>
						</table>
					</td>
					<td style="width: 33%;vertical-align: baseline;">
						<table style="width:100%;border:1px solid gray;">
							<tr> <td style="border: 1px solid gray;text-align:center;"><p style="font-size: 12px; margin-top: 20px;">Tire Legend</p><h5 style="font-size: 10px;margin: 2px;">C = CUT D = DRY ROT F = FLAT</h5><h5 style="font-size: 10px;margin: 2px;">M = MISMATCHED TIRES/CASING</h5><h5 style="font-size: 10px;margin: 2px;">MA = MISMATCHED AXLES (FRONT vs. REAR)</h5><h5 style="font-size: 10px;margin: 2px;">V = VIRGIN W = IRREGULAR WEAR</h5><h5 style="font-size: 10px;margin: 2px;">R = RECAP: 1 = ONCE, 2 = TWICE, 3 = 3 TIMES</h5></td></tr>
						</table>
					</td>
					<td style="width: 33%;vertical-align: baseline;">
						<table style="width:100%;border:1px solid gray;">
							<tr> <td style="border: 1px solid gray;text-align:center;"><p style="font-size: 12px; margin-top: 20px;">Tread Legend</p><h5 style="font-size: 10px;margin: 2px;padding-bottom:20px;">H = HIGHWAY L = LUG</h5></td></tr>
						</table>
					</td>
				</tr>
			</table>

			@endif
			@if($data->inspectionTyre->no_of_axle > 4)
			<table style="font-size:12px; margin-top: 10px; width: 100%;">
				<tr>
					<td style="border: 1px solid gray;font-size:13px;" colspan="2">STEER AXLE</td>
						@for($i = 1; $i < $data->inspectionTyre->no_of_axle; $i++)
					<td style="border: 1px solid gray;font-size:13px;">DRIVE AXLE #{{$i}}</td>
						@endfor
				</tr>
				<tr>
					<td style="border: 1px solid gray;font-size:13px;">RIGHT</td>
					<td style="font-size:13px;">{{$data->inspectionTyre->axl1}}<br><img src="https://codewithmithlesh.com/public/tiryer.png" alt="" /></td>
						@for($i = 1; $i < $data->inspectionTyre->no_of_axle; $i++)
						@php
						$key = $i+1;
						$key = 'axr'.$key;
						@endphp
					<td style="font-size:13px;">@php echo  $data->inspectionTyre->{$key}; @endphp<br><img src="https://codewithmithlesh.com/public/tiryer.png" alt="" /><br><img src="https://codewithmithlesh.com/public/tiryer.png" alt="" /><br>@php echo  $data->inspectionTyre->{$key}; @endphp</td>
						@endfor
				</tr>
				<tr>
					<td colspan="{{$data->inspectionTyre->no_of_axle + 2}}" style="padding-top:25px;padding-bottom:25px;width:100%">
						<table style="width:100%">
							<tr>
								<td style="width:10%;font-size:13px;">FRONT</td>
								<td style="width:90%"><hr></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td style="border: 1px solid gray;font-size:13px;">LEFT</td>
					<td style="font-size:13px;"><img src="https://codewithmithlesh.com/public/tiryer.png" alt="" /><br>{{$data->inspectionTyre->axr1}}</td>
					@for($i = 1; $i < $data->inspectionTyre->no_of_axle; $i++)
						@php
						$key = $i+1;
						$key = 'axl'.$key;
						@endphp
						<td style="font-size:13px;">@php echo  $data->inspectionTyre->{$key}; @endphp<br><img src="https://codewithmithlesh.com/public/tiryer.png" alt="" /><br><img src="https://codewithmithlesh.com/public/tiryer.png" alt="" /><br>@php echo $data->inspectionTyre->{$key}; @endphp</td>
						@endfor
				</tr>
			</table>
			<!--<table style="width:100%">-->
			<!--	<tr>-->
			<!--		<td style="vertical-align: baseline;">-->
			<!--			<table style="width:100%">-->
			<!--				<tr> <td style="border: 1px solid gray;text-align:center;min-height:300px;"><p style="font-size: 12px; margin-top: 10px;">Brake Legend</p><h5 style="font-size: 10px;margin: 2px;">BD = DRUM HAS MORE THAN 1/16 INCH LIP</h5><h5 style="font-size: 10px;margin: 2px;">CL = CRACKED LINING</h5><h5 style="font-size: 10px;margin: 2px;">LS = LEAKING SEAL(S)</h5></td></tr>-->
			<!--			</table>-->
			<!--		</td>-->
			<!--		<td style="vertical-align: baseline;">-->
			<!--			<table style="width:100%">-->
			<!--				<tr> <td style="border: 1px solid gray;text-align:center;min-height:300px;"><p style="font-size: 12px; margin-top: 20px;">Tire Legend</p><h5 style="font-size: 10px;margin: 2px;">C = CUT D = DRY ROT F = FLAT</h5><h5 style="font-size: 10px;margin: 2px;">M = MISMATCHED TIRES/CASING</h5><h5 style="font-size: 10px;margin: 2px;">MA = MISMATCHED AXLES (FRONT vs. REAR)</h5><h5 style="font-size: 10px;margin: 2px;">V = VIRGIN W = IRREGULAR WEAR</h5><h5 style="font-size: 10px;margin: 2px;">R = RECAP: 1 = ONCE, 2 = TWICE, 3 = 3 TIMES</h5></td></tr>-->
			<!--			</table>-->
			<!--		</td>	-->
			<!--		<td style="vertical-align: baseline;">-->
			<!--			<table style="width:100%">-->
			<!--				<tr> <td style="border: 1px solid gray;text-align:center;min-height:300px;"><p style="font-size: 12px; margin-top: 20px;">Tread Legend</p><h5 style="font-size: 10px;margin: 2px;padding-bottom:20px;">H = HIGHWAY L = LUG</h5></td></tr>-->
			<!--			</table>-->
			<!--		</td>	-->
			<!--	</tr>-->
			<!--</table>			-->
			@endif
			<section class="condition" style="border: 1px solid gray; padding: 0 5%;border-radius: 5px; margin: 5px 0; width: 90%">
				<div class="condition_container">
					<p style="font-size: 18px;font-weight: 700;text-align: center; text-transform: uppercase;">Condition Report</p>
				</div>
			</section>
			{{-- COMMENTS SECTION START HERE --}}
			<section class="comments_enginer_area mt-10" style=" margin-top: 10px;">
				<div class="comments_enginer_area_container">
					<table style="width:100%;border:1px solid gray;">
						<tr>
							<th style="background-color: #ccc; border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;"></th>
							<th style="background-color: #ccc; border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">Engine Compartment Area</th>
							<th style="background-color: #ccc; border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">Comments</th>
						</tr>
						@foreach($data->conditions as $condition)
						<tr>
							<td style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">{{$condition->status}}</td>
							<td style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">{{$condition->condition_name}}</td>
							<td style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">{{$condition->condition_comments}}</td>
						</tr>
						@endforeach
					</table>
				</div>
			</section>
			{{-- COMMENTS SECTION END HERE --}}
			<section class="comments_enginer_area mt-10" style=" margin-top: 10px;">
				<div class="comments_enginer_area_container">
					<table style="width:100%;border:1px solid gray;">
						<tr>
							<th style="background-color: #ccc; border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;"></th>
							<th style="background-color: #ccc; border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">Operational Test</th>
							<th style="background-color: #ccc; border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">Comments</th>
						</tr>
						@foreach($data->operational as $item)
						<tr>
							<td style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">{{ $item->status }}</td>
							<td style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">{{ $item->condition_name }}</td>
							<td style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">{{ $item->condition_comments }}</td>
						</tr>
						@endforeach
					</table>
				</div>
			</section>
			<section class="comments_enginer_area mt-10" style=" margin-top: 10px;">
				<div class="comments_enginer_area_container">
					<table style="width:100%;border:1px solid gray;">
						<tr>
							<th style="background-color: #ccc; border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;"></th>
							<th style="background-color: #ccc; border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">In Cab Inspection</th>
							<th style="background-color: #ccc; border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">Comments</th>
						</tr>
						@foreach ($data->incabInspectionTest as $item_in_cab )
						<tr>
							<td style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">{{$item_in_cab->status  }}</td>
							<td style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">{{$item_in_cab->condition_name  }}</td>
							<td style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">{{$item_in_cab->condition_comments  }}</td>
						</tr>
						@endforeach
					</table>
				</div>
			</section>
			</br>
			<section class="comments_enginer_area mt-10" style=" margin-top: 10px;">
				<div class="comments_enginer_area_container">
					<table style="width:100%;border:1px solid gray;">
						<tr>
							<th style="background-color: #ccc; border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;"></th>
							<th style="background-color: #ccc; border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">Outside Inspection</th>
							<th style="background-color: #ccc; border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">Comments</th>
						</tr>
						@foreach ($data->outsideInspection as $inspectionOut)
						<tr>
							<td style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">{{ $inspectionOut->status }}</td>
							<td style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">{{ $inspectionOut->condition_name }}</td>
							<td style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">{{ $inspectionOut->condition_comments }}</td>
						</tr>
						@endforeach
					</table>
				</div>
			</section>
			<section class="comments_enginer_area mt-10" style=" margin-top: 10px;">
				<div class="comments_enginer_area_container">
					<table style="width:100%;border:1px solid gray;">
						<tr>
							<th style="background-color: #ccc; border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;"></th>
							<th style="background-color: #ccc; border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">Under Vehicle Inspection</th>
							<th style="background-color: #ccc; border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">Comments</th>
						</tr>
						@foreach ($data->underInspection as $underInspection)
						<tr>
							<td style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">{{ $underInspection->status }}</td>
							<td style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">{{ $underInspection->condition_name }}</td>
							<td style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">{{ $underInspection->condition_comments }}</td>
						</tr>
						@endforeach
					</table>
				</div>
			</section>
			<section class="comments_enginer_area mt-10" style=" margin-top: 10px;">
				<div class="comments_enginer_area_container">
					<table style="width:100%;border:1px solid gray;">
						<tr>
							<th style="background-color: #ccc; border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;"></th>
							<th style="background-color: #ccc; border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">Tires/Wheels/Brakes</th>
							<th style="background-color: #ccc; border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">Comments</th>
						</tr>
						@foreach ($data->tyreInspectionTest as $tyreIns )
						<tr>
							<td style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">{{ $tyreIns->status }}</td>
							<td style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">{{ $tyreIns->condition_name }}</td>
							<td style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">{{ $tyreIns->condition_comments }}</td>
						</tr>
						@endforeach
					</table>
				</div>
			</section>
			<section class="comments_enginer_area mt-10" style=" margin-top: 10px;">
				<div class="comments_enginer_area_container">
					<table style="width:100%;border:1px solid gray;">
						<tr>
							<th style="background-color: #ccc; border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">Additional Services </th>
							<th style="background-color: #ccc; border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">Requested</th>
							<th style="background-color: #ccc; border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">Status</th>
							<th style="background-color: #ccc; border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">Comments</th>
						</tr>
					</table>
				</div>
			</section>
			@if(sizeof($data->estimates) > 0)
			<section class="worksheet mt-10" style="border: 1px solid gray; padding: 0 4%;border-radius: 5px; margin: 5px 0 0 0; width: 90%">
				<div class="worksheet_container">
					<p style="font-size: 18px;font-weight: 700;text-align: center; text-transform: uppercase;">RECONDITIONING AND SUPPLEMENTAL ESTIMATE</p>
				</div>
			</section>
			<section class="recommendation mt-10" style=" margin-top: 10px;">
				<table style=" width:100%;border:1px solid gray;">
					<thead>
						<tr>
							<td  style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 10px;">ITEM</td>
							<td  style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 10px;">DESCRIPTION / COMMENTS </td>
							<td  style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 10px;">PART COST ($) </td>
							<td  style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 10px;">LABOR </td>
						</tr>
					</thead>
					<tbody>
						@php
						$t_part = 0;
						$t_laber = 0;
						@endphp
						@foreach($data->estimates as $estimate)
						@php
						$t_part = $t_part + $estimate->item_cost;
						$t_laber = $t_laber + $estimate->labor_cost;
						@endphp
						<tr>
							<td  style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 10px;">{{$estimate->item_name}}</td>
							<td  style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 10px;">{{$estimate->desciption}}</td>
							<td  style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 10px;">{{$estimate->item_cost}}</td>
							<td  style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 10px;">{{$estimate->labor_cost}} </td>
						</tr>
						@endforeach
						<tr>
							<td colspan="2"  style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 10px;">
								<h3>TOTAL ESTIMATE </h3>
							</td>
							<td  style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 10px;">{{$t_part}}</td>
							<td  style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 10px;">{{$t_laber}}</td>
						</tr>
						<tr>
							<td colspan="3"  style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 10px;">
								<h3>TOTAL (PARTS + LABOR) </h3>
							</td>
							<td  style="border: 1px solid gray; text-align: left;padding: 5px;font-size: 12px;">{{$t_part + $t_laber}}</td>
						</tr>
					</tbody>
				</table>
			</section>
			@endif
			{{-- RECOMMENDATION SECTION END HERE --}}
			{{-- SPECIFICATION WORKSHEET START HERE --}}
			<section class="worksheet mt-10" style=" margin-top: 10px;">
				<div class="worksheet_container">
					<p style="font-weight: 700;">COMMENTS:</p>
				</div>
			</section>
			{{-- SPECIFICATION WORKSHEET START END --}}
			{{-- IMAGE BOX CONTAINER --}}
			@if(sizeof($data->conditions) > 0)
			<section class="section_image mt-10" style=" margin-top: 10px;">
				<div class="image_container" style="display: block; justify-content: center;">
					<div class="grid col-lg-3 gap3" style=" display: inline-block;width:100%">
						@foreach($data->conditions as $condition)
						<div style=" text-align: center; border: 1px solid gray; margin: 0 5px;width:18%;float:left">
							<img src="{{$condition->inspection_img}}" alt="Placeholder Image 1" style="max-width:140px;width: 100%;  height: auto;">
							<p style="margin: 0; padding: 5px 0;">{{$condition->condition_name}}</p>
						</div>
						@endforeach
					</div>
				</div>
			</section>
			@endif
			{{-- IMAGE BOX CONTAINER END HERE --}}

		    <!--DISCLAIMER SECTION START HERE-->
		    <section class="disclaimer_container mt-10" style=" margin-top: 10px;">
		        <div class="" style="margin-top: 30px;">
		            <h4 style="font-size: 12px;">Disclaimer :  <span>This is an inspection that is completed by a contracted agency IRON RESOURCE INC. dba WORKIRON REPORT and represents a visual inspection of this equipment or property. The agency is not responsible for hidden damages or mechanical failures in the future of this equipment as this is a visual inspection. This inspection is completed without any warranty from the inspection. Whether it be "Expressed or Implied" This inspection report will follow with illustrations of the equipment and the written form of what we are able to visually inspect. By accepting this inspection or estimate you are agreeing to indemnify, defend, save, and hold harmless the providing company of this repair/estimate, its agents, and employees from all liabilities, charges, expenses, and costs on account of or by reason of any such injuries, deaths, liabilities, claims, suits or losses however occurring or damages growing out of the same.</span> </h4>
		        </div>
		    </section>
		    <!--DISCLAIMER SECTION END HERE-->
		</div>
	</body>
</html>
