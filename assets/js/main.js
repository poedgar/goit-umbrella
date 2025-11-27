document.addEventListener("DOMContentLoaded", function() {
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
        }
      }
    });
  });
  const mobileMenuBtn = document.getElementById("mobile-menu-btn");
  const mobileMenu = document.getElementById("mobile-menu");
  if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener("click", function() {
      mobileMenu.classList.toggle("hidden");
    });
  }
});
//# sourceMappingURL=main.js.map
