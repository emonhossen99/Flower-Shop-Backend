<?php

namespace Modules\Setting\App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Product\App\Models\Product;
use Modules\Setting\App\Models\Setting;
use Modules\Category\App\Models\Category;
use Modules\Setting\App\Http\Requests\CategoryProductRequest;
use Modules\Setting\App\Http\Requests\TopSellingProductRequest;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            $this->setPageTitle(__f('Settings Title'));
            $data['showThemeMenu']          = 'show';
            $data['activeThemeMenu']        = 'active';
            $data['activeThemeSettingMenu'] = 'active';
            $data['categories']             = Category::where('status', '1')->where('parent_id', '0')->where('submenu_id', '0')->get();
            $data['breadcrumb']             = [__f('Admin Dashboard Title') => route('admin.dashboard.index'), __f('Settings Title') => ''];
            $data['products']               = Product::where('status', '1')->get();
            return view('setting::index', $data);
        } else {
            abort(401);
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                if ($request->file('company_primary_logo')) {
                    $company_primary_logo = $this->imageUploadWithCrop($request->file('company_primary_logo'), 'images/company/dynamic/', null, null);
                } else {
                    $company_primary_logo = config('settings.company_primary_logo');
                }

                if ($request->file('company_secondary_logo')) {
                    $company_secondary_logo = $this->imageUploadWithCrop($request->file('company_secondary_logo'), 'images/company/dynamic/', null, null);
                } else {
                    $company_secondary_logo = config('settings.company_secondary_logo');
                }

                if ($request->file('favicon_first')) {
                    $favicon_first = $this->imageUpload($request->file('favicon_first'), 'images/company/', null, null);
                } else {
                    $favicon_first = config('settings.favicon_first');
                }

                if ($request->file('favicon_second')) {
                    $favicon_second = $this->imageUpload($request->file('favicon_second'), 'images/company/', null, null);
                } else {
                    $favicon_second = config('settings.favicon_second');
                }

                Setting::updateOrCreate(['option_key' => 'company_name'], ['option_value' => $request->company_name]);
                Setting::updateOrCreate(['option_key' => 'company_email'], ['option_value' => $request->company_email]);
                Setting::updateOrCreate(['option_key' => 'company_cell'], ['option_value' => $request->company_cell]);
                Setting::updateOrCreate(['option_key' => 'company_copy_right'], ['option_value' => $request->company_copy_right]);
                Setting::updateOrCreate(['option_key' => 'currency'], ['option_value' => $request->currency]);
                Setting::updateOrCreate(['option_key' => 'admincontactmail'], ['option_value' => $request->admincontactmail]);;
                Setting::updateOrCreate(['option_key' => 'company_primary_logo'], ['option_value' => $company_primary_logo]);
                Setting::updateOrCreate(['option_key' => 'company_secondary_logo'], ['option_value' => $company_secondary_logo]);
                Setting::updateOrCreate(['option_key' => 'favicon_first'], ['option_value' => $favicon_first]);
                Setting::updateOrCreate(['option_key' => 'favicon_second'], ['option_value' => $favicon_second]);
                Setting::updateOrCreate(['option_key' => 'commingsoonmode'], ['option_value' => $request->commingsoonmode]);
                $this->changeEnvData([
                    'APP_NAME' => str_replace(' ', '-', $request->company_name),
                ]);
                Cache::forget('app_settings');
                return response()->json([
                    'status'  => 'success',
                    'message' => __f('Company Update Success Message'),
                ]);
            }
        } else {
            abort(401);
        }
    }

    public function heroStore(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                if ($request->file('hero_section_bg_image')) {
                    $hero_section_bg_image = $this->imageUpload($request->file('hero_section_bg_image'), 'images/hero/', null, null);
                } else {
                    $hero_section_bg_image = config('settings.hero_section_bg_image');
                }
                Setting::updateOrCreate(['option_key' => 'herosectiontitle'], ['option_value' => $request->herosectiontitle]);
                Setting::updateOrCreate(['option_key' => 'herosectionsubtitle'], ['option_value' => $request->herosectionsubtitle]);
                Setting::updateOrCreate(['option_key' => 'herosectionbtntitle'], ['option_value' => $request->herosectionbtntitle]);
                Setting::updateOrCreate(['option_key' => 'herosectionbtnurltitle'], ['option_value' => $request->herosectionbtnurltitle]);
                Setting::updateOrCreate(['option_key' => 'herosectionshortdescription'], ['option_value' => $request->herosectionshortdescription]);
                Setting::updateOrCreate(['option_key' => 'hero_section_bg_image'], ['option_value' => $hero_section_bg_image]);
                Cache::forget('app_settings');
                return response()->json([
                    'status'  => 'success',
                    'message' => __f('Hero Section Update Success Message'),
                ]);
            }
        } else {
            abort(401);
        }
    }

    public function specialMomentsStore(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                if ($request->file('special_moments_section_first_image')) {
                    $special_moments_section_first_image = $this->imageUpload($request->file('special_moments_section_first_image'), 'images/special-moments/', null, null);
                } else {
                    $special_moments_section_first_image = config('settings.special_moments_section_first_image');
                }
                if ($request->file('special_moments_section_second_image')) {
                    $special_moments_section_second_image = $this->imageUpload($request->file('special_moments_section_second_image'), 'images/special-moments/', null, null);
                } else {
                    $special_moments_section_second_image = config('settings.special_moments_section_second_image');
                }

                Setting::updateOrCreate(['option_key' => 'specialmomentssectiontitle'], ['option_value' => $request->specialmomentssectiontitle]);
                Setting::updateOrCreate(['option_key' => 'specialmomentssectionsubtitle'], ['option_value' => $request->specialmomentssectionsubtitle]);
                Setting::updateOrCreate(['option_key' => 'specialmomentssectionbtntitle'], ['option_value' => $request->specialmomentssectionbtntitle]);
                Setting::updateOrCreate(['option_key' => 'specialmomentssectionbtnurltitle'], ['option_value' => $request->specialmomentssectionbtnurltitle]);
                Setting::updateOrCreate(['option_key' => 'specialmomentssectionshortdescription'], ['option_value' => $request->specialmomentssectionshortdescription]);
                Setting::updateOrCreate(['option_key' => 'special_moments_section_first_image'], ['option_value' => $special_moments_section_first_image]);
                Setting::updateOrCreate(['option_key' => 'special_moments_section_second_image'], ['option_value' => $special_moments_section_second_image]);
                Cache::forget('app_settings');
                return response()->json([
                    'status'  => 'success',
                    'message' => __f('Special Moments Section Update Success Message'),
                ]);
            }
        } else {
            abort(401);
        }
    }

    public function specialOfferStore(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                if ($request->file('special_offer_section_image')) {
                    $special_offer_section_image = $this->imageUpload($request->file('special_offer_section_image'), 'images/special-offers/', null, null);
                } else {
                    $special_offer_section_image = config('settings.special_offer_section_image');
                }
                Setting::updateOrCreate(['option_key' => 'specialoffersectiontitle'], ['option_value' => $request->specialoffersectiontitle]);
                Setting::updateOrCreate(['option_key' => 'specialoffersectionsubtitle'], ['option_value' => $request->specialoffersectionsubtitle]);
                Setting::updateOrCreate(['option_key' => 'specialoffersectionbtntitle'], ['option_value' => $request->specialoffersectionbtntitle]);
                Setting::updateOrCreate(['option_key' => 'specialoffersectionbtnurltitle'], ['option_value' => $request->specialoffersectionbtnurltitle]);
                Setting::updateOrCreate(['option_key' => 'special_offer_section_image'], ['option_value' => $special_offer_section_image]);
                Cache::forget('app_settings');
                return response()->json([
                    'status'  => 'success',
                    'message' => __f('Special Offer Section Update Success Message'),
                ]);
            }
        } else {
            abort(401);
        }
    }

    public function bestSellingStore(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                Setting::updateOrCreate(['option_key' => 'bestsellingsectiontitle'], ['option_value' => $request->bestsellingsectiontitle]);
                Setting::updateOrCreate(['option_key' => 'bestsellingsectionsubtitle'], ['option_value' => $request->bestsellingsectionsubtitle]);
                Setting::updateOrCreate(['option_key' => 'bestsellingsectiondescriptiontitle'], ['option_value' => $request->bestsellingsectiondescriptiontitle]);
                Setting::updateOrCreate(['option_key' => 'bestselling_category_section'], ['option_value' => json_encode($request->bestselling_category_section)]);
                Cache::forget('app_settings');
                return response()->json([
                    'status'  => 'success',
                    'message' => __f('Best Selling Section Update Success Message'),
                ]);
            }
        } else {
            abort(401);
        }
    }

    public function testimonailStore(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                Setting::updateOrCreate(['option_key' => 'testimonailsectiontitle'], ['option_value' => $request->testimonailsectiontitle]);
                Setting::updateOrCreate(['option_key' => 'testimonailsectionsubtitle'], ['option_value' => $request->testimonailsectionsubtitle]);
                Setting::updateOrCreate(['option_key' => 'testimonailsectiondescriptiontitle'], ['option_value' => $request->testimonailsectiondescriptiontitle]);
                Cache::forget('app_settings');
                return response()->json([
                    'status'  => 'success',
                    'message' => __f('Testimonail Section Update Success Message'),
                ]);
            }
        } else {
            abort(401);
        }
    }

    public function callToActionStore(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                if ($request->file('call_to_action_section_image')) {
                    $call_to_action_section_image = $this->imageUpload($request->file('call_to_action_section_image'), 'images/call-to-action/', null, null);
                } else {
                    $call_to_action_section_image = config('settings.call_to_action_section_image');
                }
                Setting::updateOrCreate(['option_key' => 'calltoactionsectiontitle'], ['option_value' => $request->calltoactionsectiontitle]);
                Setting::updateOrCreate(['option_key' => 'calltoactionsectionsubtitle'], ['option_value' => $request->calltoactionsectionsubtitle]);
                Setting::updateOrCreate(['option_key' => 'calltoactionsectionbtntitle'], ['option_value' => $request->calltoactionsectionbtntitle]);
                Setting::updateOrCreate(['option_key' => 'calltoactionsectionbtnurltitle'], ['option_value' => $request->calltoactionsectionbtnurltitle]);
                Setting::updateOrCreate(['option_key' => 'call_to_action_section_image'], ['option_value' => $call_to_action_section_image]);
                Cache::forget('app_settings');
                return response()->json([
                    'status'  => 'success',
                    'message' => __f('Call To Action Section Update Success Message'),
                ]);
            }
        } else {
            abort(401);
        }
    }

    public function footerSectionStore(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                Setting::updateOrCreate(['option_key' => 'footer_section_description_text'], ['option_value' => $request->footer_section_description_text]);
                Setting::updateOrCreate(['option_key' => 'footer_second_gird_title'], ['option_value' => $request->footer_second_gird_title]);
                Setting::updateOrCreate(['option_key' => 'footer_section_third_title'], ['option_value' => $request->footer_section_third_title]);
                Setting::updateOrCreate(['option_key' => 'footer_section_email'], ['option_value' => $request->footer_section_email]);
                Setting::updateOrCreate(['option_key' => 'footer_section_phone'], ['option_value' => $request->footer_section_phone]);
                Setting::updateOrCreate(['option_key' => 'footer_section_copyright'], ['option_value' => $request->footer_section_copyright]);
                Setting::updateOrCreate(['option_key' => 'footer_section_facebook_url'], ['option_value' => $request->footer_section_facebook_url]);
                Setting::updateOrCreate(['option_key' => 'footer_section_twitter_url'], ['option_value' => $request->footer_section_twitter_url]);
                Setting::updateOrCreate(['option_key' => 'footer_section_instagram_url'], ['option_value' => $request->footer_section_instagram_url]);
                Setting::updateOrCreate(['option_key' => 'footer_section_youtube_url'], ['option_value' => $request->footer_section_youtube_url]);
                Cache::forget('app_settings');
                return response()->json([
                    'status'  => 'success',
                    'message' => __f('Footer Section Update Success Message'),
                ]);
            }
        } else {
            abort(401);
        }
    }


    public function categorySectionStore(CategoryProductRequest $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                Setting::updateOrCreate(['option_key' => 'category_product'], ['option_value' => json_encode($request->category_product)]);
                Setting::updateOrCreate(['option_key' => 'category_section'], ['option_value' => json_encode($request->category_section)]);
                return response()->json([
                    'status'  => 'success',
                    'message' => 'Section setting update successfully !',
                ]);
            }
        } else {
            abort(401);
        }
    }

    public function cartPageStore(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                Setting::updateOrCreate(['option_key' => 'cartpagetitle'], ['option_value' => $request->cartpagetitle]);
                Setting::updateOrCreate(['option_key' => 'cartpagewarningtext'], ['option_value' => $request->cartpagewarningtext]);
                return response()->json([
                    'status'  => 'success',
                    'message' => __f('Cart Page Update Success Message'),
                ]);
            }
        } else {
            abort(401);
        }
    }





    public function topSellingProduct(TopSellingProductRequest $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {

                Setting::updateOrCreate(['option_key' => 'topsellingproducts'], ['option_value' => json_encode($request->topsellingproducts)]);
                return response()->json([
                    'status'  => 'success',
                    'message' => 'Top selling products setting update successfully !',
                ]);
            }
        } else {
            abort(401);
        }
    }



    /**
     * Display a listing of the resource.
     */
    public function typographyIndex()
    {
        if (Gate::allows('isAdmin')) {
            $this->setPageTitle(__f('Typography Setting Title'));
            $data['showThemeMenu']               = 'show';
            $data['activeThemeMenu']             = 'active';
            $data['activeTypographySettingMenu'] = 'active';
            $data['breadcrumb']                  = [__f('Admin Dashboard Title') => route('admin.dashboard.index'), __f('Typography Setting Title') => ''];
            return view('setting::typography', $data);
        } else {
            abort(401);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function typographyStore(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                Setting::updateOrCreate(['option_key' => 'backgroundtype'], ['option_value' => $request->bacroundtype]);
                if ($request->bacroundtype == 1) {
                    Setting::updateOrCreate(['option_key' => 'singlebackround'], ['option_value' => $request->singlebackround]);
                } else {
                    Setting::updateOrCreate(['option_key' => 'gradientone'], ['option_value' => $request->gradientone]);
                    Setting::updateOrCreate(['option_key' => 'gradienttwo'], ['option_value' => $request->gradienttwo]);
                }
                Setting::updateOrCreate(['option_key' => 'primarycolor'], ['option_value' => $request->primarycolor]);
                Setting::updateOrCreate(['option_key' => 'primarywhitecolor'], ['option_value' => $request->primarywhitecolor]);
                Setting::updateOrCreate(['option_key' => 'secondarycolor'], ['option_value' => $request->secondarycolor]);
                Setting::updateOrCreate(['option_key' => 'gadientcolor'], ['option_value' => $request->gadientcolor]);
                Setting::updateOrCreate(['option_key' => 'primaryredcolor'], ['option_value' => $request->primaryredcolor]);
                Setting::updateOrCreate(['option_key' => 'bordercolor'], ['option_value' => $request->bordercolor]);
                Setting::updateOrCreate(['option_key' => 'hovercolor'], ['option_value' => $request->hovercolor]);
                return response()->json([
                    'status'  => 'success',
                    'message' => __f('Footer Update Success Message'),
                ]);
            }
        } else {
            abort(401);
        }
    }



    public function courierIndex()
    {
        if (Gate::allows('isAdmin')) {
            $this->setPageTitle('Courier Setting');
            $data['showThemeMenu']            = 'show';
            $data['activeThemeMenu']          = 'active';
            $data['activeCourierSettingMenu'] = 'active';
            $data['breadcrumb']               = ['Admin Dashboard' => route('admin.dashboard.index'), 'Courier Setting' => ''];
            return view('setting::courier', $data);
        } else {
            abort(401);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function steadFastStore(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                Setting::updateOrCreate(['option_key' => 'steadfast_base_url'], ['option_value' => $request->steadfirstbaseurl]);
                Setting::updateOrCreate(['option_key' => 'steadfast_api_key'], ['option_value' => $request->steadfirstapikey]);
                Setting::updateOrCreate(['option_key' => 'steadfast_secret_key'], ['option_value' => $request->stradfastsecretkey]);

                $this->changeEnvData([
                    'STEADFAST_BASE_URL'   => $request->steadfirstbaseurl,
                    'STEADFAST_API_KEY'    => $request->steadfirstapikey,
                    'STEADFAST_SECRET_KEY' => $request->stradfastsecretkey,
                ]);
                return response()->json([
                    'status'  => 'success',
                    'message' => 'Stead Fast settings updated successfully!',
                ]);
            }
        } else {
            abort(401);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function pathaoStore(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            if ($request->ajax()) {
                Setting::updateOrCreate(['option_key' => 'pathaoapiurl'], ['option_value' => $request->pathaoapiurl]);
                Setting::updateOrCreate(['option_key' => 'pathaoclientid'], ['option_value' => $request->pathaoclientid]);
                Setting::updateOrCreate(['option_key' => 'pathaoclientsecret'], ['option_value' => $request->pathaoclientsecret]);
                Setting::updateOrCreate(['option_key' => 'pathaogranttype'], ['option_value' => $request->pathaogranttype]);
                Setting::updateOrCreate(['option_key' => 'pathaousername'], ['option_value' => $request->pathaousername]);
                Setting::updateOrCreate(['option_key' => 'pathaopassword'], ['option_value' => $request->pathaopassword]);
                Setting::updateOrCreate(['option_key' => 'pathaosendername'], ['option_value' => $request->pathaosendername]);
                Setting::updateOrCreate(['option_key' => 'pathaosenderphone'], ['option_value' => $request->pathaosenderphone]);
                Setting::updateOrCreate(['option_key' => 'pathaostoreid'], ['option_value' => $request->pathaostoreid]);
                Setting::updateOrCreate(['option_key' => 'pathaosecrettoken'], ['option_value' => $request->pathaosecrettoken]);

                $this->changeEnvData([
                    'PATHAO_API_URL'       => $request->pathaoapiurl,
                    'PATHAO_CLIENT_ID'     => $request->pathaoclientid,
                    'PATHAO_CLIENT_SECRET' => $request->pathaoclientsecret,
                    'PATHAO_GRANT_TYPE'    => $request->pathaogranttype,
                    'PATHAO_USERNAME'      => $request->pathaousername,
                    'PATHAO_PASSWORD'      => $request->pathaopassword,
                    'PATHAO_SENDER_NAME'   => $request->pathaosendername,
                    'PATHAO_SENDER_PHONE'  => $request->pathaosenderphone,
                    'PATHAO_STORE_ID'      => $request->pathaostoreid,
                    'PATHAO_SECRET_TOKEN'  => $request->pathaosecrettoken,
                ]);
                return response()->json([
                    'status'  => 'success',
                    'message' => 'Pathao settings updated successfully!',
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
        return view('setting::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('setting::edit');
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
