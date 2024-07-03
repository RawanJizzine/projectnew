<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactData;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HomeData;
use App\Models\FeaturesData;
use App\Models\ReviewsData;
use App\Models\LogoData;
use App\Models\TeamData;
use App\Models\Plan;
use App\Models\PlanData;
use App\Models\FunFact;
use App\Models\Faq;
use App\Models\FaqModel;
use App\Models\Feature;
use App\Models\SubscriptionPlan;
use App\Models\TeamModel;
use App\Models\PlanList;
use App\Models\Reviews;
use App\Models\LetterEmail;
use App\Models\DiscussionMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Mail;
use App\Mail\YourMailClass;
use App\Mail\YourMailContact;
use App\Models\Appointment;
use App\Models\AppointmentTime;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{

    public function index()
    {
        $userId = Auth::id();
       
        $data['home'] = HomeData::first();
        $data['feature'] = Feature::first();
        $data['feature_data'] = FeaturesData::where('features_id', $data['feature']->id)->get();
        $data['reviews'] = Review::first();
        $data['review_data'] = ReviewsData::where('reviews_id', $data['reviews']->id)->get();
        $data['logosdata'] = LogoData::where('user_id', 1)->get();
        $data['team'] = TeamModel::first();
        $data['team_data'] = TeamData::where('team_id', $data['team']->id)->get();
        $data['fun_data'] = FunFact::where('user_id', 1)->get();
        $data['faqs'] = Faq::first();
        $data['faq'] = FaqModel::where('faq_id', $data['faqs']->id)->get();
        $data['value'] = ContactData::first();
        $data['plan'] = Plan::first();
        $data['plan_pricing_data'] = PlanData::where('plan_id', $data['plan']->id ?? '')->with('planLists')->get();
        $data['subscription'] = SubscriptionPlan::where('user_id', $userId ?? "")->first();
        $data['reload']='false';
       

    $user = User::find(1);
    
        $categories = $user->categories;
      
        return view('content.front-page.front', $data, ['categoryy' => $categories]);
    

        
        
    }
   

    public function adminDashboard()
    {
       
        $user_id = Auth::id();
        $ordersQuery = Order::where('status', 'pending');
        $ordersQuery->whereDate('created_at', Carbon::today());
        $orders = $ordersQuery->get();
        $totalAmount = $orders->sum('total_price');
        $data['totalorderprice'] = $totalAmount;
        $today = Carbon::today();
        $todayEarnings = OrderItem::selectRaw('SUM(products.initial_price * order_items.quantity) as total_initial_price')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->whereDate('order_items.created_at', $today)
            ->first();
        $data['earnings'] = $todayEarnings;
        $orderscompleted = Order::where('user_id', $user_id)
            ->where('status', 'completed')->whereDate('created_at', Carbon::today());
        $completed = $orderscompleted->count();
        $data['orderscompleted'] = $completed;


        $result = Order::select('user_id', DB::raw('COUNT(*) as completed_orders'), DB::raw('COUNT(DISTINCT customphoneNumber) as unique_phones'))
            ->where('status', 'pending')
            ->where('user_id', $user_id)
            ->whereDate('created_at', $today)
            ->groupBy('user_id')
            ->first();

        $customertoday = $result->unique_phones ?? "0";
        $data['customer'] = $customertoday ?? "0";

        $queryproduct = DB::table('products')->where('user_id', $user_id);


        $countproduct = $queryproduct->count();
        $data['countproduct'] = $countproduct;



        $queryappointments = DB::table('appointments')->where('user_id', $user_id)->where('status', 'pending');
        $queryappointments->whereDate('created_at', '=', now()->toDateString());
        $countapp = $queryappointments->count();
        $data['countapp'] = $countapp;

        $sum = DB::table('appointments')
            ->where('appointments.user_id', $user_id)
            ->whereDate('appointments.created_at', '=', now()->toDateString())
            ->join('features_data', function ($join) use ($user_id) {
                $join->on('appointments.session_name', '=', 'features_data.title')
                    ->where('features_data.user_id', '=', $user_id);
            })
            ->sum('features_data.price');
        $data['amountapp'] = $sum;









        /////////////////////////////


        // Retrieve the appointment for the given user_id and today's date


        // Retrieve the appointment for the given user_id, today's date, and status completed
        $appointmenttable = Appointment::where('user_id', $user_id)
            ->whereDate('date', $today)
            ->where('status', 'completed')->get();
        $data['appointmenttable'] = $appointmenttable;
        //order table 
        $orderstable = Order::where('user_id', $user_id)
            ->whereDate('created_at', $today)
            ->where('status', 'pending')
            ->get();

        if ($orders->isNotEmpty()) {
            $data['orderstable'] = $orderstable;
        } else {
            $data['orderstable'] = null;
        }


        return view('content.dashboard.ecommerce.index', $data);
       
    }



    public function sendMessageContact(Request $request)
    {
        $email = $request->email;
        $full_name = $request->full_name;
        $message = $request->message;
        $emailTo = '';
        if (auth()->check()) {

            if (auth()->user()->role == 'user') {
                $userId = auth()->user()->id;
                $contact = ContactData::where('user_id', $userId)->first();
                $emailTo = $contact->email;
                Mail::to($emailTo)->send(new YourMailContact($full_name, $email, $request->message, $emailTo));
            } else {

                $contact = ContactData::where('user_id', 1)->first();
                $emailTo = $contact->email;
                Mail::to($emailTo)->send(new YourMailContact($full_name, $email, $request->message, $emailTo));
            }
        } else {

            $contact = ContactData::first();
            $emailTo = $contact->email;
            Mail::to($emailTo)->send(new YourMailContact($full_name, $email, $request->message, $emailTo));
        }
        return redirect()->back()->with('success', 'Message Sebd successfully!');
    }



    public function saveEmailLetter(Request $request)
    {
        if (auth()->check()) {

            if (auth()->user()->role == 'user') {
                $userId = auth()->user()->id;
            } else {

                $userId = 1;
            }
        } else {

            $userId = 1;
        }


        LetterEmail::create([
            'user_id' => $userId,
            'email' => $request->footer_email,
        ]);

        return redirect()->back()->with('success', 'Email saved successfully!');
    }



    public function messages()
    { 
        $officialHolidays = [
            '2024-01-01' => "New Year's Day",
            '2024-01-06' => "Armenian Christmas",
            '2024-01-19' => "Orthodox Armenian Christmas",
            '2024-02-09' => "St. Maroun's Day",
            '2024-02-14' => "Rafik Hariri Memorial Day",
            '2024-03-25' => "Annunciation",
            '2024-12-25' => "Christmas Day",
            '2024-12-26' => "Boxing Day",
        ];


        return view('content.dashboard.message.message',compact('officialHolidays'));
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getAvailableLocation(Request $request)
    {
        $userId = Auth::id();
        $date = $request->input('date');
        $appointmentsplace = AppointmentTime::where('user_id', $userId)
        ->whereDate('date', $date)
        
        ->distinct('place')
        ->get(['place']);
     
        return response()->json(['locations' => $appointmentsplace]);
    } 
     
    public function getTimes(Request $request)
    {
        
        $location = $request->input('location');
        $selectedDate = $request->input('date');
       
        $times = AppointmentTime::where('place', $location)
                               ->whereDate('date', $selectedDate)->get();
                             
        return response()->json(['times' => $times]);
    }
    

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function sendEmail(Request $request)
    {
        $userId = Auth::id();
        $recipients = LetterEmail::where('user_id', $userId)->pluck('email')->toArray();
        Mail::to($recipients)->send(new YourMailClass($request->message, $recipients));

        return redirect()->back()->with('success', 'Emails sent successfully!');
    }






    public function showPaymentPage()
    {
        $planSelect = session('plan_id');
        dd($planSelect);
        $plan = Plan::first();
        $planData = PlanData::where('plan_id', $plan->id ?? '')->with('planLists')->get();
        if ($planSelect == 'plan 1') {
            $data['plan_select'] = $planSelect;
            $data['plan_pricing_data'] = $planData[0];

            return view('content.front-page.PaymentPage', $data);
        } elseif ($planSelect == 'plan 2') {
            $data['plan_select'] = $planSelect;
            $data['plan_pricing_data'] = $planData[1];
            return view('content.front-page.PaymentPage', $data);
        } elseif ($planSelect == 'plan 3') {
            $data['plan_select'] = $planSelect;
            $data['plan_pricing_data'] = $planData[2];
            return view('content.front-page.PaymentPage', $data);
        } else {
            $data['plan_pricing_data'] = null;
        }
    }
    public function processSubscription(Request $request)
    {


        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
            'country' => 'required',
            'zip' => 'required|numeric',


        ]);

        $userId = Auth::id();

        SubscriptionPlan::create([
            'user_id' => $userId,
            'email' => $data['email'],
            'password' => $data['password'],
            'country' => $data['country'],
            'zip' => $data['zip'],
            'monthly_payment' => $request->monthly_payment,
            'total_payment' => $request->total_payment,
            'status' => 'active',
            'plan_name' => $request->input('plan_name'),

        ]);


        return response()->json(['message' => ' data save successfully']);
    }
}
