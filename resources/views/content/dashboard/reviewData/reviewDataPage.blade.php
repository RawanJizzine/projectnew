@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>

</style>

@section('content')

    <x-card>
        <x-slot name="title">
            Ads Reviews Data
        </x-slot>

        <x-slot name="body">
            <form id="addreviewsdata" action="{{ route('create-review') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <x-input name="title" id="title" placeholder="Title" type="text"
                            value="{{ $reviews->title ?? '' }}" label="Title" />
                    </div>
                    <div class="form-group">
                        <x-input name="first_description_review" id="first_description_review" placeholder="Description 1"
                            type="text" value="{{ $reviews->first_description_review ?? '' }}" label="Description 1" />
                    </div>
                    <div class="form-group">
                        <x-input name="second_description_review" id="second_description_review" placeholder="Description 2"
                            type="text" value="{{ $reviews->second_description_review ?? '' }}" label="Description 2" />
                    </div>
                    <div class="form-group">
                        <x-input name="tertiary_description_review" id="tertiary_description_review"
                            placeholder="Description 3" type="text"
                            value="{{ $reviews->tertiary_description_review ?? '' }}" label="Description 3" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" name="submit" id="submitFormBtn">submit</button>
                </div>
            </form>
        </x-slot>
    </x-card>

    <div class="d-flex justify-content-between">
        <h3>Ads Reviews Data</h3>
        <button type="button" class="btn btn-primary" style="width: 170px; height: 40px;" data-target="#add_review_modal"
            data-toggle="modal">
            Create Data Review
        </button>
    </div>
    <div class="modal fade" id="add_review_modal" tabindex="-1" role="dialog" aria-labelledby="addReviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="addReviewModalLabel"> Create Data Review</h1>
                </div>
                <form id="createReviewForm" action="{{ route('create-reviews-data') }}" method="post"
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
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="6" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Icon" class="form-label">Icon</label>
                            <input type="file" name="icon" class="form-control" accept="image/png,image/jpeg"
                                id="iconInput" required>
                        </div>
                        <div class="form-group">
                            <img class="uploaded-icon" style="max-width: 100px; max-height: 100px;" id="previewIcon">
                        </div>
                        <label for="rating" class="form-label">Rating/5</label>
                        <input type="number" name="rating" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="saveReviewBtn">Save</button>
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
                            <th>image</th>
                            <th>description</th>
                            <th>rating</th>
                            <th>icon</th>
                            <th>name</th>
                            <th>position</th>
                            <th>action</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($reviews_data ?? [] as $index => $data)
                            <tr>
                                
                                <td><img  src="{{ explode('/', $data->image)[0] === 'uploads' ? asset('storage/' . $data->image)??'' : asset( $data->image) ??''}}" alt="Image"></td>
                                <td>
                                    <textarea readonly name="description" class="form-control" cols="24" rows="8">{{ $data->description }}</textarea>
                                </td>
                                <td><input readonly type="number" value="{{ $data->rating }}" min="0" max="5"
                                        name="rating" class="form-control"></td>


                                <td><img  src="{{ explode('/', $data->icon)[0] === 'uploads' ? asset('storage/' . $data->icon)??'' : asset( $data->icon) ??''}}" alt="Icon"></td>
                                <td> <input  readonly type="text" value="{{ $data->name }}" name="name"
                                        class="form-control">
                                </td>
                                <td> <input readonly type="text" value="{{ $data->position }}" name="position"
                                        class="form-control">
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary edit-btn" data-toggle="modal"
                                        data-target="#editReview" data-id="{{ $data->id }}"
                                        data-image="{{ $data->image }}" data-rating="{{ $data->rating }}"
                                        data-icon="{{ $data->icon }}" data-position="{{ $data->position }}"
                                        data-name="{{ $data->name }}"
                                        data-description="{{ $data->description }}">Edit</a>
                                    <a href="#" data-id="{{ $data->id }}" data-target="#deleteReviewModal"
                                        class="btn btn-sm btn-warning delete-btn  ">Delete</a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>


            </div>
        </x-slot>
    </x-card>


    <div class="modal fade" id="editReview" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit Review</h5>
                </div>
                <form id="editReviewForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="Image" class="form-label">Image</label>
                            <input type="file" name="edit_image" class="form-control" accept="image/png,image/jpeg"
                                id="imageInputEdit" required>
                        </div>
                        <div class="form-group">
                            <img class="uploaded-image-edit" style="max-width: 100px; max-height: 100px;"
                                id="previewImageEdit">
                        </div>
                        <div class="form-group">
                            <x-input type="text" label="Name" id="name_edit" name="name_edit" class="form-control"
                                required="true" />
                        </div>
                        <div class="form-group">
                            <x-input type="text" label="Position" id="position_edit" name="position_edit"
                                class="form-control" required="true" />
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description_edit" id="description_edit" class="form-control" rows="6" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Icon_edit" class="form-label">Icon</label>
                            <input type="file" name="icon_edit" class="form-control" accept="image/png,image/jpeg"
                                id="iconInputEdit" required>
                        </div>
                        <div class="form-group">
                            <img class="uploaded-icon-edit" style="max-width: 100px; max-height: 100px;"
                                id="previewIconEdit">
                        </div>
                        <div class="form-group">
                            <label for="rating_edit" class="form-label">Rating/5</label>
                            <input type="number" name="rating_edit" id="rating_edit" class="form-control" required>
                        </div>

                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="updateReviewBtn">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@include('content.dashboard.reviewData.scripts')
