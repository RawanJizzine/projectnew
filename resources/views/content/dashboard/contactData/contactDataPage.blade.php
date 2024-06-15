@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>

</style>

@section('content')

    <x-card>


        <x-slot name="title">
            Ads CTA and Contacts Data
        </x-slot>

        <x-slot name="body">
            <form id="addcontactsdata" action="{{ route('contact-save-data') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $contact->id ?? '' }}">
                    <div class="form-group">
                        <x-input name="title_cta" id="title_cta" placeholder="CTA Title" type="text"
                            value="{{ $contact->title_cta ?? '' }}" label="CTA Title" />
                    </div>
                    <div class="form-group">
                        <x-input name="description_cta" id="description_cta" placeholder="CTA Text 1" type="text"
                            value="{{ $contact->description_cta ?? '' }}" label="CTA Text 1" />
                    </div>
                    <div class="form-group">
                        <x-input name="text_button_cta" id="text_button_cta" placeholder="CTA Text Button" type="text"
                            value="{{ $contact->button_text_cta ?? '' }}" label="CTA Text Button" />
                    </div>
                    <div class="form-group">
                        <label for="image_cta" class="form-label">Image CTA</label>
                        <input id="imageInputcta" type="file" name="image_cta" class="form-control" accept="image/png,image/jpeg">
                    </div>
                    <div class="form-group" >
                        @if ($contact->image_cta ?? '')
                            <img class="uploaded-cta-image"   src="{{ explode('/', $contact->image_cta)[0] === 'uploads' ? asset('storage/' . $contact->image_cta)??'' : asset( $contact->image_cta) ??''}}"    
                                style="max-width: 100px; max-height: 100px;" id="previewImagecta">
                        @else
                            <img class="uploaded-cta-image" style="max-width: 100px; max-height: 100px;" id="previewImagecta" >
                        @endif
                    </div>
                    <div class="form-group">
                        <x-input name="title_contact" id="title_contact" placeholder="Contact US Title" type="text"
                            value="{{ $contact->title_contact ?? '' }}" label="Contact US Title" />
                    </div>
                    <div class="form-group">
                        <x-input name="first_description_contact" id="first_description_contact"
                            placeholder="Contact US Description 1" type="text"
                            value="{{ $contact->first_description_contact ?? '' }}" label="Contact US Description 1" />
                    </div>
                    <div class="form-group">
                        <x-input name="second_description_contact" id="second_description_contact"
                            placeholder="Contact US Description 2" type="text"
                            value="{{ $contact->second_description_contact ?? '' }}" label="Contact US Description 2" />
                    </div>
                    <div class="form-group">
                        <x-input name="tertiary_description_contact" id="tertiary_description_contact"
                            placeholder="Contact US Description 3" type="text"
                            value="{{ $contact->tertiary_description_contact ?? '' }}" label="Contact US Description 3" />
                    </div>

                    <div class="form-group">
                        <label for="image_contact" class="form-label">Image Contact </label>
                        <input type="file" name="image_contact" id="imageInputcontact"     class="form-control" accept="image/png,image/jpeg">
                    </div>
                    <div class="form-group">
                        @if ($contact->image_contact ?? '')
                            <img class="uploaded-contact-image" src="{{ explode('/', $contact->image_contact)[0] === 'uploads' ? asset('storage/' . $contact->image_contact)??'' : asset( $contact->image_contact) ??''}}"   
                                style="max-width: 100px; max-height: 100px;" id="previewImagecontact"  >
                        @else
                            <img class="uploaded-contact-image" style="max-width: 100px; max-height: 100px;" id="previewImagecontact"   >
                        @endif
                    </div>
                    <div class="form-group">
                        <x-input name="text_contact" id="text_contact" placeholder="Contact SubTitle " type="text"
                            value="{{ $contact->text_contact ?? '' }}" label="Contact SubTitle" />
                    </div>
                    <div class="form-group">
                        <x-input name="description_contact" id="description_contact" placeholder="Contact Description 1"
                            type="text" value="{{ $contact->description_contact ?? '' }}"
                            label="Contact Description 1" />
                    </div>
                    <div class="form-group">
                        <x-input name="description_contact_two" id="description_contact_two"
                            placeholder="Contact Description 2 " type="text"
                            value="{{ $contact->description_contact_two ?? '' }}" label="Contact Description 2" />
                    </div>
                    <div class="form-group">
                        <x-input name="email" id="email" placeholder="Email " type="text"
                            value="{{ $contact->email ?? '' }}" label="Email" />
                    </div>
                    <div class="form-group">
                        <x-input name="phone" id="phone" placeholder="Phone" type="text"
                            value="{{ $contact->phone ?? '' }}" label="Phone" />
                    </div>

                    <div class="form-group">
                        <x-input name="text_button_contact" id="text_button_contact" placeholder="Contact Text Button"
                            type="text" value="{{ $contact->text_button_contact ?? '' }}"
                            label="Contact Text Button" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit">Save</button>
                    <div class="mx-2"></div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </x-slot>


    </x-card>














@endsection
@include('content.dashboard.contactData.scripts')
