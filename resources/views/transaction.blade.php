@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {{-- <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Transaction') }}</div>

                    <div class="card-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-success" role="alert">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
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
                            @if ($item->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center">All item is empty</td>
                                </tr>
                            @endif
                            

                            @foreach ($item as $i)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $i->category->nama }}</td>
                                    <td>{{ $i->name }}</td>
                                    <td>Rp {{ number_format($i->price) }}</td>
                                    <td>{{ $i->stock }}</td>
                                    <td>
                                        <form action="{{ route('transaction.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $i->id }}" name="item_id">
                                            <input type="hidden" class="form-control" name="qty" value="1">
                                            <button type="submit" class="btn btn-sm btn-success">Add to cart</button>
                                        </form>
                                    <td>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div> --}}

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Barang') }}</div>

                    <div class="card-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-success" role="alert">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif


                        <div class="row">
                            @foreach ($item as $i)
                                <div class="card mx-3" style="width: 13rem;">
                                    <img src="{{ asset('img/e.png') }}" class="card-img-top py-3" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $i->name }}</h5>
                                        <p class="card-text">Mie goreng sederhana yang lezat dan nikmat bagi semua kalangan
                                        </p>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">{{ $i->category->nama }}</li>
                                        <li class="list-group-item">stok : {{ $i->stock }}</li>
                                        <li class="list-group-item">{{ $i->price }}</li>
                                    </ul>
                                    <form action="{{ route('transaction.store') }}" method="post">
                                        @csrf
                                        <div class="card-body">
                                            <input type="hidden" value="{{ $i->id }}" name="item_id">
                                            <input type="hidden" class="form-control" name="qty" value="1">
                                            <button class="btn btn-sm btn-primary">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                        </div>

                        @if ($item->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">item kosong</td>
                            </tr>
                        @endif
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Keranjang') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-striped table-responsive">
                            <thead>
                                <td>#</td>
                                <td>name</td>
                                <td class="col-md-3">qty</td>
                                <td>subtotal</td>
                                <td>action</td>
                            </thead>

                            @if ($cart->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center">keranjang kosong</td>
                                </tr>
                            @else
                                @foreach ($cart as $c)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $c->name }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('transaction.update', $c->cart->id) }}">
                                                @csrf
                                                @method('put')
                                                <input type="number" class="form-control" name="qty" min="1"
                                                    max="{{ $c->stock + $c->cart->qty }}"
                                                    onchange="update{{ $loop->iteration }}()" value="{{ $c->cart->qty }}">
                                        </td>
                                        <td>{{ $c->price * $c->cart->qty }}</td>
                                        <td>
                                            <input type="submit" class="btn btn-sm btn-primary"
                                                id="ubah{{ $loop->iteration }}" style="display: none" value="update">
                                            </form>
                                            <form method="POST" action="{{ route('transaction.destroy', $c->cart->id) }}">
                                                @csrf
                                                @method('delete')
                                                <input type="submit" class="btn btn-sm btn-danger"
                                                    id="hapus{{ $loop->iteration }}" style="display: " value="hapus">
                                            </form>

                                            <script>
                                                function update{{ $loop->iteration }}() {
                                                    document.getElementById("ubah{{ $loop->iteration }}").style.display = "inline";
                                                    document.getElementById("hapus{{ $loop->iteration }}").style.display = "none";
                                                }
                                            </script>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif




                            <form action="{{ route('transaction.checkout') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <tr>
                                    <td colspan="2">Total</td>
                                    <td colspan="3"><input type="number" class="form-control"
                                            value="{{ $cart->sum(function ($item) {
                                                return $item->price * $item->cart->qty;
                                            }) }}"
                                            readonly name="total"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Payment</td>
                                    <td colspan="3"><input type="number" class="form-control" name="pay_total"
                                            min="{{ $cart->sum(function ($item) {return $item->price * $item->cart->qty;}) }}"
                                            required></td>
                                </tr>
                        </table>
                        <button class="btn btn-primary text-light">save</button>
                        <input type="reset" class="btn btn-danger text-light" value="cancel">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
