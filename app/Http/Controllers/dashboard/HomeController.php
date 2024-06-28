<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\HomeData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
class HomeController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $data['home'] = HomeData::where('user_id', $user_id ?? '')->first();
        return view('content.dashboard.homeData.homeDataPage', $data);
    }
    public function createHomeData(Request $request)
    {
   
        $user_id = Auth::id();

        if ($request->id) {
            $data = $request->validate([
                'title' => 'required|string',
                'main_description' => 'required|string',
                'second_description' => 'required|string',
                'button_text' => 'required|string',

            ]);
            $home =  HomeData::find($request->id);
            if (isset($request->image_link_dashboard)) {
                $imageName = time() . '.' . $request->image_link_dashboard->extension();
                $request->image_link_dashboard->move(public_path('homeFile'), $imageName);
              
                $home->update([
                    'image_link_dashboard' => $imageName,
                ]);
            }
            if (isset($request->image_link_element)) {
                $pathelement = time() . '.' . $request->image_link_element->extension();
                $request->image_link_element->move(public_path('homeFile'), $pathelement);
               
                $home->update([
                    'image_link_element' =>  $pathelement,
                ]);
            }
            $home->update([

                'main_description' => $data['main_description'],
                'title' => $data['title'],
                'secondary_description' => $data['second_description'],
                'button_text' => $data['button_text'],
            ]);
        } else {
          
            $data = $request->validate([
                'title' => 'required|string',
                'main_description' => 'required|string',
                'second_description' => 'required|string',
                'button_text' => 'required|string',
                'image_link_dashboard' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'image_link_element' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
           
            $pathimage = Str::random(10) . '.' . $request->image_link_dashboard->extension();
            $request->image_link_dashboard->move(public_path('homeFile'), $pathimage);
           
            $pathelement = Str::random(10) . '.' . $request->image_link_element->extension();
            $request->image_link_element->move(public_path('homeFile'), $pathelement);
            HomeData::create([
                'user_id' => $user_id,
                'main_description' => $data['main_description'],
                'title' => $data['title'],
                'secondary_description' => $data['second_description'],
                'button_text' => $data['button_text'],
                'image_link_dashboard' => $pathimage,
                'image_link_element' =>  $pathelement,
            ]);
        }
        return response()->json(['message' => 'Home data save successfully']);
    }
}
