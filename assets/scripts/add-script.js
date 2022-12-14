document.addEventListener("DOMContentLoaded", function (event) {
    const galleries = document.querySelectorAll(".gallery");

    if (galleries != null) {
        for (let i = 0; i < galleries.length; i++) {
            let stringClassesOfElem = galleries[i].className;
            let arrayClassesOfElem = stringClassesOfElem.split(" ");
            let countCol = "";
            let countColFin = 0;
            for (let j = 0; j < arrayClassesOfElem.length; j++) {
                if (arrayClassesOfElem[j].indexOf("gallery-columns") !== -1) {
                    let countColArray = arrayClassesOfElem[j].split("-");
                    countCol = countColArray[countColArray.length - 1];

                    switch (countCol) {
                        case "2":
                            countColFin = 6;
                            break;
                        case "3":
                            countColFin = 4;
                            break;
                        case "4":
                            countColFin = 3;
                            break;
                        case "6":
                            countColFin = 2;
                            break;
                    }
                }
            }

            let images = galleries[i].querySelectorAll("figure");

            for (j = 0; j < images.length; j++) {
                images[j].classList.add("img-box");
                images[j].classList.add("col-12");
                images[j].classList.add("col-lg-" + countColFin);
            }
        }
    }

    const singleFilters = document.querySelectorAll(".custom-select-single");

    if (singleFilters) {
        for (let j = 0; j < singleFilters.length; j++) {
            if (!singleFilters[j].classList.contains("no-chips")) {
                let thisSelect = singleFilters[j];

                let tabItem = singleFilters[j].closest(".tab-content__item");
                let chips = tabItem.querySelector(".chips");
                let clone = chips.querySelector(".chips__item").cloneNode(true);
                let div = document.createElement("div").appendChild(clone);
                let text = div.querySelector("p");
                text.innerHTML = singleFilters[j].value;

                if (singleFilters[j].value !== null && typeof singleFilters[j].value !== "undefined") {
                    for (var i = 0; i < chips.childNodes.length; i++) {
                        if (
                            chips.childNodes[i].textContent.trim() ===
                            singleFilters[j].getAttribute("value")
                        ) {
                            chips.removeChild(chips.childNodes[i]);
                        }
                    }
                }

                if (typeof singleFilters[j].value !== "undefined" && singleFilters[j].value !== "") {
                    singleFilters[j].setAttribute("value", this.value);
                    chips.append(div);
                }

                //Remove chips item
                let divCloseButton = div.querySelector("svg");
                divCloseButton.onclick = function () {
                    chips.removeChild(div);
                    thisSelect.reset();
                };
            }
        }
    }
    //end
});

jQuery(document).ready(function () {
    var clock = jQuery('#current_time');
    if (clock !== null) {
        setInterval(function () {
            var today = new Date();
            var min = today.getMinutes();
            min = min < 10 ? '0' + min : min;

			jQuery('#current_date').html( today.getDate() + ' ' + add_scripts.l10n.month[today.getMonth()] + '<br>' + add_scripts.l10n.day[today.getDay()]);
            jQuery('#current_time').html(today.getHours() + '<span class="blink">:</span>' + min);
        }, 1000);
    }
});

function markMessagesAsRead() {
    let data = new FormData();
    let messages = document.querySelectorAll('[data-message-id]');
    let bell = document.querySelector('.notification-animation');

    if (bell !== null) {
        bell.classList.remove('notification-animation')
    }

    if (messages.length > 0) {
        messages.forEach(item => {
            data.append('post_ids[]', item.getAttribute('data-message-id'));
            item.removeAttribute('data-message-id')
        })


        const response = fetch(add_scripts.url, {
            method: 'POST', body: data
        });
        if (response.ok) {
            console.log(response)
            response.json().then(response => {
                console.log('✉️', response)
            })
        }
    }
}

document.addEventListener("DOMContentLoaded", function (event) {
    const brand_list = document.querySelectorAll('.personal__content__item');
    const brand_list_count = document.querySelector('.personal__content__block__settings__number');
    if (brand_list.length > 0 && brand_list_count !== null) {
        brand_list_count.innerHTML = brand_list.length;
    }
});

