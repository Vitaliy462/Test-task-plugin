document.addEventListener('DOMContentLoaded', function () {
    let mediaUploader;
    const uploadButton = document.getElementById('upload_image');
    const productImageIdInput = document.getElementById('product_image_id');
    const productImagePreview = document.getElementById('product_image_preview');

    uploadButton.addEventListener('click', function (e) {
        e.preventDefault();

        mediaUploader = wp.media({
            title: 'Select product image',
            button: {
                text: 'Update product image'
            },
            library: {
                type: 'image'
            },
            multiple: false
        });

        mediaUploader.on('select', function () {
            const attachment = mediaUploader.state().get('selection').first().toJSON();
            productImageIdInput.value = attachment.id;
            productImagePreview.innerHTML = `<img src="${attachment.url}" style="max-width: 150px; height: auto;" />`;
        });

        mediaUploader.open();
    });
});