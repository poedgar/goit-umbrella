document.addEventListener('DOMContentLoaded', function () {
  // --- Helper: Toggle Animation Classes ---
  function toggleClasses(element, isOpen, closedClasses, openClasses) {
    if (isOpen) {
      element.classList.remove(...closedClasses);
      element.classList.add(...openClasses);
    } else {
      element.classList.remove(...openClasses);
      element.classList.add(...closedClasses);
    }
  }

  // ==========================================
  // 0. HEADER SHADOW ON SCROLL
  // ==========================================
  const header = document.querySelector('.header.bg-body.sticky');
  if (header) {
    const shadowClass = 'shadow-scrolled'; // CSS class to add shadow

    window.addEventListener('scroll', () => {
      if (window.scrollY > 0) {
        header.classList.add(shadowClass);
      } else {
        header.classList.remove(shadowClass);
      }
    });
  }

  // ==========================================
  // 1. DESKTOP DROPDOWN (Fade & Scale)
  // ==========================================
  const deskBtn = document.getElementById('ecosystem-dropdown-btn');
  const deskDropdown = document.getElementById('ecosystem-dropdown');
  const deskArrow = deskBtn ? deskBtn.querySelector('img') : null;
  let isDeskOpen = false;

  // Define states matching your HTML initial state
  const deskClosed = ['opacity-0', 'invisible', 'scale-95', 'translate-y-2'];
  const deskOpen = ['opacity-100', 'visible', 'scale-100', 'translate-y-0'];

  if (deskBtn && deskDropdown) {
    deskBtn.addEventListener('click', (e) => {
      e.stopPropagation(); // Prevent document click from closing immediately
      isDeskOpen = !isDeskOpen;

      toggleClasses(deskDropdown, isDeskOpen, deskClosed, deskOpen);

      // Rotate Arrow
      if (deskArrow)
        deskArrow.style.transform = isDeskOpen
          ? 'rotate(180deg)'
          : 'rotate(0deg)';

      // Toggle Button Rounded corners (Open = rounded-t, Closed = rounded)
      if (isDeskOpen) {
        deskBtn.classList.remove('rounded');
        deskBtn.classList.add('rounded-t');
      } else {
        deskBtn.classList.add('rounded');
        deskBtn.classList.remove('rounded-t');
      }
    });

    // Close when clicking outside
    document.addEventListener('click', (e) => {
      if (
        isDeskOpen &&
        !deskDropdown.contains(e.target) &&
        !deskBtn.contains(e.target)
      ) {
        isDeskOpen = false;
        toggleClasses(deskDropdown, false, deskClosed, deskOpen);
        if (deskArrow) deskArrow.style.transform = 'rotate(0deg)';
        deskBtn.classList.add('rounded');
        deskBtn.classList.remove('rounded-t');
      }
    });
  }

  // ==========================================
  // 2. MOBILE MENU (Slide In)
  // ==========================================
  const mobileMenuBtn = document.getElementById('mobile-menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  const mobileCloseBtn = document.getElementById('mobile-close-btn');
  // console.log(mobileCloseBtn);

  function toggleMobileMenu(show) {
    if (!mobileMenu) return;

    if (show) {
      // Remove translate-x-full to slide in
      mobileMenu.classList.remove('translate-x-full');
      document.body.style.overflow = 'hidden'; // Lock scroll
    } else {
      // Add translate-x-full to slide out
      mobileMenu.classList.add('translate-x-full');
      document.body.style.overflow = ''; // Unlock scroll
    }
  }

  if (mobileMenuBtn)
    mobileMenuBtn.addEventListener('click', () => toggleMobileMenu(true));
  if (mobileCloseBtn)
    mobileCloseBtn.addEventListener('click', () => toggleMobileMenu(false));

  // ==========================================
  // 3. MOBILE DROPDOWN (Accordion Height)
  // ==========================================
  const mobEcoBtn = document.getElementById('mobile-ecosystem-btn');
  const mobEcoDropdown = document.getElementById('mobile-ecosystem-dropdown');
  const mobArrow = mobEcoBtn ? mobEcoBtn.querySelector('img') : null;

  if (mobEcoBtn && mobEcoDropdown) {
    mobEcoBtn.addEventListener('click', () => {
      // Check current height
      const isOpen = mobEcoDropdown.style.maxHeight;

      if (isOpen) {
        // CLOSE
        mobEcoDropdown.style.maxHeight = null;
        mobEcoDropdown.classList.remove('opacity-100');
        mobEcoDropdown.classList.add('opacity-0');
        if (mobArrow) mobArrow.style.transform = 'rotate(0deg)';

        // Toggle rounded corners
        mobEcoBtn.classList.add('rounded');
        mobEcoBtn.classList.remove('rounded-t');
      } else {
        // OPEN
        mobEcoDropdown.classList.remove('opacity-0');
        mobEcoDropdown.classList.add('opacity-100');

        // Set height to content height
        mobEcoDropdown.style.maxHeight = mobEcoDropdown.scrollHeight + 'px';
        if (mobArrow) mobArrow.style.transform = 'rotate(180deg)';

        // Toggle rounded corners
        mobEcoBtn.classList.remove('rounded');
        mobEcoBtn.classList.add('rounded-t');
      }
    });
  }
});
