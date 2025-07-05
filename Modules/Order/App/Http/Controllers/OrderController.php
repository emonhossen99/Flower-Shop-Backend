<?php

namespace Modules\Order\App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use App\Services\PathaoCourierService;
use Modules\Order\App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Artisan;
use Yajra\DataTables\Facades\DataTables;
use Enan\PathaoCourier\Facades\PathaoCourier;
use Enan\PathaoCourier\Requests\PathaoOrderRequest;
use SteadFast\SteadFastCourierLaravelPackage\Facades\SteadfastCourier;

class OrderController extends Controller
{
    private $pathaoService;

    public function __construct(PathaoCourierService $pathaoService)
    {
        $this->pathaoService = $pathaoService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            $this->setPageTitle(__f('Orders Title'));
            $data['activeParentOrderMenu'] = 'active';
            $data['activeOrderMenu']       = 'active';
            $data['showOrderMenu']         = 'show';
            $data['breadcrumb']          = [__f('Admin Dashboard Title') => route('admin.dashboard.index'), __f('Orders Title') => ''];
            return view('order::index', $data);
        } else {
            abort(401);
        }
    }

    public function getData(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                if ($request->status != null) {
                    $getData = Order::with(['user'])->where('status', $request->status)->latest('id');
                } else {
                    $getData = Order::with(['user'])->latest('id');
                }
                return DataTables::eloquent($getData)
                    ->addIndexColumn()
                    ->filter(function ($query) use ($request) {
                        if (!empty($request->search)) {
                            $query->when($request->search, function ($query, $value) {
                                $query->where('invoice_id', 'like', "%{$value}%")
                                    ->orWhere('couriertrakingid', 'like', "%{$value}%")
                                    ->orWhere('status', 'like', "%{$value}%")
                                    ->orWhereHas('user', function ($query) use ($value) {
                                        $query->where('fname', 'like', "%{$value}%")
                                            ->orWhere('lname', 'like', "%{$value}%")
                                            ->orWhere('email', 'like', "%{$value}%")
                                            ->orWhere('phone', 'like', "%{$value}%");
                                    });
                            });
                        }
                    })
                    ->addColumn('checkbox', function ($data) {
                        return '<input type="checkbox" class="row-checkbox" value="' . $data->id . '">';
                    })
                    // ->addColumn('invoice_id', function ($data) {
                    //     return '#' . $data->invoice_id;
                    // })
                    ->addColumn('name', function ($data) {
                        return $data->customer ?? '----';
                    })
                    ->addColumn('address', function ($data) {
                        return $data->adress ?? '----';
                    })
                    ->addColumn('email', function ($data) {
                        return $data->user->email ?? '----';
                    })
                    ->addColumn('phone', function ($data) {
                        return $data->phone ?? '----';
                    })
                    ->addColumn('amount', function ($data) {
                        return $data->amount ?? '---';
                    })
                    ->addColumn('quantity', function ($data) {
                        return $data->quantity ?? '---';
                    })
                    ->addColumn('discount', function ($data) {
                        return $data->discount ?? '---';
                    })
                    ->addColumn('couriername', function ($data) {
                        return $data->couriertype ?? '----';
                    })
                    // ->addColumn('couriertrakingid', function ($data) {
                    //     return $data->couriertrakingid ?? '----';
                    // })
                    // ->addColumn('paymnetstatus', function ($data) {
                    //     return $data->payment_status;
                    // })
                    ->addColumn('orderdate', function ($data) {
                        return $data->created_at->format('d-m-Y');
                    })
                    ->addColumn('status', function ($data) {
                        // '1 = Pending , 2 = Processing , 3 = On The Way , 4 = On Hold , 5 = Complete , 6 = Cancel'
                        if ($data->status == '1') {
                            $statusAction = '<a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '2']) . '"><i class="fa-solid fa-list-check text-success me-2"></i> '.__f('Processing Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '3']) . '"><i class="fa-solid fa-truck-fast me-2 text-secondary"></i> '.__f('On The Way Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '4']) . '"><i class="fa-solid fa-pause me-2 text-warning"></i>  '.__f('On Hold Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '5']) . '"><i class="fa-solid fa-flag me-2 text-primary"></i>  '.__f('Complate Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '6']) . '"><i class="fa-solid fa-ban me-2 text-danger"></i>  '.__f('Cancel Title').'</a>';
                        } else if ($data->status == '2') {
                            $statusAction = '<a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '1']) . '"><i class="fa-solid fa-hourglass-half text-info me-2"></i>  '.__f('Pending Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '3']) . '"><i class="fa-solid fa-truck-fast me-2 text-secondary"></i> '.__f('On The Way Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '4']) . '"><i class="fa-solid fa-pause me-2 text-warning"></i>  '.__f('On Hold Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '5']) . '"><i class="fa-solid fa-flag me-2 text-primary"></i>  '.__f('Complate Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '6']) . '"><i class="fa-solid fa-ban me-2 text-danger"></i>  '.__f('Cancel Title').'</a>';
                        } else if ($data->status == '3') {
                            $statusAction = '<a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '2']) . '"><i class="fa-solid fa-list-check text-success me-2"></i> '.__f('Processing Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '1']) . '"><i class="fa-solid fa-hourglass-half text-info me-2"></i>  '.__f('Pending Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '4']) . '"><i class="fa-solid fa-pause me-2 text-warning"></i>  '.__f('On Hold Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '5']) . '"><i class="fa-solid fa-flag me-2 text-primary"></i>  '.__f('Complate Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '6']) . '"><i class="fa-solid fa-ban me-2 text-danger"></i>  '.__f('Cancel Title').'</a>';
                        } else if ($data->status == '4') {
                            $statusAction = '<a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '2']) . '"><i class="fa-solid fa-list-check text-success me-2"></i> '.__f('Processing Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '1']) . '"><i class="fa-solid fa-hourglass-half text-info me-2"></i>  '.__f('Pending Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '3']) . '"><i class="fa-solid fa-truck-fast me-2 text-secondary"></i> '.__f('On The Way Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '5']) . '"><i class="fa-solid fa-flag me-2 text-primary"></i>  '.__f('Complate Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '6']) . '"><i class="fa-solid fa-ban me-2 text-danger"></i>  '.__f('Cancel Title').'</a>';
                        } else if ($data->status == '5') {
                            $statusAction = '<a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '2']) . '"><i class="fa-solid fa-list-check text-success me-2"></i> '.__f('Processing Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '1']) . '"><i class="fa-solid fa-hourglass-half text-info me-2"></i>  '.__f('Pending Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '3']) . '"><i class="fa-solid fa-truck-fast me-2 text-secondary"></i> '.__f('On The Way Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '4']) . '"><i class="fa-solid fa-pause me-2 text-warning"></i>  '.__f('On Hold Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '6']) . '"><i class="fa-solid fa-ban me-2 text-danger"></i>  '.__f('Cancel Title').'</a>';
                        } else {
                            $statusAction = '<a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '2']) . '"><i class="fa-solid fa-list-check text-success me-2"></i> '.__f('Processing Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '1']) . '"><i class="fa-solid fa-hourglass-half text-info me-2"></i>  '.__f('Pending Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '3']) . '"><i class="fa-solid fa-truck-fast me-2 text-secondary"></i> '.__f('On The Way Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '4']) . '"><i class="fa-solid fa-pause me-2 text-warning"></i>  '.__f('On Hold Title').'</a><a class="dropdown-item align-items-center" href="' . route('admin.order.status', ['id' => $data->id, 'status' => '5']) . '"><i class="fa-solid fa-flag me-2 text-primary"></i>  '.__f('Complate Title').'</a>';
                        }
                        return ' <div class="btn-group dropbottom text-end">
                                    <button type="button" class="btn border-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        '.orderStatus($data->status).'
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>' . $statusAction . '</li>
                                    </ul>
                                </div>';
                    })
                    ->addColumn('action', function ($data) {
                        return ' <div class="btn-group dropstart text-end">
                                    <button type="button" class="btn border-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                         <li>
                                            <a class="dropdown-item align-items-center" href="' . route('admin.order.edit', ['id' => $data->id]) . '">
                                           <i class="fa-solid fa-pen-to-square me-2 text-primary"></i>'. __f("Edit Title") .'</a>
                                        </li>
                                       <li> <a onclick="FraudCheckerMethod(\'' . $data->phone . '\')" class="dropdown-item align-items-center">
                                            <i class="fa-solid fa-chart-column me-2 text-warning"></i>'.__f('Courier History Title').'
                                        </a></li>
                                         <li>
                                            <a class="dropdown-item align-items-center" href="' . route('admin.order.invoice', ['id' => $data->invoice_id]) . '">

                                             <i class="fa-regular fa-eye me-2 text-info"></i>'. __f("View Title") .'</a>
                                        </li>
                                        <li>
                                            <button class="dropdown-item align-items-center" onclick="delete_data(' . $data->id . ')">
                                                <i class="fa-solid fa-trash me-2 text-danger"></i>'. __f("Delete Title") .'</button>
                                        </li>
                                        <form action="' . route('admin.order.delete', ['id' => $data->id]) . '"
                                              id="delete-form-' . $data->id . '" method="DELETE" class="d-none">
                                              @csrf
                                              @method("DELETE")
                                        </form>
                                    </ul>
                                </div>';
                    })
                    ->rawColumns(['checkbox', 'running_image', 'threed_image', 'status', 'action'])
                    ->make(true);
            }
        } else {
            abort(401);
        }
    }

    public function invoiceShow($invoice_id)
    {

        if (Gate::allows('isAdmin')) {
            $this->setPageTitle(__f('Order Details Title'));
            $data['activeParentOrderMenu'] = 'active';
            $data['activeOrderMenu']       = 'active';
            $data['showOrderMenu']         = 'show';
            $data['breadcrumb']            = [__f('Admin Dashboard Title') => route('admin.dashboard.index'), __f('Orders Title') => route('admin.order.index'), __f('Order Details Title') => ''];
            $data['orderinfo']             = Order::with(['totalearnings', 'user'])->where('invoice_id', $invoice_id)->first();
            return view('order::invoice', $data);
        } else {
            abort(401);
        }
    }

    public function orderEdit($id)
    {
        if (Gate::allows('isAdmin')) {
            $this->setPageTitle(__f('Order Edit Title'));
            $data['orderinfo']             = Order::with(['totalearnings', 'user'])->where('id', $id)->first();
            $tokenResponse                 = $this->pathaoService->getTokenResponse();
            $token                         = $tokenResponse->json('access_token');
            $citylist                      = Http::withToken($token)->get(env('PATHAO_API_URL') . '/aladdin/api/v1/city-list');
            $zonelist                      = Http::withToken($token)->get(env('PATHAO_API_URL') . "/aladdin/api/v1/cities/{$data['orderinfo']->cityid}/zone-list");
            $data['cityLists']             = $citylist->json();
            $data['zoneLists']             = $zonelist->json();
            $data['activeParentOrderMenu'] = 'active';
            $data['activeOrderMenu']       = 'active';
            $data['showOrderMenu']         = 'show';
            $data['breadcrumb']            = [__f('Admin Dashboard Title') => route('admin.dashboard.index'),  __f('Orders Title') => route('admin.order.index'), __f('Order Edit Title') => ''];
            return view('order::orderedit', $data);
        } else {
            abort(401);
        }
    }

    public function orderZoneList($id)
    {
        if (Gate::allows('isAdmin')) {
            $tokenResponse = $this->pathaoService->getTokenResponse();
            $token = $tokenResponse->json('access_token');
            $zonelist = Http::withToken($token)->get(env('PATHAO_API_URL') . "/aladdin/api/v1/cities/$id/zone-list");
            $zoneLists = $zonelist->json();
            $datalist = '';
            if ($zoneLists['data']['data'] != null) {
                $datalist .= '<option value="">Select Zone</option>';
                foreach ($zoneLists['data']['data'] as $zone) {
                    $datalist .= '<option value="' . $zone['zone_id'] . '">' . $zone['zone_name'] . '</option>';
                }
            }
            return response()->json([
                'status' => 'success',
                'data'   => $datalist,
            ]);
        } else {
            abort(401);
        }
    }

    public function delete($id)
    {
        if (Gate::allows('isAdmin')) {
            $getProject = Order::where('id', $id)->first();
            $getProject->delete();
            return back()->with('success', 'order Delete Successfully');
        } else {
            abort(401);
        }
    }

    public function orderStatus($id, $status)
    {
        if (Gate::allows('isAdmin')) {
            $getProject = Order::where('id', $id)->first();
            $getProject->update([
                'status' => $status,
            ]);
            return back()->with('success', 'Order Status Change Successfully');
        } else {
            abort(401);
        }
    }

    public function singleProductDelete($id)
    {
        if (Gate::allows('isAdmin')) {
            $product = OrderDetail::with(['order'])->where('id', $id)->first();
            if ($product) {
                if ($product->order) {
                    $success = $product->order->update([
                        'amount'  => $product->order->amount - $product->grandtotal,
                        'quantity' => $product->order->quantity - $product->quantity,
                    ]);
                    if ($success) {
                        $product->delete();
                        return response()->json([
                            'status' => 'success',
                            'message' => 'Order delete successfully'
                        ]);
                    }
                }
            }
        } else {
            abort(401);
        }
    }

    public function priceupdate(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                $orderDetails = OrderDetail::where('id', $request->order_details_id)->first();
                $successUpdate = $orderDetails->update([
                    'quantity'   => $request->quantity,
                    'amount'     => $request->price,
                    'grandtotal' => $request->price * $request->quantity,
                ]);
                if ($successUpdate) {
                    $order =  Order::with(['totalearnings'])->where('id', $request->order_id)->first();
                    if ($order->totalearnings) {
                        $totalAmount = 0;
                        $totalQnt = 0;
                        foreach ($order->totalearnings as $orderdetails) {
                            $totalAmount += $orderdetails->grandtotal;
                            $totalQnt += $orderdetails->quantity;
                        }
                        $order->update([
                            'amount'   => $totalAmount,
                            'quantity' => $totalQnt,
                            'discount' => $request->discount,
                            'charge'   => $request->delivarycharge,
                        ]);
                        return response()->json([
                            'status'  => 'success',
                            'totalamount' => $totalAmount,
                        ]);
                    }
                }
            }
        } else {
            abort(401);
        }
    }

    public function discountupdate(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                $order =  Order::where('id', $request->order_id)->first();
                $update = $order->update([
                    'discount' => $request->discount,
                ]);
                if ($update) {
                    return response()->json([
                        'status'      => 'success',
                        'totalamount' => $order->amount,
                    ]);
                }
            }
        } else {
            abort(401);
        }
    }

    public function chargeupdate(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                $order =  Order::where('id', $request->order_id)->first();
                $update = $order->update([
                    'charge' => $request->charge,
                ]);
                if ($update) {
                    return response()->json([
                        'status'      => 'success',
                        'totalamount' => $order->amount,
                    ]);
                }
            }
        } else {
            abort(401);
        }
    }

    public function orderUpdate(OrderRequest $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                $order = Order::where('id', $request->order_id)->first();
                if ($order) {
                    $ordersuccess = $order->update([
                        'pickdate'    => $request->pickdate,
                        'adress'      => $request->address,
                        'phone'       => $request->customerphone,
                        'customer'    => $request->customername,
                        'couriertype' => $request->couriertype,
                        'note'        => $request->note,
                        'status'      => '2',
                        'cityid'      => $request->selectcity ?? null,
                        'zoneid'      => $request->selectzone ?? null,
                        'weight'      => $request->weight ?? 0.5,
                    ]);
                    if ($ordersuccess) {
                        return response()->json([
                            'status' => 'success',
                            'message' => 'Order update successfully',
                        ]);
                    }
                }
            }
        } else {
            abort(401);
        }
    }

    public function orderBlukDelete(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                $getorders = Order::whereIn('id', $request->ids)->get();
                if ($getorders) {
                    foreach ($getorders as $order) {
                        $order->delete();
                    }
                    return response()->json([
                        'status'  => 'success',
                        'message' => 'Orders delete successfully',
                    ]);
                } else {
                    return response()->json([
                        'status'  => 'error',
                        'message' => 'Order not found !',
                    ]);
                }
            }
        } else {
            abort(401);
        }
    }

    public function orderBlukStatusChange(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                $getorders = Order::whereIn('id', $request->ids)->get();
                if ($getorders) {
                    foreach ($getorders as $order) {
                        $order->update([
                            'status' => $request->status,
                        ]);
                    }
                    return response()->json([
                        'status'  => 'success',
                        'message' => 'Order status update successfully',
                    ]);
                } else {
                    return response()->json([
                        'status'  => 'error',
                        'message' => 'Order not found !',
                    ]);
                }
            }
        } else {
            abort(401);
        }
    }

    public function orderBlukPrints(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            $ids = $request->ids;
            $data['getorders'] = Order::whereIn('id', $ids)->get();
            if ($data['getorders']->isNotEmpty()) {
                $pdf = app('dompdf.wrapper');
                $pdf->setPaper('A4');
                $pdf->loadView('order::orderprint', $data);
                return $pdf->download('orders.pdf');
            }
        } else {
            abort(401);
        }
    }

    public function sendToPathao(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                $getorders = Order::whereIn('id', $request->ids)->get();
                if ($getorders) {
                    foreach ($getorders as $order) {
                        if ($order->status == '3') {
                            $withoutdiscount = $order->amount +  $order->charge;
                            $grandtotal = $withoutdiscount - $order->discount;
                            $orderData = [
                                'sender_name'       => env('PATHAO_SENDER_NAME'),
                                'sender_phone'      => env('PATHAO_SENDER_PHONE'),
                                'store_id'          => env('PATHAO_STORE_ID'),
                                'merchant_order_id' => $order->id,
                                'recipient_name'    => $order->customer,
                                'recipient_phone'   => $order->phone,
                                'recipient_address' => $order->adress,
                                'recipient_city'    => $order->cityid,
                                'recipient_zone'    => $order->zoneid,
                                'amount_to_collect' => $grandtotal,
                                'delivery_type'     => 48,
                                'item_type'         => 2,
                                'item_weight'       => $order->weight ?? 0.5,
                                'item_quantity'     => (int) $order->quantity,
                                'delivery_charge'   => $order->charge,
                                'discount_amount'   => $order->discount,
                            ];
                            $orderRequest = new PathaoOrderRequest($orderData);
                            $response = PathaoCourier::CREATE_ORDER($orderRequest);
                            if (isset($response['data']['data']['consignment_id'])) {
                                $consignmentId = $response['data']['data']['consignment_id'];
                                $order->update([
                                    'couriertrakingid' => $consignmentId,
                                    'couriertype'      => 'Pathao',
                                ]);
                            } else {
                                return response()->json([
                                    'status' => 'error',
                                    'error'  => $response['data'],
                                ]);
                            }
                        }
                    }
                    return response()->json([
                        'status'  => 'success',
                        'message' => 'Order send to pathao , check our pathao dashboard',
                    ]);
                } else {
                    return response()->json([
                        'status'  => 'error',
                        'message' => 'Order not found !',
                    ]);
                }
            }
        } else {
            abort(401);
        }
    }

    public function sendToSteadFast(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                $getorders = Order::whereIn('id', $request->ids)->get();
                if ($getorders) {
                    foreach ($getorders as $order) {
                        if ($order->status == '3') {
                            $withoutdiscount = $order->amount +  $order->charge;
                            $grandtotal = $withoutdiscount - $order->discount;
                            $orderData = [
                                'invoice'           => $order->invoice_id,
                                'recipient_name'    => $order->customer,
                                'recipient_phone'   => $order->phone,
                                'recipient_address' => $order->adress,
                                'cod_amount'        => $grandtotal,
                                'note'              => $order->note ?? '',
                            ];
                            $response = SteadfastCourier::placeOrder($orderData);
                            if ($response) {
                                $trackingCode = $response['consignment']['tracking_code'];
                                $order->update([
                                    'couriertrakingid' => $trackingCode,
                                    'couriertype'      => 'Stead Fast',
                                ]);
                            }
                        }
                    }
                    return response()->json([
                        'status'  => 'success',
                        'message' => 'Order send to stead fast , check our stead fast dashboard',
                    ]);
                } else {
                    return response()->json([
                        'status'  => 'error',
                        'message' => 'Order not found !',
                    ]);
                }
            }
        } else {
            abort(401);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // user save


    }
    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('order::show');
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
