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
use Illuminate\Support\Carbon;
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
            'location' => 'required|string',
            'client_phone' => 'required|string',
            'name_session' => 'required|string',
        ]);
        $userId = Auth::id();
        Appointment::create([
            'date' => $request->input('selectedDate'),
            'time' => $request->input('time'),
            'name' => $request->input('client_name'),
            'phone' => $request->input('client_phone'),
            'session_name' => $request->input('name_session'),
            'location'=>$request->input('location'),
            'user_id' => $userId,
            'status'=>'pending',
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
    $place=$appointment->location;
    // Delete the appointment
    $appointment->delete();

    // Save the appointment time and date in the AppointmentTime table
    AppointmentTime::create([
        'place'=>$place,
        'date' => $date,
        'time' => $time,
        'user_id' => auth()->id(), // Assuming you have authentication and a user ID
    ]);

    // Return a response indicating success
    return response()->json(['message' => 'Appointment deleted successfully']);
}
public function showAppointmentsCalanderPage($id)
    {
        $userId = Auth::id();
        $appointments=FeaturesData::where('id',$id)->first();
        $data['appointments'] = $appointments;
        $today = Carbon::today();
        $appointmentsplace = AppointmentTime::where('user_id', $userId)
        ->whereDate('date', $today)
        
        ->distinct('place')
        ->get(['place']);
       
        $data['appointmentsplace']=$appointmentsplace;
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
       $today = Carbon::today();
       $appointmentsplace = AppointmentTime::where('user_id', $userId)
       ->whereDate('date', $today)
       
       ->distinct('place')
       ->get(['place']);
      
       $data['appointmentsplace']=$appointmentsplace;
       /////////get time in the  date 
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
    public function showAllPatientData()
    {
        $userId = Auth::id();
        $patients = Patient::with('filesPatientInfo')->where('user_id', $userId)->get();
      $data['patients']=$patients;
        return view('content.dashboard.patientData.allpatientData',$data);
    }

    public function showpatientData(Request $request)
    {
        $userId = Auth::id();
        $patientId =  $request->query('patientId');
     
        $patients = Patient::with('filesPatientInfo')->where('id', $patientId)->where('user_id', $userId)->first();
      $data['patient']=$patients;
     
        return view('content.dashboard.patientData.patientData',$data);
    }
    public function showcreatepatientData(Request $request)
    {
        
     
        return view('content.dashboard.patientData.createpatientData',);
    }
    public function storePatientData(Request $request)
    {
        
       
       
        if ($request->id) {
            $request->validate([
                'patientfullname' => 'required|string|max:255',
                'phonenumber' => 'required|numeric',
                'sex' => 'required|string|max:255',
                'dateofbirth' => 'required|date',
                'width' => 'required|numeric',
                'height' => 'required|numeric',
                'file.*.title' => 'required|string|max:255',
                
            ]);
            $patient = Patient::find($request->id);
            if ($patient) {
                
                $patient->update([
                    'fullname' => $request->patientfullname,
                    'phonenumber' => $request->phonenumber,
                    'sex' => $request->sex,
                    'dateofbirth' => $request->dateofbirth,
                    'width' => $request->width,
                    'height' => $request->height,
                    'user_id' => Auth::id(),
                ]);
    
                
    
              
                foreach ($request->file as $file) {
                    if (isset($file['id'])) {
                        // Update existing file record
                      
                        $existingFile = FilePatient::find($file['id']);
                       
                        if ($existingFile) {
                          
                            if (isset($file['file'])        ) {
                         
                            $path = time() . '.' . $file['file']->extension();
                            $file['file']->move(public_path('files'), $path);
                           
                            $existingFile->update([
                                'title' => $file['title'],
                                'path' => $path,
                            ]);
                        }else{
                            $existingFile->update([
                                'title' => $file['title'],
                               
                            ]);  
                        }
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
            $request->validate([
                'patientfullname' => 'required|string|max:255',
                'phonenumber' => 'required|numeric',
                'sex' => 'required|string|max:255',
                'dateofbirth' => 'required|date',
                'width' => 'required|numeric',
                'height' => 'required|numeric',
                'file.*.title' => 'required|string|max:255',
                'file.*.file' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:10000'
            ]);
            // Create new patient record
            $patient = Patient::create([
                'fullname' => $request->patientfullname,
                'phonenumber' => $request->phonenumber,
                'sex' => $request->sex,
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

    public function indexAppointmentsAvailability()
    {
        $userId = Auth::id();
        $appointment = AppointmentTime::where('user_id', $userId)->get();
        $data['appointment']=$appointment;
        
        return view('content.dashboard.appointments.appointmentavailability',$data);
    }
    public function saveAppointmentsAvailability(Request $request)
    {
        $request->validate([
            'place' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);
        $userId = Auth::id();
        // Create a new appointment
        $appointment = AppointmentTime::create([
            'place' => $request->input('place'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'user_id'=>$userId,
        ]);

        
        return response()->json(['app' => $appointment], 201);
        
    }
    public function updateAppointmentsAvailability(Request $request, $id )
    {
        $request->validate([
            'place_edit' => 'required|string|max:255',
            'date_edit' => 'required|date',
            'time_edit' => 'required|date_format:H:i',
        ]);

        // Find the appointment by ID and update it
        $appointment = AppointmentTime::findOrFail($id);
        $appointment->update([
            'place' => $request->input('place_edit'),
            'date' => $request->input('date_edit'),
            'time' => $request->input('time_edit'),
        ]);

        // Return a JSON response
        return response()->json(['app' => $appointment], 200);
        
    }
    public function destroyAppointmentsAvailability($id)
    {
        $appointment = AppointmentTime::findOrFail($id);
        $appointment->delete();

        // Return a JSON response
        return response()->json(['message' => 'Appointment deleted successfully.'], 200);
        
    }
    public function changestatusapp($appId){
        $app = Appointment::findOrFail($appId);
        $app->status = $app->status == 'completed' ? 'pending' : 'completed';
        $app->save();

        return response()->json(['message' => 'Appointment status updated to completed']); 
    }
    

}
