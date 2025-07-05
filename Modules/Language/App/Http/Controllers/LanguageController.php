<?php

namespace Modules\Language\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Modules\Language\App\Http\Requests\LanguageRequest;
use Modules\Language\App\Models\Language;
use Yajra\DataTables\Facades\DataTables;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            $this->setPageTitle(__f('Language List Title'));
            $data['activeLanguageMenu']     = 'active';
            $data['activeLanguageListMenu'] = 'active';
            $data['showLanguageMenu']       = 'show';
            $data['breadcrumb']             = [__f('Admin Dashboard Title') => route('admin.dashboard.index'), __f('Language List Title') => ''];
            return view('language::index', $data);
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
            $this->setPageTitle(__f('Language Create Title'));
            $data['activeLanguageMenu']       = 'active';
            $data['activeLanguageCreateMenu'] = 'active';
            $data['showLanguageMenu']         = 'show';
            $data['breadcrumb']               = [__f('Admin Dashboard Title') => route('admin.dashboard.index'), __f('Language Create Title') => ''];
            return view('language::create', $data);
        } else {
            abort(401);
        }
    }


    public function getData(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                $expense = Language::latest('id');
                return DataTables::eloquent($expense)
                    ->addIndexColumn()
                    ->filter(function ($query) use ($request) {
                        if (!empty($request->search)) {
                            $query->where(function ($query) use ($request) {
                                $query->where('name', 'like', "%{$request->search}%")
                                    ->orWhere('code', 'like', "%{$request->search}%")
                                    ->orWhere('status', 'like', "%{$request->search}%");
                            });
                        }
                    })
                    ->addColumn('language_name', function ($data) {
                        return $data->name ?? '----';
                    })
                    ->addColumn('language_code', function ($data) {
                        return $data->code ?? '----';
                    })
                    ->addColumn('direction', function ($data) {
                        return direction($data->direction);
                    })
                    ->addColumn('default', function ($data) {
                        return defaultCheck($data->default);
                    })
                    ->addColumn('status', function ($data) {
                        return status($data->status);
                    })
                    ->addColumn('action', function ($data) {
                        if ($data->status == '0') {
                            $statusAction = '<a class="dropdown-item align-items-center" href="' . route('admin.language.status', ['id' => $data->id, 'status' => '1']) . '">
                                        <i class="fa-solid fa-check me-2 text-success"></i>'. __f("Status Publish Title") .'</a>';
                        } else if ($data->status == '1') {
                            $statusAction = '<a class="dropdown-item align-items-center" href="' . route('admin.language.status', ['id' => $data->id, 'status' => '0']) . '">
                                        <i class="fa-regular fa-hourglass-half me-2 text-warning"></i>'. __f("Status Pending Title") .'</a>';
                        }

                        return '<div class="btn-group dropstart text-end">
                            <button type="button" class="btn border-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item align-items-center" href="' . route('admin.language.edit',  $data->id) . '">
                                        <i class="fa-solid fa-pen-to-square me-2 text-primary"></i>'. __f("Edit Title") .'</a>
                                </li>
                                <li>' . $statusAction . '</li>
                                <li>
                                    <button class="dropdown-item align-items-center" onclick="delete_data(' . $data->id . ')">
                                     <i class="fa-solid fa-trash me-2 text-danger"></i>'. __f("Delete Title") .'</button>
                                </li>
                            <form action="' . route('admin.language.destroy', $data->id) . '"
                                    id="delete-form-' . $data->id . '" method="DELETE" class="d-none">
                                    @csrf
                                    @method("DELETE")
                            </form>
                            </ul>
                        </div>';
                    })
                    ->rawColumns(['status', 'action', 'default', 'direction'])
                    ->make(true);
            }
        } else {
            abort(401);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LanguageRequest $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                if ($request->default == 1) {
                    $languages = Language::all();
                    if (count($languages) > 0) {
                        foreach ($languages as $language) {
                            $language->update([
                                'default' => 0,
                            ]);
                        }
                    }
                }
                Language::create([
                    'name'      => $request->name,
                    'code'      => $request->code,
                    'direction' => $request->direction,
                    'status'    => $request->status,
                    'default'   => $request->default ?? 0,
                ]);

                $sourceFile = base_path() . '/lang/default.json';
                $destinationFile = base_path() . '/lang/' . $request->code . '.json';

                if (File::exists($sourceFile)) {
                    File::copy($sourceFile, $destinationFile);
                }

                $sourceFileValiation =  base_path() . '/lang/default/validation.php';
                $destinationDir = base_path() . '/lang/' . $request->code;
                $destinationFileValiation = $destinationDir . '/validation.php';

                if (!File::exists($destinationDir)) {
                    File::makeDirectory($destinationDir, 0755, true); 
                }

                if (File::exists($sourceFileValiation)) {
                    File::copy($sourceFileValiation, $destinationFileValiation);
                }
                return response()->json([
                    'status'  => 'success',
                    'message' => __f('Language Create Success Message'),
                ]);
            }
        } else {
            abort(401);
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('language::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (Gate::any(['isAdmin', 'isStaff'])) {
            $this->setPageTitle(__f('Language Edit Title'));
            $data['activeLanguageMenu']     = 'active';
            $data['activeLanguageListMenu'] = 'active';
            $data['showLanguageMenu']       = 'show';
            $data['language']               = Language::where('id', $id)->first();
            $data['breadcrumb']             = [__f('Admin Dashboard Title') => route('admin.dashboard.index'),  __f('Language List Title') => route('admin.language.index'), __f('Language Edit Title') => ''];
            return view('language::edit', $data);
        } else {
            abort(401);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function Update(LanguageRequest $request, $id)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                if ($request->default == 1) {
                    $languages = Language::where('id', '!=', $id)->get();
                    if (count($languages) > 0) {
                        foreach ($languages as $language) {
                            $language->update([
                                'default' => 0,
                            ]);
                        }
                    }
                }
                $language =  Language::where('id', $id)->first();
                if ($language->code == $request->code) {
                    $language->update([
                        'name'      => $request->name,
                        'code'      => $request->code,
                        'direction' => $request->direction,
                        'status'    => $request->status,
                        'default'   => $request->default ?? 0,
                    ]);
                } else {
                    $oldPath = base_path() . '/lang/' . $language->code . '.json';
                    $newPath = base_path() . '/lang/' . $request->code . '.json';
                    if (File::exists($oldPath)) {
                        File::move($oldPath, $newPath);
                    }

                    $oldValidationPath = base_path() . '/lang/' . $language->code . '/validation.php';
                    $newValidationDir = base_path() . '/lang/' . $request->code;
                    $newValidationPath = $newValidationDir . '/validation.php';

                    if (!File::exists($newValidationDir)) {
                        File::makeDirectory($newValidationDir, 0755, true);
                    }

                    $oldValidationPath = base_path() . '/lang/' . $language->code . '/validation.php';
                    $oldValidationDir = base_path() . '/lang/' . $language->code;
                    
                    $newValidationDir = base_path() . '/lang/' . $request->code;
                    $newValidationPath = $newValidationDir . '/validation.php';
                    
                    if (!File::exists($newValidationDir)) {
                        File::makeDirectory($newValidationDir, 0755, true);
                    }
                    if (File::exists($oldValidationPath)) {
                        File::move($oldValidationPath, $newValidationPath);
                    }
                    
                    if (File::isDirectory($oldValidationDir) && count(File::files($oldValidationDir)) === 0) {
                        File::deleteDirectory($oldValidationDir);
                    }
                    $language->update([
                        'name'      => $request->name,
                        'code'      => $request->code,
                        'direction' => $request->direction,
                        'status'    => $request->status,
                        'default'   => $request->default ?? 0,
                    ]);
                }

                return response()->json([
                    'status'  => 'success',
                    'message' =>  __f('Language Update Success Message'),
                ]);
            }
        } else {
            abort(401);
        }
    }

    public function statusChange($id, $status)
    {
        if (Gate::allows('isAdmin')) {
            $getlanguage = Language::where('id', $id)->first();
            $getlanguage->update([
                'status' => $status
            ]);
            return back()->with('success',  __f('Language Status Change Message'));
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
            $getlanguage = Language::find($id);
            if ($getlanguage) {
                $filePath = base_path() . '/lang/' . $getlanguage->code . '.json';
                $filePathValiation = base_path() . '/lang/' . $getlanguage->code;
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
                if (File::isDirectory($filePathValiation)) {
                    File::deleteDirectory($filePathValiation);
                }
                $getlanguage->delete();
            }
            return back()->with('success',  __f('Language Delete Success Message'));
        } else {
            abort(401);
        }
    }


    public function websiteTranslate($lang)
    {
        if (Gate::allows('isAdmin')) {
            $this->setPageTitle(__f('Website Translate Title'));
            $data['activeLanguageMenu']         = 'active';
            $data['activeWebsiteTranslateMenu'] = 'active';
            $data['showLanguageMenu']           = 'show';
            $data['breadcrumb']                 = [__f('Admin Dashboard Title') => route('admin.dashboard.index'), __f('Website Translate Title') => ''];
            $data['lang']                       = $lang;
            $filePath                           = base_path("lang/{$lang}.json");
            $data['translations']               = json_decode(file_get_contents($filePath), true);
            $data['languages']                  = Language::where('status', '1')->get();
            $data['editlanguage']               = Language::where('code', $lang)->first();
            if (! File::exists($filePath)) {
                return back()->with('error', __f('Language file not found Title'));
            }
            return view('language::websitetranlate', $data);
        } else {
            abort(401);
        }
    }
    public function websiteTranslateStore(Request $request, $lang)
    {
        if (Gate::allows('isAdmin')) {
            if ($lang == 'us' || $lang == 'en') {
                $filePath = base_path("lang/{$lang}.json");
                $filePathEn = base_path("lang/default.json");

                if (!File::exists($filePath)) {
                    return back()->with('error', 'Language file not found!');
                }
                if (!File::exists($filePathEn)) {
                    return back()->with('error', 'Language file not found!');
                }

                $updatedTranslations = $request->input('translations');

                $jsonContent = json_encode($updatedTranslations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                File::put($filePath, $jsonContent);
                File::put($filePathEn, $jsonContent);

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Translations updated successfully!'
                ]);
            } else {
                $filePath = base_path("lang/{$lang}.json");

                if (!File::exists($filePath)) {
                    return back()->with('error', 'Language file not found!');
                }

                $updatedTranslations = $request->input('translations');

                $jsonContent = json_encode($updatedTranslations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                File::put($filePath, $jsonContent);

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Translations updated successfully!'
                ]);
            }
        } else {
            abort(401);
        }
    }

    public function changeLanguage(Request $request)
    {
        $locale = $request->locale;
        session()->put('locale', $locale);
        app()->setLocale($locale);
        return redirect()->back();
    }
}
