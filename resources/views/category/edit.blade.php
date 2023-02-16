@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-warning">{{ __('Edit Category') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <form method="post" action="{{ route('category.update',$c->id) }}">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="nama" class="form-control mb-2" value="{{ $c->nama }}">
                            </div>
                            <hr>
                            <div class="form-group">
                                <button class="btn btn-sm btn-success">Simpan</button>
                                <a href="{{ route('category.index') }}" class="btn btn-sm btn-danger">batal</a>
                            </div>
                        </form>
                        {{-- {{ __('You are logged in!') }} --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
