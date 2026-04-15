/**
 * みどり内科クリニック V2 - Main JavaScript
 * Swiper Hero Slider, Scroll Animations, Mobile Menu, Tabs
 */

document.addEventListener('DOMContentLoaded', function () {

  // ========================================
  // 1. Header Scroll Effect
  // ========================================
  var header = document.getElementById('site-header');
  var lastScroll = 0;

  function handleHeaderScroll() {
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    if (scrollTop > 50) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
    lastScroll = scrollTop;
  }

  window.addEventListener('scroll', handleHeaderScroll, { passive: true });
  handleHeaderScroll();

  // ========================================
  // 2. Mobile Menu Toggle
  // ========================================
  var menuToggle = document.getElementById('menu-toggle');
  var mainNav = document.getElementById('main-nav');
  var navOverlay = document.getElementById('nav-overlay');

  if (menuToggle && mainNav) {
    menuToggle.addEventListener('click', function () {
      menuToggle.classList.toggle('active');
      mainNav.classList.toggle('open');
      if (navOverlay) navOverlay.classList.toggle('open');
      document.body.style.overflow = mainNav.classList.contains('open') ? 'hidden' : '';
    });

    if (navOverlay) {
      navOverlay.addEventListener('click', function () {
        menuToggle.classList.remove('active');
        mainNav.classList.remove('open');
        navOverlay.classList.remove('open');
        document.body.style.overflow = '';
      });
    }

    // Close menu on nav link click
    var navLinks = mainNav.querySelectorAll('a');
    navLinks.forEach(function (link) {
      link.addEventListener('click', function () {
        menuToggle.classList.remove('active');
        mainNav.classList.remove('open');
        if (navOverlay) navOverlay.classList.remove('open');
        document.body.style.overflow = '';
      });
    });
  }

  // ========================================
  // 3. Swiper Hero Slider
  // ========================================
  if (typeof Swiper !== 'undefined' && document.querySelector('.hero-swiper')) {
    new Swiper('.hero-swiper', {
      effect: 'fade',
      fadeEffect: {
        crossFade: true,
      },
      loop: true,
      speed: 1000,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.hero-swiper .swiper-pagination',
        clickable: true,
      },
    });
  }

  // ========================================
  // 4. Intersection Observer - Fade In
  // ========================================
  var fadeElements = document.querySelectorAll('.fade-in, .fade-in-left, .fade-in-right');

  if ('IntersectionObserver' in window) {
    var fadeObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          fadeObserver.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.1,
      rootMargin: '0px 0px -60px 0px',
    });

    fadeElements.forEach(function (el) {
      fadeObserver.observe(el);
    });
  } else {
    // Fallback for older browsers
    fadeElements.forEach(function (el) {
      el.classList.add('visible');
    });
  }

  // ========================================
  // 5. Kensa Tab UI
  // ========================================
  var kensaTabs = document.querySelectorAll('.kensa-tab');
  var kensaPanels = document.querySelectorAll('.kensa-panel');

  kensaTabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      var target = this.getAttribute('data-tab');

      kensaTabs.forEach(function (t) {
        t.classList.remove('active');
        t.setAttribute('aria-selected', 'false');
      });
      kensaPanels.forEach(function (p) {
        p.classList.remove('active');
      });

      this.classList.add('active');
      this.setAttribute('aria-selected', 'true');

      var panel = document.getElementById('panel-' + target);
      if (panel) panel.classList.add('active');
    });
  });

  // ========================================
  // 6. Smooth Scroll for Anchor Links
  // ========================================
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      var href = this.getAttribute('href');
      if (href === '#') return;

      var target = document.querySelector(href);
      if (target) {
        e.preventDefault();
        var headerHeight = window.innerWidth <= 768 ? 64 : 90;
        var targetTop = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
        window.scrollTo({
          top: targetTop,
          behavior: 'smooth',
        });
      }
    });
  });

  // ========================================
  // 7. CSS Custom Property for Header Height
  // ========================================
  function setHeaderHeight() {
    var h = window.innerWidth <= 768 ? 64 : 90;
    document.documentElement.style.setProperty('--header-height', h + 'px');
  }
  setHeaderHeight();
  window.addEventListener('resize', setHeaderHeight);

});
