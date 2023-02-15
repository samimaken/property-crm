@extends('admin.layouts.app')

@section('page_title', 'Property Unit')

@section('page_styles')

@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{ $item->id ? 'Edit' : 'Create' }} Property Unit - {{$propertyData->name}}</h4>
                </div>
            </div>
            <div class="card-body">
                <form method="POST"
                    action="{{ $item->id == null ? route('units.store', ['property' => request()->property]) : route('units.update', ['property' => request()->property, 'unit' => $item->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @if ($item->id != null)
                        @method('PATCH')
                    @endif
                    <div class="row">
                        <div class="col-12 col-md-4 mb-2">
                            <div class="form-group">
                                <label for="type">Select Type</label>
                                    <select class="form-control mb-3" name ="type">
                                       <option value="private-unit" {{$item->type == 'private-unit' ? 'selected': ''}}>Private Unit</option>
                                       <option value="coworking-space" {{$item->type == 'coworking-space' ? 'selected': ''}}>Co-Working Spaces</option>
                                    </select>
                                @error('type')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label for="unit_id">Unit ID</label>
                                <input type="text" class="form-control" id="unit_id" name="unit_id"
                                    value="{{ isset($item->unit_id) ? $item->unit_id : old('unit_id') }}">
                                @error('unit_id')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label for="tawtheeq_id">Tawtheeq ID</label>
                                <input type="text" class="form-control" id="tawtheeq_id" name="tawtheeq_id"
                                    value="{{ isset($item->tawtheeq_id) ? $item->tawtheeq_id : old('tawtheeq_id') }}">
                                @error('tawtheeq_id')
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
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label for="desks_allocated">Desks Allocated</label>
                                <input list="desks" type="text"  class="custom-select custom-select-sm" id="desks_allocated" name="desks_allocated"
                                    value="{{ isset($item->desks_allocated) ? $item->desks_allocated : old('desks_allocated') }}">
                                    <datalist id="desks">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                     </datalist>
                                @error('desks_allocated')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label for="unit_price_1">Unit Price 1 Payments AED</label>
                                <input type="number" class="form-control" id="unit_price_1" name="unit_price_1"
                                    value="{{ isset($item->unit_price_1) ? $item->unit_price_1 : old('unit_price_1') }}">
                                @error('unit_price_1')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label for="unit_price_2">Unit Price 2 Payments AED</label>
                                <input type="number" class="form-control" id="unit_price_2" name="unit_price_2"
                                    value="{{ isset($item->unit_price_2) ? $item->unit_price_2 : old('unit_price_2') }}">
                                @error('unit_price_2')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label for="unit_price_monthly">Unit Price Monthly AED</label>
                                <input type="number" class="form-control" id="unit_price_monthly" name="unit_price_monthly"
                                    value="{{ isset($item->unit_price_monthly) ? $item->unit_price_monthly : old('unit_price_monthly') }}">
                                @error('unit_price_monthly')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label for="deposit_amount">Deposit Amount AED</label>
                                <input type="number" class="form-control" id="deposit_amount" name="deposit_amount"
                                    value="{{ isset($item->deposit_amount) ? $item->deposit_amount : old('deposit_amount') }}">
                                @error('deposit_amount')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">Unit Images</p>
                        </div>
                        <div class="col-12 col-md-3 mb-2">
                            @if ($item->image1 != null)
                                   <img class="img-fluid mb-2" src="{{$item->image1}}"> <br>
                            @endif
                            <label for="image1">Image 1</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="image1" name="image1"
                                    >
                                <label class="custom-file-label" for="image1">Choose file</label>
                            </div>
                            @error('image1')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-3 mb-2">
                            @if ($item->image2 != null)
                              <img class="img-fluid mb-2" src="{{$item->image2}}"> <br>
                            @endif
                            <label for="image2">Image 2</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="image2" name="image2"
                                    >
                                <label class="custom-file-label" for="image2">Choose file</label>
                            </div>
                            @error('image2')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-3 mb-2">
                            @if ($item->image3 != null)
                                   <img class="img-fluid mb-2" src="{{$item->image3}}"> <br>
                            @endif
                            <label for="image3">Image 3</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="image3" name="image3"
                                    >
                                <label class="custom-file-label" for="image3">Choose file</label>
                            </div>
                            @error('image3')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-3 mb-2">
                            @if ($item->image4 != null)
                                   <img class="img-fluid mb-2" src="{{$item->image4}}"> <br>
                            @endif
                            <label for="image4">Image 4</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="image4" name="image4"
                                    >
                                <label class="custom-file-label" for="image4">Choose file</label>
                            </div>
                            @error('image4')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label>Fully Furnished</label><br>
                                <div class="custom-control custom-radio custom-radio-color custom-control-inline">
                                    <input type="radio" id="furnished1" name="furnished"
                                        class="custom-control-input" {{ $item->furnished == 1 ? 'checked' : '' }}
                                        value="1">
                                    <label class="custom-control-label" for="furnished1"> Yes </label>
                                </div>
                                <div class="custom-control custom-radio custom-radio-color custom-control-inline">
                                    <input type="radio" id="furnished2" name="furnished"
                                        class="custom-control-input" {{ $item->furnished == 0 ? 'checked' : '' }}
                                        value="0">
                                    <label class="custom-control-label" for="furnished2"> No </label>
                                </div>
                                @error('furnished')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            <a class="btn btn-sm btn-outline-primary" href="{{route('units.index', ['property' => request()->property])}}">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page_scripts')


@endsection
