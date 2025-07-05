@extends('layouts.app')
@section('title', $title)
@push('styles')
    <style>
        body {
            font-family: "Roboto", sans-serif !important;
        }

        .apexcharts-menu-icon,
        .apexcharts-toolbar {
            display: none !important;
        }
    </style>
@endpush
@section('content')
    <div class="">
        <div class="row">
            <div class="col-xl-12 col-xxl-12 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">{{ __f('Total Entry Products Title') }}</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="list"></i>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <h1 class="mt-1 mb-3">{{ convertToLocaleNumber($totalProducts ?? 0) }}</h1> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">{{ __f('Total Users Title') }}</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <h1 class="mt-1 mb-3">{{ convertToLocaleNumber($totalUsers ?? 0) }} </h1> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">{{ __f('Total Client Users Title') }}</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <h1 class="mt-1 mb-3">{{ convertToLocaleNumber($clientTotalUsers ?? 0) }} </h1> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">{{ __f('Total Staff Users Title') }}</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <h1 class="mt-1 mb-3">{{ convertToLocaleNumber($totalStaffUsers ?? 0) }} </h1> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">{{ __f('Total Orders Title') }}</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="shopping-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <h1 class="mt-1 mb-3">{{ convertToLocaleNumber($totalOrders ?? 0) }}</h1> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">{{ __f('Pending Orders Title') }}</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="shopping-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <h1 class="mt-1 mb-3">{{ convertToLocaleNumber($pendingOrders ?? 0) }}</h1> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">{{ __f('Processing Orders Title') }}</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="shopping-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <h1 class="mt-1 mb-3">{{ convertToLocaleNumber($processingOrders ?? 0) }}</h1> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">{{ __f('Sell Orders Title') }}</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="shopping-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <h1 class="mt-1 mb-3">{{ convertToLocaleNumber($sellOrders ?? 0) }}</h1> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-xxl-6">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ __f('Months Orders Title') }}</h5>
                    </div>
                    <div class="card-body py-3">
                        <div class="chart chart-sm">
                            <div id="orderChats"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-xxl-6">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ __f('Months Products Title') }}</h5>
                    </div>
                    <div class="card-body py-3">
                        <div class="chart chart-sm">
                            <div id="productchart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function convertToLocaleNumber(number) {
            const currentLang = "{{ app()->getLocale() }}" || 'en';
            const map = {
                bn: ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'],
                en: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
            };

            const targetDigits = map[currentLang] || map['en'];
            return number.toString().split('').map(char => {
                if (!isNaN(char) && map['en'].includes(char)) {
                    return targetDigits[parseInt(char)];
                }
                return char;
            }).join('');
        }

        function getOrderData() {
            $.ajax({
                url: "{{ route('admin.dashboard.order.chart.count') }}",
                type: 'POST',
                dataType: 'json',
                async: true,
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    var options = {
                        series: [{
                            name: "{{ __f('Pending Orders Title') }}",
                            data: data.pendingOrder,
                        }, {
                            name: "{{ __f('Processing Orders Title') }}",
                            data: data.processingOrder,
                        }, {
                            name: "{{ __f('Sell Orders Title') }}",
                            data: data.sellOrder
                        }],
                        chart: {
                            height: 500,
                            type: 'area'
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth'
                        },
                        xaxis: {
                            categories: ["{{ __f('Jan Title') }}", "{{ __f('Feb Title') }}",
                                "{{ __f('Mar Title') }}", "{{ __f('Apr Title') }}",
                                "{{ __f('May Title') }}", "{{ __f('Jun Title') }}",
                                "{{ __f('Jul Title') }}", "{{ __f('Aug Title') }}",
                                "{{ __f('Sep Title') }}", "{{ __f('Oct Title') }}",
                                "{{ __f('Nov Title') }}", "{{ __f('Dec Title') }}"
                            ],
                        },
                        yaxis: {
                            labels: {
                                formatter: function(val) {
                                    return convertToLocaleNumber(val);
                                }
                            }
                        },
                        tooltip: {
                            enabled: true,
                            y: {
                                formatter: function(value) {
                                    return value;
                                },
                            },
                        },
                    };
                    var chart = new ApexCharts(document.querySelector("#orderChats"), options);
                    chart.render();
                }
            });
        }
        getOrderData();


        function getProductData() {
            $.ajax({
                url: "{{ route('admin.dashboard.products.chart.count') }}",
                type: 'POST',
                dataType: 'json',
                async: true,
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    var options = {
                        series: [{
                            name: "{{ __f('Pending Products Title') }}",
                            data: data.pendingproducts,
                        }, {
                            name: "{{ __f('Active Products Title') }}",
                            data: data.activeproducts,
                        }],
                        chart: {
                            type: 'bar',
                            height: 500
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '55%',
                                borderRadius: 5,
                                borderRadiusApplication: 'end'
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ['transparent']
                        },
                        xaxis: {
                            categories: ["{{ __f('Jan Title') }}", "{{ __f('Feb Title') }}",
                                "{{ __f('Mar Title') }}", "{{ __f('Apr Title') }}",
                                "{{ __f('May Title') }}", "{{ __f('Jun Title') }}",
                                "{{ __f('Jul Title') }}", "{{ __f('Aug Title') }}",
                                "{{ __f('Sep Title') }}", "{{ __f('Oct Title') }}",
                                "{{ __f('Nov Title') }}", "{{ __f('Dec Title') }}"
                            ],
                        },
                        yaxis: {
                            title: {
                                text: "{{ __f('Products Title') }}"
                            },
                            labels: {
                                formatter: function(val) {
                                    return convertToLocaleNumber(val);
                                }
                            }
                        },
                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function(val) {
                                    return val + "{{ __f('Products Title') }}"
                                }
                            }
                        }
                    };
                    var productrenderchart = new ApexCharts(document.querySelector("#productchart"), options);
                    productrenderchart.render();
                }
            });
        }
        getProductData();
    </script>
    <script>
        $(document).ready(function() {
            $('#search-input').val('');
            $('#customer').prop('checked', false);
            $('#supplier').prop('checked', false);
            $('#search-input').on('keyup', function() {
                let searchText = $(this).val().toLowerCase().trim();
                let supplierCount = 0;
                let customerCount = 0;

                if (searchText === '') {
                    $('.transaction-item').removeClass('hidetosearch').each(function() {
                        let role = '';
                        if ($(this).find('.role-supplier').length > 0) {
                            role = 'supplier';
                        } else if ($(this).find('.role-customer').length > 0) {
                            role = 'customer';
                        }

                        if (role === 'supplier') {
                            supplierCount++;
                        } else if (role === 'customer') {
                            customerCount++;
                        }
                    });
                } else {
                    $('.transaction-item').each(function() {
                        let name = $(this).find('.font-bold').text().toLowerCase();
                        let role = $(this).find('.role-supplier, .role-customer').hasClass(
                            'role-supplier') ? 'supplier' : 'customer';
                        if (name.includes(searchText)) {
                            $(this).removeClass('hidetosearch');
                            if (role === 'supplier') {
                                supplierCount++;
                            } else {
                                customerCount++;
                            }
                        } else {
                            $(this).addClass('hidetosearch');
                        }
                    });
                }

                $('#supplier-count').text(convertToLocaleNumber(supplierCount));
                $('#customer-count').text(convertToLocaleNumber(customerCount));

                if ($('.transaction-item:visible').length === 0) {
                    if ($('#no-result-message').length === 0) {
                        $('.transaction-list').append(
                            '<p id="no-result-message" class="text-center text-danger mt-3">{{ __f('No customer supplier found valiation') }}</p>'
                        );
                    }
                } else {
                    $('#no-result-message').remove();
                }
            });

            $('#applyFilterBtn').on('click', function () {
                let showCustomers = $('#customer').is(':checked');
                let showSuppliers = $('#supplier').is(':checked');
                let selectedSortOrder = $('input[name="amountRange"]:checked').val();
                let countCustomers = 0;
                let countSuppliers = 0;
                let visibleItems = [];

                $('.transaction-item').each(function () {
                    let $this = $(this);
                    let isCustomer = $this.find('.role-customer').length > 0;
                    let isSupplier = $this.find('.role-supplier').length > 0;

                    if ((!showCustomers && !showSuppliers) || 
                        (showCustomers && isCustomer) || 
                        (showSuppliers && isSupplier)) {

                        $this.removeClass('hidetosearch');
                        visibleItems.push($this);

                        if (isCustomer) countCustomers++;
                        if (isSupplier) countSuppliers++;
                    } else {
                        $this.addClass('hidetosearch');
                    }
                });

                if (selectedSortOrder === 'less-high' || selectedSortOrder === 'high-less') {
                    visibleItems.sort(function (a, b) {
                        let amountA = parseFloat(a.find('#customersuppliertotalamount').text()) || 0;
                        let amountB = parseFloat(b.find('#customersuppliertotalamount').text()) || 0;
                        return selectedSortOrder === 'less-high' ? amountA - amountB : amountB - amountA;
                    });
                } else if (selectedSortOrder === 'new-old' || selectedSortOrder === 'old-new') {
                    visibleItems.sort(function (a, b) {
                        let dateA = new Date(a.find('#customersupplierdate').text()) || new Date(0);
                        let dateB = new Date(b.find('#customersupplierdate').text()) || new Date(0);
                        return selectedSortOrder === 'new-old' ? dateB - dateA : dateA - dateB;
                    });
                }

                let container = $('.transaction-item').first().parent();
                visibleItems.forEach(function (item) {
                    container.append(item);
                });

                $('#supplier-count').text(convertToLocaleNumber(countSuppliers));
                $('#customer-count').text(convertToLocaleNumber(countCustomers));
                $('#fillterModal').modal('hide');
            });
        });
        function hideShowAmount(value){
            if(value == 'hide'){
                $('.action-chip-eye-hide').addClass('d-none');
                $('.show-amount').addClass('d-none');
                $('.action-chip-eye-show').removeClass('d-none');
                $('.hidden-amount').removeClass('d-none');
            }else{
                $('.action-chip-eye-hide').removeClass('d-none');
                $('.show-amount').removeClass('d-none');
                $('.action-chip-eye-show').addClass('d-none');
                $('.hidden-amount').addClass('d-none');
            }
        }
    </script>
@endpush
