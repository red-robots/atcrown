import { runDelay } from './utils';

const CHILDREN_CLASS = 'nav__item--children';
const ACTIVE_CLASS = 'nav__item--active';

const showItem = el => el.classList.add(ACTIVE_CLASS);
const hideItem = el => el.classList.remove(ACTIVE_CLASS);
const toggleItem = el => el.classList.contains(ACTIVE_CLASS) ? hideItem(el) : showItem(el);

export const hoverChildrenNav = (nav) => {
  const hovers = nav.querySelectorAll(`.${CHILDREN_CLASS}`);

  let currentDisplay;
  let hoverTimeout;

  const hide = (hover) => {
    clearTimeout(hoverTimeout);
    hideItem(hover);
  };

  const startHide = (hover) => {
    hoverTimeout = runDelay(() => hide(hover), 500, hoverTimeout);
  };

  const show = (hover) => {
    if (currentDisplay) {
      hide(currentDisplay);
    }
    showItem(hover);
    hover.classList.add(ACTIVE_CLASS);
    currentDisplay = hover;
  };

  Object.keys(hovers).forEach((k) => {
    const hover = hovers[k];
    hover.addEventListener('mouseover', () => {
      show(hover);
    });
    hover.addEventListener('mouseout', () => {
      startHide(hover);
    });
  });
};

export const toggleChildrenNav = (nav) => {
  nav.querySelectorAll(`.${CHILDREN_CLASS}`).forEach((item) => {
    const control = item.querySelector('.nav__link');
    control.addEventListener('click', (e) => {
      e.preventDefault();
      toggleItem(item);
    });
  });
};

document.addEventListener('DOMContentLoaded', (e) => {
  document.querySelectorAll('.js-nav-toggle').forEach(toggleChildrenNav);
  document.querySelectorAll('.js-nav-hover').forEach(hoverChildrenNav);
});
