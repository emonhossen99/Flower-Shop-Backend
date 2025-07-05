<!DOCTYPE html>

<html>

<head>

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
        }

        #maindivs {
            margin-bottom : 30px !important;
        }
        .maindiv {
            border: 1px solid black;
            margin: 10px;
        }

        p {
            margin-top: 2px !important;
            margin-bottom: 2px !important;
        }
    </style>

</head>

<body>
    @php
        use SimpleSoftwareIO\QrCode\Facades\QrCode;
        use Milon\Barcode\DNS1D;
        $dns1d = new DNS1D();
    @endphp
    @forelse ($getorders as $order)
        @if($order->status == '3')
            <div id="maindivs">
                <div class="maindiv">
                    <div class="orderlastdivs" style="border-bottom:1px solid black;">
                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 50%; padding: 10px;">
                                    <div class="orderlastdivFirst">
                                        <p class="firstp">{{ __f('Shipping To Title') }} : {{ $order->customer ?? '' }}</p>
                                        <p>{{ __f('Phone Number Title') }} : {{ $order->phone ?? '' }}</p>
                                        <p>{{ __f('Address Title') }} : {{ $order->adress ?? '' }}</p>
                                    </div>
                                </td>
                                @php
                                    $qrCodes = null;
                                    $barcode = null;

                                    if (!empty($order->couriertrakingid)) {
                                        try {
                                            $qrCodes = base64_encode(
                                                QrCode::format('svg')
                                                    ->size(100)
                                                    ->errorCorrection('H')
                                                    ->generate($order->couriertrakingid),
                                            );
                                        } catch (\Exception $e) {
                                            $qrCodes = null; 
                                        }

                                        try {
                                            $barcode = $dns1d->getBarcodePNG($order->couriertrakingid,'C39' );
                                        } catch (\Exception $e) {
                                            $barcode = null;
                                        }
                                    }
                                @endphp
                                <td style="width: 50%;padding: 10px; text-align:right;">
                                    @if ($qrCodes)
                                        <img style="width: 70px;" src="data:image/svg+xml;base64,{{ $qrCodes }}"
                                            alt="QR Code">
                                    @else
                                        <p>{{ __f('No QR Code available Title') }}</p> 
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="orderlastdivs">
                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 50%; border-right:1px solid black;padding: 10px;">
                                    <div class="orderlastdivFirst">
                                        <p class="firstp">{{ __f('Weight Title') }} : {{ $order->weight ?? '' }}</p>
                                        <p>{{ __f('Invoice Id Title') }} : {{ $order->invoice_id ?? '' }}</p>
                                        <p>{{ __f('Charge Title') }} : {{ $order->charge ?? '' }}</p>
                                        <p>{{ __f('Amount Title') }} : {{ $order->amount + $order->charge ?? 0.0 }}</p>
                                    </div>
                                </td>
                                <td style="width: 50%;padding: 10px;">
                                    @if ($barcode)
                                        <p class="firstp"><img style="width: 300px;"
                                                src="data:image/png;base64,{{ $barcode }}" alt="Barcode"></p>
                                    @else
                                        <p>{{ __f('No Barcode available Title') }}</p> 
                                    @endif
                                    <p>{{ $order->couriertrakingid ?? '' }}</p>
                                    <p>{{ __f('Order Date Title') }} : {{ $order->created_at->format('d-m-Y h:i:s A') }}</p>
                                    <p>{{ __f('Courier Type Title') }} : {{ $order->couriertype ?? '' }}</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    @empty
        <p>{{ __f('No orders found Title') }}</p>
    @endforelse
</body>
</html>
