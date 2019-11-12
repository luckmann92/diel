(function(){
  if (document.querySelector('.filter-item__price')) {
    let elRangePrice = document.querySelectorAll('.filter-item__price input');
    let elRangePriceMin = elRangePrice[0];
    let elRangePriceMax = elRangePrice[1];

    let rangePriceMin = Number.parseInt(elRangePriceMin.dataset.min);
    let rangePriceMax = Number.parseInt(elRangePriceMax.dataset.max);

    let rangePriceValMin = Number.parseInt(elRangePriceMin.value);
    let rangePriceValMax = Number.parseInt(elRangePriceMax.value);

    let slider = new rSlider({
      target: '#filterRangePrice',
      values: {min: rangePriceMin, max: rangePriceMax},
      step: 1,
      range: true,
      set: [rangePriceValMin, rangePriceValMax],
      scale: false,
      labels: false,
      tooltip: false,
      onChange: function (vals) {
        vals=vals.split(',');
        elRangePriceMin.value=+vals[0];
        elRangePriceMax.value=+vals[1];
      }
    });

    elRangePriceMin.addEventListener("change", function(e){
      slider.setValues(parseInt(this.value), slider.getValue().split(',')[1] );
    });
    elRangePriceMax.addEventListener("change", function(e){
      slider.setValues(slider.getValue().split(',')[0], parseInt(this.value));
    });

  if (document.querySelector(".sidebar") && (document.querySelector(".filter-button"))) {
    let btn = document.querySelector(".filter-button"),
        sidebar = document.querySelector(".sidebar"),
        btnClose = sidebar.querySelector(".filter-container__close");
    
    btn.addEventListener("click", onClcikBtn);

    btnClose.addEventListener("click", function() {
      sidebar.classList.remove("sidebar--active");
    });

    function onClcikBtn() {
      sidebar.classList.add("sidebar--active");

      var content = document.querySelectorAll('.filter-item__content');
      content.forEach(function(el) {
        el.removeAttribute("style");
      });

      var content = document.querySelectorAll('.filter-item__content');
      content.forEach(function(el) {
        el.removeAttribute("style");
      });

      slider.destroy();
      slider = new rSlider({
        target: '#filterRangePrice',
        values: {min: rangePriceMin, max: rangePriceMax},
        step: 1,
        range: true,
        set: [rangePriceValMin, rangePriceValMax],
        scale: false,
        labels: false,
        tooltip: false,
        onChange: function (vals) {
          vals=vals.split(',');
          elRangePriceMin.value=+vals[0];
          elRangePriceMax.value=+vals[1];
        }
      });

    }
  }
}

})();


document.querySelectorAll('.filter-container select').forEach(function(select){
  new customSelect({elem:select});
});



window.addEventListener("load", function() {
  document.querySelectorAll('.filter-container .filter-item').forEach(function(item){
    let content = item.querySelector('.filter-item__content');
    let tmp = content.offsetHeight;
    content.style.height = 'initial';  
    let h = content.offsetHeight;
    content.style.height = tmp+'px';

    item.querySelector('.filter-item__title').addEventListener('click', (e) => {
      if(item.classList.contains('opened')) {
        item.classList.remove('opened');
        content.style.height = 0;
        content.style.overflow='hidden';
      }
      else {
        item.classList.add('opened');
        content.style.height = h +'px';
        setTimeout(()=>content.style.overflow='visible',300);
      }
    })
  });

  // document.querySelectorAll('.filter-container .filter-item').forEach(function(item){
  //   let content = item.querySelector('.filter-item__content');
  //   content.height = 'initial';
  // });
});