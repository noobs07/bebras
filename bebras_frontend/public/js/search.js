document.addEventListener("DOMContentLoaded", () => {
    function setupSearch(inputId, suggestionsId) {
        const input = document.getElementById(inputId);
        const suggestionBox = document.getElementById(suggestionsId);

        if (!input || !suggestionBox) return;

        let debounceTimeout = null;
        let selectedIndex = -1;

        function escapeHtml(str) {
            return str
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        // Fetch & render suggestions
        function fetchSuggestions(query) {
            const trimmedQuery = query.trim();

            if (trimmedQuery.length < 1) {
                suggestionBox.innerHTML = "";
                suggestionBox.classList.add("hidden");
                selectedIndex = -1;
                return;
            }

            fetch(`/search/suggest?q=${encodeURIComponent(trimmedQuery)}`)
                .then(res => res.json())
                .then(data => {
                    suggestionBox.innerHTML = "";
                    selectedIndex = -1;

                    if (data && data.length > 0) {
                        data.forEach((item, index) => {
                            const li = document.createElement("li");
                            li.className = "suggestion-item hover:bg-blue-50 cursor-pointer transition-colors";
                            li.setAttribute("data-index", index);
                            li.innerHTML = `
                                <a href="${item.url}" class="block px-4 py-2.5 text-sm text-gray-700 hover:text-bebrasDarkBlue flex items-center justify-between">
                                    <span class="font-medium truncate">${escapeHtml(item.name)}</span>
                                    <i class="fas fa-chevron-right text-xs text-gray-400 ms-2"></i>
                                </a>
                            `;
                            suggestionBox.appendChild(li);
                        });
                        suggestionBox.classList.remove("hidden");
                    } else {
                        const li = document.createElement("li");
                        li.className = "px-4 py-3 text-sm text-gray-400 text-center italic";
                        li.textContent = "Tidak ada saran ditemukan";
                        suggestionBox.appendChild(li);
                        suggestionBox.classList.remove("hidden");
                    }
                })
                .catch(err => {
                    console.error("Error fetching search suggestions:", err);
                    suggestionBox.classList.add("hidden");
                });
        }

        // Input handler with DEBOUNCE (300ms)
        input.addEventListener("input", function () {
            clearTimeout(debounceTimeout);
            const query = this.value;

            debounceTimeout = setTimeout(() => {
                fetchSuggestions(query);
            }, 300);
        });

        // Keyboard navigation (Arrow Up, Arrow Down, Enter, Escape)
        input.addEventListener("keydown", function (e) {
            const items = suggestionBox.querySelectorAll(".suggestion-item");
            if (suggestionBox.classList.contains("hidden") || items.length === 0) return;

            if (e.key === "ArrowDown") {
                e.preventDefault();
                selectedIndex = (selectedIndex + 1) % items.length;
                updateHighlight(items);
            } else if (e.key === "ArrowUp") {
                e.preventDefault();
                selectedIndex = (selectedIndex - 1 + items.length) % items.length;
                updateHighlight(items);
            } else if (e.key === "Enter" && selectedIndex >= 0) {
                e.preventDefault();
                const selectedLink = items[selectedIndex].querySelector("a");
                if (selectedLink) {
                    window.location.href = selectedLink.href;
                }
            } else if (e.key === "Escape") {
                suggestionBox.classList.add("hidden");
                selectedIndex = -1;
            }
        });

        function updateHighlight(items) {
            items.forEach((item, idx) => {
                if (idx === selectedIndex) {
                    item.classList.add("bg-blue-100");
                    item.scrollIntoView({ block: "nearest" });
                } else {
                    item.classList.remove("bg-blue-100");
                }
            });
        }

        // Close dropdown on click outside
        document.addEventListener("click", (e) => {
            if (!input.contains(e.target) && !suggestionBox.contains(e.target)) {
                suggestionBox.classList.add("hidden");
                selectedIndex = -1;
            }
        });

        // Re-open on focus if query present
        input.addEventListener("focus", function () {
            if (this.value.trim().length >= 1 && suggestionBox.children.length > 0) {
                suggestionBox.classList.remove("hidden");
            }
        });
    }

    setupSearch("searchInput", "suggestions");
    setupSearch("searchInputMobile", "suggestionsMobile");
});
