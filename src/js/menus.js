document.addEventListener('DOMContentLoaded', function () {
  // Check if we're on XL screen before showing mobile menu
  function isXLScreen() {
    return window.innerWidth >= 1280; // Tailwind's XL breakpoint
  }

  // Smooth scroll for anchor links
  const smoothScrollLinks = document.querySelectorAll('a[href^="#"]');

  smoothScrollLinks.forEach((link) => {
    link.addEventListener('click', function (e) {
      const href = this.getAttribute('href');

      // Skip if it's just "#" or empty
      if (!href || href === '#') return;

      e.preventDefault();
      const targetElement = document.querySelector(href);

      if (targetElement) {
        const headerOffset = 80;
        const elementPosition = targetElement.getBoundingClientRect().top;
        const offsetPosition =
          elementPosition + window.pageYOffset - headerOffset;

        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth',
        });

        // Close mobile menu if open
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
          mobileMenu.classList.add('hidden');
          document.body.style.overflow = '';
        }
      }
    });
  });

  // Mobile menu toggle
  const mobileMenuBtn = document.getElementById('mobile-menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');

  if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener('click', function () {
      // Don't open mobile menu on XL screens
      if (isXLScreen()) return;

      const isHidden = mobileMenu.classList.contains('hidden');

      if (isHidden) {
        mobileMenu.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
      } else {
        mobileMenu.classList.add('hidden');
        document.body.style.overflow = '';
      }
    });
  }

  // Mobile menu close button
  const mobileCloseBtn = document.getElementById('mobile-close-btn');
  if (mobileCloseBtn && mobileMenu) {
    mobileCloseBtn.addEventListener('click', function () {
      mobileMenu.classList.add('hidden');
      document.body.style.overflow = '';
    });
  }

  // Desktop Ecosystem Dropdown
  const ecosystemBtn = document.getElementById('ecosystem-dropdown-btn');
  const ecosystemDropdown = document.getElementById('ecosystem-dropdown');
  const dropdownArrow = document.getElementById('dropdown-arrow');

  if (ecosystemBtn) {
    ecosystemBtn.addEventListener('click', () => {
      ecosystemDropdown.classList.toggle('hidden');
      dropdownArrow.classList.toggle('rotate-180');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
      if (
        !ecosystemBtn.contains(e.target) &&
        !ecosystemDropdown.contains(e.target)
      ) {
        ecosystemDropdown.classList.add('hidden');
        dropdownArrow.classList.remove('rotate-180');
      }
    });
  }

  // Mobile Ecosystem Dropdown
  const mobileEcosystemBtn = document.getElementById('mobile-ecosystem-btn');
  const mobileEcosystemDropdown = document.getElementById(
    'mobile-ecosystem-dropdown'
  );
  const mobileDropdownArrow = document.getElementById('mobile-dropdown-arrow');

  if (mobileEcosystemBtn) {
    mobileEcosystemBtn.addEventListener('click', () => {
      mobileEcosystemDropdown.classList.toggle('hidden');
      mobileDropdownArrow.classList.toggle('rotate-180');
    });
  }

  // Close mobile menu on ecosystem link click
  const mobileEcosystemLinks = document.querySelectorAll(
    '#mobile-ecosystem-dropdown a'
  );
  mobileEcosystemLinks.forEach((link) => {
    link.addEventListener('click', () => {
      mobileMenu.classList.add('hidden');
      document.body.style.overflow = '';
    });
  });

  // Close mobile menu when resizing to XL
  window.addEventListener('resize', function () {
    if (
      isXLScreen() &&
      mobileMenu &&
      !mobileMenu.classList.contains('hidden')
    ) {
      mobileMenu.classList.add('hidden');
      document.body.style.overflow = '';
    }
  });
});
