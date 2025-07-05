<?php

namespace Modules\DatabaseReset\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DatabaseResetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            $this->setPageTitle(__f('Database List Title'));
            $data['activeDatabaseResetMenu'] = 'active';
            $data['activeDatabaseListMenu']  = 'active';
            $data['showDatabaseResetMenu']   = 'show';
            $data['breadcrumb']           = [__f('Admin Dashboard Title') => route('admin.dashboard.index'), __f('Database List Title') => ''];
            return view('databasereset::index', $data);
        } else {
            abort(401);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('databasereset::create');
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
        return view('databasereset::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('databasereset::edit');
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
        if (Gate::allows('isAdmin')) {
            if ($id == 'users') {
                DB::table($id)->whereNotIn('role_id',[1,2])->delete();
            } else {
                DB::table($id)->delete();
            }
            return back()->with('success','Data Reset Successfully');
        } else {
            abort(401);
        }
    }
}
