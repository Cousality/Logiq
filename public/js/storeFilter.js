document.addEventListener("DOMContentLoaded", function () {
    const categoryFilters = document.querySelectorAll(".category-filter");
    const difficultyFilters = document.querySelectorAll(".difficulty-filter");
    const productCards = document.querySelectorAll(".product-card");
    const noResultsMsg = document.querySelector(".no-results");
    // add event listener for each filter
    categoryFilters.forEach((filter) => {
        filter.addEventListener("change", filterProducts);
    });

    difficultyFilters.forEach((filter) => {
        filter.addEventListener("change", filterProducts);
    });

    function filterProducts() {
        const selectedCategories = Array.from(categoryFilters)
            .filter((checkbox) => checkbox.checked)
            .map((checkbox) => checkbox.value);

        const selectedDifficulties = Array.from(difficultyFilters)
            .filter((checkbox) => checkbox.checked)
            .map((checkbox) => checkbox.value);

        let visibleCount = 0;

        productCards.forEach((card) => {
            const productCategory = card.dataset.category;
            const productDifficulty = card.dataset.difficulty;

            const categoryMatch =
                selectedCategories.length === 0 ||
                selectedCategories.includes(productCategory);

            const difficultyMatch =
                selectedDifficulties.length === 0 ||
                selectedDifficulties.includes(productDifficulty);

            if (categoryMatch && difficultyMatch) {
                card.classList.remove("hidden");
                visibleCount++;
            } else {
                card.classList.add("hidden");
            }
        });

        // Show/hide no results message
        if (visibleCount === 0) {
            noResultsMsg.style.display = "block";
        } else {
            noResultsMsg.style.display = "none";
        }
    }
});
