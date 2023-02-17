@extends('admin.layouts.app')

@section('page_title', 'Client Management')

@section('page_styles')

@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">View Client</h4>
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
                            <span><strong>Company Name: </strong> {{ $item->company_name }}</span>
                        </div>
                        <div class="mt-2  mb-2">
                            <span><strong>Contact Name: </strong> {{ $item->contact_name }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mt-2  mb-2">
                            <span><strong>Mobile Number: </strong> {{ $item->mobile_number }}</span>
                        </div>
                        <div class="mt-2  mb-2">
                            <span><strong>WhatsApp Number: </strong> {{ $item->whatsapp_number }}</span>
                        </div>
                        <div class="mt-2  mb-2">
                            <span><strong>License Number: </strong> {{ $item->license_number }}</span>
                        </div>
                        <div class="mt-2  mb-2">
                            <span><strong>Address: </strong> {{ $item->address }}</span>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <h6 class="m-0 mb-2">Uploaded Documents</h6>
                        <div class="row">
                        @foreach ($item->docs as $key => $doc)
                            <div class="col-md-6 col-12">
                            <div class="d-flex align-items-center" style="column-gap: 1rem">
                                <p class="m-0">{{ $key + 1 }}) {{ $doc->title }}</p>
                                <p class="m-0">
                                    @if ($doc->file != null)
                                        <a href="{{ $doc->file }}" target="_blank"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="20" class="h-6 w-6"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2">
                                                </path>
                                            </svg></a>
                                    @endif
                                </p>
                                <p class="m-0">
                                      <form action="{{ route('client.doc.destroy', ['id' => $item->id, 'client' => request()->client]) }}"
                                        method="POST" id="deleteForm-{{ $item->id }}">
                                        @method('DELETE')
                                        @csrf
                                        <a href="javascript:void(0)" class="delete text-danger"
                                            data-id="{{ $item->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                              </svg>
                                        </a>
                                    </form>
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
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
