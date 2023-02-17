@extends('admin.layouts.app')

@section('page_title', 'Client Management')

@section('page_styles')

@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{ $item->id ? 'Edit' : 'Create' }} Client </h4>
                </div>
            </div>
            <div class="card-body">
                <form method="POST"
                    action="{{ $item->id == null ? route('clients.store') : route('clients.update', ['client' => $item->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @if ($item->id != null)
                        @method('PATCH')
                    @endif
                    <div class="row">
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label for="company_name">Company Name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name"
                                    value="{{ isset($item->company_name) ? $item->company_name : old('company_name') }}">
                                @error('company_name')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label for="contact_name">Contact Name</label>
                                <input type="text" class="form-control" id="contact_name" name="contact_name"
                                    value="{{ isset($item->contact_name) ? $item->contact_name : old('contact_name') }}">
                                @error('contact_name')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label for="mobile_number">Mobile Number</label>
                                <input type="tel" step="any" class="form-control" id="mobile_number" name="mobile_number"
                                    value="{{ isset($item->mobile_number) ? $item->mobile_number : old('mobile_number') }}">
                                @error('mobile_number')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label for="whatsapp_number">WhatsApp Number</label>
                                <input  type="tel"  class="form-control" id="whatsapp_number" name="whatsapp_number"
                                    value="{{ isset($item->whatsapp_number) ? $item->whatsapp_number : old('whatsapp_number') }}">
                                @error('whatsapp_number')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ isset($item->email) ? $item->email : old('email') }}">
                                @error('email')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label for="name">User Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ isset($item->name) ? $item->name : old('name') }}">
                                @error('name')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label for="license_number">License Number</label>
                                <input type="text" class="form-control" id="license_number" name="license_number"
                                    value="{{ isset($item->license_number) ? $item->license_number : old('license_number') }}">
                                @error('license_number')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label for="password">Temporary Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                @error('password')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="form-group">
                                <label for="password_confirmation">Re-enter Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                @error('password_confirmation')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea type="number" class="form-control" id="address" name="address"
                                    >{{ isset($item->address) ? $item->address : old('address') }}</textarea>
                                @error('address')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            <a class="btn btn-sm btn-outline-primary" href="{{route('clients.index')}}">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page_scripts')


@endsection
