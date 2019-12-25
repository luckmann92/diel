if (document.querySelector(".main-search__input")) {
  let input = document.querySelector(".main-search__input");

  input.addEventListener("focus", function() {
    this.parentElement.classList.add("main-search--focus");
    this.placeholder = "";
  });

  input.addEventListener("blur", function() {
    this.parentElement.classList.remove("main-search--focus");
    this.placeholder = "ПОИСК";
  });


}