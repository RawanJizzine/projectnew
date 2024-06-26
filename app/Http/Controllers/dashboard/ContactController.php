<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
class ContactController extends Controller
{
    
    public function index()
    {
        $user_id = Auth::id();
        $data['contact'] = ContactData::where('user_id', $user_id ?? '')->first();
        return view('content.dashboard.contactData.contactDataPage', $data);
    }
    
    public function createContactData(Request $request)
    {

       
        $user_id = Auth::id();

        if ($request->id) {
            $data = $request->validate([
                'title_cta' => 'required|string',
                'description_cta' => 'required|string',
                'text_button_cta' => 'required|string',
                'title_contact' => 'required|string',
                'first_description_contact' => 'required|string',
                'second_description_contact' => 'required|string',
                'tertiary_description_contact' => 'required|string',
                'text_contact' => 'required|string',
                'description_contact' => 'required|string',
                'description_contact_two' => 'required|string',
                'email' => 'required|string',
                'phone' => 'required|string',
                'text_button_contact' => 'required|string',
            ]);
            $contact =  ContactData::find($request->id);
            if (isset($request->image_cta)) {
                
                $pathimage = Str::random(10) . '.' .  $request->image_cta->extension();
                $request->image_cta->move(public_path('contactFile'), $pathimage);
                $contact->update([
                    'image_cta' => $pathimage,
                ]);
            }
            if (isset($request->image_contact)) {
              
                $pathcontact = Str::random(10) . '.' .  $request->image_contact->extension();
                $request->image_contact->move(public_path('contactFile'), $pathcontact);
                $contact->update([
                    'image_contact' =>  $pathcontact,
                ]);
            }
            $contact->update([

                'title_cta' => $data['title_cta'],
                'description_cta' => $data['description_cta'],
                'button_text_cta' => $data['text_button_cta'],
                'title_contact' => $data['title_contact'],
                'first_description_contact' => $data['first_description_contact'],
                'second_description_contact' => $data['second_description_contact'],
                'tertiary_description_contact' => $data['tertiary_description_contact'],
                'text_contact' => $data['text_contact'],
                'description_contact' => $data['description_contact'],
                'description_contact_two' => $data['description_contact_two'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'text_button_contact' => $data['text_button_contact'],
            ]);
        } else {
           
            $data = $request->validate([
                'title_cta' => 'required|string',
                'description_cta' => 'required|string',
                'text_button_cta' => 'required|string',
                'title_contact' => 'required|string',
                'first_description_contact' => 'required|string',
                'second_description_contact' => 'required|string',
                'tertiary_description_contact' => 'required|string',
                'text_contact' => 'required|string',
                'description_contact' => 'required|string',
                'description_contact_two' => 'required|string',
                'email' => 'required|string',
                'phone' => 'required|string',
                'text_button_contact' => 'required|string',
                'image_cta' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'image_contact' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
           
            $pathimage = Str::random(10) . '.' .  $request->image_cta->extension();
            $request->image_cta->move(public_path('contactFile'), $pathimage);
            $pathcontact = Str::random(10) . '.' .  $request->image_contact->extension();
                $request->image_contact->move(public_path('contactFile'), $pathcontact);
            ContactData::create([
                'user_id' => $user_id,
                'title_cta' => $data['title_cta'],
                'description_cta' => $data['description_cta'],
                'button_text_cta' => $data['text_button_cta'],
                'title_contact' => $data['title_contact'],
                'first_description_contact' => $data['first_description_contact'],
                'second_description_contact' => $data['second_description_contact'],
                'tertiary_description_contact' => $data['tertiary_description_contact'],
                'text_contact' => $data['text_contact'],
                'description_contact' => $data['description_contact'],
                'description_contact_two' => $data['description_contact_two'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'text_button_contact' => $data['text_button_contact'],
                'image_cta' => $pathimage,
                'image_contact' =>  $pathcontact,
            ]);
        }
        return response()->json(['message' => 'Contact data save successfully']);
    }
}
