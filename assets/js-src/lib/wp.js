(function(window, document) {
  let adminBar;
  let elements;
  let adminBarHeight;

  function avoidAdminBar() {
    requestAnimationFrame(avoidAdminBar);
    const r = adminBar.getBoundingClientRect();
    let h = r.height + r.top;
    if (h < 0) {
      h = 0;
    }
    if (typeof adminBarHeight === 'undefined' || h !== adminBarHeight) {
      adminBarHeight = h;
      elements.forEach(el => {
        el.style.marginTop = `${adminBarHeight}px`;
      });
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    adminBar = document.querySelector('#wpadminbar');
    elements = document.querySelectorAll('.js-avoid-admin-bar');
    if (adminBar && elements) {
      avoidAdminBar();
    }
  });
}(window, document));