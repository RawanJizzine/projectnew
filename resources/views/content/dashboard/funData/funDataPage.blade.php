@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>

</style>

@section('content')

    <div class="d-flex justify-content-between">
        <h3>Ads Fun Data</h3>
        <button type="button" class="btn btn-primary" style="width: 170px; height: 40px;" data-target="#add_fun_modal"
            data-toggle="modal">
            Create New Fun
        </button>
    </div>
    <div class="modal fade" id="add_fun_modal" tabindex="-1" role="dialog" aria-labelledby="addFunModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="addFunModalLabel">Create New Fun</h1>
                </div>
                <form id="createFunForm" action="{{ route('create-funs-data') }}" method="post"
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
                            <x-input type="text" label="Event" name="event" class="form-control" required="true" />
                        </div>
                        <div class="form-group">
                            <x-input type="text" label="Title" name="title" class="form-control" required="true" />
                        </div>
                        <div class="form-group">
                            <x-input type="text" label="Text" name="text" class="form-control" required="true" />
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
                        <button type="button" class="btn btn-primary" id="saveFunBtn">Save</button>
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
                            <th>Event</th>
                            <th>Title</th>
                            <th>Text</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($funs_data ?? [] as $index => $data)
                            <tr>
                               
                                <td><img src="{{ explode('/', $data['image'])[0] === 'uploads' ? asset('storage/' . $data['image'])??'' : asset( $data['image']) ??''}}" alt="Image"></td>
                                <td> <input readonly type="text" value="{{ $data['event'] }}" name="event" class="form-control">
                                </td>
                                <td> <input readonly type="text" value="{{ $data['title'] }}" name="title" class="form-control">
                                </td>
                                <td> <input readonly  type="text" value="{{ $data['text'] }}" name="text" class="form-control">
                                </td>


                                <td>
                                    <a href="#" class="btn btn-sm btn-primary edit-btn" data-toggle="modal"
                                        data-target="#editFun" data-id="{{ $data['id'] }}"
                                        data-image="{{ $data['image'] }}" data-event="{{ $data['event'] }}"
                                        data-text="{{ $data['text'] }}" data-title="{{ $data['title'] }}"
                                        data-border-color="{{ $data['border_color'] }}">Edit</a>
                                    <a href="#" data-id="{{ $data['id'] }}" data-target="#deleteFunModal"
                                        class="btn btn-sm btn-warning delete-btn  ">Delete</a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>


            </div>
        </x-slot>
    </x-card>


    <div class="modal fade" id="editFun" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit Fun Data</h5>
                </div>
                <form id="editFunForm" action="" method="POST" enctype="multipart/form-data">
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
                            <x-input type="text" label="Event" name="event_edit" id="event_edit"
                                class="form-control" required="true" />
                        </div>
                        <div class="form-group">
                            <x-input type="text" label="Title" name="title_edit" id="title_edit"
                                class="form-control" required="true" />
                        </div>
                        <div class="form-group">
                            <x-input type="text" label="Text" name="text_edit" id="text_edit" class="form-control"
                                required="true" />
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
                        <button type="button" class="btn btn-primary" id="updateFunBtn">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
@include('content.dashboard.funData.scripts')
