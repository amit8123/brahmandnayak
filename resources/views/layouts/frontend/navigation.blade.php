<!-- Preloader Start -->
    <div class="sigma_preloader">
      <img src="{{ asset('assets/frontend/images/om.svg') }}" alt="preloader" />
    </div>
    <!-- Preloader End -->

    <!-- partial:partia/__sidenav.html -->
    <aside
      class="sigma_aside sigma_aside-right sigma_aside-right-panel sigma_aside-bg"
    >
      <div class="sidebar">
        <div class="sidebar-widget widget-logo">
          <img src="{{ asset('assets/frontend/images/logo1.png') }}" class="mb-30" alt="img" />
        </div>
      </div>
    </aside>
    <div class="sigma_aside-overlay aside-trigger-right"></div>
    <!-- partial -->

    <!-- partial:partia/__mobile-nav.html -->
    <aside class="sigma_aside sigma_aside-left">
      <div class="sidebar-widget widget-logo">
        <a class="navbar-brand" href="{{ route('home') }}">
          <img src="{{ asset('assets/frontend/images/logo1.png') }}" alt="logo" />
        </a>
      </div>

      <!-- Menu -->
      <ul class="navbar-nav">
        <li class="menu-item menu-item-has-children">
          <a href="{{ route('home') }}">मुख्य पान</a>
          <ul class="sub-menu">
            <li class="menu-item">
              <a href="{{ route('home') }}">निवेदन</a>
            </li>
            <li class="menu-item">
              <a href="{{ route('home') }}">विश्वस्त</a>
            </li>
          </ul>
        </li>
        <li class="menu-item menu-item-has-children">
          <a href="{{ route('about') }}">प्रस्तावना</a>
          <ul class="sub-menu">
            <li class="menu-item">
              <a href="{{ route('about') }}">उद्देश</a>
            </li>
            <li class="menu-item">
              <a href="{{ route('about') }}">अंतरंग</a>
            </li>
          </ul>
        </li>
        <li class="menu-item menu-item-has-children">
          <a href="{{ route('sampraday') }}">सम्प्रदाय</a>
          <ul class="sub-menu">
            <li class="menu-item">
              <a href="{{ route('sampraday') }}">श्री गुरु दत्तात्रेय</a>
            </li>
            <li class="menu-item">
              <a href="{{ route('sampraday') }}">श्री श्रीपाद श्रीवल्लभ</a>
            </li>
            <li class="menu-item">
              <a href="{{ route('sampraday') }}">श्री नृसिंह सरस्वती</a>
            </li>
            <li class="menu-item">
              <a href="{{ route('sampraday') }}">श्री स्वामी समर्थ</a>
            </li>
          </ul>
        </li>
        <li class="menu-item menu-item-has-children">
          <a href="#">परंपरा</a>
          <ul class="sub-menu">
            <li class="menu-item">
              <a href="{{ route('parampara') }}?id=#<?php echo hash('sha256', 1234); ?>-tab">श्री स्वामी सेवेकरी परंपरा1</a>
            </li>
            <li class="menu-item">
              <a href="{{ route('parampara') }}?id=#<?php echo hash('sha256', 5678); ?>-tab">श्री स्वामी शिष्य परंपरा</a>
            </li>
          </ul>
        </li>
        <li class="menu-item menu-item-has-children">
          <a href="{{ route('nityasmaran') }}">नित्यस्मरण</a>
          <ul class="sub-menu">
            <li class="menu-item">
            <a href="{{ route('nityasmaran') }}">नमस्कार</a>
            </li>
            <li class="menu-item">
              <a href="{{ route('nityasmaran') }}">श्री स्वामी समर्थ अष्टोत्तरशत नामावली</a>
            </li>
            <li class="menu-item">
              <a href="{{ route('nityasmaran') }}">श्री स्वामी समर्थ तारक मंत्र</a>
            </li>
            <li class="menu-item">
              <a href="{{ route('nityasmaran') }}">श्री स्वामी समर्थ मानसपूजा</a>
            </li>
            <li class="menu-item">
              <a href="{{ route('nityasmaran') }}">श्री स्वामी समर्थाष्टक</a>
            </li>
            <li class="menu-item">
              <a href="{{ route('nityasmaran') }}">स्वामी आशीर्वचन</a>
            </li>
            <li class="menu-item">
              <a href="{{ route('nityasmaran') }}">स्वामींची आरती</a>
            </li>
          </ul>
        </li>
        <li class="menu-item">
          <a href="{{ route('gallery') }}">चित्रदालन</a>
        </li>
        <li class="menu-item">
          <a href="{{ route('contact') }}">संपर्क</a>
        </li>
        <li class="menu-item">
          <a href="{{ route('donation') }}">देणगी</a>
        </li>
      </ul>
    </aside>
    <div class="sigma_aside-overlay aside-trigger-left"></div>
    <!-- partial -->

    <!-- partial:partia/__header.html -->
    <header class="sigma_header header-2 can-sticky">
      <!-- Middle Header Start -->
      <div class="sigma_header-middle">
        <nav class="navbar">
          <!-- Controls -->
          <div class="sigma_header-controls style-2">
            <ul class="sigma_header-controls-inner">

              <!-- Mobile Toggler -->
              <li class="aside-toggler style-2 aside-trigger-left">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
              </li>
              <!-- Logo Start -->
              <div class="sigma_logo-wrapper">
                <a class="navbar-brand" href="{{ route('home') }}">
                  <img id="brand" src="{{ asset('assets/frontend/images/logo1.png') }}" alt="logo" />
                </a>
              </div>
              <!-- Logo End -->
            </ul>
          </div>

          <!-- Menu -->
          <ul class="navbar-nav">
            <li class="menu-item menu-item-has-children">
              <a href="{{ route('home') }}">मुख्य पान</a>
              <ul class="sub-menu">
                <li class="menu-item">
                  <a href="{{ route('home',['#nivedan']) }}">निवेदन</a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('home',['#vishwastal mandal']) }}">विश्वस्त</a>
                </li>
              </ul>
            </li>
            <li class="menu-item menu-item-has-children">
              <a href="{{ route('about') }}">प्रस्तावना</a>
              <ul class="sub-menu">
                <li class="menu-item">
                  <a href="{{ route('about',['#uddesh']) }}">उद्देश</a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('about',['#antarang']) }}">अंतरंग</a>
                </li>
              </ul>
            </li>
            <li class="menu-item menu-item-has-children">
              <a href="{{ route('sampraday') }}">सम्प्रदाय</a>
              <ul class="sub-menu">
                <li class="menu-item">
                  <a href="{{ route('sampraday',['#sampraday01']) }}">श्री गुरु दत्तात्रेय</a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('sampraday',['#sampraday02']) }}">श्री श्रीपाद श्रीवल्लभ</a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('sampraday',['#sampraday03']) }}">श्री नृसिंह सरस्वती</a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('sampraday',['#sampraday04']) }}">श्री स्वामी समर्थ</a>
                </li>
              </ul>
            </li>
            <li class="menu-item menu-item-has-children">
              <a href="#">परंपरा</a>
              <ul class="sub-menu">
                <li class="menu-item">
                  <a href="{{ route('parampara')}}?id=#<?php echo hash('sha256', 1234); ?>-tab" onclick="Content('1')">श्री स्वामी सेवेकरी परंपरा</a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('parampara')}}?id=#<?php echo hash('sha256', 5678); ?>-tab" onclick="Content('2')">श्री स्वामी शिष्य परंपरा</a>
                </li>
              </ul>
            </li>
            <li class="menu-item menu-item-has-children">
              <a href="{{ route('nityasmaran') }}">नित्यस्मरण</a>
              <ul class="sub-menu">
                <li class="menu-item">
                <a href="{{ route('nityasmaran',['#remind01']) }}">नमस्कार</a>
                </li>
                <li class="menu-item">
                  <a href="#">श्री स्वामी समर्थ अष्टोत्तरशत नामावली</a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('nityasmaran',['#remind02']) }}">श्री स्वामी समर्थ तारक मंत्र</a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('nityasmaran',['#remind03']) }}">श्री स्वामी समर्थ मानसपूजा</a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('nityasmaran',['#remind04']) }}">श्री स्वामी समर्थाष्टक</a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('nityasmaran',['#remind05']) }}">स्वामी आशीर्वचन</a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('nityasmaran',['#remind06']) }}">स्वामींची आरती</a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="{{ route('gallery') }}">चित्रदालन</a>
            </li>
            <li class="menu-item">
              <a href="{{ route('contact') }}">संपर्क</a>
            </li>
            <li class="menu-item">
              <a href="{{ route('donation') }}">देणगी</a>
            </li>
          </ul>

          <!-- Button & Phone -->
          <div class="sigma_header-controls sigma_header-button">
            <!-- Mantra player -->
            <audio id="tah_audio" src="{{ asset('assets/frontend/audio/swami.mp3') }}" loop preload="none"></audio>
            <button type="button" id="dv-audio-btn" class="dv-player" aria-label="Play / Pause mantra" aria-pressed="false">
              <span class="dv-player-icon"><i class="fas fa-play"></i></span>
              <span class="dv-player-text">
                <small>तारकमंत्र</small>
                <strong>श्री स्वामी समर्थ</strong>
              </span>
              <span class="dv-eq" aria-hidden="true"><i></i><i></i><i></i><i></i></span>
            </button>
            <a class="sigma_btn-custom donate_nav" href="{{ route('donation') }}">
              <img src="{{ asset('assets/frontend/images/rudraksha01.png') }}" alt="Donation" />
            </a>
          </div>
        </nav>
      </div>
      <!-- Middle Header End -->
    </header>
    <!-- partial -->
