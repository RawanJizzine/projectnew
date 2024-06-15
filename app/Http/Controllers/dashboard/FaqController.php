<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $data['faqs'] = Faq::where('user_id', $user_id ?? '')->first();
        $data['faqs_data'] = FaqModel::where('faq_id', $data['faqs']->id ?? '')->get();
        return view('content.dashboard.faqData.faqDataPage', $data);
    }

    public function createFaq(Request $request)
    {

        $data = $request->validate([
            'title' => 'required|string',
            'first_description' => 'required|string',
            'second_description' => 'required|string',
            'tertiary_description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user_id = Auth::id();
        $path = $data['image']->store('uploads/images/faqs', 'public');
        $faqsdata = Faq::updateOrCreate([
            'user_id' => $user_id,
        ], [
            'title' => $data['title'],
            'first_description' => $data['first_description'],
            'second_description' => $data['second_description'],
            'tertiary_description' => $data['tertiary_description'],
            'image' => $path,
        ]);
        return response()->json(['message' => 'Data created successfully']);
    }

    public function createFaqsData(Request $request)
    {

        $data = $request->validate([
            'title_faqs' => 'required|string',
            'description' => 'required|string',
        ]);
        $user_id = Auth::id();
        $faq_data = Faq::where('user_id', $user_id ?? '')
            ->first();
        $faq =  FaqModel::create([
            'faq_id' => $faq_data->id,
            'title' => $data['title_faqs'],
            'description' => $data['description'],
        ]);
        return response()->json(['message' => 'faq save successfully', 'faq' => $faq]);
    }

    public function update(Request $request, $id)

    {
      
        $validatedData = $request->validate([
            'description_edit' => 'required|string',
            'title_edit' => 'required|string',
        ]);

        $faq =  FaqModel::find($id);
        if (!$faq) {
            return response()->json(['message' => 'this not found'], 404);
        }
        $faq->update([
            'title' => $validatedData['title_edit'],
            'description' => $validatedData['description_edit'],
        ]);
        return response()->json(['message' => 'faq updated successfully', 'faq' => $faq]);
    }



    public function destroy($id)
    {
        $faq = FaqModel::find($id);

        if (!$faq) {
            return response()->json(['error' => 'Faq not found'], 404);
        }

        $faq->delete();

        return response()->json(['message' => 'Faq deleted successfully']);
    }
}
