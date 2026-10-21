<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $feedbackList = DB::select('SELECT * from enquiries');
        return view('layouts.backend.pages.admin.feedback.index', compact('feedbackList'));
    }
}
