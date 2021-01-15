/*			
var 
inputField		= document.querySelectorAll('.input-field'),
input				= document.querySelectorAll('.input-field__input'),
placeholder		= document.querySelector('.input-field__placeholder');



var initInput = function() {
	this.classList.add('active');
	this.querySelector('.input-field__input').focus();

}
for (var i = 0; i < inputField.length; i++) {
	inputField[i].addEventListener('click', initInput);
	inputField[i].addEventListener('focusin', initInput);
}
document.addEventListener('click', function(event) {


	if (!event.target.closest('.input-field')) {

		var activeInputField = document.querySelectorAll('.input-field.active');
		for (var i = 0; i < activeInputField.length; i++) {
			if (activeInputField[i].querySelector('.input-field__input').value.length <= 0){
				activeInputField[i].classList.remove('active');
			}
		}

	}



}); */
