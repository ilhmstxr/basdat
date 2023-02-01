@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

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
                            <tr>
                                <td>1</td>
                                <td>10-01-2023</td>
                                <td>15000</td>
                                <td>15000</td>
                                <td>udin</td>
                                <td>
                                    <button class="btn btn-sm btn-success">Detail</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>10-01-2023</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>udin</td>
                                <td>
                                    <button class="btn btn-sm btn-success">Detail</button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                        {{-- {{ __('You are logged in!') }} --}}
                    </div>
                </div>
            </div>


     
        </div>
    </div>
    
@endsection
