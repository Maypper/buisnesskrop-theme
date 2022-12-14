// Search block single selects
document.querySelectorAll(".custom-select-single").forEach(function (item) {
    if (!item.classList.contains("no-chips")) {
        item.addEventListener("change", function () {
            let thisSelect = this;

            let tabItem = this.closest(".tab-content__item");
            let chips = tabItem.querySelector(".chips");
            let clone = chips.querySelector(".chips__item").cloneNode(true);
            let div = document.createElement("div").appendChild(clone);
            let text = div.querySelector("p");
            text.innerHTML = this.value;

            if (this.value !== null) {
                for (var i = 0; i < chips.childNodes.length; i++) {
                    if (
                        chips.childNodes[i].textContent.trim() ===
                        this.getAttribute("value")
                    ) {
                        chips.removeChild(chips.childNodes[i]);
                    }
                }
            }

            if (this.value !== "") {
                this.setAttribute("value", this.value);
                chips.append(div);
            }

            //Remove chips item
            let divCloseButton = div.querySelector("svg");
            divCloseButton.onclick = function () {
                chips.removeChild(div);
                thisSelect.reset();
            };
        });
    }
});
