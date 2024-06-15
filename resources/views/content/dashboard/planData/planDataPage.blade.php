@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>

</style>

@section('content')

    <x-card>
        <x-slot name="title">
            Ads Plan
        </x-slot>

        <x-slot name="body">
            <form id="addplansdata" action="{{ route('create-plan') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <x-input name="title_plan" id="title_plan" placeholder="Title" type="text"
                            value="{{ $plan->title ?? '' }}" label="Title" />
                    </div>
                    <div class="form-group">
                        <x-input name="first_description" id="first_description" placeholder="Description 1" type="text"
                            value="{{ $plan->first_description ?? '' }}" label="Description 1" />
                    </div>
                    <div class="form-group">
                        <x-input name="second_description" id="second_description" placeholder="Description 2"
                            type="text" value="{{ $plan->second_description ?? '' }}" label="Description 2" />
                    </div>
                    <div class="form-group">
                        <x-input name="tertiary_description" id="tertiary_description" placeholder="Description 3"
                            type="text" value="{{ $plan->tertiary_description ?? '' }}" label="Description 3" />
                    </div>
                    <div class="form-group">
                        <x-input name="four_description" id="four_description" placeholder="Description 4" type="text"
                            value="{{ $plan->four_description ?? '' }}" label="Description 4" />
                    </div>
                    <div class="form-group">
                        <x-input name="switch_text_left" id="switch_text_left" placeholder="Switch Text Left" type="text"
                            value="{{ $plan->text_switch_left ?? '' }}" label="Switch Text Left" />
                    </div>
                    <div class="form-group">
                        <x-input name="switch_text_right" id="switch_text_right" placeholder="Switch Text Right"
                            type="text" value="{{ $plan->text_switch_right ?? '' }}" label="Switch Text Left" />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" name="submit" id="submitFormBtn">submit</button>
                </div>
            </form>
        </x-slot>
    </x-card>


    <div class="d-flex justify-content-between">
        <h3>Ads Plans Data</h3>
        <button type="button" class="btn btn-primary" style="width: 170px; height: 40px;" data-target="#add_plan_modal"
            data-toggle="modal">
            Create Plans Data
        </button>
    </div>



    <x-card>

        <x-slot name="body">
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>image</th>
                            <th>title</th>
                            <th>price monthly</th>
                            <th>price yearly</th>
                            <th>total price</th>

                            <th>action</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($plan_data ?? [] as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><img  src="{{ explode('/', $data->image)[0] === 'uploads' ? asset('storage/' . $data->image)??'' : asset( $data->image) ??''}}" alt="Image"></td>

                                <td> <input readonly type="text" value="{{ $data->title }}" name="title" class="form-control">
                                </td>
                                <td> <input readonly type="text" value="{{ $data->monthly_price }}" name="monthly_price"
                                        class="form-control">
                                </td>
                                <td> <input readonly  type="text" value="{{ $data->yearly_price }}" name="yearly_price"
                                        class="form-control">
                                </td>
                                <td> <input  readonly type="text" value="{{ $data->total_price }}" name="total_price"
                                        class="form-control">
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary edit-btn" data-toggle="modal"
                                        data-target="#editPlan" data-id="{{ $data->id }}"
                                        data-image="{{ $data->image }}" data-title="{{ $data->title }}"
                                        data-monthly-price="{{ $data->monthly_price }}"
                                        data-yearly-price="{{ $data->yearly_price }}"
                                        data-total-price="{{ $data->total_price }}"
                                        data-text-button="{{ $data->text_button }}">Edit</a>
                                    <a href="#" data-id="{{ $data->id }}" data-target="#deletePlanModal"
                                        class="btn btn-sm btn-warning delete-btn  ">Delete</a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>
            <div class="modal fade" id="editPlan" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel">Edit Review</h5>
                        </div>
                        <form id="editPlanForm" action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="Image" class="form-label">Image</label>
                                    <input type="file" name="edit_image" class="form-control"
                                        accept="image/png,image/jpeg" id="imageInputEdit" required>
                                </div>
                                <div class="form-group">
                                    <img class="uploaded-image-edit" style="max-width: 100px; max-height: 100px;"
                                        id="previewImageEdit">
                                </div>
                                <div class="form-group">
                                    <x-input type="text" label="Title" name="title_edit" id="title_edit"
                                        class="form-control" required="true" />
                                </div>
                                <div class="form-group">
                                    <x-input type="text" label="Price Monthly" name="monthly_edit" id="monthly_edit"
                                        class="form-control" required="true" />
                                </div>
                                <div class="form-group">
                                    <x-input type="text" label="Price Yearly" name="yearly_edit" id="yearly_edit"
                                        class="form-control" required="true" />
                                </div>
                                <div class="form-group">
                                    <x-input type="text" label="Price Total" name="total_price_edit"
                                        id="total_price_edit" class="form-control" required="true" />
                                </div>
                                <div class="form-group">
                                    <x-input type="text" label="Text Button" name="text_button_edit"
                                        id="text_button_edit" class="form-control" required="true" />
                                </div>



                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="updatePlanBtn">Update</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-card>

    <x-card>
        <x-slot name="title">
            Ads List of Plan
        </x-slot>
        <x-slot name="body">
            
                <form id="addpricingdata" action="{{ route('create-list-plan') }}" method="POST">
                    @csrf
        
                    <div class="modal-body">
        
        
                        <div class="mb-12">
                            <div class="form-group">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><button type="button" class="btn btn-primary"
                                                    id="add_btn_plan">+</button>
                                            </th>
        
        
                                            <th> Select Name OF PLAN </th>
                                            <th> Content</th>
        
        
                                        </tr>
                                    </thead>
                                    <tbody id="plan_table">
                                    </tbody>
                                </table>
                                <div class="col-12 text-right ">
                                    <button type="submit" class="btn btn-primary" name="submit">submit</button>
                                </div>
                            </div>
                        </div>
        
        
        
        
        
        
        
        
                    </div>
        
                </form>
           
        

        </x-slot>
    </x-card>


    <div class="modal fade" id="add_plan_modal" tabindex="-1" role="dialog" aria-labelledby="addPlanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="addPlanModalLabel"> Create Data Plan</h1>
                </div>
                <form id="createPlanForm" action="{{ route('create-plan-data') }}" method="post"
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
                            <x-input type="text" label="Title" name="title" class="form-control"
                                required="true" />
                        </div>
                        <div class="form-group">
                            <x-input type="text" label="Price Monthly" name="monthly" class="form-control"
                                required="true" />
                        </div>
                        <div class="form-group">
                            <x-input type="text" label="Price Yearly" name="yearly" class="form-control"
                                required="true" />
                        </div>
                        <div class="form-group">
                            <x-input type="text" label="Price Total" name="total_price" class="form-control"
                                required="true" />
                        </div>
                        <div class="form-group">
                            <x-input type="text" label="Text Button" name="text_button" class="form-control"
                                required="true" />
                        </div>



                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="savePlanBtn">Save</button>
                            <button type="button" class="btn btn-secondary closebut" data-dismiss="modal">Close</button>
                        </div>
                </form>
            </div>
        </div>
    </div>



















@endsection
@include('content.dashboard.planData.scripts')
