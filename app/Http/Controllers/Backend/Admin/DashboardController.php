<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerSupplierRequest;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\Customer\App\Models\Customer;
use Modules\Customer\App\Models\PayBillCustomerSupplier;
use Modules\Product\App\Models\Product;
use Modules\Supplier\App\Models\Supplier;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (Gate::allows('isAdmin')) {
            $this->setPageTitle(__f('Dashboard Title'));
            $data['activeDashboard']      = 'active';
            return view('backend.admin.dashboard.index', $data);
        } else {
            abort(401);
        }
    }
    public function dashboardOrderChartCount(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                $month = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
                $pendingOrder    = [];
                $processingOrder = [];
                $sellOrder       = [];
                foreach ($month as $value) {
                    $pendingOrder[]    = Order::where('status', 0)->whereMonth('updated_at', '=', $value)->count();
                    $processingOrder[] = Order::where('status', 1)->whereMonth('updated_at', '=', $value)->count();
                    $sellOrder[]       = Order::where('status', 3)->whereMonth('updated_at', '=', $value)->count();
                }
                return response()->json([
                    'pendingOrder'    => $pendingOrder,
                    'processingOrder' => $processingOrder,
                    'sellOrder'       => $sellOrder,
                ]);
            }
        } else {
            abort(401);
        }
    }

    public function dashboardProductsChartCount(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                $month = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
                $pendingproducts = [];
                $activeproducts  = [];
                foreach ($month as $value) {
                    $pendingproducts[]    = Product::where('status', '0')->whereMonth('updated_at', '=', $value)->count();
                    $activeproducts[] = Product::where('status', '1')->whereMonth('updated_at', '=', $value)->count();
                }
                return response()->json([
                    'pendingproducts' => $pendingproducts,
                    'activeproducts'  => $activeproducts,
                ]);
            }
        } else {
            abort(401);
        }
    }

    public function orderReview()
    {
        if (Gate::allows('isAdmin')) {
            $this->setPageTitle('Order Reviews');
            $data['activeParentOrderMenu']   = 'active';
            $data['showOrderMenu']           = 'show';
            $data['activeOrderReview']       = 'active';
            return view('backend.admin.reviews.index', $data);
        } else {
            abort(401);
        }
    }

    public function create()
    {
        if (Gate::allows('isAdmin')) {
            $this->setPageTitle(__f('Customer Supplier Create Title'));
            return view('backend.admin.dashboard.create');
        } else {
            abort(401);
        }
    }

    public function customerSupplier(CustomerSupplierRequest $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                if ($request->usertype == 'customer') {
                    $getcustomer = Customer::where('phone', $request->phone_number)->first();
                    if (!$getcustomer) {
                        if ($request->file('userimage')) {
                            $image = $this->imageUpload($request->file('userimage'), 'images/customer/', null, null);
                        } else {
                            $image = null;
                        }
                        Customer::create([
                            'customer_name' => $request->name,
                            'phone'         => $request->phone_number,
                            'address'       => null,
                            'previous_due'  => $request->previous_due ?? 0,
                            'status'        => '1',
                            'photo'         => $image,
                        ]);
                    } else {
                        return response()->json([
                            'status'  => 'error',
                            'message' => __f('Customer already exists Message'),
                        ]);
                    }
                    return response()->json([
                        'status'  => 'success',
                        'message' => __f('Customer Create Success Message'),
                    ]);
                } else {
                    $getsupplier = Supplier::where('phone', $request->phone_number)->first();
                    if (!$getsupplier) {
                        if ($request->file('userimage')) {
                            $image = $this->imageUpload($request->file('userimage'), 'images/supplier/', null, null);
                        } else {
                            $image = null;
                        }

                        Supplier::create([
                            'group'           => null,
                            'name'            => $request->name,
                            'company_name'    => null,
                            'phone'           => $request->phone_number,
                            'photo'           => $image,
                            'email'           => null,
                            'address'         => null,
                            'vat'             => null,
                            'city'            => null,
                            'state'           => null,
                            'postal_code'     => null,
                            'country'         => null,
                            'status'          => null,
                            'previous_due'    => $request->previous_due ?? 0,
                        ]);
                    } else {
                        return response()->json([
                            'status'  => 'error',
                            'message' => __f('Supplier already exists Message'),
                        ]);
                    }
                    return response()->json([
                        'status'  => 'success',
                        'message' => __f('Supplier Create Success Message'),
                    ]);
                }
            }
        } else {
            abort(401);
        }
    }

    public function payBillCustomerSupplier($id, $role)
    {
        if (Gate::allows('isAdmin')) {
            $this->setPageTitle(__f('Customer Supplier Payment Title'));
            $data['role']       = $role;

            $todaycollectamount = PayBillCustomerSupplier::where('role', 'customer')->whereDate('pay_date', now())->sum('pay_amount');
            $boxCashSell        = PayBillCustomerSupplier::where('role', 'cash_sell')->whereDate('pay_date', now())->sum('total_amount');
            $boxCashOwneGave    = PayBillCustomerSupplier::where('role', 'owner_gave')->whereDate('pay_date', now())->sum('total_amount');

            $todaypaymentsupplier = PayBillCustomerSupplier::where('role', 'supplier')->whereDate('pay_date', now())->sum('pay_amount');
            $boxCashBuy           = PayBillCustomerSupplier::where('role', 'cash_buy')->whereDate('pay_date', now())->sum('total_amount');
            $boxCashExpence       = PayBillCustomerSupplier::where('role', 'expence')->whereDate('pay_date', now())->sum('total_amount');
            $boxCashOwnerNeil     = PayBillCustomerSupplier::where('role', 'owner_neil')->whereDate('pay_date', now())->sum('total_amount');
            $data['cashboxAmount']= (($todaycollectamount ?? 0) + ($boxCashSell ?? 0) + ($boxCashOwneGave ?? 0)) - (($todaypaymentsupplier ?? 0) + ($boxCashBuy ?? 0) + ($boxCashExpence ?? 0) + ($boxCashOwnerNeil ?? 0));
            
            if ($role == 'customer') {
                $data['user'] = Customer::with('lastpayment')->findOrFail($id);
            } else {
                $data['user'] = Supplier::with('lastpayment')->findOrFail($id);
            }
            return view('backend.admin.dashboard.paybill', $data);
        } else {
            abort(401);
        }
    }

    public function payBillCustomerSupplierStore(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                // if ($request->message == 1) {
                //     dd($request->all());
                // }


                $payDate = Carbon::parse($request->pay_date)->startOfDay();
                $today = now()->startOfDay();
                $currentTime = now()->format('H:i:s'); 
                $finalDateTime = Carbon::parse($request->pay_date . ' ' . $currentTime);

                if ($payDate->lt($today)) {
                    return response()->json([
                        'status' => 'error',
                        'message' => "Your Can't Add In Previous Date",
                    ]);
                } else {
                    if ($request->file('image')) {
                        $image = $this->imageUpload($request->file('image'), 'images/pay-bill/', null, null);
                    } else {
                        $image = null;
                    }

                    if ($request->role == 'customer') {
                        $paymentAmount = $request->pay_amount;
                        $customer = Customer::with('lastpayment')->findOrFail($request->user_id);
                        $payForDue = min($customer->previous_due, $paymentAmount);
                        $customer->update([
                            'previous_due' => $customer->previous_due - $payForDue,
                        ]);
                        $paymentAmount -= $payForDue;
                        $lastDue = $customer->lastpayment->due ?? 0;
                        $paymentAmount -= $lastDue;
                        $currentDue = $request->total_amount - $paymentAmount;
                        PayBillCustomerSupplier::create([
                            'role'         => $request->role,
                            'user_id'      => $request->user_id,
                            'total_amount' => $request->total_amount ?? 0,
                            'pay_amount'   => $request->pay_amount ?? 0,
                            'due'          => $currentDue,
                            'pay_date'     => $finalDateTime,
                            'image'        => $image,
                            'details'      => $request->details,
                        ]);
                    } else {
                        $paymentAmount = $request->total_amount;
                        $supplier = Supplier::with('lastpayment')->findOrFail($request->user_id);
                        $payForDue = min($supplier->previous_due, $paymentAmount);
                        $supplier->update([
                            'previous_due' => $supplier->previous_due - $payForDue,
                        ]);
                        $paymentAmount -= $payForDue;
                        $lastDue = $supplier->lastpayment->due ?? 0;
                        $paymentAmount -= $lastDue;
                        $currentDue = $request->pay_amount - $paymentAmount;

                        PayBillCustomerSupplier::create([
                            'role'         => $request->role,
                            'user_id'      => $request->user_id,
                            'total_amount' => $request->pay_amount ?? 0,
                            'pay_amount'   => $request->total_amount ?? 0,
                            'due'          => $currentDue,
                            'pay_date'     => $finalDateTime,
                            'image'        => $image,
                            'details'      => $request->details,
                        ]);

                        if($request->uppercash_sell && $request->uppercash_sell != null){
                            PayBillCustomerSupplier::create([
                                'role'         => 'cash_sell',
                                'user_id'      => Auth::id(),
                                'total_amount' => $request->uppercash_sell ?? 0,
                                'pay_amount'   => $request->pay_amount ?? 0,
                                'due'          => 0,
                                'pay_date'     => $finalDateTime,
                                'image'        => null,
                                'details'      => null,
                            ]);
                        };

                        if($request->uppercash_owner_give && $request->uppercash_owner_give != null){
                            PayBillCustomerSupplier::create([
                                'role'         => 'owner_gave',
                                'user_id'      => Auth::id(),
                                'total_amount' => $request->uppercash_owner_give ?? 0,
                                'pay_amount'   => $request->pay_amount ?? 0,
                                'due'          => 0,
                                'pay_date'     => $finalDateTime,
                                'image'        => null,
                                'details'      => null,
                            ]);
                        };
                    }
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Payment Successfully',
                    ]);
                }
            }
        } else {
            abort(401);
        }
    }

    public function payBill($role)
    {
        if (Gate::allows('isAdmin')) {
            $this->setPageTitle(__f('Customer Supplier Payment Title'));
            $data['role'] = $role;
            $todaycollectamount = PayBillCustomerSupplier::where('role', 'customer')->whereDate('pay_date', now())->sum('pay_amount');
            $boxCashSell        = PayBillCustomerSupplier::where('role', 'cash_sell')->whereDate('pay_date', now())->sum('total_amount');
            $boxCashOwneGave    = PayBillCustomerSupplier::where('role', 'owner_gave')->whereDate('pay_date', now())->sum('total_amount');

            $todaypaymentsupplier = PayBillCustomerSupplier::where('role', 'supplier')->whereDate('pay_date', now())->sum('pay_amount');
            $boxCashBuy           = PayBillCustomerSupplier::where('role', 'cash_buy')->whereDate('pay_date', now())->sum('total_amount');
            $boxCashExpence       = PayBillCustomerSupplier::where('role', 'expence')->whereDate('pay_date', now())->sum('total_amount');
            $boxCashOwnerNeil     = PayBillCustomerSupplier::where('role', 'owner_neil')->whereDate('pay_date', now())->sum('total_amount');
            $data['cashboxAmount']= (($todaycollectamount ?? 0) + ($boxCashSell ?? 0) + ($boxCashOwneGave ?? 0)) - (($todaypaymentsupplier ?? 0) + ($boxCashBuy ?? 0) + ($boxCashExpence ?? 0) + ($boxCashOwnerNeil ?? 0));
            return view('backend.admin.dashboard.cashbook', $data);
        } else {
            abort(401);
        }
    }
    public function payBillStore(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->file('image')) {
                $image = $this->imageUpload($request->file('image'), 'images/pay-bill/', null, null);
            } else {
                $image = null;
            }

            $currentTime = now()->format('H:i:s'); 
            $finalDateTime = Carbon::parse($request->pay_date . ' ' . $currentTime);

            PayBillCustomerSupplier::create([
                'role'         => $request->role,
                'user_id'      => Auth::id(),
                'total_amount' => $request->total_amount ?? 0,
                'pay_amount'   => $request->pay_amount ?? 0,
                'due'          => 0,
                'pay_date'     => $finalDateTime,
                'image'        => $image,
                'details'      => $request->details,
            ]);

            if($request->uppercash_sell && $request->uppercash_sell != null){
                PayBillCustomerSupplier::create([
                    'role'         => 'cash_sell',
                    'user_id'      => Auth::id(),
                    'total_amount' => $request->uppercash_sell ?? 0,
                    'pay_amount'   => $request->pay_amount ?? 0,
                    'due'          => 0,
                    'pay_date'     => $finalDateTime,
                    'image'        => null,
                    'details'      => null,
                ]);
            };

            if($request->uppercash_owner_give && $request->uppercash_owner_give != null){
                PayBillCustomerSupplier::create([
                    'role'         => 'owner_gave',
                    'user_id'      => Auth::id(),
                    'total_amount' => $request->uppercash_owner_give ?? 0,
                    'pay_amount'   => $request->pay_amount ?? 0,
                    'due'          => 0,
                    'pay_date'     => $finalDateTime,
                    'image'        => null,
                    'details'      => null,
                ]);
            };
            return response()->json([
                'status' => 'success',
                'message' => 'Payment Successfully',
            ]);
        } else {
            abort(401);
        }
    }
    public function cashboxAmountCheck()
    {
        if (Gate::allows('isAdmin')) {
            $this->setPageTitle(__f('Customer Supplier Payment Title'));
            $todaycollectamount = PayBillCustomerSupplier::where('role', 'customer')->whereDate('pay_date', now())->sum('pay_amount');
            $boxCashSell        = PayBillCustomerSupplier::where('role', 'cash_sell')->whereDate('pay_date', now())->sum('total_amount');
            $boxCashOwneGave    = PayBillCustomerSupplier::where('role', 'owner_gave')->whereDate('pay_date', now())->sum('total_amount');

            $todaypaymentsupplier = PayBillCustomerSupplier::where('role', 'supplier')->whereDate('pay_date', now())->sum('pay_amount');
            $boxCashBuy           = PayBillCustomerSupplier::where('role', 'cash_buy')->whereDate('pay_date', now())->sum('total_amount');
            $boxCashExpence       = PayBillCustomerSupplier::where('role', 'expence')->whereDate('pay_date', now())->sum('total_amount');
            $boxCashOwnerNeil     = PayBillCustomerSupplier::where('role', 'owner_neil')->whereDate('pay_date', now())->sum('total_amount');
            $data['cashboxAmount']= (($todaycollectamount ?? 0) + ($boxCashSell ?? 0) + ($boxCashOwneGave ?? 0)) - (($todaypaymentsupplier ?? 0) + ($boxCashBuy ?? 0) + ($boxCashExpence ?? 0) + ($boxCashOwnerNeil ?? 0));
            return view('backend.admin.dashboard.cashbookcheckaount', $data);
        } else {
            abort(401);
        }
    }
}
