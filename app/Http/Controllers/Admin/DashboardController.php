<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonorList;
use App\Models\Enquiry;
use App\Models\Gallery;
use App\Models\Manager;
use App\Models\Slider;
use App\Models\Trusty;
use App\Models\Upkram;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            ['label' => 'Home Slider Images', 'count' => Slider::count(), 'icon' => 'fa-images', 'color' => '#e8730c', 'route' => 'admin.slider.index'],
            ['label' => 'Gallery Photos', 'count' => Gallery::count(), 'icon' => 'fa-camera', 'color' => '#6b1d1d', 'route' => 'admin.gallery.index'],
            ['label' => 'Upkram (Events)', 'count' => Upkram::count(), 'icon' => 'fa-calendar-alt', 'color' => '#2e8b57', 'route' => 'admin.upkram.index'],
            ['label' => 'Trustees', 'count' => Trusty::count(), 'icon' => 'fa-users', 'color' => '#3b6fb6', 'route' => 'admin.trusty.index'],
            ['label' => 'Managers', 'count' => Manager::count(), 'icon' => 'fa-user-tie', 'color' => '#8e5ab5', 'route' => 'admin.manager.index'],
            ['label' => 'Donors', 'count' => DonorList::count(), 'icon' => 'fa-hand-holding-heart', 'color' => '#c0392b', 'route' => 'admin.donorList.index'],
            ['label' => 'Feedback / Enquiries', 'count' => Enquiry::count(), 'icon' => 'fa-comments', 'color' => '#d4a017', 'route' => 'admin.feedback.index'],
        ];

        $recentDonors = DonorList::orderBy('id', 'desc')->take(5)->get();
        $recentEnquiries = Enquiry::orderBy('id', 'desc')->take(5)->get();

        return view('layouts.backend.pages.admin.dashboard', compact('stats', 'recentDonors', 'recentEnquiries'));
    }
}
