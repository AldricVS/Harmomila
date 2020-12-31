//on insère un editeur de texte et on lui fait subir des modifications

//ATTENTION, on doit avoir un textarea qui a comme id 'editor' sur la page

CKEDITOR.replace('editor', {
	removeButtons:''
});

function preview() {
	var preview_zone = document.getElementById('preview');
	const data = CKEDITOR.instances.editor.getData();
	preview_zone.innerHTML = data;
}