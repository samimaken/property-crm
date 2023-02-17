@extends('admin.layouts.app')

@section('page_title', 'Users Management')

@section('page_styles')

@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between flex-wrap">
                <div class="header-title mb-2">
                    <h4 class="card-title"> Users Management </h4>
                </div>
                <div>
                    @can('write-users')
                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm mb-2">Create User</a>
                    </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable-1" class="table data-table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>User Name</th>
                                <th>Mobile Number</th>
                                <th>Position</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->user_name }}</td>
                                    <td>{{ $item->mobile_number }}</td>
                                    <td>{{ $item->position }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <div class="d-flex gap-1 justify-content-center">
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('users.edit', ['user' => $item->id]) }}">Edit
                                            </a>
                                            <a class="btn btn-sm btn-primary ml-2"
                                                href="{{ route('users.show', ['user' => $item->id]) }}">View
                                            </a>
                                            <form action="{{ route('users.destroy', ['user' => $item->id]) }}"
                                                method="POST" id="deleteForm-{{ $item->id }}">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-sm  btn-danger delete ml-2"
                                                    data-id="{{ $item->id }}">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                title: 'Are you sure to delete this client ?',
                text: "Please confirm by typing “DELETE” on the box below",
                input: "text",
                icon: 'warning',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Yes',
                inputValidator: (value) => {
                    if (value != 'DELETE') {
                        return 'You need to write DELETE'
                    }
                }
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $(`#deleteForm-${id}`).submit();
                } else if (result.isDenied) {}
            })
        })
    </script>

@endsection
