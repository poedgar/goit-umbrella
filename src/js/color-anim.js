document.addEventListener('DOMContentLoaded', () => {
  const pause = 1500; // пауза між діями (мс)

  function animateCards(selector) {
    const overlays = Array.from(document.querySelectorAll(selector)).slice(
      0,
      3,
    );

    let index = 0;

    // Старт: всі картки “закриті” (overlay видимий)
    overlays.forEach((o) => (o.style.opacity = 1));

    function nextStep() {
      if (index < overlays.length) {
        // Відкриваємо поточну картку
        overlays[index].style.opacity = 0;

        // Закриваємо попередню, якщо потрібно
        if (index > 0) overlays[index - 1].style.opacity = 1;

        index++;
        setTimeout(nextStep, pause);
      } else if (index === overlays.length) {
        // Всі одночасно відкриті
        overlays.forEach((o) => (o.style.opacity = 0));
        index++;
        setTimeout(nextStep, pause);
      } else {
        // Всі знову закриті
        overlays.forEach((o) => (o.style.opacity = 1));
        index = 0;
        setTimeout(nextStep, pause);
      }
    }

    nextStep();
  }

  // Запускаємо окремо для мобайл і десктоп
  animateCards('.animated-card.mobile .overlay');
  animateCards('.animated-card.desktop .overlay');
});
