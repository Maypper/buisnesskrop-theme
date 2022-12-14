let modal_files_uploading = document.querySelector('[data-modal="modal-files-uploading"]');
if (document.querySelector('#dwn_btn')) {
    var uploader = new plupload.Uploader({
        runtimes: 'html5',
        browse_button: document.querySelector('#dwn_btn'),
        container: document.querySelector('#dwn_cnt'),
        drop_element: document.querySelector('#drop_cnt'),
        url: uploader_js.url,
        max_retries: 3,
        min_files: 3,
        max_files: 10,
        filters: {
            mime_types: [
                {title: "Image files", extensions: "jpg,jpeg,png"},
            ],
            max_file_size: '5mb',
        },
        multipart_params: {
            "post_id": "",
        }
    });

    uploader.init();

    uploader.bind('QueueChanged', function (up) {
        if (up.files.length <= up.settings.max_files && up.files.length >= up.settings.min_files) {
            let error_messages = document.querySelectorAll('.login__form__input-error--show');
            error_messages.forEach(item => item.classList.remove('login__form__input-error--show'));
        }

        document.querySelector('.upload_progress .overall').innerHTML = up.files.length;
    });

    uploader.bind('FilesAdded', function (up, files) {
        files.forEach(function (file) {
            let clone = document.querySelector('#file_tmpl').cloneNode(true);
            let file_wrapper = document.querySelector('.files__wrpap');

            // todo: remade to template tag
            clone.removeAttribute('style');
            clone.removeAttribute('id');
            clone.classList.add('file-style');

            clone.querySelector('span[class="filenam"]').innerHTML = file.name;

            let img = new mOxie.Image();
            img.onload = function () {
                setTimeout(() => {
                    let image_icon = clone.querySelector('.image')
                    image_icon.setAttribute('data-preview-image', this.getAsDataURL())
                    image_icon.addEventListener('click', (e) => {
                        document.getElementById('image_preview').setAttribute('src', e.target.parentNode.getAttribute('data-preview-image'));
                    })
                    image_icon.addEventListener('click', (e) => {
                        document.getElementById('image_preview').setAttribute('src', e.target.parentNode.getAttribute('data-preview-image'));
                        document.querySelector('.modal[data-modal="modal-image-preview"]').classList.add('active');
                        document.querySelector('.js-overlay-modal').classList.add('active');
                    })
                }, 0);
            };
            img.load(file.getSource());

            file_wrapper.append(clone);
            clone.dataset.file_id = file.id;
            clone.getElementsByClassName('cross')[0].real_file_id = file.id;
            clone.getElementsByClassName('cross')[0].addEventListener('click', function (evt) {
                uploader.removeFile(evt.currentTarget.real_file_id)
                uploader.refresh();
            });
        });

        if (up.files.length > up.settings.max_files) {
            up.splice(up.settings.max_files);
            let error_messages = document.querySelectorAll('.upload-error-to-many');
            error_messages.forEach(item => item.classList.add('login__form__input-error--show'));
        } else if (up.files.length < up.settings.min_files) {
            let error_messages = document.querySelectorAll('.upload-error-to-few');
            error_messages.forEach(item => item.classList.add('login__form__input-error--show'));
        }
    });
    uploader.bind('FilesRemoved', function (up, files) {
        files.forEach(function (file) {
            document.querySelector('[data-file_id="' + file.id + '"]').remove();
        })
        if (up.files.length < up.settings.min_files) {
            let error_messages = document.querySelectorAll('.upload-error-to-few');
            error_messages.forEach(item => item.classList.add('login__form__input-error--show'));
        }
    });

    uploader.bind('UploadProgress', function (up, file) {
        let bar = document.querySelector('.upload_progress_bar_inner');
        bar.style.width = 'calc( ' + up.total.percent + '% + 2px)';
    });

    uploader.bind('FileUploaded', function () {
        let current = document.querySelector('.upload_progress .current');
        let files_uploaded = parseFloat(current.innerHTML);
        current.innerHTML = (files_uploaded + 1);
    })

    uploader.bind('UploadComplete', function (up, files, result) {
        update_modal({'modal': 'modal-send-brand'});
        profile_form.reset();
        modal_files_uploading.classList.remove('active')
        document.querySelector('[data-modal="modal-send-brand"]').classList.add('active');
    });

    uploader.bind('Error', function (up, error) {
        console.error([up, error])
        let error_messages = document.querySelectorAll('.upload-error' + error.code);
        error_messages.forEach(item => item.classList.add('login__form__input-error--show'));
    })

    uploader.bind('PostInit', async function (uploader) {
        let preloaded_images = JSON.parse(uploader_js.preloaded)
        if (preloaded_images) {
            for (const url of preloaded_images) {
                if (url) {
                    getFileFromUrl(url, url.split('/').pop())
                        .then(file => {
                            uploader.addFile(file)
                        })
                }
            }
        }
    });

    async function getFileFromUrl(url, name) {
        const response = await fetch(url);
        const data = await response.blob();
        return new File([data], name, {
            type: data.type,
        });
    }
}
