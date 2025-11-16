document.addEventListener("DOMContentLoaded", function () {
    // Handle Add to Wishlist buttons
    const wishlistButtons = document.querySelectorAll(".add-to-wishlist");

    wishlistButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const productId = this.getAttribute("data-product-id");
            addToWishlist(productId, this);
        });
    });

    function addToWishlist(productId, button) {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        fetch("/wishlist/add", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            body: JSON.stringify({ productID: productId }),
        });

        alert("Added to wishlist!");
    }
});
