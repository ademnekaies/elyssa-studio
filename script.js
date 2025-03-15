document.addEventListener("DOMContentLoaded", () => {
  const logo = document.getElementById("logo");
  let isLogoMoved = false;

  // Continuous rotation and pulsating scale animation for the logo
  function animateLogo(timestamp) {
      if (!animateLogo.startTime) animateLogo.startTime = timestamp;
      const elapsed = timestamp - animateLogo.startTime;
      const rotation = elapsed * 0.05;
      const scale = 1 + 0.3 * Math.sin(elapsed / 300);
      logo.style.transform = `rotate(${rotation}deg) scale(${scale})`;
      requestAnimationFrame(animateLogo);
  }
  requestAnimationFrame(animateLogo);

  // Dynamic Navigation Generation
  const navItems = [
      { text: "Home", href: "#" },
      { text: "About", href: "about.html" },
      { text: "Portfolio", href: "portfolio.html" },
      { text: "Contact", href: "contact.php" },
      { text: "Login", href: "login.php" }
  ];

  function createMenu(items) {
      const ul = document.createElement("ul");
      items.forEach(item => {
          const li = document.createElement("li");
          const a = document.createElement("a");
          a.href = item.href;
          a.textContent = item.text;
          li.appendChild(a);
          ul.appendChild(li);
      });
      return ul;
  }

  const navContainer = document.getElementById("main-nav");
  if (navContainer) {
      navContainer.appendChild(createMenu(navItems));
  }

  // Update logo position when scrolling
  function updateLogoPosition() {
      const bestSection = document.querySelector(".best-section");
      const track2Item = document.querySelector(".best-items .best-item:nth-child(2)");
      if (!bestSection || !track2Item) return;
      
      const bestRect = bestSection.getBoundingClientRect();

      if (bestRect.top <= window.innerHeight * 0.5 && !isLogoMoved) {
          track2Item.appendChild(logo);
          logo.style.position = "relative";
          logo.style.margin = "10px auto";
          isLogoMoved = true;
      } else if (bestRect.top > window.innerHeight * 0.5 && isLogoMoved) {
          const logoSection = document.querySelector(".logo-section");
          logoSection.appendChild(logo);
          logo.style.position = "";
          logo.style.margin = "";
          isLogoMoved = false;
      }
  }

  window.addEventListener("scroll", updateLogoPosition);


  const bestSection = document.querySelector(".best-section");
  if (bestSection) {
      bestSection.style.opacity = 0;
      bestSection.style.transition = "opacity 1.5s ease-in-out";
      
      function revealBestSection() {
          const bestRect = bestSection.getBoundingClientRect();
          if (bestRect.top <= window.innerHeight * 0.8) {
              bestSection.style.opacity = 1;
              window.removeEventListener("scroll", revealBestSection);
          }
      }
      window.addEventListener("scroll", revealBestSection);
  }

  // Hide header on mobile when scrolling
  let lastScrollTop = 0;
  window.addEventListener("scroll", () => {
      if (window.innerWidth < 768) {
          const st = window.pageYOffset || document.documentElement.scrollTop;
          const header = document.querySelector("header");
          if (st > lastScrollTop) {
              header.classList.add("header-hidden");
          } else {
              header.classList.remove("header-hidden");
          }
          lastScrollTop = st <= 0 ? 0 : st;
      }
  });


  
    // Optional: Code for register/login container switching if needed
    const container = document.querySelector('.container');
    const registerBtn = document.querySelector('.register-btn');
    const loginBtn = document.querySelector('.login-btn');
  
    if (registerBtn && loginBtn && container) {
      registerBtn.addEventListener('click', () => {
        container.classList.add('active');
      });
  
      loginBtn.addEventListener('click', () => {
        container.classList.remove('active');
      });
    }
  
  


})