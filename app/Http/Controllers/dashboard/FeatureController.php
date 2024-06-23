<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;
use App\Models\FeaturesData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class FeatureController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $data['features'] = Feature::where('user_id', $user_id ?? '')->first();
        $c = FeaturesData::where('features_id', $data['features']->id ?? '')->get();
       
        $data['features_data']=$c;
        return view('content.dashboard.featureData.featureDataPage', $data);
    }
    protected function FuturesData($futures){
        $data = [];

        foreach($futures as $future){
          
            if($future->image){
             
                $data[] = [
                    'id'=>$future->id,

                    'title' => $future->title,
                    'description' => $future->description,
                    'image' => url("") . '/storage/' .$future->image,
                ];
            }
        }
        return $data;
    }

    public function createFeature(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'first_description_features' => 'required|string',
            'second_description_features' => 'required|string',
            'tertiary_description_features' => 'required|string',
        ]);

        $user_id = Auth::id();
        $featuresdata = Feature::updateOrCreate([
            'user_id' => $user_id,
        ], [
            'title' => $data['title'],
            'main_description' => $data['first_description_features'],
            'secondary_description' => $data['second_description_features'],
            'tertiary_description' => $data['tertiary_description_features'],
        ]);
        return response()->json(['message' => 'Data created successfully']);
    }

    public function createFeaturesData(Request $request)
    {
  
        $data = $request->validate([
            'title' => 'required|string',
            'price' => 'required|numeric',
            'location' => 'required|string',
            'description' => 'required|string',
            'subdescription' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user_id = Auth::id();
        $feature_data = Feature::where('user_id', $user_id ?? '')
            ->first();
       
        $path = time() . '.' . $data['image']->extension();
        $data['image']->move(public_path('images'), $path);
        $feature =  FeaturesData::create([
            'features_id' => $feature_data->id,
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $path,
            'location'=>$data['location'],
            'price'=>$data['price'],
            'sub_description'=>$data['subdescription'] ,
            'user_id'=>$user_id,

        ]);

        return response()->json(['message' => 'User save successfully', 'feature' => $feature]);
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'description_edit' => 'required|string',
            'title_edit' => 'required|string',
            'location_edit' => 'required|string',
            'sub_description_edit' => 'required|string',
            'price_edit' => 'required|numeric',

        ]);
        $feature =  FeaturesData::find($id);
        if (!$feature) {
            return response()->json(['message' => 'this not found'], 404);
        }
        if (isset($request->image_edit)) {
            $path = $request->image_edit->store('images', 'public');
         
            $feature->update([
                'title' => $validatedData['title_edit'],
                'description' => $validatedData['description_edit'],
                'image' => $path,
                'price'=>$validatedData['price_edit'],
                'location' => $validatedData['location_edit'],
                'sub_description' => $validatedData['sub_description_edit'],
            ]);
        } else {
            $feature->update([
                'title' => $validatedData['title_edit'],
                'description' => $validatedData['description_edit'],
                'location' => $validatedData['location_edit'],
                'sub_description' => $validatedData['sub_description_edit'],
                'price'=>$validatedData['price_edit'],
            ]);
        }

        return response()->json(['message' => 'feature updated successfully', 'feature' => $feature]);
    }



    public function destroy($id)
    {

        $feature = FeaturesData::find($id);
        if (!$feature) {
            return response()->json(['error' => 'Feature not found'], 404);
        }
        $feature->delete();
        return response()->json(['message' => 'Feature deleted successfully']);
    }
}
