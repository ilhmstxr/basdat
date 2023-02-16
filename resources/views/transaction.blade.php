@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

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
                                    <img src="{{ asset('/template/img/'.$i->img) }}"   class="card-img-top py-3" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $i->name }}</h5>
                                        <p class="card-text">{{$i->deskripsi}}
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
                                {{-- <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"> --}}
                                <input type="hidden" name="userkupon_id" value="{{ Auth::user()->id }}">
                                <tr>
                                    <td colspan="2">kupon anda </td>

                                    @if ($uk == 0)
                                        <td>
                                            <input type="number" class="form-control" value="0" readonly>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="form-check-input" id="pakai" disabled onchange="pakaikupon({{$k->diskon}})">
                                        </td>
                                    @else
                                        <td>
                                            <input type="number" id="jk" class="form-control"
                                                value="{{ $kupon->quantity_kupon }}" readonly>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="form-check-input" id="pakai" onchange="pakaikupon({{$k->diskon}})"> Pakai
                                        </td>
                                    @endif

                                    <td>
                                        <p id="text" style="display:none">Checkbox is CHECKED!</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Total</td>
                                    <td colspan="3"><input type="number" class="form-control" id="total"
                                            value="{{ $cart->sum(function ($item) {
                                                return $item->price * $item->cart->qty;
                                            }) }}"
                                            readonly name="total">
                                    <td colspan="3">
                                        <input type="hidden" class="form-control" id="ha"
                                            value="{{ $cart->sum(function ($item) {
                                                return $item->price * $item->cart->qty;
                                            }) }}"
                                            readonly>
                                    </td>
                                </tr>
                                <input type="hidden" class="form-control" name="hasil" id="hasil">
                                <input type="hidden" class="form-control" name="disc" id="disc">
                                <tr>
                                    <td colspan="2">Payment</td>
                                    <td colspan="3"><input type="number" class="form-control" name="pay_total"
                                            min="" required>
                                    </td>
                                </tr>
                                <script>
                                    function pakaikupon(diskon) {
                                        let checkbox = document.getElementById("pakai");
                                        // let diskon = document.getElementById("diskon");
                                        let jk = document.getElementById("jk");
                                        let total = document.getElementById("total");
                                        let ha = document.getElementById("ha");
                                        if (checkbox.checked) {
                                            jk.value = parseInt(jk.value) - 1;
                                            total.value = (total.value * (1 - diskon));
                                            console.log(total.value);
                                            document.getElementById("hasil").value = total.value;
                                            document.getElementById("jk").value = jk.value;

                                        } else {
                                            jk.value = parseInt(jk.value) + 1;
                                            total.value = (ha.value);
                                        }

                                        // document.getElementById("hasil").setAttribute("min", total.value);

                                    }
                                </script>
                        </table>
                        <button class="btn btn-primary text-light">save</button>
                        <input type="reset" class="btn btn-danger text-light" value="cancel">
                        {{--                         
                        </table>
                        <button class="btn btn-primary text-light">save</button>
                        <input type="reset" class="btn btn-danger text-light" value="cancel">
                        </form>

                        <form action="{{ route('transaction.kupon') }}">
                            @csrf
                            <button class="btn btn-primary text-light">button nggo kupon</button>
                        </form> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
