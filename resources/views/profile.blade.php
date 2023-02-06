@extends('layouts.app')
@section('content')
    @foreach ($user as $u)
        <h1>
            {{ $u}}
        </h1>
    @endforeach
@endsection
