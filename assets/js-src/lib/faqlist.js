((document, window) => {
  const CHECK_CLASS = 'js-faqlist-toggle';
  const ACTIVE_CLASS = 'faqlist__toggle--active';
  const HOVER_CLASS = 'faqlist__toggle--hover';


  function findClosest(el, selector) {
    if (el.matches(selector)) {
      return el;
    }
    if (el.parentElement) {
      return findClosest(el.parentElement, selector);
    }
    return false;
  }

  document.addEventListener('click', (e) => {
    if (!e.target || !e.target.classList) {
      return null;
    }

    const toggle = findClosest(e.target, '.js-faqlist-toggle');

    if (!toggle) {
      return null;
    }

    if (toggle.classList.contains(CHECK_CLASS)) {
      if (toggle.classList.contains(ACTIVE_CLASS)) {
        toggle.classList.remove(ACTIVE_CLASS);
      } else {
        toggle.classList.add(ACTIVE_CLASS);
      }
    }
  });

  document.addEventListener('mouseover', (e) => {
    if (!e.target || !e.target.classList || e.target.tagName === 'A') {
      return null;
    }
    if (e.target.classList.contains(CHECK_CLASS)) {
      e.target.classList.add(HOVER_CLASS);
    }
  }, true);

  document.addEventListener('mouseout', (e) => {
    if (!e.target || !e.target.classList) {
      return null;
    }
    if (e.target.classList.contains(CHECK_CLASS)) {
      e.target.classList.remove(HOVER_CLASS);
    }
  }, true);

})(document, window);
