window.addEventListener("load", () => {
  movePartners();
  touchPartners();
});

window.addEventListener("resize", () => {
  movePartners();
  touchPartners();
});

function movePartners() {
  let list = document.querySelector(".partners-list");

  list.addEventListener("dragstart", () => false);
  list.style.transform = `translateX(0px)`;
  
  list.addEventListener("mousedown", evt => {
    let that = evt.currentTarget,
        x = evt.clientX,        
        left = parseInt(that.style.transform.slice(11, -3));

    if (that.offsetWidth < getWidth(".partners-list__item")) {
      that.classList.remove("partners-list-animate");

      that.addEventListener("mousemove", move);
      window.addEventListener("mouseup", up);

      function move(evt) {
        let mX = x - evt.clientX;    
        shiftX =  left - mX;
        that.style.transform = `translateX(${shiftX}px)`;
      }

      function up() {
        let left = parseInt(that.style.transform.slice(11, -3));

        that.removeEventListener("mousemove", move);

        if (left > 0) {
          that.style.transform = `translateX(0px)`;
          that.classList.add("partners-list-animate");
        }

        let max = getWidth(".partners-list__item") - that.offsetWidth;

        if (left < -max) {
          that.style.transform = `translateX(${-max}px)`;
          that.classList.add("partners-list-animate");
        }
      }
    }
  });

  function getWidth(className) {
    if (document.querySelector(`${className}`)) {
      let node = document.querySelectorAll(`${className}`),
          width = 0;

      node.forEach(el => {
        width += el.offsetWidth;
      });

      return width;
    }
  }
}

function touchPartners() {
  let list = document.querySelector(".partners-list");

  list.addEventListener("dragstart", () => false);
  list.style.transform = `translateX(0px)`;
  
  list.addEventListener("touchstart", evt => {
    let that = evt.currentTarget,
        x = evt.touches[0].clientX,        
        left = parseInt(that.style.transform.slice(11, -3));

    if (that.offsetWidth < getWidth(".partners-list__item")) {
      that.classList.remove("partners-list-animate");

      that.addEventListener("touchmove", move);
      window.addEventListener("touchend", up);

      function move(evt) {
        let mX = x - evt.touches[0].clientX;    
        shiftX =  left - mX;
        that.style.transform = `translateX(${shiftX}px)`;
      }

      function up() {
        let left = parseInt(that.style.transform.slice(11, -3));

        that.removeEventListener("touchmove", move);

        if (left > 0) {
          that.style.transform = `translateX(0px)`;
          that.classList.add("partners-list-animate");
        }

        let max = getWidth(".partners-list__item") - that.offsetWidth;

        if (left < -max) {
          that.style.transform = `translateX(${-max}px)`;
          that.classList.add("partners-list-animate");
        }
      }
    }
  });

  function getWidth(className) {
    if (document.querySelector(`${className}`)) {
      let node = document.querySelectorAll(`${className}`),
          width = 0;

      node.forEach(el => {
        width += el.offsetWidth;
      });

      return width;
    }
  }
}