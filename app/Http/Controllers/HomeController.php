<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\user;
use App\models\Doctor;
use App\models\Appiontment;

class HomeController extends Controller
{
    public function redirect(){
        if(Auth::id()){
            if(Auth::user()->usertype=='0'){
                $doctor = doctor::all();
                return view('user.home', compact('doctor'));
            }else{
                return view('admin.home');
            }
        }else{
            return redirect()->back();
        }
    }


    public function index(){
        if(Auth::id())
        {
            return redirect('home');
        }
        else
        $doctor = doctor::all();
        return view('user.home', compact('doctor'));
    }

    // Book appointment with a doctor
    public function appointment(Request $request){

        //Validation
        

        $data = new appiontment();
        
        $data->name = $request->name;

        $data->email = $request->email;

        $data->phone = $request->phone;

        $data->doctor = $request->doctor;

        $data->date =$request->date;

        $data->message = $request->message;

        $data->status = 'In Progress';

        if(Auth::id()){
            $data->user_id = Auth::user()->id;
        }
        $data->save();

        return redirect()->back()->with('message', 'Appointment booked sucessfully');
    }

    //My appointments
    public function myappointment(){
        if(Auth::id()){

            $userid = Auth::user()->id;
 
            $appoint = appiontment ::where('user_id', $userid)->get();
            
            return view('user.myappointment', compact('appoint'));  

        }else{
            return redirect()->back();
        }
    }


    //Delete Appointments
    public function deleteappoint($id){
        $data = appiontment::find($id);
        $data->delete();
        return redirect()->back();
    }

}