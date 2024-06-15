@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>

</style>

@section('content')

    <x-card>
        <x-slot name="title">
            Ads Faq
        </x-slot>

        <x-slot name="body">
            <form id="addfaqsdata" action="{{ route('create-faq') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <x-input name="title" id="title" placeholder="Title" type="text" label="Title"
                                    value="{{ $faqs->title ?? '' }}" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <x-input name="first_description" id="first_description" label="Description 1"
                                    placeholder="Description 1" type="text"
                                    value="{{ $faqs->first_description ?? '' }}" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <x-input name="second_description" id="second_description" label="Description 2"
                                    placeholder="Description 2" type="text"
                                    value="{{ $faqs->second_description ?? '' }}" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <x-input name="tertiary_description" id="tertiary_description" placeholder="Description 3"
                                    type="text" label="Description 3" value="{{ $faqs->tertiary_description ?? '' }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Image" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" accept="image/png,image/jpeg"
                                id="imageInput" required>
                        </div>
                        
                        @if ($faqs->image ?? '')
                            <img class="uploaded-image" 
                            src="{{ explode('/', $faqs->image)[0] === 'uploads' ? asset('storage/' . $faqs->image)??'' : asset( $faqs->image) ??''}}"
                                style="max-width: 100px; max-height: 100px;" id="previewImage" >
                        @else
                            <img class="uploaded-image" style="max-width: 100px; max-height: 100px;" id="previewImage">
                        @endif

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" name="submit" id="submitFormBtn">submit</button>

                </div>
            </form>
        </x-slot>
    </x-card>



    <div class="d-flex justify-content-between">
        <h3>Ads Faqs Data</h3>
        <button type="button" class="btn btn-primary" style="width: 170px; height: 40px;" data-target="#add_faq_modal"
            data-toggle="modal">
            Create Faq
        </button>
    </div>
    <div class="modal fade" id="add_faq_modal" tabindex="-1" role="dialog" aria-labelledby="addFaqModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="addFaqModalLabel"> Create Faq </h1>
                </div>
                <form id="createFaqForm" action="{{ route('create-faqs-data') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">


                        <div class="form-group">
                            <x-input type="text" label="Title" name="title_faqs" class="form-control" required="true" />
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="6" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="saveFaqBtn">Save</button>
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
                            <th>title</th>
                            <th>description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($faqs_data ?? [] as $index => $data)
                            <tr>
                                <td>
                                    <input name="" readonly class="form-control" value="{{ $data->title }}">
                                </td>

                                <td>
                                    <textarea name="" readonly class="form-control" cols="4" rows="6">{{ $data->description }}</textarea>
                                </td>


                                <td>
                                    <a href="#" class="btn btn-sm btn-primary edit-btn" data-toggle="modal"
                                        data-target="#editFaq" data-id="{{ $data->id }}"
                                        data-title="{{ $data->title }}"
                                        data-description="{{ $data->description }}">Edit</a>
                                    <a href="#" data-id="{{ $data->id }}" data-target="#deleteFaqModal"
                                        class="btn btn-sm btn-warning delete-btn  ">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="editFaq" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel">Edit Faq Data</h5>
                        </div>
                        <form id="editFaqForm" action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">


                                <div class="form-group">
                                    <x-input type="text" label="Title" id="title_edit" name="title_edit"
                                        class="form-control" required="true" />
                                </div>
                                <div class="form-group">
                                    <label for="description_edit" class="form-label">Description</label>
                                    <textarea name="description_edit" id="description_edit" class="form-control" rows="6" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="updateFaqBtn">Update</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-card>

@endsection
@include('content.dashboard.faqData.scripts')
