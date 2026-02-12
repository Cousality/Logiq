// Category filter functionality
const categoryFilterBtns = document.querySelectorAll(".category-filter");
const productCards = document.querySelectorAll(".product-card");
const difficultyFilter = document.getElementById("difficulty-filter");
const sortBy = document.getElementById("sort-by");
const noResults = document.querySelector(".no-results");

let activeCategory = "all";
let activeDifficulty = "all";

// Category button filters
categoryFilterBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
        categoryFilterBtns.forEach((b) => b.classList.remove("active"));
        btn.classList.add("active");

        activeCategory = btn.dataset.filter;
        applyFilters();
    });
});

// Difficulty filter
difficultyFilter.addEventListener("change", (e) => {
    activeDifficulty = e.target.value;
    applyFilters();
});

// Apply all filters
function applyFilters() {
    let visibleCount = 0;

    productCards.forEach((card) => {
        const category = card.dataset.category;
        const difficulty = card.dataset.difficulty;

        let showCategory =
            activeCategory === "all" || category === activeCategory;
        let showDifficulty =
            activeDifficulty === "all" || difficulty === activeDifficulty;

        if (showCategory && showDifficulty) {
            card.style.display = "block";
            visibleCount++;
        } else {
            card.style.display = "none";
        }
    });

    if (noResults) {
        noResults.style.display = visibleCount === 0 ? "block" : "none";
    }
}

// Sort functionality
if (sortBy) {
    sortBy.addEventListener("change", (e) => {
        const sortValue = e.target.value;
        const grid = document.querySelector(".products-grid");
        const cards = Array.from(productCards);

        cards.sort((a, b) => {
            if (sortValue === "price-low") {
                return (
                    parseFloat(a.dataset.price) - parseFloat(b.dataset.price)
                );
            } else if (sortValue === "price-high") {
                return (
                    parseFloat(b.dataset.price) - parseFloat(a.dataset.price)
                );
            }
            return 0;
        });

        cards.forEach((card) => grid.appendChild(card));
    });
}
