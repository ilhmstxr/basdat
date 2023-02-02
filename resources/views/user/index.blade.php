@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

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


            <div class="col-md-4 ">
                <div class="card">
                    <div class="card-header">{{ __('Add Kupon') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <form action="{{ route('kupon.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="">Stok Kupon</label>
                                <input type="number" class="form-control" placeholder="Masukkan stok" name="stok">
                            </div>
                            
                            <div class="form-group">
                                <label for="">Harga ketentuan</label>
                                <input type="number" class="form-control" placeholder="Masukkan Harga ketentuan" name="harga_ketentuan">
                            </div>
                            
                            <div class="form-group">
                                <label for="">Diskon</label>
                                <input type="number" class="form-control" placeholder="Masukkan diskon" name="diskon">
                            </div>
                            

                            <div class="form-group mt-2">
                                
                                <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                                <input type="reset" value="Batal" class="btn btn-sm btn-danger">                                
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection