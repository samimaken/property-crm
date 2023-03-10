@extends('admin.layouts.app')

@section('page_title', 'Property Units')

@section('page_styles')

@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between flex-wrap">
                <div class="header-title mb-2">
                    <h4 class="card-title">{{request()->type == 'archived'  ? 'Archived' : ''}} Units – {{$propertyData->name}}</h4>
                </div>
                <div>
                    <a href="{{ route('units.index', ['property' => request()->property]) }}"
                        class="btn btn-success btn-sm mb-2">Active ({{$active}})</a>
                    <a href="{{ route('units.index', ['property' => request()->property, 'type' => 'archived']) }}"
                        class="btn btn-danger btn-sm mb-2">Archived ({{$archived}})</a>
                    @can('write-units')
                    <a href="{{ route('units.create', ['property' => request()->property]) }}" class="btn btn-primary btn-sm mb-2">Create Unit</a>
                    @endcan
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable-1" class="table data-table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Date Added</th>
                                <th>Unit ID</th>
                                <th>Sqft Size</th>
                                <th>Type</th>
                                <th>Desks Allocated</th>
                                <th>Furnished</th>
                                <th>Unit Price Monthly AED</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->unit_id }}</td>
                                    <td>{{ $item->sqft_size }}</td>
                                    <td>{{ $item->type == 'private-unit' ? 'Private Unit' : 'Co-Working Space' }}</td>
                                    <td>{{ $item->desks_allocated }}</td>
                                    <td>{!! $item->furnished == 1 ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-danger">No</span>' !!}</td>
                                    <td>{{ $item->unit_price_monthly }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            @if (request()->type == 'archived')
                                            @can('delete-units')
                                            <form action="{{ route('units.delete', ['property' => request()->property, 'id' => $item->id]) }}"
                                                method="POST" id="deletePermanentForm-{{ $item->id }}">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-sm  btn-danger delete ml-2"
                                                    data-id="{{ $item->id }}">Delete</button>
                                            </form>
                                            @endcan
                                            @can('delete-units')
                                                <form
                                                    action="{{ route('units.unarchive', ['property' => request()->property, 'id' => $item->id]) }}"
                                                    method="POST">

                                                    @csrf
                                                    <button class="btn btn-sm  btn-danger  ml-2" type="submit">Unarchive</button>
                                                </form>
                                                @endcan
                                            @else
                                            @can('write-units')
                                                <a class="btn btn-sm btn-primary"
                                                href="{{ route('units.edit', ['property' => request()->property, 'unit' => $item->id]) }}">Edit
                                                    </a>
                                                    @endcan
                                                    @can('read-units')
                                                    <a class="btn btn-sm btn-primary ml-2"
                                                        href="{{ route('units.show', ['property' => request()->property, 'unit' => $item->id]) }}">View
                                                    </a>
                                                    @endcan
                                                    @can('delete-units')
                                                <form action="{{ route('units.destroy', ['property' => request()->property, 'unit' => $item->id]) }}"
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
                title: 'Are you sure?',
                icon: 'warning',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $(`#deletePermanentForm-${id}`).submit();
                } else if (result.isDenied) {}
            })
        })
    </script>

@endsection
