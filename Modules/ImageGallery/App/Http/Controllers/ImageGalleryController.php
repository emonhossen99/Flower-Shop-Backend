<?php

namespace Modules\ImageGallery\App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\ImageGallery\App\Models\ImageGallery;

class ImageGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('imagegallery::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('imagegallery::create');
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
        return view('imagegallery::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('imagegallery::edit');
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
        try {
            $image = ImageGallery::findOrFail($id); // ইমেজ খুঁজে বের করুন
            $imagePath = public_path($image->image_path); // ইমেজের সঠিক পাথ নিন
    
            if (file_exists($imagePath)) {
                unlink($imagePath); // ফাইল ডিলিট করুন
            }
    
            $image->delete(); // ডাটাবেজ থেকে ডিলিট করুন
    
            return response()->json(['status' => 'success', 'message' => 'Image deleted successfully.']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Failed to delete the image.'], 500);
        }
    }
    
}
