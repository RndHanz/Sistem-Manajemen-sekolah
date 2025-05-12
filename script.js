// Mobile Menu Toggle
const mobileMenuBtn = document.getElementById("mobileMenuBtn");
const mainNav = document.getElementById("mainNav");

mobileMenuBtn.addEventListener("click", () => {
  mainNav.classList.toggle("active");
});

// Smooth Scrolling for Anchor Links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();

    const targetId = this.getAttribute("href");
    const targetElement = document.querySelector(targetId);

    if (targetElement) {
      window.scrollTo({
        top: targetElement.offsetTop - 80,
        behavior: "smooth",
      });

      // Close mobile menu if open
      mainNav.classList.remove("active");
    }
  });
});

// Calendar Functionality
const prevMonthBtn = document.getElementById("prevMonth");
const nextMonthBtn = document.getElementById("nextMonth");
const calendarGrid = document.getElementById("calendarGrid");

let currentDate = new Date();
let currentMonth = currentDate.getMonth();
let currentYear = currentDate.getFullYear();

function renderCalendar(month, year) {
  // Clear previous calendar
  calendarGrid.innerHTML = "";

  // Set month and year in header
  const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
  document.querySelector(".calendar-title").textContent = `${monthNames[month]} ${year}`;

  // Get first day of month and total days in month
  const firstDay = new Date(year, month, 1).getDay();
  const daysInMonth = new Date(year, month + 1, 0).getDate();

  // Create day headers
  const dayNames = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
  dayNames.forEach((day) => {
    const dayElement = document.createElement("div");
    dayElement.className = "calendar-day-header";
    dayElement.textContent = day.substring(0, 3);
    calendarGrid.appendChild(dayElement);
  });

  // Add empty cells for days before first day of month
  for (let i = 0; i < firstDay; i++) {
    const emptyCell = document.createElement("div");
    emptyCell.className = "calendar-day";
    calendarGrid.appendChild(emptyCell);
  }

  // Add days of month
  for (let day = 1; day <= daysInMonth; day++) {
    const dayElement = document.createElement("div");
    dayElement.className = "calendar-day";
    dayElement.textContent = day;

    // Highlight current day
    if (day === currentDate.getDate() && month === currentDate.getMonth() && year === currentDate.getFullYear()) {
      dayElement.classList.add("current-day");
    }

    // Mark days with events (example: 5th, 15th, 25th)
    if (day === 5 || day === 15 || day === 25) {
      dayElement.classList.add("event-day");
    }

    calendarGrid.appendChild(dayElement);
  }
}

// Initial calendar render
renderCalendar(currentMonth, currentYear);

// Previous month button
prevMonthBtn.addEventListener("click", () => {
  currentMonth--;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }
  renderCalendar(currentMonth, currentYear);
});

// Next month button
nextMonthBtn.addEventListener("click", () => {
  currentMonth++;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  }
  renderCalendar(currentMonth, currentYear);
});

// Chatbot Functionality
const chatbotBtn = document.getElementById("chatbotBtn");
const chatbotWindow = document.getElementById("chatbotWindow");
const chatbotClose = document.getElementById("chatbotClose");
const chatbotMessages = document.getElementById("chatbotMessages");
const chatbotInput = document.getElementById("chatbotInput");
const chatbotSend = document.getElementById("chatbotSend");

// Toggle chatbot window
chatbotBtn.addEventListener("click", () => {
  chatbotWindow.classList.toggle("active");
});

// Close chatbot
chatbotClose.addEventListener("click", () => {
  chatbotWindow.classList.remove("active");
});

// Send message
function sendMessage() {
  const message = chatbotInput.value.trim();
  if (message) {
    // Add user message
    addMessage(message, "user");
    chatbotInput.value = "";

    // Bot response
    setTimeout(() => {
      const botResponse = getBotResponse(message);
      addMessage(botResponse, "bot");
    }, 500);
  }
}

// Send message on button click or Enter key
chatbotSend.addEventListener("click", sendMessage);
chatbotInput.addEventListener("keypress", (e) => {
  if (e.key === "Enter") {
    sendMessage();
  }
});

// Add message to chat
function addMessage(text, sender) {
  const messageElement = document.createElement("div");
  messageElement.className = `message ${sender}-message`;
  messageElement.textContent = text;
  chatbotMessages.appendChild(messageElement);
  chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
}

// Simple bot responses
function getBotResponse(message) {
  const lowerMessage = message.toLowerCase();

  const responses = [
    {
      keywords: ["halo", "hai", "hi", "hallo", "aku mau tanya"],
      response: "Halo! Ada yang bisa saya bantu?",
    },
    {
      keywords: ["pendaftaran", "daftar"],
      response: "Informasi pendaftaran siswa baru bisa Anda temukan di menu Pendaftaran atau dengan mengunjungi link ini: [Link Pendaftaran]",
    },
    {
      keywords: ["tanya", "ada"],
      response: "Silakan ingin bertanya tentang apa?",
    },
    {
      keywords: ["kalender", "jadwal"],
      response: "Kalender akademik sekolah bisa dilihat di menu Kalender pada website kami.",
    },
    {
      keywords: ["alamat", "lokasi"],
      response: "SMA ELITE HARAPAN BANGSA berada di Jl elite. Pendidikan No. 123, Kota jakarta elite. Lihat peta di footer website.",
    },
    {
      keywords: ["terima kasih", "thanks", "makasih", "bagus"],
      response: "Sama-sama! Jika ada pertanyaan lain, jangan ragu untuk bertanya.",
    },
    {
      keywords: ["sosial media", "kontak person"],
      response: "Berikut adalah akun sosial media kami: Instagram: @smaelitharapanbangsa, WhatsApp: 08383737****.",
    },
    {
      keywords: ["biaya", "spp", "pembayaran"],
      response: "Informasi mengenai biaya spp adalah sekitar 20 juta biaya pendaftaran dan dalam 1 kelas biayanya adalah total 10 juta. berarti total sampai lulus adalah 30 juta.",
    },
    {
      keywords: ["jurusan", "program", "kurikulum"],
      response: "Kami menawarkan berbagai program studi unggulan. Silakan kunjungi menu Akademik untuk informasi lengkap.",
    },
    {
      keywords: ["ekstrakurikuler", "ekskul"],
      response: "Kami memiliki berbagai kegiatan ekstrakurikuler seperti Pramuka, Paskibra, dan Klub Sains. Info lebih lanjut ada di menu Kegiatan.",
    },
    {
      keywords: ["jam buka", "waktu operasional", "buka sekolah"],
      response: "Jam operasional sekolah kami adalah Senin–Jumat, pukul 07.00–15.00 WIB.",
    },
    {
      keywords: ["login", "akun siswa", "masuk"],
      response: "tidak ada menu login di website ini, jika ingin login silakan hubungi admin melalui kontak yang tersedia.",
    },
  ];

  for (const item of responses) {
    if (item.keywords.some((keyword) => lowerMessage.includes(keyword))) {
      return item.response;
    }
  }

  return "Maaf, saya tidak mengerti pertanyaan Anda. Untuk informasi lebih lanjut, silakan hubungi kami melalui kontak yang tersedia di website.";
}
