@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-warning text-center">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <table class="table table-responsive table-striped">
                            <thead>
                                <td>#</td>
                                <td>Date</td>
                                <td>Total</td>
                                <td>Pay total</td>
                                <td>Served By</td>
                                <td>action</td>
                            </thead>
                            @foreach ($t as $trx)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $trx->created_at }}</td>
                                    <td>{{ $trx->total }}</td>
                                    <td>{{ $trx->pay_total }}</td>
                                    <td>{{ $trx->userkupon->user->name}}</td>
                                    <td>

                                        <a href="{{ route('transaction.show',$trx->id) }}"
                                            class="btn btn-sm btn-success">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{-- {{ __('You are logged in!') }} --}}
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
