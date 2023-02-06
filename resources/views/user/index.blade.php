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
                                <td>User</td>
                                <td>Kupon</td>
                                <td>Jumlah Kupon</td>
                            </thead>
                            @foreach ($userK as $uk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $uk->user->name }}</td>
                                <td>{{ $uk->kupon->diskon}}</td>
                                <td>{{ $uk->quantity_kupon}}</td>
                                {{-- <td>Makanan</td> --}}  
                                <td>
                                <a href="{{ route('kupon.edit' , $uk -> id ) }}" class="btn btn-sm btn-warning">Edit</a>
                                <a href="{{ route('kupon.destroy' , $uk -> id ) }}" class="btn btn-sm btn-danger">Delete</a>
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