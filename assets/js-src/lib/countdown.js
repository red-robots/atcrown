(function(window, document) {
  const SECOND = 1000;
  const MINUTE = SECOND * 60;
  const HOUR = MINUTE * 60;
  const DAY = HOUR * 24;

  const config = {
    Days: DAY,
    Hours: HOUR,
    Minutes: MINUTE,
    Seconds: SECOND,
  };

  const init = (el) => {
    const date = el.getAttribute('data-date');
    const content = el.querySelector('.js-countdown-content');
    const endDate = new Date(date);
    let diff = endDate - new Date();

    const valueElements = {};

    Object.keys(config).forEach(label => {
      const el = document.createElement('div');
      el.className = 'countdown__el';
      const valEl = document.createElement('span');
      valEl.className = 'countdown__value';
      const labelEl = document.createElement('span');
      labelEl.className = 'countdown__label';
      labelEl.innerText = label;
      el.appendChild(valEl);
      el.appendChild(labelEl);
      valueElements[label] = valEl;
      content.appendChild(el);
    });

    const updateValues = () => {
      let current;
      let newDiff = diff;
      Object.keys(config).forEach(label => {
        current = Math.floor(newDiff / config[label]);
        valueElements[label].innerText = current >= 0 ? current : 0;
        newDiff -= current * config[label];
      });
      diff = diff - SECOND;
    };

    updateValues();
    setInterval(updateValues, SECOND);
  };

  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.js-countdown').forEach(init);
  });
})(window, document);