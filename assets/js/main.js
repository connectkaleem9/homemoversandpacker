/* ==========================================================================
   Home Movers & Packers — main.js
   Vanilla JS only. Everything here is progressive enhancement: navigation,
   forms and content all work with this file blocked.
   ========================================================================== */
(function () {
  'use strict';

  /* ----------------------------------------------------------------------
     Mobile navigation
     -------------------------------------------------------------------- */
  var toggle = document.querySelector('.nav-toggle');
  var nav = document.getElementById('primary-nav');

  if (toggle && nav) {
    toggle.addEventListener('click', function () {
      var open = nav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      toggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
      document.body.style.overflow = open ? 'hidden' : '';
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && nav.classList.contains('is-open')) {
        toggle.click();
        toggle.focus();
      }
    });
  }

  /* Dropdowns: click to open on touch/narrow screens, hover handles the rest. */
  var isNarrow = function () { return window.matchMedia('(max-width: 1024px)').matches; };

  document.querySelectorAll('.has-dropdown > .nav-link').forEach(function (link) {
    var parent = link.parentElement;

    link.addEventListener('click', function (e) {
      if (!isNarrow()) { return; }          // desktop: follow the link
      e.preventDefault();
      var open = parent.classList.toggle('is-open');
      link.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  });

  /* Close any open desktop dropdown when focus or a click leaves the header. */
  document.addEventListener('click', function (e) {
    if (isNarrow() || e.target.closest('.has-dropdown')) { return; }
    document.querySelectorAll('.has-dropdown.is-open').forEach(function (item) {
      item.classList.remove('is-open');
      var link = item.querySelector('.nav-link');
      if (link) { link.setAttribute('aria-expanded', 'false'); }
    });
  });

  /* ----------------------------------------------------------------------
     Sticky header shadow
     -------------------------------------------------------------------- */
  var header = document.getElementById('site-header');
  if (header) {
    var lastState = false;
    var onScroll = function () {
      var stuck = window.scrollY > 8;
      if (stuck !== lastState) {
        header.classList.toggle('is-stuck', stuck);
        lastState = stuck;
      }
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ----------------------------------------------------------------------
     Conversion tracking
     Pushes a dataLayer event for every phone / WhatsApp / quote / email CTA.
     Works with GTM when a container ID is configured, and stays silent
     (no errors) when tracking is not yet set up.
     -------------------------------------------------------------------- */
  function track(action, detail) {
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
      event: 'cta_click',
      cta_type: action,
      cta_detail: detail || '',
      page_path: window.location.pathname
    });
  }

  document.addEventListener('click', function (e) {
    var el = e.target.closest('.js-track');
    if (!el) { return; }
    track(el.getAttribute('data-cta') || 'unknown', el.textContent.trim().slice(0, 60));
  });

  /* ----------------------------------------------------------------------
     Form validation
     Server-side validation is authoritative; this only gives faster feedback.
     -------------------------------------------------------------------- */
  var UAE_PHONE = /^(?:\+?971|0)?5[0-9]{8}$/;
  var EMAIL = /^[^\s@]+@[^\s@]+\.[a-z]{2,}$/i;

  function fieldError(input, message) {
    var wrap = input.closest('.field');
    if (!wrap) { return; }
    var slot = wrap.querySelector('.field-error');
    if (!slot) {
      slot = document.createElement('span');
      slot.className = 'field-error';
      wrap.appendChild(slot);
    }
    slot.textContent = message || '';
    input.setAttribute('aria-invalid', message ? 'true' : 'false');
  }

  function validate(input) {
    var value = (input.value || '').trim();
    var required = input.hasAttribute('required');

    if (required && !value) {
      fieldError(input, 'This field is required.');
      return false;
    }
    if (!value) { fieldError(input, ''); return true; }

    if (input.type === 'tel' && !UAE_PHONE.test(value.replace(/[\s\-()]/g, ''))) {
      fieldError(input, 'Enter a valid UAE mobile number, e.g. 055 658 1781.');
      return false;
    }
    if (input.type === 'email' && !EMAIL.test(value)) {
      fieldError(input, 'Enter a valid email address.');
      return false;
    }
    if (input.name === 'name' && value.length < 2) {
      fieldError(input, 'Please enter your name.');
      return false;
    }
    fieldError(input, '');
    return true;
  }

  document.querySelectorAll('form[data-validate]').forEach(function (form) {
    var fields = form.querySelectorAll('input:not([type=hidden]), select, textarea');

    fields.forEach(function (input) {
      input.addEventListener('blur', function () { validate(input); });
      input.addEventListener('input', function () {
        if (input.getAttribute('aria-invalid') === 'true') { validate(input); }
      });
    });

    form.addEventListener('submit', function (e) {
      var valid = true;
      var firstBad = null;

      fields.forEach(function (input) {
        if (input.classList.contains('hp-input')) { return; }
        if (!validate(input)) {
          valid = false;
          if (!firstBad) { firstBad = input; }
        }
      });

      if (!valid) {
        e.preventDefault();
        if (firstBad) { firstBad.focus(); }
        return;
      }

      /* Let the server know how long the form was on screen (bot signal). */
      var elapsed = form.querySelector('input[name="form_elapsed"]');
      if (elapsed) {
        elapsed.value = String(Math.round((Date.now() - startedAt) / 1000));
      }

      track('form_submit', form.getAttribute('id') || 'form');

      var button = form.querySelector('button[type=submit]');
      if (button) {
        button.disabled = true;
        button.dataset.label = button.textContent;
        button.textContent = 'Sending…';
      }
    });
  });

  var startedAt = Date.now();

  /* ----------------------------------------------------------------------
     Scroll to a form that reported errors or success
     -------------------------------------------------------------------- */
  var alertBox = document.querySelector('.alert[data-focus]');
  if (alertBox) {
    alertBox.setAttribute('tabindex', '-1');
    alertBox.focus({ preventScroll: false });
  }
})();
