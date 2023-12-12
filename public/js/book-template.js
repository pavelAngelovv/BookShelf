document.addEventListener("DOMContentLoaded", function() {
    const rows = document.querySelectorAll(".item-row");
    rows.forEach(row => {
        row.addEventListener("click", function() {
            window.location.href = this.dataset.href;
        });
    });
});