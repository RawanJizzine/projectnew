@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>

</style>

@section('content')
<x-card>
    <x-slot name="title">
        Ads App Data
    </x-slot>

    <x-slot name="body">
        <form id="addappdata" action="{{ route('create-app-data') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="modal-body">
                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                <div class="form-group">
                    <x-input name="title" id="title" placeholder="Name Of Business" type="text" label="Name Of Business"
                        value="{{ $data->title ?? '' }}" />
                </div> 
                <div class="form-group">
                    <label for="logo" class="form-label">Logo</label>
                    <input type="file" name="logo" class="form-control" accept="image/png,image/jpeg" id="imageInputelement"   >
                </div>
                <div class="form-group">
                    @if ($data->image ?? '')
                   
                        <img class="uploaded-image-element" src="{{ asset('images/' . $data->image) }}"
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
@include('content.dashboard.appData.scripts')