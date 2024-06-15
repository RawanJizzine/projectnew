<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\TeamData;
use App\Models\TeamModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TeamController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $data['team'] = TeamModel::where('user_id', $user_id ?? '')->first();
        $teams_data = TeamData::where('team_id', $data['team']->id ?? '')->get();
        $team = $this->TeamsData($teams_data);
        $data['listcolor'] = ['grey', 'blue', 'red', 'green'];
        $data['teams_data'] = $team;

        return view('content.dashboard.teamData.teamDataPage', $data);
    }
    public function createTeam(Request $request)
    {

        $data = $request->validate([
            'title_team' => 'required|string',
            'first_description_team' => 'required|string',
            'second_description_team' => 'required|string',
            'tertiary_description_team' => 'required|string',

        ]);

        $user_id = Auth::id();
        $teamsdata = TeamModel::updateOrCreate([
            'user_id' => $user_id,
        ], [
            'title' => $data['title_team'],
            'first_text' => $data['first_description_team'],
            'second_text' => $data['second_description_team'],
            'tertiary_text' => $data['tertiary_description_team'],
        ]);



        return response()->json(['message' => 'Data created successfully']);
    }
    public function createTeamsData(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string',
            'position' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user_id = Auth::id();
        $team_data = TeamModel::where('user_id', $user_id ?? '')
            ->first();

        $path = $data['image']->store('uploads/images/teams', 'public');
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
        switch ($request->label_color) {
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
        $team =  TeamData::create([
            'team_id' => $team_data->id,
            'name' => $data['name'],
            'position' => $data['position'],
            'image' => $path,
            'color_label' => $labelColor,
            'color_border' => $borderColor,
        ]);
        return response()->json(['message' => 'Data team save successfully', 'team' => $team]);
    }
    public function update(Request $request, $id)

    {

        $validatedData = $request->validate([
            'name_edit' => 'required|string',
            'position_edit' => 'required|string',
        ]);

        $team =  TeamData::find($id);

        if (!$team) {
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
            $path = $request->image_edit->store('uploads/images/teams', 'public');
            $team->update([
                'name' => $validatedData['name_edit'],
                'position' => $validatedData['position_edit'],
                'image' => $path,
                'color_label' => $labelColor,
                'color_border' => $borderColor,
            ]);
        } else {

            $team->update([
                'name' => $validatedData['name_edit'],
                'position' => $validatedData['position_edit'],
                'color_label' => $labelColor,
                'color_border' => $borderColor,
            ]);
        }
        return response()->json(['message' => 'team updated successfully', 'team' => $team,]);
    }
    public function destroy($id)
    {

        $team = TeamData::find($id);

        if (!$team) {
            return response()->json(['error' => 'Team not found'], 404);
        }

        $team->delete();

        return response()->json(['message' => 'Team deleted successfully']);
    }
    protected function TeamsData($teams)
    {
        $data = [];
        foreach ($teams ?? [] as $team) {
            $labelColor = '';
            switch ($team['color_label']) {
                case 'bg-label-danger':
                    $labelColor = 'red';
                    break;
                case 'bg-label-success':
                    $labelColor = 'green';
                    break;
                case 'bg-label-primary':
                    $labelColor = 'grey';
                    break;
                case 'bg-label-info':
                    $labelColor = 'blue';
                    break;

                default:
                    $labelColor = '';
            }

            $borderColor = '';
            switch ($team['color_border']) {
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

                default:
                    $borderColor = '';
            }
            $data[] = [
                'id' => $team->id,
                'name' => $team->name,
                'position' => $team->position,
                'image' => $team->image,
                'label_color' => $labelColor,
                'border_color' => $borderColor,
                'label_class' => $team['color_label'],
                'border_class' => $team['color_border_label'],
            ];
        }


        return $data;
    }
}
