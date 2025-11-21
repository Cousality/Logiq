document.addEventListener("DOMContentLoaded", () => {
    const btns = document.querySelectorAll(".add-to-basket");
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    btns.forEach(btn => {
        btn.addEventListener("click", () => {
            fetch("/basket/add", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrf
                },
                body: JSON.stringify({
                    productID: btn.dataset.productId,
                    quantity: 1
                })
            });

            alert("Added to basket!");
        });
    });
});
