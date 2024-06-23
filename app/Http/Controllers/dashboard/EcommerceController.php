<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AppointmentTime;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EcommerceController extends Controller
{
    public function index()
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

        $customertoday = $result->unique_phones??"";
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
        $today = Carbon::today()->toDateString();

        // Retrieve the appointment for the given user_id, today's date, and status completed
        $appointmenttable = Appointment::where('user_id', $user_id)
                                  ->whereDate('date', $today)
                                  ->where('status', 'completed')->get();     
       $data['appointmenttable']=$appointmenttable;


        return view('content.dashboard.ecommerce.index', $data);
    }
    public function getOrders(Request $request)
    {
        $timeFrame = $request->input('time_frame');
        $user_id = Auth::id();
        $ordersQuery = Order::where('user_id', $user_id)->where('status', 'pending');


        switch ($timeFrame) {

            case 'today':
                $ordersQuery->whereDate('created_at', Carbon::today());
                break;

            case 'weekly':
                $ordersQuery->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;

            case 'monthly':
                $ordersQuery->whereMonth('created_at', Carbon::now()->month);

                break;

            case 'yearly':
                $ordersQuery->whereYear('created_at', Carbon::now()->year);
                break;

            default:
                return response()->json(['error' => 'Invalid time frame'], 400);
        }

        $orders = $ordersQuery->get();

        $totalOrders = $orders->count();

        $totalAmount = $orders->sum('total_price'); // Assuming 'amount' is the field for order total
        ///////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////
        $ordersQueryearning = OrderItem::selectRaw('SUM(products.initial_price * order_items.quantity) as total_initial_price')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('order_items.user_id', $user_id);


        switch ($timeFrame) {
            case 'today':
                $startDate = Carbon::today();
                $endDate = Carbon::today()->endOfDay();
                $ordersQueryearning->whereDate('order_items.created_at', $startDate);
                break;

            case 'weekly':
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
                $ordersQueryearning->whereBetween('order_items.created_at', [$startDate, $endDate]);
                break;

            case 'monthly':
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                $ordersQueryearning->whereMonth('order_items.created_at', Carbon::now()->month)
                    ->whereYear('order_items.created_at', Carbon::now()->year);
                break;

            case 'yearly':
                $startDate = Carbon::now()->startOfYear();
                $endDate = Carbon::now()->endOfYear();
                $ordersQueryearning->whereYear('order_items.created_at', Carbon::now()->year);
                break;

            default:
                return response()->json(['error' => 'Invalid period specified'], 400);
        }

        $earnings = $ordersQueryearning->first();
        /////////////////////////////////////////////////////////////////////
        $ordersQuerycompleted = Order::where('user_id', $user_id)
            ->where('status', 'pending');

        switch ($timeFrame) {
            case 'today':
                $ordersQuerycompleted->whereDate('created_at', Carbon::today());
                break;

            case 'weekly':
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
                $ordersQuerycompleted->whereBetween('created_at', [$startDate, $endDate]);
                break;

            case 'monthly':
                $ordersQuerycompleted->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
                break;

            case 'yearly':
                $ordersQuerycompleted->whereYear('created_at', Carbon::now()->year);
                break;

            default:
                return response()->json(['error' => 'Invalid time frame'], 400);
        }

        $completedOrderCount = $ordersQuerycompleted->count();




        /////////////////////////////////////////////////////////////////////
        $query = Order::select('user_id', DB::raw('COUNT(*) as completed_orders'), DB::raw('COUNT(DISTINCT customphoneNumber) as unique_phones'))
            ->where('status', 'pending')
            ->where('user_id', $user_id)
            ->groupBy('user_id');

        switch ($timeFrame) {
            case 'today':
                $query->whereDate('created_at', Carbon::today());
                break;

            case 'weekly':
                $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;

            case 'monthly':
                $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
                break;

            case 'yearly':
                $query->whereYear('created_at', Carbon::now()->year);
                break;

            default:
                return response()->json(['error' => 'Invalid time frame'], 400);
        }

        $result = $query->first();

        $customer = $result->unique_phones;



        ////////////////////////////////////////////////////////////////////
        $queryproduct = DB::table('products')->where('user_id', $user_id);


        $countproduct = $queryproduct->count();


        ///////////
        $queryappointments = DB::table('appointments')->where('user_id', $user_id)->where('status', 'pending');

        switch ($timeFrame) {
            case 'today':
                $queryappointments->whereDate('created_at', '=', now()->toDateString());
                break;

            case 'weekly':
                $queryappointments->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;

            case 'monthly':
                $queryappointments->whereMonth('created_at', '=', now()->month)
                    ->whereYear('created_at', '=', now()->year);
                break;

            case 'yearly':
                $queryappointments->whereYear('created_at', '=', now()->year);
                break;

            default:
                return response()->json(['error' => 'Invalid time frame'], 400);
        }

        $countapp = $queryappointments->count();
        //////////////////////////
        $queryamountapp = DB::table('appointments')
            ->where('appointments.user_id', $user_id)
            ->join('features_data', function ($join) use ($user_id) {
                $join->on('appointments.session_name', '=', 'features_data.title')
                    ->where('features_data.user_id', '=', $user_id);
            });

        // Apply date filters based on time frame
        switch ($timeFrame) {
            case 'today':
                $queryamountapp->whereDate('appointments.created_at', '=', now()->toDateString());
                break;

            case 'weekly':
                $queryamountapp->whereBetween('appointments.created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;

            case 'monthly':
                $queryamountapp->whereMonth('appointments.created_at', '=', now()->month)
                    ->whereYear('appointments.created_at', '=', now()->year);
                break;

            case 'yearly':
                $queryamountapp->whereYear('appointments.created_at', '=', now()->year);
                break;

            default:
                return response()->json(['error' => 'Invalid time frame'], 400);
        }

        // Calculate the sum of prices
        $sum = $queryamountapp->sum('features_data.price');





        return response()->json([
            'earnings' => $earnings->total_initial_price,
            'pageview' => '0',
            'completed_order' => $completedOrderCount,
            'total_amount' => $totalAmount,
            'customer' => $customer,
            'productnumber' => $countproduct,
            'totalappointment' => $countapp,
            'amountappointment'=>$sum,
        ]);
    }


    public function getAppointmentsByDate($date)
    {
        $user_id = Auth::id();
        $appointments = Appointment::where('user_id', $user_id)
                                  ->whereDate('date', $date)->where('status', 'completed')->get();
                                  

        
        if ($appointments->isNotEmpty()) {
            return response()->json([
                'success' => true,
                'appointments' => $appointments,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No appointments found for the selected date.',
            ], 404);
        }
    }
   
}
