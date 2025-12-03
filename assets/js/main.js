document.addEventListener("DOMContentLoaded", function() {
  function isXLScreen() {
    return window.innerWidth >= 1280;
  }
  const smoothScrollLinks = document.querySelectorAll('a[href^="#"]');
  smoothScrollLinks.forEach((link) => {
    link.addEventListener("click", function(e) {
      const href = this.getAttribute("href");
      if (!href || href === "#")
        return;
      e.preventDefault();
      const targetElement = document.querySelector(href);
      if (targetElement) {
        const headerOffset = 80;
        const elementPosition = targetElement.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
        window.scrollTo({
          top: offsetPosition,
          behavior: "smooth"
        });
        const mobileMenu2 = document.getElementById("mobile-menu");
        if (mobileMenu2 && !mobileMenu2.classList.contains("hidden")) {
          mobileMenu2.classList.add("hidden");
          document.body.style.overflow = "";
        }
      }
    });
  });
  const mobileMenuBtn = document.getElementById("mobile-menu-btn");
  const mobileMenu = document.getElementById("mobile-menu");
  if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener("click", function() {
      if (isXLScreen())
        return;
      const isHidden = mobileMenu.classList.contains("hidden");
      if (isHidden) {
        mobileMenu.classList.remove("hidden");
        document.body.style.overflow = "hidden";
      } else {
        mobileMenu.classList.add("hidden");
        document.body.style.overflow = "";
      }
    });
  }
  const mobileCloseBtn = document.getElementById("mobile-close-btn");
  if (mobileCloseBtn && mobileMenu) {
    mobileCloseBtn.addEventListener("click", function() {
      mobileMenu.classList.add("hidden");
      document.body.style.overflow = "";
    });
  }
  const ecosystemBtn = document.getElementById("ecosystem-dropdown-btn");
  const ecosystemDropdown = document.getElementById("ecosystem-dropdown");
  const dropdownArrow = document.getElementById("dropdown-arrow");
  if (ecosystemBtn) {
    ecosystemBtn.addEventListener("click", () => {
      ecosystemDropdown.classList.toggle("hidden");
      dropdownArrow.classList.toggle("rotate-180");
    });
    document.addEventListener("click", (e) => {
      if (!ecosystemBtn.contains(e.target) && !ecosystemDropdown.contains(e.target)) {
        ecosystemDropdown.classList.add("hidden");
        dropdownArrow.classList.remove("rotate-180");
      }
    });
  }
  const mobileEcosystemBtn = document.getElementById("mobile-ecosystem-btn");
  const mobileEcosystemDropdown = document.getElementById(
    "mobile-ecosystem-dropdown"
  );
  const mobileDropdownArrow = document.getElementById("mobile-dropdown-arrow");
  if (mobileEcosystemBtn) {
    mobileEcosystemBtn.addEventListener("click", () => {
      mobileEcosystemDropdown.classList.toggle("hidden");
      mobileDropdownArrow.classList.toggle("rotate-180");
    });
  }
  const mobileEcosystemLinks = document.querySelectorAll(
    "#mobile-ecosystem-dropdown a"
  );
  mobileEcosystemLinks.forEach((link) => {
    link.addEventListener("click", () => {
      mobileMenu.classList.add("hidden");
      document.body.style.overflow = "";
    });
  });
  window.addEventListener("resize", function() {
    if (isXLScreen() && mobileMenu && !mobileMenu.classList.contains("hidden")) {
      mobileMenu.classList.add("hidden");
      document.body.style.overflow = "";
    }
  });
});
//# sourceMappingURL=main.js.map
