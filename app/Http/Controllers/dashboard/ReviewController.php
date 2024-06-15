<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\ReviewsData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class ReviewController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();

        $data['reviews'] = Review::where('user_id', $user_id ?? '')->first();
        $data['reviews_data'] = ReviewsData::where('reviews_id', $data['reviews']->id ?? '')->get();
        return view('content.dashboard.reviewData.reviewDataPage', $data);
    }

    public function createReview(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'first_description_review' => 'required|string',
            'second_description_review' => 'required|string',
            'tertiary_description_review' => 'required|string',
        ]);

        $user_id = Auth::id();
        $reviewdata = Review::updateOrCreate([
            'user_id' => $user_id,
        ], [
            'title' => $data['title'],
            'first_description_review' => $data['first_description_review'],
            'second_description_review' => $data['second_description_review'],
            'tertiary_description_review' => $data['tertiary_description_review'],
        ]);



        return response()->json(['message' => 'Data created successfully']);
    }
    public function createReviewsData(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string',
            'position' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'required|numeric|min:0|max:5',
        ]);

        $user_id = Auth::id();
        $review_data = Review::where('user_id', $user_id ?? '')
            ->first();

        $pathimage = $data['image']->store('uploads/images/reviews', 'public');
        $pathicon = $data['icon']->store('uploads/images/reviews', 'public');

        $review =  ReviewsData::create([
            'reviews_id' => $review_data->id,
            'name' => $data['name'],
            'description' => $data['description'],
            'image' =>  $pathimage,
            'icon' => $pathicon,
            'position' => $data['position'],
            'rating' => $data['rating'],
        ]);

        return response()->json(['message' => 'Review Data save successfully', 'review' => $review]);
    }
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'description_edit' => 'required|string',

            'name_edit' => 'required|string',
            'position_edit' => 'required|string',
            'description_edit' => 'required|string',
            'rating_edit' => 'required|numeric|min:0|max:5',

        ]);
        $review =  ReviewsData::find($id);

        if (!$review) {
            return response()->json(['message' => 'this not found'], 404);
        }
        if (isset($request->image_edit)) {
            $pathimage = $request->image_edit->store('uploads/images/reviews', 'public');
            $review->update([
                'image' => $pathimage,
            ]);
        }
        if (isset($request->icon_edit)) {
            $pathicon = $request->icon_edit->store('uploads/images/reviews', 'public');
            $review->update([
                'icon' => $pathicon,
            ]);
        }
        $review->update([

            'name' => $validatedData['name_edit'],
            'rating' => $validatedData['rating_edit'],
            'description' => $validatedData['description_edit'],
            'position' => $validatedData['position_edit'],
        ]);
        return response()->json(['message' => 'Review data updated successfully', 'review' => $review]);
    }
    public function destroy($id)
    {

        $review = ReviewsData::find($id);

        if (!$review) {
            return response()->json(['error' => 'Review not found'], 404);
        }

        $review->delete();

        return response()->json(['message' => 'Review Data deleted successfully']);
    }
}
