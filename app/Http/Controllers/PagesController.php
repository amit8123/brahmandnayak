<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryCategory;
use App\Models\Manager;
use App\Models\Role;
use App\Models\Slider;
use App\Models\Trusty;
use App\Models\Upkram;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{

    /**
     * welcome page 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome()
    {
        return view('layouts.frontend.pages.welcome');
    }

    /**
     * splash page 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function splash()
    {
        return view('layouts.frontend.pages.splash');
    }

    /**
     * Home Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $upkramList = Upkram::orderBy('id', 'DESC')->get();
        $gallery = Gallery::orderBy('id', 'DESC')->get();
        $slider = Slider::get();
        $trusty = Trusty::get();
        $manager = Manager::get();
        return view('layouts.frontend.pages.home', compact('upkramList', 'gallery', 'slider', 'trusty', 'manager'));
    }

    /**
     * About Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('layouts.frontend.pages.about');
    }

    /**
     * Sampraday Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sampraday()
    {
        return view('layouts.frontend.pages.sampraday');
    }

    /**
     * Parampara Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function parampara()
    {
        return view('layouts.frontend.pages.parampara');
    }

    /**
     * Nityasmaran Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function nityasmaran()
    {
        return view('layouts.frontend.pages.nityasmaran');
    }


    /**
     * upkram detail 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function upkramDetail($id)
    {
        $upkram = Upkram::find($id);
        return view('layouts.frontend.pages.upkram-detail', compact('upkram'));
    }


    /**
     * District Info
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function districtInfo()
    {
        return view('layouts.frontend.pages.district-info');
    }

    /**
     * gallery Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gallery()
    {
        $category = GalleryCategory::all();
        $gallery = Gallery::all();
        // foreach ($gallery as $key => $element) {

        //     $categoryID = GalleryCategory::find($element->category_id,);
        //     if (!isset($categoryID)) {
        //         unset($gallery[$key]);
        //     } else {
        //         $element['category'] = $categoryID->category;
        //     }
        // }
        return view('layouts.frontend.pages.gallery', compact('gallery', 'category'));
    }


    /**
     * contact
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        return view('layouts.frontend.pages.contact');
    }

    /**
     * donation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function donation(\Illuminate\Http\Request $request)
    {
        $search = trim((string) $request->query('q', ''));

        $query = \App\Models\DonorList::query();
        if ($search !== '') {
            $like = '%' . str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $search) . '%';
            $query->where(function ($q) use ($like) {
                $q->where('name', 'like', $like)
                    ->orWhere('remark', 'like', $like)
                    ->orWhere('amount', 'like', $like);
            });
        }

        $totals = \App\Models\DonorList::selectRaw('COUNT(*) as donors, COALESCE(SUM(CAST(amount AS DECIMAL(15,2))), 0) as total')->first();

        $donors = $query->orderBy('date', 'DESC')->orderBy('id', 'DESC')
            ->paginate(20)
            ->appends(['q' => $search]);

        return view('layouts.frontend.pages.donation', compact('donors', 'search', 'totals'));
    }
}
