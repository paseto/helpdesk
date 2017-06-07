// JavaScript Document

// convert textareas into tinymce
tinymce.init({
	selector:'textarea',
	selector : "textarea:not(.notinymce)",	
	toolbar_items_size : 'medium',
	plugins: "link, textcolor, image",
	toolbar: "bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |  cut copy paste | undo redo | link image",
 	menubar : false,
	statusbar : false,
	browser_spellcheck : true,
	image_advtab: true
});