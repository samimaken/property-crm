@extends('admin.layouts.app')

@section('page_title', 'Client Tickets')

@section('page_styles')
<style>
    .preserveLines {
    white-space: pre-wrap;
    line-height: inherit !important;
}
</style>
@endsection

@section('content')
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-3">{{ $item->title }}</h6>
                <div class="d-flex align-items-center mb-2" style="column-gap:1rem">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24"
                            strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                            <path strokeLinecap="round" strokeLinejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                        </svg>
                        {{ $item->created_at }}
                    </span>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                          </svg>
                        {{$item->user->name}}
                    </span>
                    <span class="badge {{ $item->status == 'open' ? 'badge-primary' : 'badge-success' }}">
                        {{ $item->status }}
                    </span>
                </div>
                <p class="preserveLines">{!! $item->description !!}</p>
                @if ($item->image != null)
                    <img class="img-fluid" src="{{ $item->image }}">
                @endif
            </div>
        </div>
    </div>
    @if ($item->reply != null)
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <p class="mb-2">Staff Reply</p>
                    <div class="mb-2 d-flex align-items-center mb-2" style="column-gap:1rem">
                        <span><svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24"
                                strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                                <path strokeLinecap="round" strokeLinejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                            </svg>
                            {{ $item->updated_at }}
                        </span>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                              </svg>
                            {{$item->admin->name}}
                        </span>
                    </div>
                    <div class="mt-2 mb-2 preserveLines">{!! $item->reply !!}</div>
                </div>
            </div>
        </div>
    @endif
    @if ($item->reply == null)
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('tickets.update', ['ticket' => $item->id]) }}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label for="reply">Reply</label>
                                    <textarea class="form-control preserveLines" rows="5" name="reply">{{ isset($item->reply) ? $item->reply : old('reply') }}</textarea>
                                    @error('reply')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('page_scripts')

@endsection
