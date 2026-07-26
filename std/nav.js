document.addEventListener("DOMContentLoaded", () => {
  const sidebar = document.querySelector(".sidebar");
  const collapseBtn = document.getElementById("collapseBtn");
  const logoutBtn = document.getElementById("logoutBtn");

  if (sidebar && collapseBtn) {
    collapseBtn.addEventListener("click", () => {
      sidebar.classList.toggle("collapsed");
    });
  }

  document.querySelectorAll(".nav button").forEach((btn) => {
    btn.addEventListener("click", () => {
      const list = btn.closest(".nav");
      list
        .querySelectorAll("button")
        .forEach((b) => b.classList.remove("active"));
      btn.classList.add("active");
    });
  });

  if (logoutBtn) {
    logoutBtn.addEventListener("click", () => {
      if (confirm("ต้องการออกจากระบบใช่หรือไม่?")) {
        window.location.href = "config/logout.php?logout=1";
      }
    });
  }

  if (window.lucide) {
    lucide.createIcons();
  }
});