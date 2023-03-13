@extends('admin.layouts.app')

@section('page_title', 'Quotations')

@section('page_styles')

@endsection

@section('content')
    <div class="col-12">
        <div class="mb-2">
            <h5 class="m-0">Approved Quotation for Generate Invoices & Contracts</h5>
        </div>
        <div class="card">
            <div class="card-header d-flex justify-content-between flex-wrap">
                <div class="header-title mb-2">
                    <h5 class="card-title">{{request()->type == 'archived'  ? 'Archived' : ''}} Quotations </h5>
                </div>
                <div>
                    <a href="{{ route('quotations.approved', ['type' => 'archived']) }}"
                        class="btn btn-danger btn-sm mb-2">Archived ({{$archived}})</a>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable-1" class="table data-table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Quotation Number</th>
                                <th>Company</th>
                                <th>Client Name</th>
                                <th>Quote Status</th>
                                <th>Approved Date</th>
                                <th>Telephone Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->quotation_number }}</td>
                                    <td>{{ $item->company }}</td>
                                    <td>{{ $item->client_name }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>{{ $item->client_telephone }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            @if (request()->type == 'archived')
                                            @can('delete-quote-requests')
                                            <form action="{{ route('quotations.delete', ['id' => $item->id]) }}"
                                                method="POST" id="deletePermanentForm-{{ $item->id }}">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-sm  btn-danger delete ml-2"
                                                    data-id="{{ $item->id }}">Delete</button>
                                            </form>
                                            @endcan
                                            @can('delete-quote-requests')
                                                <form
                                                    action="{{ route('quotations.unarchive', ['id' => $item->id]) }}"
                                                    method="POST">

                                                    @csrf
                                                    <button class="btn btn-sm  btn-danger  ml-2" type="submit">Unarchive</button>
                                                </form>
                                                @endcan
                                            @else
                                            @can('write-quote-requests')
                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ route('quotations.show', [ 'quotation' => $item->id]) }}">View
                                                    </a>
                                                    @endcan
                                                    @can('delete-quote-requests')
                                                <form action="{{ route('quotations.destroy', [ 'quotation' => $item->id]) }}"
                                                    method="POST" id="deleteForm-{{ $item->id }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-sm  btn-danger archive ml-2"
                                                        data-id="{{ $item->id }}">Archive</button>
                                                </form>
                                                @endcan
                                            @endif
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
        $('.archive').click(function(e) {
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

        $('.delete').click(function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id')
            Swal.fire({
                title: 'Are you sure to delete this quotation ?',
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
                    $(`#deletePermanentForm-${id}`).submit();
                } else if (result.isDenied) {}
            })
        })
    </script>

@endsection
