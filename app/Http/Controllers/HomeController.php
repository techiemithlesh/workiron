<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
use Illuminate\Support\Facades\Hash;
use PDF;
use Illuminate\Support\Facades\Storage;
use App\Notifications\SendUserCredentials;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // get total users
        $users = User::where(['status' => 1])->count();

        // get total reports
        $reports = InspectionDetail::whereNotNull('user_id')->count();

        return view('home', compact('users', 'reports'));
    }

    public function users(){
        $users = User::orderBy('id', 'desc')->with('inspectionDetails')->paginate(10);
        return view('users', compact('users'));
    }

    public function editUser($id, Request $request){
        $user = User::where(['id' => $id])->firstOrFail();
        return view('edit-user', compact('user'));
    }

    public function updateUser($id, Request $request){
        $request->validate([
            'email' => 'required|string|email|unique:users,email,'.$id,
            'name' => 'required|string',
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::where(['id' => $id])->firstOrFail();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = !empty($request->status) ? true : false;

        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
            $user->notify(new SendUserCredentials($user, $request->password));
        }

        $user->save();

        return redirect(route('users'))->withStatus("User updated successfully");
    }

    public function createUser(Request $request){
        return view('create-user');
    }

    public function storeUser(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = !empty($request->status) ? true : false;
        $user->password = Hash::make($request->password);
        $user->save();

        $user->notify(new SendUserCredentials($user, $request->password));

        return redirect(route('users'))->withStatus("User created successfully");
    }

    public function deleteUser($id, Request $request){
        $user = User::where(['id' => $id])->firstOrFail();
        InspectionDetail::where(['user_id' => $id])->update(['user_id' => null]);
        $user->delete();
        return redirect(route('users'))->withStatus("User deleted successfully");
    }

    public function vehicleInspections(Request $request){
        $query = InspectionDetail::orderBy('id', 'desc');
        $inspector = $request->inspector;
        if(!empty($inspector)){
            $query->where(['user_id' => $request->inspector]);
        }
        $inspections = $query->paginate(10);
		//echo '<pre>';
		//print_r($inspections);
		//die();
        $inspectors = User::pluck('name', 'id')->toArray();
        return view('inspections', compact('inspections', 'inspectors', 'inspector'));
    }

    public function showVehicleInspection($id, Request $request){
        $inspection = InspectionDetail::where(['id' => $id])->with(['user', 'checklist'])->firstOrFail();
        return view('inspection-detail', compact('inspection'));
    }

    public function searchInspections(Request $request)
    {

        $searchQuery = $request->input('search');

        // Query the inspections based on the search query
        $inspections = InspectionDetail::where('vin_no', 'like', '%' . $searchQuery . '%')
            ->orWhere('fleet_no', 'like', '%' . $searchQuery . '%')
            ->orWhere('unit_number', 'like', '%' . $searchQuery . '%')
            ->orWhere('vin_no', 'like', '%' . $searchQuery . '%')
            ->orWhere('inspector_name', 'like', '%' . $searchQuery . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('partials.inspection_table_rows', compact('inspections'));
    }


    // PDF SENT BY EMAIL
// PDF SENT BY EMAIL
public function sendPdfEmail(Request $request)
{
    // Validate the request
    $request->validate([
        'inspection_id' => 'required|exists:inspection_details,id', // Update table name here
        'email' => 'required|email'
    ]);

    // Retrieve the inspection data
    $inspection = InspectionDetail::findOrFail($request->inspection_id);

    // Generate the PDF URL dynamically
    $pdfUrl = "https://" . $_SERVER['HTTP_HOST'] . "/pdf/view/{$inspection->id}";



    // Send email with PDF attachment
    Mail::to($request->email)->send(new PdfEmail($pdfUrl));

    return response()->json(['message' => 'Email sent successfully', 'data' =>  $pdfUrl]);
}

    public function reportVehicleInspection($id, Request $request){
        // dd(ini_get('upload_max_filesize'), ini_get('post_max_size'), ini_get('memory_limit'));
        $inspection = InspectionDetail::where(['id' => $id])->with(['user', 'checklist'])->firstOrFail();

        $folderPath = 'public/reports/' . $inspection->user->id;
        $fileName = 'inspection_report_' . $inspection->report_no . '.pdf';

        $images = InspectionChecklist::where(['inspection_detail_id' => $id])
        ->where('images', '!=', "")
        ->whereNotNull('images')->get();

        $pdf = PDF::loadView('inspection-report', ['data' => $inspection, 'images' => $images]);
        $pdf->setPaper('a4');
        // $pdf->setOptions([
        //     'isHtml5ParserEnabled' => false,
        //     'isRemoteEnabled' => true,
        // ]);

        $content = $pdf->download()->getOriginalContent();
        Storage::put($folderPath."/".$fileName, $content);

        return $pdf->download($fileName);
    }

    public function testPdfView($id, Request $request)
    {

        // Retrieve data or any necessary information for your PDF
       $inspection = InspectionDetail::where(['id' => $id])->with(['user', 'conditions', 'extras', 'inspectionTyre', 'misslenous', 'operational', 'incabInspectionTest', 'outsideInspection', 'underInspection', 'tyreInspectionTest', 'estimates' ])->firstOrFail();;

// 		return $inspection;
// 		echo '<pre>';
// 		print_r($inspection);


       $folderPath = 'public/reports/' . $inspection->user->id;
       $fileName = 'inspection_report_' . $inspection->report_no . '.pdf';

    //    $images = Condition::where(['inspection_detail_id' => $id])
    //    ->where('inspection_img', '!=', "")
    //    ->whereNotNull('inspection_img')->get();


    // Merge image collections from different tables into one collection
    $images = collect([]);
    $imageTables = ['conditions', 'operational', 'incabInspectionTest', 'outsideInspection', 'underInspection', 'tyreInspectionTest'];

    foreach ($imageTables as $table) {
        $tableImages = $inspection->$table->filter(function ($item) {
            return !is_null($item->inspection_img) && $item->inspection_img !== '';
        })->pluck('inspection_img');

        $images = $images->merge($tableImages);
    }


        // Generate PDF

        $pdf = PDF::loadView('pdf_generate', ['data' => $inspection]);

        $customPaper = [0, 0, 600.00, 780.80];
        // Set paper size to A4
        $pdf->setPaper($customPaper);


       $content = $pdf->download()->getOriginalContent();
       Storage::put($folderPath."/".$fileName, $content);

       // return $pdf->download($fileName);

       // Return the PDF as a response
         return new Response($pdf->output(), 200, [
           'Content-Type' => 'application/pdf',
        ]);


    }


   public function testPdf($id, Request $request){

		$data = InspectionDetail::where(['id' => $id])->with(['user', 'checklist'])->firstOrFail();


		$conditions = Condition::where(['inspection_detail_id' => $id])->get();

		$extras = Extra::where(['inspection_detail_id' => $id])->firstOrFail();

		//$images = InspectionImage::where(['inspection_detail_id' => $id])->firstOrFail();
		$inspectionTyre = InspectionTyre::where(['inspection_detail_id' => $id])->get();
		$misslenous = Misslenous::where(['inspection_detail_id' => $id])->firstOrFail();
		$estimates = Estimates::where(['inspection_detail_id' => $id])->get();
        $operationalTest = InspectionOperationalTest::where(['inspection_detail_id' => $id])->get();
        $InspectionInCab = InspectionInCab::where(['inspection_detail_id' => $id])->get();
        $InspectionOutSide = InspectionOutside::where(['inspection_detail_id' => $id])->get();
        $UnderVehicleInspection = UnderVehicleInspectionTest::where(['inspection_detail_id' => $id])->get();
        $TyreInspection = TyreInspectionTest::where(['inspection_detail_id' => $id])->get();

    //    return $TyreInspection;

        //echo '<pre>';
        //print_r($estimates);

       // die();

		//$folderPath = 'public/reports/' . $inspection->user->id;
       // $fileName = 'inspection_report_' . $inspection->report_no . '.pdf';

       // $images = InspectionChecklist::where(['inspection_detail_id' => $id])
        //->where('images', '!=', "")
       // ->whereNotNull('images')->get();

    //    return $data;

        return view('pdf_generate', compact('data','misslenous','estimates','conditions',
        'extras', 'operationalTest', 'InspectionInCab', 'InspectionOutSide',
        'UnderVehicleInspection', 'TyreInspection'));
    }


    public function editPdfById(Request $request, $id){

        $inspection = InspectionDetail::where(['id' => $id])->with(['user', 'conditions', 'extras', 'inspectionTyre', 'misslenous', 'operational', 'incabInspectionTest', 'outsideInspection', 'underInspection', 'tyreInspectionTest', 'estimates' ])->firstOrFail();

        // return $inspection;
        return view('edit_pdf', compact('inspection'));
    }

    public function deleteinspections($id,Request $request)
    {
        if($id== 0)
        {
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = 'Invalid inspection id';

            return response()->json($return, 422);
        }

        $inspection = InspectionDetail::where(['id' => $id])->with(['user', 'conditions', 'extras', 'inspectionTyre', 'misslenous', 'operational', 'incabInspectionTest', 'outsideInspection', 'underInspection', 'tyreInspectionTest', 'estimates' ])->firstOrFail();
        $conditions = $inspection->conditions;

        for($i=0; $i < sizeof($conditions); $i++)
        {
            //print_r($conditions[$i]);
            //echo $conditions[$i]->inspection_img;
            //unlink($conditions[$i]->inspection_img);
            if(file_exists($conditions[$i]->inspection_img)) {
                unlink($conditions[$i]->inspection_img);
            }
        }

        $operational = $inspection->operational;

        for($i=0; $i < sizeof($operational); $i++)
        {
           // print_r($operational[$i]);
            //echo $operational[$i]->inspection_img;
            //unlink($operational[$i]->inspection_img);
            if(file_exists($operational[$i]->inspection_img)) {
                unlink($operational[$i]->inspection_img);
            }
        }

        $incabInspectionTest = $inspection->incabInspectionTest;

        for($i=0; $i < sizeof($incabInspectionTest); $i++)
        {
           // print_r($incabInspectionTest[$i]);
            //echo $incabInspectionTest[$i]->inspection_img;
            //unlink($incabInspectionTest[$i]->inspection_img);
            if(file_exists($incabInspectionTest[$i]->inspection_img)) {
                unlink($incabInspectionTest[$i]->inspection_img);
            }
        }

        $outsideInspection = $inspection->outsideInspection;

        for($i=0; $i < sizeof($outsideInspection); $i++)
        {
            //print_r($outsideInspection[$i]);
            //echo $outsideInspection[$i]->inspection_img;
            //unlink($outsideInspection[$i]->inspection_img);
            if(file_exists($outsideInspection[$i]->inspection_img)) {
                unlink($outsideInspection[$i]->inspection_img);
            }
        }


        $underInspection = $inspection->underInspection;

        for($i=0; $i < sizeof($underInspection); $i++)
        {
            //print_r($underInspection[$i]);
            //echo $underInspection[$i]->inspection_img;
            //unlink($underInspection[$i]->inspection_img);
            if(file_exists($underInspection[$i]->inspection_img)) {
                unlink($underInspection[$i]->inspection_img);
            }
        }

        $tyreInspectionTest = $inspection->tyreInspectionTest;

        for($i=0; $i < sizeof($tyreInspectionTest); $i++)
        {
            //print_r($tyreInspectionTest[$i]);
            //echo $tyreInspectionTest[$i]->inspection_img;
            if(file_exists($tyreInspectionTest[$i]->inspection_img)) {
                unlink($tyreInspectionTest[$i]->inspection_img);
            }
        }

        DB::table('conditions')->where('inspection_detail_id', '=', $id)->delete();
        DB::table('estimates')->where('inspection_detail_id', '=', $id)->delete();
        DB::table('inspection_in_cabs')->where('inspection_detail_id', '=', $id)->delete();
        DB::table('inspection_operational_tests')->where('inspection_detail_id', '=', $id)->delete();
        DB::table('inspection_outsides')->where('inspection_detail_id', '=', $id)->delete();
        DB::table('misslenouses')->where('inspection_detail_id', '=', $id)->delete();
        DB::table('tyre_inspection_tests')->where('inspection_detail_id', '=', $id)->delete();
        DB::table('under_vehicle_inspection_tests')->where('inspection_detail_id', '=', $id)->delete();
        DB::table('vehicle_inspection_extras_details')->where('inspection_detail_id', '=', $id)->delete();
        DB::table('vehicle_tires')->where('inspection_detail_id', '=', $id)->delete();
        DB::table('inspection_details')->where('id', '=', $id)->delete();
        return redirect()->route('vehicle-inspections');

    }

    public function removeCondition(Request $request)
    {
        $condition_id = $request->input('condition_id');
        $record = Condition::find($condition_id);
        if($record)
        {
            $record->delete();
            return response()->json(['success'=>true,'message' => 'Record deleted successfully'], 200);
        }else{
            return response()->json(['success'=>false,'error' => 'Record not found'], 404);
        }



    }



    public function update(Request $request)
    {
        $inspection = array_merge($request->input('inspection'));
        $inspection_id = $inspection['id'];
        $misslenous = $request->input('misslenous');
        $extras = $request->input('extras');
        $inspectionTyre = $request->input('inspectionTyre');
        $inspectionTyreIncrease = $request->input('inspectionTyreIncrease');

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
			'inspection.inspection_date' => 'required',
			'inspection.inspector_name' => 'required',
			'inspection.fleet_no' => 'required|integer',
			'inspection.unit_number' => 'required',
			'inspection.vin_no' => 'required',
			'inspection.po_no' => 'required|integer',
			'inspection.model_year' => 'integer',
            'inspection.engine_serial' => 'numeric',
			'inspection.engine_hp' => 'numeric',
			'inspection.cruise' => 'in:YES,NO,DOES NOT APPLY',
			'inspection.clean_air_idle' => 'in:YES,NO,DOES NOT APPLY',
			'inspection.ov_length' => 'regex:/^[a-zA-Z0-9\s]+$/',
			'inspection.ov_width' => 'regex:/^[a-zA-Z0-9\s]+$/',
			'inspection.ov_height' => 'regex:/^[a-zA-Z0-9\s]+$/',
			'inspection.odometer' => 'numeric',
			'inspection.hub_odometer' => 'numeric',
			'inspection.ecu_hp' => 'numeric',
			'inspection.ecu_miles' => 'numeric',
            'inspection.fuel' => 'in:DIESEL,GASOLINE,CNG,ELECTRIC VEHICLE,OTHER',
			'inspection.air_horns' => 'integer',
			'inspection.mirrors' => 'integer',
			'inspection.wheelbase' => 'regex:/^[a-zA-Z0-9\s]+$/',
			'inspection.rear_ratio' => 'numeric',
            'inspection.f_axle_measure' => 'in:lbs,kg',
			'inspection.f_axle' => 'numeric',
            'inspection.r_axle_measure' => 'in:lbs,kg',
			'inspection.r_axle' => 'numeric',
			'inspection.gvwr' => 'numeric',
            'inspection.gvwr_measure' => 'in:lbs,kg',
			'inspection.suspension' => 'in:AIR,SPRING',
			'inspection.trans_make' => 'nullable|regex:/^[a-zA-Z0-9\s]+$/',
			'inspection.trans_model' =>'nullable|regex:/^[a-zA-Z0-9\s]+$/',
            'inspection.trans_speed' => 'nullable|regex:/^[a-zA-Z0-9\s]+$/',
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
			'inspectionTyre.no_of_axle' => 'integer',
			'inspectionTyre.steer_brake_left' => 'required',
			'inspectionTyre.steer_brake_right' => 'required',
			'inspectionTyre.drive_axle_brake_left' => 'required',
			'inspectionTyre.drive_axle_brake_right' => 'required',
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
            foreach($validator->errors()->getMessages() as $key => $msg){
                $errors[$key] = $msg[0];
            }
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = $errors;
            session()->flash('error', implode(', ',$errors));
            // Redirect back to the view with the flashed message
            return redirect()->route('edit.pdf', [$inspection_id]);
		}


        $conditions = $request->input('conditions');
        if(sizeof($conditions)== 0)
        {
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = 'Please enter any one condtions';
            session()->flash('error', 'Please enter any one condtions');
            // Redirect back to the view with the flashed message
            return redirect()->route('edit.pdf', [$inspection_id]);
        }
        $operational = $request->input('operational');
        if(sizeof($operational)== 0)
        {
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = 'Please enter any one inspection operional data';
            session()->flash('error', 'Please enter any one inspection operional data');
            // Redirect back to the view with the flashed message
            return redirect()->route('edit.pdf', [$inspection_id]);
        }
        $incabInspectionTest = $request->input('incabInspectionTest');
        if(sizeof($incabInspectionTest)== 0)
        {
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = 'Please enter any one inspection in cab data';
            session()->flash('error', 'Please enter any one inspection in cab data');
            // Redirect back to the view with the flashed message
            return redirect()->route('edit.pdf', [$inspection_id]);
        }
        $outsideInspection = $request->input('outsideInspection');
        if(sizeof($outsideInspection)== 0)
        {
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = 'Please enter any one inspection outside data';
            session()->flash('error', 'Please enter any one inspection outside data');
            // Redirect back to the view with the flashed message
            return redirect()->route('edit.pdf', [$inspection_id]);
        }
        $underInspection = $request->input('underInspection');
        if(sizeof($underInspection)== 0)
        {
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = 'Please enter any one under vehicle inspection data';
            session()->flash('error', 'Please enter any one under vehicle inspection data');
            // Redirect back to the view with the flashed message
            return redirect()->route('edit.pdf', [$inspection_id]);
        }

        $tyreInspectionTest = $request->input('tyreInspectionTest');
        if(sizeof($tyreInspectionTest)== 0)
        {
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = 'Please enter any one tyre inspection data';
            session()->flash('error', 'Please enter any one tyre inspection data');
            // Redirect back to the view with the flashed message
            return redirect()->route('edit.pdf', [$inspection_id]);
        }
        $estimates = $request->input('estimates');
        if(sizeof($estimates)== 0)
        {
            $return['status'] = 'failed';
            $return['message'] = "Error: Validation failed";
            $return['errors'] = 'Please enter any one estimate';
            session()->flash('error', 'Please enter any one estimate');
            // Redirect back to the view with the flashed message
            return redirect()->route('edit.pdf', [$inspection_id]);
        }
        $conditions_bottom = $request->input('conditions_bottom');

        echo '<pre>';
       // print_r($inspection);



        $inspectionDetail = InspectionDetail::find($inspection_id);

        // Update the attributes
        $inspectionDetail->fill($inspection);
        $inspectionDetail->save();

        //echo '<br>';
       // print_r($conditions['id']);

        // UPDATE CONDITION DATA
        //DB::table('conditions')->where('inspection_detail_id', '=', $inspection_id)->delete();
        if($conditions)
        {
            for($i=0; $i<sizeof($conditions['id']); $i++)
            {
                $conditionObj = array('status'=>$conditions['status'][$i],'condition_name'=>$conditions['condition_name'][$i],'condition_comments'=>$conditions['condition_comments'][$i]);
                $condtion_id = $conditions['id'][$i];
                if($condtion_id > 0)
                {
                   $condition = Condition::find($condtion_id);
                   if($condition)
                   {
                       $condition->status = $conditions['status'][$i];
                       $condition->condition_name = $conditions['condition_name'][$i];
                       $condition->condition_comments = $conditions['condition_comments'][$i];
                       $condition->save();
                   }
                }else{
                    $condition = new Condition();
                    $condition->fill($conditionObj);
                    $condition->inspection_detail_id = $inspection_id;
                    $condition->save();
                }
            }
        }


       // echo '<br>';
       // print_r($misslenous);

        $misslenous_id = $misslenous['id'];
        $Misslenous = Misslenous::find($misslenous_id);
        $Misslenous->fill($misslenous);
        $Misslenous->save();

        //echo '<br>';
        //print_r($extras);

        $extra_id = $extras['id'];
        $extra = Extra::find($extra_id);
        $extra->fill($extras);
        $extra->save();

    //     //echo '<br>';
       // print_r($inspectionTyre);
        //echo $inspectionTyre['no_of_axle'];
        //die();

        $update = array(
            'id' => $inspectionTyreIncrease['id'],
            'no_of_axle' => $inspectionTyreIncrease['no_of_axle']
        );

        $inspectionTyre_id = $update['id'];
        $inspectionTyre = InspectionTyre::find($inspectionTyre_id);
        $inspectionTyre->fill($update);
        $inspectionTyre->save();


        $conditionObj = array(
            'steer_brake_left'=>$inspectionTyre['steer_brake_left'],
            'steer_brake_right'=>$inspectionTyre['steer_brake_right'],
            'drive_axle_brake_left'=>$inspectionTyre['drive_axle_brake_left'],
            'drive_axle_brake_right'=>$inspectionTyre['drive_axle_brake_right'],
            'id' => $inspectionTyre['id'],
            'no_of_axle'=>$inspectionTyre['no_of_axle']
        );

        for($i = 1; $i <=$inspectionTyre['no_of_axle'] ; $i++)
        {
            $key1 = 'axl'.$i;
            $key2 = 'axr'.$i;

            if($inspectionTyre[$key1])
            {
                $val =  str_replace('`','',$inspectionTyre[$key1]);
                $val =  str_replace('"','',$val);
                $conditionObj[$key1] = '`'.$val.'`';
            }else{
                $conditionObj[$key1] = "";
            }
            if($inspectionTyre[$key2])
            {
                $val =  str_replace('`','',$inspectionTyre[$key2]);
                $val =  str_replace('"','',$val);
                $conditionObj[$key2] = '`'.$val.'`';
            }else{
                $conditionObj[$key2] = "";
            }



        }

        //print_r($conditionObj);
       // die();
       // $inspectionTyre = array_merge($inspectionTyre);
       // print_r($inspectionTyre);
        $inspectionTyre_id = $conditionObj['id'];
        $inspectionTyre = InspectionTyre::find($inspectionTyre_id);
        $inspectionTyre->fill($conditionObj);
        $inspectionTyre->save();

        //echo '<br>';
        //print_r($operational);
        // DB::table('inspection_operational_tests')->where('inspection_detail_id', '=', $inspection_id)->delete();
        // if($operational)
        // {
        //     for($i=0; $i<sizeof($operational['id']); $i++)
        //     {
        //         $conditionObj = array('status'=>$operational['status'][$i],'condition_name'=>$operational['condition_name'][$i],'condition_comments'=>$operational['condition_comments'][$i]);

        //         $InspectionOperationalTest = New InspectionOperationalTest();
        //         $InspectionOperationalTest->fill($conditionObj);
        //         $InspectionOperationalTest->inspection_detail_id = $inspection_id;
        //         $InspectionOperationalTest->save();
        //     }
        // }

        if($operational)
        {
            for($i=0; $i<sizeof($operational['id']); $i++)
            {
                $conditionObj = array('status'=>$operational['status'][$i],'condition_name'=>$operational['condition_name'][$i],'condition_comments'=>$operational['condition_comments'][$i]);
                $condtion_id = $operational['id'][$i];
                if($condtion_id > 0)
                {
                   $condition = InspectionOperationalTest::find($condtion_id);
                   if($condition)
                   {
                       $condition->status = $operational['status'][$i];
                       $condition->condition_name = $operational['condition_name'][$i];
                       $condition->condition_comments = $operational['condition_comments'][$i];
                       $condition->save();
                   }
                }else{
                    $condition = new InspectionOperationalTest();
                    $condition->fill($conditionObj);
                    $condition->inspection_detail_id = $inspection_id;
                    $condition->save();
                }
            }
        }


        //echo '<br>';
        //print_r($incabInspectionTest);
        // DB::table('inspection_in_cabs')->where('inspection_detail_id', '=', $inspection_id)->delete();
        // if($incabInspectionTest)
        // {
        //     for($i=0; $i<sizeof($incabInspectionTest['id']); $i++)
        //     {
        //         $conditionObj = array('status'=>$incabInspectionTest['status'][$i],'condition_name'=>$incabInspectionTest['condition_name'][$i],'condition_comments'=>$incabInspectionTest['condition_comments'][$i]);

        //         $InspectionOperationalTest = new InspectionInCab();
        //         $InspectionOperationalTest->fill($conditionObj);
        //         $InspectionOperationalTest->inspection_detail_id = $inspection_id;
        //         $InspectionOperationalTest->save();
        //     }
        // }

        if($incabInspectionTest)
        {
            for($i=0; $i<sizeof($incabInspectionTest['id']); $i++)
            {
                $conditionObj = array('status'=>$incabInspectionTest['status'][$i],'condition_name'=>$incabInspectionTest['condition_name'][$i],'condition_comments'=>$incabInspectionTest['condition_comments'][$i]);
                $condtion_id = $incabInspectionTest['id'][$i];
                if($condtion_id > 0)
                {
                   $condition = InspectionInCab::find($condtion_id);
                   if($condition)
                   {
                       $condition->status = $incabInspectionTest['status'][$i];
                       $condition->condition_name = $incabInspectionTest['condition_name'][$i];
                       $condition->condition_comments = $incabInspectionTest['condition_comments'][$i];
                       $condition->save();
                   }
                }else{
                    $condition = new InspectionInCab();
                    $condition->fill($conditionObj);
                    $condition->inspection_detail_id = $inspection_id;
                    $condition->save();
                }
            }
        }

        //echo '<br>';
        //print_r($outsideInspection);
        // DB::table('inspection_outsides')->where('inspection_detail_id', '=', $inspection_id)->delete();
        // if($outsideInspection)
        // {
        //     for($i=0; $i<sizeof($outsideInspection['id']); $i++)
        //     {
        //         $conditionObj = array('status'=>$outsideInspection['status'][$i],'condition_name'=>$outsideInspection['condition_name'][$i],'condition_comments'=>$outsideInspection['condition_comments'][$i]);

        //         $InspectionOperationalTest = new InspectionOutside();
        //         $InspectionOperationalTest->fill($conditionObj);
        //         $InspectionOperationalTest->inspection_detail_id = $inspection_id;
        //         $InspectionOperationalTest->save();


        //     }
        // }

        if($outsideInspection)
        {
            for($i=0; $i<sizeof($outsideInspection['id']); $i++)
            {
                $conditionObj = array('status'=>$outsideInspection['status'][$i],'condition_name'=>$outsideInspection['condition_name'][$i],'condition_comments'=>$outsideInspection['condition_comments'][$i]);
                $condtion_id = $outsideInspection['id'][$i];
                if($condtion_id > 0)
                {
                   $condition = InspectionOutside::find($condtion_id);
                   if($condition)
                   {
                       $condition->status = $outsideInspection['status'][$i];
                       $condition->condition_name = $outsideInspection['condition_name'][$i];
                       $condition->condition_comments = $outsideInspection['condition_comments'][$i];
                       $condition->save();
                   }
                }else{
                    $condition = new InspectionOutside();
                    $condition->fill($conditionObj);
                    $condition->inspection_detail_id = $inspection_id;
                    $condition->save();
                }
            }
        }

        //echo '<br>';
        //print_r($underInspection);
        // DB::table('under_vehicle_inspection_tests')->where('inspection_detail_id', '=', $inspection_id)->delete();
        // if($underInspection)
        // {
        //     for($i=0; $i<sizeof($underInspection['id']); $i++)
        //     {
        //         $conditionObj = array('status'=>$underInspection['status'][$i],'condition_name'=>$underInspection['condition_name'][$i],'condition_comments'=>$underInspection['condition_comments'][$i]);

        //         $InspectionOperationalTest = new UnderVehicleInspectionTest();
        //         $InspectionOperationalTest->fill($conditionObj);
        //         $InspectionOperationalTest->inspection_detail_id = $inspection_id;
        //         $InspectionOperationalTest->save();

        //     }
        // }

        if($underInspection)
        {
            for($i=0; $i<sizeof($underInspection['id']); $i++)
            {
                $conditionObj = array('status'=>$underInspection['status'][$i],'condition_name'=>$underInspection['condition_name'][$i],'condition_comments'=>$underInspection['condition_comments'][$i]);
                $condtion_id = $underInspection['id'][$i];
                if($condtion_id > 0)
                {
                   $condition = UnderVehicleInspectionTest::find($condtion_id);
                   if($condition)
                   {
                       $condition->status = $underInspection['status'][$i];
                       $condition->condition_name = $underInspection['condition_name'][$i];
                       $condition->condition_comments = $underInspection['condition_comments'][$i];
                       $condition->save();
                   }
                }else{
                    $condition = new UnderVehicleInspectionTest();
                    $condition->fill($conditionObj);
                    $condition->inspection_detail_id = $inspection_id;
                    $condition->save();
                }
            }
        }

        //echo '<br>';
        //print_r($tyreInspectionTest);
        // DB::table('tyre_inspection_tests')->where('inspection_detail_id', '=', $inspection_id)->delete();
        // if($tyreInspectionTest)
        // {
        //     for($i=0; $i<sizeof($tyreInspectionTest['id']); $i++)
        //     {
        //         $conditionObj = array('status'=>$tyreInspectionTest['status'][$i],'condition_name'=>$tyreInspectionTest['condition_name'][$i],'condition_comments'=>$tyreInspectionTest['condition_comments'][$i]);

        //         $InspectionOperationalTest = new TyreInspectionTest();
        //         $InspectionOperationalTest->fill($conditionObj);
        //         $InspectionOperationalTest->inspection_detail_id = $inspection_id;
        //         $InspectionOperationalTest->save();

        //     }
        // }

        if($tyreInspectionTest)
        {
            for($i=0; $i<sizeof($tyreInspectionTest['id']); $i++)
            {
                $conditionObj = array('status'=>$tyreInspectionTest['status'][$i],'condition_name'=>$tyreInspectionTest['condition_name'][$i],'condition_comments'=>$tyreInspectionTest['condition_comments'][$i]);
                $condtion_id = $tyreInspectionTest['id'][$i];
                if($condtion_id > 0)
                {
                   $condition = TyreInspectionTest::find($condtion_id);
                   if($condition)
                   {
                       $condition->status = $tyreInspectionTest['status'][$i];
                       $condition->condition_name = $tyreInspectionTest['condition_name'][$i];
                       $condition->condition_comments = $tyreInspectionTest['condition_comments'][$i];
                       $condition->save();
                   }
                }else{
                    $condition = new TyreInspectionTest();
                    $condition->fill($conditionObj);
                    $condition->inspection_detail_id = $inspection_id;
                    $condition->save();
                }
            }
        }

        //echo '<br>';
        //print_r($estimates);
        DB::table('estimates')->where('inspection_detail_id', '=', $inspection_id)->delete();
        if($estimates)
        {
            for($i=0; $i<sizeof($estimates['id']); $i++)
            {

                $conditionObj = array('item_name'=>$estimates['item_name'][$i],'desciption'=>$estimates['desciption'][$i],'item_cost'=>$estimates['item_cost'][$i],'labor_cost'=>$estimates['labor_cost'][$i]);
                $InspectionOperationalTest = new Estimates();
                $InspectionOperationalTest->fill($conditionObj);
                $InspectionOperationalTest->inspection_detail_id = $inspection_id;
                $InspectionOperationalTest->t_part_cost = $conditionObj['item_cost'];
                $InspectionOperationalTest->t_labor_cost = $conditionObj['labor_cost'];
                $InspectionOperationalTest->save();

            }
        }


        //echo '<br>';
        //print_r($conditions_bottom);
		//die();

        // UPDATE CONDITION DATA

        for($i=0; $i<sizeof($conditions_bottom['id']); $i++)
        {
            $path = '';
			$imageUrl = '';
			$key = 'conditions_bottom_inspection_img_'.$conditions_bottom['image_id'][$i];


            $conditionObj = array('condition_name'=>$conditions_bottom['condition_name'][$i],'id'=>$conditions_bottom['id'][$i],'status'=>$conditions_bottom['status'][$i],'condition_comments'=>$conditions_bottom['condition_comments'][$i],'inspection_detail_id'=>$inspection_id);

            $condtion_id = $conditions_bottom['id'][$i];
            $condition = Condition::find($condtion_id);
            if($condition)
            {
                $condition->condition_name = $conditions_bottom['condition_name'][$i];
                if($request->file($key))
    			{
    				 $file = $request->file($key);
    				 $folderName = 'images';
    				 $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
    				 //$path = $file->store('public');
    				 $path = $file->storeAs($folderName, $fileName, 'public');
    				 $imageUrl = asset('storage/' . $path);
    				 //$conditionObj['inspection_img'] = $imageUrl;
    				 $condition->inspection_img = $imageUrl;
    			}else{

    			  	//$conditionObj['inspection_img'] = $conditions_bottom['inspection_img'][$i];
    			  	$condition->inspection_img = $conditions_bottom['inspection_img'][$i];
    			}


    			$condition->save();
            }

        }

        $operational_bottom = $request->input('operational_bottom');

        for($i=0; $i<sizeof($operational_bottom['id']); $i++)
        {
            $path = '';
			$imageUrl = '';
			$key = 'operational_bottom_inspection_img_'.$operational_bottom['image_id'][$i];

            $conditionObj = array('condition_name'=>$operational_bottom['condition_name'][$i],'id'=>$operational_bottom['id'][$i],'status'=>$operational_bottom['status'][$i],'condition_comments'=>$operational_bottom['condition_comments'][$i],'inspection_detail_id'=>$inspection_id);

            $condtion_id = $operational_bottom['id'][$i];
            $condition = InspectionOperationalTest::find($condtion_id);
            if($condition)
            {
                $condition->condition_name = $operational_bottom['condition_name'][$i];
                if($request->file($key))
    			{
    				 $file = $request->file($key);
    				 $folderName = 'images';
    				 $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
    				 //$path = $file->store('public');
    				 $path = $file->storeAs($folderName, $fileName, 'public');
    				 $imageUrl = asset('storage/' . $path);
    				 //$conditionObj['inspection_img'] = $imageUrl;
    				 $condition->inspection_img = $imageUrl;
    			}else{

    			  	//$conditionObj['inspection_img'] = $conditions_bottom['inspection_img'][$i];
    			  	$condition->inspection_img = $operational_bottom['inspection_img'][$i];
    			}


    			$condition->save();
            }

        }

        $incabInspectionTest_bottom = $request->input('incabInspectionTest_bottom');
        for($i=0; $i<sizeof($incabInspectionTest_bottom['id']); $i++)
        {
            $path = '';
			$imageUrl = '';
			$key = 'incabInspectionTest_bottom_inspection_img_'.$incabInspectionTest_bottom['image_id'][$i];


            $conditionObj = array('condition_name'=>$incabInspectionTest_bottom['condition_name'][$i],'id'=>$incabInspectionTest_bottom['id'][$i],'status'=>$incabInspectionTest_bottom['status'][$i],'condition_comments'=>$incabInspectionTest_bottom['condition_comments'][$i],'inspection_detail_id'=>$inspection_id);

            $condtion_id = $incabInspectionTest_bottom['id'][$i];
            $condition = InspectionInCab::find($condtion_id);
            if($condition)
            {
                $condition->condition_name = $incabInspectionTest_bottom['condition_name'][$i];
                if($request->file($key))
    			{
    				 $file = $request->file($key);
    				 $folderName = 'images';
    				 $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
    				 //$path = $file->store('public');
    				 $path = $file->storeAs($folderName, $fileName, 'public');
    				 $imageUrl = asset('storage/' . $path);
    				 //$conditionObj['inspection_img'] = $imageUrl;
    				 $condition->inspection_img = $imageUrl;
    			}else{

    			  	//$conditionObj['inspection_img'] = $conditions_bottom['inspection_img'][$i];
    			  	$condition->inspection_img = $incabInspectionTest_bottom['inspection_img'][$i];
    			}


    			$condition->save();
            }

        }

        $outsideInspection_bottom = $request->input('outsideInspection_bottom');
        for($i=0; $i<sizeof($outsideInspection_bottom['id']); $i++)
        {
            $path = '';
			$imageUrl = '';
			$key = 'outsideInspection_bottom_inspection_img_'.$outsideInspection_bottom['image_id'][$i];


            $conditionObj = array('condition_name'=>$outsideInspection_bottom['condition_name'][$i],'id'=>$outsideInspection_bottom['id'][$i],'status'=>$outsideInspection_bottom['status'][$i],'condition_comments'=>$outsideInspection_bottom['condition_comments'][$i],'inspection_detail_id'=>$inspection_id);

            $condtion_id = $outsideInspection_bottom['id'][$i];
            $condition = InspectionOutside::find($condtion_id);
            if($condition)
            {
                $condition->condition_name = $outsideInspection_bottom['condition_name'][$i];
                if($request->file($key))
    			{
    				 $file = $request->file($key);
    				 $folderName = 'images';
    				 $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
    				 //$path = $file->store('public');
    				 $path = $file->storeAs($folderName, $fileName, 'public');
    				 $imageUrl = asset('storage/' . $path);
    				 //$conditionObj['inspection_img'] = $imageUrl;
    				 $condition->inspection_img = $imageUrl;
    			}else{

    			  	//$conditionObj['inspection_img'] = $conditions_bottom['inspection_img'][$i];
    			  	$condition->inspection_img = $outsideInspection_bottom['inspection_img'][$i];
    			}


    			$condition->save();
            }

        }

        $underInspection_bottom = $request->input('underInspection_bottom');
        for($i=0; $i<sizeof($underInspection_bottom['id']); $i++)
        {
            $path = '';
			$imageUrl = '';
			$key = 'underInspection_bottom_inspection_img_'.$underInspection_bottom['image_id'][$i];


            $conditionObj = array('condition_name'=>$underInspection_bottom['condition_name'][$i],'id'=>$underInspection_bottom['id'][$i],'status'=>$underInspection_bottom['status'][$i],'condition_comments'=>$underInspection_bottom['condition_comments'][$i],'inspection_detail_id'=>$inspection_id);

            $condtion_id = $underInspection_bottom['id'][$i];
            $condition = UnderVehicleInspectionTest::find($condtion_id);
            if($condition)
            {
                $condition->condition_name = $underInspection_bottom['condition_name'][$i];
                if($request->file($key))
    			{
    				 $file = $request->file($key);
    				 $folderName = 'images';
    				 $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
    				 //$path = $file->store('public');
    				 $path = $file->storeAs($folderName, $fileName, 'public');
    				 $imageUrl = asset('storage/' . $path);
    				 //$conditionObj['inspection_img'] = $imageUrl;
    				 $condition->inspection_img = $imageUrl;
    			}else{

    			  	//$conditionObj['inspection_img'] = $conditions_bottom['inspection_img'][$i];
    			  	$condition->inspection_img = $underInspection_bottom['inspection_img'][$i];
    			}


    			$condition->save();
            }

        }

        $tyreInspectionTest_bottom = $request->input('tyreInspectionTest_bottom');
        for($i=0; $i<sizeof($tyreInspectionTest_bottom['id']); $i++)
        {
            $path = '';
			$imageUrl = '';
			$key = 'tyreInspectionTest_bottom_inspection_img_'.$tyreInspectionTest_bottom['image_id'][$i];


            $conditionObj = array('condition_name'=>$tyreInspectionTest_bottom['condition_name'][$i],'id'=>$tyreInspectionTest_bottom['id'][$i],'status'=>$tyreInspectionTest_bottom['status'][$i],'condition_comments'=>$tyreInspectionTest_bottom['condition_comments'][$i],'inspection_detail_id'=>$inspection_id);

            $condtion_id = $tyreInspectionTest_bottom['id'][$i];
            $condition = TyreInspectionTest::find($condtion_id);
            if($condition)
            {
                $condition->condition_name = $tyreInspectionTest_bottom['condition_name'][$i];
                if($request->file($key))
    			{
    				 $file = $request->file($key);
    				 $folderName = 'images';
    				 $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
    				 //$path = $file->store('public');
    				 $path = $file->storeAs($folderName, $fileName, 'public');
    				 $imageUrl = asset('storage/' . $path);
    				 //$conditionObj['inspection_img'] = $imageUrl;
    				 $condition->inspection_img = $imageUrl;
    			}else{

    			  	//$conditionObj['inspection_img'] = $conditions_bottom['inspection_img'][$i];
    			  	$condition->inspection_img = $tyreInspectionTest_bottom['inspection_img'][$i];
    			}


    			$condition->save();
            }

        }


        //die();

        // Flash a success message to the session
        session()->flash('success', 'Inspection updated successfully');

        // Redirect back to the view with the flashed message
        return redirect()->route('edit.pdf', [$inspection_id]);
    }


}
