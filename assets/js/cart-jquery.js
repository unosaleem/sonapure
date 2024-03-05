function increaseValue() {
  var value = parseInt(document.getElementById('number').value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  document.getElementById('number').value = value;
}

function decreaseValue() {
  var value = parseInt(document.getElementById('number').value, 10);
  value = isNaN(value) ? 0 : value;
  value < 1 ? value = 1 : '';
  value--;
  document.getElementById('number').value = value;
}















jQuery(document).ready(function(){
  var $this = $('.viewsitems');
  if ($this.find('div').length > 2) {
      $('.viewsitems').append('<div><a href="javascript:;" class="showMore"></a></div>');
  }
	$('.viewsitems .viewitem').slice(0,2).addClass('shown');
	$('.viewsitems .viewitem').not('.shown').hide();
	$('.viewsitems .showMore').on('click',function(){
		$('.viewsitems .viewitem').not('.shown').toggle(300);
		$(this).toggleClass('showLess');
	});
});



// active thumbnail
	$(document).ready(function(){
  
  $("#thumbSlider .thumb").on("click", function(){
			$(this).addClass("active");
			$(this).siblings().removeClass("active");
		
		});
})
	// active thumbnail
		
    		//cart tab//
const buttonElement = document.querySelectorAll('.tablinks');
const tabContent = document.querySelectorAll(".tabcontent");

tabContent[0].style.display = "block";

buttonElement.forEach(function (i) {
    i.addEventListener('click', function (event) {

        for (let x = 0; x < buttonElement.length; x++) {
            if (event.target.id == buttonElement[x].id) {
                buttonElement[x].className = buttonElement[x].className.replace(" active", "");
                tabContent[x].style.display = "block";
                event.currentTarget.className += " active";
            } else {
                tabContent[x].style.display = "none";
                buttonElement[x].className = buttonElement[x].className.replace(" active", "");
            }
        }
        
    });
});
	//cart tab//