document.addEventListener("DOMContentLoaded", function (event) {
    const comment_order_switch = document.querySelector('[name="comments_order"]');
    if (comment_order_switch) {
        comment_order_switch.addEventListener('change', function () {
            document.location.href = document.location.origin + document.location.pathname + '?order=' + comment_order_switch.value + '\#comments';
        })
    }

    const comment_rating = document.querySelector('.rating_value__current');
    if (comment_rating) {
        comment_rating.innerHTML = document.querySelector('.comment-stars:checked').value;
        const stars = document.querySelectorAll('.star-icon');
        stars.forEach(input => {
            input.onclick = function (e) {
                comment_rating.innerHTML = document.getElementById(e.target.getAttribute('for')).value;
            }
        })
    }
});

document.addEventListener("DOMContentLoaded", function (event) {
    let open_popup = document.querySelectorAll('[data-confirm-type]');
    if (open_popup.length) {
        open_popup.forEach(item => {
            item.addEventListener('click', async (event) => {
                event.preventDefault();
                let type = item.getAttribute('data-confirm-type')
                await send_otp(type)
            });
        })
    }

    const submit_button_code = document.getElementById('submit_check_code');
    if (!submit_button_code) {
        return false;
    }
    if ('OTPCredential' in window) {
        const input = document.querySelector('input[autocomplete="one-time-code"]');
        if (!input) return;
        const ac = new AbortController();
        if (submit_button_code) {
            submit_button_code.addEventListener('click', e => {
                ac.abort();
            });
        }
        navigator.credentials.get({
            otp: {transport: ['sms']},
            signal: ac.signal
        }).then(otp => {
            input.value = otp.code;
            submit_code();
        }).catch(err => {
            console.log(err);
        });
    }


    submit_button_code.addEventListener('click', async function (event) {
        await submit_code();
    })
    document.querySelector('.js-overlay-modal').addEventListener('click', e => {
        e.stopImmediatePropagation()
    }, true)

    async function submit_code() {
        event.preventDefault();
        const form_data = new FormData();
        form_data.append('action', 'confirm_code')
        form_data.append('login', document.querySelector('input[name="login"]').value)
        form_data.append('login_type', document.querySelector('input[name="login_type"]').value)
        form_data.append('user_password', document.querySelector('input[name="user_password_2"]').value)
        form_data.append('key', document.querySelector('input[name="code"]').value)

        submit_button_code.setAttribute('disabled', 'true');
        const response = await fetch(login_data.root_url, {
            method: 'POST', body: form_data
        });
        if (response.ok) {
            response.json().then(response => {
                if (Object.keys(response).length) {
                    if (typeof response.code !== "undefined" && response.code !== null) {
                        // show errors
                        let error = document.querySelectorAll('.' + response.code);
                        error.forEach(item => item.classList.add('login__form__input-error--show'));
                    } else if( response.modal) {
                        send_otp(response.login_type)
                        update_modal(response);
                        document.querySelector('[data-modal="' + response.modal + '"]').classList.add('active');
                        document.querySelector('.js-overlay-modal').classList.add('active');
                    } else {
                        window.location.href = response.redirect;
                    }
                } else {
                    document.querySelector('.active[data-modal]').classList.remove('active');
                    document.querySelector('.js-overlay-modal.active').classList.remove('active');
                }
            })

        } else {
            document.querySelector('[data-modal="modal-alert-reload"]').classList.add('active');
            document.querySelector('.js-overlay-modal').classList.add('active');
            // noinspection ExceptionCaughtLocallyJS
            throw new Error(response.status + ' - ' + response.statusText);
        }
        submit_button_code.removeAttribute('disabled');
    }

    async function send_otp(type) {
        let request = new FormData();
        request.append('action', 'send_confirmation_code')
        request.append('email_or_phone', document.querySelector('input.' + type).value)
        const response = await fetch(login_data.root_url, {
            method: 'POST', body: request
        });
        if (response.ok) {
            update_modal({
                'modal': 'modal-confirm-code',
                'login_type': type,
                'login': 'false',
                'user_password': 'false'
            });
            document.querySelector('[data-modal="modal-confirm-code"]').classList.add('active');
            document.querySelector('.js-overlay-modal').classList.add('active');
        }
    }
});