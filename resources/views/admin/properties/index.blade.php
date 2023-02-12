@extends('admin.layouts.app')

@section('page_title', 'Categories')

@section('page_styles')

@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Properties</h4>
                </div>
                <div>
                    <a href="{{ route('properties.index', ['type' => 'archived']) }}"
                        class="btn btn-danger btn-sm">Archived ({{$archived}})</a>
                    <a href="{{ route('properties.create') }}" class="btn btn-primary btn-sm">Create Property</a>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable-1" class="table data-table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Location</th>
                                <th>PMA Contract Start Date</th>
                                <th>PMA Contract End Date</th>
                                <th>AED Value</th>
                                <th>Sqft Size</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->location }}</td>
                                    <td>{{ $item->start_date_format }}</td>
                                    <td>{{ $item->end_date_format }}</td>
                                    <td>{{ $item->aed_value }}</td>
                                    <td>{{ $item->sqft_size }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('properties.edit', ['property' => $item->id]) }}">Edit
                                            </a>
                                            <a class="btn btn-sm btn-primary ml-2"
                                                href="{{ route('properties.show', ['property' => $item->id]) }}">View
                                            </a>
                                            @if (request()->type == 'archived')
                                                <form
                                                    action="{{ route('properties.unarchive', ['id' => $item->id]) }}"
                                                    method="POST">

                                                    @csrf
                                                    <button class="btn btn-sm  btn-danger  ml-2" type="submit">Unarchive</button>
                                                </form>
                                            @else
                                                <form action="{{ route('properties.destroy', ['property' => $item->id]) }}"
                                                    method="POST" id="deleteForm-{{ $item->id }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-sm  btn-danger delete ml-2"
                                                        data-id="{{ $item->id }}">Archive</button>
                                                </form>
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
        $('.delete').click(function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id')
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'yes',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $(`#deleteForm-${id}`).submit();
                } else if (result.isDenied) {}
            })
        })
    </script>

@endsection
