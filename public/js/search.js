document.getElementById("searchInput").addEventListener("input", function() {
    let filter = this.value.toLowerCase();
    let articles = document.querySelectorAll(".article");

    articles.forEach(article => {
        let title = article.querySelector(".post-title h2").innerText.toLowerCase();
        let subtitle = article.querySelector(".post-subtitle")?.innerText.toLowerCase();
        let meta = article.querySelector(".post-meta")?.innerText.toLowerCase();

        if (title.includes(filter) || (subtitle && subtitle.includes(filter)) || (meta && meta.includes(filter))) {
            article.style.display = "block";
        } else {
            article.style.display = "none";
        }
    });
});