@extends('admin.layouts.app')

@section('page_title', 'Categories')

@section('page_styles')

@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{ $item->id ? 'Edit' : 'Create' }} Property</h4>
                </div>
            </div>
            <div class="card-body">
                <form method="POST"
                    action="{{ $item->id == null ? route('properties.store') : route('properties.update', ['property' => $item->id]) }}">
                    @csrf
                    @if ($item->id != null)
                        @method('PATCH')
                    @endif
                    <div class="row">
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ isset($item->name) ? $item->name : old('name') }}">
                                @error('name')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" id="location" name="location"
                                    value="{{ isset($item->location) ? $item->location : old('location') }}">
                                @error('location')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label for="aed_value">AED Value</label>
                                <input type="number" step="any" class="form-control" id="aed_value" name="aed_value"
                                    value="{{ isset($item->aed_value) ? $item->aed_value : old('aed_value') }}">
                                @error('aed_value')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label for="pma_contract_start_date">PMA Contract Start Date</label>
                                <input type="date" step="any" class="form-control" id="pma_contract_start_date" name="pma_contract_start_date"
                                    value="{{ isset($item->pma_contract_start_date) ? $item->pma_contract_start_date : old('pma_contract_start_date') }}">
                                @error('pma_contract_start_date')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label for="pma_contract_end_date">PMA Contract End Date</label>
                                <input type="date" step="any" class="form-control" id="pma_contract_end_date" name="pma_contract_end_date"
                                    value="{{ isset($item->pma_contract_end_date) ? $item->pma_contract_end_date : old('pma_contract_end_date') }}">
                                @error('pma_contract_end_date')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label for="sqft_size">Sqft Size</label>
                                <input type="number" step="any" class="form-control" id="sqft_size" name="sqft_size"
                                    value="{{ isset($item->sqft_size) ? $item->sqft_size : old('sqft_size') }}">
                                @error('sqft_size')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-2">
                            <div class="form-group">
                                <label for="private_units">Private Units</label>
                                    <select class="form-control mb-3" name ="private_units">
                                       <option value="1" {{$item->private_units == 1 ? 'selected': ''}}>One</option>
                                       <option value="2" {{$item->private_units == 2 ? 'selected': ''}}>Two</option>
                                       <option value="3" {{$item->private_units == 3 ? 'selected': ''}}>Three</option>
                                    </select>
                                @error('private_units')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-2">
                            <div class="form-group">
                                <label for="coworking_spaces">Coworking Spaces</label>
                                    <select class="form-control mb-3" name ="coworking_spaces">
                                       <option value="1" {{$item->coworking_spaces == 1 ? 'selected': ''}}>One</option>
                                       <option value="2" {{$item->coworking_spaces == 2 ? 'selected': ''}}>Two</option>
                                       <option value="3" {{$item->coworking_spaces == 3 ? 'selected': ''}}>Three</option>
                                    </select>
                                @error('coworking_spaces')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label>Meeting Room</label><br>
                                <div class="custom-control custom-radio custom-radio-color custom-control-inline">
                                    <input type="radio" id="meeting_room1" name="meeting_room" class="custom-control-input" {{$item->meeting_room == 1 ? 'checked' : ''}} value="1">
                                    <label class="custom-control-label" for="meeting_room1"> Yes </label>
                                 </div>
                                 <div class="custom-control custom-radio custom-radio-color custom-control-inline">
                                    <input type="radio" id="meeting_room2" name="meeting_room" class="custom-control-input" {{$item->meeting_room == 0 ? 'checked' : ''}} value="0">
                                    <label class="custom-control-label" for="meeting_room2"> No </label>
                                 </div>
                                @error('meeting_room')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label>Conference Room</label><br>
                                <div class="custom-control custom-radio custom-radio-color custom-control-inline">
                                    <input type="radio" id="conference_room1" name="conference_room" class="custom-control-input" {{$item->conference_room == 1 ? 'checked' : ''}} value="1">
                                    <label class="custom-control-label" for="conference_room1" > Yes </label>
                                 </div>
                                 <div class="custom-control custom-radio custom-radio-color custom-control-inline">
                                    <input type="radio" id="conference_room2" name="conference_room" class="custom-control-input" {{$item->conference_room == 0 ? 'checked' : ''}} value="0">
                                    <label class="custom-control-label" for="conference_room2" > No </label>
                                 </div>
                                @error('conference_room')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label>Fully Furnished</label><br>
                                <div class="custom-control custom-radio custom-radio-color custom-control-inline">
                                    <input type="radio" id="fully_furnished1" name="fully_furnished" class="custom-control-input" {{$item->fully_furnished == 1 ? 'checked' : ''}} value="1">
                                    <label class="custom-control-label" for="fully_furnished1"> Yes </label>
                                 </div>
                                 <div class="custom-control custom-radio custom-radio-color custom-control-inline">
                                    <input type="radio" id="fully_furnished2" name="fully_furnished" class="custom-control-input" {{$item->fully_furnished == 0 ? 'checked' : ''}} value="0">
                                    <label class="custom-control-label" for="fully_furnished2"> No </label>
                                 </div>
                                @error('fully_furnished')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" placeholder="" name="address">{{$item->address}}</textarea>
                            @error('address')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page_scripts')


@endsection
