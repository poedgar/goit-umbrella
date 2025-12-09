function animateCounter(el, end, duration = 1000) {
  // Якщо рядок не містить цифр, просто вставляємо текст
  if (!/\d/.test(end)) {
    el.textContent = end;
    return;
  }

  // --- Діапазон, наприклад 5-17 ---
  if (end.includes('-')) {
    const parts = end.split('-');
    const first = parts[0]; // залишаємо статично
    const secondNum = parseFloat(parts[1].replace(',', '.')) || 0;

    let startTime;

    function step(timestamp) {
      if (!startTime) startTime = timestamp;
      const progress = Math.min((timestamp - startTime) / duration, 1);
      const value = Math.round(progress * secondNum);
      el.textContent = first + '-' + value;
      if (progress < 1) requestAnimationFrame(step);
    }

    requestAnimationFrame(step);
    return;
  }

  // --- Звичайне число з можливим суфіксом, наприклад 6500+, 76% ---
  const match = end.match(/^(\d+(\.\d+)?)(.*)$/);
  if (!match) {
    el.textContent = end;
    return;
  }

  const numeric = parseFloat(match[1]);
  const suffix = match[3] || '';

  let startTime;

  function step(timestamp) {
    if (!startTime) startTime = timestamp;
    const progress = Math.min((timestamp - startTime) / duration, 1);
    const value = Math.round(progress * numeric);
    el.textContent = value + suffix;
    if (progress < 1) requestAnimationFrame(step);
  }

  requestAnimationFrame(step);
}

function initCounters() {
  // Вибираємо всі лічильники, які знаходяться у li[data-counter-container]
  const sections = document.querySelectorAll('[data-counter-container]');

  sections.forEach((section) => {
    const counters = section.querySelectorAll('[data-counter]');
    if (!counters.length) return;

    const observer = new IntersectionObserver(
      (entries, obs) => {
        if (entries[0].isIntersecting) {
          counters.forEach((c) => animateCounter(c, c.dataset.counter));
          obs.disconnect(); // тільки для цього блоку
        }
      },
      {
        threshold: 0.1,
      }
    );

    observer.observe(section);
  });
}

initCounters();
