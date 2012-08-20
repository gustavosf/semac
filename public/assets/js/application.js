$(document).ready(function () {
	$('a.dropdown-toggle').dropdown(); // catch any dropdowns on the page
	$('.alert-message').alert();
});

$.modal = function(opt) {
	if (opt.header === undefined) opt.header = 'Hello';
	if (opt.content === undefined) opt.content = 'Hello';
	if (opt.primary_btn === undefined) opt.primary_btn = 'Ok';

	var tmpl = 
		$('<div class="modal fade" id="modal-window">' +
			'<div class="modal-header">' +
				'<a class="close" data-dismiss="modal">×</a>' +
				'<h3>'+opt.header+'</h3>' +
			'</div>' +
			'<div class="modal-body"><p>'+opt.content+'</p></div>' +
			'<div class="modal-footer"></div>' +
		'</div>');

	if (opt.buttons !== undefined) {
		var footer = tmpl.find('.modal-footer');
		$.each(opt.buttons, function(i, btn) {
			var btn_el = $('<a href="#" class="btn">');
			btn.type && btn_el.addClass('btn-' + btn.type);
			btn.click && btn_el.on('click', function(){
				btn.click(tmpl);
			});
			btn_el.text(btn.text);
			footer.prepend(btn_el);
		});
	}

	tmpl.on('hidden', function() {
		tmpl.detach();
	});

	tmpl.modal();
};