<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\LogoData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $data['logos_data'] = LogoData::where('user_id', $user_id)->get();
        return view('content.dashboard.logoData.logoDataPage', $data);
    }


    public function createLogoData(Request $request)
    {

        $data = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $user_id = Auth::id();
        $path = $data['image']->store('uploads/images/logo', 'public');
        $logo =  LogoData::create([
            'user_id' => $user_id,
            'image' => $path,
        ]);
        return response()->json(['message' => 'Logo save successfully', 'logo' => $logo]);
    }

    public function update(Request $request, $id)

    {
        $logo =  LogoData::find($id);
        if (!$logo) {
            return response()->json(['message' => 'this not found'], 404);
        }
        if (isset($request->image_edit)) {
            $path = $request->image_edit->store('uploads/images/logo', 'public');
            $logo->update([
                'image' => $path,
            ]);
        }
        return response()->json(['message' => 'logo updated successfully', 'logo' => $logo]);
    }

    public function destroy($id)
    {
        $logo = LogoData::find($id);

        if (!$logo) {
            return response()->json(['error' => 'Logo not found'], 404);
        }

        $logo->delete();

        return response()->json(['message' => 'Logo deleted successfully']);
    }
}
