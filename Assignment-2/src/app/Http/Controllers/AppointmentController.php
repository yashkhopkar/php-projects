<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentMail;

class AppointmentController extends Controller
{
    public function index()
    {
        // Get all the appointments
        $appointments = Appointment::all();

        // Render the appointments view with the appointments
        return view('appointments-view', ['appointments' => $appointments]);
    }

    public function create()
    {
        // Render the appointment form view
        return view('appointments-create');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:20',
            'date_time' => 'required|date_format:Y-m-d\TH:i',
        ]);

        // Create a new appointment record in the database
        $appointment = new Appointment;
        $appointment->name = $validatedData['name'];
        $appointment->email = $validatedData['email'];
        $appointment->phone = $validatedData['phone'];
        $appointment->date_time = $validatedData['date_time'];
        //$appointment->user_id = Auth::id();
        $appointment->save();

        // Send an email to confirm the appointment
        // Mail::send('emails.appointment_confirmation', ['appointment' => $appointment], function($message) use ($appointment) {
        //     $message->to($appointment->email)->subject('Appointment Confirmation');
        // });

        Mail::to('khopkar.y@northeastern.edu')->send(new AppointmentMail());

        // Redirect back to the appointment form with a success message
        return redirect()->back()->with('success', 'Appointment created successfully!');
    }

    public function edit($id)
    {
        // Find the appointment by ID
        $appointment = Appointment::findOrFail($id);

        // Render the appointment edit view with the appointment data
        return view('appointments-edit', ['appointment' => $appointment]);
    }

    public function update(Request $request, $id)
{
    // Validate the form data
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|max:20',
        'date_time' => 'required|date_format:Y-m-d\TH:i',
    ]);

    // Update the appointment record in the database
    $appointment = Appointment::findOrFail($id);
    $appointment->name = $validatedData['name'];
    $appointment->email = $validatedData['email'];
    $appointment->phone = $validatedData['phone'];
    $appointment->date_time = $validatedData['date_time'];
    $appointment->save();

    // Redirect back to the appointment edit view with a success message
    return redirect()->route('appointments.edit', $appointment)->with('success', 'Appointment updated successfully!');
}

public function destroy($id)
{
    // Find the appointment by ID and delete it
    $appointment = Appointment::findOrFail($id);
    $appointment->delete();

    // Redirect back to the appointments view with a success message
    return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully!');
}
}
