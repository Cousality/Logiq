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

    // ── Toast ────────────────────────────────────────────────────────────────
    function showToast(message, isError) {
        var existing = document.getElementById('wishlist-page-toast');
        if (existing) existing.remove();
        var existingBd = document.getElementById('wishlist-page-backdrop');
        if (existingBd) existingBd.remove();

        var backdrop = document.createElement('div');
        backdrop.id = 'wishlist-page-backdrop';
        backdrop.style.cssText = 'position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:9998;opacity:1;transition:opacity 0.6s ease;';
        document.body.appendChild(backdrop);

        var toast = document.createElement('div');
        toast.id = 'wishlist-page-toast';
        toast.style.cssText = 'position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);padding:3rem 4rem;border:3px solid var(--text);background:var(--bg-primary);color:var(--text);font-weight:bold;font-size:1.3rem;text-align:center;z-index:9999;box-shadow:10px 10px 0px var(--text);opacity:1;transition:opacity 0.6s ease;text-transform:uppercase;letter-spacing:2px;max-width:550px;width:90%;line-height:2;';
        toast.innerHTML = '<div style="font-size:3.5rem;margin-bottom:1rem;">' + (isError ? '✕' : '✓') + '</div>'
            + '<div style="font-size:1.5rem;margin-bottom:0.5rem;">' + (isError ? 'Error' : 'Success!') + '</div>'
            + '<div style="font-size:1rem;opacity:0.8;text-transform:none;letter-spacing:0;">' + message + '</div>';
        document.body.appendChild(toast);

        setTimeout(function () {
            toast.style.opacity = '0';
            backdrop.style.opacity = '0';
            setTimeout(function () { toast.remove(); backdrop.remove(); }, 600);
        }, 4000);
    }

    // ── Add to Basket (AJAX) ─────────────────────────────────────────────────
    var token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    document.querySelectorAll('.wishlist-card form').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var productID = form.querySelector('input[name="productID"]').value;

            fetch('/basket/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ productID: productID, quantity: 1 }),
            })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                showToast(data.message, !data.success);
            })
            .catch(function () {
                showToast('Something went wrong. Please try again.', true);
            });
        });
    });

    // ── Remove from Wishlist ─────────────────────────────────────────────────
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
