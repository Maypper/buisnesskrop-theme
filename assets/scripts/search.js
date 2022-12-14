const advanced_search = document.getElementById('advanced-search');
const advanced_search_header = document.getElementById('advanced-search-header');
const search_form = document.getElementById('searchform');
const search_form_header = document.getElementById('searchform-header');
const search_form_mob = document.getElementById('searchform-mob');
const timepicker = document.querySelector('.timepicker-modal-search');
const timepicker_header = document.querySelector('.timepicker-modal-main');
console.log(search_form_mob);
function advance_search_request(advanced_form, search_form, timepicker) {
    if (advanced_form !== null && typeof advanced_form !== 'undefined') {
        const form_parent = advanced_form.closest('.search-block__wrap');
        const search_tabs = document.querySelectorAll('.nav-tabs__item');
        search_tabs.forEach(function (search_tab) {
            search_tab.addEventListener('click', setInputValue);
        });


        function setInputValue(event) {
            var current_el = event.currentTarget;
            var tab_value = current_el.dataset.value;
            var hidden_input = current_el.parentElement.querySelector('input[type=hidden]');
            hidden_input.value = tab_value;
        }

        if (search_form !== null && typeof search_form !== 'undefined') {
            search_form.addEventListener('submit', function (e) {
                const form_data = new FormData(advanced_form);
                if (form_parent.classList.contains('open')) {
                    for (let key of form_data.keys()) {
                        var input_val = form_data.get(key);
                        if (input_val) {
                            let hiddenField = document.createElement('input');
                            hiddenField.type = 'hidden';
                            hiddenField.name = key;
                            hiddenField.value = form_data.get(key);
                            search_form.appendChild(hiddenField);
                        }
                    }
                }
            });

            const timepicker_btn = timepicker.querySelector('.btn');
            timepicker_btn.addEventListener('click', function (){
                let brandTimeStart = timepicker.querySelectorAll('.flatpickr-time')[0];
                // find start hour:
                let brandHourStart = brandTimeStart.querySelectorAll('.numInputWrapper')[0];
                let brandHourStartValue = brandHourStart.querySelector('input').value;
                // find start minute
                let brandMinuteStart = brandTimeStart.querySelectorAll('.numInputWrapper')[1];
                let brandMinuteStartValue = brandMinuteStart.querySelector('input').value;

                // find end:
                let brandTimeEnd = timepicker.querySelectorAll('.flatpickr-time')[1];
                // find end hour
                let brandHourEnd = brandTimeEnd.querySelectorAll('.numInputWrapper')[0];
                let brandHourEndValue = brandHourEnd.querySelector('input').value;
                // find end minute
                let brandMinuteEnd = brandTimeEnd.querySelectorAll('.numInputWrapper')[1];
                let brandMinuteEndValue = brandMinuteEnd.querySelector('input').value;

                let brandInputTime = `${brandHourStartValue}:${brandMinuteStartValue} - ${brandHourEndValue}:${brandMinuteEndValue}`;
                let time_from = search_form.querySelector('input[name=time_from]');
                if (time_from !== null && typeof work_from !== 'undefined') {
                    time_from.value = brandHourStartValue + ':' + brandMinuteStartValue + ':00';
                } else {
                    let hiddenField = document.createElement('input');
                    hiddenField.type = 'hidden';
                    hiddenField.name = 'time_from';
                    hiddenField.value = brandHourStartValue + ':' + brandMinuteEndValue + ':00';
                    search_form.appendChild(hiddenField);
                }

                let time_to = search_form.querySelector('input[name=time_to]');
                if (time_to !== null && typeof work_from !== 'undefined') {
                    time_to.value = brandHourEndValue + ':' + brandMinuteStartValue + ':00';
                } else {
                    let hiddenField = document.createElement('input');
                    hiddenField.type = 'hidden';
                    hiddenField.name = 'time_to';
                    hiddenField.value = brandHourEndValue + ':' + brandMinuteEndValue + ':00';
                    search_form.appendChild(hiddenField);
                }


                setTimeout(function () {
                    let time_chips = document.querySelector('.chips__item[data-value=custom-time]');
                    if (time_chips !== null && typeof time_chips !== 'undefined') {
                        let divCloseButton = time_chips.querySelector('svg');
                        divCloseButton.onclick = function () {
                            let time_from = search_form.querySelector('input[name=time_from]');
                            let time_to = search_form.querySelector('input[name=time_to]');
                            time_chips.remove();
                            time_to.remove();
                            time_from.remove();
                        };
                    }
                }, 50);
            });
        }
        advanced_form.addEventListener('submit', function (event) {
            event.preventDefault();
        });
    }
}

advance_search_request(advanced_search, search_form, timepicker);
advance_search_request(advanced_search, search_form_mob, timepicker);
advance_search_request(advanced_search_header, search_form_header, timepicker_header);

let mob_search_btn = document.querySelector('.mob-advanced-form-btn');
if (mob_search_btn !== null && typeof mob_search_btn !== 'undefined') {
    mob_search_btn.addEventListener('click', function (event) {
        let form = document.getElementById('advanced-search');
        form.classList.toggle("open");
        mob_search_btn.classList.toggle("open");
        document.querySelector('.search-block__wrap').classList.toggle("open");
    });
}