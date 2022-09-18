var button = document.getElementsByClassName('item');
var closeBtn = document.getElementsByClassName('close');
var modal = document.getElementsByClassName('modal');

for (let i = 0; i < button.length; i++) {
  button[i].addEventListener("click", function() {
    modal[i].classList.add('show');
  });
}

for (let i = 0; i < closeBtn.length; i++) {
  closeBtn[i].addEventListener("click", function() {
    modal[i].classList.remove("show");
  });
}



