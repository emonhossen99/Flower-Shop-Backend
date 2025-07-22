<?php

namespace Modules\Coupon\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SendPasswordMail;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Modules\Coupon\App\Http\Requests\CouponRequest;
use Modules\Coupon\App\Http\Requests\OrderRequest;
use Modules\Coupon\App\Models\Coupon;
use Modules\Coupon\App\Models\CouponUses;
use Yajra\DataTables\Facades\DataTables;
use Mpdf\Mpdf;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            $this->setPageTitle(__f('Coupon List Title'));
            $data['showCouponMenu']       = 'show';
            $data['activeCouponMenu']     = 'active';
            $data['activeCouponListMenu'] = 'active';
            $data['breadcrumb']           = [__f('Admin Dashboard Title') => route('admin.dashboard.index'), __f('Coupon List Title') => '',];
            return view('coupon::index', $data);
        } else {
            abort(401);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::allows('isAdmin')) {
            $this->setPageTitle(__f('Coupon Create Title'));
            $data['showCouponMenu']         = 'show';
            $data['activeCouponMenu']       = 'active';
            $data['activeCreateCouponMenu'] = 'active';
            $data['breadcrumb']             = [__f('Admin Dashboard Title') => route('admin.dashboard.index'), __f('Coupon List Title') => route('admin.coupon.index'), __f('Coupon Create Title') => '',];
            return view('coupon::create', $data);
        } else {
            abort(401);
        }
    }

    public function getData(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                $getData = Coupon::latest('id');
                return DataTables::eloquent($getData)
                    ->addIndexColumn()
                    ->filter(function ($query) use ($request) {
                        if (!empty($request->search)) {
                            $query->when($request->search, function ($query, $value) {
                                $query->where('name', 'like', "%{$value}%")
                                    ->orWhere('code', 'like', "%{$value}%")
                                    ->orWhere('status', 'like', "%{$value}%");
                            });
                        }
                    })
                    ->addColumn('name', function ($data) {
                        return $data->name;
                    })
                    ->addColumn('discount_amount', function ($data) {
                        return $data->discount_amount ?? 0;
                    })
                    ->addColumn('code', function ($data) {
                        return $data->code;
                    })
                    ->addColumn('type', function ($data) {
                        return coupontype($data->type);
                    })
                    ->addColumn('use_limit', function ($data) {
                        return $data->limit ?? '<span class="badge bg-success text-white">' . __f('Unlimited Title') . '</span>';
                    })
                    ->addColumn('start_date', function ($data) {
                        return  $data->start_date ? date('d F, y', strtotime($data->start_date))  :  '<span class="badge bg-success text-white">' . __f('Active After Creation Title') . '</span>';
                    })
                    ->addColumn('end_date', function ($data) {
                        return $data->end_date ? date('d F, y', strtotime($data->end_date)) :  '<span class="badge bg-success text-white">' . __f('Valid For Lifetime Title') . '</span>';
                    })
                    ->addColumn('status', function ($data) {
                        return status($data->status);
                    })
                    ->addColumn('action', function ($data) {
                        if ($data->status == '0') {
                            $statusAction = '<a class="dropdown-item align-items-center" href="' . route('admin.coupon.status.change', ['id' => $data->id, 'status' => '1']) . '">
                                                <i class="fa-solid fa-check me-2 text-success"></i>' . __f("Status Publish Title") . '</a>';
                        } else if ($data->status == '1') {
                            $statusAction = '<a class="dropdown-item align-items-center" href="' . route('admin.coupon.status.change', ['id' => $data->id, 'status' => '0']) . '">
                                                <i class="fa-regular fa-hourglass-half me-2 text-warning"></i>' . __f("Status Pending Title") . '</a>';
                        }

                        return '<div class="btn-group dropstart text-end">
                                    <button type="button" class="btn border-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item align-items-center" href="' . route('admin.coupon.edit', ['coupon' => $data->id]) . '">
                                                <i class="fa-solid fa-pen-to-square me-2 text-primary"></i>' . __f("Edit Title") . '</a>
                                        </li>
                                        <li>' . $statusAction . '</li>
                                        <li>
                                            <button class="dropdown-item align-items-center" onclick="delete_data(' . $data->id . ')">
                                                <i class="fa-solid fa-trash me-2 text-danger"></i>' . __f("Delete Title") . '</button>
                                        </li>
                                        <form action="' . route('admin.coupon.delete', ['id' => $data->id]) . '"
                                              id="delete-form-' . $data->id . '" method="DELETE" class="d-none">
                                              @csrf
                                              @method("DELETE")
                                        </form>
                                    </ul>
                                </div>';
                    })
                    ->rawColumns(['type', 'use_limit', 'start_date', 'end_date', 'status', 'action'])
                    ->make(true);
            }
        } else {
            abort(401);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request)
    {
        if (Gate::allows('isAdmin')) {
            Coupon::create([
                'user_id'         => Auth::id(),
                'name'            => $request->name,
                'code'            => $request->code,
                'discount_amount' => $request->discount_amount,
                'type'            => $request->type,
                'limit'           => $request->limit,
                'start_date'      => $request->start_date,
                'end_date'        => $request->end_date,
                'status'          => $request->status,
            ]);
            return response()->json([
                'status'  => 'success',
                'message' => __f('Coupon Create Success Message'),
            ]);
        } else {
            abort(401);
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('coupon::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (Gate::allows('isAdmin')) {
            $this->setPageTitle(__f('Coupon Edit Title'));
            $data['showCouponMenu']         = 'show';
            $data['activeCouponMenu']       = 'active';
            $data['activeCreateCouponMenu'] = 'active';
            $data['editCoupon']             = Coupon::findOrFail($id);
            $data['breadcrumb']             = [__f('Admin Dashboard Title') => route('admin.dashboard.index'), __f('Coupon List Title') => route('admin.coupon.index'), __f('Coupon Edit Title') => '',];
            return view('coupon::edit', $data);
        } else {
            abort(401);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponRequest $request, $id)
    {
        if (Gate::allows('isAdmin')) {
            $coupon  = Coupon::findOrFail($id);

            $coupon->update([
                'name'            => $request->name,
                'code'            => $request->code,
                'discount_amount' => $request->discount_amount,
                'type'            => $request->type,
                'limit'           => $request->limit,
                'start_date'      => $request->start_date,
                'end_date'        => $request->end_date,
                'status'          => $request->status,
            ]);

            return response()->json([
                'status'  => 'success',
                'message' => __f('Coupon Update Success Message'),
            ]);
        } else {
            abort(401);
        }
    }

    // Coupon status update
    public function changeStatus($id, $status)
    {
        if (Gate::allows('isAdmin')) {
            $getcoupon = Coupon::findOrFail($id);
            $getcoupon->update([
                'status' => $status,
            ]);
            Cache::forget('navbar_menus');
            return back()->with('success', __f('Coupon Status Change Message'));
        } else {
            abort(401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Gate::allows('isAdmin')) {
            $coupon = Coupon::findOrFail($id);
            $coupon->delete();
            return back()->with('success',  __f('Coupon Delete Success Message'));
        } else {
            abort(401);
        }
    }

    // match Coupon From Frontend
    public function matchCoupon(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'code' => ['required'],
            ]);

            if (count(session('cart', [])) > 0) {
                $coupon = Coupon::where('name', $request->code)->orWhere('code', $request->code)->first();
                if($coupon){
                    if($coupon->status == '1'){
                        $useCount = CouponUses::where('coupon_id', $coupon->id)->count();
                        $today = Carbon::today();
                        if ($coupon->limit != null && $coupon->limit != 0) {
                            if ($useCount >= $coupon->limit) {
                                return response()->json([
                                    'status' => 'warning',
                                    'message' => __f('Coupon Limit Use Warning Message')
                                ]);
                            }
                        }

                        if ($coupon->start_date != null) {
                            if ($today->lt(Carbon::parse($coupon->start_date))) {
                                return response()->json([
                                    'status' => 'warning',
                                    'message' => __f('Coupon Not Yet Ative Warning Message')
                                ]);
                            }
                        }

                        if ($coupon->end_date != null) {
                            if ($today->gt(Carbon::parse($coupon->end_date))) {
                                return response()->json([
                                    'status' => 'warning',
                                    'message' => 'This coupon has expired.'
                                ]);
                            }
                        }
                        $subtotal = 0;
                        $subtotal = collect(session('cart', []))->sum(function($item){
                            return $item['price'] * $item['quantity'];
                        });

                        $discountAmount = $coupon->discount_amount ?? 0;

                        if ($coupon->type == '0') {
                            $discount = ($subtotal * $discountAmount) / 100;
                        } else {
                            $discount = $discountAmount;
                        }

                        $grandTotal = $subtotal - $discount;
                        return response()->json([
                            'status'    => 'success',
                            'message'   => __f('Coupon Applied Successfully Message'),
                            'discount'  => $discount,
                            'amount'    => $grandTotal,
                            'coupon_id' => $coupon->id,
                        ]);

                    }else{
                        return response()->json([
                            'status'  => 'warning',
                            'message' => __f('Coupon Pending Warning Message'),
                        ]);
                    }
                }else{
                    return response()->json([
                        'status'  => 'warning',
                        'message' => __f('Coupon Code Not Match Warning Message'),
                    ]);
                }
            } else {
                return response()->json([
                    'status'  => 'warning',
                    'message' => __f('Without Product To Apply Coupon Warning Message'),
                ]);
            }
        }
    }

    public function orderStoreFrontendTwo(OrderRequest $request){
        if($request->ajax()){
            if(count(session('cart', [])) > 0){
                $randomPass     = rand(100000, 999999);
                $invoiceid      = rand(100000, 999999);
                $user           = User::where('email', $request->email)->first();
                $role           = Role::where('slug', 'client_portal')->first();
                $cart           = session()->get('cart', []);
                $totall_price   = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
                $total_quantity = array_sum(array_map(fn($item) => $item['quantity'], $cart));

                if ($request->coupon_id != null) {
                    if ($user && $user->id != null) {
                        $usetoken = CouponUses::where('user_id', $user->id)->where('coupon_id', $request->coupon_id)->first();
                        if ($usetoken != null) {
                            return response()->json([
                                'status'  => 'warning',
                                'message' => __f('Before Use Coupon Warning Message'),
                            ]);
                        }
                    }
                }

                if (!$user) {
                    $user = User::create([
                        'role_id'      => $role->id,
                        'fname'        => $request->fname,
                        'lname'        => $request->lname ?? null,
                        'phone'        => $request->phone,
                        'email'        => $request->email,
                        'password'     => Hash::make($randomPass),
                        'country'      => $request->country ?? null,
                        'house_number' => $request->house_number,
                        'apartment'    => $request->apartment ?? null,
                        'city'         => $request->city ?? null,
                        'state'        => $request->state ?? null,
                        'zip'          => $request->zip ?? null,
                    ]);
                    $mailuserinfo = ['fname' => $request->fname, 'email' => $request->email, 'password' => $randomPass];
                    Mail::to($user->email)->send(new SendPasswordMail($mailuserinfo));
                }else{
                    $user->update([
                        'fname'        => $request->fname,
                        'lname'        => $request->lname ?? null,
                        'country'      => $request->country ?? null,
                        'house_number' => $request->house_number,
                        'apartment'    => $request->apartment ?? null,
                        'city'         => $request->city ?? null,
                        'state'        => $request->state ?? null,
                        'zip'          => $request->zip ?? null,
                    ]);
                }

                if ($request->shipping == config('settings.deliveryinsidedhake')) {
                    $shippingtype = 1;
                } else {
                    $shippingtype = 2;
                }

                $discount = 0;

                if($request->coupon_id != null){
                    $coupon = Coupon::findOrFail($request->coupon_id);
                    $discountAmount = $coupon->discount_amount ?? 0;
                    if ($coupon->type == '0') {
                        $discount = ($totall_price * $discountAmount) / 100;
                    } else {
                        $discount = $discountAmount;
                    }
                    $totall_price = $totall_price - $discount;
                    CouponUses::create([
                        'user_id'   => $user->id,
                        'coupon_id' => $request->coupon_id,
                    ]);
                }

                $order = Order::create([
                    'invoice_id'     => $invoiceid,
                    'user_id'        => $user->id,
                    'amount'         => $totall_price,
                    'discount'       => $discount,
                    'charge'         => $request->shipping,
                    'quantity'       => $total_quantity,
                    'payment_status' => 'cod',
                    'adress'         => $request->house_number,
                    'phone'          => $request->phone,
                    'customer'       => $request->fname,
                    'shippingtype'   => $shippingtype,
                    'note'           => $request->note,
                    'status'         => '1',
                ]);

                $orderDetails = [];
                $cart = session()->get('cart', []);
                $orderDetails = [];
                foreach ($cart as $id => $item) {
                    $orderDetails[] =  OrderDetail::create([
                        'invoice_id'    => $invoiceid,
                        'order_id'      => $order->id,
                        'product_id'    => $item['product_id'],
                        'product_name'  => $item['name'],
                        'product_image' => $item['image'],
                        'quantity'      => $item['quantity'],
                        'amount'        => $item['price'],
                        'grandtotal'    => $item['quantity'] * $item['price'],
                        'status'        => '0',
                        'varient'       => $item['product_varient'] ?? null,
                    ]);
                }
                session()->forget('cart');
                return response()->json([
                    'status'   => 'success',
                    'message'  => __f('Order Success Message'),
                    'order_id' => $order->id,
                ]);
            }else{
                return response()->json([
                    'status'  => 'error',
                    'message' => __f('No Product at Cart Warning Message'),
                ]);
            }
        }
    }

    public function orderSuccessTwo($order_id){
        $this->setPageTitle(__f('Order Details Page Title'));
        $data['order'] = Order::with(['user','orderdetails'])->findOrFail($order_id);
        return view('frontend.ordersuccesstwo.ordersuccesstwo',$data);
    }

    public function orderInvoiceDownload($order_id){
        $data['order'] = Order::with(['user','orderdetails'])->findOrFail($order_id);
        return view('frontend.ordersuccesstwo.printinvoice',$data);
    }
}
