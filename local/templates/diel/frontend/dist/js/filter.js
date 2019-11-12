if (document.querySelector(".diel-select__button")) {
  document.querySelectorAll(".diel-select__button").forEach(function(el) {
    for (let i = el.firstElementChild; i !== null; i = i.nextElementSibling) {
      el.addEventListener("click", function() {
        this.parentElement.classList.add("diel-select--active");
      });
    }

    document.addEventListener("click", function(evt) {
      for (let i = el.firstElementChild; i !== null; i = i.nextElementSibling) {
        if (evt.target !== i && evt.target !== el) {
          el.parentElement.classList.remove("diel-select--active");
          break;
        }
      }
    });
  });
}

if (document.querySelector(".diel-select")) {
  let selectWrapper = document.querySelectorAll(".diel-select");
  
  showSelect();

  function showSelect() {
    selectWrapper.forEach(function(el) {
    if (el.querySelector(".diel-select-list") && el.querySelector(".filter__diel-option-js")) {

      let option = el.querySelectorAll(".filter__diel-option-js");
  
      el.querySelector(".diel-select-list").innerHTML = "";
      for (let i = 0; i < option.length; i++) {
        let li = document.createElement("li");
  
        li.classList.add("diel-select-list__item");
        li.textContent = option[i].textContent;

        el.querySelector(".diel-select-list").appendChild(li);
      }


      let width = 0;

      el.querySelectorAll(".diel-select-list__item").forEach(function(el, index) {
        el.dataset.id = index;

        if (el.parentElement.parentElement.querySelector(".diel-select__button").offsetWidth > width) 
          width = el.parentElement.parentElement.querySelector(".diel-select__button").offsetWidth;

        el.addEventListener("click", function() {
          this.parentElement.parentElement.querySelector(".filter__diel-js").selectedIndex = this.dataset.id;

          this.parentElement.parentElement.querySelector(".diel-select__button-text").textContent = option[this.dataset.id].textContent;

          this.parentElement.parentElement.querySelector(".filter__diel-js").dispatchEvent(new Event('change'));
        });
      });

      el.querySelector(".diel-select__button").style.width = width + 17 + "px";
      if (option.length > 0) {
        el.querySelector(".diel-select__button-text").textContent = option[0].textContent;
      }
    }
    });
  }
}