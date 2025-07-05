<?php

namespace Modules\Testimonail\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Modules\Testimonail\App\Http\Requests\TestimonailRequest;
use Modules\Testimonail\App\Models\Testimonail;

class TestimonailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            $this->setPageTitle(__f('Testimonail Title'));
            $data['activeParentSliderMenu']    = 'active';
            $data['activeTestimonailListMenu'] = 'active';
            $data['showSliderMenu']            = 'show';
            $data['breadcrumb']                = [__f('Admin Dashboard Title') => route('admin.dashboard.index'), __f('Testimonail Title') => ''];
            return view('testimonail::index', $data);
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
            $this->setPageTitle(__f('Testimonail Create Title'));
            $data['activeParentSliderMenu']     = 'active';
            $data['activeTestimonaiCreateMenu'] = 'active';
            $data['showSliderMenu']             = 'show';
            $data['breadcrumb']             = [__f('Admin Dashboard Title') => route('admin.dashboard.index'), __f('Testimonail Title') => route('admin.testimonail.index'), __f('Testimonail Create Title') => ''];
            return view('testimonail::create', $data);
        } else {
            abort(401);
        }
    }

    public function getData(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                $getData = Testimonail::latest('id');
                return DataTables::eloquent($getData)
                    ->addIndexColumn()
                    ->filter(function ($query) use ($request) {
                        if (!empty($request->search)) {
                            $query->where(function ($query) use ($request) {
                                $query->where('name', 'like', "%{$request->search}%")
                                    ->orWhere('status', 'like', "%{$request->search}%");
                            });
                        }
                    })
                    ->addColumn('name', function ($data) {
                        return $data->name ?? '-----';
                    })
                    ->addColumn('designation', function ($data) {
                        return $data->designation ?? '-----';
                    })
                    ->addColumn('image', function ($data) {
                        if ($data->image != null) {
                            return '<a target="_blank" href="' . asset($data->image) . '"><img id="getDataImage" src="' . asset($data->image) . '" alt="image"></a>';
                        } else {
                            return '<img id="getDataImage" src="' . asset('backend/assets/img/avatars/blank image.jpg') . '" alt="image">';
                        }
                    })

                    ->addColumn('review_text', function ($data) {
                        return '<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#productlocation' . $data->id . '">
                       <i class="fa-solid fa-eye"></i>
                        </button>
                        <div class="modal fade" id="productlocation' . $data->id . '" tabindex="-1" aria-labelledby="productlocationLabel' . $data->id . '" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="productlocationLabel' . $data->id . '">' . __f('User Review Modal Text') . '</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ' . $data->review . '
                            </div>
                            </div>
                        </div>
                        </div>';
                    })
                    ->addColumn('review_star', function ($data) {
                        return reviewstar($data->ratting);
                    })
                    ->addColumn('status', function ($data) {
                        return status($data->status);
                    })
                    ->addColumn('action', function ($data) {
                        if ($data->status == '0') {
                            $statusAction = '<a class="dropdown-item align-items-center" href="' . route('admin.testimonail.status', ['id' => $data->id, 'status' => '1']) . '">
                                                    <i class="fa-solid fa-check me-2 text-success"></i>' . __f("Status Publish Title") . '</a>';
                        } else if ($data->status == '1') {
                            $statusAction = '<a class="dropdown-item align-items-center" href="' . route('admin.testimonail.status', ['id' => $data->id, 'status' => '0']) . '">
                                                    <i class="fa-regular fa-hourglass-half me-2 text-warning"></i>' . __f("Status Pending Title") . '</a>';
                        }

                        return '<div class="btn-group dropstart text-end">
                                        <button type="button" class="btn border-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item align-items-center" href="' . route('admin.testimonail.edit', ['testimonail' => $data->id]) . '">
                                                    <i class="fa-solid fa-pen-to-square me-2 text-primary"></i>' . __f("Edit Title") . '</a>
                                            </li>
                                            <li>' . $statusAction . '</li>
                                            <li>
                                                <button class="dropdown-item align-items-center" onclick="delete_data(' . $data->id . ')">
                                                <i class="fa-solid fa-trash me-2 text-danger"></i>' . __f("Delete Title") . '</button>
                                            </li>
                                        <form action="' . route('admin.testimonail.delete', ['id' => $data->id]) . '"
                                                id="delete-form-' . $data->id . '" method="DELETE" class="d-none">
                                                @csrf
                                                @method("DELETE")
                                        </form>
                                        </ul>
                                    </div>';
                    })
                    ->rawColumns(['review_text', 'review_star', 'status', 'image', 'action'])
                    ->make(true);
            }
        } else {
            abort(401);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestimonailRequest $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                if ($request->file('image')) {
                    $image = $this->imageUpload($request->file('image'), 'images/testimonail/', null, null);
                } else {
                    $image = null;
                }
                Testimonail::create([
                    'name'        => $request->name,
                    'designation' => $request->designation,
                    'ratting'     => $request->ratting,
                    'status'      => $request->status,
                    'review'      => $request->review,
                    'image'       => $image,
                ]);
                Cache::forget('all_testimonail');
                return response()->json([
                    'status' => 'success',
                    'message' => __f('Testimonail Create Success Message')
                ]);
            }
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('testimonail::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (Gate::allows('isAdmin')) {
            $this->setPageTitle(__f('Testimonail Edit Title'));
            $data['activeParentSliderMenu']    = 'active';
            $data['activeTestimonailListMenu'] = 'active';
            $data['showSliderMenu']            = 'show';
            $data['breadcrumb']                = [__f('Admin Dashboard Title') => route('admin.dashboard.index'), __f('Testimonail Title') => route('admin.testimonail.index'), __f('Testimonail Edit Title') => ''];
            $data['testimonail']               = Testimonail::where('id', $id)->first();
            return view('testimonail::edit', $data);
        } else {
            abort(401);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function Update(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                $getTestimonail = Testimonail::where('id', $request->id)->first();
                if ($request->file('image')) {
                    $this->imageDelete($getTestimonail->image);
                    $image = $this->imageUpload($request->file('image'), 'images/testimonail/', null, null);
                } else {
                    $image = $getTestimonail->image;
                }
                $getTestimonail->update([
                    'name'        => $request->name,
                    'designation' => $request->designation,
                    'ratting'     => $request->ratting,
                    'status'      => $request->status,
                    'review'      => $request->review,
                    'image'       => $image,
                ]);

                Cache::forget('all_testimonail');
                return response()->json([
                    'status' => 'success',
                    'message' => __f('Testimonail Update Success Message')
                ]);
            }
        }
    }


    public function testimonailStatus($id, $status)
    {
        if (Gate::allows('isAdmin')) {
            $getTestimonail = Testimonail::where('id', $id)->first();
            $getTestimonail->update([
                'status' => $status,
            ]);
            Cache::forget('all_testimonail');
            return back()->with('success', __f('Testimonail Status Change Message'));
        } else {
            abort(401);
        }
    }

    public function delete($id)
    {

        if (Gate::allows('isAdmin')) {
            $getTestimonail = Testimonail::where('id', $id)->first();
            if($getTestimonail->image != null){
                $this->imageDelete($getTestimonail->image);
                $getTestimonail->delete();
                Cache::forget('all_testimonail');
            }else{
               $getTestimonail->delete();
                Cache::forget('all_testimonail'); 
            }
            return back()->with('success', __f('Testimonail Delete Success Message'));
        } else {
            abort(401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
