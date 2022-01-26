import { request } from "http";





// Mobile Navigation
function mobileNavigation() {
  const BODY_MOBILE_NAV_CLASS = 'body--mobile-nav-active';
  const mobileNavControls = document.querySelectorAll('.js-mobile-nav-control');
  const mobileNav = document.querySelector('.js-mobile-nav');
  const body = document.body;

  const show = () => body.classList.add(BODY_MOBILE_NAV_CLASS);
  const hide = () => body.classList.remove(BODY_MOBILE_NAV_CLASS);
  const toggle = () => body.classList.contains(BODY_MOBILE_NAV_CLASS) ? hide() : show();

  Object.keys(mobileNavControls).forEach(k => mobileNavControls[k].addEventListener('click', toggle));

  document.addEventListener('click', (e) => {
    if (e.target === mobileNav) {
      hide();
    }
  });
}

const BODY_SCROLL_CLASS = 'body--scroll-top';
let isScrollTop = false;

function updateBodyScrollClass() {
  const scrollTopCheck = !window.scrollY;
  if (scrollTopCheck !== isScrollTop) {
    if (!scrollTopCheck) {
      document.body.classList.remove(BODY_SCROLL_CLASS);
    } else {
      document.body.classList.add(BODY_SCROLL_CLASS);
    }
    isScrollTop = scrollTopCheck;
  }
  requestAnimationFrame(updateBodyScrollClass);
}

document.addEventListener('DOMContentLoaded', () => {
  mobileNavigation();
  updateBodyScrollClass();
});



