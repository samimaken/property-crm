@extends('layouts.app')

@section('page_title', 'Client Tickets')

@section('page_styles')

@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between flex-wrap">
                <div class="header-title mb-2">
                    <h4 class="card-title">Tickets</h4>
                </div>
                <div>
                    <a href="{{ route('client-tickets.create') }}" class="btn btn-primary btn-sm mb-2">Create Ticket</a>
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
                                <th>Status</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{ $item->ticket_number }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a class="btn btn-sm btn-primary ml-2"
                                                href="{{ route('client-tickets.show', ['client_ticket' => $item->id]) }}">View
                                            </a>
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

@endsection
