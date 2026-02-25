// Store filter functionality
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

let activeDifficulty = "all";
let activeMinRating = 0;

// Initialise price slider range from actual product prices
const allPrices = Array.from(productCards).map((c) => parseFloat(c.dataset.price) || 0);
const maxProductPrice = allPrices.length ? Math.ceil(Math.max(...allPrices)) : 200;
priceMin.max = maxProductPrice;
priceMax.max = maxProductPrice;
priceMax.value = maxProductPrice;

function updatePriceSlider() {
    const min = parseInt(priceMin.value);
    const max = parseInt(priceMax.value);
    const pct = (v) => (v / maxProductPrice) * 100;
    priceSliderRange.style.left = pct(min) + "%";
    priceSliderRange.style.width = (pct(max) - pct(min)) + "%";
    priceMinLabel.textContent = "£" + min;
    priceMaxLabel.textContent = "£" + max;
}

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
    updatePriceSlider();
    applyFilters();
});

priceMax.addEventListener("input", () => {
    if (parseInt(priceMax.value) < parseInt(priceMin.value)) {
        priceMax.value = priceMin.value;
    }
    updatePriceSlider();
    applyFilters();
});

updatePriceSlider();

// Apply all filters
function applyFilters() {
    let visibleCount = 0;

    productCards.forEach((card) => {
        const difficulty = card.dataset.difficulty;
        const rating = parseInt(card.dataset.rating) || 0;
        const price = parseFloat(card.dataset.price) || 0;

        let showDifficulty =
            activeDifficulty === "all" || difficulty === activeDifficulty;
        let showRating = rating >= activeMinRating;
        let showPrice = price >= parseInt(priceMin.value) && price <= parseInt(priceMax.value);

        if (showDifficulty && showRating && showPrice) {
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
