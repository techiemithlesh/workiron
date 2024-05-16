<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InspectionDetail;
use App\Models\InspectionChecklist;
use App\Models\Condition;
use App\Models\Extra;
use App\Models\InspectionImage;
use App\Models\InspectionTyre;
use App\Models\Misslenous;
use App\Models\Estimates;
use App\Models\InspectionInCab;
use App\Models\InspectionOperationalTest;
use App\Models\InspectionOutside;
use App\Models\TyreInspectionTest;
use App\Models\UnderVehicleInspectionTest;
use Illuminate\Support\Str;
use PDF;
use URL;
use Illuminate\Support\Facades\Storage;

class InspectionController extends Controller
{
    public function submitInspection(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'inspection_details.inspection_date' => 'required|string',
            'equipment_information.vehicle_no' => 'nullable|string',
            'equipment_information.vin_no' => 'nullable|integer',
            'equipment_information.meater_reading' => 'nullable|integer',
            'equipment_information.ecm_reading' => 'required|integer',
            'equipment_information.ecm_hours' => 'required|integer',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->getMessages() as $key => $msg) {
                $errors[$key] = $msg[0];
            }
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = $errors;

            return response()->json($return, 422);
        }

        $user = Auth::guard('api')->user();
        $requestData = $request->all();

        $detailsData = array_merge($requestData['inspection_details'], $requestData['equipment_information']);

        $details = new InspectionDetail();
        $details->fill($detailsData);
        $details->inspector_name = $user->name;
        $details->user_id = $user->id;
        $details->report_no = uniqid();
        $details->save();
        $details->report_no = sprintf("WR" . "%06d", $details->id);
        $details->save();

        foreach ($requestData['inspection_checklis'] as $checklistData) {
            $checklist = new InspectionChecklist();
            $checklist->name = $checklistData['field'];
            $checklist->note = $checklistData['values']['note'];
            $checklist->good = $checklistData['values']['good'];
            $checklist->repair = $checklistData['values']['repair'];
            $checklist->replace = $checklistData['values']['replace'];
            $checklist->na = $checklistData['values']['na'];
            $checklist->images = implode(",", $checklistData['values']['images']);
            $checklist->inspection_detail_id = $details->id;
            $checklist->save();
        }

        $details->load('checklist');

        $folderPath = 'public/reports/' . $details->user->id;
        $fileName = 'inspection_report_' . $details->report_no . '.pdf';

        $images = InspectionChecklist::where(['inspection_detail_id' => $details->id])
            ->where('images', '!=', "")
            ->whereNotNull('images')->get();

        $pdf = PDF::loadView('inspection-report', ['data' => $details, 'images' => $images]);
        $pdf->setPaper('a4');

        $content = $pdf->download()->getOriginalContent();
        Storage::put($folderPath . "/" . $fileName, $content);

        return response()->json([
            'status' => 'success',
            'data' => $details,
            'report_url' => env('APP_URL') . '/storage/reports/' . $user->id . '/inspection_report_' . $details->report_no . '.pdf'
        ]);
    }

    // API FOR GET INSPECTION DATA
    public function getInspectionsDetails($id)
    {
        if ($id == '' || !isset($id)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Inspection id required.'
            ]);
        }

        $inspection_id = $id;

        $inspection = InspectionDetail::where(['id' => $inspection_id])->with(['user', 'conditions', 'extras', 'inspectionTyre', 'misslenous', 'operational', 'incabInspectionTest', 'outsideInspection', 'underInspection', 'tyreInspectionTest', 'estimates'])->firstOrFail();

        return response()->json([
            'status' => 'success',
            'inspectionData' => $inspection
        ]);
    }

    // API FOR UPDATE INSPECTION DATA
    public function updateInspectionsDetails(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'inspection_details.user_id' => 'required|integer',
            'inspection_details.vehicle_type' => 'required|string',
            'inspection_details.location' => 'required',
            'inspection_details.inspection_date' => 'required',
            'inspection_details.inspector_name' => 'required',
            'inspection_details.fleet_no' => 'required|integer',
            'inspection_details.unit_number' => 'required',
            'inspection_details.vin_no' => 'required',
            'inspection_details.po_no' => 'required|integer',
            'inspection_details.model_year' => 'integer',
            'inspection_details.engine_serial' => 'numeric',
            'inspection_details.engine_hp' => 'numeric',
            'inspection_details.cruise' => 'in:YES,NO,DOES NOT APPLY',
            'inspection_details.clean_air_idle' => 'in:YES,NO,DOES NOT APPLY',
            'inspection_details.ov_length' => 'regex:/^[a-zA-Z0-9\s]+$/',
            'inspection_details.ov_width' => 'regex:/^[a-zA-Z0-9\s]+$/',
            'inspection_details.ov_height' => 'regex:/^[a-zA-Z0-9\s]+$/',
            'inspection_details.odometer' => 'numeric',
            'inspection_details.hub_odometer' => 'numeric',
            'inspection_details.ecu_hp' => 'numeric',
            'inspection_details.fuel' => 'in:DIESEL,GASOLINE,CNG,ELECTRIC VEHICLE,OTHER',
            'inspection_details.ecu_miles' => 'numeric',
            'inspection_details.air_horns' => 'integer',
            'inspection_details.mirrors' => 'integer',
            'inspection_details.wheelbase' => 'regex:/^[a-zA-Z0-9\s]+$/',
            'inspection_details.rear_ratio' => 'numeric',
            'inspection_details.f_axle_measure' => 'in:lbs,kg',
            'inspection_details.r_axle' => 'numeric',
            'inspection_details.r_axle_measure' => 'in:lbs,kg',
            'inspection_details.gvwr' => 'numeric',
            'inspection_details.gvwr_measure' => 'in:lbs,kg',
            'inspection_details.suspension' => 'in:AIR,SPRING',
            'inspection_details.tag_axie_capacity' => 'integer',
            'inspection_details.rear_axie_model' => 'integer',
            'inspection_details.trans_make' => 'nullable|regex:/^[a-zA-Z0-9\s]+$/',
            'inspection_details.trans_model' => 'nullable|regex:/^[a-zA-Z0-9\s]+$/',
            'inspection_details.trans_speed' => 'regex:/^[a-zA-Z0-9\s]+$/',
            'inspection_details.independent_suspension' => 'integer',
            'inspection_details.full_coach_suspension' => 'integer',
            'inspection_details.tag_axie_unloading' => 'integer',
            'inspection_details.tag_axie_unloading' => 'integer',
            'inspection_details.powr_steering' => 'integer',
            'extras.abs' => 'integer',
            'extras.hyd' => 'integer',
            'extras.air' => 'integer',
            'extras.disk' => 'integer',
            'extras.drum' => 'integer',
            'extras.break_plates' => 'in:0 % OF LINING LEFT,DOES NOT APPLY,DID NOT INSPECT',
            'extras.wheels' => 'in:ALUMINIUM,STEEL',
            'extras.tyre_size_f' => 'regex:/^[a-zA-Z0-9\s]+$/',
            'extras.tyre_size_r' => 'regex:/^[a-zA-Z0-9\s]+$/',
            'extras.detail_f' => 'string',
            'inspection_tyre.no_of_axle' => 'integer',
            'inspection_tyre.steer_brake_left' => 'integer',
            'inspection_tyre.steer_brake_right' => 'integer',
            'inspection_tyre.drive_axle_brake_left' => 'integer',
            'inspection_tyre.drive_axle_brake_right' => 'integer',
            'misslenous.elect_eng_control' => 'integer',
            'misslenous.full_gause' => 'integer',
            'misslenous.wraparound' => 'integer',
            'misslenous.power_mirror' => 'integer',
            'misslenous.tilt' => 'integer',
            'misslenous.air_ride' => 'integer',
            'misslenous.restroom' => 'integer',
            'misslenous.pa_syst' => 'integer',
            'misslenous.aud_vid_syst' => 'integer',
            'misslenous.video_m_no' => 'integer',
            'misslenous.cd_charger' => 'integer',
            'misslenous.ind_aud_syst' => 'integer',
            'misslenous.gps' => 'integer',
            'misslenous.satelite_tv_syst' => 'integer',
            'misslenous.road_viewing_m_syst' => 'integer',
            'misslenous.under_floor' => 'integer',
            'misslenous.parcel_rack' => 'integer',
            'misslenous.tracon_control' => 'integer',
            'misslenous.sun_visors' => 'integer',
            'misslenous.tour_guide_seat' => 'integer',
            'misslenous.other' => 'integer',
            'misslenous.unit_driven_in' => 'integer',
            'misslenous.jump_started' => 'integer',
            'misslenous.unit_tower_in' => 'integer',
            'misslenous.unit_start_run' => 'integer',
            'misslenous.unit_condition' => 'in:EXCELLENT,GOOD,FAIR',
            'misslenous.seating_capacity' => 'regex:/^[a-zA-Z0-9\s]+$/',
            'inspectionincabs.status' => 'in:OK,Bad,Good,N/A',
            'inspectionoutsides.status' => 'in:OK,Bad,Good,N/A',
            'tyreinspectiontests.status' => 'in:OK,Bad,Good,N/A',
            'undervehicleinspectiontests.status' => 'in:OK,Bad,Good,N/A',
            'status.status' => 'in:OK,Bad,Good,N/A',

        ], [
            'in' => 'The :attribute must be one of the following: :values.',
            'regex' => 'The :attribute must contain only letters, numbers, and spaces.',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->getMessages() as $key => $msg) {
                $errors[$key] = $msg[0];
            }
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = $errors;

            return response()->json($return, 422);
        }
        $requestData = $request->all();
        $conditionDatas = array_merge($requestData['conditions']);

        if (sizeof($conditionDatas) == 0) {
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = 'Please enter any one condtions';

            return response()->json($return, 422);
        }

        $estimatesDatas = array_merge($requestData['estimates']);
        if (sizeof($estimatesDatas) == 0) {
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = 'Please enter any one estimate';

            return response()->json($return, 422);
        }

        $incab_inspection_testDatas = array_merge($requestData['incab_inspection_test']);

        if (sizeof($incab_inspection_testDatas) == 0) {
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = 'Please enter any one inspection in cab data';

            return response()->json($return, 422);
        }

        $operationalDatas = array_merge($requestData['operational']);

        if (sizeof($operationalDatas) == 0) {
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = 'Please enter any one inspection operional data';

            return response()->json($return, 422);
        }

        $outside_inspectionDats = array_merge($requestData['outside_inspection']);

        if (sizeof($outside_inspectionDats) == 0) {
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = 'Please enter any one inspection outside data';

            return response()->json($return, 422);
        }

        $tyre_inspection_testDatas = array_merge($requestData['tyre_inspection_test']);

        if (sizeof($tyre_inspection_testDatas) == 0) {
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = 'Please enter any one tyre inspection data';

            return response()->json($return, 422);
        }

        $under_inspectionDatas = array_merge($requestData['under_inspection']);
        if (sizeof($under_inspectionDatas) == 0) {
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = 'Please enter any one under vehicle inspection data';

            return response()->json($return, 422);
        }

        // UPDATE INSPECTION DATA
        $detailsData = array_merge($requestData['inspection_details']);

        $inspection_id = $detailsData['id'];

        $inspectionDetail = InspectionDetail::find($inspection_id);

        // Update the attributes
        $inspectionDetail->fill($detailsData);
        $inspectionDetail->save();

        // UPDATE CONDITION DATA

        foreach ($conditionDatas as $conditionData) {
            $condtion_id = $conditionData['id'];
            $condition = Condition::find($condtion_id);
            $condition->fill($conditionData);
            $condition->save();
        }

        // UPDATE EXTRA DATA
        $extraData = array_merge($requestData['extras']);
        $extra_id = $extraData['id'];
        $extra = Extra::find($extra_id);
        $extra->fill($extraData);
        $extra->inspection_detail_id = $inspection_id;
        $extra->save();

        // UPDATE INSPECTION TYRE DATA
        $inspectionTyreData = array_merge($requestData['inspection_tyre']);
        $inspectionTyre_id = $inspectionTyreData['id'];
        $inspectionTyre = InspectionTyre::find($inspectionTyre_id);
        $inspectionTyre->fill($inspectionTyreData);
        $inspectionTyre->save();

        // UPDATE misslenou DATA
        $misslenousData = array_merge($requestData['misslenous']);
        $misslenous_id = $misslenousData['id'];
        $Misslenous = Misslenous::find($misslenous_id);
        $Misslenous->fill($misslenousData);
        $Misslenous->save();


        // UPDATE operational DATA

        foreach ($operationalDatas as $operationalData) {
            $operationalData_id = $operationalData['id'];
            $InspectionOperationalTest = InspectionOperationalTest::find($operationalData_id);
            $InspectionOperationalTest->fill($operationalData);
            $InspectionOperationalTest->save();
        }


        // UPDATE incab_inspection_testDatas DATA

        foreach ($incab_inspection_testDatas as $incab_inspection_testData) {
            $incab_inspection_testData_id = $incab_inspection_testData['id'];
            $InspectionInCab = InspectionInCab::find($incab_inspection_testData_id);
            $InspectionInCab->fill($incab_inspection_testData);
            $InspectionInCab->save();
        }

        // UPDATE outside_inspection DATA

        foreach ($outside_inspectionDats as $outside_inspectionDat) {
            $outside_inspectionDat_id = $outside_inspectionDat['id'];
            $InspectionOutside = InspectionOutside::find($outside_inspectionDat_id);
            $InspectionOutside->fill($outside_inspectionDat);
            $InspectionOutside->save();
        }

        // UPDATE under_inspectionData DATA

        foreach ($under_inspectionDatas as $under_inspectionData) {
            $under_inspectionData_id = $under_inspectionData['id'];
            $UnderVehicleInspectionTest = UnderVehicleInspectionTest::find($under_inspectionData_id);
            $UnderVehicleInspectionTest->fill($under_inspectionData);
            $UnderVehicleInspectionTest->save();
        }

        // UPDATE tyre_inspection_test DATA

        foreach ($tyre_inspection_testDatas as $tyre_inspection_testData) {
            $tyre_inspection_testData_id = $tyre_inspection_testData['id'];
            $TyreInspectionTest = TyreInspectionTest::find($tyre_inspection_testData_id);
            $TyreInspectionTest->fill($tyre_inspection_testData);
            $TyreInspectionTest->save();
        }

        // UPDATE estimates DATA

        foreach ($estimatesDatas as $estimatesData) {
            $estimatesData_id = $estimatesData['id'];
            $Estimates = Estimates::find($estimatesData_id);
            $Estimates->fill($estimatesData);
            $Estimates->save();
        }

        return response()->json([
            'status' => 'success',
            'msg' => 'Update successfully'
        ]);
    }

    // API FOR INSERT INSPECTION DATA
    public function submitInspectionNew(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'inspection_details.user_id' => 'required|integer',
            'inspection_details.location' => 'required',
            'inspection_details.inspection_date' => 'required',
            'inspection_details.inspector_name' => 'required',
            'inspection_details.fleet_no' => 'required|integer',
            'inspection_details.unit_number' => 'required',
            'inspection_details.vin_no' => 'required',
            'inspection_details.po_no' => 'required|integer',
            'inspection_details.model_year' => 'integer',
            'inspection_details.engine_serial' => 'numeric',
            'inspection_details.engine_hp' => 'numeric',
            'inspection_details.cruise' => 'in:YES,NO,DOES NOT APPLY',
            'inspection_details.clean_air_idle' => 'in:YES,NO,DOES NOT APPLY',
            'inspection_details.ov_length' => 'regex:/^[a-zA-Z0-9\s]+$/',
            'inspection_details.ov_width' => 'regex:/^[a-zA-Z0-9\s]+$/',
            'inspection_details.ov_height' => 'regex:/^[a-zA-Z0-9\s]+$/',
            'inspection_details.odometer' => 'numeric',
            'inspection_details.hub_odometer' => 'numeric',
            'inspection_details.ecu_hp' => 'numeric',
            'inspection_details.ecu_miles' => 'numeric',
            'inspection_details.air_horns' => 'integer',
            'inspection_details.mirrors' => 'integer',
            'inspection_details.wheelbase' => 'regex:/^[a-zA-Z0-9\s]+$/',
            'inspection_details.rear_ratio' => 'numeric',
            'inspection_details.f_axle_measure' => 'in:lbs,kg',
            'inspection_details.r_axle' => 'numeric',
            'inspection_details.r_axle_measure' => 'in:lbs,kg',
            'inspection_details.gvwr' => 'numeric',
            'inspection_details.gvwr_measure' => 'in:lbs,kg',
            'inspection_details.suspension' => 'in:AIR,SPRING',
            'inspection_details.tag_axie_capacity' => 'integer',
            'inspection_details.rear_axie_model' => 'integer',
            'inspection_details.trans_make' => 'nullable|regex:/^[a-zA-Z0-9\s]+$/',
            'inspection_details.trans_model' => 'nullable|regex:/^[a-zA-Z0-9\s]+$/',
            'inspection_details.trans_speed' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'inspection_details.independent_suspension' => 'integer',
            'inspection_details.full_coach_suspension' => 'integer',
            'inspection_details.tag_axie_unloading' => 'integer',
            'extras.abs' => 'integer',
            'extras.hyd' => 'integer',
            'extras.air' => 'integer',
            'extras.disk' => 'integer',
            'extras.drum' => 'integer',
            'extras.break_plates' => 'in:0 % OF LINING LEFT,DOES NOT APPLY,DID NOT INSPECT',
            'extras.wheels' => 'integer',
            'extras.tyre_size_f' => 'regex:/^[a-zA-Z0-9\s]+$/',
            'extras.tyre_size_r' => 'regex:/^[a-zA-Z0-9\s]+$/',
            'inspection_tyre.no_of_axle' => 'integer',
            'inspection_tyre.steer_brake_left' => 'integer',
            'inspection_tyre.steer_brake_right' => 'integer',
            'inspection_tyre.drive_axle_brake_left' => 'integer',
            'inspection_tyre.drive_axle_brake_right' => 'integer',
            'misslenous.elect_eng_control' => 'integer',
            'misslenous.full_gause' => 'integer',
            'misslenous.wraparound' => 'integer',
            'misslenous.power_mirror' => 'integer',
            'misslenous.tilt' => 'integer',
            'misslenous.air_ride' => 'integer',
            'misslenous.restroom' => 'integer',
            'misslenous.pa_syst' => 'integer',
            'misslenous.aud_vid_syst' => 'integer',
            'misslenous.video_m_no' => 'integer',
            'misslenous.cd_charger' => 'integer',
            'misslenous.ind_aud_syst' => 'integer',
            'misslenous.gps' => 'integer',
            'misslenous.satelite_tv_syst' => 'integer',
            'misslenous.road_viewing_m_syst' => 'integer',
            'misslenous.under_floor' => 'integer',
            'misslenous.parcel_rack' => 'integer',
            'misslenous.tracon_control' => 'integer',
            'misslenous.sun_visors' => 'integer',
            'misslenous.tour_guide_seat' => 'integer',
            'misslenous.other' => 'integer',
            'misslenous.unit_driven_in' => 'integer',
            'misslenous.jump_started' => 'integer',
            'misslenous.unit_tower_in' => 'integer',
            'misslenous.unit_start_run' => 'integer',
            'misslenous.seating_capacity' => 'regex:/^[a-zA-Z0-9\s]+$/'
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->getMessages() as $key => $msg) {
                $errors[$key] = $msg[0];
            }
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = $errors;

            return response()->json($return, 422);
        }
        $requestData = $request->all();
        $conditionDatas = array_merge($requestData['conditions']);

        if (sizeof($conditionDatas) == 0) {
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = 'Please enter any one condtions';

            return response()->json($return, 422);
        }

        $estimatesData = array_merge($requestData['estimates']);
        if (sizeof($estimatesData) == 0) {
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = 'Please enter any one estimate';

            return response()->json($return, 422);
        }

        $inspectionincabs = array_merge($requestData['inspectionincabs']);

        if (sizeof($inspectionincabs) == 0) {
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = 'Please enter any one inspection in cab data';

            return response()->json($return, 422);
        }

        $inspectionoperationaltests = array_merge($requestData['inspectionoperationaltests']);

        if (sizeof($inspectionoperationaltests) == 0) {
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = 'Please enter any one inspection operional data';

            return response()->json($return, 422);
        }

        $inspectionoutsides = array_merge($requestData['inspectionoutsides']);

        if (sizeof($inspectionoutsides) == 0) {
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = 'Please enter any one inspection outside data';

            return response()->json($return, 422);
        }

        $tyreinspectiontests = array_merge($requestData['tyreinspectiontests']);

        if (sizeof($tyreinspectiontests) == 0) {
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = 'Please enter any one tyre inspection data';

            return response()->json($return, 422);
        }

        $undervehicleinspectiontests = array_merge($requestData['undervehicleinspectiontests']);

        if (sizeof($undervehicleinspectiontests) == 0) {
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = 'Please enter any one under vehicle inspection data';

            return response()->json($return, 422);
        }

        $detailsData = array_merge($requestData['inspection_details']);

        $details = new InspectionDetail();
        $details->fill($detailsData);
        $details->report_no = uniqid();
        $details->save();
        $details->report_no = sprintf("WR" . "%06d", $details->id);
        $inspection_id = $details->id;
        $details->save();


        foreach ($conditionDatas as $conditionData) {
            $condition = new Condition();
            $condition->fill($conditionData);
            $condition->inspection_detail_id = $inspection_id;
            $condition->save();
        }

        $extraData = array_merge($requestData['extras']);
        $extra = new Extra();
        $extra->fill($extraData);
        $extra->inspection_detail_id = $inspection_id;
        $extra->save();


        $tiresData = array_merge($requestData['tires']);

        $InspectionTyre = new InspectionTyre();
        $InspectionTyre->fill($tiresData);
        $InspectionTyre->inspection_detail_id = $inspection_id;
        $InspectionTyre->save();


        $misslenousData = array_merge($requestData['misslenous']);
        $Misslenous = new Misslenous();
        $Misslenous->fill($misslenousData);
        $Misslenous->inspection_detail_id = $inspection_id;
        $Misslenous->save();


        foreach ($estimatesData as $estimateData) {
            $Estimates = new Estimates();
            $Estimates->fill($estimateData);
            $Estimates->inspection_detail_id = $inspection_id;
            $Estimates->save();
        }


        foreach ($inspectionincabs as $inspectionincab) {
            $InspectionInCab = new InspectionInCab();
            $InspectionInCab->fill($inspectionincab);
            $InspectionInCab->inspection_detail_id = $inspection_id;
            $InspectionInCab->save();
        }


        foreach ($inspectionoperationaltests as $inspectionoperationaltest) {
            $InspectionOperationalTest = new InspectionOperationalTest();
            $InspectionOperationalTest->fill($inspectionoperationaltest);
            $InspectionOperationalTest->inspection_detail_id = $inspection_id;
            $InspectionOperationalTest->save();
        }


        foreach ($inspectionoutsides as $inspectionoutside) {
            $InspectionOutside = new InspectionOutside();
            $InspectionOutside->fill($inspectionoutside);
            $InspectionOutside->inspection_detail_id = $inspection_id;
            $InspectionOutside->save();
        }


        foreach ($tyreinspectiontests as $tyreinspectiontest) {
            $TyreInspectionTest = new TyreInspectionTest();
            $TyreInspectionTest->fill($tyreinspectiontest);
            $TyreInspectionTest->inspection_detail_id = $inspection_id;
            $TyreInspectionTest->save();
        }



        foreach ($undervehicleinspectiontests as $undervehicleinspectiontest) {
            $UnderVehicleInspectionTest = new UnderVehicleInspectionTest();
            $UnderVehicleInspectionTest->fill($undervehicleinspectiontest);
            $UnderVehicleInspectionTest->inspection_detail_id = $inspection_id;
            $UnderVehicleInspectionTest->save();
        }

        return response()->json([
            'status' => 'success',
            'inspection_data' => $details,
            'pdf_url' => URL::to('pdf/view/' . $details->id)
        ]);
    }

    public function submitInspectionNewTest(Request $request)
    {
        try {
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'inspection_details.user_id' => 'required|integer',
                'inspection_details.location' => 'required',
                'inspection_details.inspection_date' => 'required',
                'inspection_details.inspector_name' => 'required',
                'inspection_details.fleet_no' => 'required|integer',
                'inspection_details.unit_number' => 'required',
                'inspection_details.vin_no' => 'required',
                'inspection_details.po_no' => 'required|integer',
                'inspection_details.model_year' => 'integer',
                'inspection_details.engine_serial' => 'numeric',
                'inspection_details.engine_hp' => 'numeric',
                'inspection_details.cruise' => 'in:YES,NO,DOES NOT APPLY',
                'inspection_details.clean_air_idle' => 'in:YES,NO,DOES NOT APPLY',
                'inspection_details.ov_length' => 'regex:/^[a-zA-Z0-9\s]+$/',
                'inspection_details.ov_width' => 'regex:/^[a-zA-Z0-9\s]+$/',
                'inspection_details.ov_height' => 'regex:/^[a-zA-Z0-9\s]+$/',
                'inspection_details.odometer' => 'numeric',
                'inspection_details.hub_odometer' => 'numeric',
                'inspection_details.ecu_hp' => 'numeric',
                'inspection_details.fuel' => 'in:DIESEL,GASOLINE,CNG,ELECTRIC VEHICLE,OTHER',
                'inspection_details.ecu_miles' => 'numeric',
                'inspection_details.air_horns' => 'integer',
                'inspection_details.mirrors' => 'integer',
                'inspection_details.wheelbase' => 'regex:/^[a-zA-Z0-9\s]+$/',
                'inspection_details.rear_ratio' => 'numeric',
                'inspection_details.f_axle_measure' => 'in:lbs,kg',
                'inspection_details.r_axle' => 'numeric',
                'inspection_details.r_axle_measure' => 'in:lbs,kg',
                'inspection_details.gvwr' => 'numeric',
                'inspection_details.gvwr_measure' => 'in:lbs,kg',
                'inspection_details.suspension' => 'in:AIR,SPRING',
                'inspection_details.tag_axie_capacity' => 'integer',
                'inspection_details.rear_axie_model' => 'integer',
                'inspection_details.trans_make' => 'nullable|regex:/^[a-zA-Z0-9\s]+$/',
                'inspection_details.trans_model' => 'nullable|regex:/^[a-zA-Z0-9\s]+$/',
                'inspection_details.trans_speed' => 'regex:/^[a-zA-Z0-9\s]+$/',
                'inspection_details.independent_suspension' => 'integer',
                'inspection_details.full_coach_suspension' => 'integer',
                'inspection_details.tag_axie_unloading' => 'integer',
                'inspection_details.tag_axie_unloading' => 'integer',
                'inspection_details.powr_steering' => 'integer',
                'extras.abs' => 'integer',
                'extras.hyd' => 'integer',
                'extras.air' => 'integer',
                'extras.disk' => 'integer',
                'extras.drum' => 'integer',
                'extras.break_plates' => 'in:0 % OF LINING LEFT,DOES NOT APPLY,DID NOT INSPECT',
                'extras.wheels' => 'in:ALUMINIUM,STEEL',
                'extras.tyre_size_f' => 'regex:/^[a-zA-Z0-9\s]+$/',
                'extras.tyre_size_r' => 'regex:/^[a-zA-Z0-9\s]+$/',
                'extras.detail_f' => 'string',
                'inspection_tyre.no_of_axle' => 'integer',
                'inspection_tyre.steer_brake_left' => 'integer',
                'inspection_tyre.steer_brake_right' => 'integer',
                'inspection_tyre.drive_axle_brake_left' => 'integer',
                'inspection_tyre.drive_axle_brake_right' => 'integer',
                'misslenous.elect_eng_control' => 'integer',
                'misslenous.full_gause' => 'integer',
                'misslenous.wraparound' => 'integer',
                'misslenous.power_mirror' => 'integer',
                'misslenous.tilt' => 'integer',
                'misslenous.air_ride' => 'integer',
                'misslenous.restroom' => 'integer',
                'misslenous.pa_syst' => 'integer',
                'misslenous.aud_vid_syst' => 'integer',
                'misslenous.video_m_no' => 'integer',
                'misslenous.cd_charger' => 'integer',
                'misslenous.ind_aud_syst' => 'integer',
                'misslenous.gps' => 'integer',
                'misslenous.satelite_tv_syst' => 'integer',
                'misslenous.road_viewing_m_syst' => 'integer',
                'misslenous.under_floor' => 'integer',
                'misslenous.parcel_rack' => 'integer',
                'misslenous.tracon_control' => 'integer',
                'misslenous.sun_visors' => 'integer',
                'misslenous.tour_guide_seat' => 'integer',
                'misslenous.other' => 'integer',
                'misslenous.unit_driven_in' => 'integer',
                'misslenous.jump_started' => 'integer',
                'misslenous.unit_tower_in' => 'integer',
                'misslenous.unit_start_run' => 'integer',
                'misslenous.unit_condition' => 'in:EXCELLENT,GOOD,FAIR',
                'misslenous.seating_capacity' => 'regex:/^[a-zA-Z0-9\s]+$/',
                'inspectionincabs.status' => 'in:OK,Bad,Good,N/A',
                'inspectionoutsides.status' => 'in:OK,Bad,Good,N/A',
                'tyreinspectiontests.status' => 'in:OK,Bad,Good,N/A',
                'undervehicleinspectiontests.status' => 'in:OK,Bad,Good,N/A',
                'status.status' => 'in:OK,Bad,Good,N/A',

            ], [
                'in' => 'The :attribute must be one of the following: :values.',
                'regex' => 'The :attribute must contain only letters, numbers, and spaces.',

            ]);

            if ($validator->fails()) {
                // Validation errors occurred
                // Log the validation errors
                Log::error('Validation failed', ['errors' => $validator->errors()->toArray()]);

                $errors = [];
                foreach ($validator->errors()->getMessages() as $key => $msg) {
                    $errors[$key] = $msg[0];
                }
                $return['status'] = 'failed';
                $return['message'] = "Error: Validation failed";
                $return['errors'] = $errors;

                return response()->json($return, 422);
            }


            $requestData = $request->all();
            $conditionDatas = array_merge($requestData['engine_compartment_area']);

            if (sizeof($conditionDatas) == 0) {
                $return['status'] = 'failed';
                $return['message'] = "Error: Validation failed";
                $return['errors'] = 'Please enter any one condtions';

                return response()->json($return, 422);
            }

            $estimatesData = array_merge($requestData['estimates']);
            if (sizeof($estimatesData) == 0) {
                $return['status'] = 'failed';
                $return['message'] = "Error: Validation failed";
                $return['errors'] = 'Please enter any one estimate';

                return response()->json($return, 422);
            }

            $inspectionincabs = array_merge($requestData['inspectionincabs']);

            if (sizeof($inspectionincabs) == 0) {
                $return['status'] = 'failed';
                $return['message'] = "Error: Validation failed";
                $return['errors'] = 'Please enter any one inspection in cab data';

                return response()->json($return, 422);
            }

            $inspectionoperationaltests = array_merge($requestData['inspectionoperationaltests']);

            if (sizeof($inspectionoperationaltests) == 0) {
                $return['status'] = 'failed';
                $return['message'] = "Error: Validation failed";
                $return['errors'] = 'Please enter any one inspection operional data';

                return response()->json($return, 422);
            }

            $inspectionoutsides = array_merge($requestData['inspectionoutsides']);

            if (sizeof($inspectionoutsides) == 0) {
                $return['status'] = 'failed';
                $return['message'] = "Error: Validation failed";
                $return['errors'] = 'Please enter any one inspection outside data';

                return response()->json($return, 422);
            }

            $tyreinspectiontests = array_merge($requestData['tyreinspectiontests']);

            if (sizeof($tyreinspectiontests) == 0) {
                $return['status'] = 'failed';
                $return['message'] = "Error: Validation failed";
                $return['errors'] = 'Please enter any one tyre inspection data';

                return response()->json($return, 422);
            }

            $undervehicleinspectiontests = array_merge($requestData['undervehicleinspectiontests']);

            if (sizeof($undervehicleinspectiontests) == 0) {
                $return['status'] = 'failed';
                $return['message'] = "Error: Validation failed";
                $return['errors'] = 'Please enter any one under vehicle inspection data';

                return response()->json($return, 422);
            }

            $detailsData = array_merge($requestData['inspection_details']);

            $details = new InspectionDetail();
            $details->fill($detailsData);
            $details->report_no = uniqid();
            $details->save();
            $details->report_no = sprintf("WR" . "%06d", $details->id);
            $inspection_id = $details->id;
            $details->save();


            foreach ($conditionDatas as $conditionData) {
                $condition = new Condition();
                $condition->fill($conditionData);
                $condition->inspection_detail_id = $inspection_id;
                $condition->save();
            }

            $extraData = array_merge($requestData['extras']);
            $extra = new Extra();
            $extra->fill($extraData);
            $extra->inspection_detail_id = $inspection_id;
            $extra->save();


            $tiresData = array_merge($requestData['tires']);

            $InspectionTyre = new InspectionTyre();
            $InspectionTyre->fill($tiresData);
            $InspectionTyre->inspection_detail_id = $inspection_id;
            $InspectionTyre->save();


            $misslenousData = array_merge($requestData['misslenous']);
            $Misslenous = new Misslenous();
            $Misslenous->fill($misslenousData);
            $Misslenous->inspection_detail_id = $inspection_id;
            $Misslenous->save();


            foreach ($estimatesData as $estimateData) {
                $Estimates = new Estimates();
                $Estimates->fill($estimateData);
                $Estimates->inspection_detail_id = $inspection_id;
                $Estimates->save();
            }


            foreach ($inspectionincabs as $inspectionincab) {
                $InspectionInCab = new InspectionInCab();
                $InspectionInCab->fill($inspectionincab);
                $InspectionInCab->inspection_detail_id = $inspection_id;
                $InspectionInCab->save();
            }


            foreach ($inspectionoperationaltests as $inspectionoperationaltest) {
                $InspectionOperationalTest = new InspectionOperationalTest();
                $InspectionOperationalTest->fill($inspectionoperationaltest);
                $InspectionOperationalTest->inspection_detail_id = $inspection_id;
                $InspectionOperationalTest->save();
            }


            foreach ($inspectionoutsides as $inspectionoutside) {
                $InspectionOutside = new InspectionOutside();
                $InspectionOutside->fill($inspectionoutside);
                $InspectionOutside->inspection_detail_id = $inspection_id;
                $InspectionOutside->save();
            }


            foreach ($tyreinspectiontests as $tyreinspectiontest) {
                $TyreInspectionTest = new TyreInspectionTest();
                $TyreInspectionTest->fill($tyreinspectiontest);
                $TyreInspectionTest->inspection_detail_id = $inspection_id;
                $TyreInspectionTest->save();
            }



            foreach ($undervehicleinspectiontests as $undervehicleinspectiontest) {
                $UnderVehicleInspectionTest = new UnderVehicleInspectionTest();
                $UnderVehicleInspectionTest->fill($undervehicleinspectiontest);
                $UnderVehicleInspectionTest->inspection_detail_id = $inspection_id;
                $UnderVehicleInspectionTest->save();
            }

            return response()->json([
                'status' => 'success',
                'inspection_data' => $details,
                'pdf_url' => URL::to('pdf/view/' . $details->id)
            ]);
        } catch (\Exception $e) {

            Log::error('An error occurred during inspection submission', ['exception' => $e]);

            return response()->json([
                'status' => 'failed',
                'message' => 'An unexpected error occurred'
            ], 500);
        }
    }

    public function getInspections(Request $request)
    {
        $user = Auth::guard('api')->user();
        $details = InspectionDetail::where(['user_id' => $user->id])->with('checklist')->orderBy('id', 'desc')->get()->toArray();
        foreach ($details as $k => $detail) {
            $details[$k]['report_url'] = env('APP_URL') . '/storage/reports/' . $user->id . '/inspection_report_' . $detail['report_no'] . '.pdf';
        }
        return response()->json([
            'status' => 'success',
            'data' => $details
        ]);
    }

    public function uploadImages(Request $request)
    {
        $imageUrls = [];
        $user = Auth::guard('api')->user();
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:1024'
        ], [
            'images.*.image' => "File must be an image",
            'images.*.mimes' => "Only jpeg,png,jpg,gif files can be upload",
            'images.*.max' => "File size cannot be more than 1MB",
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->getMessages() as $key => $msg) {
                $errors[$key] = $msg[0];
            }
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = $errors;

            return response()->json($return, 422);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $folderName = 'images/' . $user->id;
                $fileName = Str::random(20) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs($folderName, $fileName, 'public');
                $imageUrl = asset('storage/' . $path);
                $imageUrls[] = $imageUrl;
            }
        }

        return response()->json([
            'status' => 'success',
            'image_urls' => $imageUrls
        ], 200);
    }
}
