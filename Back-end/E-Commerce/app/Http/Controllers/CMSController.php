<?php

namespace App\Http\Controllers;

use App\Models\Cms;
use Illuminate\Http\Request;

class CMSController extends Controller
{
    /**
     * Render the All CMS data.
     *
     * @return App\Models\CMS
     */
    public function getCMSs()
    {
        return view('cms_management', ['cmss' => Cms::all()]);
    }

    /**
     * Render the Add Category form.
     *
     * @return view
     */
    public function addCMSForm()
    {
        return view('add_cms');
    }

    /**
     * Add Category.
     *
     * @return flash Session
     */
    public function addCMS(Request $request)
    {
        $validator = $request->validate([
            'ctitle' => 'required|unique:cms,title',
            'cslug' => 'required',
            'cimage' => 'required|image|mimes:png,jpg',
            'cdescription' => 'required',
        ], [
            'ctitle.required' => 'CMS title is required',
            'ctitle.unique' => 'CMS tile is already taken',
            'cslug.required' => 'CMS slug is required',
            'cimage.required' => 'CMS image is required',
            'cimage.mimes' => 'Only png and jpg files are allowed',
            'cdescription.required' => 'CMS description is required'
        ]);
        if ($validator) {
            $imageName = 'cms' . '-' . rand() . time() . '.' . $request->cimage->extension();
            $cms = new Cms();
            $cms->title = $request->ctitle;
            $cms->description = $request->cdescription;
            $cms->slug = $request->cslug;
            $cms->image = 'cms/' . $imageName;
            if ($cms->save()) {
                if ($request->cimage->move(public_path('cms'), $imageName)) {
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
     * @return App\Models\Category 
     */
    public function getCMS($id)
    {
        return response()->json(CMS::find($id));
    }

    /**
     * Returns response
     *
     * @param $id
     * 
     * @return Illuminate\Http\Response
     */
    public function editCMS(Request $request, $id)
    {
        $validator = $request->validate([
            'cslug' => 'required',
            'cdescription' => 'required',
        ], [
            'cslug.required' => 'CMS slug is required',
            'cdescription.required' => 'CMS description is required'
        ]);
        if ($validator) {
            $cms = CMS::find($id);
            $cms->description = $request->cdescription;
            $cms->slug = $request->cslug;
            if ($request->cimage) {
                $request->cimage->move(public_path('cms'), $cms->image);
            }
            if ($cms->save()) {
                return response()->json(['success']);
            }
        }
    }

    /**
     * Delete Cms.
     *
     * @param $id
     * @return void
     */
    public function deleteCMS($id)
    {
        $cms = Cms::find($id);
        if (unlink(public_path($cms->image))) {
            $cms->delete();
        }
    }

    /**
     * All CMS Api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCMSsApi()
    {
        return response()->json(['cms' => Cms::all(), 'message' => 'all cms fetched'], 200);
    }

    /**
     * CMS Api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCMSApi($slug)
    {
        return response()->json(['cms' => Cms::where('slug', $slug)->first(), 'message' => 'all cms fetched'], 200);
    }
}
