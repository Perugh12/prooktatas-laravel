@extends('layout.app')

@section('content')
<div class="order-end-wrapper">
    <div class="row mt-3">
        <div class="col-12">
            <h5>Köszönjük rendelését!</h5>
        </div>
        <div class="col-12">
            <div class="row">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Rendelés száma: </td>
                            <td>#{{ $order->id }}</td>
                        </tr>
                    </tbody>

                </table>
                <p>A rendelését rögzítettük. A megadott e-mail címre elküldtük a rendelés visszaigazolását.</p>
            </div>
            <div class="col-12">
                <a href="{{ route('product.list', ['osszes-termek']) }}" class="btn btn-primary float-end">Vissza a termékekhez</a>
            </div>
        </div>
    </div>
</div>

@endsection