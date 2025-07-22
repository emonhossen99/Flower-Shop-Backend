@extends('layouts.app')
@section('title', $title)
@section('add_button')
    <div>
        <a href="{{ route('admin.coupon.create') }}"
            class="create_btns  btn-md d-flex justify-content-between align-items-center">
            <i class="fa-solid fa-plus me-2"></i>
            <span>{{ __f("Create Title") }}</span>
        </a>
    </div>
@endsection
@section('content')
<div class="row mt-3">
    <div class="col-md-12">
        <div class="card px-3 py-3">
            <div class="bg-white border-bottom-0 pb-4 d-flex justify-content-between align-items-center flex-row">
                <h2 class="backend-title">{{ $title }}</h2>
                <div class="email-template-search-bar btn-group d-flex align-items-center">
                    <label for="" class="me-2">{{ __f("Search Title") }} : </label>
                    <input type="text" id="datatable-search" class="h-100 border w-100 py-2 px-3"
                        placeholder="{{ __f('Coupon Name Code Status Placeholder') }}">
                </div>
            </div>
            <table id="menuDataTables" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ __f('SL Title') }}</th>
                        <th>{{ __f('Name Title') }}</th>
                        <th>{{ __f('Code Title') }}</th>
                        <th>{{ __f('Discount Amount Title') }}</th>
                        <th>{{ __f('Coupon Type Title') }}</th>
                        <th>{{ __f('Coupon Use Limit Title') }}</th>
                        <th>{{ __f('Coupon Start Date Title') }}</th>
                        <th>{{ __f('Coupon End Date Title') }}</th>
                        <th>{{ __f('Status Title') }}</th>
                        <th>{{ __f('Action Title') }}</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const currentLang = "{{ app()->getLocale() }}" || 'en'; 
        var tables = $('#menuDataTables').DataTable({
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
                url: "{{ route('admin.coupon.get.data') }}",
                type: "GET",
                dataType: "JSON",
                data: function(d) {
                    d._token = _token,
                    d.search = $('#datatable-search').val();
                },
            },
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row, meta) {
                    if(currentLang == 'bn'){
                        return toBanglaNumber(data);
                    }
                        return data;
                    }
                },
                {
                    data: 'name'
                },
                {
                    data: 'code'
                },
                {
                    data: 'discount_amount'
                },
                {
                    data: 'type'
                },
                {
                    data: 'use_limit'
                },
                {
                    data: 'start_date'
                },
                {
                    data: 'end_date'
                },
                {
                    data: 'status'
                },
                {
                    data: 'action'
                },
            ],
            language: {
                processing: '<img src="{{ asset('backend/assets/img/avatars/table-loading.svg') }}">',
                emptyTable: '<strong class="text-danger">{{ __f("No Data Found Title") }}</strong>',
                infoEmpty: '',
                info: "{{ __f('DataTables Showing Title') }}",
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
                        title: 'Admin Project',
                        filename: 'admin_project_{{ date('d-m-Y') }}',
                        text: '<i class="fa-solid fa-file-pdf"></i> {{ __f("PDF Title") }}',
                        className: 'dataTablesExportBtn mb-3',
                        orientation: "landscape",
                        pageSize: "A4",
                        exportOptions: {
                            columns: '0,1,2,4,5'
                        },
                        customize: function(doc) {
                            doc.defaultStyle.alignment = 'center';
                        }
                    },
                    {
                        extend: 'excel',
                        title: 'Admin Project',
                        filename: 'admin_project_{{ date('d-m-Y') }}',
                        text: '<i class="fa-regular fa-file-excel"></i>  {{ __f("Excel Title") }}',
                        className: 'dataTablesExportBtn mb-3',
                        exportOptions: {
                            columns: '0,1,2,4,5'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print" aria-hidden="true"></i> {{ __f("Print Title") }}',
                        className: 'dataTablesExportBtn  mb-3',
                        orientation: "landscape",
                        pageSize: "A4",
                        exportOptions: {
                            columns: '0,1,2,4,5'
                        }
                    }
                ]
        });
        $(document).on('keyup keyup', 'input#datatable-search', function(e) {
            tables.draw();
        });
    </script>
@endpush
