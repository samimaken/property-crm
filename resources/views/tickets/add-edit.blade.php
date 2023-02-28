@extends('layouts.app')

@section('page_title', 'Client Ticket')

@section('page_styles')

@endsection

@section('content')
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Create Ticket</h4>
                </div>
            </div>
            <div class="card-body">
                <form method="POST"
                    action="{{route('client-tickets.store')}}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ isset($item->title) ? $item->title : old('title') }}">
                                @error('title')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" rows="5" name="description">{{ isset($item->description) ? $item->description : old('description') }}</textarea>
                                @error('description')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12  mb-2">
                            <label for="image">Image</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="image" name="image"
                                    >
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                            @error('image')
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
