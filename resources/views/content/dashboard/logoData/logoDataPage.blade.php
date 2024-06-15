@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>

</style>

@section('content')
    <div class="d-flex justify-content-between">
        <h3>Ads Logo Data</h3>
        <button type="button" class="btn btn-primary" style="width: 170px; height: 40px;" data-target="#add_logo_modal"
            data-toggle="modal">
            Create Logo
        </button>
    </div>
    <div class="modal fade" id="add_logo_modal" tabindex="-1" role="dialog" aria-labelledby="addLogoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="addLogoModalLabel">Create Logo</h1>
                </div>
                <form id="createLogoForm" action="{{ route('create-logo-data') }}" method="post"
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

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="saveLogoBtn">Save</button>
                        <button type="button" class="btn btn-secondary closebut" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div>

        <x-card>
            <x-slot name="body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>photo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($logos_data ?? [] as $index => $data)
                            <tr>

                                <td><img  src="{{ explode('/', $data->image)[0] === 'uploads' ? asset('storage/' . $data->image)??'' : asset( $data->image) ??''}}" alt="Image"></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary edit-btn" data-toggle="modal"
                                        data-target="#editLogo" data-id="{{ $data->id }}"
                                        data-image="{{ $data->image }}">Edit</a>
                                    <a href="#" data-id="{{ $data->id }}" data-target="#deleteLogoModal"
                                        class="btn btn-sm btn-warning delete-btn  ">Delete</a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </x-slot>
        </x-card>

    </div>


    <div class="modal fade" id="editLogo" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit Logo </h5>
                </div>
                <form id="editLogoForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="image_edit" class="form-label">Image</label>
                            <input type="file" name="image_edit" class="form-control" accept="image/png,image/jpeg"
                                id="imageInputEdit" required>
                        </div>
                        <div class="form-group">
                            <img class="uploaded-image-edit" style="max-width: 100px; max-height: 100px;"
                                id="previewImageEdit">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="updateLogoBtn">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>











@endsection
@include('content.dashboard.logoData.scripts')
