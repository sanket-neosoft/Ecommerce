<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerManagement extends Controller
{
    /**
     * Render the Add Banner form
     *
     * @return add_banner view
     */
    public function addBannerForm()
    {
        return view('add_banner');
    }

    /**
     * Render the All Banners
     *
     * @return  App\Models\Banner
     */
    public function getBanners()
    {
        return view('banner_management', ['banners' => Banner::all()]);
    }

    /**
     * Insert Data in users table
     *
     * @param Illuminate\Http\Request $request
     * @return session('status') = 'success' or 'failed'
     */
    public function addBanner(Request $request)
    {
        $validator = $request->validate([
            'bname' => 'required',
            'bimage' => 'required|image|mimes:png,jpg',
        ], [
            'bname.required' => 'Banner name is required',
            'bimage.required' => 'Select Image',
            'bimage.image' => 'Only png and jpg files are allowed',
        ]);
        if ($validator) {
            $imageName = 'banner' . '-' . rand() . time() . '.' . $request->bimage->extension();
            $banner = new Banner();
            $banner->banner_name = $request->bname;
            $banner->banner_link = $request->blink;
            $banner->banner_image =  $imageName;
            if ($banner->save()) {
                if ($request->bimage->move(public_path('banners'), $imageName)) {
                    return back()->with('status', 'success');
                } else {
                    return back()->with('status', 'failed');
                }
            } else {
                return back()->with('status', 'failed');
            }
        }
    }
}
