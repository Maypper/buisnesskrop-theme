const profile_form = document.getElementById('profile_form');
if (typeof profile_form !== "undefined" && profile_form !== null) {
    const submit_button = profile_form.querySelector('button[type="submit"]');
    profile_form.addEventListener('submit', async function (event) {

        event.preventDefault();
        const errors = profile_form.querySelectorAll('.login__form__input-error--show');
        if (typeof errors !== 'undefined' && errors !== null) {
            errors.forEach(error_item => error_item.classList.remove('login__form__input-error--show'))
        }
        const form_data = new FormData(profile_form);
        const action = form_data.get('action')

        submit_button.setAttribute('disabled', 'true');
        const response = await fetch(login_data.root_url, {
            method: 'POST', body: form_data
        });
        if (response.ok) {
            response.json().then(response => {
                if (Object.keys(response).length) {
                    if (typeof response.code !== "undefined" && response.code !== null) {
                        let error = profile_form.querySelectorAll('.' + response.code);
                        error.forEach(item => item.classList.add('login__form__input-error--show'));
                        scrollToError('.login__form__input-error--show', 250);
                    } else if (typeof response.modal !== "undefined" && response.modal !== null) {

                        if (typeof uploader !== "undefined" && uploader !== null) {
                            // uploader.post_id = response.post_id;
                            uploader.settings.multipart_params.post_id = response.post_id;
                            console.log(uploader.settings.multipart_params.post_id)
                            modal_files_uploading.classList.add('active');
                            document.querySelector('.js-overlay-modal').classList.add('active');
                            uploader.refresh();
                            uploader.start();
                        } else {
                            update_modal(response);
                            profile_form.reset();
                            document.querySelector('[data-modal="' + response.modal + '"]').classList.add('active');
                            document.querySelector('.js-overlay-modal').classList.add('active');
                        }
                    }
                } else {
                    profile_form.reset();
                    const params = new Proxy(new URLSearchParams(window.location.search), {
                        get: (searchParams, prop) => searchParams.get(prop),
                    });

                    window.location.href = params.redirect ? params.redirect : login_data.redirect_to[action];
                }
            })

        } else {
            document.querySelector('[data-modal="modal-alert-reload"]').classList.add('active');
            document.querySelector('.js-overlay-modal').classList.add('active');
            // noinspection ExceptionCaughtLocallyJS
            throw new Error(response.status + ' - ' + response.statusText);
        }
        submit_button.removeAttribute('disabled');
    })


    submit_button.addEventListener('click', function (e) {
        const errors = profile_form.querySelectorAll('.login__form__input-error--show');
        if (typeof errors !== 'undefined' && errors !== null) {
            errors.forEach(error_item => error_item.classList.remove('login__form__input-error--show'))
        }

        const repeat_password = profile_form.querySelector('input[name="password_confirm"]');
        if (typeof repeat_password !== "undefined" && repeat_password !== null) {
            let first_password = profile_form.querySelector(' input[name="user_password"]');
            if (first_password.value !== '') {
                let show_error = repeat_password.value !== first_password.value;
                profile_form.querySelector('.confirm-password').classList.toggle('login__form__input-error--show', show_error)
                if (show_error) {
                    e.preventDefault();
                }
            }
        }

        if (typeof uploader !== "undefined" && uploader !== null) {
            if (uploader.files.length > uploader.settings.max_files) {
                let error_messages = document.querySelectorAll('.upload-error-to-many');
                error_messages.forEach(item => item.classList.add('login__form__input-error--show'));
                e.preventDefault();
            } else if (uploader.files.length < uploader.settings.min_files) {
                let error_messages = document.querySelectorAll('.upload-error-to-few');
                error_messages.forEach(item => item.classList.add('login__form__input-error--show'));
                e.preventDefault();
            } else {
                let error_messages = document.querySelectorAll('.login__form__input-error--show');
                error_messages.forEach(item => item.classList.remove('login__form__input-error--show'));
            }
        }

        const form_elements = profile_form.querySelectorAll('input, textarea');
        let hidden_inputs = profile_form.querySelectorAll('input.vscomp-hidden-input')
        hidden_inputs.forEach(item => {
            item.setAttribute('required', 'true')
        })
        form_elements.forEach(element => {
            if (element.classList.contains('vscomp-hidden-input')) {
                if (!element.value) {
                    e.preventDefault();
                    element.parentNode.parentNode.parentNode.querySelector('.login__form__input-error:not(.login__form__input-error--show)').classList.add('login__form__input-error--show')
                }
            }
            if (!element.checkValidity()) {
                e.preventDefault();
                element.classList.add('login__form__input-error--show')
                element.parentNode.querySelector('.login__form__input-error:not(.login__form__input-error--show)').classList.add('login__form__input-error--show')
            }
        })

        const category_popup = document.querySelectorAll('input[name="category[]"]');
        if (category_popup.length > 0) {
            let inputs_with_value = [];
            category_popup.forEach((input) => {
                if (input.checked) {
                    inputs_with_value.push(input);
                }
            })
            if (inputs_with_value.length < 1) {
                e.preventDefault();
                document.querySelector('.add-brand__form__input.category-button').nextElementSibling.classList.add('login__form__input-error--show')
            }
        }

        scrollToError('.login__form__input-error--show', 250);
    });
}

function update_modal(response) {
    console.log(response)
    let modal = response.modal;
    console.log(modal)
    let login_type = response.login_type;
    if (modal === 'modal-send-brand') {
        console.log(document.querySelector('[name="post_title"]').value)
        document.getElementById('post_title').innerHTML = document.querySelector('[name="post_title"]').value;
    } else if (modal === 'modal-confirm-code') {
        let selector = '.modal_confirm_code_' + login_type;
        let disable = document.querySelectorAll('.modal_confirm_code');
        let enable = document.querySelectorAll(selector);
        if (disable) {
            disable.forEach(item => item.style.display = 'none')
        }
        if (enable) {
            enable.forEach(item => item.style.display = 'block')
        }
        document.querySelector('input[autocomplete="one-time-code"]').value = '';
        document.querySelector('input[name="login"]').value = response.login;
        document.querySelector('input[name="login_type"]').value = response.login_type;
        document.querySelector('input[name="user_password_2"]').value = response.user_password;
    }
}

function scrollToError(selector, offset = 0) {
    let element = document.querySelector(selector);
    if (element !== null) {
        window.scrollTo({
            top: element.getBoundingClientRect().top + (window.scrollY || document.documentElement.scrollTop) - offset,
            behavior: "smooth"
        });
    }
}