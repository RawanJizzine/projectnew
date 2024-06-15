<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\PlanData;
use App\Models\PlanList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PricingPlanController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $data['plan'] = Plan::where('user_id', $user_id ?? '')->first();
        $data['plan_data'] = PlanData::where('plan_id', $data['plan']->id??'')->get();
        return view('content.dashboard.planData.planDataPage', $data);
    }

    public function createPlan(Request $request)
    {
        $data = $request->validate([
            'title_plan' => 'required|string',
            'first_description' => 'required|string',
            'second_description' => 'required|string',
            'tertiary_description' => 'required|string',
            'four_description' => 'required|string',
            'switch_text_left' => 'required|string',
            'switch_text_right' => 'required|string',

        ]);
        $user_id = Auth::id();
        $plandata = Plan::updateOrCreate([
            'user_id' => $user_id,
        ], [
            'title' => $data['title_plan'],
            'first_description' => $data['first_description'],
            'second_description' => $data['second_description'],
            'tertiary_description' => $data['tertiary_description'],
            'four_description' => $data['four_description'],
            'text_switch_left' => $data['switch_text_left'],
            'text_switch_right' => $data['switch_text_right'],
        ]);
        return response()->json(['message' => 'Data created successfully']);
    }
    public function createPlanData(Request $request)
    {

        $data = $request->validate([
            'title' => 'required|string',
            'text_button' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'monthly' => 'required|numeric',
            'yearly' => 'required|numeric',
            'total_price' => 'required|numeric',
        ]);

        $user_id = Auth::id();
        $plan = Plan::where('user_id', $user_id ?? '')
            ->first();

        $pathimage = $data['image']->store('uploads/images/plans', 'public');


        $plandata =  PlanData::create([
            'plan_id' => $plan->id,
            'title' => $data['title'],
            'text_button' => $data['text_button'],
            'image' =>  $pathimage,
            'monthly_price' => $data['monthly'],
            'yearly_price' => $data['yearly'],
            'total_price' => $data['total_price'],
        ]);
        return response()->json(['message' => 'Plan Data save successfully', 'plan' => $plandata]);
    }
    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'title_edit' => 'required|string',
            'text_button_edit' => 'required|string',
            'monthly_edit' => 'required|numeric',
            'yearly_edit' => 'required|numeric',
            'total_price_edit' => 'required|numeric',
        ]);

        $plandata =  PlanData::find($id);

        if (!$plandata) {
            return response()->json(['message' => 'this not found'], 404);
        }
        if (isset($request->image_edit)) {
            $pathimage = $request->image_edit->store('uploads/images/reviews', 'public');
            $plandata->update([
                'image' => $pathimage,
            ]);
        }

        $plandata->update([
            'title' => $data['title_edit'],
            'text_button' => $data['text_button_edit'],
            'monthly_price' => $data['monthly_edit'],
            'yearly_price' => $data['yearly_edit'],
            'total_price' => $data['total_price_edit'],
        ]);
        return response()->json(['message' => 'Review data updated successfully', 'plandata' => $plandata]);
    }
    public function destroy($id)
    {

        $plandata = PlanData::find($id);

        if (!$plandata) {
            return response()->json(['error' => 'Plan data  not found'], 404);
        }

        $plandata->delete();

        return response()->json(['message' => 'Plan Data deleted successfully']);
    }
    public function insertListPlan(Request $request)
    {
   
        $user_id = auth()->id();
        foreach ($request->data as $key => $item) {
            $data = [
                'plan_data_id' => $item['plan_name'],
                'content_list' => $item['content_list'],
                'user_id' => $user_id,
            ];
            if (isset($item['id'])) {

                PlanList::where('id', $item['id'])->update($data);
            } else {

                PlanList::create($data);
            }
        }
    }
    public function getPlanDataList()
    {
        $user_id = auth()->id();
        $planlist = PlanList::where('user_id', $user_id)->get();

        if ($planlist) {
            $formattedData = $planlist;
            return response()->json(['success' => true, 'data' => $formattedData]);
        } else {
            return response()->json(['success' => false]);
        }
    }
    public function delete($id)
    {

        $listdata = PlanList::find($id);

        if (!$listdata) {
            return response()->json(['error' => 'Content List plan data  not found'], 404);
        }

        $listdata->delete();

        return response()->json(['message' => 'Content List plan data deleted successfully']);
    }



}
