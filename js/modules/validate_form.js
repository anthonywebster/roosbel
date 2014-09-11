define(['jquery'],function($){
var validateForm;

return validateForm = (function() {
	'use strict';

	function validateForm(args) {	
		/*
		Este _this es para poder acceder a los metodos de la function
		 */
		var _this = this;
		var foo = 5;

		$('.form-register').on('submit',function(event){
			event.preventDefault();
			var 
			email1 = $('.email_origen'),
			email2 = $('.email_eval'),
			pass1  = $('.pass_origen'),
			pass2  = $('.pass_eval');

			// if (_this.validateExistEmail(email1)) {
			// 	console.log('test');
			// }
			_this.validateExistEmail(email1,email2);		
			_this.validatePass(pass1,pass2);
		});

		
		this.getFoo = function(){
			return foo;
		}
		
	}

	validateForm.prototype.test = function(first_argument) {
		console.log('hola');
	};

	validateForm.prototype.validateExistEmail = function(email1,email2) {
		//Esta variable la declaro aqui para poder usar los metodos ya creados.
		var _this = this;
		$.ajax({
			url: 'validate_email.php',
			type: 'post',
			dataType:'json',
			data: {email:email1.val()},
			success: function (data) {
				if (data.status == "empty") {
					_this.validateEmail(email1,email2);
				} else {
					email1.val("");
					email2.val("");
				}
			},
		});

		//console.log(response);
	};

	validateForm.prototype.validateEmail = function(email1,email2) {
		if (email1.val()!= email2.val()) {
			event.preventDefault();
			email1.css({'background-color':'#F96464'});
			email2.css({'background-color':'#F96464'});
			setTimeout(function() {
				email1.css({'background-color':'#FFF'});
				email2.css({'background-color':'#FFF'});
			}, 1500);
		} 
	};

	validateForm.prototype.validatePass = function(pass1,pass2) {
		if (pass1.val()!= pass2.val()) {
			event.preventDefault();
			pass1.css({'background-color':'#F96464'});
			pass2.css({'background-color':'#F96464'});
			setTimeout(function() {
				pass1.css({'background-color':'#FFF'});
				pass2.css({'background-color':'#FFF'});
			}, 1500);
		} 
	};

	return validateForm;

}());

});