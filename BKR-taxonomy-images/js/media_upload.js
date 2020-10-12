let add_image = document.querySelector('#bkr_taxonomy_images_add_image');
let remove_image = document.querySelector('#bkr_taxonomy_images_remove_image');
let image_preview = document.querySelector('#bkr_taxonomy_images_image_preview');
let selected_image = document.querySelector('#bkr_taxonomy_images_selected_image');

add_image.addEventListener('click', function () {
    let frame = wp.media().on('select', function () {
        attachment = frame.state().get('selection').first();
        console.log(attachment);
        selected_image.value = attachment.attributes.id;
		image_preview.innerHTML = '<img style="max-width: 100%;" src="' + attachment.attributes.url + '">';
    }).open();
});

if ( remove_image != null ) {
    remove_image.addEventListener('click', function () {
        selected_image.value = '';
        image_preview.innerHTML = '';
    })
}
