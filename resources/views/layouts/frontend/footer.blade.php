<!-- Back To Top Start -->
        <div class="sigma_top style-5">
            <i class="far fa-angle-double-up"></i>
        </div>

        <!-- Floating call / WhatsApp -->
        <div class="dv-fab">
            <a class="dv-fab-wa" href="https://wa.me/917775037999" target="_blank" rel="noopener" aria-label="WhatsApp">
                <i class="fab fa-whatsapp"></i>
            </a>
            <a class="dv-fab-call" href="tel:+917775037999" aria-label="Call 7775037999">
                <i class="fas fa-phone"></i>
            </a>
        </div>

        <!-- partial:partia/__footer.html -->
        <footer class="sigma_footer footer-2 sigma_footer-dark dv-footer">

            <!-- Invocation banner -->
            <div class="dv-footer-om">
                <span>॥ श्री स्वामी समर्थ ॥</span>
            </div>

            <div class="sigma_footer-middle">
                <div class="container">
                    <div class="row g-4">

                        <!-- About + contact -->
                        <div class="col-lg-4 col-md-6 footer-widget">
                            <a href="{{ route('home') }}" class="dv-footer-logo">
                                <img src="{{ asset('assets/frontend/images/logo1.png') }}" alt="logo" loading="lazy" />
                            </a>
                            <p class="dv-footer-about">ब्रह्मांडनायक श्री स्वामी समर्थ प्रतिष्ठान (स्वामी मठ) — जनसेवा हीच ईश्वरसेवा.</p>

                            <ul class="dv-contact">
                                <li>
                                    <i class="fas fa-phone"></i>
                                    <a href="tel:+917775037999">7775037999</a>
                                </li>
                                <li>
                                    <i class="far fa-envelope"></i>
                                    <a href="mailto:bsssp.org@gmail.com">bsssp.org@gmail.com</a>
                                </li>
                                <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    <a href="https://www.google.com/maps/search/?api=1&query=Brahmandnayak+Shree+Swami+Samarth+Pratistan+Swami+Math" target="_blank" rel="noopener">Brahmandnayak Shree Swami Samarth Pratistan (Swami Math), HPHW+3VW, Madhukar Nagar, Chatale, Dahisar T. Mahim, Maharashtra 401102</a>
                                </li>
                                <li>
                                    <i class="far fa-building"></i>
                                    <span class="dv-trust-addr"><strong>Trust:</strong> A/601 Ashwant Star YK/NX, Virar West</span>
                                </li>
                            </ul>

                        </div>

                        <!-- Quick links -->
                        <div class="col-lg-2 col-md-6 col-6 footer-widget">
                            <h5 class="widget-title">महत्त्वाचे दुवे</h5>
                            <ul class="dv-links">
                                <li><a href="{{ route('home') }}">मुख्य पान</a></li>
                                <li><a href="{{ route('about') }}">प्रस्तावना</a></li>
                                <li><a href="{{ route('sampraday') }}">सम्प्रदाय</a></li>
                                <li><a href="{{ route('nityasmaran') }}">नित्यस्मरण</a></li>
                                <li><a href="{{ route('gallery') }}">चित्रदालन</a></li>
                                <li><a href="{{ route('contact') }}">संपर्क</a></li>
                                <li><a href="{{ route('donation') }}">देणगी</a></li>
                            </ul>
                        </div>

                        <!-- Location QR -->
                        <div class="col-lg-3 col-md-6 col-6 footer-widget">
                            <h5 class="widget-title">लोकेशन</h5>
                            <div class="dv-qr dv-qr-footer">
                                <img src="{{ asset('assets/frontend/images/QR/location.jpg') }}" alt="Location QR code" loading="lazy" />
                                <small>स्कॅन करा आणि लोकेशन उघडा</small>
                            </div>
                        </div>

                        <!-- WhatsApp QR -->
                        <div class="col-lg-3 col-md-6 footer-widget">
                            <h5 class="widget-title">WhatsApp ग्रुप</h5>
                            <div class="dv-qr dv-qr-footer">
                                <img src="{{ asset('assets/frontend/images/QR/whatsapp-group.jpg') }}" alt="WhatsApp group QR code" loading="lazy" />
                                <small>ग्रुपमध्ये सामील होण्यासाठी स्कॅन करा</small>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="sigma_footer-bottom">
                <div class="container">
                    <div class="dv-footer-bottom">
                        <p>© <?php echo date("Y"); ?> ब्रह्मांडनायक श्री स्वामी समर्थ प्रतिष्ठान. सर्व हक्क राखीव.</p>
                        <p class="dv-handcrafted" style="display:flex;flex-wrap:wrap;align-items:center;justify-content:center;gap:8px;">
                            <img class="dv-flag-wave" src="{{ asset('assets/frontend/images/flag-india.svg') }}" alt="India" height="20" style="height:20px;width:auto;" />
                            <span>Incredibly handcrafted by</span>
                            <a href="https://www.csismtechnologies.com/" target="_blank" rel="noopener" aria-label="CSISM Technologies">
                                <img class="dv-butterfly" src="{{ asset('assets/frontend/images/ashhwa-logo.png') }}" alt="CSISM Technologies" height="26" style="height:26px;width:auto;" />
                            </a>
                        </p>
                        <style>
                            .dv-flag-wave { transform-origin: left center; animation: dvFlagWave 2.2s ease-in-out infinite; }
                            @keyframes dvFlagWave {
                                0%, 100% { transform: perspective(200px) rotateY(0deg) skewY(0deg); }
                                25% { transform: perspective(200px) rotateY(-14deg) skewY(-3deg); }
                                75% { transform: perspective(200px) rotateY(14deg) skewY(3deg); }
                            }
                            .dv-butterfly { transform-origin: 50% 80%; animation: dvButterfly 1.1s ease-in-out infinite, dvFloat 3.2s ease-in-out infinite; }
                            @keyframes dvButterfly {
                                0%, 100% { transform: scaleX(1); }
                                50% { transform: scaleX(0.55); }
                            }
                            @keyframes dvFloat {
                                0%, 100% { translate: 0 0; rotate: 0deg; }
                                50% { translate: 0 -5px; rotate: -6deg; }
                            }
                            @media (prefers-reduced-motion: reduce) { .dv-flag-wave, .dv-butterfly { animation: none; } }
                        </style>
                        <ul class="sigma_sm square">
                            <li><a href="https://www.facebook.com/p/Brahmandnayak-100069185836486/" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="https://wa.me/917775037999" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a></li>
                            <li><a href="tel:+917775037999" aria-label="Call"><i class="fas fa-phone"></i></a></li>
                            <li><a href="mailto:bsssp.org@gmail.com" aria-label="Email"><i class="far fa-envelope"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- partial -->

