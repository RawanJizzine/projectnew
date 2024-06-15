<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\FeaturesData;
use App\Models\AppointmentTime;
use App\Models\Feature;
use App\Models\FilePatient;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentsController extends Controller
{
    public function indexFront()
    {
       
      

        return view('content.dashboard.appointments.appointmentSection');
    }
    public function indexAppointments($id)
    { 
        
        $feature = FeaturesData::findOrFail($id);
        $data['officialHolidays'] = [
            '2024-01-01' => "New Year's Day",
            '2024-01-06' => "Armenian Christmas",
            '2024-01-19' => "Orthodox Armenian Christmas",
            '2024-02-09' => "St. Maroun's Day",
            '2024-02-14' => "Rafik Hariri Memorial Day",
            '2024-03-25' => "Annunciation",
            '2024-12-25' => "Christmas Day",
            '2024-12-26' => "Boxing Day",
        ];

        $data['appointments'] =$feature ;
       
      

        return view('content.front-page.appointment',$data);
    }
    public function index()
    {
        $userId = Auth::id();
        $data['appointments'] = Appointment::where('user_id', $userId)->get();
        return view('content.dashboard.appointments.appointmentsClients',$data);
    }
    public function store(Request $request)
    {
 
        $request->validate([
            'selectedDate' => 'required|date',
            'time' => 'required',
            'client_name' => 'required|string',
            'client_phone' => 'required|string',
            'name_session' => 'required|string',
        ]);

        Appointment::create([
            'date' => $request->input('selectedDate'),
            'time' => $request->input('time'),
            'name' => $request->input('client_name'),
            'phone' => $request->input('client_phone'),
            'session_name' => $request->input('name_session'),
            'user_id' => '1',
        ]);
        AppointmentTime::where('date', $request->input('selectedDate'))
        ->whereIn('time', (array) $request->input('time'))
        ->delete();

        return redirect()->back()->with('success', 'Appointment booked successfully!');
    }
    public function destroy($id)
{
    // Find the appointment by its ID
    $appointment = Appointment::findOrFail($id);

    // Get the date and time of the appointment to be deleted
    $date = $appointment->date;
    $time = $appointment->time;

    // Delete the appointment
    $appointment->delete();

    // Save the appointment time and date in the AppointmentTime table
    AppointmentTime::create([
        'date' => $date,
        'time' => $time,
        'user_id' => auth()->id(), // Assuming you have authentication and a user ID
    ]);

    // Return a response indicating success
    return response()->json(['message' => 'Appointment deleted successfully']);
}
public function showAppointmentsCalanderPage($id)
    {
        $appointments=FeaturesData::where('id',$id)->first();
        $data['appointments'] = $appointments;
      
        $data['officialHolidays'] = [
            '2024-01-01' => "New Year's Day",
            '2024-01-06' => "Armenian Christmas",
            '2024-01-19' => "Orthodox Armenian Christmas",
            '2024-02-09' => "St. Maroun's Day",
            '2024-02-14' => "Rafik Hariri Memorial Day",
            '2024-03-25' => "Annunciation",
            '2024-12-25' => "Christmas Day",
            '2024-12-26' => "Boxing Day",
        ];
      

        return view('content.front-page.appointmentCalander',$data);
    }
    public function showAppointmentsCalanderDashboard()
    {
        $userId = Auth::id();
       $features=Feature::where('user_id',$userId)->first();
       $feature_data=FeaturesData::where('features_id',$features->id )->get();
       $data['appointment']=$feature_data;
    
        $data['officialHolidays'] = [
            '2024-01-01' => "New Year's Day",
            '2024-01-06' => "Armenian Christmas",
            '2024-01-19' => "Orthodox Armenian Christmas",
            '2024-02-09' => "St. Maroun's Day",
            '2024-02-14' => "Rafik Hariri Memorial Day",
            '2024-03-25' => "Annunciation",
            '2024-12-25' => "Christmas Day",
            '2024-12-26' => "Boxing Day",
        ];
      

        return view('content.dashboard.appointments.appointmentCalanderDashboard',$data);
    }

    public function showpatientData()
    {
        $userId = Auth::id();
        $patients = Patient::with('filesPatientInfo')->where('user_id', $userId)->first();
      $data['patient']=$patients;
        return view('content.dashboard.patientData.patientData',$data);
    }
    public function storePatientData(Request $request)
    {
        $request->validate([
            'patientfullname' => 'required|string|max:255',
            'phonenumber' => 'required|numeric',
            'age' => 'required|numeric',
            'dateofbirth' => 'required|date',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'file.*.title' => 'required|string|max:255',
            'file.*.file' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:4000'
        ]);
    
        if ($request->id) {
            // Update existing patient record
            $patient = Patient::find($request->id);
            if ($patient) {
                $patient->update([
                    'fullname' => $request->patientfullname,
                    'phonenumber' => $request->phonenumber,
                    'age' => $request->age,
                    'dateofbirth' => $request->dateofbirth,
                    'width' => $request->width,
                    'height' => $request->height,
                    'user_id' => Auth::id(),
                ]);
    
              
    
                // Process files for update
                foreach ($request->file as $file) {
                    if (isset($file['id'])) {
                        // Update existing file record
                        $existingFile = FilePatient::find($file['id']);
                        if ($existingFile) {
                            // Delete the old file if a new one is uploaded
                            $filePath = public_path('files/' . $existingFile->path);
                            if (file_exists($filePath)) {
                                unlink($filePath);
                            }
                            $path = time() . '.' . $file['file']->extension();
                            $file['file']->move(public_path('files'), $path);
                            
                            $existingFile->update([
                                'title' => $file['title'],
                                'path' => $path,
                            ]);
                        }
                    } else {
                        // Create new file record
                        $path = time() . '.' . $file['file']->extension();
                        $file['file']->move(public_path('files'), $path);
    
                        FilePatient::create([
                            'patient_id' => $patient->id,
                            'title' => $file['title'],
                            'path' => $path,
                        ]);
                    }
                }
            }
        } else {
            // Create new patient record
            $patient = Patient::create([
                'fullname' => $request->patientfullname,
                'phonenumber' => $request->phonenumber,
                'age' => $request->age,
                'dateofbirth' => $request->dateofbirth,
                'width' => $request->width,
                'height' => $request->height,
                'user_id' => Auth::id(),
            ]);
    
            foreach ($request->file as $file) {
                $path = time() . '.' . $file['file']->extension();
                $file['file']->move(public_path('files'), $path);
    
                FilePatient::create([
                    'patient_id' => $patient->id,
                    'title' => $file['title'],
                    'path' => $path,
                ]);
            }
        }
    
        return response()->json(['success' => true, 'message' => 'Patient information saved successfully!']);
    }
    

}
