if (document.querySelector(".main-search__input")) {
  let input = document.querySelector(".main-search__input");

  input.addEventListener("focus", function() {
    this.parentElement.classList.add("main-search--focus");
    this.placeholder = "";

    let primary = document.querySelector(".main-search__box-primary"),
        secondary = document.querySelector(".main-search__box-secondary");

    primary.style.display = "block";
    secondary.style.display = "none";
    this.value = "";
  });

  input.addEventListener("blur", function() {
    this.parentElement.classList.remove("main-search--focus");
    this.placeholder = "ПОИСК";
  });
}

if (document.querySelector(".search-section__title")) {
  let input = document.querySelector(".search-section__title");

  let span = document.createElement("span");

  span.className = "section-title search-section__span";

  input.parentElement.parentElement.insertAdjacentElement("afterEnd", span);

  let len = input.value.length;

  span.textContent = input.value;
  input.title = input.value;

  if (span.offsetWidth > input.offsetWidth) {
    for (let i = 1; i <= len; i++) {
      span.textContent = input.value.slice(0, -i);
      
      if (span.offsetWidth < input.offsetWidth) {
        input.value = span.textContent.slice(0, -3) + "...";
        break;
      }  
    }
  }

}