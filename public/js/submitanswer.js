document.querySelectorAll(".option-btn").forEach((button) => {
    button.addEventListener("click", function () {
        const answer = this.getAttribute("data-value");
        submitAnswer(answer);
    });
});

function submitAnswer(val) {
    const feedback = document.getElementById("feedback");
    const btns = document.querySelectorAll(".option-btn");

    // Disable buttons Temp
    btns.forEach((btn) => (btn.disabled = true));
    feedback.textContent = "Analyzing...";
    feedback.style.color = "var(--text)";

    fetch("{{ route('puzzle.check') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            answer: val,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            feedback.style.color = data.color;
            feedback.textContent = data.message;

            if (data.status === "error") {
                setTimeout(() => {
                    btns.forEach((btn) => (btn.disabled = false));
                    feedback.textContent = "";
                }, 2000);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            feedback.textContent = "System Error.";
        });
}
