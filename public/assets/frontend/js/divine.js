/* Divine theme: scroll reveal, progress bar, falling petals, counters. */
(function () {
    "use strict";
    var reduce = window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    // scroll progress bar
    var bar = document.createElement("div");
    bar.className = "dv-progress";
    document.body.appendChild(bar);
    function onScroll() {
        var h = document.documentElement;
        var max = h.scrollHeight - h.clientHeight;
        bar.style.width = (max > 0 ? (h.scrollTop / max) * 100 : 0) + "%";
    }
    window.addEventListener("scroll", onScroll, { passive: true });
    onScroll();

    // fixed header: reserve its height so content is not hidden underneath
    var hdr = document.querySelector(".sigma_header.can-sticky");
    function fitHeader() {
        if (!hdr) return;
        var h = hdr.offsetHeight;
        document.documentElement.style.setProperty("--dv-header-h", h + "px");
        document.body.classList.add("dv-has-fixed-header");
    }
    if (hdr) {
        fitHeader();
        window.addEventListener("resize", fitHeader);
        window.addEventListener("load", fitHeader);
    }

    // scroll reveal
    var selectors = [
        ".section .row > [class*='col-']",
        ".section .card",
        ".section .blockquote",
        ".section h1", ".section h2", ".section h3",
        ".section p", ".section .img-group", ".section img",
        ".sigma_btn-custom:not(.donate_nav)",
        ".sigma_footer .footer-widget"
    ];
    var els = document.querySelectorAll(selectors.join(","));
    var seen = new Set();
    var list = [];
    els.forEach(function (el) {
        // skip children whose ancestor is already revealed, to avoid double fading
        for (var p = el.parentElement; p; p = p.parentElement) {
            if (seen.has(p)) return;
        }
        seen.add(el);
        list.push(el);
    });
    list.forEach(function (el, i) {
        el.classList.add("dv-reveal");
        var col = el.matches("[class*='col-']");
        if (col) {
            var idx = Array.prototype.indexOf.call(el.parentElement.children, el);
            if (idx % 2 === 0) el.classList.add("dv-left");
            else el.classList.add("dv-right");
            el.style.setProperty("--dv-delay", Math.min(idx, 5) * 90 + "ms");
        } else if (el.tagName === "IMG") {
            el.classList.add("dv-zoom");
        }
    });

    if ("IntersectionObserver" in window && !reduce) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) {
                    e.target.classList.add("dv-in");
                    io.unobserve(e.target);
                }
            });
        }, { threshold: 0.12, rootMargin: "0px 0px -40px 0px" });
        list.forEach(function (el) { io.observe(el); });
    } else {
        list.forEach(function (el) { el.classList.add("dv-in"); });
    }

    // soft falling petals (light, desktop + tablet only)
    if (!reduce && window.innerWidth > 575) {
        var wrap = document.createElement("div");
        wrap.className = "dv-petals";
        for (var i = 0; i < 14; i++) {
            var p = document.createElement("span");
            p.className = "dv-petal";
            p.style.left = Math.random() * 100 + "%";
            p.style.setProperty("--dx", (Math.random() * 160 - 80) + "px");
            p.style.animationDuration = 12 + Math.random() * 14 + "s";
            p.style.animationDelay = -Math.random() * 20 + "s";
            var s = 8 + Math.random() * 10;
            p.style.width = p.style.height = s + "px";
            wrap.appendChild(p);
        }
        document.body.appendChild(wrap);
    }

    // active menu highlight
    var here = location.pathname.replace(/\/$/, "");
    document.querySelectorAll(".sigma_header .navbar-nav > .menu-item > a").forEach(function (a) {
        try {
            var u = new URL(a.href, location.origin);
            if (u.pathname.replace(/\/$/, "") === here) a.parentElement.classList.add("active");
        } catch (e) { /* ignore */ }
    });
})();
