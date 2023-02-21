@extends('admin.layouts.app')

@section('page_title', 'Client Management')

@section('page_styles')

@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between flex-wrap">
                <div class="header-title mb-2">
                    <h4 class="card-title"> Client Management </h4>
                </div>
                <div>
                    @can('write-clients')
                    <a href="{{ route('clients.create') }}" class="btn btn-primary btn-sm mb-2">Create Client</a>
                    </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable-1" class="table data-table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Date Added</th>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Company Name</th>
                                <th>Contact Name</th>
                                <th>Mobile Number</th>
                                <th>WhatsApp Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->company_name }}</td>
                                    <td>{{ $item->contact_name }}</td>
                                    <td>{{ $item->mobile_number }}</td>
                                    <td>{{ $item->whatsapp_number }}</td>
                                    <td>
                                        <div class="d-flex gap-1 justify-content-center">
                                            @can('write-units')
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('clients.edit', ['client' => $item->id]) }}">Edit
                                            </a>
                                            @endcan
                                            @can('read-units')
                                            <a class="btn btn-sm btn-primary ml-2"
                                                href="{{ route('clients.show', ['client' => $item->id]) }}">View
                                            </a>
                                            @endcan
                                            @can('delete-units')
                                            <form action="{{ route('clients.destroy', ['client' => $item->id]) }}"
                                                method="POST" id="deleteForm-{{ $item->id }}">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-sm  btn-danger delete ml-2"
                                                    data-id="{{ $item->id }}">Delete</button>
                                            </form>
                                            @endcan
                                        </div>
                                        <div class="text-center mt-2">
                                            @can('write-units')
                                             <a class="btn btn-sm btn-success  bg-success-darker btn- ml-2"
                                                href="{{ route('client.doc.create', ['client' => $item->id]) }}">Add Document
                                             </a>
                                            @endcan
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
