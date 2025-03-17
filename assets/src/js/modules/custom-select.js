document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".wapf-field-container select.wapf-input").forEach(select => {
        let wrapper = document.createElement("div");
        wrapper.className = "custom-wapf-select relative w-full";

        // Создаем триггер для кастомного селекта
        let trigger = document.createElement("div");
        trigger.className = "custom-wapf-trigger bg-transparent text-gray-20 border-b border-black py-2 text-base flex justify-between items-center cursor-pointer";
        trigger.innerText = select.options[select.selectedIndex]?.text || "Выберите опцию";

        // Создаем список кастомных опций
        let optionsWrapper = document.createElement("div");
        optionsWrapper.className = "custom-wapf-options absolute top-full left-0 w-full bg-white-10 border border-gray-10 hidden z-10";

        Array.from(select.options).forEach(option => {
            if (option.value) {
                let customOption = document.createElement("div");
                customOption.className = "custom-wapf-option px-3 py-2 bg-white text-black text-sm cursor-pointer hover:bg-gray-10 hover:text-white-10 transition";
                customOption.innerText = option.text;
                customOption.dataset.value = option.value;
                customOption.dataset.price = option.dataset.wapfPrice || "0"; // Получаем цену из атрибута

                customOption.addEventListener("click", function () {
                    trigger.innerText = this.innerText;
                    select.value = this.dataset.value;
                    optionsWrapper.classList.add("hidden");

                    // Тригерим изменение, чтобы WAPF пересчитал цену
                    let event = new Event("change", { bubbles: true });
                    select.dispatchEvent(event);
                });

                optionsWrapper.appendChild(customOption);
            }
        });

        wrapper.appendChild(trigger);
        wrapper.appendChild(optionsWrapper);
        select.style.display = "none"; // Прячем оригинальный WAPF select
        select.parentNode.appendChild(wrapper);

        // Открытие / закрытие выпадающего списка
        trigger.addEventListener("click", function () {
            optionsWrapper.classList.toggle("hidden");
        });

        // Закрытие списка при клике вне
        document.addEventListener("click", function (e) {
            if (!wrapper.contains(e.target)) {
                optionsWrapper.classList.add("hidden");
            }
        });
    });
});

