<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\FunFact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FunFactsController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();

        $funs_data = FunFact::where('user_id', $user_id ?? '')->get();
        $fun = $this->FunsData($funs_data);
        $data['listcolor'] = ['grey', 'blue', 'red', 'green'];
        $data['funs_data'] = $fun;


        return view('content.dashboard.funData.funDataPage', $data);
    }
    public function createFunsData(Request $request)
    {

        $data = $request->validate([
            'event' => 'required|string',
            'title' => 'required|string',
            'text' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $user_id = Auth::id();

        $path = $data['image']->store('uploads/images/funs', 'public');
        $labelColor = '';
        switch ($request->label_color) {
            case 'red':
                $labelColor = 'bg-label-danger';
                break;
            case 'green':
                $labelColor = 'bg-label-success';
                break;
            case 'grey':
                $labelColor = 'bg-label-primary';
                break;
            case 'blue':
                $labelColor = 'bg-label-info';
                break;

            default:
                $labelColor = '';
        }

        $borderColor = '';
        switch ($request->border_color) {
            case 'red':
                $borderColor = 'border-label-danger';
                break;
            case 'green':
                $borderColor = 'border-label-success';
                break;
            case 'grey':
                $borderColor = 'border-label-primary';
                break;
            case 'blue':
                $borderColor = 'border-label-info';
                break;

            default:
                $borderColor = '';
        }
        $fun =  FunFact::create([
            'user_id' => $user_id,
            'event' => $data['event'],
            'title' => $data['title'],
            'text' => $data['text'],
            'image' => $path,
            'border_color' => $borderColor,
        ]);
        return response()->json(['message' => 'Data team save successfully', 'fun' => $fun]);
    }
    public function update(Request $request, $id)

    {

        $validatedData = $request->validate([
            'event_edit' => 'required|string',
            'title_edit' => 'required|string',
            'text_edit' => 'required|string',
        ]);

        $fun =  FunFact::find($id);

        if (!$fun) {
            return response()->json(['message' => 'this not found'], 404);
        }
        $labelColor = '';
        switch ($request->label_color_edit) {
            case 'red':
                $labelColor = 'bg-label-danger';
                break;
            case 'green':
                $labelColor = 'bg-label-success';
                break;
            case 'grey':
                $labelColor = 'bg-label-primary';
                break;
            case 'blue':
                $labelColor = 'bg-label-info';
                break;

            default:
                $labelColor = '';
        }

        $borderColor = '';
        switch ($request->border_color_edit) {
            case 'red':
                $borderColor = 'border-label-danger';
                break;
            case 'green':
                $borderColor = 'border-label-success';
                break;
            case 'grey':
                $borderColor = 'border-label-primary';
                break;
            case 'blue':
                $borderColor = 'border-label-info';
                break;

            default:
                $borderColor = '';
        }


        if (isset($request->image_edit)) {
            $path = $request->image_edit->store('uploads/images/funs', 'public');
            $fun->update([
                'event' => $validatedData['event_edit'],
                'title' => $validatedData['title_edit'],
                'text' => $validatedData['text_edit'],
                'image' => $path,

                'border_color' => $borderColor,
            ]);
        } else {

            $fun->update([
                'event' => $validatedData['event_edit'],
                'title' => $validatedData['title_edit'],
                'text' => $validatedData['text_edit'],
                'border_color' => $borderColor,
            ]);
        }
        return response()->json(['message' => 'fun updated successfully', 'fun' => $fun,]);
    }


    public function destroy($id)
    {

        $fun = FunFact::find($id);

        if (!$fun) {
            return response()->json(['error' => 'Fun not found'], 404);
        }

        $fun->delete();

        return response()->json(['message' => 'Fun deleted successfully']);
    }
    protected function FunsData($funs)
    {
        $data = [];
        foreach ($funs ?? [] as $fun) {
            $borderColor = '';
            switch ($fun['border_color']) {
                case 'border-label-danger':
                    $borderColor = 'red';
                    break;
                case 'border-label-success':
                    $borderColor = 'green';
                    break;
                case 'border-label-primary':
                    $borderColor = 'grey';
                    break;
                case 'border-label-info':
                    $borderColor = 'blue';
                    break;
                    // Add more cases if needed
                default:
                    $borderColor = ''; // Default value
            }
            $data[] = [
                'id' => $fun->id,
                'event' => $fun->event,
                'title' => $fun->title,
                'text' => $fun->text,
                'border_color' => $borderColor,
                'image' => $fun->image,
            ];
        }


        return $data;
    }
}
