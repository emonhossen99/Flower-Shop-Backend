<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Modules\Feature\App\Models\Feature;
use Modules\Product\App\Models\Product;
use Modules\Category\App\Models\Category;
use Modules\Subscriber\App\Models\Subscriber;
use Modules\Testimonail\App\Models\Testimonail;

class MainIndexController extends Controller
{
    public function index()
    {
        Cache::forget('all_products');
        $this->setPageTitle('Home');
        $data['mode']                 = config('settings.commingsoonmode') ?? 0;
        $category_sections             = json_decode(config('settings.bestselling_category_section'));
        $data['features']             =  Cache::remember('all_features', 60 * 60, function () {
            return Feature::where('status', '1')->orderBy('id', 'desc')->take(4)->get();
        });
        $data['products']             =  Cache::remember('all_products', 60 * 60, function () {
            return Product::with(['categories', 'images'])->where('status', '1')->orderBy('id', 'desc')->take(8)->get();
        });

        if ($category_sections != null &&  collect($category_sections)->count() > 0) {
            $data['dynamicCategorySection']  = Cache::remember('dynamic_products', 60 * 60, function () use ($category_sections) {
                return  Category::with(['products'])->whereIn('id', $category_sections)->has('products')->where('status', '1')->get();
            });
        } else {
            $categories = Cache::remember('dynamic_category', 60 * 60, function () {
                return Category::where('status', '1')->take(2)->pluck('id');
            });
            $data['dynamicCategorySection']  = Cache::remember('dynamic_products_with_category', 60 * 60, function () use ($categories) {
                return  Category::with(['products'])->whereIn('id', $categories)->has('products')->where('status', '1')->get();
            });
        }

        $data['testimonails'] =  Cache::remember('all_testimonail', 60 * 60, function () {
            return Testimonail::where('status', '1')->orderBy('id', 'desc')->take(3)->get();
        });

        if ($data['mode'] == 1) {
            if ((Auth::check() && Auth::user()->role_id == 1) || (Auth::check() && Auth::user()->role_id == 2)) {
                return redirect()->route('admin.dashboard.index');
            } else if (Auth::check() && Auth::user()->role_id == 3) {
                return redirect()->route('staff.dashboard.index');
            } else {
                return view('commingsoon.commingsoon');
            }
        } else {
            return view('frontend.home', $data);
        }
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name"       => $product->name,
                "product_id" => $product->id,
                "quantity"   => 1,
                "price"      => $product->discount_price ?? $product->price,
                "image"      => $product->product_image ?? null
            ];
        }

        session()->put('cart', $cart);
        $countcart = count((array) session('cart'));
        $totalAmout = 0;
        if (session('cart')) {
            foreach (session('cart') as $id => $details) {
                $totalAmout += $details['quantity'] * $details['price'];
            }
        }
        session()->put('cart', $cart);
        return back()->with('success', 'Product added to cart successfully!');
    }

    public function productshow($id)
    {
        $this->setPageTitle('Product Single');
        $data['breadcrumb']  = ['Home' => url('/'), 'Product Single' => ''];
        $singleProduct = Product::with(['categories', 'images',])->where('id', $id)->first();
        $data['singleproduct'] = $singleProduct;
        $categoryIds = $singleProduct->categories->pluck('id');
        $data['relatedProducts'] = Product::with(['categories',])
            ->whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('categories.id', $categoryIds);
            })
            ->where('id', '!=', $id)
            ->take(6)
            ->get();

        $data['previousProduct'] = Product::where('id', '<', $id)
            ->orderBy('id', 'desc')
            ->first();

        $data['nextProduct'] = Product::where('id', '>', $id)
            ->orderBy('id', 'asc')
            ->first();
        return view('frontend.productdetails.productdetails', $data);
    }

    public function generateCSS()
    {
        $backgroundtype =  config('settings.backgroundtype');

        if ($backgroundtype == 1) {
            $primaryBackground = config('settings.singlebackround');
        } else {
            $primaryBackground = 'radial-gradient(circle farthest-corner at 10% 20%, ' . config('settings.gradientone') . ' 0%, ' . config('settings.gradienttwo') . ' 90%)';
        }

        $primaryColor = config('settings.primarycolor');
        $primaryWhiteColor = config('settings.primarywhitecolor');
        $primarySecondaryColor = config('settings.secondarycolor');
        $primaryGadientColor = config('settings.gadientcolor');
        $primaryBordercolor = config('settings.bordercolor');
        $primaryHovercolor = config('settings.hovercolor');
        $primaryRedColor = config('settings.primaryredcolor');

        $css = "
        .header-top {
            background: {$primaryBackground} !important;
            color: {$primaryColor};
        }
        ";
        return response($css)->header('Content-Type', 'text/css');
    }
}
