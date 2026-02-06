<style>
/* Navigation Styles */
nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem 5%;
  background: var(--bg-primary);
  border-bottom: 1px solid var(--text);
}

.logo {
  font-size: 2rem;
  font-weight: 900;
  letter-spacing: -2px;
  border: 2px solid var(--text);
  padding: 5px 15px;
  flex-shrink: 0;
}

.search-container {
  flex: 1;
  max-width: 400px;
  margin: 0 2rem;
  display: flex;
  align-items: center;
  border-bottom: 1px solid var(--text);
  padding-bottom: 5px;
}

.search-icon {
  font-size: 1.2rem;
  margin-right: 10px;
  opacity: 0.6;
}

.search-input {
  width: 100%;
  background: transparent;
  border: none;
  outline: none;
  color: var(--text);
  font-size: 1rem;
  font-family: inherit;
}

.search-input::placeholder {
  color: var(--text);
  opacity: 0.5;
}

.nav-links {
  flex-shrink: 0;
}

.nav-links a {
  margin-left: 2rem;
  text-decoration: none;
  color: var(--text);
  font-weight: 600;
  text-transform: uppercase;
  font-size: 0.9rem;
}

/* Mobile Fixes for Nav - Add to the bottom of theme.css */
@media (max-width: 768px) {
  nav {
    flex-direction: column;
    gap: 1.5rem;
    padding-bottom: 1.5rem;
  }
  .search-container {
    width: 100%;
    margin: 0;
  }
  .nav-links a {
    margin: 0 10px;
  }
}
</style>


<nav>
  <div class="logo">LOGIQ.</div>
  <div class="search-container">
    <span class="search-icon">⌕</span>
    <input
      type="text"
      class="search-input"
      placeholder="Search puzzles..."
    />
  </div>
  <div class="nav-links">
    <a href="#">Profile</a>
    <a href="#">Store</a>
    <a href="#">Cart (0)</a>
  </div>
  <button
    id="dark-mode-toggle"
    style="
      background: var(--text);
      color: var(--bg-primary);
      border: none;
      padding: 5px 10px;
      cursor: pointer;
      font-family: inherit;
      font-weight: bold;
      margin-left: 1rem;
    "
  >
    THEME
  </button>
</nav>
<script>
     const toggleBtn = document.getElementById("dark-mode-toggle");
      const body = document.body;

      if (localStorage.getItem("theme") === "dark") {
        body.classList.add("dark-mode");
      }

      toggleBtn.addEventListener("click", () => {
        body.classList.toggle("dark-mode");
        localStorage.setItem(
          "theme",
          body.classList.contains("dark-mode") ? "dark" : "light",
        );
      });
</script>