// Mobile Menu Toggle
const mobileMenuBtn = document.getElementById("mobileMenuBtn");
const mainNav = document.getElementById("mainNav");

// Cek jika tombol menu mobile ada
if (mobileMenuBtn && mainNav) {
  mobileMenuBtn.addEventListener("click", () => {
    // Di file HTML/PHP Anda, nav id="mainNav" berisi ul.
    // Jadi kita targetkan ul di dalamnya untuk toggle class.
    const navUl = mainNav.querySelector("ul");
    if (navUl) {
      navUl.classList.toggle("show"); // Menggunakan class .show seperti di pendaftaran.php
    } else {
      mainNav.classList.toggle("active"); // Fallback jika tidak ada ul
    }
  });
}


// Dropdown menu functionality
const toggle = document.getElementById("dropdownToggle");
const menu = document.getElementById("dropdownMenu");

// Cek jika elemen dropdown ada
if (toggle && menu) {
  toggle.addEventListener("click", function (e) {
    e.preventDefault();
    menu.classList.toggle("show");
  });

  // Tutup dropdown jika klik di luar
  document.addEventListener("click", function (e) {
    if (!toggle.contains(e.target) && !menu.contains(e.target)) {
      menu.classList.remove("show");
    }
  });
}


// Smooth Scrolling for Anchor Links
document.querySelectorAll('a[href*="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    const targetId = this.getAttribute("href");
    
    // Hanya lakukan smooth scroll jika linknya adalah anchor di halaman yang sama
    if (targetId.startsWith("#")) {
      e.preventDefault();
      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        window.scrollTo({
          top: targetElement.offsetTop - 80, // Sesuaikan offset jika header fixed
          behavior: "smooth",
        });
        // Tutup menu mobile jika terbuka
        if (mainNav && mainNav.classList.contains("active")) {
          mainNav.classList.remove("active");
        }
      }
    }
  });
});


// Calendar Functionality
const prevMonthBtn = document.getElementById("prevMonth");
const nextMonthBtn = document.getElementById("nextMonth");
const calendarGrid = document.getElementById("calendarGrid");

// HANYA jalankan kode kalender jika elemennya ada di halaman ini
if (prevMonthBtn && nextMonthBtn && calendarGrid) {
  let currentDate = new Date();
  let currentMonth = currentDate.getMonth();
  let currentYear = currentDate.getFullYear();

  function renderCalendar(month, year) {
    calendarGrid.innerHTML = "";
    const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    document.querySelector(".calendar-title").textContent = `${monthNames[month]} ${year}`;
    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const dayNames = ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"];
    dayNames.forEach((day) => {
      const dayElement = document.createElement("div");
      dayElement.className = "calendar-day-header";
      dayElement.textContent = day;
      calendarGrid.appendChild(dayElement);
    });
    for (let i = 0; i < firstDay; i++) {
      const emptyCell = document.createElement("div");
      emptyCell.className = "calendar-day";
      calendarGrid.appendChild(emptyCell);
    }
    for (let day = 1; day <= daysInMonth; day++) {
      const dayElement = document.createElement("div");
      dayElement.className = "calendar-day";
      dayElement.textContent = day;
      if (day === currentDate.getDate() && month === currentDate.getMonth() && year === currentDate.getFullYear()) {
        dayElement.classList.add("current-day");
      }
      if (day === 15 || day === 20 || day === 25) { // Contoh event
        dayElement.classList.add("event-day");
      }
      calendarGrid.appendChild(dayElement);
    }
  }

  renderCalendar(currentMonth, currentYear);

  prevMonthBtn.addEventListener("click", () => {
    currentMonth--;
    if (currentMonth < 0) {
      currentMonth = 11;
      currentYear--;
    }
    renderCalendar(currentMonth, currentYear);
  });

  nextMonthBtn.addEventListener("click", () => {
    currentMonth++;
    if (currentMonth > 11) {
      currentMonth = 0;
      currentYear++;
    }
    renderCalendar(currentMonth, currentYear);
  });
}


