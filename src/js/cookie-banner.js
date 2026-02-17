document.addEventListener('DOMContentLoaded', () => {
  const banner = document.getElementById('cookie-modal');
  const showMoreBtn = document.getElementById('show-more');
  const fullText = document.getElementById('cookie-full-text');
  const acceptBtn = document.getElementById('accept-cookies');
  const rejectBtn = document.getElementById('reject-cookies');

  const CONSENT_KEY = 'cookie-consent';

  function openBanner() {
    banner.style.display = 'flex';
    document.body.style.overflow = 'hidden';
  }

  function closeBanner() {
    banner.style.display = 'none';
    document.body.style.overflow = '';
  }

  function loadAnalyticsScripts() {
    // Тут підключається аналітика (Google Analytics / Facebook Pixel / Ads)
    // Скрипти повинні завантажуватись тільки після згоди користувача
  }

  const consent = localStorage.getItem(CONSENT_KEY);

  if (!consent) {
    openBanner();
  } else {
    closeBanner();

    if (consent === 'accepted') {
      loadAnalyticsScripts();
    }
  }

  if (showMoreBtn && fullText) {
    showMoreBtn.addEventListener('click', () => {
      fullText.classList.remove('hidden');
      showMoreBtn.style.display = 'none';
    });
  }

  if (acceptBtn) {
    acceptBtn.addEventListener('click', () => {
      localStorage.setItem(CONSENT_KEY, 'accepted');
      loadAnalyticsScripts();
      closeBanner();
    });
  }

  if (rejectBtn) {
    rejectBtn.addEventListener('click', () => {
      localStorage.setItem(CONSENT_KEY, 'rejected');
      closeBanner();
    });
  }
});
