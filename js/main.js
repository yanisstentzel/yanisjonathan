// Run 4 Smiles 2027 — interactions

// ----- Settings (edit here) -----
const RACE_DATE = new Date("2027-06-12T09:00:00+02:00"); // fictional race day (Paris time)
const DONATION_GOAL = 500000; // € — placeholder
const DONATION_RAISED = 0;    // € — placeholder, update later

// ----- Mobile menu -----
const toggle = document.querySelector(".nav-toggle");
const nav = document.querySelector(".nav");

toggle.addEventListener("click", () => {
  const open = nav.classList.toggle("is-open");
  toggle.setAttribute("aria-expanded", open);
});

nav.querySelectorAll("a").forEach((link) =>
  link.addEventListener("click", () => {
    nav.classList.remove("is-open");
    toggle.setAttribute("aria-expanded", "false");
  })
);

// ----- Countdown -----
const cd = {
  days: document.getElementById("cd-days"),
  hours: document.getElementById("cd-hours"),
  min: document.getElementById("cd-min"),
  sec: document.getElementById("cd-sec"),
};

function updateCountdown() {
  const diff = Math.max(0, RACE_DATE - Date.now());
  const s = Math.floor(diff / 1000);
  cd.days.textContent = Math.floor(s / 86400);
  cd.hours.textContent = String(Math.floor((s % 86400) / 3600)).padStart(2, "0");
  cd.min.textContent = String(Math.floor((s % 3600) / 60)).padStart(2, "0");
  cd.sec.textContent = String(s % 60).padStart(2, "0");
}
updateCountdown();
setInterval(updateCountdown, 1000);

// ----- Donation progress -----
const fmt = new Intl.NumberFormat("en-IE", { style: "currency", currency: "EUR", maximumFractionDigits: 0 });
document.getElementById("raised").textContent = fmt.format(DONATION_RAISED);
document.getElementById("goal").textContent = fmt.format(DONATION_GOAL);

const fill = document.getElementById("progress-fill");
const pct = Math.min(100, (DONATION_RAISED / DONATION_GOAL) * 100);

// ----- Donation amount buttons -----
document.querySelectorAll(".amount").forEach((btn) =>
  btn.addEventListener("click", () => {
    document.querySelectorAll(".amount").forEach((b) => b.classList.remove("is-active"));
    btn.classList.add("is-active");
  })
);

// ----- Reveal on scroll -----
const revealTargets = document.querySelectorAll(".section h2, .city, .card, .steps li, .timeline li, details, .merch, .donate__box");
revealTargets.forEach((el) => el.classList.add("reveal"));

const observer = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) return;
      entry.target.classList.add("is-visible");
      if (entry.target.classList.contains("donate__box")) fill.style.width = pct + "%";
      observer.unobserve(entry.target);
    });
  },
  { threshold: 0.15 }
);
revealTargets.forEach((el) => observer.observe(el));
