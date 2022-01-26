export const runDelay = (fn, delay, interval) => {
  clearInterval(interval);
  return setTimeout(fn, delay);
};