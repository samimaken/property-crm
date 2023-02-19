@extends('layouts.app')

@section('contet')
<div class="col-12">
    @if ($new == 0)
    <div class="alert alert-success">You are welcome to our platform</div>
    @endif
</div>
@endsection
