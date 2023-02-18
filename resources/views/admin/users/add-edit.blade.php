@extends('admin.layouts.app')

@section('page_title', 'Users Management')

@section('page_styles')

@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{ $item->id ? 'Edit' : 'Create' }} User </h4>
                </div>
            </div>
            <div class="card-body">
                <form method="POST"
                    action="{{ $item->id == null ? route('users.store') : route('users.update', ['user' => $item->id]) }}">
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
                                <label for="user_name">User Name</label>
                                <input type="text" class="form-control" id="user_name" name="user_name"
                                    value="{{ isset($item->user_name) ? $item->user_name : old('user_name') }}">
                                @error('user_name')
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
                                <label for="mobile_number">Mobile Number</label>
                                <input type="tel" step="any" class="form-control" id="mobile_number"
                                    name="mobile_number"
                                    value="{{ isset($item->mobile_number) ? $item->mobile_number : old('mobile_number') }}">
                                @error('mobile_number')
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
                                <label for="position">Position</label>
                                <input type="text" class="form-control" id="position" name="position"
                                    value="{{ isset($item->position) ? $item->position : old('position') }}">
                                @error('position')
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
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">
                                @error('password_confirmation')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="m-0">Permissions</p>
                        </div>
                        <div class="col-12">
                            <div class="row p-2">
                                @foreach ($permissions as $key => $permission)
                                    <div class="custom-control custom-checkbox  mb-2 col-2">
                                        <input type="checkbox" name="permissions[]" value="{{$permission->id}}" class="custom-control-input"
                                            id="customCheck-{{ $key }}"
                                            {{in_array($permission->id, $item['permission_ids'] ?? []) ? 'checked': ''}}>
                                        <label class="custom-control-label text-capitalize"
                                            for="customCheck-{{ $key }}">{{ str_replace('-', ' ', $permission->name) }}</label>
                                    </div>
                                @endforeach
                            </div>
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
