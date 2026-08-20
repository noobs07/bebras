import './bootstrap';
import '../css/app.css';

document.addEventListener("DOMContentLoaded", () => {
  const btn = document.getElementById('mobile-menu-button')
  const menu = document.getElementById('mobile-menu')

  btn.addEventListener("click", (e) => {
    e.stopPropagation();
    menu.classList.toggle('hidden')
  })

  document.addEventListener("click", (e) => {
    if (!menu.contains(e.target) && !btn.contains(e.target)) {
      menu.classList.add("hidden");
    }
  });
})

document.addEventListener('DOMContentLoaded', () => {
  // Toggle helper
  const openMenu = (menu, btn) => {
    menu.classList.remove('hidden');
    if (btn) {
      btn.setAttribute('aria-expanded', 'true');
      const icon = btn.querySelector('svg');
      if (icon) icon.classList.add('rotate-180');
    }
  };
  const closeMenu = (menu, btn) => {
    menu.classList.add('hidden');
    if (btn) {
      btn.setAttribute('aria-expanded', 'false');
      const icon = btn.querySelector('svg');
      if (icon) icon.classList.remove('rotate-180');
    }
    // Tutup semua nested di dalamnya juga
    menu.querySelectorAll('.dropdown > .dropdown-menu:not(.hidden)').forEach(m => {
      const b = m.parentElement.querySelector(':scope > .dropdown-btn');
      closeMenu(m, b);
    });
  };
  const closeSiblingsAtSameLevel = (container, exceptMenu) => {
    const parent = container.parentElement;
    if (!parent) return;
    parent.querySelectorAll(':scope > .dropdown > .dropdown-menu:not(.hidden)').forEach(m => {
      if (m !== exceptMenu) {
        const b = m.parentElement.querySelector(':scope > .dropdown-btn');
        closeMenu(m, b);
      }
    });
  };
  const closeAll = () => {
    document.querySelectorAll('.dropdown > .dropdown-menu:not(.hidden)').forEach(m => {
      const b = m.parentElement.querySelector(':scope > .dropdown-btn');
      closeMenu(m, b);
    });
  };

  // Event delegation: klik tombol dropdown
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.dropdown-btn');
    if (btn) {
      const container = btn.closest('.dropdown');
      const menu = container.querySelector(':scope > .dropdown-menu');
      if (!menu) return;

      const isOpen = !menu.classList.contains('hidden');
      // Tutup saudara level yang sama (hanya satu terbuka per level)
      closeSiblingsAtSameLevel(container, menu);
      // Toggle menu yang diklik
      if (isOpen) closeMenu(menu, btn);
      else openMenu(menu, btn);
      return; // penting: jangan lanjut ke "klik di luar"
    }

    // Klik di luar semua dropdown -> tutup semua
    if (!e.target.closest('.dropdown')) {
      closeAll();
    }
  });

  // Klik link di menu -> tutup semua
  document.addEventListener('click', (e) => {
    const link = e.target.closest('.dropdown-menu a[href]');
    if (link) closeAll();
  });

  // ESC untuk tutup semua
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeAll();
  });
});


