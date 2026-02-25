document.addEventListener("DOMContentLoaded", function () {
    const removeMessages = [
        "This puzzle was saving itself for you. Are you sure you want to let it go?",
        "Once removed, it's gone from your list forever... (not really). Sure about this anyway?",
        "Your future self might come back for this one. Really want to remove it?",
        "We'll miss it too. Are you absolutely sure you want to remove this?",
        "This item had such potential in your wishlist. Sure you want to remove it?",
        "It's been waiting here just for you. Are you really, truly, completely sure?",
    ];

    var pendingProductId  = null;
    var pendingCard       = null;
    var modal      = document.getElementById('removeWishlistModal');
    var confirmBtn = document.getElementById('removeWishlistConfirm');
    var cancelBtn  = document.getElementById('removeWishlistCancel');
    var closeBtn   = document.getElementById('removeWishlistClose');
    var messageEl  = document.getElementById('removeWishlistMessage');

    function openRemoveModal(productId, card) {
        pendingProductId = productId;
        pendingCard      = card;
        messageEl.textContent = removeMessages[Math.floor(Math.random() * removeMessages.length)];
        modal.classList.add('active');
    }

    function closeRemoveModal() {
        pendingProductId = null;
        pendingCard      = null;
        modal.classList.remove('active');
    }

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

    // Wire up remove buttons
    document.querySelectorAll(".remove-from-wishlist").forEach(function (button) {
        button.addEventListener("click", function () {
            const productId = this.getAttribute("data-product-id");
            const card = this.closest(".wishlist-card");
            openRemoveModal(productId, card);
        });
    });

    confirmBtn.addEventListener('click', function () {
        if (pendingProductId && pendingCard) {
            removeFromWishlist(pendingProductId, pendingCard);
        }
        closeRemoveModal();
    });

    cancelBtn.addEventListener('click', closeRemoveModal);
    closeBtn.addEventListener('click', closeRemoveModal);
    modal.addEventListener('click', function (e) {
        if (e.target === this) closeRemoveModal();
    });
});
