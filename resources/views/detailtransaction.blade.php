@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Detail Transaction') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <table>
                            <tr>
                                <td class="col-md-6">Date</td>
                                <td>: {{ $trx->created_at }}</td>
                            </tr> 
                            <tr>
                                <td class="col-md-6">Served By</td>
                                <td>: {{ $trx->user->name }}</td>
                            </tr>
                        </table>

                        <table class="table table-responsive table-striped">
                            <thead>
                                <td>#</td>
                                <td>Item name</td>
                                <td>qty</td>
                                <td>price</td>
                                <td>subtotal</td>
                            </thead>
                            @foreach ($trx->transactiondetail as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->item->name }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->item->price }}</td>
                                    <td>{{ $item->item->price * $item->qty }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="text-end" colspan="4">Grand total =</td>
                                <td>{{ $trx->total }}</td>
                            </tr>
                            <tr>
                                <td class="text-end" colspan="4">Pay total =</td>
                                <td>{{ $trx->pay_total }}</td>
                            </tr>
                            <tr>
                                <td class="text-end" colspan="4">change =</td>
                                <td>{{ $trx->pay_total - $trx->total }}</td>
                            </tr>
                        </table>
                        <div class="d-flex flex-row-reverse">
                            <a href="{{ route('transaction.history') }}" class="btn btn-sm btn-success">history</a>
                            <a href="{{ route('transaction.index') }}" class="btn btn-sm btn-danger mx-2">kembali</a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
