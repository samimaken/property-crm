@extends('admin.layouts.app')

@section('page_title', 'Users Management')

@section('page_styles')

@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">View User</h4>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-6 col-12">
                        <p class="m-0"><strong>{{ $item->name }}</strong></p>
                        <div class="d-flex mt-2 mb-2">
                            <span><i class="fa-regular fa-calendar-days"></i> {{ $item->created_at }}</span>
                        </div>
                        <div class="mt-2  mb-2">
                            <span><strong>Email: </strong> {{ $item->email }}</span>
                        </div>
                        <div class="mt-2  mb-2">
                            <span><strong>User Name: </strong> {{ $item->user_name }}</span>
                        </div>
                        <div class="mt-2  mb-2">
                            <span><strong>Position: </strong> {{ $item->position }}</span>
                        </div>
                        <div class="mt-2  mb-2">
                            <span><strong>Mobile Number: </strong> {{ $item->mobile_number }}</span>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <h6 class="m-0 mb-2">Permission</h6>
                           <p>
                            @foreach ($item->permissions as $key => $permission)
                              <span class="badge badge-primary mb-2 mr-2">{{str_replace('-', ' ',$permission->name)}}</span>
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_scripts')

    <script>
        $('.delete').click(function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id')
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $(`#deleteForm-${id}`).submit();
                } else if (result.isDenied) {}
            })
        })
    </script>
@endsection
