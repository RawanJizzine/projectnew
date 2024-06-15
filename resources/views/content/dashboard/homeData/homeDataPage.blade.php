@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>

</style>

@section('content')

    <x-card>
        <x-slot name="title">
            Ads Home Data
        </x-slot>

        <x-slot name="body">
            <form id="addhomedata" action="{{ route('create-home-data') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $home->id ?? '' }}">

                    <div class="form-group">
                        <x-input name="title" id="title" placeholder="Title" type="text" label="Title"
                            value="{{ $home->title ?? '' }}" />
                    </div>
                    <div class="form-group">
                        <x-input name="main_description" id="main_description" label="Description 1"
                            placeholder="Description 1" type="text" value="{{ $home->main_description ?? '' }}" />
                    </div>
                    <div class="form-group">
                        <x-input name="second_description" id="second_description" placeholder="Description 2"
                            label="Description 2" type="text" value="{{ $home->secondary_description ?? '' }}" />
                    </div>

                    <div class="form-group">
                        <x-input name="button_text" id="button_text" placeholder="Text Button" type="text"
                            label="Text Button" value="{{ $home->button_text ?? '' }}" />
                    </div>
                    <div class="form-group">
                        <label for="image_link_dashboard" class="form-label">Image Dashboard</label>
                        <input type="file" name="image_link_dashboard" class="form-control" id="imageInput"
                            accept="image/png,image/jpeg">
                    </div>
                    <div class="form-group">
                        @if ($home->image_link_dashboard ?? '')
                            <img class="uploaded-image-dashboard" 
                            src="{{ asset('images/' . $home->image_link_dashboard) }}"
                                style="max-width: 100px; max-height: 100px;" id="previewImage" >
                        @else
                            <img class="uploaded-image-dashboard" style="max-width: 100px; max-height: 100px;" id="previewImage">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="image_link_element" class="form-label">Image Element</label>
                        <input type="file" name="image_link_element" class="form-control" accept="image/png,image/jpeg" id="imageInputelement"   >
                    </div>
                    <div class="form-group">
                        @if ($home->image_link_element ?? '')
                       
                            <img class="uploaded-image-element" src="{{ explode('/', $home->image_link_element)[0] === 'uploads' ? url("") . '/storage/' . $home->image_link_element : asset( $home->image_link_element) }}"alt="hero elements"
                                style="max-width: 100px; max-height: 100px;"   id="previewImageelement"   >
                        @else
                            <img class="uploaded-image-element" style="max-width: 100px; max-height: 100px;"  id="previewImageelement"    >
                        @endif
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit">submit</button>
                    <div class="mx-2"></div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </x-slot>
    </x-card>


@endsection
@include('content.dashboard.homeData.scripts')
