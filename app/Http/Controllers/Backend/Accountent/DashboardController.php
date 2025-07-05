<?php

namespace App\Http\Controllers\Backend\Accountent;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (Gate::allows('isAccountent')) {
            $this->setPageTitle('Dashboard');
            $data['breadcrumb']    = ['Accountent Dashboard' => '',];
            return view('backend.accountent.dashboard.index', $data);
        } else {
            abort(401);
        }
    }
}
