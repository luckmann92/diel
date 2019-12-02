if (document.querySelector(".popup-request-call__form")) {
  ajaxForm(document.querySelector(".popup-request-call__form"));
}

if (document.querySelector(".main-search")) {
  document.querySelector(".main-search").addEventListener("submit", function(evt) {
    evt.preventDefault();

    let action = document.querySelector(".main-search").action,
        inputValue = document.querySelector(".main-search .main-search__input").value;

    fetch(action + inputValue);

    window.location = action + inputValue;
  });
  document.querySelector(".main-search").action += document.querySelector(".main-search__input").value;

}

function ajaxForm(form) {
	form.addEventListener('submit', function(e) {
    e.preventDefault();

    if (document.querySelector(".popup-successful") && form.classList.contains("popup-request-call__form")) {
      let popup = new Popup(".popup-successful");
      popup.showPopup();
    }

    fetch(
      form.getAttribute('action'),
        {
          method: 'POST', 
          body: new FormData(form),
          headers : { 
            'Content-Type': 'application/json',
            'Accept': 'application/json'
           }
        }
    	)
      .then(res => res.json())
      .then(res => {
        if (res.error) {

          console.log("Ошибка");
        }
        if(res.success) {

          console.log("Отправлено");
        }
      });
  });
}

if (document.querySelector('input[type=tel]')) {
  var element = document.querySelectorAll('input[type=tel]');

  for (let i = 0; i < element.length; i ++) {
      var maskOptions = {
      mask: '+{7}(000)000-00-00'
      };
      var mask = IMask(element[i], maskOptions);
  }
}