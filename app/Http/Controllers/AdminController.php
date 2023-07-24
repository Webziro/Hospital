<?php

namespace App\Http\Controllers;

use App\Models\Doctor;

use App\Models\Appiontment;

use Illuminate\Http\Request;

use Notification;

use App\Notifications\MyFirstNotification;


// use Illuminate\Notifications\Notification;

class AdminController extends Controller
{
    public function addview(){
        {
            return view('admin.add_doctor');
        }
    }

    public function upload(Request $request){
        $doctor = new Doctor;
        $image = $request->file;
        $imagename = time(). '.' .$image->getClientoriginalExtension();
        $request->file->move('doctorimage', $imagename);
        $doctor->image = $imagename;

        $doctor->name = $request->name;

        $doctor->phone = $request->phone;

        $doctor->speciality = $request->speciality; 

        $doctor->room = $request->room;

        $doctor->message = $request->message;

        $doctor->save();
        return redirect()->back()->with('message', 'Doctor Added Successfully');
    }

    //Admin Show Appointments
    public function admin_view_appointment(){
        $data = appiontment::all();
        return view('admin.admin_view_appointment', compact('data'));
    }

    //Admin Approve Appointments
    public function approved($id){
        $data = appiontment::find($id);
        $data->status = 'approved';
        $data->save();
        return redirect()->back();
    }

    //Admin canceled Appointments
    public function canceled($id){
        $data = appiontment::find($id);
        $data->status = 'canceled';
        $data->save();
        return redirect()->back();
    }

    //Show Doctor
    public function showdoctor(){
        $data = doctor::all();
        return view('admin.showdoctor', compact('data'));
    }

    //Delete Doctor
    public function deletedoctor($id){
        $data = doctor::find($id);
        $data->delete();
        return redirect()->back();
    }

    //Update
    public function updatedoctor($id){
        $data = doctor::find($id);
        return view('admin.updatedoctor', compact('data'));
    }

    //Edit

    public function editdoctor(Request $request, $id)
{
    // Find the doctor by ID
    $doctor = Doctor::find($id);
    
    if (!$doctor) {
        return redirect()->back()->with('error', 'Doctor not found');
    }
    
    // Update the doctor's information
    $doctor->name = $request->name;
    $doctor->phone = $request->phone;
    $doctor->speciality = $request->speciality;
    $doctor->room = $request->room;
    
    // Handle image upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagename = time(). '.'.$image->getClientOriginalExtension();
        $image->move('doctorimage', $imagename);
        $doctor->image = $imagename;
    }
    
    $doctor->save();

    $doctor->message = $request->message;

    return redirect()->back()->with('message', 'Doctor updated successfully');
}

//Send Mail
    public function emailview($id){
        $data = appiontment::find($id);
        return view('admin.emailview', compact('data'));
    }

    //Retrive Mail
    public function sendmail(Request $request, $id){
        $data = appiontment::find($id);
        $details = [
            'greeting' => $request->greeting,
            'body' => $request->body,
            'actiontext' => $request->actiontext,
            'actionurl' => $request->actionurl,
            'endpart' => $request->endpart
        ];

        Notification::send($data, new MyFirstNotification ($details));

        return redirect()->back()->with('message', 'Message Sent Successfully!!');
    }

    
}