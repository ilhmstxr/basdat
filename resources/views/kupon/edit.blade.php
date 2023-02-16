@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-4 ">
                <div class="card">
                    <div class="card-header bg-warning">{{ __('Edit Kupon') }}</div>

                    <div class="card-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-success" role="alert">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('kupon.update',$kupon->id) }}">
                            @csrf
                            @method('put')


                            <div class="form-group">
                                <label for="">Stok</label>
                                <input type="number" class="form-control" name="stok" value="{{ $kupon->stok }}">
                            </div>

                            <div class="form-group">
                                <label for="">Harga Ketentuan</label>
                                <input type="number" class="form-control" name="harga_ketentuan" value="{{ $kupon->harga_ketentuan }}">
                            </div>

                            <div class="form-group">
                                <label for="">Diskon</label>
                                <input type="number" class="form-control" name="diskon" value="{{ $kupon->diskon }}">
                            </div>

                            <hr>


                            <div class="form-group mt-2">
                                <button class="btn btn-sm btn-success">Simpan</button>
                                <a href="{{ route('kupon.index') }}" class="btn btn-sm btn-danger">batal</a>
                            </div>
                        </form>
                        {{-- {{ __('You are logged in!') }} --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