// Chatbot Functionality
const chatbotBtn = document.getElementById("chatbotBtn");
const chatbotWindow = document.getElementById("chatbotWindow");

// HANYA jalankan kode chatbot jika elemennya ada
if (chatbotBtn && chatbotWindow) {
  const chatbotClose = document.getElementById("chatbotClose");
  const chatbotMessages = document.getElementById("chatbotMessages");
  const chatbotInput = document.getElementById("chatbotInput");
  const chatbotSend = document.getElementById("chatbotSend");

  chatbotBtn.addEventListener("click", () => {
    chatbotWindow.classList.toggle("active");
  });

  chatbotClose.addEventListener("click", () => {
    chatbotWindow.classList.remove("active");
  });

  function sendMessage() {
    const message = chatbotInput.value.trim();
    if (message) {
      addMessage(message, "user");
      chatbotInput.value = "";
      setTimeout(() => {
        const botResponse = getBotResponse(message);
        addMessage(botResponse, "bot");
      }, 500);
    }
  }

  chatbotSend.addEventListener("click", sendMessage);
  chatbotInput.addEventListener("keypress", (e) => {
    if (e.key === "Enter") {
      sendMessage();
    }
  });

  function addMessage(text, sender) {
    const messageElement = document.createElement("div");
    messageElement.className = `message ${sender}-message`;
    messageElement.textContent = text;
    chatbotMessages.appendChild(messageElement);
    chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
  }
  
  // (Fungsi getBotResponse Anda ditaruh di sini)
  function getBotResponse(message) {
    const lowerMessage = message.toLowerCase();
      const responses = [
          { keywords: ["halo", "hai", "hi"], response: "Halo! Ada yang bisa saya bantu?" },
          { keywords: ["pendaftaran", "daftar"], response: "Informasi pendaftaran siswa baru bisa Anda temukan di menu Pendaftaran." },
          { keywords: ["kalender", "jadwal"], response: "Kalender akademik sekolah bisa dilihat di menu Kalender pada website kami." },
          { keywords: ["alamat", "lokasi"], response: "SMA ELITE HARAPAN BANGSA berada di Jl elite. Pendidikan No. 123, Kota jakarta elite." },
          { keywords: ["terima kasih", "thanks"], response: "Sama-sama! Jika ada pertanyaan lain, jangan ragu untuk bertanya." }
      ];
      for (const item of responses) {
          if (item.keywords.some(keyword => lowerMessage.includes(keyword))) {
              return item.response;
          }
      }
      return "Maaf, saya tidak mengerti. Untuk info lebih lanjut, hubungi kontak sekolah.";
  }
}

/* ===== JAVASCRIPT UNTUK MODAL LOGIN ===== */
document.addEventListener('DOMContentLoaded', function() {
    
    const loginModal = document.getElementById('loginModal');
    const loginBtn = document.getElementById('loginModalBtn');
    const closeLoginBtn = document.getElementById('closeLoginModal');

    // Jika tombol login ada, tambahkan event listener
    if (loginBtn) {
        loginBtn.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah link pindah halaman
            loginModal.style.display = 'flex';
        });
    }

    // Fungsi untuk menutup modal
    function closeModal() {
        loginModal.style.display = 'none';
    }

    // Tombol close (X) di dalam modal
    if (closeLoginBtn) {
        closeLoginBtn.addEventListener('click', closeModal);
    }

    // Klik di area luar modal (latar belakang gelap) akan menutup modal
    loginModal.addEventListener('click', function(event) {
        if (event.target === loginModal) {
            closeModal();
        }
    });

    // Cek jika ada parameter error di URL
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');
    if (error) {
        loginModal.style.display = 'flex'; // Tampilkan modal
        const errorDiv = document.getElementById('loginError');
        errorDiv.textContent = error; // Tampilkan pesan error
        errorDiv.style.display = 'block';
    }
});