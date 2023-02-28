@extends('layouts.app')

@section('page_title', 'Client Tickets')

@section('page_styles')

@endsection

@section('content')
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-body">
                  <h6 class="mb-3">{{$item->title}}</h6>
                  <div class="d-flex align-items-center mb-2" style="column-gap:1rem">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                      </svg>
                      {{$item->created_at}}
                      </span>
                    <span class="badge {{$item->status == 'open' ? 'badge-primary' : 'badge-success'}}">
                        {{$item->status}}
                    </span>
                  </div>
                  <p>{{$item->description}}</p>
                  @if ($item->image != null)
                  <img class="img-fluid" src="{{$item->image}}">
                  @endif
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        @if ($item->reply != null)
        <div class="card">
            <div class="card-body">
                <p class="mb-2">Staff Reply</p>
                  <div class="mb-2">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                      </svg>
                      {{$item->updated_at}}
                      </span>
                  </div>
                  <p class="mt-2 mb-2">
                    {{$item->reply}}
                  </p>
            </div>
        </div>
        @endif
    </div>
@endsection

@section('page_scripts')

@endsection
