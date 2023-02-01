@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Category') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-responsive">
                            <thead>
                                <td>#</td>
                                <td>name</td>
                                <td>action</td>
                            </thead>
                            @foreach ($categories as $c)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $c->nama }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('category.destroy', $c->id) }}">
                                            @csrf
                                            @method('delete')
                                            <a href="{{ route('category.edit', $c->id) }}"
                                                class="btn btn-sm btn-warning">edit</a>
                                            <button type="submit" class="btn btn-sm btn-danger">delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{-- {{ __('You are logged in!') }} --}}
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Add Category') }}</div>

                    <div class="card-body">
                        
                        @if (count($errors) > 0)
                            <div class="alert alert-success" role="alert">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                        <form method="POST" action="{{ route('category.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="nama">Name</label>
                                <input type="text" class="form-control mb-2" id="nama" name="nama">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-sm btn-success">Tambah</button>
                                {{-- <input type="reset" value="Batal" class="btn btn-sm btn-danger"> --}}
                            </div>
                        </form>

                        {{-- {{ __('You are logged in!') }} --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
