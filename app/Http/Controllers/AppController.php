<?php

namespace App\Http\Controllers;

use App\Models\AppData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $data['data'] = AppData::where('user_id', $user_id)->first();
      
        return view('content.dashboard.appData.appData', $data);
    }
    public function createAppData(Request $request)
    {
    
        $user_id = Auth::id();

        if ($request->id) {
            $data = $request->validate([
                'title' => 'required|string',
               

            ]);
            $data =  AppData::find($request->id);
            if (isset($request->logo)) {
                $path = time() . '.' . $request->logo->extension();
                $request->logo->move(public_path('images'), $path);
              
                $data->update([
                    'image' => $path,
                ]);
            }
         
            $data->update([

              
                'title' => $data['title'],
               
            ]);
        } else {
          
            $data = $request->validate([
                'title' => 'required|string',
                
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                
            ]);
            $pathh = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('images'), $pathh);
            AppData::create([
                'user_id' => $user_id,
                'title' => $data['title'],
                'image' =>  $pathh,
            ]);
        }
        return response()->json(['message' => 'Home data save successfully']);
    }
}
