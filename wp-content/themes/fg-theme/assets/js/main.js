// Mobile nav toggle
const toggle = document.querySelector('.nav-toggle');
const nav    = document.querySelector('.site-nav');

if (toggle && nav) {
  toggle.addEventListener('click', () => {
    const open = toggle.getAttribute('aria-expanded') === 'true';
    toggle.setAttribute('aria-expanded', String(!open));
    nav.classList.toggle('is-open', !open);
  });

  // Cerrar al pulsar fuera del menú
  document.addEventListener('click', (e) => {
    if (nav.classList.contains('is-open') && !nav.contains(e.target) && !toggle.contains(e.target)) {
      toggle.setAttribute('aria-expanded', 'false');
      nav.classList.remove('is-open');
    }
  });
}

// Testimonial carousel
const testimonials = document.querySelectorAll('.testimonial');
const dots         = document.querySelectorAll('.testimonial-dot');

if (testimonials.length && dots.length) {
  function showTestimonial(index) {
    testimonials.forEach((t, i) => t.classList.toggle('is-active', i === index));
    dots.forEach((d, i) => d.classList.toggle('is-active', i === index));
  }

  dots.forEach((dot, i) => {
    dot.addEventListener('click', () => showTestimonial(i));
  });
}
