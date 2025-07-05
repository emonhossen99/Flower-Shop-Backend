@extends('layouts.app')
@section('title', $title)
@section('content')
    <div class="row mt-3 position-relative">
        <div class="col-md-12">
            <div class="card px-3 py-3">
                <div class="bg-white border-bottom-0 pb-4 d-flex justify-content-between align-items-center flex-row">
                    <h2 class="backend-title">{{ $title }}</h2>
                </div>
                <div
                    class="blukactions bg-white border-bottom-0 pb-4 d-flex justify-content-between align-items-center flex-row">
                    <div class="d-flex align-items-center">
                        <div class="dropdown">
                            <a class="btn dropdown-toggle d-flex align-items-center" href="#" role="button"
                                id="blukactions" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="spinner-border text-light d-none bluk-spinner" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <i class="align-middle me-2" data-feather="tool"></i>{{ __f('Bluk Actions Title') }} 
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="blukactions">
                                {{-- <li id="bluk-send-redx"><a class="dropdown-item" href="javascript:"><i
                                            class="align-middle text-danger" data-feather="truck"></i> Send To Redx</a></li> --}}
                                <li id="bluk-send-pathao"><a class="dropdown-item" href="javascript:"><i
                                            class="align-middle text-dark" data-feather="truck"></i>{{ __f('Send To Pathao Title') }} </a></li>
                                <li id="bluk-send-stead-fast"><a class="dropdown-item" href="javascript:"><i
                                            class="align-middle text-info" data-feather="truck"></i>{{ __f('Send To Stead Fast Title') }} </a>
                                </li>
                                <li id="bluk-printer"><a class="dropdown-item" href="javascript:"><i
                                            class="align-middle text-secondary" data-feather="printer"></i>{{ __f('Print Orders Title') }} 
                                    </a>
                                </li>
                                <li id="bluk-change-status"><a class="dropdown-item" href="javascript:"><i
                                            class="align-middle text-warning" data-feather="edit-3"></i> {{ __f('Change Status Title') }}</a>
                                </li>
                                <li id="bluk-delete"><a class="dropdown-item" href="javascript:"><i
                                            class="align-middle text-danger" data-feather="trash-2"></i>{{ __f('Delete Orders Title') }} </a>
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown ms-3">
                            <a class="btn dropdown-toggle d-flex align-items-center" href="#" role="button"
                                id="orderstatusfillter" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="spinner-border text-light d-none" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <i class="align-middle me-2" data-feather="filter"></i> <span id="filtername">{{ __f('Fillter Title') }}</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="orderstatusfillter">
                                <li onclick="orderFilter(1,'Pending')"><a class="dropdown-item" href="javascript:"><i
                                            class="align-middle text-info" data-feather="truck"></i> {{ __f('Pending Title') }}</a></li>
                                <li onclick="orderFilter(2,'Processing')"><a class="dropdown-item" href="javascript:"><i
                                            class="align-middle text-success" data-feather="truck"></i>{{ __f('Processing Title') }} </a></li>
                                <li onclick="orderFilter(3,'On The Way')"><a class="dropdown-item" href="javascript:"><i
                                            class="align-middle text-secondary" data-feather="truck"></i> {{ __f('On The Way Title') }}</a>
                                </li>
                                <li onclick="orderFilter(4,'On Hold')"><a class="dropdown-item" href="javascript:"><i
                                            class="align-middle text-warning" data-feather="truck"></i>{{ __f('On Hold Title') }} </a></li>
                                <li onclick="orderFilter(5,'Complate')"><a class="dropdown-item" href="javascript:"><i
                                            class="align-middle text-primary" data-feather="truck"></i>{{ __f('Complate Title') }} </a></li>
                                <li onclick="orderFilter(6,'Cancel')"><a class="dropdown-item" href="javascript:"><i
                                            class="align-middle text-danger" data-feather="truck"></i> {{ __f('Cancel Title') }}</a></li>
                                <li onclick="orderFilter(null,'Fillter')"><a class="dropdown-item" href="javascript:"><i
                                            class="align-middle text-info" data-feather="refresh-ccw"></i>{{ __f('Reset Fillter Title') }} </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="email-template-search-bar btn-group d-flex align-items-center w-40">
                        <input type="text" id="datatable-search" class="h-100 border w-100 py-2 px-3"
                            placeholder="{{ __f('Invoice Id,Phone,Courier Traking Id,Status Placeholder') }}">
                        <input type="hidden" id="datatable-status-search" class="d-none">
                    </div>
                </div>
                <table id="admin_project" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>{{ __f('SL Title') }}</th>
                            {{-- <th>Invoice Id</th> --}}
                            <th>{{ __f('Name Title') }}</th>
                            <th>{{ __f('Address Title') }}</th>
                            <th>{{ __f('Phone Title') }}</th>
                            <th>{{ __f('Amount Title') }}</th>
                            <th>{{ __f('Courier Name Title') }}</th>
                            {{-- <th>Courier Traking Id</th> --}}
                            <th>{{ __f('Order Date Title') }}</th>
                            <th>{{ __f('Status Title') }}</th>
                            <th>{{ __f('Action Title') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- Order Status Change Modal Start-->
        @include('components.models.orderchangestatus')
        <!-- Order Status Change Modal End -->
        <!-- Fraud Checker Modal Start-->
        @include('components.models.fraudcheckmodal')
        <!-- Fraud Checker Modal End -->
    @endsection
    @push('scripts')
        <script>
            const currentLang = "{{ app()->getLocale() }}" || 'en'; 
            var tables = $('#admin_project').DataTable({
            processing: true,
            serverSide: true,
            order: [],
            bInfo: true,
            bFilter: false,
            responsive: true,
            ordering: false,
            lengthMenu: [
                [5, 10, 15, 25, 50, 100, 1000, 10000, -1],
                [5, 10, 15, 25, 50, 100, 1000, 10000, "All"]
            ],
            pageLength: 25,
            ajax: {
                url: "{{ route('admin.order.get.data') }}",
                type: "POST",
                dataType: "JSON",
                data: function(d) {
                    d._token = _token,
                    d.search = $('#datatable-search').val();
                    d.status = $('#datatable-status-search').val();
                },
            },
            columns: [
                {
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `<input type="checkbox" class="row-checkbox select-row" value="${row.id}">`;
                    }
                },
                {
                    data: null, // SL column
                    name: 'sl',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        if(currentLang == 'bn'){
                            return toBanglaNumber(data.DT_RowIndex);
                        }
                        return data.DT_RowIndex;
                    }
                },
                // { data: 'invoice_id', name: 'invoice_id' },
                { data: 'name', name: 'name' },
                { data: 'address', name: 'address' },
                { data: 'phone', name: 'phone' },
                { 
                    data: 'amount',
                    render: function(data, type, row, meta) {
                        if(currentLang == 'bn'){
                            return toBanglaNumber(data);
                        }
                        return data;
                    }
                },
                { data: 'couriername', name: 'couriername' },
                // { data: 'couriertrakingid', name: 'couriertrakingid' },
                { data: 'orderdate', name: 'orderdate' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action' }
            ],
            language: {
                processing: '<img src="{{ asset('backend/assets/img/avatars/table-loading.svg') }}">',
                emptyTable: '<strong class="text-danger">{{ __f("No Data Found Title") }}</strong>',
                infoEmpty: '',
                zeroRecords: '<strong class="text-danger">{{ __f("No Data Found Title") }}</strong>',
                oPaginate: {
                    sPrevious: "{{ __f('Paginate Previous Title') }}",
                    sNext: "{{ __f('Paginate Next Title') }}",
                },
                lengthMenu: "_MENU_"
            },
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 text-end' <''B>>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'<''p>>>",
            buttons: [
                {
                    extend: 'pdf',
                    title: 'Admin Orders',
                    filename: 'admin_orders_{{ date('d-m-Y') }}',
                    text: '<i class="fa-solid fa-file-pdf"></i> {{ __f("PDF Title") }}',
                    className: 'dataTablesExportBtn mb-3',
                    orientation: "landscape",
                    pageSize: "A4",
                    exportOptions: {
                        columns: '0,1,2,3,4,5,6,7,8'
                    },
                    customize: function(doc) {
                        doc.defaultStyle.alignment = 'center';
                    }
                },
                {
                    extend: 'excel',
                    title: 'Admin Orders',
                    filename: 'admin_orders_{{ date('d-m-Y') }}',
                    text: '<i class="fa-regular fa-file-excel"></i>  {{ __f("Excel Title") }}',
                    className: 'dataTablesExportBtn mb-3',
                    exportOptions: {
                       columns: '0,1,2,3,4,5,6,7,8'
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print" aria-hidden="true"></i> {{ __f("Print Title") }}',
                    className: 'dataTablesExportBtn  mb-3',
                    orientation: "landscape",
                    pageSize: "A4",
                    exportOptions: {
                       columns: '0,1,2,3,4,5,6,7,8'
                    }
                }
            ]
        });

        $(document).on('keyup keyup', 'input#datatable-search', function(e) {
            tables.draw();
        });

        function orderFilter(id, filtername) {
            var setvalue = $('#datatable-status-search').val(id);
            if (setvalue) {
                $('#filtername').html(filtername);
                tables.draw();
            }
        }
        </script>
        <script>
            $(document).ready(function() {
                const selectAllCheckbox = $('#select-all');

                selectAllCheckbox.on('change', function() {
                    const isChecked = $(this).is(':checked');
                    $('.row-checkbox').prop('checked', isChecked);
                });

                $(document).on('change', '.row-checkbox', function() {
                    const allChecked = $('.row-checkbox').length === $('.row-checkbox:checked').length;
                    selectAllCheckbox.prop('checked', allChecked);
                });
            });

            //---------------------- Send To Pathao ----------------------//
            $('#bluk-send-pathao').click(function() {
                const ids = [];
                $('.select-row:checked').each(function() {
                    ids.push($(this).val());
                });

                if (ids.length === 0) {
                    flashMessage('warning', '{{ __f("Select one order and try agin Message") }}');
                    return;
                }

                Swal.fire({
                    title: "{{ __f('Sent To Pathao Alert Message') }}",
                    icon: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "{{ __f('Delete Confirem Text') }}",
                    cancelButtonText: "{{ __f('Delete Cancel Text') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('.bluk-spinner').removeClass('d-none');
                        $.ajax({
                            url: "{{ route('admin.send.pathao') }}",
                            type: 'POST',
                            data: {
                                ids: ids,
                                _token: "{{ csrf_token() }}"
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(res) {
                                if (res.status === 'success') {
                                    flashMessage(res.status, res.message);
                                    location.reload();
                                } else {
                                    $('.bluk-spinner').addClass('d-none');
                                    $.each(res.error, function (input,messages) {
                                        flashMessage(res.status, messages[0]);
                                    });
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                                $('.bluk-spinner').addClass('d-none');
                            }
                        });
                    }
                });
            });

            //---------------------- Send To Stead Fast ----------------------//
            $('#bluk-send-stead-fast').click(function() {
                const ids = [];
                $('.select-row:checked').each(function() {
                    ids.push($(this).val());
                });

                if (ids.length === 0) {
                    flashMessage('warning', '{{ __f("Select one order and try agin Message") }}');
                    return;
                }

                Swal.fire({
                    title: "{{ __f('Sent To Stead Fast Alert Message') }}",
                    icon: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "{{ __f('Delete Confirem Text') }}",
                    cancelButtonText: "{{ __f('Delete Cancel Text') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('.bluk-spinner').removeClass('d-none');
                        $.ajax({
                            url: "{{ route('admin.send.stead.fast') }}",
                            type: 'POST',
                            data: {
                                ids: ids,
                                _token: "{{ csrf_token() }}"
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(res) {
                                if (res.status === 'success') {
                                    flashMessage(res.status, res.message);
                                    location.reload();
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                                $('.bluk-spinner').addClass('d-none');
                            }
                        });
                    }
                });
            });

            //---------------------- Bluk Print ----------------------//
            $('#bluk-printer').click(function() {
                const ids = [];
                $('.select-row:checked').each(function() {
                    ids.push($(this).val());
                });

                if (ids.length === 0) {
                    flashMessage('warning', '{{ __f("Select one order and try agin Message") }}');
                    return;
                }

                Swal.fire({
                    title: "{{ __f('Print Order Alert Message') }}",
                    icon: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "{{ __f('Delete Confirem Text') }}",
                    cancelButtonText: "{{ __f('Delete Cancel Text') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = $('<form>', {
                            action: "{{ route('admin.order.bluk.prints') }}",
                            method: 'POST',
                            target: '_blank'
                        });

                        form.append($('<input>', {
                            name: '_token',
                            value: "{{ csrf_token() }}",
                            type: 'hidden'
                        }));

                        ids.forEach(id => {
                            form.append($('<input>', {
                                name: 'ids[]',
                                value: id,
                                type: 'hidden'
                            }));
                        });
                        $('body').append(form);
                        form.submit();
                        form.remove();
                    }
                });
            });

            //---------------------- Bluk Status Change ----------------------//
            var statusModal = new bootstrap.Modal(document.getElementById('statusChangeModal'), {
                keyboard: false,
                backdrop: false,
            })
            $('#bluk-change-status').click(function() {
                const ids = [];
                $('.select-row:checked').each(function() {
                    ids.push($(this).val());
                });

                if (ids.length === 0) {
                    flashMessage('warning', '{{ __f("Select one order and try agin Message") }}');
                    return;
                }
                statusModal.show();
            });
            $('#bluk-change-status-submit').click(function() {
                const ids = [];
                const status = $('#selectorderstatus').val();
                $('.select-row:checked').each(function() {
                    ids.push($(this).val());
                });

                if (ids.length === 0) {
                    flashMessage('warning', '{{ __f("Select one order and try agin Message") }}');
                    return;
                }

                $('.bluk-change-status-submit-loader').removeClass('d-none');
                $.ajax({
                    url: "{{ route('admin.order.bluk.status.change') }}",
                    type: 'POST',
                    data: {
                        ids: ids,
                        status: status,
                        _token: "{{ csrf_token() }}"
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            flashMessage(res.status, res.message);
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        $('.bluk-change-status-submit-loader').addClass('d-none');
                    }
                });
            });

            //---------------------- Bluk Delete ----------------------//
            $('#bluk-delete').click(function() {
                const ids = [];
                $('.select-row:checked').each(function() {
                    ids.push($(this).val());
                });

                if (ids.length === 0) {
                    flashMessage('warning', '{{ __f("Select one order and try agin Message") }}');
                    return;
                }

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
                        $('.bluk-spinner').removeClass('d-none');
                        $.ajax({
                            url: "{{ route('admin.order.bluk.delete') }}",
                            type: 'POST',
                            data: {
                                ids: ids,
                                _token: "{{ csrf_token() }}"
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(res) {
                                if (res.status === 'success') {
                                    flashMessage(res.status, res.message);
                                    location.reload();
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                                $('.bluk-spinner').addClass('d-none');
                            }
                        });
                    }
                });
            });

            //---------------------- Fraud Checker ----------------------//
            var fraudChecker = new bootstrap.Modal(document.getElementById('fraudCheckerModal'), {
                keyboard: false,
                backdrop: false,
            });

            function FraudCheckerMethod(number){
                $('#commonLoadeBackend').removeClass('d-none')
                $.ajax({
                    url: "{{ route('admin.fraud.check') }}",
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Content-Type": "application/json"
                    },
                    data: JSON.stringify({ phone: number }),
                    processData: true,
                    contentType: 'application/json',
                    success: function(res) {
                        if (res.status == 'success') {
                            $('#commonLoadeBackend').addClass('d-none');
                            $('#responsedataadd').html('');
                            $('#responsedataadd').html(res.data);
                            $('#responchartrander').removeClass('d-none');
                            $('#total_parcel').html(res.rowdata.courierData['summary']
                                .total_parcel);
                            $('#success_parcel').html(res.rowdata.courierData['summary']
                                .success_parcel);
                            $('#cancel_parcel').html(res.rowdata.courierData['summary']
                                .cancelled_parcel);

                            var successRate = res.rowdata.courierData['summary'].success_ratio;
                            var cancelRate = 100 - res.rowdata.courierData['summary']
                                .success_ratio;
                            var convertCancelRate = parseFloat(cancelRate.toFixed(2));

                            if (typeof successRateChart !== "undefined") {
                                successRateChart.updateSeries([successRate, convertCancelRate]);
                            } else {
                                var options = {
                                    series: [successRate, convertCancelRate],
                                    chart: {
                                        width: '200',
                                        height: '200',
                                        type: 'pie',
                                    },
                                    labels: ['{{ __f("Success Title") }}', '{{ __f("Cancel Title") }}'],
                                    colors: ['#28a745', '#dc3545'],
                                    dataLabels: {
                                        enabled: false,
                                    },
                                    plotOptions: {
                                        pie: {
                                            expandOnClick: true,
                                            donut: {
                                                labels: {
                                                    show: false
                                                }
                                            }
                                        }
                                    },
                                    grid: {
                                        padding: {
                                            top: 0,
                                            bottom: 0,
                                            left: 0,
                                            right: 0,
                                        },
                                    },
                                };
                                successRateChart = new ApexCharts(document.querySelector(
                                    "#success-rate-chats"), options);
                                successRateChart.render();
                            }
                            fraudChecker.show();
                        }
                    },
                    error: function(xhr) {
                        flashMessage('error','{{ __f("Phone Format Invalid Error Message") }}');
                        $('#commonLoadeBackend').addClass('d-none');
                    }
                });
            }
        </script>
    @endpush
