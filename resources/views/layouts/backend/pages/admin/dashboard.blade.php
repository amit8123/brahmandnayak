@extends('layouts.backend.pages.admin.injector.admin-attribute-injection')

@section('sub-title')
    Dashboard
@endsection

@section('page-content')
<div class="main-container">
    @include('layouts.backend.messages')

    <!-- welcome -->
    <div class="welcome-banner">
        <h2>Namaste, {{ Auth::user()->name }} 🙏</h2>
        <p>Welcome to the temple admin panel. Use the menu on the left or the quick buttons below to manage your website.</p>
    </div>

    <!-- counts -->
    <h3 class="section-title">Overview</h3>
    <div class="stat-grid">
        @foreach($stats as $s)
            <a class="stat-card" href="{{ route($s['route']) }}">
                <span class="stat-icon" style="background: {{ $s['color'] }}"><i class="fas {{ $s['icon'] }}"></i></span>
                <span>
                    <span class="stat-num d-block">{{ $s['count'] }}</span>
                    <span class="stat-text d-block">{{ $s['label'] }}</span>
                    <span class="stat-link">View all &rarr;</span>
                </span>
            </a>
        @endforeach
    </div>

    <!-- quick actions -->
    <h3 class="section-title">Quick Actions</h3>
    <div class="quick-grid">
        <a class="quick-btn" href="{{ route('admin.slider.create') }}"><i class="fas fa-plus-circle"></i> Add Slider Image</a>
        <a class="quick-btn" href="{{ route('admin.gallery.create') }}"><i class="fas fa-camera"></i> Add Gallery Photo</a>
        <a class="quick-btn" href="{{ route('admin.upkram.create') }}"><i class="fas fa-calendar-plus"></i> Add Upkram</a>
        <a class="quick-btn" href="{{ route('admin.trusty.create') }}"><i class="fas fa-user-plus"></i> Add Trustee</a>
        <a class="quick-btn" href="{{ route('admin.donorList.create') }}"><i class="fas fa-donate"></i> Add Donor</a>
    </div>

    <!-- recent -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="panel-box">
                <h3 class="section-title">Recent Donors</h3>
                @if($recentDonors->isNotEmpty())
                    <table>
                        <thead><tr><th>Name</th><th>Amount</th><th>Date</th></tr></thead>
                        <tbody>
                        @foreach($recentDonors as $d)
                            <tr><td>{{ $d->name }}</td><td>&#8377; {{ $d->amount }}</td><td>{{ $d->date }}</td></tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-note">No donors yet.</div>
                @endif
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="panel-box">
                <h3 class="section-title">Recent Feedback</h3>
                @if($recentEnquiries->isNotEmpty())
                    <table>
                        <thead><tr><th>Name</th><th>Mobile</th><th>Message</th></tr></thead>
                        <tbody>
                        @foreach($recentEnquiries as $e)
                            <tr><td>{{ $e->name }}</td><td>{{ $e->mobile }}</td><td>{{ \Illuminate\Support\Str::limit($e->comment, 40) }}</td></tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-note">No feedback received yet.</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
