document.addEventListener("DOMContentLoaded", () => {
    const input = document.getElementById("searchInput");
    const suggestionBox = document.getElementById("suggestions");

    input.addEventListener("keyup", function () {
        const query = this.value;

        if (query.length > 1) {
            fetch(`/search/suggest?q=${query}`)
                .then(res => res.json())
                .then(data => {
                    suggestionBox.innerHTML = "";
                    if (data.length > 0) {
                        data.forEach(item => {
                            const li = document.createElement("li");
                            li.innerHTML = `<a href="${item.url}" class="block px-3 py-2 hover:bg-blue-100">${item.name}</a>`;
                            suggestionBox.appendChild(li);
                        });
                        suggestionBox.classList.remove("hidden");
                    } else {
                        suggestionBox.classList.add("hidden");
                    }
                });
        } else {
            suggestionBox.classList.add("hidden");
        }
    });
});
