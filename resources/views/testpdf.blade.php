<!doctype html>
<html>


	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

		<title>{{ config('app.name', 'Vehicle Inspection') }}</title>

		<!-- <style>
			.container {
            width: 100%
			}

			.header {
            width: 100%;
            justify-content: space-around;
            border: 1px solid gray;
            padding: 5px;
            border-radius: 5px;
			}

			.flex {
            display: flex;
			}

			.container {
            max-width: 960px;
            /* Adjust as needed */
            margin: 0 auto;
			}

			.logo_container {
            width: 35%;
			}

			.logo_container p {
            font-weight: 1000;
            text-transform: capitalize;
            font-size: 17px;
			}

			.client_information {
            width: 100%;
            border-left: 2px solid gainsboro;
            padding-left: 15px;
			}

			.vehicle_information {
            width: 30%;

			}

			.inspector_id {
            font-size: 15px;
            font-weight: 600;
			}

			.inspector_id span {
            font-weight: 100;
			}

			.inspection_id {
            font-size: 10px;
            margin-left: 10px;
			}

			.lower_information_content {
            margin-top: 10px;
			}

			.lower_information_content div {
            margin-right: 5px;
            border-left: 2px solid gainsboro;
            padding: 5px;
			}

			.lower_information_content div:first-child {
            border-left: none;
			}

			.lower_information_content div p {
            font-size: 10px;
			}

			.year {
            width: 100%;
            margin-top: 5px;
            padding: 5px;
            border-left: 2px solid gainsboro;

            border-right: 2px solid gainsboro;

            border-bottom: 2px solid gainsboro;
			}

			.year_container {
            display: flex;
            justify-content: space-between;
			}

			.year_container div {
            flex: 1;
            padding: 10px;
			}

			.year_container p {
            margin: 0;
            margin-top: 5px;
            font-size: 10px;
			}

			.year_container p span {
            float: right;
			}

			.worksheet {
            width: 100%;
            padding: 5px;
            border: 2px solid gainsboro;
            margin-top: 10px;
            border-radius: 10px;
			}

			.worksheet p {
            font-size: 10px;
			}

			.steering_interior {
            width: 100%;
            margin-top: 10px;
			}

			.steering_interior>div {
            margin-right: 5px;
			}

			.steering_interior .flex {
            display: flex;
			}

			.steering_interior .container table {
            width: 100%;
            border-collapse: collapse;
			}

			.steering_interior .container table th {
            background-color: rgb(202, 30, 30);
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 8px;
			}

			.steering_interior .container table td {
            padding: 8px;
            border-bottom: 1px solid gainsboro;
            text-align: left;
			}

			.steering_interior .container table tr:last-child td {
            border-bottom: none;
			}


			.engine_section_a_container,
			.engine_section_b_container {
            margin-top: 10px;
			}

			.engine_section_a_container>div {
            flex: 1;
            width: 50%;
            border: 1px solid gainsboro;
			}

			.engine_section_a_container>div h4 {
            padding-left: 5px;
            font-size: 14px;
			}

			.engine_section_b_container>div {
            flex: 1;
            width: 50%;

			}

			.engine_section_b_container .left_enginer_container>div {
            border: 1px solid gainsboro;
            margin-top: 10px;
			}

			.Miscellaneous_container {
            border: 1px solid gainsboro;
            margin-top: 10px;
			}

			.engine_section_b_container .left .engine_section_a_container>div h4,
			.engine_section_b_container>div h4 {
            padding-left: 5px;
            font-size: 14px;
			}

			.options {
            padding: 10px;
            border-radius: 5px;
			}

			.options p {
            margin: 0;
            margin-bottom: 5px;
            font-size: 12px;
			}

			.options p span {
            float: right;
			}

			.options table tr {
            border-bottom: 1px solid rgb(202, 30, 30);
			}

			.options table td {
            display: block;
			}

			.options table tr:last-child {
            border-bottom: none;
			}

			.transmission {
            margin-top: 10px;
			}

			.left_box_container {
            width: 100%;
			}

			.left_box_container>div {
            border: 1px solid gainsboro;
            padding-left: 5px;
			}

			.left_box_container>div h4 {
            font-size: 14px;

			}

			.right_box_container {
            width: 100%;
            border: 1px solid gainsboro;
            padding: 10px;
            border-radius: 5px;
			}

			.right_box_container h4 {
            margin-top: 0;
            font-size: 14px;
			}

			.right_box_container table {
            width: 100%;
            border-collapse: collapse;
			}

			.right_box_container th,
			.right_box_container td {
            padding: 8px;
            border-bottom: 1px solid gainsboro;
            text-align: left;
            font-size: 12px;
			}

			.right_box_container th {
            font-weight: bold;
            width: 40%;

			}

			.right_box_container td {
            display: flex;
            align-items: center;
            width: 60%;
			}

			.right_box_container td span {
            flex-grow: 1;
			}

			.tyre_container {
            margin-top: 10px;
			}

			.tyre_flex_container>div {
            border: 1px solid gainsboro;
            text-align: center;
            padding: 10px;
            line-height: 1.2%;
			}

			.tyre_flex_container>div h5 {
            font-size: 10px;
			}

			.tyre_flex_container>div p {
            font-size: 12px;
            margin-top: 10px;
			}

			.condition_container {
            margin-top: 10px;
            border: 1px solid gainsboro;
            font-size: 10px;
            padding-left: 5px;
            border-radius: 10px;
			}

			.mt-10 {
            margin-top: 10px;
			}

			table {
            border-collapse: collapse;
            width: 100%;
			}

			td,
			th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 5px;
            font-size: 12px;
			}

			.image_container {
            display: flex;
            justify-content: center;
			}

			.grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);

            gap: 4px;

			}

			.grid>div {
            text-align: center;
            border: 1px solid #dddddd;
            margin-bottom: 10px;
			}

			.grid img {
            width: 100%;

            height: auto;

			}

			.grid p {
            margin: 0;
			}
		</style> -->

	</head>

	<body>
		<div style="max-width: 960px;margin: 0 auto;">
			{{-- HEADER START HERE --}}
			<section class="header flex" style="width: 100%; justify-content: space-around; border: 1px solid gray; padding: 5px;border-radius: 5px;display:inline-block;">
				<div class="logo_container " style="width: 35%;float:left">
					<img src="{{ asset('pdflogo.png') }}" alt="Vehicle Inspections"/>

					<p style="font-weight: 1000;text-transform: capitalize; font-size: 17px;">Dekra Services. INC</p>
					<p style="font-weight: 1000;text-transform: capitalize; font-size: 17px;">Customer Service 770-257-0107</p>
				</div>
				<div class="client_information flex" style="justify-content: space-between;width: 65%; border-left: 2px solid gainsboro; padding-left: 15px;float:left">
					<div class="client_information_content">
						<div class="upper_information_content">
							<p>BUS</p>
							<span>CLIENT</span>
							<span>397 - A F OHAB</span>
						</div>
						<div class="lower_information_content flex" style="display:flex;margin-top: 10px;">
							<div class="insp_date" style=" margin-right: 5px;border-left: 2px solid gainsboro; padding: 5px; border-left: none;">
								<p style="font-size: 10px;">INSP DATE</p>
								<span>{{ $data->inspection_date }}</span>
							</div>
							<div class="fleet_name" style=" margin-right: 5px;border-left: 2px solid gainsboro; padding: 5px;">
								<p style="font-size: 10px;">FLEET NAME</p>
								<span>{{ $data->fleet_no }}</span>
							</div>
							<div class="unit_number" style=" margin-right: 5px;border-left: 2px solid gainsboro; padding: 5px;">
								<p style="font-size: 10px;">UNIT NUMBER</p>
								<span>{{ $data->unit_number }}</span>
							</div>
							<div class="vin_last" style=" margin-right: 5px;border-left: 2px solid gainsboro; padding: 5px;">
								<p style="font-size: 10px;">VIN (LAST 8)</p>
								<span>{{ $data->vin_no }}</span>
							</div>
							<div class="vin_last" style=" margin-right: 5px;border-left: 2px solid gainsboro; padding: 5px;">
								<p style="font-size: 10px;">PO NUMBER</p>
								<span>{{ $data->po_no }}</span>
							</div>
						</div>
					</div>
					<div class="vehicle_information" style=" width: 30%;">
						<p class="inspector_id" style="font-size: 15px; font-weight: 600;">INSPECTOR: <span class="" style=" font-weight: 100;">{{ $data->inspector_name }}</span> </p>
						<span class="inspection_id" style=" font-size: 10px;margin-left: 10px;">INSPECTION ID: <span>{{ $data->id }}</span> </span>
					</div>
				</div>
			</section>
			{{-- HEADER END HERE --}}

			{{-- YEAR SECTION START HERE --}}
			<section class="year" style="  width: 100%;margin-top: 5px; padding: 5px;border-left: 2px solid gainsboro; border-right: 2px solid gainsboro;border-bottom: 2px solid gainsboro;">
				<div class="flex year_container" style="justify-content: space-between; display: flex;justify-content: space-between;">
					<div style="flex: 1;padding: 10px;">
						<p style=" margin: 0;margin-top: 5px;">YEAR <span style="float: right;">{{ $data->model_year }}</span></p>
						<p style=" margin: 0;margin-top: 5px;">MODEL <span style="float: right;">{{ $data->model_year }}</span></p>
					</div>
					<div style="flex: 1;padding: 10px;">
						<p style=" margin: 0;margin-top: 5px;">MAKE <span style="float: right;">{{ $data->model_make }}</span></p>
						<p style=" margin: 0;margin-top: 5px;">VIN <span style="float: right;">{{ $data->vin_no }}</span></p>
					</div>
				</div>
			</section>
			{{-- YEAR SECTION END HERE --}}

			{{-- SPECIFICATION WORKSHEET START HERE --}}
			<section class="worksheet" style="  width: 100%; padding: 5px;  border: 2px solid gainsboro; margin-top: 10px;border-radius: 10px;">
				<div class="worksheet_container">
					<p style="font-size: 10px;">SPECIFICATION WORKSHEET</p>
				</div>
			</section>
			{{-- SPECIFICATION WORKSHEET START END --}}

			{{-- INTERIOR OPTION AND STEERING OPTION CONTAINER START HERE --}}
			<section class="steering_interior" style=" width: 100%;margin-top: 10px;">
				<div class="flex" style="justify-content: space-between; margin-right: 5px; display: flex;">
					<div class="container" style=" margin-right: 5px;">
						<table style=" width: 100%;border-collapse: collapse;">
							<tr>
								<th colspan="2" style=" background-color: rgb(202, 30, 30);color: white;font-weight: bold; text-align: center; padding: 8px;">Interior Options</th>
							</tr>
							<tr>
								<td style="  padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;border-bottom: none;">Interior Color:</td>
								<td style="  padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;border-bottom: none;">{{ $data->interior_color }}</td>
							</tr>
						</table>
					</div>
					<div class="container" style=" margin-right: 5px;">
						<table style=" width: 100%;border-collapse: collapse;">
							<tr>
								<th colspan="2" style=" background-color: rgb(202, 30, 30);color: white;font-weight: bold; text-align: center; padding: 8px;">Steering Options</th>
							</tr>
							<tr>
								<td style="  padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;border-bottom: none;">Power Steering?:</td>
								<td style="  padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;border-bottom: none;">{{ $data->powr_steering }}</td>
							</tr>
						</table>
					</div>
				</div>
			</section>

			{{-- INTERIOR OPTION AND STEERING OPTION CONTAINER END HERE --}}

			{{-- ENGINE SECTION A START HERE --}}

			<section class="engine_seaction_a">
				<div class="engine_section_a_container flex" style="justify-content: space-between;margin-top: 10px;display: flex;">
					<div style=" flex: 1; width: 50%;border: 1px solid gainsboro;">
						<h4 style=" padding-left: 5px;font-size: 14px;">Engine Options A</h4>
						<div class="options" style=" flex: 1; width: 50%;border: 1px solid gainsboro;padding: 10px;border-radius: 5px;">
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Eng Make: <span style=" float: right;">{{ $data->engine_make }}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Eng Model: <span style=" float: right;">{{ $data->engine_model }}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Eng Serial: <span style=" float: right;">{{ $data->engine_serial }}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Eng HP: <span style=" float: right;">{{ $data->engine_hp }}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Cruise: <span style=" float: right;">{{ $data->cruise }}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Clean air idle: <span style=" float: right;">{{ $data->clean_air_idle }}</span></p>
						</div>
					</div>
					<div style=" flex: 1; width: 50%;border: 1px solid gainsboro;">
						<h4 style=" padding-left: 5px;font-size: 14px;">Overall Condition</h4>
						<div class="options" style=" flex: 1; width: 50%;border: 1px solid gainsboro;padding: 10px;border-radius: 5px;">
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Overall Length: <span style=" float: right;">{{ $data->ov_length }}"</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Overall Height: <span style=" float: right;">{{ $data->ov_height }}"</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Overall Width: <span style=" float: right;">{{ $data->ov_width }}"</span></p>
						</div>
					</div>
				</div>
			</section>
			{{-- ENGINE SECTION A END HERE --}}

			{{-- ENGINE SECTION B START HERE --}}

			<section class="engine_seaction_b">
				<div class="engine_section_b_container flex" style="justify-content: space-between;margin-top: 10px;display: flex;">
					<div class="left_enginer_container" style="flex: 1; width: 50%;">
						<div style="flex: 1; width: 50%;border: 1px solid gainsboro;margin-top: 10px;">
							<h4 style="  padding-left: 5px;font-size: 14px;">Engine Options B</h4>
							<div class="options" style="flex: 1; width: 50%;border: 1px solid gainsboro;margin-top: 10px;padding: 10px;border-radius: 5px;">
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Odometer: <span style=" float: right;">{{ $data->odometer }}</span></p>
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Hub odometer:: <span style=" float: right;">{{ $data->hub_odometer }}</span></p>
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">ECU HP: <span style=" float: right;">{{ $data->ecu_hp }}</span></p>
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">ECU Miles: <span style=" float: right;">{{ $data->ecu_miles }}</span></p>
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Eng Hours: <span style=" float: right;">{{ $data->ecu_hours }}</span></p>

							</div>
						</div>

						<div style="flex: 1; width: 50%;border: 1px solid gainsboro;margin-top: 10px;">
							<h4 style="  padding-left: 5px;font-size: 14px;">Engine Options C</h4>
							<div class="options" style="flex: 1; width: 50%;border: 1px solid gainsboro;margin-top: 10px;padding: 10px;border-radius: 5px;">
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Eng Brake: <span>{{ $data->engine_brake }}</span></p>
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Fuel: <span>{{ $data->fuel }}</span></p>
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">FT1 Capac (Gal): <span>{{ $data->ft1 }}</span></p>

							</div>
						</div>

						<div style="flex: 1; width: 50%;border: 1px solid gainsboro;margin-top: 10px;">
							<h4 style="  padding-left: 5px;font-size: 14px;">Exterior Options A</h4>
							<div class="options" style="flex: 1; width: 50%;border: 1px solid gainsboro;margin-top: 10px;padding: 10px;border-radius: 5px;">
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Air Horns: <span style=" float: right;">{{ $data->air_horns }}</span></p>
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Mirrors: <span style=" float: right;">{{ $data->mirrors }}</span></p>
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Exterior Color: <span style=" float: right;">{{ $data->exterior_color }}</span></p>

							</div>
						</div>

						<div style="flex: 1; width: 50%;border: 1px solid gainsboro;margin-top: 10px;">
							<h4 style="  padding-left: 5px;font-size: 14px;">Axle / Susp Options</h4>
							<div class="options" style="flex: 1; width: 50%;border: 1px solid gainsboro;margin-top: 10px;padding: 10px;border-radius: 5px;">
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">WheelBase (In): <span style=" float: right;">{{ $data->wheelbase }}</span></p>
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Rear Ratio: <span style=" float: right;">{{ $data->rear_ratio }}</span></p>
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">F Axle (lbs): <span style=" float: right;">{{ $data->f_axle }}</span></p>
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">R Axle (lbs): <span style=" float: right;">{{ $data->r_axle }}</span></p>
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">GVWR (lbs): <span style=" float: right;">{{ $data->gvwr }}</span></p>
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Suspension: <span style=" float: right;">{{ $data->suspension }}</span></p>
							</div>
						</div>

						<div style="flex: 1; width: 50%;border: 1px solid gainsboro;margin-top: 10px;">
							<h4 style="  padding-left: 5px;font-size: 14px;">Transmission Options</h4>
							<div class="options" style="flex: 1; width: 50%;border: 1px solid gainsboro;margin-top: 10px;padding: 10px;border-radius: 5px;">
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Trans Make: <span style=" float: right;">{{ $data->trans_make }}</span></p>
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Trans Model: <span style=" float: right;">{{ $data->trans_model }}</span></p>
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Trans Speed: <span style=" float: right;">{{ $data->trans_speed ?? 'NA' }}</span></p>
							</div>
						</div>

					</div>

					{{-- Miscellaneous CONDITION --}}
					<div class="Miscellaneous_container" style="flex: 1; width: 50%;border: 1px solid gainsboro;margin-top: 10px;">
						<h4 style="  padding-left: 5px;font-size: 14px;">Miscellaneous</h4>
						<div class="options" style="flex: 1; width: 50%;border: 1px solid gainsboro;margin-top: 10px;padding: 10px;border-radius: 5px;">
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Seating Capacity: <span style=" float: right;">{{$misslenous->seating_capacity}}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Electronic Engine Controls: <span style=" float: right;">{{$misslenous->elect_eng_control? 'Yes': 'No'}}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Full Gauge Package: <span style=" float: right;">{{$misslenous->full_gause? 'Yes': 'No'}}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Wraparound Dash: <span style=" float: right;">{{$misslenous->wraparound? 'Yes': 'No'}}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Power Mirrors: <span style=" float: right;">{{$misslenous->power_mirror? 'Yes': 'No'}}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Tilt / Telescopic Steering Wheel: <span style=" float: right;">{{$misslenous->tilt? 'Yes': 'No'}}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">AirRide Driver's Seat: <span style=" float: right;">{{$misslenous->air_ride? 'Yes': 'No'}}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Restroom: <span style=" float: right;">{{$misslenous->restroom? 'Yes': 'No'}}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">PA System: <span style=" float: right;">{{$misslenous->pa_syst? 'Yes': 'No'}}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Audio - Video System: <span style=" float: right;">{{$misslenous->aud_vid_syst? 'Yes': 'No'}}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Number of Video Monitors: <span style=" float: right;">{{$misslenous->video_m_no? 'Yes': 'No'}}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Multi-Disc CD Changer:: <span style=" float: right;">{{$misslenous->cd_charger? 'Yes': 'No'}}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Individual multi-Channel Audio System: <span style=" float: right;">{{$misslenous->ind_aud_syst? 'Yes': 'No'}}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Global Positioning System: <span style=" float: right;">{{$misslenous->gps? 'Yes': 'No'}}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">In Motion Satellite TV System: <span style=" float: right;">{{$misslenous->satelite_tv_syst? 'Yes': 'No'}}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Road Viewing Monitor System: <span style=" float: right;">{{$misslenous->road_viewing_m_syst? 'Yes': 'No'}}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Wheelchair Lift: <span style=" float: right;"></span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Underfloor Storage with Lift: <span style=" float: right;">{{$misslenous->under_floor? 'Yes': 'No'}}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Parcel Rack Storage with Lift: <span style=" float: right;">{{$misslenous->parcel_rack? 'Yes': 'No'}}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Traction Control: <span style=" float: right;">{{$misslenous->tracon_control? 'Yes': 'No'}}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Power Windshield Sun Visors: <span style=" float: right;">{{$misslenous->sun_visors? 'Yes': 'No'}}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Tour Guide Seat <span style=" float: right;">{{$misslenous->tour_guide_seat? 'Yes': 'No'}}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Other: <span style=" float: right;">{{$misslenous->other? 'Yes': 'No'}}</span></p>
							<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Was Unit driven In ?: <span style=" float: right;">{{$misslenous->unit_driven_in? 'Yes': 'No'}}</span></p>
						</div>
					</div>
				</div>
			</section>

			{{-- ENGINE SECTION B END HERE --}}


			{{-- TRANSMISSION SECTION START HERE --}}
			<section class="transmission" style=" margin-top: 10px;">
				<div class="flex" style="justify-content: space-between;">
					<div class="left_box_container" style=" width: 100%;">
						<div style=" border: 1px solid gainsboro; padding-left: 5px;">
							<h4 style=" font-size: 14px;">Brakes Options</h4>

							<div class="options" style=" padding: 10px;border-radius: 5px;">
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">ABS: <span style=" float: right;">{{ $extras->abs == 1 ? 'YES' : 'NO' }}</span></p>
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">HYD: <span style=" float: right;">{{ $extras->hyd == 1 ? 'YES' : 'NO' }}</span></p>
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">AIR: <span style=" float: right;">{{ $extras->air == 1 ? 'YES' : 'NO' }}</span></p>
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">DISK: <span style=" float: right;">{{ $extras->disk == 1 ? 'YES' : 'NO' }}</span></p>
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">DRUM: <span style=" float: right;">{{ $extras->drum == 1 ? 'YES' : 'NO' }}</span></p>
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Break Plates: <span style=" float: right;">{{ $extras->break_plates }}</span></p>
							</div>
						</div>

						<div style=" border: 1px solid gainsboro; padding-left: 5px;">
							<h4 style=" font-size: 14px;">Tires [Front]</h4>
							<div class="options" style=" padding: 10px;border-radius: 5px;">
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Size: <span style=" float: right;">{{ $extras->tyre_size_f }}</span></p>
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Wheels: <span style=" float: right;">{{ $extras->wheels }}/span></p>
								<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Detail: <span style=" float: right;">{{ $extras->detail_f }}</span></p>

							</div>
						</div>

					</div>
					<div class="right_box_container" style=" width: 100%; border: 1px solid gainsboro;padding: 10px;border-radius: 5px;">
						<h4 style="margin-top: 0; font-size: 14px;">Brakes</h4>
						<table style="width: 100%; border-collapse: collapse;">
							<tr>
								<th style=" padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;font-size: 12px;font-weight: bold; width: 40%;">Steer Axle Brakes:</th>
								<td style=" padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;font-size: 12px; display: flex;align-items: center;  width: 60%;">70% 70% (1)</td>
							</tr>
							<tr>
								<th style=" padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;font-size: 12px;font-weight: bold; width: 40%;">Drive Axle Brakes:</th>
								<td style=" padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;font-size: 12px;display: flex;align-items: center;  width: 60%;">70% 70% (2)</td>
							</tr>
							<tr>
								<th style=" padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;font-size: 12px;font-weight: bold; width: 40%;"></th>
								<td style=" padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;font-size: 12px;display: flex;align-items: center;  width: 60%;">70% 70% (3)</td>
							</tr>
							<tr>
								<th style=" padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;font-size: 12px;font-weight: bold; width: 40%;"></th>
								<td style=" padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;font-size: 12px;display: flex;align-items: center;  width: 60%;">(4)</td>
							</tr>
							<tr>
								<th style=" padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;font-size: 12px;font-weight: bold; width: 40%;"></th>
								<td style=" padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;font-size: 12px;display: flex;align-items: center;  width: 60%;"> (5)</td>
							</tr>
							<tr>
								<th style=" padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;font-size: 12px;font-weight: bold; width: 40%;"></th>
								<td style=" padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;font-size: 12px;display: flex;align-items: center;  width: 60%;">(6)</td>
							</tr>
						</table>

						<h4 style="margin-top: 0; font-size: 14px;">Tires [Rear]</h4>
						<table style="width: 100%; border-collapse: collapse;">
							<tr>
								<th style=" padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;font-size: 12px;font-weight: bold; width: 40%;">Size:</th>
								<td style=" padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;font-size: 12px;display: flex;align-items: center;  width: 60%;">{{ $extras->tyre_size_r }}</td>
							</tr>
							<tr>
								<th style=" padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;font-size: 12px;font-weight: bold; width: 40%;">Wheels:</th>
								<td style=" padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;font-size: 12px;display: flex;align-items: center;  width: 60%;">{{ $extras->wheels }}</td>
							</tr>
							<tr>
								<th style=" padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;font-size: 12px;font-weight: bold; width: 40%;">Detail:</th>
								<td style=" padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;font-size: 12px;display: flex;align-items: center;  width: 60%;">{{ $extras->detail_r }}</td>
							</tr>

						</table>

					</div>
				</div>
			</section>
			{{-- TRANSMISSION SECTION END HERE --}}

			{{-- TYRE SECTION START HERE --}}
			<section class="tyre_container" style=" margin-top: 10px;">
				<div class="flex tyre_flex_container" style="justify-content: space-between;display:flex;">
					<div style="border: 1px solid gainsboro; text-align: center; padding: 10px;line-height: 1.2%;">
						1
					</div>
					<div style="border: 1px solid gainsboro; text-align: center; padding: 10px;line-height: 1.2%;">
						<p style="font-size: 12px; margin-top: 10px;">Brake Legend</p>
						<h5 style="font-size: 10px;">BD = DRUM HAS MORE THAN 1/16 INCH LIP</h5>
						<h5 style="font-size: 10px;">CL = CRACKED LINING</h5>
						<h5 style="font-size: 10px;">LS = LEAKING SEAL(S)</h5>
						<p style="font-size: 12px; margin-top: 10px;">Tire Legend</p>
						<h5 style="font-size: 10px;">C = CUT D = DRY ROT F = FLAT</h5>
						<h5 style="font-size: 10px;">M = MISMATCHED TIRES/CASING</h5>
						<h5 style="font-size: 10px;">MA = MISMATCHED AXLES (FRONT vs. REAR)</h5>
						<h5 style="font-size: 10px;">V = VIRGIN W = IRREGULAR WEAR</h5>
						<h5 style="font-size: 10px;">R = RECAP: 1 = ONCE, 2 = TWICE, 3 = 3 TIMES</h5>
						<p style="font-size: 12px; margin-top: 10px;">Tread Legend</p>
						<h5 style="font-size: 10px;">H = HIGHWAY L = LUG</h5>

					</div>
				</div>
			</section>
			{{-- TYRE SECTION END HERE --}}

			<section class="condition">
				<div class="condition_container" style=" margin-top: 10px;border: 1px solid gainsboro;font-size: 10px;padding-left: 5px; border-radius: 10px;">
					<span>Condition Report</span>
				</div>
			</section>

			{{-- COMMENTS SECTION START HERE --}}
			<section class="comments_enginer_area mt-10" style=" margin-top: 10px;">
				<div class="comments_enginer_area_container">
					<table style=" border-collapse: collapse; width: 100%;">

						<tr>
							<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"></th>
							<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Engine Compartment Area</th>
							<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Comments</th>

						</tr>

						@foreach($conditions as $condition)
						<tr>
							<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{$condition->status}}</td>
							<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{$condition->condition_name}}</td>
							<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{$condition->condition_comments}}</td>
						</tr>
						@endforeach

					</table>
				</div>
			</section>
			{{-- COMMENTS SECTION END HERE --}}

			<section class="comments_enginer_area mt-10" style=" margin-top: 10px;">
				<div class="comments_enginer_area_container">
					<table style=" border-collapse: collapse; width: 100%;">
						<tr>
							<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"></th>
							<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Operational Test</th>
							<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Comments</th>

						</tr>
                        @foreach($operationalTest as $item)
						<tr>
							<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{ $item->status }}</td>
							<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{ $item->condition_name }}</td>
							<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{ $item->condition_comments }}</td>
						</tr>

                        @endforeach

					</table>
				</div>
			</section>

			<section class="comments_enginer_area mt-10" style=" margin-top: 10px;">
				<div class="comments_enginer_area_container">
					<table style=" border-collapse: collapse; width: 100%;">
						<tr>
							<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"></th>
							<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">In Cab Inspection</th>
							<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Comments</th>

						</tr>
                        @foreach ($InspectionInCab as $item_in_cab )
                        <tr>
							<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{$item_in_cab->status  }}</td>
							<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{$item_in_cab->condition_name  }}</td>
							<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{$item_in_cab->condition_comments  }}</td>
						</tr>
                        @endforeach



					</table>
				</div>
			</section>

			<section class="comments_enginer_area mt-10" style=" margin-top: 10px;">
				<div class="comments_enginer_area_container">
					<table style=" border-collapse: collapse; width: 100%;">
						<tr>
							<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"></th>
							<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Outside Inspection</th>
							<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Comments</th>

						</tr>

                        @foreach ($InspectionOutSide as $inspectionOut)
                        <tr>
							<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{ $inspectionOut->status }}</td>
							<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{ $inspectionOut->condition_name }}</td>
							<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{ $inspectionOut->condition_comments }}</td>
						</tr>
                        @endforeach

					</table>
				</div>
			</section>

			<section class="comments_enginer_area mt-10" style=" margin-top: 10px;">
				<div class="comments_enginer_area_container">
					<table style=" border-collapse: collapse; width: 100%;">
						<tr>
							<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"></th>
							<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Under Vehicle Inspection</th>
							<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Comments</th>

						</tr>
                       @foreach ($UnderVehicleInspection as $underInspection)
                       <tr>
                        <td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{ $underInspection->status }}</td>
							<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{ $underInspection->condition_name }}</td>
							<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{ $underInspection->condition_comments }}</td>
                    </tr>
                       @endforeach

					</table>
				</div>
			</section>

			<section class="comments_enginer_area mt-10" style=" margin-top: 10px;">
				<div class="comments_enginer_area_container">
					<table style=" border-collapse: collapse; width: 100%;">
						<tr>
							<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"></th>
							<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Tires/Wheels/Brakes</th>
							<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Comments</th>

						</tr>
                       @foreach ($TyreInspection as $tyreIns )
                       <tr>
                           <td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{ $tyreIns->status }}</td>
							<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{ $tyreIns->condition_name }}</td>
							<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{ $tyreIns->condition_comments }}</td>
                    </tr>
                       @endforeach

					</table>
				</div>
			</section>

			<section class="comments_enginer_area mt-10" style=" margin-top: 10px;">
				<div class="comments_enginer_area_container">
					<table style=" border-collapse: collapse; width: 100%;">
						<tr>
							<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Additional Services </th>
							<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Requested</th>
							<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Status</th>
							<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Comments</th>
						</tr>

					</table>
				</div>
			</section>
			@if(sizeof($estimates) > 0)
			<section class="worksheet mt-10" style=" margin-top: 10px;">
				<div class="worksheet_container">
					<p>RECONDITIONING AND SUPPLEMENTAL ESTIMATE</p>

				</div>
			</section>

			<section class="recommendation mt-10" style=" margin-top: 10px;">
				<table style=" border-collapse: collapse; width: 100%;">
					<thead>
						<tr>
							<td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">ITEM</td>
							<td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">DESCRIPTION / COMMENTS </td>
							<td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">PART COST ($) </td>
							<td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">LABOR </td>
						</tr>
					</thead>
					<tbody>
						@php
							$t_part = 0;
							$t_laber = 0;
						@endphp
						@foreach($estimates as $estimate)
						@php
							$t_part = $t_part + $estimate->t_part_cost;
							$t_laber = $t_laber + $estimate->t_labor_cost;
						@endphp
						<tr>
							<td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{$estimate->item_name}}</td>
							<td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{$estimate->desciption}}</td>
							<td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{$estimate->t_part_cost}}</td>
							<td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{$estimate->t_labor_cost}} </td>
						</tr>
						@endforeach
						<tr>
							<td colspan="2"  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">
								<h3>TOTAL ESTIMATE </h3>
							</td>
							<td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{$t_part}}</td>
							<td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{$t_laber}}</td>
						</tr>

						<tr>
							<td colspan="3"  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">
								<h3>TOTAL (PARTS + LABOR) </h3>
							</td>

							<td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">{{$t_part + $t_laber}}</td>
						</tr>

					</tbody>
				</table>
			</section>
			@endif
			{{-- RECOMMENDATION SECTION END HERE --}}

			{{-- SPECIFICATION WORKSHEET START HERE --}}
			<section class="worksheet mt-10" style=" margin-top: 10px;">
				<div class="worksheet_container">
					<p>COMMENTS:</p>
				</div>
			</section>
			{{-- SPECIFICATION WORKSHEET START END --}}

			{{-- IMAGE BOX CONTAINER --}}
			@if(sizeof($conditions) > 0)
			<section class="section_image mt-10" style=" margin-top: 10px;">
				<div class="image_container" style="display: flex; justify-content: center;">
					<div class="grid col-lg-4 gap4" style=" display: grid; grid-template-columns: repeat(4, 1fr); gap: 4px;">
						@foreach($conditions as $condition)
						<div style=" text-align: center; border: 1px solid #dddddd; margin-bottom: 10px;">
							<img src="{{$condition->inspection_img}}" alt="Placeholder Image 1" style="width: 100%;  height: auto;">
							<p style="margin: 0;">{{$condition->condition_name}}</p>
						</div>
						@endforeach
					</div>
				</div>
			</section>
			@endif
			{{-- IMAGE BOX CONTAINER END HERE --}}
		</div>
	</body>

</html>
