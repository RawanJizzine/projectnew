@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>

</style>

@section('content')

    <x-card>
        <x-slot name="title">
            Ads Team
        </x-slot>

        <x-slot name="body">

            <form id="addteamsdata" action="{{ route('create-team-data') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <x-input name="title_team" id="title_team" placeholder="Title" type="text"
                            value="{{ $team->title ?? '' }}" label="Title" />
                    </div>
                    <div class="form-group">
                        <x-input name="first_description_team" id="first_description_team" placeholder="Text 1"
                            type="text" value="{{ $team->first_text ?? '' }}" label="Text 1" />
                    </div>
                    <div class="form-group">
                        <x-input name="second_description_team" id="second_description_team" placeholder="Text 2"
                            type="text" value="{{ $team->second_text ?? '' }}" label="Text 2" />
                    </div>
                    <div class="form-group">
                        <x-input name="tertiary_description_team" id="tertiary_description_team" placeholder="Text 3"
                            type="text" value="{{ $team->tertiary_text ?? '' }}" label="Text 3" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" name="submit" id="submitFormBtn">submit</button>

                </div>
            </form>
        </x-slot>
    </x-card>



    <div class="d-flex justify-content-between">
        <h3>Ads Teams Data</h3>
        <button type="button" class="btn btn-primary" style="width: 170px; height: 40px;" data-target="#add_team_modal"
            data-toggle="modal">
            Create New Team
        </button>
    </div>
    <div class="modal fade" id="add_team_modal" tabindex="-1" role="dialog" aria-labelledby="addTeamModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="addTeamModalLabel">Create New Team</h1>
                </div>
                <form id="createTeamForm" action="{{ route('create-teams-data') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="Image" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" accept="image/png,image/jpeg"
                                id="imageInput" required>
                        </div>
                        <div class="form-group">
                            <img class="uploaded-image" style="max-width: 100px; max-height: 100px;" id="previewImage">
                        </div>
                        <div class="form-group">
                            <x-input type="text" label="Name" name="name" class="form-control" required="true" />
                        </div>
                        <div class="form-group">
                            <x-input type="text" label="Position" name="position" class="form-control" required="true" />
                        </div>
                        <div class="form-group">
                            <label for="LabelColor" class="form-label">Label Color</label>
                            <select name="label_color" id="label_color">
                                @foreach ($listcolor as $color)
                                    <option value="{{ $color }}">{{ ucfirst($color) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="BorderColor" class="form-label">Border Color</label>
                            <select name="border_color" id="border_color">
                                @foreach ($listcolor as $color)
                                    <option value="{{ $color }}">{{ ucfirst($color) }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="saveTeamBtn">Save</button>
                        <button type="button" class="btn btn-secondary closebut" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <x-card>
        <x-slot name="body">
            <div>
                <table class="table">
                    <thead>
                        <tr>
                           
                            <th>photo</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($teams_data ?? [] as $index => $data)
                            <tr>
                               
                                <td><img src="{{ explode('/', $data['image'])[0] === 'uploads' ? asset('storage/' . $data['image'])??'' : asset( $data['image']) ??''}}"  alt="Image"></td>
                                <td> <input type="text" readonly value="{{ $data['name'] }}" name="name"
                                        class="form-control">
                                </td>
                                <td> <input type="text" readonly value="{{ $data['position'] }}" name="position"
                                        class="form-control">
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary edit-btn" data-toggle="modal"
                                        data-target="#editTeam" data-id="{{ $data['id'] }}"
                                        data-image="{{ $data['image'] }}" data-name="{{ $data['name'] }}"
                                        data-position="{{ $data['position'] }}"
                                        data-label-color="{{ $data['label_color'] }}"
                                        data-border-color="{{ $data['border_color'] }}">Edit</a>
                                    <a href="#" data-id="{{ $data['id'] }}" data-target="#deleteTeamModal"
                                        class="btn btn-sm btn-warning delete-btn  ">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-slot>
    </x-card>


    <div class="modal fade" id="editTeam" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit Team Data</h5>
                </div>
                <form id="editTeamForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="Image" class="form-label">Image</label>
                            <input type="file" name="image_edit" class="form-control" accept="image/png,image/jpeg"
                                id="imageInputEdit" required>
                        </div>
                        <div class="form-group">
                            <img class="uploaded-image" style="max-width: 100px; max-height: 100px;"
                                id="previewImageEdit">
                        </div>
                        <div class="form-group">
                            <x-input type="text" label="Name" name="name_edit" id="name_edit" class="form-control"
                                required="true" />
                        </div>
                        <div class="form-group">
                            <x-input type="text" label="Position" name="position_edit" id="position_edit"
                                class="form-control" required="true" />
                        </div>
                        <div class="form-group">
                            <label for="LabelColor" class="form-label">Label Color</label>
                            <select name="label_color_edit" id="label_color_edit" data-selected="">
                                @foreach ($listcolor as $color)
                                    <option value="{{ $color }}">{{ ucfirst($color) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="BorderColor" class="form-label">Border Color</label>
                            <select name="border_color_edit" id="border_color_edit" data-selected="">
                                @foreach ($listcolor as $color)
                                    <option value="{{ $color }}">{{ ucfirst($color) }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="updateTeamBtn">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>











@endsection
@include('content.dashboard.teamData.scripts')
