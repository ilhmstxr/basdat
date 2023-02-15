@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Item') }}</div>

                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <table class="table table-responsive table-striped">
                            <thead>
                                <td>#</td>
                                <td>Category</td>
                                <td>name</td>
                                <td>price</td>
                                <td>stock</td>
                                <td>action</td>
                            </thead>
                            @foreach ($item as $i)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $i->category->nama }}</td>
                                    <td>{{ $i->name }}</td>
                                    <td>Rp {{ number_format($i->price) }}</td>
                                    <td>{{ $i->stock }}</td>
                                    {{-- <td>makanan</td> --}}
                                    <td>
                                        <form method="POST" action="{{ route('items.destroy', $i->id) }}">
                                            @csrf
                                            @method('delete')
                                            <a href="{{ route('items.edit', $i->id) }}"
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


            <div class="col-md-4 ">
                <div class="card">
                    <div class="card-header">{{ __('Add Item') }}</div>

                    <div class="card-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-success" role="alert">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif


                        <form method="POST" action="{{ route('items.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="">Item Category</label>
                                <select class="form-control form-select" id="category_id" name="category_id">
                                    @foreach ($category as $c)
                                        <option value="{{ $c->id }}">{{ $c->nama }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="name">Item Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>

                            <div class="form-group">
                                <label for="img">Image</label>
                                <input type="file" class="form-control" name="img" id="img" value="{{ old('img') }}">
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Description</label>
                                <input type="text" class="form-control" name="deskripsi" id="deskripsi">
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price" name="price">
                            </div>

                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock">
                            </div>


                            <div class="form-group mt-2">
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
