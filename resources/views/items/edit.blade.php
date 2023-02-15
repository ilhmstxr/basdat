@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-4 ">
                <div class="card">
                    <div class="card-header">{{ __('Edit Item') }}</div>

                    <div class="card-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-success" role="alert">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" enctype="multipart/form-data" action="{{ route('items.update',$item->id) }}">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="">Item Category</label>
                                <select name="category_id" class="form-control" id="">
                                    @foreach ($category as $c)
                                        <option value="{{ $c->id }}" @if($c->id == $item->category->id) selected @endif>{{ $c->nama }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="">Item Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $item->name }}">
                            </div>

                            <div class="form-group">
                                <label for="">Image</label>
                                <input type="file" class="form-control" name="img" id="img" value="{{ $item->img }}">
                            </div>

                            <div class="form-group">
                                <label for="">Description</label>
                                <input type="text" class="form-control" name="deskripsi" value="{{ $item->deskripsi }}">
                            </div>

                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="number" class="form-control" name="price" value="{{ $item->price }}">
                            </div>

                            <div class="form-group">
                                <label for="">Stock</label>
                                <input type="number" class="form-control" name="stock" value="{{ $item->stock }}">
                            </div>

                            <div class="form-group mt-2">
                                <button class="btn btn-sm btn-success">Simpan</button>
                                <a href="{{ route('items.index') }}" class="btn btn-sm btn-danger">batal</a>
                            </div>
                        </form>
                        {{-- {{ __('You are logged in!') }} --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
