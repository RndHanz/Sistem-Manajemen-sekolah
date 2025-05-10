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

// Form Submission
const registrationForm = document.getElementById("registrationForm");

registrationForm.addEventListener("submit", (e) => {
  e.preventDefault();

  // Here you would typically send the form data to a server
  // For this example, we'll just show an alert
  alert("Pendaftaran berhasil dikirim! Kami akan menghubungi Anda segera.");
  registrationForm.reset();
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

  if (lowerMessage.includes("halo") || lowerMessage.includes("hai") || lowerMessage.includes("hi") || lowerMessage.includes("hallo" || lowerMessage.includes("aku mau tanya"))) {
    return "Halo! Ada yang bisa saya bantu?";
  } else if (lowerMessage.includes("pendaftaran") || lowerMessage.includes("daftar")) {
    return "Informasi pendaftaran siswa baru bisa Anda temukan di menu Pendaftaran atau dengan mengunjungi link ini: [Link Pendaftaran]";
  } else if (lowerMessage.includes("kalender") || lowerMessage.includes("jadwal")) {
    return "Kalender akademik sekolah bisa dilihat di menu Kalender pada website kami.";
  } else if (lowerMessage.includes("alamat") || lowerMessage.includes("lokasi")) {
    return "SMP Negeri 1 Maju Jaya berlokasi di Jl. Pendidikan No. 123, Kota Maju Jaya. Lihat peta di footer website.";
  } else if (lowerMessage.includes("terima kasih") || lowerMessage.includes("thanks")) {
    return "Sama-sama! Jika ada pertanyaan lain, jangan ragu untuk bertanya.";
  } else if (lowerMessage.includes("Bagus") || lowerMessage.includes("makasih")) {
    return "Sama-sama! Jika ada pertanyaan lain, jangan ragu untuk bertanya.";
  } else if (lowerMessage.includes("sosial media") || lowerMessage.includes("kontak person")) {
    return "Berikut adalah akun sosial media kami: instagram: @smaelitharapanbangsa, Whatsapp: 08383737****.";
  } else {
    return "Maaf, saya tidak mengerti pertanyaan Anda. Untuk informasi lebih lanjut, silakan hubungi kami melalui kontak yang tersedia di website.";
  }
}
