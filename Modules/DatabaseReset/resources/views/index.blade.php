@extends('layouts.app')
@section('title', $title)
@push('styles')
    <style>
        #databaseTables thead {
            border-bottom: 1px solid #ddd;
        }
        #databaseTables tbody tr {
            border-bottom: 1px solid #ddd;
        }
        #databaseTables tbody tr:last-child {
            border-bottom: 1px solid transparent;
        }
        #databaseTables tbody tr td {
	        padding: 6px 0px;
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
                <table id="databaseTables" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>{{ __f('SL Title') }}</th>
                            <th>{{ __f('Database Table Name Title') }}</th>
                            <th>{{ __f('Total Data Title') }}</th>
                            <th>{{ __f('Action Title') }}</th>
                        </tr>
                    </thead>
                    @php
                        $categories     = DB::table('categories')->count();
                        $customers      = DB::table('customers')->count();
                        $expenses       = DB::table('expenses')->count();
                        $expense_lists  = DB::table('expense_lists')->count();
                        $orders         = DB::table('orders')->count();
                        $products       = DB::table('products')->count();
                        $purchases      = DB::table('purchases')->count();
                        $purchase_invoice_details      = DB::table('purchase_invoice_details')->count();
                        $sales_invoices = DB::table('sales_invoices')->count();
                        $sales_invoice_details = DB::table('sales_invoice_details')->count();
                        $menus = DB::table('menus')->count();
                        $sliders        = DB::table('sliders')->count();
                        $suppliers      = DB::table('suppliers')->count();
                        $users          = DB::table('users')->where('role_id',8)->count();
                    @endphp
                    <tbody>
                        <tr>
                            <td>{{ convertToLocaleNumber(1) }}</td>
                            <td>{{ __f('Categories Title') }}</td>
                            <td>{{ convertToLocaleNumber($categories ?? 0) }}</td>
                            <td>
                                <button class="dropdown-item align-items-center" onclick="delete_data('categories')">
                                    <i class="fa-solid fa-trash me-2 text-danger"></i></button>
                                <form action="{{ route('admin.databasereset.destroy',['id' => 'categories']) }}"
                                    id="delete-form-categories" method="DELETE" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ convertToLocaleNumber(2) }}</td>
                            <td>{{ __f('Customers Title') }} </td>
                            <td>{{ convertToLocaleNumber($customers ?? 0) }}</td>
                            <td>
                                <button class="dropdown-item align-items-center" onclick="delete_data('customers')">
                                    <i class="fa-solid fa-trash me-2 text-danger"></i></button>
                                <form action="{{ route('admin.databasereset.destroy',['id' => 'customers']) }}"
                                    id="delete-form-customers" method="DELETE" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ convertToLocaleNumber(3) }}</td>
                            <td>{{ __f('Expenses Title') }} </td>
                            <td>{{ convertToLocaleNumber($expenses ?? 0) }}</td>
                            <td>
                                <button class="dropdown-item align-items-center" onclick="delete_data('expenses')">
                                    <i class="fa-solid fa-trash me-2 text-danger"></i></button>
                                <form action="{{ route('admin.databasereset.destroy',['id' => 'expenses']) }}"
                                    id="delete-form-expenses" method="DELETE" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ convertToLocaleNumber(4) }}</td>
                            <td>{{ __f('Expenses List Title') }}</td>
                            <td>{{ convertToLocaleNumber($expense_lists ?? 0) }}</td>
                            <td>
                                <button class="dropdown-item align-items-center" onclick="delete_data('expense_lists')">
                                    <i class="fa-solid fa-trash me-2 text-danger"></i></button>
                                <form action="{{ route('admin.databasereset.destroy',['id' => 'expense_lists']) }}"
                                    id="delete-form-expense_lists" method="DELETE" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ convertToLocaleNumber(5) }}</td>
                            <td>{{ __f('Orders Title') }}</td>
                            <td>{{ convertToLocaleNumber($orders ?? 0) }}</td>
                            <td>
                                <button class="dropdown-item align-items-center" onclick="delete_data('orders')">
                                    <i class="fa-solid fa-trash me-2 text-danger"></i></button>
                                <form action="{{ route('admin.databasereset.destroy',['id' => 'orders']) }}"
                                    id="delete-form-orders" method="DELETE" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ convertToLocaleNumber(6) }}</td>
                            <td>{{ __f('Products Title') }}</td>
                            <td>{{ convertToLocaleNumber($products ?? 0) }}</td>
                            <td>
                                <button class="dropdown-item align-items-center" onclick="delete_data('products')">
                                    <i class="fa-solid fa-trash me-2 text-danger"></i></button>
                                <form action="{{ route('admin.databasereset.destroy',['id' => 'products']) }}"
                                    id="delete-form-products" method="DELETE" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ convertToLocaleNumber(7) }}</td>
                            <td>{{ __f('Purchases Title') }} </td>
                            <td>{{ convertToLocaleNumber($purchases  ?? 0) }}</td>
                            <td>
                                <button class="dropdown-item align-items-center" onclick="delete_data('purchases')">
                                    <i class="fa-solid fa-trash me-2 text-danger"></i></button>
                                <form action="{{ route('admin.databasereset.destroy',['id' => 'purchases']) }}"
                                    id="delete-form-purchases" method="DELETE" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ convertToLocaleNumber(8) }}</td>
                            <td>{{ __f('Purchase Invoice Details Title') }} </td>
                            <td>{{ convertToLocaleNumber($purchase_invoice_details  ?? 0) }}</td>
                            <td>
                                <button class="dropdown-item align-items-center" onclick="delete_data('purchase_invoice_details')">
                                    <i class="fa-solid fa-trash me-2 text-danger"></i></button>
                                <form action="{{ route('admin.databasereset.destroy',['id' => 'purchase_invoice_details']) }}"
                                    id="delete-form-purchase_invoice_details" method="DELETE" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ convertToLocaleNumber(9) }}</td>
                            <td>{{ __f('Sales Invoices Title') }} </td>
                            <td>{{ convertToLocaleNumber($sales_invoices  ?? 0) }}</td>
                            <td>
                                <button class="dropdown-item align-items-center" onclick="delete_data('sales_invoices')">
                                    <i class="fa-solid fa-trash me-2 text-danger"></i></button>
                                <form action="{{ route('admin.databasereset.destroy',['id' => 'sales_invoices']) }}"
                                    id="delete-form-sales_invoices" method="DELETE" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ convertToLocaleNumber(10) }}</td>
                            <td>{{ __f('Sales Invoices Datails Title') }}</td>
                            <td>{{ convertToLocaleNumber($sales_invoice_details   ?? 0) }}</td>
                            <td>
                                <button class="dropdown-item align-items-center" onclick="delete_data('sales_invoice_details')">
                                    <i class="fa-solid fa-trash me-2 text-danger"></i></button>
                                <form action="{{ route('admin.databasereset.destroy',['id' => 'sales_invoice_details']) }}"
                                    id="delete-form-sales_invoice_details" method="DELETE" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ convertToLocaleNumber(11) }}</td>
                            <td>{{ __f('Menus Title') }}</td>
                            <td>{{ convertToLocaleNumber($menus ?? 0) }}</td>
                            <td>
                                <button class="dropdown-item align-items-center" onclick="delete_data('menus')">
                                    <i class="fa-solid fa-trash me-2 text-danger"></i></button>
                                <form action="{{ route('admin.databasereset.destroy',['id' => 'menus']) }}"
                                    id="delete-form-menus" method="DELETE" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ convertToLocaleNumber(12) }}</td>
                            <td>{{ __f('Sliders Title') }}</td>
                            <td>{{ convertToLocaleNumber($sliders ?? 0) }}</td>
                            <td>
                                <button class="dropdown-item align-items-center" onclick="delete_data('sliders')">
                                    <i class="fa-solid fa-trash me-2 text-danger"></i></button>
                                <form action="{{ route('admin.databasereset.destroy',['id' => 'sliders']) }}"
                                    id="delete-form-sliders" method="DELETE" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ convertToLocaleNumber(13) }}</td>
                            <td>{{ __f('Suppliers Title') }} </td>
                            <td>{{ convertToLocaleNumber($suppliers ?? 0) }}</td>
                            <td>
                                <button class="dropdown-item align-items-center" onclick="delete_data('suppliers')">
                                    <i class="fa-solid fa-trash me-2 text-danger"></i></button>
                                <form action="{{ route('admin.databasereset.destroy',['id' => 'suppliers']) }}"
                                    id="delete-form-suppliers" method="DELETE" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ convertToLocaleNumber(14) }}</td>
                            <td>{{ __f('Users Title') }}</td>
                            <td>{{ convertToLocaleNumber($users ?? 0) }}</td>
                            <td>
                                <button class="dropdown-item align-items-center" onclick="delete_data('users')">
                                    <i class="fa-solid fa-trash me-2 text-danger"></i></button>
                                <form action="{{ route('admin.databasereset.destroy',['id' => 'users']) }}"
                                    id="delete-form-users" method="DELETE" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
