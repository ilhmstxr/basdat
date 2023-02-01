@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard User') }}</div>

                    <div class="card-body">
                        @if (count ($errors) > 0)
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>                                
                            
                            @endforeach
                        </div>
                        @endif

                        
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">                                
                                {{ session('status') }}
                            </div>
                        @endif


                        <table class="table table-responsive table-striped">
                            <thead>
                                <td>#</td>
                                <td>Stock</td>
                                <td>Harga ketentuan</td>
                                <td>Diskon</td>
                            </thead>
                            @foreach ($kupon as $k)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $k->stok }}</td>
                                <td>{{ $k->harga_ketentuan }}</td>
                                <td>{{ $k->diskon}}</td>
                                {{-- <td>Makanan</td> --}}  
                                <td>
                                <a href="{{ route('kupon.edit' , $k -> id ) }}" class="btn btn-sm btn-warning">Edit</a>
                                <a href="{{ route('kupon.destroy' , $k -> id ) }}" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach                            
                        </table>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection