document.addEventListener('DOMContentLoaded', () => {
  const banner = document.getElementById('cookie-modal');
  const showMoreBtn = document.getElementById('show-more');
  const fullText = document.getElementById('cookie-full-text');
  const acceptBtn = document.getElementById('accept-cookies');
  const rejectBtn = document.getElementById('reject-cookies');

  // Перевірка localStorage: якщо користувач вже прийняв → не показуємо
  if (localStorage.getItem('cookie-consent') === 'accepted') {
    banner.style.display = 'none';
    document.body.style.overflow = '';
  } else {
    banner.style.display = 'flex';
    document.body.style.overflow = 'hidden';
  }

  // Детальніше
  if (showMoreBtn && fullText) {
    showMoreBtn.addEventListener('click', () => {
      fullText.classList.toggle('hidden');
      showMoreBtn.style.display = 'none';
    });
  }

  acceptBtn.addEventListener('click', () => {
    localStorage.setItem('cookie-consent', 'accepted');
    banner.style.display = 'none';
    document.body.style.overflow = '';
  });

  rejectBtn.addEventListener('click', () => {
    banner.style.display = 'none';
    document.body.style.overflow = '';
  });
});
