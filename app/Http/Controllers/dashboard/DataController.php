<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscribers;

class DataController extends Controller
{
    public function users()
    {

        $data['subscribers']  = Subscribers::all();

        return view('content.dashboard.data-user.userData', $data);
    }
    public function create(Request $request)
    {

        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);

        $subscriber =  Subscribers::updateOrCreate(

            [
                'email' => $validatedData['email'],
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'phone' => $validatedData['phone'],
            ]
        );

        return response()->json(['message' => 'User save successfully', 'subscriber' => $subscriber]);
    }

    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);

        $subscriber = Subscribers::find($id);

        if (!$subscriber) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $subscriber->update([
            'email' => $validatedData['email'],
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'phone' => $validatedData['phone'],
        ]);

        return response()->json(['message' => 'User updated successfully', 'subscriber' => $subscriber]);
    }


    public function destroy($id)
    {

        $subscriber = Subscribers::find($id);

        if (!$subscriber) {
            return response()->json(['error' => 'Subscriber not found'], 404);
        }

        $subscriber->delete();

        return response()->json(['message' => 'Subscriber deleted successfully']);
    }



}
