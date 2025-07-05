@extends('layouts.app')
@section('title', $title)
@push('styles')
    <style>
        #order_product {
            width: 50px;
            border-radius: 50%;
        }

        .order-delete {
            background: red;
            border: none;
            color: white;
            padding: 5px 9px;
            border-radius: 3px;
        }
    </style>
@endpush
@php
    use Modules\Product\App\Models\ProductAttribute;
@endphp
@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card px-3 py-3">
                <div class="bg-white border-bottom-0 pb-4 d-flex justify-content-between align-items-center flex-row">
                    <h2 class="backend-title">{{ $title }}</h2>
                </div>
                <form id="orderUpdateFrom" action="{{ route('admin.single.order.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="order_id" id="order_id" value="{{ $orderinfo->id }}">
                    <div class="row">
                        <x-form.textbox labelName="{{ __f('Pick a Date label Title') }}" parantClass="col-12 col-md-4" name="pickdate"
                            placeholder="{{ __f('Pick a Date Placeholder') }}" errorName="pickdate" class="py-2" type="date"
                            value="{{ now()->format('Y-m-d') }}">
                        </x-form.textbox>

                        <x-form.textbox labelName="{{ __f('Reference Number label Title') }}" parantClass="col-12 col-md-4" name="reference"
                            placeholder="{{ __f('Reference Number Placeholder') }}" errorName="reference" class="py-2"
                            value="{{ old('reference') }}">
                        </x-form.textbox>

                        <x-form.selectbox parantClass="col-12 col-md-4" class="form-control py-2" name="status"
                            labelName="{{ __f('Status Title') }}" errorName="status" id="status">
                            <option value="1" {{ $orderinfo->status == '1' ? 'selected' : '' }}>{{ __f('Pending Title') }}</option>
                            <option value="2" {{ $orderinfo->status == '2' ? 'selected' : '' }}>{{ __f('Processing Title') }}</option>
                            <option value="3" {{ $orderinfo->status == '3' ? 'selected' : '' }}>{{ __f('On The Way Title') }}</option>
                            <option value="4" {{ $orderinfo->status == '4' ? 'selected' : '' }}>{{ __f('On Hold Title') }}</option>
                            <option value="5" {{ $orderinfo->status == '5' ? 'selected' : '' }}>{{ __f('Complate Title') }}</option>
                            <option value="6" {{ $orderinfo->status == '6' ? 'selected' : '' }}>{{ __f('Cancel Title') }}</option>
                        </x-form.selectbox>
                    </div>

                    <div class="row mt-4">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __f('Product Name Title') }}</th>
                                    <th>{{ __f('Product Image Title') }}</th>
                                    <th>{{ __f('Product Color Title') }}</th>
                                    <th>{{ __f('Product Size Title') }}</th>
                                    <th>{{ __f('Product Price Title') }}</th>
                                    <th>{{ __f('Product Quantity Title') }}</th>
                                    <th>{{ __f('SubTotal Title') }}</th>
                                    <th>{{ __f('Action Title') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @php
                                        $totalAmount = 0;
                                    @endphp
                                @if (count($orderinfo->totalearnings) > 0)
                                    @forelse ($orderinfo->totalearnings as $key => $product)
                                        @php
                                            $totalAmount += $product->grandtotal;
                                        @endphp
                                        <tr data-product-id="{{ $product->id }}">
                                            <td>{{ $product->product_name ?? '---' }}</td>
                                            <td>
                                                @if ($product->product_image != null)
                                                  <img id="order_product" src="{{ asset($product->product_image) }}"
                                                    alt="product image">  
                                                @else
                                                    <img id="order_product" src="{{ asset('frontend/assets/images/category/default-image.webp') }}"
                                                    alt="product image"> 
                                                @endif
                                                
                                            </td>
                                            @if ($product->varient != null)
                                                @php
                                                    $productvarient = ProductAttribute::with(['color','size'])->where('id', $product->varient)->first();
                                                @endphp
                                                <td>{{ $productvarient->color->attribute_option ?? '' }}</td>
                                                <td>{{ $productvarient->size->attribute_option  ?? '' }}</td>
                                            @else
                                                <td>{{ '--------' }}</td>
                                                <td>{{ '--------' }}</td>
                                            @endif

                                            <td>
                                                <input type="number" name="productprice[]" class="product-price"
                                                    data-id="{{ $product->id }}" value="{{ convertToLocaleNumber($product->amount) }}">
                                                    {{ config('settings.currency') ?? '৳' }}
                                            </td>
                                            <td>
                                                <input type="number" name="quantity[]" class="product-quantity"
                                                    data-id="{{ $product->id }}" value="{{ convertToLocaleNumber($product->quantity) }}">
                                            </td>
                                            <td>
                                                <span id="grandtotal-{{ $product->id }}"
                                                    class="grandtotal">{{ convertToLocaleNumber($product->grandtotal) }}</span>
                                                    {{ config('settings.currency') ?? '৳' }}
                                            </td>
                                            <td>
                                                <button type="button" class="order-delete align-items-center"
                                                    id="singleproductdelete" data-id="{{ $product->id }}">
                                                    <i class="fa-solid fa-trash text-white"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">{{ __f('No products found Title') }}</td>
                                        </tr>
                                    @endforelse
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-3">
                        <x-form.selectbox parantClass="col-12 col-md-4" class="form-control py-2" name="couriertype"
                            labelName="{{ __f('Select Courier Title') }}" errorName="couriertype" id="couriertype">
                            <option value="">{{ __f('Select Courier Title') }}</option>
                            <option value="Pathao" {{ $orderinfo->couriertype == 'Pathao' ? 'selected' : '' }}>{{ __f('Pathao Title') }}
                            </option>
                            <option value="Stead Fast" {{ $orderinfo->couriertype == 'Stead Fast' ? 'selected' : '' }}>
                                {{ __f('Stead Fast Title') }}</option>
                        </x-form.selectbox>

                        <x-form.textbox labelName="{{ __f('Customer Name Label Title') }}" parantClass="col-12 col-md-4" name="customername"
                            placeholder="{{ __f('Customer Name Placeholder') }}" errorName="customername" class="py-2"
                            value="{{ $orderinfo->customer ?? old('customername') }}">
                        </x-form.textbox>

                        <x-form.textbox labelName="{{ __f('Phone Number Label Title') }}" parantClass="col-12 col-md-4" name="customerphone"
                            placeholder="{{ __f('Phone Number Placeholder') }}" errorName="customerphone" class="py-2"
                            value="{{ $orderinfo->phone ?? old('customerphone') }}">
                        </x-form.textbox>
                    </div>
                    <div class="pathauCourierExtraFiled row mt-3">
                        @if ($orderinfo->couriertype == 'Pathao')
                            <div class="col-md-4">
                                <label for="selectcity" class="required">{{ __f('Select City Label Title') }}</label>
                                <select id="selectcity" name="selectcity" class="form-select">
                                    <option value="">{{ __f('Select City Label Title') }}</option>
                                    @forelse ($cityLists['data']['data'] as $city)
                                        <option value="{{ $city['city_id'] }}"
                                            {{ (int) $city['city_id'] === (int) $orderinfo->cityid ? 'selected' : '' }}>
                                            {{ $city['city_name'] }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <span class="text-danger error-text selectcity-error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="selectzone" class="required">{{ __f('Select Zone Label Title') }}</label>
                                <select id="selectzone" name="selectzone" class="form-select">
                                    @isset($zoneLists['data']['data'])
                                        @forelse ($zoneLists['data']['data'] as $zone)
                                            <option value="{{ $zone['zone_id'] }}"
                                                {{ (int) $zone['zone_id'] === (int) $orderinfo->zoneid ? 'selected' : '' }}>
                                                {{ $zone['zone_name'] }}</option>
                                        @empty
                                        @endforelse
                                    @endisset
                                </select>
                                <span class="text-danger error-text selectzone-error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="weight" class="required">{{ __f('Net Weight Label Title') }}</label>
                                <input type="number" name="weight" placeholder="{{ __f('Net Weight Placeholder') }}"
                                    class="form-control py-2" value="{{ convertToLocaleNumber(0.5) }}">
                            </div>
                        @endif
                    </div>
                    <div class="row mt-3">
                        <x-form.textarea labelName="{{ __f('Customer Address Label Title') }}" parantClass="col-12 col-md-6" name="address"
                            placeholder="{{ __f('Customer Address Placeholder') }}" errorName="address" class="py-2"
                            value="{{ $orderinfo->adress ?? old('address') }}">
                        </x-form.textarea>

                        <x-form.textbox labelName="{{ __f('Customer Traking Id Label Title') }}" parantClass="col-12 col-md-6" name="trakingid"
                            placeholder="{{ __f('Customer Traking Id Placeholder') }}" errorName="trakingid" class="py-2"
                            value="{{ $orderinfo->couriertrakingid ?? old('trakingid') }}">
                        </x-form.textbox>
                    </div>
                    <div class="row mt-3">
                        <x-form.textbox labelName="{{ __f('Delivary Charge Label Title') }}" parantClass="col-12 col-md-4" name="delivarycharge"
                            placeholder="{{ __f('Delivary Charge Placeholder') }}" errorName="delivarycharge" class="py-2"
                            type="number" value="{{ convertToLocaleNumber($orderinfo->charge ?? old('delivarycharge')) }}">
                        </x-form.textbox>

                        <x-form.textbox labelName="{{ __f('Discount Title') }}" parantClass="col-12 col-md-4" name="discount"
                            placeholder="{{ __f('Discount Placeholder') }}" errorName="discount" class="py-2" type="number"
                            value="{{ convertToLocaleNumber($orderinfo->discount ?? old('discount')) }}">
                        </x-form.textbox>
                        @php
                            $totalconvartamont = $totalAmount - $orderinfo->discount;
                            $totalgrandamount = $totalconvartamont + $orderinfo->charge;
                        @endphp
                        <x-form.textbox labelName="{{ __f('Total Title') }}" parantClass="col-12 col-md-4" name="total"
                            placeholder="{{ __f('Total Placeholder') }}" errorName="total" class="py-2" type="number"
                            value="{{ convertToLocaleNumber($totalgrandamount ?? 0) }}">
                        </x-form.textbox>
                    </div>
                    <div class="row mt-3">
                        <x-form.textarea labelName="{{ __f('Note Title') }}" parantClass="col-12 col-md-12" name="note"
                            placeholder="{{ __f('Note Placeholder') }}" errorName="note" class="py-2"
                            value="{{ $orderinfo->note ?? old('note') }}">
                        </x-form.textarea>
                    </div>
                    <div class="d-flex justify-content-end align-items-center mt-3">
                        <button type="submit" class="btn btn-primary d-flex align-items-center">
                            <div class="spinner-border text-light d-none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>{{ __f('Submit Title') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#selectcity').select2({
                tags: true,
                theme: 'bootstrap'
            });
            const preselectedValue = "{{ $orderinfo->cityid }}";
            if (preselectedValue) {
                $('#selectcity').val(preselectedValue).trigger('change');
            }
        });

        $(document).ready(function() {
            $('#selectzone').select2({
                tags: true,
                theme: 'bootstrap'
            });
            const preselectedValue = "{{ $orderinfo->zoneid }}";
            if (preselectedValue) {
                $('#selectzone').val(preselectedValue).trigger('change');
            }
        });

        $(document).on('input', '.product-price, .product-quantity', function() {
            const row = $(this).closest('tr');
            const orderId = $('#order_id').val();
            const orderDetailsId = $(this).data('id');
            const price = parseFloat(row.find('.product-price').val()) || 0;
            const quantity = parseInt(row.find('.product-quantity').val()) || 0;
            const discount = parseInt($('#discount').val() || 0);
            const delivarycharge = parseInt($('#delivarycharge').val() || 0);

            const grandtotal = price * quantity;
            row.find('.grandtotal').text(grandtotal.toFixed(2));
            $.ajax({
                url: "{{ route('admin.price.update') }}",
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    order_id: orderId,
                    order_details_id: orderDetailsId,
                    price: price,
                    quantity: quantity,
                    discount: discount,
                    delivarycharge: delivarycharge,
                },
                success: function(res) {
                    if (res.status == 'success') {
                        var totalamounts = res.totalamount - discount;
                        $('#total').val(totalamounts + delivarycharge);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });

        $(document).on('input', '#discount', function() {
            const orderId = $('#order_id').val();
            const discount = parseInt($('#discount').val() || 0);
            const delivarycharge = parseInt($('#delivarycharge').val() || 0);
            $.ajax({
                url: "{{ route('admin.discount.update') }}",
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    order_id: orderId,
                    discount: discount,
                },
                success: function(res) {
                    if (res.status == 'success') {
                        var totalamounts = res.totalamount - discount;
                        $('#total').val(totalamounts + delivarycharge);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });

        });

        $(document).on('input', '#delivarycharge', function() {
            const orderId = $('#order_id').val();
            const discount = parseInt($('#discount').val() || 0);
            const delivarycharge = parseInt($('#delivarycharge').val() || 0);
            $.ajax({
                url: "{{ route('admin.charge.update') }}",
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    order_id: orderId,
                    charge: delivarycharge,
                },
                success: function(res) {
                    if (res.status == 'success') {
                        var totalamounts = res.totalamount - discount;
                        $('#total').val(totalamounts + delivarycharge);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });

        });

        $(document).on('change', '#couriertype', function() {
            const changeValue = $(this).val();
            const storeHtml = $('.pathauCourierExtraFiled');
            if (changeValue === 'Pathao') {
                const cityLists = @json($cityLists['data']['data']);
                storeHtml.html(renderPathauFields(cityLists));
                $('#selectcity').select2({
                    tags: true,
                    theme: 'bootstrap'
                });
                $("#selectzone").select2({
                    tags: true,
                    theme: "bootstrap",
                });
            } else {
                storeHtml.html('');
            }
        });

        $(document).on('change', '#selectcity', function() {
            var changevalue = $(this).val();
            $.ajax({
                url: '/admin/order-zone-list/' + changevalue,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                },
                success: function(res) {
                    if (res.status === 'success') {
                        var getsuccess = $('#selectzone').html(res.data);
                        if (getsuccess) {
                            $("#selectzone").select2({
                                tags: true,
                                theme: "bootstrap",
                            });
                        }

                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        $(document).ready(function() {
            $('.order-delete').on('click', function() {
                var productId = $(this).data('id');
                Swal.fire({
                    title: "{{ __f('Order Delete Alert Message') }}",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "{{ __f('Delete Confirem Text') }}",
                    cancelButtonText: "{{ __f('Delete Cancel Text') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/admin/single-product-delete/' +
                                productId,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            success: function(res) {
                                if (res.status === 'success') {
                                    flashMessage(res.status, res.message);
                                    location.reload();
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    }
                });
            });
            const projectRedirectUrl = "{{ route('admin.order.index') }}";

            $('#orderUpdateFrom').on('submit', function(e) {
                e.preventDefault();
                $('.spinner-border').removeClass('d-none');
                $('.error-text').text('');
                let formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == 'success') {
                            flashMessage(res.status, res.message);
                            setTimeout(() => {
                                window.location.href = projectRedirectUrl;
                            }, 100);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $('.spinner-border').addClass('d-none');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.' + key + '-error').text(value[0]);
                            });
                        } else {
                            $('.spinner-border').addClass('d-none');
                            console.log('Something went wrong. Please try again.');
                        }
                    }
                });
            });
        });

        function renderPathauFields(cityLists) {
            return `
                <div class="col-md-4">
                    <label for="selectcity" class="required">{{ __f('Select City Label Title') }}</label>
                    <select id="selectcity" name="selectcity" class="form-select">
                       <option value="">{{ __f('Select City Label Title') }}</option>
                        ${cityLists.map(city => `<option value="${city.city_id}">${city.city_name || ''}</option>`).join('')}
                    </select>
                    <span class="text-danger error-text selectcity-error"></span>
                </div>
                <div class="col-md-4">
                    <label for="selectzone" class="required">{{ __f('Select Zone Label Title') }}</label>
                    <select id="selectzone" name="selectzone" class="form-select"></select>
                     <span class="text-danger error-text selectzone-error"></span>
                </div>
                <div class="col-md-4">
                     <label for="weight" class="required">{{ __f('Net Weight Label Title') }}</label>
                    <input type="number" name="weight" placeholder="{{ __f('Net Weight Placeholder') }}" class="form-control py-2" value="0.5">
                </div>
            `;
        }
    </script>
@endpush
