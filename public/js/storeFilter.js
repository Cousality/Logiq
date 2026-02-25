// Category filter functionality
const categoryFilterBtns = document.querySelectorAll(".category-filter");
const productCards = document.querySelectorAll(".product-card");
const difficultyFilter = document.getElementById("difficulty-filter");
const ratingFilter = document.getElementById("rating-filter");
const priceMin = document.getElementById("price-min");
const priceMax = document.getElementById("price-max");
const priceMinLabel = document.getElementById("price-min-label");
const priceMaxLabel = document.getElementById("price-max-label");
const priceSliderRange = document.getElementById("price-slider-range");
const sortBy = document.getElementById("sort-by");
const noResults = document.querySelector(".no-results");

// Read initial category from URL params (e.g. ?category=Twist)
const urlParams = new URLSearchParams(window.location.search);
const urlCategory = urlParams.get("category");

let activeCategory = urlCategory || "all";
let activeDifficulty = "all";
let activeMinRating = 0;
let activePriceMin = 0;
let activePriceMax = Infinity;

// Initialise price slider range from actual product prices
const allPrices = Array.from(productCards).map((c) => parseFloat(c.dataset.price) || 0);
const maxProductPrice = allPrices.length ? Math.ceil(Math.max(...allPrices)) : 200;
priceMin.max = maxProductPrice;
priceMax.max = maxProductPrice;
priceMax.value = maxProductPrice;
activePriceMax = maxProductPrice;
priceMaxLabel.textContent = "£" + maxProductPrice;

function updatePriceSlider() {
    const min = parseInt(priceMin.value);
    const max = parseInt(priceMax.value);
    const pct = (v) => (v / maxProductPrice) * 100;
    priceSliderRange.style.left = pct(min) + "%";
    priceSliderRange.style.width = (pct(max) - pct(min)) + "%";
    priceMinLabel.textContent = "£" + min;
    priceMaxLabel.textContent = "£" + max;
}

// Apply URL-based category on load
if (urlCategory) {
    categoryFilterBtns.forEach((btn) => {
        btn.classList.remove("active");
        if (btn.dataset.filter === urlCategory) {
            btn.classList.add("active");
        }
    });
}

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

// Rating filter
ratingFilter.addEventListener("change", (e) => {
    activeMinRating = parseInt(e.target.value);
    applyFilters();
});

// Price slider
priceMin.addEventListener("input", () => {
    if (parseInt(priceMin.value) > parseInt(priceMax.value)) {
        priceMin.value = priceMax.value;
    }
    activePriceMin = parseInt(priceMin.value);
    updatePriceSlider();
    applyFilters();
});

priceMax.addEventListener("input", () => {
    if (parseInt(priceMax.value) < parseInt(priceMin.value)) {
        priceMax.value = priceMin.value;
    }
    activePriceMax = parseInt(priceMax.value);
    updatePriceSlider();
    applyFilters();
});

updatePriceSlider();

// Apply all filters
function applyFilters() {
    let visibleCount = 0;

    productCards.forEach((card) => {
        const category = card.dataset.category;
        const difficulty = card.dataset.difficulty;
        const rating = parseInt(card.dataset.rating) || 0;
        const price = parseFloat(card.dataset.price) || 0;

        let showCategory =
            activeCategory === "all" || category === activeCategory;
        let showDifficulty =
            activeDifficulty === "all" || difficulty === activeDifficulty;
        let showRating = rating >= activeMinRating;
        let showPrice = price >= activePriceMin && price <= activePriceMax;

        if (showCategory && showDifficulty && showRating && showPrice) {
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

// Apply initial filter if a category was passed via URL
if (urlCategory) {
    applyFilters();
}
