<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

// ---------models---------------------
use App\Models\admin;
use App\Models\customer;
use App\Models\collaborator;
use App\Models\air_company;
use App\Models\carrier;
use App\Models\package_service;
use App\Models\visa_service;
use App\Models\visa_price_for_individual;
use App\Models\visa_price_for_package;
use App\Models\lodging_service;
use App\Models\lodging_service_price_for_package;
use App\Models\lodging_service_price_for_individual;
use App\Models\transport_service;
use App\Models\transport_service_price_for_adult;
use App\Models\transport_service_price_for_child;
use App\Models\transport_service_price_for_infant;
use App\Models\extra_service;
use App\Models\extra_service_price;
use App\Models\ticket_service;
use App\Models\reservation;
use App\Models\package_reservation;
use App\Models\flight_reservation;
use App\Models\lodging_reservation;
use App\Models\transport_reservation;
use App\Models\visa_reservation;
use App\Models\payment_detail_for_reservation;
use App\Models\extra_service_for_reservation;

class AdminController extends Controller
{
    //
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('admin/');
    }
    public function index()
    {
        return view('admin.index');
    }
    public function login(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'email'=>'required|email',
            'password'=>'required', 
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            // dd($req);
            if(Auth::guard('admin')->attempt(['email'=>$req->email,'password'=>$req->password]))
            {

                ///////////////////take to dashboard
                return redirect("admin/dashboard");
            }
            else
            {
                //////////////////////error msg password not correct
                return redirect()->back()->with('error_msg', "Incorrect Password");
            }
        }
    }
    public function submit_forgot_password(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'email'=>'required|email', 
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            // dd($req);
            $user=admin::where('email',$req->email)->first();
            if($user){
                $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                $random_string=substr(str_shuffle($str_result),0, 10);
                $user->token=$random_string;
                $user->save();
                
                
                
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $from = 'info@ahmedhousedeal.com';
                $headers .= 'From: info@ahmedhousedeal.com'."\r\n".
                            'Reply-To: info@ahmedhousedeal.com'. "\r\n" .
                            'X-Mailer: PHP/' . phpversion();
                $msg="Dear <b>$user->name</b>, Your request of password reset have received. Click the link to change the Password: <br>"."http://ahmedhousedeal.com/ahmed_property/reset_password/".$random_string;
                $msg = wordwrap($msg, 70, "\r\n");
                $mailsuccess=mail($user->email,"Password Reset",$msg,$headers);
                
                
                if (!$mailsuccess) {
                    $mailsuccess = error_get_last()['message'];
                    return redirect()->back()->with('error_msg', $mailsuccess);
                    
                }else{
                    return redirect()->back()->with('success_msg', " Check Your Email for Password Reset");
                }
            }else{
                return redirect()->back()->with('error_msg', " User not found");
            }
        }
    }
    public function profile()
    {
        $user_id=Auth::guard('admin')->user()->id;
        $user=admin::where('id',$user_id)->first();
        return view('admin.profile',compact('user'));
    }
    public function edit_profile($id)
    {
        $user=admin::where('id',$id)->first();
        return view('admin.edit_profile',compact('user'));
    }
    public function submit_edit_profile(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            $user_id=Auth::guard('admin')->user()->id;

            if($req->file('profile_image')!=null){
                if(Auth::guard('admin')->user()->profile_image!=NULL){

                    $unlink_doc=Storage::delete(Auth::guard('admin')->user()->profile_image);
                }
                $profileImage=$req->file('profile_image')->store('Profile_Image');
                $add_property=admin::where('id',$user_id)->update([
                    'name'=>$req->name,
                    'email'=>$req->email, 
                    'phone'=>$req->phone, 
                    'address'=>$req->address, 
                    'profile_image'=>$profileImage,
                ]);
                if($add_property){
                    return redirect()->back()->with('success_msg', 'Profile Updated');
                }else{
                    return redirect()->back()->with('error_msg', 'Unable To Update Profile...');
                }
            }else{
                $add_property=admin::where('id',$user_id)->update([
                    'name'=>$req->name,
                    'email'=>$req->email, 
                    'phone'=>$req->phone, 
                    'address'=>$req->address, 
                ]);
                if($add_property){
                    return redirect()->back()->with('success_msg', 'Profile Updated');
                }else{
                    return redirect()->back()->with('error_msg', 'Unable To Update Profile...');
                }
            }
            
        }
    }
    public function change_password()
    {
        return view('admin.change_password');
    }
    public function submit_change_password(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'oldpassword'=>'required',
            'newpass'=>'required',
            'cpass'=>'required',
            
        ]);
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            $user_id=Auth::guard('admin')->user()->id;
            // Hash::make($req->oldpassword);
            // dd();
            if(Hash::check($req->oldpassword,Auth::guard('admin')->user()->password)){

                if($req->newpass==$req->cpass){
                    $update_pass=admin::where('id',$user_id)->update([
                        'password'=>Hash::make($req->newpass),
                    ]);
                    if($update_pass){
                        return redirect()->back()->with('success_msg', "password updated successfully");
                    }else{
                        return redirect()->back()->with('error_msg', "unable to update password");
                    }
                }else{
                    return redirect()->back()->with('error_msg', "new password and confirm password are not matched");
                }
            }else{
                return redirect()->back()->with('error_msg', "inccorrect old password");
            }
        }
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function add_customer()
    {

        $collaborators=collaborator::get();
        $customers=customer::get();
        return view('admin.add_customer',compact('customers','collaborators'));
    }
    public function submit_add_customer(Request $req)
    {
        
        $validator = Validator::make($req->all(),[
            'first_name'=>'required',
            'last_name'=>'required',
            'sex'=>'required',
            'gender'=>'required',
            'phone'=>'required',
            'dob'=>'required',
            'nationality'=>'required',
            'city'=>'required',
            
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            
            // dd($req->guardian_phone);
            if($req->file('passport_file')!=null){
                $passport_image=$req->file('passport_file')->store('passport_files');
                $add_customer=customer::create([
                    'first_name'=>$req->first_name,
                    'last_name'=>$req->last_name,
                    'sex'=>$req->sex,
                    'gender'=>$req->gender,
                    'phone'=>$req->phone,
                    'dob'=>$req->dob,
                    'id_card'=>$req->cnic,
                    'passport'=>$req->passport,
                    'passport_file'=>$passport_image,
                    'passport_issue_date'=>$req->issue_date,
                    'nationality'=>$req->nationality,
                    'city'=>$req->city,
                    'email'=>$req->email,
                    'gaurdian_name'=>$req->guardian_name,
                    'gaurdian_phone'=>$req->guardian_phone,
                    'gaurdian_relation'=>$req->relation,
                    'collaborator'=>$req->collaborator,
                    'linked_with'=>$req->linked_with,
                ]);
                if($add_customer){
                    
                    if($req->submit=="Go to Reservation"){
                        return redirect::route('add_reservation_with_id',['customer_id'=>$add_customer->id]);
                    }else{
                        return redirect()->back()->with('success_msg', 'Customer Added Successfully....');
                    }
                }else{
                    return redirect()->back()->with('error_msg', 'Unable To add Property...');
                }
            }else{
                $add_customer=customer::create([
                    'first_name'=>$req->first_name,
                    'last_name'=>$req->last_name,
                    'sex'=>$req->sex,
                    'gender'=>$req->gender,
                    'phone'=>$req->phone,
                    'dob'=>$req->dob,
                    'id_card'=>$req->cnic,
                    'passport'=>$req->passport,
                    'passport_issue_date'=>$req->issue_date,
                    'nationality'=>$req->nationality,
                    'city'=>$req->city,
                    'email'=>$req->email,
                    'gaurdian_name'=>$req->guardian_name,
                    'gaurdian_phone'=>$req->guardian_phone,
                    'gaurdian_relation'=>$req->relation,
                    'collaborator'=>$req->collaborator,
                    'linked_with'=>$req->linked_with,
                ]);
                if($add_customer){
                    
                    if($req->submit=="Go to Reservation"){
                        return redirect::route('add_reservation_with_id',['customer_id'=>$add_customer->id]);

                    }else{
                        return redirect()->back()->with('success_msg', 'Customer Added Successfully....');
                    }
                }else{
                    return redirect()->back()->with('error_msg', 'Unable To add Property...');
                }
            }
            
        }

    }

    public function view_customer()
    {
        $customers=customer::with('linkedWith','Collaborator')->orderBy('id', 'DESC')->get();;
        
        return view('admin.view_customer',compact('customers'));
    }
    public function submit_edit_customer(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'first_name'=>'required',
            'last_name'=>'required',
            'sex'=>'required',
            'gender'=>'required',
            'phone'=>'required',
            'dob'=>'required',
            'cnic'=>'required',
            'passport'=>'required',
            'issue_date'=>'required',
            'nationality'=>'required',
            'city'=>'required',
            'email'=>'required | email',
            'guardian_name'=>'required',
            'guardian_phone'=>'required',
            'relation'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            
            if($req->file('passport_file')!=null){
                $passport_image=$req->file('passport_file')->store('passport_files');
                $add_customer=customer::where('id',$req->id)->update([
                    
                    'first_name'=>$req->first_name,
                    'last_name'=>$req->last_name,
                    'sex'=>$req->sex,
                    'gender'=>$req->gender,
                    'phone'=>$req->phone,
                    'dob'=>$req->dob,
                    'id_card'=>$req->cnic,
                    'passport'=>$req->passport,
                    'passport_file'=>$passport_image,
                    'passport_issue_date'=>$req->issue_date,
                    'nationality'=>$req->nationality,
                    'city'=>$req->city,
                    'email'=>$req->email,
                    'gaurdian_name'=>$req->guardian_name,
                    'gaurdian_phone'=>$req->guardian_phone,
                    'gaurdian_relation'=>$req->relation,
                    // 'collaborator'=>$req->collaborator,
                    'linked_with'=>$req->linked_with,
                ]);
                if($add_customer){
                    return redirect()->back()->with('success_msg', 'Customer Updated Successfully....');
                }else{
                    return redirect()->back()->with('error_msg', 'Unable To Update Customer...');
                }
            }else{
                $add_customer=customer::where('id',$req->id)->update([
                    'first_name'=>$req->first_name,
                    'last_name'=>$req->last_name,
                    'sex'=>$req->sex,
                    'gender'=>$req->gender,
                    'phone'=>$req->phone,
                    'dob'=>$req->dob,
                    'id_card'=>$req->cnic,
                    'passport'=>$req->passport,
                    'passport_issue_date'=>$req->issue_date,
                    'nationality'=>$req->nationality,
                    'city'=>$req->city,
                    'email'=>$req->email,
                    'gaurdian_name'=>$req->guardian_name,
                    'gaurdian_phone'=>$req->guardian_phone,
                    'gaurdian_relation'=>$req->relation,
                    'linked_with'=>$req->linked_with,
                ]);
                if($add_customer){
                    return redirect()->back()->with('success_msg', 'Customer Updated Successfully....');
                }else{
                    return redirect()->back()->with('error_msg', 'Unable To Update Customer...');
                }
            }
            
        }

    }
    public function customer_detail($id)
    {
        $customer=customer::with('linkedWith','collaborator')->where('id',$id)->first();
        return view('admin.customer_detail',compact('customer'));
    }
    public function edit_customer($id)
    {   
        $customers=customer::with('linkedWith','collaborator')->where('id','!=',$id)->get();
        $customer=customer::where('id',$id)->first();
        return view('admin.edit_customer',compact(['customer','customers']));
    }
    public function delete_customer($id)
    {   
        try{

            $customer=customer::where('id',$id)->delete();
            if($customer){
                return redirect()->back()->with('success_msg', 'Customer Deleted Successfully....');
            }else{
                return redirect()->back()->with('error_msg', 'Unable To Delete Customer...');
            }
        }catch(\Exception){
            return redirect()->back()->with('error_msg', ' This Customer is Linked With other Customer');

        }
    }
    public function visa()
    {
        return view('admin.visa');
    }
    public function ticket()
    {
        return view('admin.ticket');
    }
    public function airline()
    {
        $airlines=air_company::orderBy('id', 'DESC')->get();
        return view('admin.airline',compact('airlines'));
    }
    public function submit_add_air_company(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'name'=>'required',
            'abbreviation'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            // dd($req);
            $add_air_company=air_company::create([
                'name'=>$req->name,
                'abbreviation'=>$req->abbreviation,
            ]);
            if($add_air_company){
                return redirect()->back()->with('success_msg', 'Air Company Added Successfully....');
            }else{
                return redirect()->back()->with('error_msg', 'Unable To add Air Company...');
            }
        }
    }
    public function submit_edit_air_company(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'id'=>'required',
            'name'=>'required',
            'abbreviation'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            
            $add_air_company=air_company::where('id',$req->id)->update([
                'name'=>$req->name,
                'abbreviation'=>$req->abbreviation,
            ]);
            if($add_air_company){
                return redirect()->back()->with('success_msg', 'Air Company Updated Successfully....');
            }else{
                return redirect()->back()->with('error_msg', 'Unable To update Air Company...');
            }
        }
    }
    public function delete_air_company($id)
    {   
        try{
            $air_company=air_company::where('id',$id)->delete();
            if($air_company){
                return redirect()->back()->with('success_msg', 'Air Company Deleted Successfully....');
            }else{
                return redirect()->back()->with('error_msg', 'Unable To Air Company Customer...');
            }
        }catch(\Exception){
            return redirect()->back()->with('error_msg', ' This Air Company is Linked With other Customer');
        }
    }
    public function add_hotel()
    {
        return view('admin.add_hotel');
    }
    public function view_hotel()
    {
        return view('admin.view_hotel');
    }
    public function edit_hotel()
    {
        return view('admin.edit_hotel');
    }
    public function hotel_detail()
    {
        return view('admin.hotel_detail');
    }
    public function collaborator()
    {
        $collaborators=collaborator::orderBy('id', 'DESC')->get();
        return view('admin.collaborator',compact('collaborators'));
    }
    public function submit_add_collaborator(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'collaborator_name'=>'required',
            'location'=>'required',
            'phone'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            
            $add_collaborator=collaborator::create([
                'name'=>$req->collaborator_name,
                'location'=>$req->location,
                'phone'=>$req->phone,
            ]);
            if($add_collaborator){
                return redirect()->back()->with('success_msg', 'Collaborator Added Successfully....');
            }else{
                return redirect()->back()->with('error_msg', 'Unable To add Collaborator...');
            }
        }
    }
    public function submit_edit_collaborator(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'id'=>'required',
            'collaborator_name'=>'required',
            'location'=>'required',
            'phone'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            
            $add_collaborator=collaborator::where('id',$req->id)->update([
                'name'=>$req->collaborator_name,
                'location'=>$req->location,
                'phone'=>$req->phone,
            ]);
            if($add_collaborator){
                return redirect()->back()->with('success_msg', 'Collaborator Updated Successfully....');
            }else{
                return redirect()->back()->with('error_msg', 'Unable To update Collaborator...');
            }
        }
    }
    public function delete_collaborator($id)
    {   
        try{
            $customer=collaborator::where('id',$id)->delete();
            if($customer){
                return redirect()->back()->with('success_msg', 'Customer Deleted Successfully....');
            }else{
                return redirect()->back()->with('error_msg', 'Unable To Delete Customer...');
            }
        }catch(\Exception){
            return redirect()->back()->with('error_msg', ' This Collaborator is Linked With other Customer');
        }
    }
    public function transport()
    {
        $carriers=carrier::orderBy('id', 'DESC')->get();
        return view('admin.transport',compact('carriers'));
    }
    public function submit_add_carrier(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'company_name'=>'required',
            'driver_name'=>'required',
            'phone'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            // dd($req);
            $add_carrier=carrier::create([
                'company_name'=>$req->company_name,
                'driver_name'=>$req->driver_name,
                'phone'=>$req->phone,
            ]);
            if($add_carrier){
                return redirect()->back()->with('success_msg', 'Carrier Added Successfully....');
            }else{
                return redirect()->back()->with('error_msg', 'Unable To add Carrier...');
            }
        }
    }
    public function submit_edit_carrier(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'id'=>'required',
            'company_name'=>'required',
            'driver_name'=>'required',
            'phone'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            
            $add_carrier=carrier::where('id',$req->id)->update([
                'company_name'=>$req->company_name,
                'driver_name'=>$req->driver_name,
                'phone'=>$req->phone,
            ]);
            if($add_carrier){
                return redirect()->back()->with('success_msg', 'Carrier Updated Successfully....');
            }else{
                return redirect()->back()->with('error_msg', 'Unable To update Carrier...');
            }
        }
    }
    public function delete_carrier($id)
    {   
        try{
            $carrier=carrier::where('id',$id)->delete();
            if($carrier){
                return redirect()->back()->with('success_msg', 'Carrier Deleted Successfully....');
            }else{
                return redirect()->back()->with('error_msg', 'Unable To Carrier Customer...');
            }
        }catch(\Exception){
            return redirect()->back()->with('error_msg', ' This Carrier is Linked With other Customer');
        }
    }
    public function get_reservation_customers($going_date,$coming_date) {
        $reservation=reservation::with('customer')->where('going_date','>=',$going_date)->where('going_date','<=',$coming_date)->get();

        return $reservation;
    }

    public function add_group()
    {
        return view('admin.add_group');
    }
    public function view_group()
    {
        return view('admin.view_group');
    }
    public function group_detail()
    {
        return view('admin.group_detail');
    }
    public function edit_group()
    {
        return view('admin.edit_group');
    }
    public function add_package()
    {
        return view('admin.add_package');
    }
    public function view_package()
    {
        $packages=package_service::orderBy('id', 'DESC')->get();
        return view('admin.view_package',compact('packages'));
    }
    public function edit_package()
    {
        return view('admin.edit_package');
    }
    public function add_reservation_with_customer($customer_id)
    {
        $visas=visa_service::with('package_price','individual_price')->get();
        $packages=package_service::get();
        $tickets=ticket_service::get();
        $lodging_madina=lodging_service::with('price_for_package','price_for_individual')->where('city','Madina')->get();
        $lodging_makkah=lodging_service::with('price_for_package','price_for_individual')->where('city','Makkah')->get();   
        $transports=transport_service::with('price_for_adult','price_for_child','price_for_infant')->get();
        $customers=customer::get();
        $extra_services=extra_service::with('service_price')->get();
        $airlines=air_company::get();

        return view('admin.add_reservation',compact(['visas','packages','tickets','lodging_madina','lodging_makkah','transports','extra_services','airlines','customers','customer_id']));
    }
    public function add_reservation()
    {
        $customer_id=0;
        $visas=visa_service::with('package_price','individual_price')->get();
        $packages=package_service::get();
        $tickets=ticket_service::get();
        $lodging_madina=lodging_service::with('price_for_package','price_for_individual')->where('city','Madina')->get();
        $lodging_makkah=lodging_service::with('price_for_package','price_for_individual')->where('city','Makkah')->get();   
        $transports=transport_service::with('price_for_adult','price_for_child','price_for_infant')->get();
        $customers=customer::get();
        $extra_services=extra_service::with('service_price')->get();
        $airlines=air_company::get();

        return view('admin.add_reservation',compact(['visas','packages','tickets','lodging_madina','lodging_makkah','transports','extra_services','airlines','customers','customer_id']));
    }
    public function submit_add_reservation(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'customer'=>'required',
            'service_name'=>'required',
            
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{

            $is_reservation_done=false;
            $reservation=null;
            if($req->service_name=="package"){
                // dd("package");
                $validator = Validator::make($req->all(),[
                    'package_type'=>'required',
                    'package_name'=>'required',
                    'from_package'=>'required',
                    'to_package'=>'required',
                    'length_of_stay'=>'required',
                    'package_service_price'=>'required',
                    'payment_method'=>'required',
                    'total_amount'=>'required',
                    'advance_amount'=>'required',
                    'rest_amount'=>'required',
                ]);
                if($validator->fails())
                {
                    return redirect()->back()->with('error_msg', $validator->errors()->first());
                }
                else{
                    $reservation=reservation::create([
                        'customer_id'=>$req->customer,
                        'service_type'=>$req->service_name,
                        'reservation_status'=>1,
                        'going_date'=>$req->from_package
                    ]);
                    if($reservation){
                        $reservation_service=package_reservation::create([
                            'reservation_id'=>$reservation->id,
                            'package_type'=>$req->package_type,
                            'package_service_id'=>$req->package_name,
                            'from_date'=>$req->from_package,
                            'to_date'=>$req->to_package,
                            'length_of_stay'=>$req->length_of_stay,
                            'service_price'=>$req->package_service_price,
                        ]);
                        if($reservation_service){
                            $is_reservation_done=true;
                        }
                    }

                }

            }else if($req->service_name=="lodging"){
                $validator = Validator::make($req->all(),[
                    'lodging_destination'=>'required',
                    'lodging_madina'=>'required',
                    'room_type_madina'=>'required',
                    'lodging_from_madina'=>'required',
                    'lodging_to_madina'=>'required',
                    'lodging_makkah'=>'required',
                    'room_type_makkah'=>'required',
                    'lodging_from_makkah'=>'required',
                    'lodging_to_makkah'=>'required',
                    'loadging_length_stay'=>'required',
                    'loadging_madina_price'=>'required',
                    'loadging_makkah_price'=>'required',
                    'payment_method'=>'required',
                    'total_amount'=>'required',
                    'advance_amount'=>'required',
                    'rest_amount'=>'required',
                ]);
                if($validator->fails())
                {
                    return redirect()->back()->with('error_msg', $validator->errors()->first());
                }
                else{
                    $reservation=reservation::create([
                        'customer_id'=>$req->customer,
                        'service_type'=>$req->service_name,
                        'reservation_status'=>1,
                        'going_date'=>$req->from_date_makkah
                    ]);
                    if($reservation){
                        $reservation_service=lodging_reservation::create([
                            'reservation_id'=>$reservation->id,
                            'destination'=>$req->lodging_destination,
                            'lodging_in_madina'=>$req->lodging_madina,
                            'room_type_in_madina'=>$req->room_type_madina,
                            'from_date_madina'=>$req->lodging_from_madina,
                            'to_date_madina'=>$req->lodging_to_madina,
                            'lodging_in_makkah'=>$req->lodging_makkah,
                            'room_type_in_makkah'=>$req->room_type_makkah,
                            'from_date_makkah'=>$req->lodging_from_makkah,
                            'to_date_makkah'=>$req->lodging_to_makkah,
                            'length_of_stay'=>$req->loadging_length_stay,
                            'madina_price'=>$req->loadging_madina_price,
                            'makkah_price'=>$req->loadging_makkah_price,
                        ]);
                        if($reservation_service){
                            $is_reservation_done=true;
                        }
                    }

                }

            }else if($req->service_name=="visa"){
                $validator = Validator::make($req->all(),[
                    'visa'=>'required',
                    'from_visa'=>'required',
                    'to_visa'=>'required',
                    'visa_stay'=>'required',
                    'service_price'=>'required',
                    'payment_method'=>'required',
                    'total_amount'=>'required',
                    'advance_amount'=>'required',
                    'rest_amount'=>'required',
                ]);
                if($validator->fails())
                {
                    return redirect()->back()->with('error_msg', $validator->errors()->first());
                }
                else{
                    $reservation=reservation::create([
                        'customer_id'=>$req->customer,
                        'service_type'=>$req->service_name,
                        'reservation_status'=>1,
                        'going_date'=>$req->from_visa
                    ]);
                    if($reservation){
                        $reservation_service=visa_reservation::create([
                            'reservation_id'=>$reservation->id,
                            'visa_type'=>$req->visa,
                            'from_date'=>$req->from_visa,
                            'to_date'=>$req->to_visa,
                            'length_of_stay'=>$req->visa_stay,
                            'service_price'=>$req->service_price,
                        ]);
                        if($reservation_service){
                            $is_reservation_done=true;
                        }
                    }

                }

            }else if($req->service_name=="flight"){
                $validator = Validator::make($req->all(),[
                    'flight_name'=>'required',
                    'flight_from'=>'required',
                    'flight_to'=>'required',
                    'flight_trip_type'=>'required',
                    'flight_type'=>'required',
                    'flight_airline'=>'required',
                    'flight_departure'=>'required',
                    'flight_return'=>'required',
                    'flight_service_price'=>'required',
                ]);
                if($validator->fails())
                {
                    return redirect()->back()->with('error_msg', $validator->errors()->first());
                }
                else{
                    $reservation=reservation::create([
                        'customer_id'=>$req->customer,
                        'service_type'=>$req->service_name,
                        'reservation_status'=>0,
                        'going_date'=>$req->flight_departure
                    ]);
                    if($reservation){
                        $reservation_service=flight_reservation::create([
                            'reservation_id'=>$reservation->id,
                            'flight_id'=>$req->flight_name,
                            'from_airport'=>$req->flight_from,
                            'to_airport'=>$req->flight_to,
                            'trip_type'=>$req->flight_trip_type,
                            'flight_type'=>$req->flight_type,
                            'air_company_id'=>$req->flight_airline,
                            'departure_time'=>$req->flight_departure,
                            'return_time'=>$req->flight_return,
                            'service_price'=>$req->flight_service_price,
                        ]);
                        if($reservation_service){
                            $is_reservation_done=true;
                        }
                    }

                }
            }
            else if($req->service_name=="transport"){
                
                $validator = Validator::make($req->all(),[
                    'transport_id'=>'required',
                    'transport_country'=>'required',
                    'transport_type'=>'required',
                    'transport_trip_type'=>'required',
                    'transport_service_price'=>'required',
                    'payment_method'=>'required',
                    'total_amount'=>'required',
                    'advance_amount'=>'required',
                    'rest_amount'=>'required',
                ]);
                if($validator->fails())
                {
                    return redirect()->back()->with('error_msg', $validator->errors()->first());
                }
                else{
                    $reservation=reservation::create([
                        'customer_id'=>$req->customer,
                        'service_type'=>$req->service_name,
                        'reservation_status'=>1,
                    ]);
                    if($reservation){
                        $reservation_service=transport_reservation::create([
                            'reservation_id'=>$reservation->id,
                            'transport_service_id'=>$req->transport_id,
                            'country'=>$req->transport_country,
                            'type'=>$req->transport_type,
                            'trip_type'=>$req->transport_trip_type,
                            'service_price'=>$req->transport_service_price
                        ]);
                        if($reservation_service){
                            $is_reservation_done=true;
                        }
                    }

                }
            }

            if($is_reservation_done){
                $reservation_id=$reservation->id;

                $payment_details=payment_detail_for_reservation::create([
                    'reservation_id'=>$reservation_id,
                    'payment_method'=>$req->payment_method,
                    'total_amount'=>$req->total_amount,
                    'advance_amount'=>$req->advance_amount,
                    'rest_amount'=>$req->rest_amount
                ]);
                $extra_service_detail=extra_service_for_reservation::create([
                    'reservation_id'=>$reservation_id,
                    'extra_service_id'=>$req->extra_service_name,
                    'type'=>$req->extra_type,
                    'trip_type'=>$req->extra_trip_type,
                    'service_price'=>$req->extra_service_price
                ]);

                if($payment_details && $extra_service_detail){
                    return redirect()->back()->with('success_msg',"Reservation Added Sucessfully");
                }else{
                    return redirect()->back()->with('success_msg',"Reservation Added Sucessfully but extra service and payment detail are saved");

                }
            }else{
                return redirect()->back()->with('error_msg',"Unable to add reservation");
            }



        }
    }



    public function submit_edit_reservation(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'reservation_id'=>'required',
            'customer'=>'required',
            'service_name'=>'required',
            
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{

            $is_reservation_done=false;
            $reservation=null;
           
 
            // if($delete_package){
                if($req->service_name=="package"){
                    // dd("package");
                    $validator = Validator::make($req->all(),[
                        'package_type'=>'required',
                        'package_name'=>'required',
                        'from_package'=>'required',
                        'to_package'=>'required',
                        'length_of_stay'=>'required',
                        'package_service_price'=>'required',
                        'payment_method'=>'required',
                        'total_amount'=>'required',
                        'advance_amount'=>'required',
                        'rest_amount'=>'required',
                    ]);
                    if($validator->fails())
                    {
                        return redirect()->back()->with('error_msg', $validator->errors()->first());
                    }
                    else{
                        $reservation=reservation::where('id',$req->reservation_id)->update([
                            'customer_id'=>$req->customer,
                            'service_type'=>$req->service_name,
                            'reservation_status'=>1,
                        ]);
                        if($reservation){
                            $this->delete_service_reservation($req->reservation_id);
                            $reservation_service=package_reservation::create([
                                'reservation_id'=>$req->reservation_id,
                                'package_type'=>$req->package_type,
                                'package_service_id'=>$req->package_name,
                                'from_date'=>$req->from_package,
                                'to_date'=>$req->to_package,
                                'length_of_stay'=>$req->length_of_stay,
                                'service_price'=>$req->package_service_price,
                            ]);
                            if($reservation_service){
                                $is_reservation_done=true;
                            }
                        }

                    }

                }else if($req->service_name=="lodging"){
                    $validator = Validator::make($req->all(),[
                        'lodging_destination'=>'required',
                        'lodging_madina'=>'required',
                        'room_type_madina'=>'required',
                        'lodging_from_madina'=>'required',
                        'lodging_to_madina'=>'required',
                        'lodging_makkah'=>'required',
                        'room_type_makkah'=>'required',
                        'lodging_from_makkah'=>'required',
                        'lodging_to_makkah'=>'required',
                        'loadging_length_stay'=>'required',
                        'loadging_madina_price'=>'required',
                        'loadging_makkah_price'=>'required',
                        'payment_method'=>'required',
                        'total_amount'=>'required',
                        'advance_amount'=>'required',
                        'rest_amount'=>'required',
                    ]);
                    if($validator->fails())
                    {
                        return redirect()->back()->with('error_msg', $validator->errors()->first());
                    }
                    else{
                        $reservation=reservation::where('id',$req->reservation_id)->update([
                            'customer_id'=>$req->customer,
                            'service_type'=>$req->service_name,
                            'reservation_status'=>1,
                        ]);
                        if($reservation){
                            $this->delete_service_reservation($req->reservation_id);
                            $reservation_service=lodging_reservation::create([
                                'reservation_id'=>$req->reservation_id,
                                'destination'=>$req->lodging_destination,
                                'lodging_in_madina'=>$req->lodging_madina,
                                'room_type_in_madina'=>$req->room_type_madina,
                                'from_date_madina'=>$req->lodging_from_madina,
                                'to_date_madina'=>$req->lodging_to_madina,
                                'lodging_in_makkah'=>$req->lodging_makkah,
                                'room_type_in_makkah'=>$req->room_type_makkah,
                                'from_date_makkah'=>$req->lodging_from_makkah,
                                'to_date_makkah'=>$req->lodging_to_makkah,
                                'length_of_stay'=>$req->loadging_length_stay,
                                'madina_price'=>$req->loadging_madina_price,
                                'makkah_price'=>$req->loadging_makkah_price,
                            ]);
                            if($reservation_service){
                                $is_reservation_done=true;
                            }
                        }

                    }

                }else if($req->service_name=="visa"){
                    $validator = Validator::make($req->all(),[
                        'visa'=>'required',
                        'from_visa'=>'required',
                        'to_visa'=>'required',
                        'visa_stay'=>'required',
                        'service_price'=>'required',
                        'payment_method'=>'required',
                        'total_amount'=>'required',
                        'advance_amount'=>'required',
                        'rest_amount'=>'required',
                    ]);
                    if($validator->fails())
                    {
                        return redirect()->back()->with('error_msg', $validator->errors()->first());
                    }
                    else{
                        $reservation=reservation::where('id',$req->reservation_id)->update([
                            'customer_id'=>$req->customer,
                            'service_type'=>$req->service_name,
                            'reservation_status'=>1,
                        ]);
                        if($reservation){
                            $this->delete_service_reservation($req->reservation_id);
                            $reservation_service=visa_reservation::create([
                                'reservation_id'=>$req->reservation_id,
                                'visa_type'=>$req->visa,
                                'from_date'=>$req->from_visa,
                                'to_date'=>$req->to_visa,
                                'length_of_stay'=>$req->visa_stay,
                                'service_price'=>$req->service_price,
                            ]);
                            if($reservation_service){
                                $is_reservation_done=true;
                            }
                        }

                    }

                }else if($req->service_name=="flight"){
                    $this->delete_service_reservation($req->reservation_id);
                    $validator = Validator::make($req->all(),[
                        'flight_name'=>'required',
                        'flight_from'=>'required',
                        'flight_to'=>'required',
                        'flight_trip_type'=>'required',
                        'flight_type'=>'required',
                        'flight_airline'=>'required',
                        'flight_departure'=>'required',
                        'flight_return'=>'required',
                        'flight_service_price'=>'required',
                    ]);
                    if($validator->fails())
                    {
                        return redirect()->back()->with('error_msg', $validator->errors()->first());
                    }
                    else{
                        $reservation=reservation::where('id',$req->reservation_id)->update([
                            'customer_id'=>$req->customer,
                            'service_type'=>$req->service_name,
                            'reservation_status'=>0,
                        ]);
                        if($reservation){
                            $this->delete_service_reservation($req->reservation_id);
                            $reservation_service=flight_reservation::create([
                                'reservation_id'=>$req->reservation_id,
                                'flight_id'=>$req->flight_name,
                                'from_airport'=>$req->flight_from,
                                'to_airport'=>$req->flight_to,
                                'trip_type'=>$req->flight_trip_type,
                                'flight_type'=>$req->flight_type,
                                'air_company_id'=>$req->flight_airline,
                                'departure_time'=>$req->flight_departure,
                                'return_time'=>$req->flight_return,
                                'service_price'=>$req->flight_service_price,
                            ]);
                            if($reservation_service){
                                $is_reservation_done=true;
                            }
                        }

                    }
                }
                else if($req->service_name=="transport"){
                    
                    $validator = Validator::make($req->all(),[
                        'transport_id'=>'required',
                        'transport_country'=>'required',
                        'transport_type'=>'required',
                        'transport_trip_type'=>'required',
                        'transport_service_price'=>'required',
                        'payment_method'=>'required',
                        'total_amount'=>'required',
                        'advance_amount'=>'required',
                        'rest_amount'=>'required',
                    ]);
                    if($validator->fails())
                    {
                        return redirect()->back()->with('error_msg', $validator->errors()->first());
                    }
                    else{
                        $reservation=reservation::where('id',$req->reservation_id)->update([
                            'customer_id'=>$req->customer,
                            'service_type'=>$req->service_name,
                            'reservation_status'=>1,
                        ]);
                        if($reservation){
                            $this->delete_service_reservation($req->reservation_id);
                            $reservation_service=transport_reservation::create([
                                'reservation_id'=>$req->reservation_id,
                                'transport_service_id'=>$req->transport_id,
                                'country'=>$req->transport_country,
                                'type'=>$req->transport_type,
                                'trip_type'=>$req->transport_trip_type,
                                'service_price'=>$req->transport_service_price
                            ]);
                            if($reservation_service){
                                $is_reservation_done=true;
                            }
                        }

                    }
                }

                if($is_reservation_done){

                    $payment_details=payment_detail_for_reservation::where('reservation_id',$req->reservation_id)->update([
                        'payment_method'=>$req->payment_method,
                        'total_amount'=>$req->total_amount,
                        'advance_amount'=>$req->advance_amount,
                        'rest_amount'=>$req->rest_amount
                    ]);
                    $extra_service_detail=extra_service_for_reservation::where('reservation_id',$req->reservation_id)->update([
                        'extra_service_id'=>$req->extra_service_name,
                        'type'=>$req->extra_type,
                        'trip_type'=>$req->extra_trip_type,
                        'service_price'=>$req->extra_service_price
                    ]);

                    if($payment_details && $extra_service_detail){
                        return redirect()->back()->with('success_msg',"Reservation Updated Sucessfully");
                    }else{
                        return redirect()->back()->with('success_msg',"Reservation Updated Sucessfully but extra service and payment detail are saved");

                    }
                }else{
                    return redirect()->back()->with('error_msg',"Unable to update reservation");
                }
            // }else{
            //     return redirect()->back()->with('error_msg',"Unable to update reservation");

            // }


            



        }
    }
    public function delete_reservation($id)
    {
        try{
            $delete_reservation=reservation::where('id',$id)->delete();
            if($delete_reservation){
                return redirect()->back()->with('success_msg', 'Reservation Deleted Successfully....');
            }else{
                return redirect()->back()->with('error_msg', 'Unable To delete Reservation...');
            }
        }catch(\Exception){
            return redirect()->back()->with('error_msg', ' This Reservation is Linked With something else');
        }
        // return view('admin.view_ticking_history');
    }
    public function view_ticking_history()
    {
        return view('admin.view_ticking_history');
    }
    public function view_reservations()
    {
        $reservations=reservation::with(['customer.linkedWith','customer.Collaborator','package','lodging','visa','flight','transport','extra_service','payment'])->get();
        // dd($reservations);
        return view('admin.view_reservations',compact('reservations'));
    }
    public function edit_reservation($id)
    {
        $visas=visa_service::with('package_price','individual_price')->get();
        $packages=package_service::get();
        $tickets=ticket_service::get();
        $lodging_madina=lodging_service::with('price_for_package','price_for_individual')->where('city','Madina')->get();
        $lodging_makkah=lodging_service::with('price_for_package','price_for_individual')->where('city','Makkah')->get();   
        $transports=transport_service::with('price_for_adult','price_for_child','price_for_infant')->get();
        $customers=customer::get();
        $extra_services=extra_service::with('service_price')->get();
        $airlines=air_company::get();

        $reservation=reservation::with(['customer.linkedWith','customer.Collaborator','package','lodging','visa','flight','transport','extra_service','payment'])->where('id',$id)->first();
        
        return view('admin.edit_reservation',compact('visas','packages','tickets','lodging_madina','lodging_makkah','transports','extra_services','airlines','customers','reservation'));
    }
    public function view_group_reservation()
    {
        return view('admin.view_group_reservation');
    }
    
    public function individual_reservation_detail()
    {
        return view('admin.individual_reservation_detail');
    }
    public function group_reservation_detail()
    {
        return view('admin.group_reservation_detail');
    }
    public function accounting()
    {
        return view('admin.accounting');
    }
    public function compta_accounting()
    {
        return view('admin.compta_accounting');
    }
    public function services()
    {
        return view('admin.services');
    }
    public function package_services()
    {
        $visas=visa_service::with('package_price','individual_price')->get();
        $tickets=ticket_service::get();
        $lodging_madina=lodging_service::with('price_for_package','price_for_individual')->where('city','Madina')->get();
        $lodging_makkah=lodging_service::with('price_for_package','price_for_individual')->where('city','Makkah')->get();
        return view('admin.package_services',compact(['visas','tickets','lodging_madina','lodging_makkah']));
    }
    public function submit_add_package_services(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'package_name'=>'required',
            'available_from'=>'required',
            'available_to'=>'required',
            'visa'=>'required',
            'makkah_lodging'=>'required',
            'madina_lodging'=>'required',
            'ticket'=>'required',
            'madina_room_type'=>'required',
            'makkah_room_type'=>'required',
            'adult_package'=>'required',
            'child_package'=>'required',
            'infant_package'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            
            $package_service=package_service::create([
                'name'=>$req->package_name,
                'available_from'=>$req->available_from,
                'available_to'=>$req->available_to,
                'visa'=>$req->visa,
                'lodging_in_makkah'=>$req->makkah_lodging,
                'lodging_in_madina'=>$req->madina_lodging,
                'room_type_makkah'=>$req->makkah_room_type,
                'room_type_madina'=>$req->madina_room_type,
                'ticket'=>$req->ticket,
                'price_for_adult'=>$req->adult_package,
                'price_for_child'=>$req->child_package,
                'price_for_infant'=>$req->infant_package,
            ]);
            if($package_service){
                return redirect()->back()->with('success_msg', 'Package Added Successfully....');
            }else{
                return redirect()->back()->with('error_msg', 'Unable To add Package...');
            }
        }
    }
    public function edit_package_services($id)
    {
        $visas=visa_service::with('package_price','individual_price')->get();
        $tickets=ticket_service::get();
        $lodging_madina=lodging_service::with('price_for_package','price_for_individual')->where('city','Madina')->get();
        $lodging_makkah=lodging_service::with('price_for_package','price_for_individual')->where('city','Makkah')->get();
        
        $package=package_service::where('id',$id)->first();

        return view('admin.edit_package_services',compact(['package','visas','tickets','lodging_madina','lodging_makkah']));
    }
    public function submit_edit_package_services(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'package_id'=>'required',
            'package_name'=>'required',
            'available_from'=>'required',
            'available_to'=>'required',
            'visa'=>'required',
            'makkah_lodging'=>'required',
            'madina_lodging'=>'required',
            'madina_room_type'=>'required',
            'makkah_room_type'=>'required',
            'ticket'=>'required',
            'adult_package'=>'required',
            'child_package'=>'required',
            'infant_package'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            
            $package_service=package_service::where('id',$req->package_id)->update([
                'name'=>$req->package_name,
                'available_from'=>$req->available_from,
                'available_to'=>$req->available_to,
                'visa'=>$req->visa,
                'lodging_in_makkah'=>$req->makkah_lodging,
                'lodging_in_madina'=>$req->madina_lodging,
                'room_type_makkah'=>$req->makkah_room_type,
                'room_type_madina'=>$req->madina_room_type,
                'ticket'=>$req->ticket,
                'price_for_adult'=>$req->adult_package,
                'price_for_child'=>$req->child_package,
                'price_for_infant'=>$req->infant_package,
            ]);
            if($package_service){
                return redirect()->back()->with('success_msg', 'Package Updated Successfully....');
            }else{
                return redirect()->back()->with('error_msg', 'Unable To update Package...');
            }
        }
    }
    public function delete_package_services($id)
    {   
        try{
            $package=package_service::where('id',$id)->delete();
            if($package){
                return redirect()->back()->with('success_msg', 'package Deleted Successfully....');
            }else{
                return redirect()->back()->with('error_msg', 'Unable To delete package...');
            }
        }catch(\Exception){
            return redirect()->back()->with('error_msg', ' This Visa is Linked With something else');
        }
    }
    public function visa_services()
    {
        return view('admin.visa_services');
    }
    public function submit_add_visa_services(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'visa_name'=>'required',
            'package_adult_buying'=>'required',
            'package_child_buying'=>'required',
            'package_infant_buying'=>'required',
            'package_adult_selling'=>'required',
            'package_child_selling'=>'required',
            'package_infant_selling'=>'required',
            'individual_adult_buying'=>'required',
            'individual_child_buying'=>'required',
            'individual_infant_buying'=>'required',
            'individual_adult_selling'=>'required',
            'individual_child_selling'=>'required',
            'individual_infant_selling'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            
            $visa_service=visa_service::create([
                'visa_name'=>$req->visa_name,
            ]);
            if($visa_service){
                $visa_price_for_package=visa_price_for_package::create([
                'visa_service_id'=>$visa_service->id,
                'adult_buying'=>$req->package_adult_buying,
                'child_buying'=>$req->package_child_buying,
                'infant_buying'=>$req->package_infant_buying,
                'adult_selling'=>$req->package_adult_selling,
                'child_selling'=>$req->package_child_selling,
                'infant_selling'=>$req->package_infant_selling,
            ]);
            
            $visa_price_for_individual=visa_price_for_individual::create([
                'visa_service_id'=>$visa_service->id,
                'adult_buying'=>$req->individual_adult_buying,
                'child_buying'=>$req->individual_child_buying,
                'infant_buying'=>$req->individual_infant_buying,
                'adult_selling'=>$req->individual_adult_selling,
                'child_selling'=>$req->individual_child_selling,
                'infant_selling'=>$req->individual_infant_selling,
                ]);
                if($visa_price_for_individual && $visa_price_for_individual){
                    return redirect()->back()->with('success_msg', 'Visa Added Successfully....');
                }else{
                    return redirect()->back()->with('success_msg', 'Visa Added Successfully But Price is not added....');
                }

            }else{
                return redirect()->back()->with('error_msg', 'Unable To add Visa...');
            }
        }
    }
    public function edit_visa_services($id)
    {
        $visa=visa_service::with('package_price','individual_price')->where('id',$id)->first();
        
        return view('admin.edit_visa_services',compact('visa'));
    }
    public function submit_edit_visa_services(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'visa_id'=>'required',
            'visa_name'=>'required',
            'package_adult_buying'=>'required',
            'package_child_buying'=>'required',
            'package_infant_buying'=>'required',
            'package_adult_selling'=>'required',
            'package_child_selling'=>'required',
            'package_infant_selling'=>'required',
            'individual_adult_buying'=>'required',
            'individual_child_buying'=>'required',
            'individual_infant_buying'=>'required',
            'individual_adult_selling'=>'required',
            'individual_child_selling'=>'required',
            'individual_infant_selling'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            
            $visa_service=visa_service::where('id',$req->visa_id)->update([
                'visa_name'=>$req->visa_name,
            ]);
            if($visa_service){
                $delete_visa_price_for_package=visa_price_for_package::where('visa_service_id',$req->visa_id)->delete();
                $delete_visa_price_for_individual=visa_price_for_individual::where('visa_service_id',$req->visa_id)->delete();
                

                $visa_price_for_package=visa_price_for_package::create([
                'visa_service_id'=>$req->visa_id,
                'adult_buying'=>$req->package_adult_buying,
                'child_buying'=>$req->package_child_buying,
                'infant_buying'=>$req->package_infant_buying,
                'adult_selling'=>$req->package_adult_selling,
                'child_selling'=>$req->package_child_selling,
                'infant_selling'=>$req->package_infant_selling,
            ]);
            
            $visa_price_for_individual=visa_price_for_individual::create([
                'visa_service_id'=>$req->visa_id,
                'adult_buying'=>$req->individual_adult_buying,
                'child_buying'=>$req->individual_child_buying,
                'infant_buying'=>$req->individual_infant_buying,
                'adult_selling'=>$req->individual_adult_selling,
                'child_selling'=>$req->individual_child_selling,
                'infant_selling'=>$req->individual_infant_selling,
                ]);
                if($visa_price_for_individual && $visa_price_for_individual){
                    return redirect()->back()->with('success_msg', 'Visa Updated Successfully....');
                }else{
                    return redirect()->back()->with('success_msg', 'Visa Updated Successfully But Price is not updated....');
                }

            }else{
                return redirect()->back()->with('error_msg', 'Unable To update Visa...');
            }
        }
    }
    public function delete_visa_services($id)
    {   
        try{
            $visa=visa_service::where('id',$id)->delete();
            if($visa){
                return redirect()->back()->with('success_msg', 'visa Deleted Successfully....');
            }else{
                return redirect()->back()->with('error_msg', 'Unable To delete visa...');
            }
        }catch(\Exception){
            return redirect()->back()->with('error_msg', ' This Visa is Linked With something else');
        }
    }
    public function lodging_services()
    {
        return view('admin.lodging_services');
    }
    public function submit_add_lodging_services(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'hotel_name'=>'required',
            'city'=>'required',
            'hotel_type'=>'required',
            'available_from'=>'required',
            'available_to'=>'required',
            'room_two'=>'required',
            'room_three'=>'required',
            'room_four'=>'required',
            'room_five'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            $lodging_service=lodging_service::create([
                'hotel_name'=>$req->hotel_name,
                'city'=>$req->city,
                'hotel_type'=>$req->hotel_type,
                'available_from'=>$req->available_from,
                'available_to'=>$req->available_to,
                'rooms_for_two'=>$req->room_two,
                'rooms_for_three'=>$req->room_three,
                'rooms_for_four'=>$req->room_four,
                'rooms_for_five'=>$req->room_five,
            ]);
            // dd($req);
            if($lodging_service){
                $lodging_service_price_for_individual=lodging_service_price_for_individual::create([
                    'lodging_service_id'=>$lodging_service->id,
                    'room_two_buying_adult'=>$req->individual_adult_two_buying,
                    'room_two_selling_adult'=>$req->individual_adult_two_selling,
                    'room_two_buying_child'=>$req->individual_child_two_buying,
                    'room_two_selling_child'=>$req->individual_child_two_selling,
                    'room_two_buying_infant'=>$req->individual_infant_two_buying,
                    'room_two_selling_infant'=>$req->individual_infant_two_selling,
                    'room_three_buying_adult'=>$req->individual_adult_three_buying,
                    'room_three_selling_adult'=>$req->individual_adult_three_selling,
                    'room_three_buying_child'=>$req->individual_child_three_buying,
                    'room_three_selling_child'=>$req->individual_child_three_selling,
                    'room_three_buying_infant'=>$req->individual_infant_three_buying,
                    'room_three_selling_infant'=>$req->individual_infant_three_selling,
                    'room_four_buying_adult'=>$req->individual_adult_four_buying,
                    'room_four_selling_adult'=>$req->individual_adult_four_selling,
                    'room_four_buying_child'=>$req->individual_child_four_buying,
                    'room_four_selling_child'=>$req->individual_child_four_selling,
                    'room_four_buying_infant'=>$req->individual_infant_four_buying,
                    'room_four_selling_infant'=>$req->individual_infant_four_selling,
                    'room_five_buying_adult'=>$req->individual_adult_five_buying,
                    'room_five_selling_adult'=>$req->individual_adult_five_selling,
                    'room_five_buying_child'=>$req->individual_child_five_buying,
                    'room_five_selling_child'=>$req->individual_child_five_selling,
                    'room_five_buying_infant'=>$req->individual_infant_five_buying,
                    'room_five_selling_infant'=>$req->individual_infant_five_selling,
            ]);
                $lodging_service_price_for_package=lodging_service_price_for_package::create([

                    'lodging_service_id'=>$lodging_service->id,
                    'room_two_buying_adult'=>$req->package_adult_two_buying,
                    'room_two_selling_adult'=>$req->package_adult_two_selling,
                    'room_two_buying_child'=>$req->package_child_two_buying,
                    'room_two_selling_child'=>$req->package_child_two_selling,
                    'room_two_buying_infant'=>$req->package_infant_two_buying,
                    'room_two_selling_infant'=>$req->package_infant_two_selling,
                    'room_three_buying_adult'=>$req->package_adult_three_buying,
                    'room_three_selling_adult'=>$req->package_adult_three_selling,
                    'room_three_buying_child'=>$req->package_child_three_buying,
                    'room_three_selling_child'=>$req->package_child_three_selling,
                    'room_three_buying_infant'=>$req->package_infant_three_buying,
                    'room_three_selling_infant'=>$req->package_infant_three_selling,
                    'room_four_buying_adult'=>$req->package_adult_four_buying,
                    'room_four_selling_adult'=>$req->package_adult_four_selling,
                    'room_four_buying_child'=>$req->package_child_four_buying,
                    'room_four_selling_child'=>$req->package_child_four_selling,
                    'room_four_buying_infant'=>$req->package_infant_four_buying,
                    'room_four_selling_infant'=>$req->package_infant_four_selling,
                    'room_five_buying_adult'=>$req->package_adult_five_buying,
                    'room_five_selling_adult'=>$req->package_adult_five_selling,
                    'room_five_buying_child'=>$req->package_child_five_buying,
                    'room_five_selling_child'=>$req->package_child_five_selling,
                    'room_five_buying_infant'=>$req->package_infant_five_buying,
                    'room_five_selling_infant'=>$req->package_infant_five_selling,
            ]);
            
                
                if($lodging_service_price_for_individual && $lodging_service_price_for_package){
                    return redirect()->back()->with('success_msg', 'Lodging Added Successfully....');
                }else{
                    return redirect()->back()->with('success_msg', 'Lodging Added Successfully But Price is not added....');
                }

            }else{
                return redirect()->back()->with('error_msg', 'Unable To add Lodging...');
            }
        }
    }
    public function edit_lodging_services($id)
    {
        $lodging=lodging_service::with('price_for_package','price_for_individual')->where('id',$id)->first();
        return view('admin.edit_lodging_service',compact('lodging'));
    }
    public function submit_edit_lodging_services(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'hotel_id'=>'required',
            'hotel_name'=>'required',
            'city'=>'required',
            'hotel_type'=>'required',
            'available_from'=>'required',
            'available_to'=>'required',
            'room_two'=>'required',
            'room_three'=>'required',
            'room_four'=>'required',
            'room_five'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            $lodging_service=lodging_service::where('id',$req->hotel_id)->update([
                'hotel_name'=>$req->hotel_name,
                'city'=>$req->city,
                'hotel_type'=>$req->hotel_type,
                'available_from'=>$req->available_from,
                'available_to'=>$req->available_to,
                'rooms_for_two'=>$req->room_two,
                'rooms_for_three'=>$req->room_three,
                'rooms_for_four'=>$req->room_four,
                'rooms_for_five'=>$req->room_five,
            ]);
            // dd($req);
            if($lodging_service){
                $delete_lodging_service_price_for_individual=lodging_service_price_for_individual::where('lodging_service_id',$req->hotel_id)->delete();
                $delete_lodging_service_price_for_package=lodging_service_price_for_package::where('lodging_service_id',$req->hotel_id)->delete();


                $lodging_service_price_for_individual=lodging_service_price_for_individual::create([
                    'lodging_service_id'=>$req->hotel_id,
                    'room_two_buying_adult'=>$req->individual_adult_two_buying,
                    'room_two_selling_adult'=>$req->individual_adult_two_selling,
                    'room_two_buying_child'=>$req->individual_child_two_buying,
                    'room_two_selling_child'=>$req->individual_child_two_selling,
                    'room_two_buying_infant'=>$req->individual_infant_two_buying,
                    'room_two_selling_infant'=>$req->individual_infant_two_selling,
                    'room_three_buying_adult'=>$req->individual_adult_three_buying,
                    'room_three_selling_adult'=>$req->individual_adult_three_selling,
                    'room_three_buying_child'=>$req->individual_child_three_buying,
                    'room_three_selling_child'=>$req->individual_child_three_selling,
                    'room_three_buying_infant'=>$req->individual_infant_three_buying,
                    'room_three_selling_infant'=>$req->individual_infant_three_selling,
                    'room_four_buying_adult'=>$req->individual_adult_four_buying,
                    'room_four_selling_adult'=>$req->individual_adult_four_selling,
                    'room_four_buying_child'=>$req->individual_child_four_buying,
                    'room_four_selling_child'=>$req->individual_child_four_selling,
                    'room_four_buying_infant'=>$req->individual_infant_four_buying,
                    'room_four_selling_infant'=>$req->individual_infant_four_selling,
                    'room_five_buying_adult'=>$req->individual_adult_five_buying,
                    'room_five_selling_adult'=>$req->individual_adult_five_selling,
                    'room_five_buying_child'=>$req->individual_child_five_buying,
                    'room_five_selling_child'=>$req->individual_child_five_selling,
                    'room_five_buying_infant'=>$req->individual_infant_five_buying,
                    'room_five_selling_infant'=>$req->individual_infant_five_selling,
                ]);
                $lodging_service_price_for_package=lodging_service_price_for_package::create([

                    'lodging_service_id'=>$req->hotel_id,
                    'room_two_buying_adult'=>$req->package_adult_two_buying,
                    'room_two_selling_adult'=>$req->package_adult_two_selling,
                    'room_two_buying_child'=>$req->package_child_two_buying,
                    'room_two_selling_child'=>$req->package_child_two_selling,
                    'room_two_buying_infant'=>$req->package_infant_two_buying,
                    'room_two_selling_infant'=>$req->package_infant_two_selling,
                    'room_three_buying_adult'=>$req->package_adult_three_buying,
                    'room_three_selling_adult'=>$req->package_adult_three_selling,
                    'room_three_buying_child'=>$req->package_child_three_buying,
                    'room_three_selling_child'=>$req->package_child_three_selling,
                    'room_three_buying_infant'=>$req->package_infant_three_buying,
                    'room_three_selling_infant'=>$req->package_infant_three_selling,
                    'room_four_buying_adult'=>$req->package_adult_four_buying,
                    'room_four_selling_adult'=>$req->package_adult_four_selling,
                    'room_four_buying_child'=>$req->package_child_four_buying,
                    'room_four_selling_child'=>$req->package_child_four_selling,
                    'room_four_buying_infant'=>$req->package_infant_four_buying,
                    'room_four_selling_infant'=>$req->package_infant_four_selling,
                    'room_five_buying_adult'=>$req->package_adult_five_buying,
                    'room_five_selling_adult'=>$req->package_adult_five_selling,
                    'room_five_buying_child'=>$req->package_child_five_buying,
                    'room_five_selling_child'=>$req->package_child_five_selling,
                    'room_five_buying_infant'=>$req->package_infant_five_buying,
                    'room_five_selling_infant'=>$req->package_infant_five_selling,
                ]);
            
                
                if($lodging_service_price_for_individual && $lodging_service_price_for_package){
                    return redirect()->back()->with('success_msg', 'Lodging Updated Successfully....');
                }else{
                    return redirect()->back()->with('success_msg', 'Lodging Uptated Successfully But Price is not added....');
                }

            }else{
                return redirect()->back()->with('error_msg', 'Unable To update Lodging...');
            }
        }
    }
    public function delete_lodging_services($id)
    {   
        try{
            $visa=lodging_service::where('id',$id)->delete();
            if($visa){
                return redirect()->back()->with('success_msg', 'Lodging Deleted Successfully....');
            }else{
                return redirect()->back()->with('error_msg', 'Unable To visa Lodging...');
            }
        }catch(\Exception){
            return redirect()->back()->with('error_msg', ' This Lodging is Linked With something else');
        }
    }
    public function tickets_services()
    {
        $airlines=air_company::orderBy('id', 'DESC')->get();
        return view('admin.tickets_services',compact('airlines'));
    }
    public function submit_add_tickets_services(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'ticket_name'=>'required',
            'ticket_type'=>'required',
            'flight_type'=>'required',
            'air_company'=>'required',
            'buy_price'=>'required',
            'sell_price'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            
            $ticket_service=ticket_service::create([
                'name'=>$req->ticket_name,
                'type'=>$req->ticket_type,
                'flight_type'=>$req->flight_type,
                'air_company'=>$req->air_company,
                'buying_price_for_package'=>$req->buy_price,
                'selling_price_for_package'=>$req->sell_price
            ]);
            if($ticket_service){
                return redirect()->back()->with('success_msg', 'Ticket Added Successfully....');
            }else{
                return redirect()->back()->with('error_msg', 'Unable To add Ticket...');
            }
        }
    }
    public function edit_tickets_services($id)
    {
        $airlines=air_company::orderBy('id', 'DESC')->get();
        $ticket=ticket_service::where('id',$id)->first();
        return view('admin.edit_tickets_services',compact('airlines','ticket'));
    }


    public function submit_edit_tickets_services(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'ticket_id'=>'required',
            'ticket_name'=>'required',
            'ticket_type'=>'required',
            'flight_type'=>'required',
            'air_company'=>'required',
            'buy_price'=>'required',
            'sell_price'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            
            $ticket_service=ticket_service::where('id',$req->ticket_id)->update([
                'name'=>$req->ticket_name,
                'type'=>$req->ticket_type,
                'flight_type'=>$req->flight_type,
                'air_company'=>$req->air_company,
                'buying_price_for_package'=>$req->buy_price,
                'selling_price_for_package'=>$req->sell_price
            ]);
            if($ticket_service){
                return redirect()->back()->with('success_msg', 'Ticket Updated Successfully....');
            }else{
                return redirect()->back()->with('error_msg', 'Unable To update Ticket...');
            }
        }
    }
    public function delete_ticket_services($id)
    {   
        try{
            $ticket_service=ticket_service::where('id',$id)->delete();
            if($ticket_service){
                return redirect()->back()->with('success_msg', 'Ticket service Deleted Successfully....');
            }else{
                return redirect()->back()->with('error_msg', 'Unable To delete Ticket service...');
            }
        }catch(\Exception){
            return redirect()->back()->with('error_msg', ' This Ticket service is Linked With something else');
        }
    }

    public function transport_services()
    {
        return view('admin.transport_services');
    }
    public function submit_add_transport_services(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'transport_name'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            
            $transport_service=transport_service::create([
                'name'=>$req->transport_name,
            ]);

            if($transport_service){

                $transport_service_price_for_adult=transport_service_price_for_adult::create([
                    'transport_service_id'=>$transport_service->id,
                    'vip_morroco_buying_one'=>$req->vip_morroco_buying,
                    'vip_morroco_selling_one'=>$req->vip_morroco_selling,
                    'vip_morroco_buying_round'=>$req->vip_morroco_buying_round,
                    'vip_morroco_selling_round'=>$req->vip_morroco_selling_round,
                    'vip_ksa_buying_one'=>$req->vip_ksa_buying,
                    'vip_ksa_selling_one'=>$req->vip_ksa_selling,
                    'vip_ksa_buying_round'=>$req->vip_ksa_buying_round,
                    'vip_ksa_selling_round'=>$req->vip_ksa_selling_round,
                    'normal_morroco_buying_one'=>$req->normal_morroco_buying,
                    'normal_morroco_selling_one'=>$req->normal_morroco_selling,
                    'normal_morroco_buying_round'=>$req->normal_morroco_buying_round,
                    'normal_morroco_selling_round'=>$req->normal_morroco_selling_round,
                    'normal_ksa_buying_one'=>$req->normal_ksa_buying,
                    'normal_ksa_selling_one'=>$req->normal_ksa_selling,
                    'normal_ksa_buying_round'=>$req->normal_ksa_buying_round,
                    'normal_ksa_selling_round'=>$req->normal_ksa_selling_round
                ]);

                $transport_service_price_for_child=transport_service_price_for_child::create([
                    'transport_service_id'=>$transport_service->id,
                    'vip_morroco_buying_one'=>$req->vip_child_morroco_buying,
                    'vip_morroco_selling_one'=>$req->vip_child_morroco_selling,
                    'vip_morroco_buying_round'=>$req->vip_child_morroco_buying_round,
                    'vip_morroco_selling_round'=>$req->vip_child_morroco_selling_round,
                    'vip_ksa_buying_one'=>$req->vip_child_ksa_buying,
                    'vip_ksa_selling_one'=>$req->vip_child_ksa_selling,
                    'vip_ksa_buying_round'=>$req->vip_child_ksa_buying_round,
                    'vip_ksa_selling_round'=>$req->vip_child_ksa_selling_round,
                    'normal_morroco_buying_one'=>$req->normal_child_morroco_buying,
                    'normal_morroco_selling_one'=>$req->normal_child_morroco_selling,
                    'normal_morroco_buying_round'=>$req->normal_child_morroco_buying_round,
                    'normal_morroco_selling_round'=>$req->normal_child_morroco_selling_round,
                    'normal_ksa_buying_one'=>$req->normal_child_ksa_buying,
                    'normal_ksa_selling_one'=>$req->normal_child_ksa_selling,
                    'normal_ksa_buying_round'=>$req->normal_child_ksa_buying_round,
                    'normal_ksa_selling_round'=>$req->normal_child_ksa_selling_round
                ]);
                
                $transport_service_price_for_infant=transport_service_price_for_infant::create([
                    'transport_service_id'=>$transport_service->id,
                    'vip_morroco_buying_one'=>$req->vip_infant_morroco_buying,
                    'vip_morroco_selling_one'=>$req->vip_infant_morroco_selling,
                    'vip_morroco_buying_round'=>$req->vip_infant_morroco_buying_round,
                    'vip_morroco_selling_round'=>$req->vip_infant_morroco_selling_round,
                    'vip_ksa_buying_one'=>$req->vip_infant_ksa_buying,
                    'vip_ksa_selling_one'=>$req->vip_infant_ksa_selling,
                    'vip_ksa_buying_round'=>$req->vip_infant_ksa_buying_round,
                    'vip_ksa_selling_round'=>$req->vip_infant_ksa_selling_round,
                    'normal_morroco_buying_one'=>$req->normal_infant_morroco_buying,
                    'normal_morroco_selling_one'=>$req->normal_infant_morroco_selling,
                    'normal_morroco_buying_round'=>$req->normal_infant_morroco_buying_round,
                    'normal_morroco_selling_round'=>$req->normal_infant_morroco_selling_round,
                    'normal_ksa_buying_one'=>$req->normal_infant_ksa_buying,
                    'normal_ksa_selling_one'=>$req->normal_infant_ksa_selling,
                    'normal_ksa_buying_round'=>$req->normal_infant_ksa_buying_round,
                    'normal_ksa_selling_round'=>$req->normal_infant_ksa_selling_round
                ]);

                if($transport_service_price_for_adult && $transport_service_price_for_child && $transport_service_price_for_infant){

                    return redirect()->back()->with('success_msg', 'Transport Added Successfully....');
                }else{
                    return redirect()->back()->with('success_msg', 'Transport Added Successfully But unable to add price....');
                }

            }else{
                return redirect()->back()->with('error_msg', 'Unable To add Transport...');
            }
        }
    }
    public function edit_transport_service($id)
    {
        $transport=transport_service::with('price_for_adult','price_for_child','price_for_infant')->where('id',$id)->first();
        return view('admin.edit_transport_service',compact('transport'));
    }
    public function submit_edit_transport_service(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'transport_id'=>'required',
            'transport_name'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            
            $transport_service=transport_service::where('id',$req->transport_id)->update([
                'name'=>$req->transport_name,
            ]);

            if($transport_service){
                $delete_transport_service_price_for_adult=transport_service_price_for_adult::where('transport_service_id',$req->transport_id)->delete();
                $delete_transport_service_price_for_child=transport_service_price_for_child::where('transport_service_id',$req->transport_id)->delete();
                $delete_transport_service_price_for_infant=transport_service_price_for_infant::where('transport_service_id',$req->transport_id)->delete();
                
                $transport_service_price_for_adult=transport_service_price_for_adult::create([
                    'transport_service_id'=>$req->transport_id,
                    'vip_morroco_buying_one'=>$req->vip_morroco_buying,
                    'vip_morroco_selling_one'=>$req->vip_morroco_selling,
                    'vip_morroco_buying_round'=>$req->vip_morroco_buying_round,
                    'vip_morroco_selling_round'=>$req->vip_morroco_selling_round,
                    'vip_ksa_buying_one'=>$req->vip_ksa_buying,
                    'vip_ksa_selling_one'=>$req->vip_ksa_selling,
                    'vip_ksa_buying_round'=>$req->vip_ksa_buying_round,
                    'vip_ksa_selling_round'=>$req->vip_ksa_selling_round,
                    'normal_morroco_buying_one'=>$req->normal_morroco_buying,
                    'normal_morroco_selling_one'=>$req->normal_morroco_selling,
                    'normal_morroco_buying_round'=>$req->normal_morroco_buying_round,
                    'normal_morroco_selling_round'=>$req->normal_morroco_selling_round,
                    'normal_ksa_buying_one'=>$req->normal_ksa_buying,
                    'normal_ksa_selling_one'=>$req->normal_ksa_selling,
                    'normal_ksa_buying_round'=>$req->normal_ksa_buying_round,
                    'normal_ksa_selling_round'=>$req->normal_ksa_selling_round
                ]);

                $transport_service_price_for_child=transport_service_price_for_child::create([
                    'transport_service_id'=>$req->transport_id,
                    'vip_morroco_buying_one'=>$req->vip_child_morroco_buying,
                    'vip_morroco_selling_one'=>$req->vip_child_morroco_selling,
                    'vip_morroco_buying_round'=>$req->vip_child_morroco_buying_round,
                    'vip_morroco_selling_round'=>$req->vip_child_morroco_selling_round,
                    'vip_ksa_buying_one'=>$req->vip_child_ksa_buying,
                    'vip_ksa_selling_one'=>$req->vip_child_ksa_selling,
                    'vip_ksa_buying_round'=>$req->vip_child_ksa_buying_round,
                    'vip_ksa_selling_round'=>$req->vip_child_ksa_selling_round,
                    'normal_morroco_buying_one'=>$req->normal_child_morroco_buying,
                    'normal_morroco_selling_one'=>$req->normal_child_morroco_selling,
                    'normal_morroco_buying_round'=>$req->normal_child_morroco_buying_round,
                    'normal_morroco_selling_round'=>$req->normal_child_morroco_selling_round,
                    'normal_ksa_buying_one'=>$req->normal_child_ksa_buying,
                    'normal_ksa_selling_one'=>$req->normal_child_ksa_selling,
                    'normal_ksa_buying_round'=>$req->normal_child_ksa_buying_round,
                    'normal_ksa_selling_round'=>$req->normal_child_ksa_selling_round
                ]);
                
                $transport_service_price_for_infant=transport_service_price_for_infant::create([
                    'transport_service_id'=>$req->transport_id,
                    'vip_morroco_buying_one'=>$req->vip_infant_morroco_buying,
                    'vip_morroco_selling_one'=>$req->vip_infant_morroco_selling,
                    'vip_morroco_buying_round'=>$req->vip_infant_morroco_buying_round,
                    'vip_morroco_selling_round'=>$req->vip_infant_morroco_selling_round,
                    'vip_ksa_buying_one'=>$req->vip_infant_ksa_buying,
                    'vip_ksa_selling_one'=>$req->vip_infant_ksa_selling,
                    'vip_ksa_buying_round'=>$req->vip_infant_ksa_buying_round,
                    'vip_ksa_selling_round'=>$req->vip_infant_ksa_selling_round,
                    'normal_morroco_buying_one'=>$req->normal_infant_morroco_buying,
                    'normal_morroco_selling_one'=>$req->normal_infant_morroco_selling,
                    'normal_morroco_buying_round'=>$req->normal_infant_morroco_buying_round,
                    'normal_morroco_selling_round'=>$req->normal_infant_morroco_selling_round,
                    'normal_ksa_buying_one'=>$req->normal_infant_ksa_buying,
                    'normal_ksa_selling_one'=>$req->normal_infant_ksa_selling,
                    'normal_ksa_buying_round'=>$req->normal_infant_ksa_buying_round,
                    'normal_ksa_selling_round'=>$req->normal_infant_ksa_selling_round
                ]);

                if($transport_service_price_for_adult && $transport_service_price_for_child && $transport_service_price_for_infant){

                    return redirect()->back()->with('success_msg', 'Transport Updated Successfully....');
                }else{
                    return redirect()->back()->with('success_msg', 'Transport Updated Successfully But unable to add price....');
                }

            }else{
                return redirect()->back()->with('error_msg', 'Unable To update Transport...');
            }
        }
    }
    public function delete_transport_services($id)
    {   
        try{
            $transport=transport_service::where('id',$id)->delete();
            if($transport){
                return redirect()->back()->with('success_msg', 'transport Deleted Successfully....');
            }else{
                return redirect()->back()->with('error_msg', 'Unable To delete transport...');
            }
        }catch(\Exception){
            return redirect()->back()->with('error_msg', ' This transport is Linked With something else');
        }
    }
    public function extra_services()
    {
        return view('admin.extra_services');
    }
    public function submit_add_extra_services(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'service_name'=>'required',
        ]);
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            $extra_service=extra_service::create([
                'name'=>$req->service_name,
            ]);
            if($extra_service){

                $extra_service_price=extra_service_price::create([
                  
                    'extra_service_id'=>$extra_service->id,
                    'adult_buying_one'=>$req->adult_buying,
                    'adult_selling_one'=>$req->adult_selling,
                    'adult_buying_round'=>$req->adult_buying_round,
                    'adult_selling_round'=>$req->adult_selling_round,
                    'child_buying_one'=>$req->child_buying,
                    'child_selling_one'=>$req->child_selling,
                    'child_buying_round'=>$req->child_buying_round,
                    'child_selling_round'=>$req->child_selling_round,
                    'infant_buying_one'=>$req->infant_buying,
                    'infant_selling_one'=>$req->infant_selling,
                    'infant_buying_round'=>$req->infant_buying_round,
                    'infant_selling_round'=>$req->infant_selling_round

                ]);

                if($extra_service_price){

                    return redirect()->back()->with('success_msg', 'Extra Service Added Successfully....');
                }else{
                    return redirect()->back()->with('success_msg', 'Extra Service  Added Successfully But unable to add price....');
                }

            }else{
                return redirect()->back()->with('error_msg', 'Unable To add TExtra Service ...');
            }
        }
    }
    public function edit_extra_services($id)
    {
        $extra_service=extra_service::with('service_price')->where('id',$id)->first();
        return view('admin.edit_extra_services',compact('extra_service'));
    }
    public function submit_edit_extra_services(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'service_id'=>'required',
            'service_name'=>'required',
        ]);
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }else{
            $extra_service=extra_service::where('id',$req->service_id)->update([
                'name'=>$req->service_name,
            ]);
            if($extra_service){

                $delete_extra_service_price=extra_service_price::where('extra_service_id',$req->service_id)->delete();
                $extra_service_price=extra_service_price::create([
                    'extra_service_id'=>$req->service_id,
                    'adult_buying_one'=>$req->adult_buying,
                    'adult_selling_one'=>$req->adult_selling,
                    'adult_buying_round'=>$req->adult_buying_round,
                    'adult_selling_round'=>$req->adult_selling_round,
                    'child_buying_one'=>$req->child_buying,
                    'child_selling_one'=>$req->child_selling,
                    'child_buying_round'=>$req->child_buying_round,
                    'child_selling_round'=>$req->child_selling_round,
                    'infant_buying_one'=>$req->infant_buying,
                    'infant_selling_one'=>$req->infant_selling,
                    'infant_buying_round'=>$req->infant_buying_round,
                    'infant_selling_round'=>$req->infant_selling_round

                ]);

                if($extra_service_price){
                    return redirect()->back()->with('success_msg', 'Extra Service Updated Successfully....');
                }else{
                    return redirect()->back()->with('success_msg', 'Extra Service  Updated Successfully But unable to add price....');
                }
            }else{
                return redirect()->back()->with('error_msg', 'Unable To update Extra Service ...');
            }
        }
    }
    public function delete_extra_services($id)
    {   
        try{
            $extra=extra_service::where('id',$id)->delete();
            if($extra){
                return redirect()->back()->with('success_msg', 'extra service Deleted Successfully....');
            }else{
                return redirect()->back()->with('error_msg', 'Unable To delete extra service...');
            }
        }catch(\Exception){
            return redirect()->back()->with('error_msg', ' This extra service is Linked With something else');
        }
    }
    public function add_ticket()
    {
        return view('admin.add_ticket');
    }
    public function view_visa()
    {
        $visas=visa_service::orderBy('id', 'DESC')->get();
        return view('admin.view_visa',compact('visas'));
    }
    public function view_transport()
    {
        $transports=transport_service::orderBy('id', 'DESC')->get();
        return view('admin.view_transport',compact('transports'));
    }
    public function view_extra_services()
    {
        $extra_services=extra_service::orderBy('id', 'DESC')->get();
        return view('admin.view_extra_services',compact('extra_services'));
    }
    public function view_tickets()
    {
        $tickets=ticket_service::with('airline')->orderBy('id', 'DESC')->get();
        // dd($tickets);
        return view('admin.view_tickets',compact('tickets'));
    }
    public function view_lodging()
    {
        $lodgings=lodging_service::orderBy('id', 'DESC')->get();
        return view('admin.view_lodging',compact('lodgings'));
    }
    public function partners()
    {
        return view('admin.partners');
    }
    public function invoice()
    {
        return view('admin.invoice_template');
    }


    public function delete_service_reservation($id){
        $delete_package=package_reservation::where('reservation_id',$id)->delete();
        $visa_reservation=visa_reservation::where('reservation_id',$id)->delete();
        $flight_reservation=flight_reservation::where('reservation_id',$id)->delete();
        $lodging_reservation=lodging_reservation::where('reservation_id',$id)->delete();
        $transport_reservation=transport_reservation::where('reservation_id',$id)->delete();
    }
}

