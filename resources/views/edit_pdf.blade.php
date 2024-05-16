@extends('layouts.app')

@section('content')
<div class="container1" style="width:100%;overflow:hidden;margin:0 auto">
	<div class="row justify-content-center">
	
        <div class="col-md-9">
		@if(session('success'))
		<div class="alert alert-success">
			{{ session('success') }}
		</div>
		@endif	
		@if(session('error'))
		<div class="alert alert-danger">
			{{ session('error') }}
		</div>
		@endif	
			<form action="{{ route('update-test') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<section class="header flex"
                style="width: 100%; justify-content: space-around; border: 1px solid gray; padding: 5px;border-radius: 5px;display:inline-block;">
					<div class="logo_container " style="width: 19%;float:left">
						<img src="{{ asset('pdflogo.png') }}" alt="Vehicle Inspections" />
						
						<p style="font-weight: 1000;text-transform: capitalize; font-size: 17px;">Dekra Services. INC</p>
						<p style="font-weight: 1000;text-transform: capitalize; font-size: 17px;">Customer Service
						770-257-0107</p>
					</div>
					<div class="client_information flex"
                    style="justify-content: space-between;width: 80%; border-left: 2px solid gainsboro; padding-left: 15px;float:left">
						<div class="client_information_content">
							<div class="upper_information_content">
								<p>BUS</p>
								<span>CLIENT</span>
								<span>397 - A F OHAB</span>
							</div>
							<div class="lower_information_content flex" style="display:flex;margin-top: 10px;">
								<div class="insp_date"
                                style=" margin-right: 5px;border-left: 2px solid gainsboro; padding: 5px; border-left: none;">
									<label>INSP DATE</label>
									<input type="date" name="inspection[inspection_date]" value="{{ $inspection->inspection_date }}"/>
								</div>
								<div class="fleet_name"
                                style=" margin-right: 5px;border-left: 2px solid gainsboro; padding: 5px;">
									<label>FLEET NAME</label>
									<input type="text" name="inspection[fleet_no]" value="{{ $inspection->fleet_no }}" />
								</div>
								<div class="unit_number"
                                style=" margin-right: 5px;border-left: 2px solid gainsboro; padding: 5px;">
									<label style="font-size: 10px;">UNIT NUMBER</label>
									<input name="inspection[unit_number]" type="text" value="{{ $inspection->unit_number }}"/>
								</div>
								<div class="vin_last"
                                style=" margin-right: 5px;border-left: 2px solid gainsboro; padding: 5px;">
									<label style="font-size: 10px;">VIN (LAST 8)</label>
									<input type="text" name="inspection[vin_no]" value="{{ $inspection->vin_no }}"/>
								</div>
								<div class="vin_last"
                                style=" margin-right: 5px;border-left: 2px solid gainsboro; padding: 5px;">
									<label style="font-size: 10px;">PO NUMBER</label>
									<input type="text" name="inspection[po_no]" value="{{ $inspection->po_no }}"/>
								</div>
							</div>
						</div>
						<input type="hidden" name="inspection[id]" value="{{ $inspection->id }}" />
						<div class="vehicle_information" style=" width: 30%;">
							<label class="inspector_id" style="font-size: 15px; font-weight: 600;">INSPECTOR: </label> <br/>
							<input style="font-weight: 100;" name="inspection[inspector_name]" value="{{ $inspection->inspector_name }}"></input>
							
						</div>
						<button type="submit" style="background: red;border-color: red;box-shadow: none;padding: 2px 8px 4px 8px;border-radius: 32px;color: #fff;font-weight: bold;margin-top: 15px;">Submit</button>
					</div>
				</section>
				
				
				
				<section class="year" style="  width: 100%;margin-top: 5px;border-left: 2px solid gainsboro; border-right: 2px solid gainsboro;border-bottom: 2px solid gainsboro;">
					<div class="flex year_container" style="justify-content: space-between; display: flex;justify-content: space-between;">
						<div style="flex: 1;padding: 10px;">
							<table style="width:100%;">
								<tr>
									<td style=" margin: 0;margin-top: 5px;">
										YEAR
									</td>
									<td style=" margin: 0;margin-top: 5px;">
										<input type="text" name="inspection[model_year]" value="{{ $inspection->model_year }}" style="float: right;" />
									</td>
								</tr>
								<tr>
									<td style=" margin: 0;margin-top: 5px;">
										MODEL
									</td>
									<td style=" margin: 0;margin-top: 5px;">
										<input type="text" name="inspection[model_year]" value="{{ $inspection->model_year }}" style="float: right;"/>
									</td>
								</tr>
							</table>
						</div>
						<div style="flex: 1;padding: 10px;">
							<table style="width:100%;">
								<tr>
									<td style=" margin: 0;margin-top: 5px;">
										MAKE
									</td>
									<td style=" margin: 0;margin-top: 5px;">
										<input type="text" name="inspection[model_make]" value="{{ $inspection->model_make }}" style="float: right;">
									</td>
								</tr>
								<tr>
									<td style=" margin: 0;margin-top: 5px;">
										VIN
									</td>
									<td style=" margin: 0;margin-top: 5px;">
										<input type="text" name="inspection[vin_no]" value="{{ $inspection->vin_no }}" style="float: right;"/>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</section>
				
				<section class="worksheet" style="  width: 100%; padding: 5px;  border: 2px solid gainsboro; margin-top: 10px;border-radius: 10px;">
					<div class="worksheet_container">
						<p style="font-size: 10px;">SPECIFICATION WORKSHEET</p>
					</div>
				</section>
				
				<section class="steering_interior" style=" width: 100%;margin-top: 10px;">
					<div class="flex" style="justify-content: space-between; margin-right: 5px; display: flex;width: 100%;">
						<div class="container" style=" margin-right: 5px;width:50%;float:left;padding:0">
							<table style=" width: 100%;border-collapse: collapse;">
								<tr>
									<th colspan="2" style=" background-color: rgb(202, 30, 30);color: white;font-weight: bold; text-align: center; padding: 8px;">Interior Options</th>
								</tr>
								<tr>
									<td style="  padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;border-bottom: none;">Interior Color:</td>
									<td style="  padding: 8px; border-bottom: 1px solid gainsboro; text-align: right;border-bottom: none;"><input type="text" name="inspection[interior_color]" value="{{ $inspection->interior_color }}"></td>
								</tr>
							</table>
						</div>
						<div class="container" style=" margin-right: 5px;width:50%;float:left;padding:0">
							<table style=" width: 100%;border-collapse: collapse;">
								<tr>
									<th colspan="2" style=" background-color: rgb(202, 30, 30);color: white;font-weight: bold; text-align: center; padding: 8px;">Steering Options</th>
								</tr>
								<tr>
									<td style="  padding: 8px; border-bottom: 1px solid gainsboro; text-align: left;border-bottom: none;">Power Steering?:</td>
									<td style="  padding: 8px; border-bottom: 1px solid gainsboro; text-align: right;border-bottom: none;">
										<select name="inspection[powr_steering]">
											<option value="1" {{ $inspection->powr_steering == 1 ? 'selected' : '' }}>YES</option>
											<option value="0" {{ $inspection->powr_steering == 0 ? 'selected' : '' }}>NO</option>
										</select>
										
									</td>
								</tr>
							</table>
						</div>
					</div>
				</section>
				<table style=" width: 100%;margin-top: 10px;">
					<tr>
						<td style="vertical-align: baseline;">
							<table style="width:100%">
								<tr><td style="border: 1px solid gainsboro"><h4 style=" padding-left: 5px;font-size: 14px;">Engine Options A</h4></td></tr>
								<tr><td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Eng Make: <span style=" float: right;"> <input type="text" name="inspection[engine_make]" value="{{ $inspection->engine_make }}"/></span></p></td></tr>
								<tr><td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Eng Model: <span style=" float: right;"><input type="text" name="inspection[engine_model]" value="{{ $inspection->engine_model }}"/></span></p></td></tr>
								<tr><td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Eng Serial: <span style=" float: right;"><input type="text" name="inspection[engine_serial]" value="{{ $inspection->engine_serial }}"/></span></p></td></tr>
								<tr><td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Eng HP: <span style=" float: right;">
								<!-- <select name="inspection[engine_hp]">
									<option value="1" {{ $inspection->engine_hp == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->engine_hp == 0 ? 'selected' : '' }}>No</option>
								</select> -->
								<input type="number" name="inspection[engine_hp]" value="{{ $inspection->engine_hp }}"/>
								</span></p></td></tr>
								<tr><td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Cruise: <span style=" float: right;">
								<select name="inspection[cruise]">
									<option value="YES" {{ $inspection->cruise == 'YES' ? 'selected' : '' }}>YES</option>
									<option value="NO" {{ $inspection->cruise == 'NO' ? 'selected' : '' }}>NO</option>
									<option value="DOES NOT APPLY" {{ $inspection->cruise == 'DOES NOT APPLY' ? 'selected' : '' }}>DOES NOT APPLY</option>
								</select>
								</span></p></td></tr>
								<tr><td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Clean air idle: <span style=" float: right;">
								<select name="inspection[clean_air_idle]">
									<option value="YES" {{ $inspection->clean_air_idle == 'YES' ? 'selected' : '' }}>YES</option>
									<option value="NO" {{ $inspection->clean_air_idle == 'NO' ? 'selected' : '' }}>NO</option>
									<option value="DOES NOT APPLY" {{ $inspection->clean_air_idle == 'DOES NOT APPLY' ? 'selected' : '' }}>DOES NOT APPLY</option>
								</select>
								</span></p></td> </tr>
							</table>
							<table style="width:100%">
								<tr><td style="border: 1px solid gainsboro"><h4 style="  padding-left: 5px;font-size: 14px;">Engine Options B</h4></td></tr>
								<tr><td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Odometer: <span style=" float: right;"><input type="number" name="inspection[odometer]" value="{{ $inspection->odometer }}"/></span></p></td></tr>
								<tr><td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Hub odometer:: <span style=" float: right;"><input type="number" name="inspection[hub_odometer]" value="{{ $inspection->hub_odometer }}"/></span></p></td></tr>
								<tr><td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">ECU HP: <span style=" float: right;">
								<!-- <select name="inspection[ecu_hp]">
									<option value="1" {{ $inspection->ecu_hp == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->ecu_hp == 0 ? 'selected' : '' }}>No</option>
								</select> -->
								<input type="number" name="inspection[ecu_hp]" value="{{ $inspection->ecu_hp }}"/>
								</span></p></td></tr>
								<tr><td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">ECU Miles: <span style=" float: right;">
								<!-- <select name="inspection[ecu_miles]">
									<option value="1" {{ $inspection->ecu_miles == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->ecu_miles == 0 ? 'selected' : '' }}>No</option>
								</select> -->
								<input type="number" name="inspection[ecu_miles]" value="{{ $inspection->ecu_miles }}"/>
								</span></p></td></tr>
								<tr><td style="border: 1px solid gainsboro">	<p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Eng Hours: <span style=" float: right;">
								<!-- <select name="inspection[ecu_hours]">
									<option value="1" {{ $inspection->ecu_hours == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->ecu_hours == 0 ? 'selected' : '' }}>No</option>
								</select> -->
								<input type="text" name="inspection[ecu_hours]" value="{{ $inspection->ecu_hours }}"/>
								</span></p></td></tr>
							</table>
						</td>
						<td style="vertical-align: baseline;">
							<table style="width:100%">
								
								<tr> <td style="border: 1px solid gainsboro"><h4 style=" padding-left: 5px;font-size: 14px;">Overall Condition</h4></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Overall Length: <span style=" float: right;"><input type="text" name="inspection[ov_length]" value="{{ $inspection->ov_length }}"/></span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Overall Height: <span style=" float: right;"><input type="text" name="inspection[ov_height]" value="{{ $inspection->ov_height }}"/></span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Overall Width: <span style=" float: right;"><input type="text" name="inspection[ov_width]" value="{{ $inspection->ov_width }}"/></span></p></td></tr>
								
								
							</table>
							
						</td>
					</tr>
				</table>
				<table style=" width: 100%;margin-top: 10px;">
					<tr>
						<td style="vertical-align: baseline;">
							
							
							
							<table style="width:100%">
								<tr><td style="border: 1px solid gainsboro"><h4 style="  padding-left: 5px;font-size: 14px;">Engine Options C</h4></td></tr>
								<tr><td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Eng Brake: <span style=" float: right;">
								<select name="inspection[engine_brake]">
									<option value="YES" {{ $inspection->engine_brake == 'YES' ? 'selected' : '' }}>YES</option>
									<option value="NO" {{ $inspection->engine_brake == 'NO' ? 'selected' : '' }}>NO</option>
								</select>		
								</span></p></td></tr>
								<tr><td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Fuel: <span style=" float: right;">
								<select name="inspection[fuel]">
									<option value="DIESEL" {{ $inspection->fuel == 'DIESEL' ? 'selected' : '' }}>DIESEL</option>
									<option value="GASOLINE" {{ $inspection->fuel == 'GASOLINE' ? 'selected' : '' }}>GASOLINE</option>
									<option value="CNG" {{ $inspection->fuel == 'CNG' ? 'selected' : '' }}>CNG</option>
									<option value="ELECTRIC VEHICLE" {{ $inspection->fuel == 'ELECTRIC VEHICLE' ? 'selected' : '' }}>ELECTRIC VEHICLE</option>
									<option value="OTHER" {{ $inspection->fuel == 'OTHER' ? 'selected' : '' }}>OTHER</option>
								</select>	
								</span></p></td></tr>
								<tr><td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">FT1 Capac (Gal): <span style=" float: right;">
								<select name="inspection[ft1]">
									<option value="LITERS" {{ $inspection->ft1 == 'LITERS' ? 'selected' : '' }}>LITERS</option>
									<option value="GALLONS" {{ $inspection->ft1 == 'GALLONS' ? 'selected' : '' }}>GALLONS</option>
								</select>
								</span></p></td></tr>
							</table>
							<table style="width:100%">
								<tr><td style="border: 1px solid gainsboro"><h4 style="  padding-left: 5px;font-size: 14px;">Exterior Options A</h4></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Air Horns: <span style=" float: right;">
								<select name="inspection[air_horns]">
									<option value="1" {{ $inspection->air_horns == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->air_horns == 0 ? 'selected' : '' }}>No</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Mirrors: <span style=" float: right;">
								
								<input type="text" name="inspection[mirrors]" value="{{ $inspection->mirrors }}"/></span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Exterior Color: <span style=" float: right;"><input type="text" name="inspection[exterior_color]" value="{{ $inspection->exterior_color }}"/></span></p></td></tr>
							</table>
							<table style="width:100%">
								<tr><td style="border: 1px solid gainsboro"><h4 style="  padding-left: 5px;font-size: 14px;">Axle / Susp Options</h4></td></tr>
								<tr><td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">WheelBase (In): <span style=" float: right;">
								<!-- <select name="inspection[wheelbase]">
									<option value="1" {{ $inspection->wheelbase == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->wheelbase == 0 ? 'selected' : '' }}>No</option>
								</select> -->
								<input type="text" name="inspection[wheelbase]" value="{{ $inspection->wheelbase }}"/>
								</span></p></td></tr>
								<tr><td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Rear Ratio: <span style=" float: right;">
								<!-- <select name="inspection[rear_ratio]">
									<option value="1" {{ $inspection->rear_ratio == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->rear_ratio == 0 ? 'selected' : '' }}>No</option>
								</select> -->
								<input type="text" name="inspection[rear_ratio]" value="{{ $inspection->rear_ratio }}"/>
								</span></p></td></tr>
								<tr><td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">F Axle (lbs): <span style=" float: right;">
								<input type="text" name="inspection[f_axle]" value="{{ $inspection->f_axle }}"/>
								<select name="inspection[f_axle_measure]">
									<option value="lbs" {{ $inspection->f_axle_measure == 'lbs' ? 'selected' : '' }}>LBS </option>
									<option value="kg" {{ $inspection->f_axle_measure == 'kg'? 'selected' : '' }}>KG</option>
								</select>
								</span></p></td></tr>
								<tr><td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">R Axle (lbs): <span style=" float: right;">
								<input type="text" name="inspection[r_axle]" value="{{ $inspection->r_axle }}"/>
								<select name="inspection[r_axle_measure]">
									<option value="lbs" {{ $inspection->r_axle_measure == 'lbs' ? 'selected' : '' }}>LBS </option>
									<option value="kg" {{ $inspection->r_axle_measure == 'kg'? 'selected' : '' }}>KG</option>
								</select>
								</span></p></td></tr>
								<tr><td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">GVWR (lbs): <span style=" float: right;">
								<input type="text" name="inspection[gvwr]" value="{{ $inspection->gvwr }}"/>
								<select name="inspection[gvwr_measure]">
									<option value="lbs" {{ $inspection->gvwr_measure == 'lbs' ? 'selected' : '' }}>LBS </option>
									<option value="kg" {{ $inspection->gvwr_measure == 'kg'? 'selected' : '' }}>KG</option>	
								</select>
								</span></p></td></tr>
								<tr><td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Suspension: <span style=" float: right;">
								<select name="inspection[suspension]">
									<option value="AIR" {{ $inspection->suspension == 'AIR' ? 'selected' : '' }}>AIR</option>
									<option value="SPRING" {{ $inspection->suspension == 'SPRING' ? 'selected' : '' }}>SPRING</option>
								</select>
								</span></p></td></tr>
							</table>
							<table style="width:100%">
								<tr><td style="border: 1px solid gainsboro"><h4 style="  padding-left: 5px;font-size: 14px;">Transmission Options</h4></td></tr>
								<tr><td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Trans Make: <span style=" float: right;">
								<input type="text" name="inspection[trans_make]"  value="{{ $inspection->trans_make}}" />
								</span></p></td></tr>
								<tr><td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Trans Model: <span style=" float: right;">
								
								<input type="text" name="inspection[trans_model]"  value="{{ $inspection->trans_model}}" />
								</span></p></td></tr>
								<tr><td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Trans Speed: <span style=" float: right;">
								
								<input type="number" name="inspection[trans_speed]"  value="{{ $inspection->trans_speed}}" />
								</span></p></td></tr>
							</table>
						</td>
						<td style="vertical-align: baseline;">
							
							<table style="width:100%">
								<tr> <td style="border: 1px solid gainsboro"><h4 style="  padding-left: 5px;font-size: 14px;">Miscellaneous</h4></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Seating Capacity: <span style=" float: right;">
								
								<input type="text" name="misslenous[seating_capacity]"  value="{{ $inspection->misslenous->seating_capacity}}" />
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Electronic Engine Controls: <span style=" float: right;">
								<select name="misslenous[elect_eng_control]">
									<option value="1" {{ $inspection->misslenous->elect_eng_control == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->elect_eng_control == 0 ? 'selected' : '' }}>No</option>
								</select>
								
							
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Full Gauge Package: <span style=" float: right;">
								<select name="misslenous[full_gause]">
									<option value="1" {{ $inspection->misslenous->full_gause == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->full_gause == 0 ? 'selected' : '' }}>No</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Wraparound Dash: <span style=" float: right;">
								<select name="misslenous[wraparound]">
									<option value="1" {{ $inspection->misslenous->wraparound == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->wraparound == 0 ? 'selected' : '' }}>No</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Power Mirrors: <span style=" float: right;">
								<select name="misslenous[power_mirror]">
									<option value="1" {{ $inspection->misslenous->power_mirror == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->power_mirror == 0 ? 'selected' : '' }}>No</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Tilt / Telescopic Steering Wheel: <span style=" float: right;">
								<select name="misslenous[tilt]">
									<option value="1" {{ $inspection->misslenous->tilt == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->tilt == 0 ? 'selected' : '' }}>No</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">AirRide Driver's Seat: <span style=" float: right;">
								<select name="misslenous[air_ride]">
									<option value="1" {{ $inspection->misslenous->tilt == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->tilt == 0 ? 'selected' : '' }}>No</option>
								</select>
								
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Restroom: <span style=" float: right;">
								<select name="misslenous[restroom]">
									<option value="1" {{ $inspection->misslenous->restroom == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->restroom == 0 ? 'selected' : '' }}>No</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">PA System: <span style=" float: right;">
								<select name="misslenous[pa_syst]">
									<option value="1" {{ $inspection->misslenous->pa_syst == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->pa_syst == 0 ? 'selected' : '' }}>No</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Audio - Video System: <span style=" float: right;">
								<select name="misslenous[aud_vid_syst]">
									<option value="1" {{ $inspection->misslenous->aud_vid_syst == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->aud_vid_syst == 0 ? 'selected' : '' }}>No</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Number of Video Monitors: <span style=" float: right;">
								<select name="misslenous[video_m_no]">
									<option value="1" {{ $inspection->misslenous->video_m_no == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->video_m_no == 0 ? 'selected' : '' }}>No</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Multi-Disc CD Changer:: <span style=" float: right;">
								<select name="misslenous[cd_charger]">
									<option value="1" {{ $inspection->misslenous->cd_charger == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->cd_charger == 0 ? 'selected' : '' }}>No</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Individual multi-Channel Audio System: <span style=" float: right;">
								<select name="misslenous[ind_aud_syst]">
									<option value="1" {{ $inspection->misslenous->ind_aud_syst == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->ind_aud_syst == 0 ? 'selected' : '' }}>No</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Global Positioning System: <span style=" float: right;">
								<select name="misslenous[gps]">
									<option value="1" {{ $inspection->misslenous->gps == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->gps == 0 ? 'selected' : '' }}>No</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">In Motion Satellite TV System: <span style=" float: right;">
								<select name="misslenous[satelite_tv_syst]">
									<option value="1" {{ $inspection->misslenous->satelite_tv_syst == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->satelite_tv_syst == 0 ? 'selected' : '' }}>No</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Road Viewing Monitor System: <span style=" float: right;">
								<select name="misslenous[road_viewing_m_syst]">
									<option value="1" {{ $inspection->misslenous->road_viewing_m_syst == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->road_viewing_m_syst == 0 ? 'selected' : '' }}>No</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Wheelchair Lift: <span style=" float: right;"></span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Underfloor Storage with Lift: <span style=" float: right;">
								<select name="misslenous[under_floor]">
									<option value="1" {{ $inspection->misslenous->under_floor == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->under_floor == 0 ? 'selected' : '' }}>No</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Parcel Rack Storage with Lift: <span style=" float: right;">
								<select name="misslenous[parcel_rack]">
									<option value="1" {{ $inspection->misslenous->parcel_rack == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->parcel_rack == 0 ? 'selected' : '' }}>No</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Traction Control: <span style=" float: right;">
								<select name="misslenous[tracon_control]">
									<option value="1" {{ $inspection->misslenous->tracon_control == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->tracon_control == 0 ? 'selected' : '' }}>No</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Power Windshield Sun Visors: <span style=" float: right;">
								<select name="misslenous[sun_visors]">
									<option value="1" {{ $inspection->misslenous->sun_visors == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->sun_visors == 0 ? 'selected' : '' }}>No</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Tour Guide Seat <span style=" float: right;">
								<select name="misslenous[tour_guide_seat]">
									<option value="1" {{ $inspection->misslenous->tour_guide_seat == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->tour_guide_seat == 0 ? 'selected' : '' }}>No</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Other: <span style=" float: right;">
								<select name="misslenous[other]">
									<option value="1" {{ $inspection->misslenous->other == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->other == 0 ? 'selected' : '' }}>No</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Was Unit driven In ?: <span style=" float: right;">
								<select name="misslenous[unit_driven_in]">
									<option value="1" {{ $inspection->misslenous->unit_driven_in == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->unit_driven_in == 0 ? 'selected' : '' }}>No</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Did Unit need to be jump started ?:  <span style=" float: right;">
								<select name="misslenous[jump_started]">
									<option value="1" {{ $inspection->misslenous->jump_started == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->jump_started == 0 ? 'selected' : '' }}>No</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Was Unit towed in ?:   <span style=" float: right;">
								<select name="misslenous[unit_tower_in]">
									<option value="1" {{ $inspection->misslenous->unit_tower_in == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->unit_tower_in == 0 ? 'selected' : '' }}>No</option>
								</select>
								
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Did Unit start and run ?:   <span style=" float: right;">
								<select name="misslenous[unit_start_run]">
									<option value="1" {{ $inspection->misslenous->unit_start_run == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->misslenous->unit_start_run == 0 ? 'selected' : '' }}>No</option>
								</select>
								
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Unit Condition:    <span style=" float: right;">
								<select name="misslenous[unit_condition]">
									<option value="EXCELLENT" {{ $inspection->misslenous->unit_condition == 'EXCELLENT' ? 'selected' : '' }}>EXCELLENT </option>
									<option value="GOOD" {{ $inspection->misslenous->unit_condition == 'GOOD' ? 'selected' : '' }}>GOOD </option>
									<option value="FAIR" {{ $inspection->misslenous->unit_condition == 'FAIR' ? 'selected' : '' }}>FAIR </option>
									<option value="BAD" {{ $inspection->misslenous->unit_condition == 'BAD' ? 'selected' : '' }}>BAD </option>
									<option value="SALVAGE" {{ $inspection->misslenous->unit_condition == 'SALVAGE' ? 'selected' : '' }}>SALVAGE </option>
									
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">If Unit is not driveable or will not start, Explain:    <span style=" float: right;">&nbsp;</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Any extra options or features not listed on front page and any additional comments:    <span style=" float: right;"><input type="text" name="misslenous[not_listend_comment]" value="{{ $inspection->misslenous->not_listend_comment }}"/></span></p></td></tr>
								<input type="hidden" name="misslenous[id]" value="{{ $inspection->misslenous->id}}" />
							</table>
							
						</td>
					</tr>
				</table>
				
				<table style="width:100%">
					<tr>
						<td style="width:50%;vertical-align: baseline;">
							<table style="width:100%">
								<tr> <td style="border: 1px solid gainsboro"><h4 style=" font-size: 14px;">Brakes Options</h4></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">ABS: <span style=" float: right;">
								<select name="extras[abs]">
									<option value="1" {{ $inspection->extras->abs == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->extras->abs == 0 ? 'selected' : '' }}>No</option>
								</select>
								<!-- <input type="text" name="extras[abs]" value="{{ $inspection->extras->abs }}"/> -->
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">HYD: <span style=" float: right;">
								<select name="extras[hyd]">
									<option value="1" {{ $inspection->extras->hyd == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->extras->hyd == 0 ? 'selected' : '' }}>No</option>
								</select>
								<!-- <input type="text" name="extras[hyd]" value="{{ $inspection->extras->hyd }}"/> -->
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">AIR: <span style=" float: right;">
								<select name="extras[air]">
									<option value="1" {{ $inspection->extras->air == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->extras->air == 0 ? 'selected' : '' }}>No</option>
								</select>
								<!-- <input type="text" name="extras[air]" value="{{ $inspection->extras->air}}"/> -->
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">DISK: <span style=" float: right;">
								<select name="extras[disk]">
									<option value="1" {{ $inspection->extras->disk == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->extras->disk == 0 ? 'selected' : '' }}>No</option>
								</select>
								<!-- <input type="text" name="extras[disk]" value="{{ $inspection->extras->disk}}"/> -->
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">DRUM: <span style=" float: right;">
								<select name="extras[drum]">
									<option value="1" {{ $inspection->extras->drum == 1 ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ $inspection->extras->drum == 0 ? 'selected' : '' }}>No</option>
								</select>
								<!-- <input type="text" name="extras[drum]" value="{{ $inspection->extras->drum }}"/> -->
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">BRAKE LINING: <span style=" float: right;">
								<select name="extras[break_plates]">
									<option value="0% OF LINING LEFT" {{ $inspection->extras->break_plates == '0 % OF LINING LEFT' ? 'selected' : '' }}>0 % OF LINING LEFT </option>
									<option value="DOES NOT APPLY" {{ $inspection->extras->break_plates == 'DOES NOT APPLY' ? 'selected' : '' }}>DOES NOT APPLY</option>
									<option value="DID NOT INSPECT" {{ $inspection->extras->break_plates == 'DID NOT INSPECT' ? 'selected' : '' }}>DID NOT INSPECT</option>
								</select>
								</span></p></td></tr>
							</table>
							<table style="width:100%">
								<tr> <td style="border: 1px solid gainsboro"><h4 style=" font-size: 14px;">Tires [Front]</h4></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Size: <span style=" float: right;">
								<input type="text" name="extras[tyre_size_f]" list="tyre_size_f" value="{{ $inspection->extras->tyre_size_f }}">
								<datalist id="tyre_size_f">
									<option value="17.5">
									<option value="19.5">
									<option value="22.5">
									<option value="24.5">
								</datalist>
								
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Wheels: <span style=" float: right;">
								<select name="extras[wheels]">
									<option value="ALUMINIUM" {{ $inspection->extras->wheels == 'ALUMINIUM' ? 'selected' : '' }}>ALUMINIUM </option>
									<option value="STEEL" {{ $inspection->extras->wheels == 'STEEL' ? 'selected' : '' }}>STEEL</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Detail: <span style=" float: right;"><input type="text" name="extras[detail_f]" value="{{ $inspection->extras->detail_f }}"/></span></p></td></tr>
							</table>
							<input type="hidden" name="extras[id]" value="{{ $inspection->extras->id}}" />
							
						</td>
						<td style="width:50%;vertical-align: baseline;">
							<table style="width:100%">
								<tr> <td style="border: 1px solid gainsboro"><h4 style="margin-top: 0; font-size: 14px;">Brakes</h4></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Steer Axle Brakes: <span style=" float: right;">LEFT <input type="text" name="inspectionTyre[steer_brake_left]" value="{{ $inspection->inspectionTyre->steer_brake_left }}"/>% RIGHT <input type="text" name="inspectionTyre[steer_brake_right]" value="{{ $inspection->inspectionTyre->steer_brake_right }}"/>% (1)</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Drive Axle Brakes: <span style=" float: right;">LEFT <input type="text" name="inspectionTyre[drive_axle_brake_left]" value="{{ $inspection->inspectionTyre->drive_axle_brake_left }}"/>% RIGHT<input type="text" name="inspectionTyre[drive_axle_brake_right]" value="{{ $inspection->inspectionTyre->drive_axle_brake_right }}"/>% (2)</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;"> &nbsp;<span style=" float: right;">(3)</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;"> &nbsp;<span style=" float: right;">(4)</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;"> &nbsp;<span style=" float: right;">(5)</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;"> &nbsp;<span style=" float: right;">(6)</span></p></td></tr>
								<input type="hidden" name="inspectionTyre[id]" value="{{ $inspection->inspectionTyre->id}}" />
								
							</table>
							<table style="width: 100%; border-collapse: collapse;">
								<tr> <td style="border: 1px solid gainsboro"><h4 style="margin-top: 0; font-size: 14px;">Tires [Rear]</h4></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Size <span style=" float: right;">
								<input type="text" name="extras[tyre_size_r]" list="tyre_size_r" value="{{ $inspection->extras->tyre_size_r }}">
								<datalist id="tyre_size_r">
									<option value="17.5">
									<option value="19.5">
									<option value="22.5">
									<option value="24.5">
								</datalist>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Wheels: <span style=" float: right;">
								<select name="extras[wheels]">
									<option value="ALUMINIUM" {{ $inspection->extras->wheels == 'ALUMINIUM' ? 'selected' : '' }}>ALUMINIUM </option>
									<option value="STEEL" {{ $inspection->extras->wheels == 'STEEL' ? 'selected' : '' }}>STEEL</option>
								</select>
								</span></p></td></tr>
								<tr> <td style="border: 1px solid gainsboro"><p style=" margin: 0;margin-bottom: 5px;font-size: 12px;">Detail: <span style=" float: right;"><input type="text" name="extras[detail_r]" value="{{ $inspection->extras->detail_r }}"/></span></p></td></tr>
							</table>
						</td>
					</tr>
				</table>
				
				<table style="width:100%;border:1px solid #ccc;margin-bottom:20px;margin-top:20px;">
					<tr>
						<th colspan="2">No of axle</th>	
					</tr>
					<tr>
						<td style="width:40%">
								<select name="inspectionTyreIncrease[no_of_axle]" style="width:100%;    margin-bottom: 10px !important;height: 30px;">
									<option value="1" {{ $inspection->inspectionTyre->no_of_axle == 1 ? 'selected' : '' }}>1</option>
									<option value="2" {{ $inspection->inspectionTyre->no_of_axle == 2 ? 'selected' : '' }}>2</option>
									<option value="3" {{ $inspection->inspectionTyre->no_of_axle == 3 ? 'selected' : '' }}>3</option>
									<option value="4" {{ $inspection->inspectionTyre->no_of_axle == 4 ? 'selected' : '' }}>4</option>
									<option value="5" {{ $inspection->inspectionTyre->no_of_axle == 5 ? 'selected' : '' }}>5</option>
									<option value="6" {{ $inspection->inspectionTyre->no_of_axle == 6 ? 'selected' : '' }}>6</option>
									<option value="7" {{ $inspection->inspectionTyre->no_of_axle == 7 ? 'selected' : '' }}>7</option>
									<option value="8" {{ $inspection->inspectionTyre->no_of_axle == 8 ? 'selected' : '' }}>8</option>
									<option value="9" {{ $inspection->inspectionTyre->no_of_axle == 9 ? 'selected' : '' }}>9</option>
								</select>
							<input type="hidden" name="inspectionTyreIncrease[id]" value="{{ $inspection->inspectionTyre->id }}"/>
							<input type="hidden" name="inspectionTyre[no_of_axle]" value="{{ $inspection->inspectionTyre->no_of_axle }}"/>
						</td>	
						<td>
							<button type="submit" onchange="this.form.submit()" style="background: red;border-color: red;box-shadow: none;padding: 2px 8px 4px 8px;border-radius: 32px;color: #fff;font-weight: bold;margin-bottom:10px;">Submit</button>
						</td>
					</tr>
				</table>	
				<table style="width:100%;border:1px solid #ccc;">
                    <tr> 
                        <td style="border: 1px solid gainsboro;font-size:13px;" colspan="2">STEER AXLE</td>
                        @for($i = 1; $i < $inspection->inspectionTyre->no_of_axle; $i++)
                            <td style="border: 1px solid gainsboro;font-size:13px;">DRIVE AXLE #{{$i}}</td>
                            @endfor
						</tr>
						
						<tr>
							<td style="border: 1px solid gainsboro;font-size:13px;">RIGHT</td>
							<td style="font-size:13px;"><input type="text" name="inspectionTyre[axl1]" value="{{ $inspection->inspectionTyre->axl1 }}"/><br><img src="https://codewithmithlesh.com/public/tiryer.png" alt="" /></td>
							@for($i = 1; $i < $inspection->inspectionTyre->no_of_axle; $i++)
								@php
								$key = $i+1;
								$key = 'axr'.$key;
								@endphp
								<td style="font-size:13px;"><input type="text" name="inspectionTyre[{{$key}}]" value="{{ $inspection->inspectionTyre->{$key} }}"/><br><img src="https://codewithmithlesh.com/public/tiryer.png" alt="" /></td>
								@endfor
							</tr>
							<tr><td colspan="{{$inspection->inspectionTyre->no_of_axle + 2}}" style="padding-top:25px;padding-bottom:25px;width:100%">
								<table style="width:100%">
									<tr>
										<td style="width:10%;font-size:13px;">FRONT</td>
										<td style="width:90%"><hr></td>
									</tr>
								</table>	
							</td></tr>
							<tr>
								<td style="border: 1px solid gainsboro;font-size:13px;">LEFT</td>
								<td style="font-size:13px;"><img src="https://codewithmithlesh.com/public/tiryer.png" alt="" /><br><input type="text" name="inspectionTyre[axr1]" value="{{ $inspection->inspectionTyre->axr1 }}"/></td>
								@for($i = 1; $i < $inspection->inspectionTyre->no_of_axle; $i++)
									@php
									$key = $i+1;
									$key = 'axl'.$key;
									@endphp
									<td style="font-size:13px;"><img src="https://codewithmithlesh.com/public/tiryer.png" alt="" /><br><input type="text" name="inspectionTyre[{{$key}}]" value="{{ $inspection->inspectionTyre->{$key} }}"/></td>
									@endfor
								</tr>	
							</table> 
							<section class="condition">
								<div class="condition_container" style=" margin-top: 10px;border: 1px solid gainsboro;font-size: 10px;padding-left: 5px; border-radius: 10px;">
									<span>Condition Report</span>
								</div>
							</section>
							<section class="comments_enginer_area mt-10" style=" margin-top: 10px;">
								<div class="comments_enginer_area_container">
									<table style=" border-collapse: collapse; width: 100%;" id="conditions">
										
										<tr>
											<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"></th>
											<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Engine Compartment Area</th>
											<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Comments</th>
											
										</tr>
										@php 
										$i=1;
										@endphp
										@foreach($inspection->conditions as $condition)
										<tr id="conditions_{{ $condition->id}}">
											<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">
											<select name="conditions[status][]" style="width:100%;margin-bottom:10px;">
												<option value="OK" {{ $condition->status == 'OK' ? 'selected' : '' }}>OK</option>
												<option value="Bad" {{ $condition->status == 'Bad' ? 'selected' : '' }}>Bad</option>
												<option value="Good" {{ $condition->status == 'Good' ? 'selected' : '' }}>Good</option>
											</select>
											</td>
											<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><input type="text" name="conditions[condition_name][]" value="{{ $condition->condition_name}}"/></td>
											<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><input type="text" name="conditions[condition_comments][]" value="{{ $condition->condition_comments}}"/>&nbsp;
												<span class="remove">
													@if(sizeof($inspection->conditions) > 1)
													<i class="fa fa-minus-circle" aria-hidden="true" style="font-size: 18px;color: red;margin-right: 10px;" onclick="removeItem('conditions',{{$condition->id}})"></i>
													@endif
												</span>
												<span class="add">
													@if($i == sizeof($inspection->conditions))
													<i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 18px;color: green;" onclick="addItem('conditions',{{$condition->id}})"></i>
													@endif
												</span>
											</td>
											<input type="hidden" name="conditions[id][]" value="{{ $condition->id}}" />
										</tr>
										@php $i++;
										@endphp
										@endforeach
										
									</table>
								</div>
							</section>  
							<section class="comments_enginer_area mt-10" style=" margin-top: 10px;">
								<div class="comments_enginer_area_container">
									<table style=" border-collapse: collapse; width: 100%;" id="operational">
										<tr>
											<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"></th>
											<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Operational Test</th>
											<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Comments</th>
											
										</tr>
										@php 
										$i=1;
										@endphp
										@foreach($inspection->operational as $item)
										<tr id="operational_{{ $item->id}}">
											<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">
											<select name="operational[status][]" style="width:100%;margin-bottom:10px;">
												<option value="OK" {{ $item->status == 'OK' ? 'selected' : '' }}>OK</option>
												<option value="Bad" {{ $item->status == 'Bad' ? 'selected' : '' }}>Bad</option>
												<option value="Good" {{ $item->status == 'Good' ? 'selected' : '' }}>Good</option>
											</select>
										</td>
											<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><input type="text" name="operational[condition_name][]" value="{{ $item->condition_name}}"/></td>
											<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><input type="text" name="operational[condition_comments][]" value="{{ $item->condition_comments}}"/>&nbsp;<span class="remove">
												@if(sizeof($inspection->operational) > 1)
												<i class="fa fa-minus-circle" aria-hidden="true" style="font-size: 18px;color: red;margin-right: 10px;" onclick="removeItem('operational',{{$item->id}})"></i>
												@endif
											</span>
											<span class="add">
												@if($i == sizeof($inspection->operational))
												<i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 18px;color: green;" onclick="addItem('operational',{{$item->id}})"></i>
												@endif
											</span>
											</td>
											<input type="hidden" name="operational[id][]" value="{{ $item->id}}" />
										</tr>
										@php $i++;
										@endphp
										@endforeach
										
									</table>
								</div>
							</section>   
							<section class="comments_enginer_area mt-10" style=" margin-top: 10px;">
								<div class="comments_enginer_area_container">
									<table style=" border-collapse: collapse; width: 100%;" id="incabInspectionTest">
										<tr>
											<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"></th>
											<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">In Cab Inspection</th>
											<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Comments</th>
											
										</tr>
										@php 
										$i=1;
										@endphp
										@foreach ($inspection->incabInspectionTest as $item_in_cab )
										<tr id="incabInspectionTest_{{ $item_in_cab->id}}">
											<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">
											<select name="incabInspectionTest[status][]" style="width:100%;margin-bottom:10px;">
												<option value="OK" {{ $item_in_cab->status == 'OK' ? 'selected' : '' }}>OK</option>
												<option value="Bad" {{ $item_in_cab->status == 'Bad' ? 'selected' : '' }}>Bad</option>
												<option value="Good" {{ $item_in_cab->status == 'Good' ? 'selected' : '' }}>Good</option>
											</select>
											</td>
											<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><input type="text" name="incabInspectionTest[condition_name][]" value="{{ $item_in_cab->condition_name}}"/></td>
											<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><input type="text" name="incabInspectionTest[condition_comments][]" value="{{ $item_in_cab->condition_comments}}"/>&nbsp;
												
												<span class="remove">
													@if(sizeof($inspection->incabInspectionTest) > 1)
													<i class="fa fa-minus-circle" aria-hidden="true" style="font-size: 18px;color: red;margin-right: 10px;" onclick="removeItem('incabInspectionTest',{{$item_in_cab->id}})"></i>
													@endif
												</span>
												
												<span class="add">
													@if($i == sizeof($inspection->incabInspectionTest))
													<i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 18px;color: green;" onclick="addItem('incabInspectionTest',{{$item_in_cab->id}})"></i>
													@endif
												</span>
											</td>
											<input type="hidden" name="incabInspectionTest[id][]" value="{{ $item_in_cab->id}}" />
										</tr>
										@php $i++;
										@endphp
										@endforeach
										
										
										
									</table>
								</div>
							</section>   
							<section class="comments_enginer_area mt-10" style=" margin-top: 10px;">
								<div class="comments_enginer_area_container">
									<table style=" border-collapse: collapse; width: 100%;" id="outsideInspection">
										<tr>
											<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"></th>
											<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Outside Inspection</th>
											<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Comments</th>
											
										</tr>
										@php 
										$i=1;
										@endphp
										@foreach ($inspection->outsideInspection as $inspectionOut)
										<tr id="outsideInspection_{{ $inspectionOut->id}}">
											<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">
											<select name="outsideInspection[status][]" style="width:100%;margin-bottom:10px;">
												<option value="OK" {{ $inspectionOut->status == 'OK' ? 'selected' : '' }}>OK</option>
												<option value="Bad" {{ $inspectionOut->status == 'Bad' ? 'selected' : '' }}>Bad</option>
												<option value="Good" {{ $inspectionOut->status == 'Good' ? 'selected' : '' }}>Good</option>
											</select>
											
											</td>
											<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><input type="text" name="outsideInspection[condition_name][]" value="{{$inspectionOut->condition_name}}"/></td>
											<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><input type="text" name="outsideInspection[condition_comments][]" value="{{$inspectionOut->condition_comments}}"/>&nbsp;
												<span class="remove">
													@if(sizeof($inspection->outsideInspection) > 1)
													<i class="fa fa-minus-circle" aria-hidden="true" style="font-size: 18px;color: red;margin-right: 10px;" onclick="removeItem('outsideInspection',{{$inspectionOut->id}})"></i>
													@endif
												</span>
												<span class="add">
													@if($i == sizeof($inspection->outsideInspection))
													<i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 18px;color: green;" onclick="addItem('outsideInspection',{{$inspectionOut->id}})"></i>
													@endif
												</span>
											</td>
											<input type="hidden" name="outsideInspection[id][]" value="{{ $inspectionOut->id}}" />
										</tr>
										@php $i++;
										@endphp
										@endforeach
										
									</table>
								</div>
							</section>     
							<section class="comments_enginer_area mt-10" style=" margin-top: 10px;">
								<div class="comments_enginer_area_container">
									<table style=" border-collapse: collapse; width: 100%;" id="underInspection">
										<tr>
											<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"></th>
											<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Under Vehicle Inspection</th>
											<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Comments</th>
											
										</tr>
										@php 
										$i=1;
										@endphp
										@foreach ($inspection->underInspection as $underInspection)
										<tr id="underInspection_{{ $underInspection->id}}">
											<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">
											<select name="underInspection[status][]" style="width:100%;margin-bottom:10px;">
												<option value="OK" {{ $underInspection->status == 'OK' ? 'selected' : '' }}>OK</option>
												<option value="Bad" {{ $underInspection->status == 'Bad' ? 'selected' : '' }}>Bad</option>
												<option value="Good" {{ $underInspection->status == 'Good' ? 'selected' : '' }}>Good</option>
											</select>
											</td>
											<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><input type="text" name="underInspection[condition_name][]" value="{{$underInspection->condition_name}}"/></td>
											<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><input type="text" name="underInspection[condition_comments][]" value="{{$underInspection->condition_comments}}"/>&nbsp;
												<span class="remove">
													@if(sizeof($inspection->underInspection) > 1)
													<i class="fa fa-minus-circle" aria-hidden="true" style="font-size: 18px;color: red;margin-right: 10px;" onclick="removeItem('underInspection',{{$underInspection->id}})"></i>
													@endif
												</span>
												<span class="add">
													@if($i == sizeof($inspection->underInspection))
													<i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 18px;color: green;" onclick="addItem('underInspection',{{$underInspection->id}})"></i>
													@endif
												</span>
											</td>
											<input type="hidden" name="underInspection[id][]" value="{{ $underInspection->id}}" />
										</tr>
										@php $i++;
										@endphp
										@endforeach
										
									</table>
								</div>
							</section>  
							<section class="comments_enginer_area mt-10" style=" margin-top: 10px;">
								<div class="comments_enginer_area_container">
									<table style=" border-collapse: collapse; width: 100%;" id="tyreInspectionTest">
										<tr>
											<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"></th>
											<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Tires/Wheels/Brakes</th>
											<th style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">Comments</th>
											
										</tr>
										@php 
										$i=1;
										@endphp
										@foreach ($inspection->tyreInspectionTest as $tyreIns )
										<tr id="tyreInspectionTest_{{ $tyreIns->id}}">
											<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">
											<select name="tyreInspectionTest[status][]" style="width:100%;margin-bottom:10px;">
												<option value="OK" {{ $tyreIns->status == 'OK' ? 'selected' : '' }}>OK</option>
												<option value="Bad" {{ $tyreIns->status == 'Bad' ? 'selected' : '' }}>Bad</option>
												<option value="Good" {{ $tyreIns->status == 'Good' ? 'selected' : '' }}>Good</option>
											</select>
											</td>
											<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><input type="text" name="tyreInspectionTest[condition_name][]" value="{{$tyreIns->condition_name}}"/></td>
											<td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><input type="text" name="tyreInspectionTest[condition_comments][]" value="{{$tyreIns->condition_comments}}"/>&nbsp;
												
												<span class="remove">
													@if(sizeof($inspection->tyreInspectionTest) > 1)	
													<i class="fa fa-minus-circle" aria-hidden="true" style="font-size: 18px;color: red;margin-right: 10px;" onclick="removeItem('tyreInspectionTest',{{$tyreIns->id}})"></i>
													@endif
												</span>
												<span class="add">
													@if($i == sizeof($inspection->tyreInspectionTest))
													<i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 18px;color: green;" onclick="addItem('tyreInspectionTest',{{$tyreIns->id}})"></i>
													@endif
												</span>
											</td>
											<input type="hidden" name="tyreInspectionTest[id][]" value="{{ $tyreIns->id}}" />
										</tr>
										@php $i++;
										@endphp
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
							<section class="worksheet mt-10" style=" margin-top: 10px;">
								<div class="worksheet_container">
									<p>RECONDITIONING AND SUPPLEMENTAL ESTIMATE</p>
									
								</div>
							</section>  
							<section class="recommendation mt-10" style=" margin-top: 10px;">
								<table style=" border-collapse: collapse; width: 100%;" id="estimates">
									<thead>
										<tr>
											<td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">ITEM</td>
											<td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">DESCRIPTION / COMMENTS </td>
											<td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">PART COST ($) </td>
											<td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;">LABOR COST ($) </td>
										</tr>
									</thead>
									<tbody>
										@php
										$t_part = 0;
										$t_laber = 0;
										@endphp
										@php 
										$i=1;
										@endphp
										@foreach($inspection->estimates as $estimate)
										@php
										$t_part = $t_part + $estimate->t_part_cost;
										$t_laber = $t_laber + $estimate->t_labor_cost;
										@endphp
										<tr id="estimates_{{ $estimate->id}}">
											<td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><input type="text" name="estimates[item_name][]" value="{{$estimate->item_name}}"/></td>
											<td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><input type="text" name="estimates[desciption][]" value="{{$estimate->desciption}}"/></td>
											<td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><input type="number" name="estimates[item_cost][]" value="{{$estimate->item_cost}}"/></td>
											<td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><input type="number" name="estimates[labor_cost][]" value="{{$estimate->labor_cost}}"/>&nbsp;
												<span class="remove">
													@if(sizeof($inspection->estimates) > 1)
													<i class="fa fa-minus-circle" aria-hidden="true" style="font-size: 18px;color: red;margin-right: 10px;" onclick="removeItemestimates('estimates',{{$estimate->id}})"></i>
													@endif
												</span>
												<span class="add">
													@if($i == sizeof($inspection->estimates))
													<i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 18px;color: green;" onclick="addItemestimates('estimates',{{$estimate->id}})"></i>
													@endif
												</span>
											</td>
											<input type="hidden" name="estimates[id][]" value="{{ $estimate->id}}" />
										</tr>
										@php $i++;
										@endphp
										@endforeach
										
									</tbody>
								</table>
							</section> 
							<section class="worksheet mt-10" style=" margin-top: 10px;">
								<div class="worksheet_container">
									<p>COMMENTS:</p>
								</div>
							</section>   
							<section class="section_image mt-10" style=" margin-top: 10px;">
								<div class="image_container" style="display: block; justify-content: center;">
									<div class="grid col-lg-4 gap4" style=" display: inline-block;width:100%" id="conditions_bottom">
										@php 
										$i=1;
										@endphp
										@foreach($inspection->conditions as $condition)
										
										<div id="conditions_bottom_{{$condition->id}}" class="parent_div" style=" text-align: center; border: 1px solid #dddddd; margin-bottom: 10px;width:25%;float:left">
											<img src="{{$condition->inspection_img}}" alt="Placeholder Image 1" style="width: 100%;  height: 279px;min-height: 250px;" >
											<input type="file" name="conditions_bottom_inspection_img_{{$condition->id}}"  id="conditions_bottom_image_{{ $condition->id}}" style="display:none;"/>
											
											
											
											<p style="margin: 0;    min-height: 77px;"><input type="text" name="conditions_bottom[condition_name][]" value="{{$condition->condition_name}}" style="margin-top: 30px;"/></p>
											<input type="hidden" name="conditions_bottom[status][]" value="{{ $condition->status}}" />
											<input type="hidden" name="conditions_bottom[condition_comments][]" value="{{ $condition->condition_comments}}" />
											<input type="hidden" name="conditions_bottom[inspection_img][]" value="{{ $condition->inspection_img}}" />
											<input type="hidden" name="conditions_bottom[id][]" value="{{ $condition->id}}" />
											<input type="hidden" name="conditions_bottom[image_id][]" value="{{ $condition->id}}" />
											<div class="action_section">
												<span class="remove">
													@if(sizeof($inspection->conditions) > 1)
													
													@endif
												</span>
												<span class="add">
													@if($i == sizeof($inspection->conditions))
													
													@endif
												</span>
												<span class="edit">
													<i class="fa fa-pencil-square" aria-hidden="true" onclick="chnageImageSection('conditions_bottom',{{ $condition->id}})" style="font-size: 18px;color: green;"></i>
												</span>
											</div>
										</div>
										@php $i++;
										@endphp
										@endforeach

										@php 
										$i=1;
										@endphp
										@foreach($inspection->operational as $condition)
										
										<div id="operational_bottom_{{$condition->id}}" class="parent_div" style=" text-align: center; border: 1px solid #dddddd; margin-bottom: 10px;width:25%;float:left">
											<img src="{{$condition->inspection_img}}" alt="Placeholder Image 1" style="width: 100%;  height: 279px;min-height: 250px;" >
											<input type="file" name="operational_bottom_inspection_img_{{$condition->id}}"  id="operational_bottom_image_{{ $condition->id}}" style="display:none;"/>
											
											
											
											<p style="margin: 0;    min-height: 77px;"><input type="text" name="operational_bottom[condition_name][]" value="{{$condition->condition_name}}" style="margin-top: 30px;"/></p>
											<input type="hidden" name="operational_bottom[status][]" value="{{ $condition->status}}" />
											<input type="hidden" name="operational_bottom[condition_comments][]" value="{{ $condition->condition_comments}}" />
											<input type="hidden" name="operational_bottom[inspection_img][]" value="{{ $condition->inspection_img}}" />
											<input type="hidden" name="operational_bottom[id][]" value="{{ $condition->id}}" />
											<input type="hidden" name="operational_bottom[image_id][]" value="{{ $condition->id}}" />
											<div class="action_section">
												<span class="remove">
													@if(sizeof($inspection->operational) > 1)
													
													@endif
												</span>
												<span class="add">
													@if($i == sizeof($inspection->operational))
													
													@endif
												</span>
												<span class="edit">
													<i class="fa fa-pencil-square" aria-hidden="true" onclick="chnageImageSection('operational_bottom',{{ $condition->id}})" style="font-size: 18px;color: green;"></i>
												</span>
											</div>
										</div>
										@php $i++;
										@endphp
										@endforeach

										@php 
										$i=1;
										@endphp
										@foreach($inspection->incabInspectionTest as $condition)
										
										<div id="incabInspectionTest_bottom_{{$condition->id}}" class="parent_div" style=" text-align: center; border: 1px solid #dddddd; margin-bottom: 10px;width:25%;float:left">
											<img src="{{$condition->inspection_img}}" alt="Placeholder Image 1" style="width: 100%;  height: 279px;min-height: 250px;" >
											<input type="file" name="incabInspectionTest_bottom_inspection_img_{{$condition->id}}"  id="incabInspectionTest_bottom_image_{{ $condition->id}}" style="display:none;"/>
											
											
											
											<p style="margin: 0;    min-height: 77px;"><input type="text" name="incabInspectionTest_bottom[condition_name][]" value="{{$condition->condition_name}}" style="margin-top: 30px;"/></p>
											<input type="hidden" name="incabInspectionTest_bottom[status][]" value="{{ $condition->status}}" />
											<input type="hidden" name="incabInspectionTest_bottom[condition_comments][]" value="{{ $condition->condition_comments}}" />
											<input type="hidden" name="incabInspectionTest_bottom[inspection_img][]" value="{{ $condition->inspection_img}}" />
											<input type="hidden" name="incabInspectionTest_bottom[id][]" value="{{ $condition->id}}" />
											<input type="hidden" name="incabInspectionTest_bottom[image_id][]" value="{{ $condition->id}}" />
											<div class="action_section">
												<span class="remove">
													@if(sizeof($inspection->incabInspectionTest) > 1)
													
													@endif
												</span>
												<span class="add">
													@if($i == sizeof($inspection->incabInspectionTest))
													
													@endif
												</span>
												<span class="edit">
													<i class="fa fa-pencil-square" aria-hidden="true" onclick="chnageImageSection('incabInspectionTest_bottom',{{ $condition->id}})" style="font-size: 18px;color: green;"></i>
												</span>
											</div>
										</div>
										@php $i++;
										@endphp
										@endforeach

										@php 
										$i=1;
										@endphp
										@foreach($inspection->outsideInspection as $condition)
										
										<div id="outsideInspection_bottom_{{$condition->id}}" class="parent_div" style=" text-align: center; border: 1px solid #dddddd; margin-bottom: 10px;width:25%;float:left">
											<img src="{{$condition->inspection_img}}" alt="Placeholder Image 1" style="width: 100%;  height: 279px;min-height: 250px;" >
											<input type="file" name="outsideInspection_bottom_inspection_img_{{$condition->id}}"  id="outsideInspection_bottom_image_{{ $condition->id}}" style="display:none;"/>
											
											
											
											<p style="margin: 0;    min-height: 77px;"><input type="text" name="outsideInspection_bottom[condition_name][]" value="{{$condition->condition_name}}" style="margin-top: 30px;"/></p>
											<input type="hidden" name="outsideInspection_bottom[status][]" value="{{ $condition->status}}" />
											<input type="hidden" name="outsideInspection_bottom[condition_comments][]" value="{{ $condition->condition_comments}}" />
											<input type="hidden" name="outsideInspection_bottom[inspection_img][]" value="{{ $condition->inspection_img}}" />
											<input type="hidden" name="outsideInspection_bottom[id][]" value="{{ $condition->id}}" />
											<input type="hidden" name="outsideInspection_bottom[image_id][]" value="{{ $condition->id}}" />
											<div class="action_section">
												<span class="remove">
													@if(sizeof($inspection->outsideInspection) > 1)
													
													@endif
												</span>
												<span class="add">
													@if($i == sizeof($inspection->outsideInspection))
													
													@endif
												</span>
												<span class="edit">
													<i class="fa fa-pencil-square" aria-hidden="true" onclick="chnageImageSection('outsideInspection_bottom',{{ $condition->id}})" style="font-size: 18px;color: green;"></i>
												</span>
											</div>
										</div>
										@php $i++;
										@endphp
										@endforeach

										@php 
										$i=1;
										@endphp
										@foreach($inspection->underInspection as $condition)
										
										<div id="underInspection_bottom_{{$condition->id}}" class="parent_div" style=" text-align: center; border: 1px solid #dddddd; margin-bottom: 10px;width:25%;float:left">
											<img src="{{$condition->inspection_img}}" alt="Placeholder Image 1" style="width: 100%;  height: 279px;min-height: 250px;" >
											<input type="file" name="underInspection_bottom_inspection_img_{{$condition->id}}"  id="underInspection_bottom_image_{{ $condition->id}}" style="display:none;"/>
											
											
											
											<p style="margin: 0;    min-height: 77px;"><input type="text" name="underInspection_bottom[condition_name][]" value="{{$condition->condition_name}}" style="margin-top: 30px;"/></p>
											<input type="hidden" name="underInspection_bottom[status][]" value="{{ $condition->status}}" />
											<input type="hidden" name="underInspection_bottom[condition_comments][]" value="{{ $condition->condition_comments}}" />
											<input type="hidden" name="underInspection_bottom[inspection_img][]" value="{{ $condition->inspection_img}}" />
											<input type="hidden" name="underInspection_bottom[id][]" value="{{ $condition->id}}" />
											<input type="hidden" name="underInspection_bottom[image_id][]" value="{{ $condition->id}}" />
											<div class="action_section">
												<span class="remove">
													@if(sizeof($inspection->underInspection) > 1)
													
													@endif
												</span>
												<span class="add">
													@if($i == sizeof($inspection->underInspection))
													
													@endif
												</span>
												<span class="edit">
													<i class="fa fa-pencil-square" aria-hidden="true" onclick="chnageImageSection('underInspection_bottom',{{ $condition->id}})" style="font-size: 18px;color: green;"></i>
												</span>
											</div>
										</div>
										@php $i++;
										@endphp
										@endforeach


										@php 
										$i=1;
										@endphp
										@foreach($inspection->tyreInspectionTest as $condition)
										
										<div id="tyreInspectionTest_bottom_{{$condition->id}}" class="parent_div" style=" text-align: center; border: 1px solid #dddddd; margin-bottom: 10px;width:25%;float:left">
											<img src="{{$condition->inspection_img}}" alt="Placeholder Image 1" style="width: 100%;  height: 279px;min-height: 250px;" >
											<input type="file" name="tyreInspectionTest_bottom_inspection_img_{{$condition->id}}"  id="tyreInspectionTest_bottom_image_{{ $condition->id}}" style="display:none;"/>
											
											
											
											<p style="margin: 0;    min-height: 77px;"><input type="text" name="tyreInspectionTest_bottom[condition_name][]" value="{{$condition->condition_name}}" style="margin-top: 30px;"/></p>
											<input type="hidden" name="tyreInspectionTest_bottom[status][]" value="{{ $condition->status}}" />
											<input type="hidden" name="tyreInspectionTest_bottom[condition_comments][]" value="{{ $condition->condition_comments}}" />
											<input type="hidden" name="tyreInspectionTest_bottom[inspection_img][]" value="{{ $condition->inspection_img}}" />
											<input type="hidden" name="tyreInspectionTest_bottom[id][]" value="{{ $condition->id}}" />
											<input type="hidden" name="tyreInspectionTest_bottom[image_id][]" value="{{ $condition->id}}" />
											<div class="action_section">
												<span class="remove">
													@if(sizeof($inspection->tyreInspectionTest) > 1)
													
													@endif
												</span>
												<span class="add">
													@if($i == sizeof($inspection->tyreInspectionTest))
													
													@endif
												</span>
												<span class="edit">
													<i class="fa fa-pencil-square" aria-hidden="true" onclick="chnageImageSection('tyreInspectionTest_bottom',{{ $condition->id}})" style="font-size: 18px;color: green;"></i>
												</span>
											</div>
										</div>
										@php $i++;
										@endphp
										@endforeach
									</div>
								</div>
							</section>  
							<button type="submit" onchange="this.form.submit()" style="background: red;border-color: red;box-shadow: none;padding: 2px 8px 4px 8px;border-radius: 32px;color: #fff;font-weight: bold;margin-bottom:10px;">Submit</button>
						</form>
					</div>
				</div>
				
				
			</div>
			@endsection
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			<script>
				function addItem(section,numberrow)
				{
					
					numberrow = Number(numberrow)+1;
					$('#'+section+' tr .add').html('');
					let str='<tr id="'+section+'_'+numberrow+'"><td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><select name="'+section+'[status][]" style="width:100%;margin-bottom:10px;"><option value="OK">OK</option><option value="Bad">Bad</option><option value="Good">Good</option></select></td><td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><input type="text" name="'+section+'[condition_name][]" value=""/></td><td style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><input type="text" name="'+section+'[condition_comments][]" value=""/>&nbsp;&nbsp;<span class="remove"><i class="fa fa-minus-circle" aria-hidden="true" style="font-size: 18px;color: red;margin-right: 10px;" onclick="removeItem(`'+section+'`,'+numberrow+')"></i></span></span><span class="add"><i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 18px;color: green;" onclick="addItem(`'+section+'`,'+numberrow+')"></i></span></td><input type="hidden" name="'+section+'[id][]" value="0" /></tr>';
					$('#'+section).append(str);
				}
				
				function removeItem(section,numberrow)
				{
					var rowCount = $('#'+section).find("tr").length-2;
					console.log(rowCount);
					if(rowCount >= 1)
					{
						let previous = Number(numberrow)-1;
						$('#'+section+'_'+numberrow).remove();
						//$('#'+section+'_'+previous+' .add').html('<i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 18px;color: green;" onclick="addItem(`'+section+'`,'+previous+')"></i>');
						$('#'+section+' tr:last .add').html('<i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 18px;color: green;" onclick="addItem(`'+section+'`,'+previous+')"></i>');
					}

					if(section == 'conditions')
					{
						removeCondiondtion(numberrow);
					}
					
				}
				
				function addItemestimates(section,numberrow)
				{
					
					numberrow = Number(numberrow)+1;
					$('#'+section+' tr .add').html('');
					let str='<tr id="'+section+'_'+numberrow+'"><td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><input type="text" name="'+section+'[item_name][]" value=""/></td><td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><input type="text" name="'+section+'[desciption][]" value=""/></td><td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><input type="number" name="'+section+'[item_cost][]" value=""/></td><td  style="border: 1px solid #dddddd; text-align: left;padding: 5px;font-size: 12px;"><input type="number" name="'+section+'[labor_cost][]" value=""/>&nbsp;<span class="remove"><i class="fa fa-minus-circle" aria-hidden="true" style="font-size: 18px;color: red;margin-right: 10px;" onclick="removeItemestimates(`'+section+'`,'+numberrow+')"></i></span><span class="add"><i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 18px;color: green;" onclick="addItemestimates(`'+section+'`,'+numberrow+')"></i></span></td><input type="hidden" name="'+section+'[id][]" value="0" /></tr>';
					$('#'+section).append(str);
				}
				
				function removeItemestimates(section,numberrow)
				{
					var rowCount = $('#'+section).find("tr").length-2;
					console.log(rowCount);
					if(rowCount >= 1)
					{
						let previous = Number(numberrow)-1;
						$('#'+section+'_'+numberrow).remove();
						//$('#'+section+'_'+previous+' .add').html('<i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 18px;color: green;" onclick="addItem(`'+section+'`,'+previous+')"></i>');
						$('#'+section+' tr:last .add').html('<i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 18px;color: green;" onclick="addItemestimates(`'+section+'`,'+previous+')"></i>');
					}
					
				}
				
				function addImageCondition(section,numberrow)
				{
					
					numberrow = Number(numberrow)+1;
					$('#'+section+' .action_section .add').html('');
					let str='<div id="'+section+'_'+numberrow+'" style=" text-align: center; border: 1px solid #dddddd; margin-bottom: 10px;width:25%;float:left"><div style="min-height: 285px;"><input type="file" name="'+section+'_inspection_img_'+numberrow+'"  style="text-align: center;width: 200px;margin: 0 auto;padding-top: 100px;"/></div><p style="margin: 0;    min-height: 77px;"><input type="text" name="'+section+'[condition_name][]" value="" style="margin-left: 30px;margin-top:30px;"/></p><input type="hidden" name="'+section+'[id][]" value="0" /><input type="hidden" name="'+section+'[image_id][]" value="'+numberrow+'" /><div class="action_section"><span class="remove"><i class="fa fa-minus-circle" aria-hidden="true" style="font-size: 18px;color: red;margin-right: 10px;" onclick="removeImageCondioion(`'+section+'`,'+numberrow+')"></i></span><span class="add"><i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 18px;color: green;" onclick="addImageCondition(`'+section+'`,'+numberrow+')"></i></span></div></div>';
					$('#'+section).append(str);
				}
				
				function removeImageCondioion(section,numberrow)
				{
					var rowCount = $('#'+section).find("div.parent_div").length;
					console.log(rowCount);
					if(rowCount >= 1)
					{
						let previous = Number(numberrow)-1;
						$('#'+section+'_'+numberrow).remove();
						//$('#'+section+'_'+previous+' .add').html('<i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 18px;color: green;" onclick="addItem(`'+section+'`,'+previous+')"></i>');
						$('#'+section+' div:last .add').html('<i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 18px;color: green;" onclick="addImageCondition(`'+section+'`,'+previous+')"></i>');
					}
					
				}
				
				function chnageImageSection(section,numberrow)
				{
					$('#'+section+'_image_'+numberrow).click();
				}

				

				function removeCondiondtion(condition_id)
				{
					var csrfToken = $('meta[name="csrf-token"]').attr('content');
					// Make AJAX request
					$.ajax({
								url: '{{ route('removeCondition') }}',
								type: 'POST',
								data: {
									condition_id: condition_id
								},
								headers: {
									'X-CSRF-TOKEN': csrfToken
								},
								success: function(response) {
									// Handle the success response here
									console.log(response);
									if(response.success)
									{
										$('#conditions_bottom_'+condition_id).remove();
										$('#conditions_'+condition_id).remove();
									}
								},
								error: function(xhr) {
									// Handle any errors here
									console.log(xhr.responseText);
								}
							});
				}

				</script>
			</script>					
			<style>
				.action_section{
				position: relative;
				top: -345px;
				float: right;
				right: 9px;
				}
				select{
					height:21px;
					margin-bottom: 0px !important;
				}
			</style>			