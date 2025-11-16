document.addEventListener("DOMContentLoaded", function () {
    // Handle Remove from Wishlist buttons
    const removeButtons = document.querySelectorAll(".remove-from-wishlist");

    removeButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const productId = this.getAttribute("data-product-id");
            const card = this.closest(".wishlist-card");
            removeFromWishlist(productId, card);
        });
    });

    function removeFromWishlist(productId, card) {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        fetch("/wishlist/remove", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            body: JSON.stringify({ productID: productId }),
        });

        card.remove();
    }
});
