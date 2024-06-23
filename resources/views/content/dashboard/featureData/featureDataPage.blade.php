@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
.image {
  height: 80px;
  width: 80px;
}

.uploaded-image,
.uploaded-image-edit {
  max-width: 100px;
  max-height: 100px;
}

.modal-footer {
  display: flex;
  justify-content: flex-end;
  flex-wrap: wrap;
}

.modal-footer .btn {
  margin: 0.5rem;
}
</style>

@section('content')

    <x-card>
        <x-slot name="title">
            Ads Features
        </x-slot>

        <x-slot name="body">
            <form id="addfeaturesdata" action="{{ route('create-features') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <x-input name="title" id="title" placeholder="Title" type="text" label="Title"
                                    value="{{ $features->title ?? '' }}" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <x-input name="first_description_features" id="first_description_features"
                                    label="Description 1" placeholder="Description 1" type="text"
                                    value="{{ $features->main_description ?? '' }}" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <x-input name="second_description_features" id="second_description_features"
                                    label="Description 2" placeholder="Description 2" type="text"
                                    value="{{ $features->secondary_description ?? '' }}" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <x-input name="tertiary_description_features" id="tertiary_description_features"
                                    placeholder="Description 3" type="text" label="Description 3"
                                    value="{{ $features->tertiary_description ?? '' }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" name="submit" id="submitFormBtn">submit</button>
                </div>
            </form>
        </x-slot>
    </x-card>

    <div class="d-flex justify-content-between flex-wrap">
        <h3>Ads Features Data</h3>
        <button type="button" class="btn btn-primary" style=" margin-right:2%;     width: 150px; height: 40px;" data-target="#add_feature_modal"
            data-toggle="modal">
            Create 
        </button>
    </div>
    <div class="modal fade" id="add_feature_modal" tabindex="-1" role="dialog" aria-labelledby="addFeatureModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="addFeatureModalLabel">Create New Feature</h1>
                </div>
                <form id="createFeatureForm" action="{{ route('create-features-data') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="Image" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" accept="image/png,image/jpeg"
                                id="imageInput" required>
                        </div>
                        <div class="form-group">
                            <img class="uploaded-image" id="previewImage">
                        </div>
                        <div class="form-group">
                            <x-input type="text" label="Title" name="title" class="form-control" required="true" />
                        </div>
                        <div class="form-group">
                            <x-input type="text" label="Location" name="location" class="form-control" required="true" />
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="10" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="subdescription" class="form-label">Sub Description</label>
                            <textarea name="subdescription" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <x-input type="text" label="Bundle Cost" name="price" class="form-control" required="true" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="saveFeatureBtn">Save</button>
                        <button type="button" class="btn btn-secondary closebut" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-card>
        <x-slot name="body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($features_data ?? [] as $index => $data)
                            <tr>
                                <td>
                                    <img src="{{ asset('images/' . $data->image) }}" class="image" alt="Image">
                                </td>
                                <td>
                                    <input type="text" value="{{ $data->title }}" name="title"
                                        class="form-control" readonly>
                                </td>
                                <td>
                                    <input type="text" value="{{ $data->location }}" name="location"
                                        class="form-control" readonly>
                                </td>
                                <td>
                                    <input type="text" value="{{ $data->price }}" name="price"
                                        class="form-control" readonly>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary edit-btn" data-toggle="modal"
                                        data-target="#editFeature" data-id="{{ $data->id }}"
                                        data-image="{{ $data->image }}" data-title="{{ $data->title }}"
                                        data-description="{{ $data->description }}" data-location="{{ $data->location }}"
                                        data-subdescription="{{ $data->sub_description }}" data-price="{{ $data->price }}">
                                        Edit
                                    </a>
                                    <a href="#" data-id="{{ $data->id }}" data-target="#deleteFeatureModal"
                                        class="btn btn-sm btn-warning delete-btn">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="editFeature" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                        </div>
                        <form id="editFeatureForm" action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="image_edit" class="form-label">Image</label>
                                    <input type="file" name="image_edit" class="form-control"
                                        accept="image/png,image/jpeg" id="imageInputEdit" required>
                                </div>
                                <div class="form-group">
                                    <img class="uploaded-image-edit" id="previewImageEdit">
                                </div>
                                <div class="form-group">
                                    <x-input type="text" label="Title" id="title_edit" name="title_edit"
                                        class="form-control" required="true" />
                                </div>
                                <div class="form-group">
                                    <x-input type="text" label="Location" id="location_edit" name="location_edit"
                                        class="form-control" required="true" />
                                </div>
                                <div class="form-group">
                                    <x-input type="text" label="Bundle Cost" id="price_edit" name="price_edit"
                                        class="form-control" required="true" />
                                </div>
                                <div class="form-group">
                                    <label for="description_edit" class="form-label">Description</label>
                                    <textarea name="description_edit" id="description_edit" class="form-control" rows="10" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="sub_description_edit" class="form-label">Sub Description</label>
                                    <textarea name="sub_description_edit" id="sub_description_edit" class="form-control" rows="4" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="updateFeatureBtn">Update</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-card>

@endsection

@include('content.dashboard.featureData.scripts')
