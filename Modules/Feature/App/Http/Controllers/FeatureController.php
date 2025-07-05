<?php

namespace Modules\Feature\App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Feature\App\Models\Feature;
use Yajra\DataTables\Facades\DataTables;
use Modules\Feature\App\Http\Requests\FeatureRequest;
 use Illuminate\Support\Facades\Cache;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            $this->setPageTitle(__f('Feature Title'));
            $data['showSliderMenu']         = 'show';
            $data['activeParentSliderMenu'] = 'active';
            $data['activeFeatureMenu']      = 'active';
            $data['breadcrumb']             = [__f('Admin Dashboard Title') => route('admin.dashboard.index'), __f('Feature Title') => ''];
            return view('feature::index', $data);
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
            $this->setPageTitle(__f('Feature Create Title'));
            $data['showSliderMenu']          = 'show';
            $data['activeParentSliderMenu']  = 'active';
            $data['activeFeatureCreateMenu'] = 'active';
            $data['breadcrumb']              = [__f('Admin Dashboard Title') => route('admin.dashboard.index'), __f('Feature Title') => route('admin.feature.index'), __f('Feature Create Title') => ''];
            return view('feature::create', $data);
        } else {
            abort(401);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeatureRequest $request)
    {
        if ($request->ajax()) {
            Feature::create([
                'title'           => $request->title,
                'description'     => $request->description,
                'status'          => $request->status,
            ]);
            Cache::forget('all_features');
            return response()->json([
                'status' => 'success',
                'message' => __f('Feature Create Success Message')
            ]);
        }
    }


    // get data for list

    public function getData(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                $getData = Feature::latest('id');
                return DataTables::eloquent($getData)
                    ->addIndexColumn()
                    ->filter(function ($query) use ($request) {
                        if (!empty($request->search)) {
                            $query->when($request->search, function ($query, $value) {
                                $query->where('title', 'like', "%{$value}%")
                                    ->orWhere('status', 'like', "%{$value}%");
                            });
                        }
                    })
                    ->addColumn('title', function ($data) {
                        return $data->title;
                    })
                    ->addColumn('description', function ($data) {
                        return $data->description;
                    })
                    ->addColumn('status', function ($data) {
                        return status($data->status);
                    })

                    ->addColumn('action', function ($data) {
                        if ($data->status == '0') {
                            $statusAction = '<a class="dropdown-item align-items-center" href="' . route('admin.feature.status', ['id' => $data->id, 'status' => '1']) . '">
                                                <i class="fa-solid fa-check me-2 text-success"></i>' . __f("Status Publish Title") . '</a>';
                        } else if ($data->status == '1') {
                            $statusAction = '<a class="dropdown-item align-items-center" href="' . route('admin.feature.status', ['id' => $data->id, 'status' => '0']) . '">
                                                <i class="fa-regular fa-hourglass-half me-2 text-warning"></i>' . __f("Status Pending Title") . '</a>';
                        }

                        return '<div class="btn-group dropstart text-end">
                                    <button type="button" class="btn border-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item align-items-center" href="' . route('admin.feature.edit', ['feature' => $data->id]) . '">
                                                <i class="fa-solid fa-pen-to-square me-2 text-primary"></i>' . __f("Edit Title") . '</a>
                                        </li>
                                        <li>' . $statusAction . '</li>
                                        <li>
                                            <button class="dropdown-item align-items-center" onclick="delete_data(' . $data->id . ')">
                                                <i class="fa-solid fa-trash me-2 text-danger"></i>' . __f("Delete Title") . '</button>
                                        </li>
                                        <form action="' . route('admin.feature.delete', ['id' => $data->id]) . '"
                                              id="delete-form-' . $data->id . '" method="DELETE" class="d-none">
                                              @csrf
                                              @method("DELETE")
                                        </form>
                                    </ul>
                                </div>';
                    })
                    ->rawColumns(['status', 'description', 'action'])
                    ->make(true);
            }
        } else {
            abort(401);
        }
    }

    /**
     * Show the specified resource.
     */
    public function featureStatus($id,$status)
    {
        if (Gate::allows('isAdmin')) {
            $getCategory = Feature::where('id', $id)->first();
            $getCategory->update([
                'status' => $status,
            ]);
            Cache::forget('all_features');
            return back()->with('success', __f('Feature Status Change Success Message'));
        } else {
            abort(401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (Gate::allows('isAdmin')) {
            $this->setPageTitle(__f('Feature Edit Title'));
            $data['showSliderMenu']         = 'show';
            $data['activeParentSliderMenu'] = 'active';
            $data['activeFeatureMenu']      = 'active';
            $data['breadcrumb']             = [__f('Admin Dashboard Title') => route('admin.dashboard.index'), __f('Feature Title') => route('admin.feature.index'), __f('Feature Edit Title') => ''];
            $data['feature'] = Feature::where('id', $id)->first();
            return view('feature::edit', $data);
        } else {
            abort(401);
        };
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeatureRequest $request,$id)
    {
        if (Gate::allows('isAdmin')) {
            $getcategory = Feature::where('id', $id)->first();

            $getcategory->update([
                'title'           => $request->title,
                'description'     => $request->description,
                'status'          => $request->status,
            ]);
            Cache::forget('all_features');
            return response()->json([
                'status' => 'success',
                'message' => __f('Feature Update Success Message'),
            ]);
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
            $getCategory = Feature::where('id', $id)->first();
            $getCategory->delete();
            Cache::forget('all_features');
            return back()->with('success', __f('Feature Delete Success Message'),);
        } else {
            abort(401);
        }
    }
}
