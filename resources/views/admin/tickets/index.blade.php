@extends('admin.layouts.app')

@section('page_title', 'Client Tickets')

@section('page_styles')

@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between flex-wrap">
                <div class="header-title mb-2">
                    <h4 class="card-title">Opened Tickets</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable-1" class="table data-table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Ticket Number</th>
                                <th>Title</th>
                                <th>Client Name</th>
                                <th>Status</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <th>{{$key+1}}</th>
                                    <td>{{ $item->ticket_number }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            @can('read-tickets')
                                            <a class="btn btn-sm btn-primary ml-2"
                                                href="{{ route('tickets.show', ['ticket' => $item->id]) }}">View
                                            </a>
                                            @endcan
                                            @can('delete-tickets')
                                            <form action="{{ route('tickets.destroy', ['ticket' => $item->id]) }}"
                                                method="POST" id="deleteForm-{{ $item->id }}">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-sm  btn-danger delete ml-2 text-nowrap"
                                                    data-id="{{ $item->id }}">Delete</button>
                                            </form>
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

    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between flex-wrap">
                <div class="header-title mb-2">
                    <h4 class="card-title">Closed Tickets</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable-1" class="table data-table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Ticket Number</th>
                                <th>Title</th>
                                <th>Client Name</th>
                                <th>Status</th>
                                <th>User Replied</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($closed as $key => $item)
                                <tr>
                                    <th>{{$key+1}}</th>
                                    <td>{{ $item->ticket_number }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->admin->name }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            @can('read-tickets')
                                            <a class="btn btn-sm btn-primary ml-2"
                                                href="{{ route('tickets.show', ['ticket' => $item->id]) }}">View
                                            </a>
                                            @endcan
                                            @can('delete-tickets')
                                            <form action="{{ route('tickets.destroy', ['ticket' => $item->id]) }}"
                                                method="POST" id="deleteFormClosed-{{ $item->id }}">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-sm  btn-danger delete-closed ml-2 text-nowrap"
                                                    data-id="{{ $item->id }}">Delete</button>
                                            </form>
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
                title: 'Are you sure to delete this ticket ?',
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

        $('.delete-closed').click(function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id')
            Swal.fire({
                title: 'Are you sure to delete this ticket ?',
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
                    $(`#deleteFormClosed-${id}`).submit();
                } else if (result.isDenied) {}
            })
        })
</script>
@endsection
