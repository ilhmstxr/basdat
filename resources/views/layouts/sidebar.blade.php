{{-- <div class="col-md-4 ">
    <div class="card">
        <div class="card-header">{{ __('Add Item') }}</div>

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
                                <form method="POST" action="{{ route('transaction.update',$c->cart->id) }}">
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
                                <form method="POST" action="{{ route('transaction.destroy', $c->cart->id )}}">
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
                        <td colspan="3"><input type="number" class="form-control" value="{{ $cart->sum(function($item){return $item->price * $item->cart->qty;}) }}" readonly 
                                name="total" ></td>
                    </tr>
                    <tr>
                        <td colspan="2">Payment</td>
                        <td colspan="3"><input type="number" class="form-control" name="pay_total" min="{{ $cart->sum(function($item){return $item->price * $item->cart->qty;}) }}" required
                                ></td>
                    </tr>
            </table>
            <button class="btn btn-primary text-light">save</button>
            <input type="reset" class="btn btn-danger text-light" value="cancel">
            </form>
        </div>
    </div>
</div> --}}