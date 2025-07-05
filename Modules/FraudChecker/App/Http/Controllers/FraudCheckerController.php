<?php

namespace Modules\FraudChecker\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\BDCourierService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;

class FraudCheckerController extends Controller
{

    protected $bdCourierService;

    public function __construct(BDCourierService $bdCourierService)
    {
        $this->bdCourierService = $bdCourierService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            $this->setPageTitle(__f('Fraud Checker Title'));
            $data['activeParentOrderMenu'] = 'active';
            $data['activeFraudMenu']       = 'active';
            $data['showOrderMenu']         = 'show';
            $data['breadcrumb']          = [__f('Admin Dashboard Title') => route('admin.dashboard.index'), __f('Fraud Checker Title') => ''];
            return view('fraudchecker::index', $data);
        } else {
            abort(401);
        }
    }

    public function getHistory(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                $request->validate([
                    'phone' => 'required|regex:/^01[3-9]\d{8}$/'
                ]);
                $phone = $request->input('phone');
                $data['response'] = $this->bdCourierService->getHistoryByPhoneNumber($phone);
                $renderData = view('fraudchecker::curierinforander',$data)->render();
                return response()->json([
                    'status'  => 'success',
                    'data'    => $renderData,
                    'rowdata'    => $data['response'],
                ]);
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
        return view('fraudchecker::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('fraudchecker::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('fraudchecker::edit');
    }

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
