<?php

namespace App\Http\Controllers;

use App\Http\Resources\EcommerceResource;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    /**
     * Render the Add Banner form
     *
     * @return \Illuminate\Contracts\Support\Renderable
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
            'bcaption' => 'required',
            'bimage' => 'required|mimes:png,jpg',
        ], [
            'bcaption.required' => 'Banner name is required',
            'bimage.required' => 'Select Image',
            'bimage.mimes' => 'Only png and jpg files are allowed',
        ]);
        if ($validator) {
            $imageName = 'banner' . '-' . rand() . time() . '.' . $request->bimage->extension();
            $banner = new Banner();
            $banner->caption = $request->bcaption;
            $banner->link = $request->blink;
            $banner->description = $request->bdescription;
            $banner->image = 'banners/' . $imageName;
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

    /**
     * Returns the User data.
     *
     * @param $id
     * 
     * @return App\Models\Banner 
     */
    public function getBanner($id)
    {
        return response()->json(Banner::find($id));
    }

    /**
     * Returns response
     *
     * @param $id
     * 
     * @return Illuminate\Http\Response
     */
    public function editBanner(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'bcaption' => 'required',
            'bimage' => 'image|mimes:png,jpg',
        ], [
            'bcaption.required' => 'Banner name is required',
            'bimage.image' => 'Only png and jpg files are allowed',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }else {
            $banner = Banner::find($id);
            $banner->caption = $request->bcaption;
            $banner->link = $request->blink;
            $banner->description = $request->bdescription;
            if ($request->bimage) {
                $request->bimage->move(public_path('banners'), $banner->image);
            }
            if ($banner->save()) {
                return response()->json(true);
            }
        } 
    }

    /**
     * Delete Banner.
     *
     * @param $id
     * 
     * @return void
     */
    public function deleteBanner($id)
    {
        $banner = Banner::find($id);
        if (unlink(public_path('banners/' . $banner->image))) {
            $banner->delete();
        }
    }

    /**
     * get all banner details (Banner API).
     * 
     * @return App\Http\Resources\EcommerceResource
     */
    public function getBannersApi() {
        $banner = Banner::all();
        return response(['banners' => EcommerceResource::collection($banner), 'message' => 'All banners fetched'], 200);
    }
}
