@extends('layouts.app')
@section('title', $title)
@push('scripts')
    <style>
        .userinfotable .table {
            border: none;
        }

        .userinfotable tbody,
        .userinfotable td,
        .userinfotable tfoot,
        .userinfotable th,
        .userinfotable thead,
        .userinfotable tr,
        .userinfotable> :not(:last-child)> :last-child>* {
            border-color: transparent !important;
        }


        .userinfotable .table td,
        .userinfotable .table th {
            border: none;
        }

        #order_product {
            width: 50px;
            border-radius: 50%;
        }
    </style>
@endpush
@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card px-3 py-3">
                <div class="bg-white border-bottom-0 pb-4 d-flex justify-content-between align-items-center flex-row">
                    <h2 class="backend-title">{{ $title }}</h2>
                </div>
                <div class="table-responsive">
                    <h4 class="backend-title">{{ __f('User Informations Title') }}</h4>
                    <table class="table userinfotable">
                        <tbody>
                            <tr>
                                <td width="80%"><b>{{ __f('User Name Title') }}: </b> {{ $orderinfo ? $orderinfo->user->fname : '--' }}
                                    {{ $orderinfo ? $orderinfo->user->lname : '--' }}</td>
                                <td width="30%"><b>{{ __f('Invoice No Title') }} : </b> #{{ $orderinfo->invoice_id }}</td>
                            </tr>
                            <tr>
                                {{-- <td width="80%"><b>User Email : </b>{{ $orderinfo ? $orderinfo->user->email : '--' }}
                                </td> --}}
                                <td width="80%"><b>{{ __f('Phone Title') }} : </b>{{ $orderinfo ? $orderinfo->user->phone : '--' }}
                                </td>
                                <td width="20%"><b>{{ __f('Quantity Title') }} : </b>{{ convertToLocaleNumber($orderinfo->quantity ?? 0) }}</td>
                            </tr>
                            <tr>
                                <td width="80%"><b>{{ __f('Status Title') }} : </b>{!! orderStatus($orderinfo->status) !!}</td>
                                <td width="20%"><b>{{ __f('Charge Title') }}  : </b>{{ $orderinfo->charge ?? '' }}</td>
                            </tr>
                            <tr>
                                <td width="80%"><b>{{ __f('Address Title') }}  : </b>{{ $orderinfo ? $orderinfo->adress : '--' }} </td>
                                <td width="20%"><b>{{ __f('Amount Title') }} : </b>{{ convertToLocaleNumber($orderinfo->amount) }}</td>
                            </tr>
                            {{--<tr>
                                 <td width="80%"><b> Payment Type :
                                    </b>{{ $orderinfo ? $orderinfo->payment_status : '--' }} </td>
                                <td width="20%"><b>Status : </b>{!! orderStatus($orderinfo->status) !!}</td>
                            </tr>--}}
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive mt-3">
                    <h4 class="backend-title">{{ __f('Orders Informations Title') }}</h4>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ __f('SL Title') }}</th>
                                <th>{{ __f('Product Name Title') }}</th>
                                <th>{{ __f('Product Image Title') }} </th>
                                <th>{{ __f('Product Price Title') }}</th>
                                <th>{{ __f('Product Quntity Title') }}</th>
                                <th>{{ __f('Total Title') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($orderinfo->totalearnings) > 0)
                                @php
                                    $totalAmount = 0;
                                @endphp
                                @forelse ($orderinfo->totalearnings as $key => $product)
                                    @php
                                        $totalAmount += $product->grandtotal;
                                    @endphp
                                    <tr>
                                        <td>{{ convertToLocaleNumber($key + 1) }}</td>
                                        <td>{{ $product->product_name ?? '---' }}</td>
                                        <td>
                                            @if($product->product_image != null)
                                            <img id="order_product" src="{{ asset($product->product_image) }}"
                                                alt="product image">
                                            @else
                                            <img id="order_product" src="{{ asset('frontend/assets/images/category/default-image.webp') }}"
                                                alt="product image">
                                            @endif
                                        </td>
                                        <td> {{ convertToLocaleNumber($product->amount ?? 0) }} {{ config('settings.currency') ?? '৳' }}</td>
                                        <td>{{ convertToLocaleNumber($product->quantity ?? 0) }}</td>
                                        <td> {{ convertToLocaleNumber($product->grandtotal ?? 0) }} {{ config('settings.currency') ?? '৳' }}</td>
                                    </tr>
                                @empty
                                @endforelse
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ __f('Charge Title') }} : </td>
                                    <td> {{ convertToLocaleNumber($orderinfo->charge ?? 0) }} {{ config('settings.currency') ?? '৳' }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ __f('Discount Title') }} : </td>
                                    <td> {{ convertToLocaleNumber($orderinfo->discount ?? 0) }} {{ config('settings.currency') ?? '৳' }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ __f('Grand Total Amount Title') }} : </td>
                                    <td> {{ convertToLocaleNumber(($totalAmount + $orderinfo->charge) - $orderinfo->discount  ?? 0) }} {{ config('settings.currency') ?? '৳' }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
