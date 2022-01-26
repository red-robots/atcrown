import { runDelay } from "./utils";

document.addEventListener('DOMContentLoaded', () => {
  const body = document.querySelector('.page__content');
  const footer = document.querySelector('.page__footer');
  let resizeTimeout;

  const updateFooter = () => {
    const r = footer.getBoundingClientRect();
    body.style.marginBottom = `${r.height}px`;
  };

  const updateFooterDelay = () => {
    resizeTimeout = runDelay(updateFooter, 500, resizeTimeout);
  };

  window.addEventListener('resize', updateFooterDelay);
  window.addEventListener('load', updateFooter);
  window.addEventListener('orientationchange', updateFooter);
});
