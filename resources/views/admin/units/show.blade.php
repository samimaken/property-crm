@extends('admin.layouts.app')

@section('page_title', 'Categories')

@section('page_styles')

@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">View Property Unit - {{ $item->property->name }}</h4>
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
                            <span><strong>Type: </strong> {{ $item->type == 'private-unit' ? 'Private Unit' : 'Co-Working Space' }}</span>
                        </div>
                        <div class="mt-2  mb-2">
                            <span><strong>Unit ID: </strong> {{ $item->unit_id }}</span>
                        </div>
                        <div class="mt-2  mb-2">
                            <span><strong>Tawtheeq ID: </strong> {{ $item->tawtheeq_id }}</span>
                        </div>
                        <div class="mt-2  mb-2">
                            <span><strong>Sqft Size: </strong> {{ $item->sqft_size }}</span>
                        </div>
                        <div class="mt-2  mb-2">
                            <p>Furnished: <span
                                    class="badge {{ $item->furnished == 1 ? 'badge-success' : 'badge-danger' }}">{{ $item->furnished == 1 ? 'Yes' : 'No' }}</span>
                            </p>

                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mt-5  mb-2">
                            <span><strong>Unit Price 1 Payments AED: </strong> {{ $item->unit_price_1 }}</span>
                        </div>
                        <div class="mt-2  mb-2">
                            <span><strong>Unit Price 2 Payments AED: </strong> {{ $item->unit_price_2 }}</span>
                        </div>
                        <div class="mt-2  mb-2">
                            <span><strong>Unit Price Monthly AED: </strong> {{ $item->unit_price_monthly }}</span>
                        </div>
                        <div class="mt-2  mb-2">
                            <span><strong>Deposit Amount AED: </strong> {{ $item->deposit_amount }}</span>
                        </div>
                        <div class="mt-2  mb-2">
                            <span><strong>Desks Allocated: </strong> {{ $item->desks_allocated }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-2 mt-4">
                        <p class="m-0">Unit Images</p>
                    </div>
                    @if ($item->image1 != null)
                        <div class="col-md-3 col-12 mb-2">
                            <img class="img-fluid rounded" src="{{ $item->image1 }}">
                        </div>
                    @endif
                    @if ($item->image2 != null)
                        <div class="col-md-3 col-12 mb-2">
                            <img class="img-fluid rounded" src="{{ $item->image2 }}">
                        </div>
                    @endif
                    @if ($item->image3 != null)
                        <div class="col-md-3 col-12 mb-2">
                            <img class="img-fluid rounded" src="{{ $item->image3 }}">
                        </div>
                    @endif
                    @if ($item->image4 != null)
                        <div class="col-md-3 col-12 mb-2">
                            <img class="img-fluid rounded" src="{{ $item->image4 }}">
                        </div>
                    @endif
                    <div class="col-12 text-right">
                        <a class="btn btn-sm btn-outline-primary" href="{{route('units.index', ['property' => request()->property])}}">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_scripts')
@endsection
