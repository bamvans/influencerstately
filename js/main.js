"user strict";
/*--------------------------------- 8.Contact Form Submit Js -----------------------*/
$(function () {
	var form = $('#ajax-contact');
	var formMessages = $('#form-messages');
	$(form).submit(function (e) {
		e.preventDefault();
		var formData = $(form).serialize();
		$.ajax({
				type: 'POST',
				url: $(form).attr('action'),
				data: formData
			})
			.done(function (response) {
				$(formMessages).removeClass('error');
				$(formMessages).addClass('success');
				setTimeout(function(){
					$(formMessages).removeClass('error, success');
				}, 5000);
				$(formMessages).text(response);
				$('#name').val('');
                $('#email').val('');
                $('#cell').val('');
				$('#website').val('');
				// $('#instagramlink').val('');
			})
			.fail(function (data) {
				$(formMessages).removeClass('success');
				$(formMessages).addClass('error');
				if (data.responseText !== '') {
					$(formMessages).text(data.responseText);
				} else {
					$(formMessages).text('Oops! An error occured and your message could not be sent.');
				}
			});
	});
});
// Contact Form Submit Js END 