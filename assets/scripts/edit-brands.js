const buttons = document.querySelectorAll('button[data-modal="personal-modal-delete"], button[data-modal="personal-modal-activate"], button[data-modal="personal-modal-deactivate"]');
buttons.forEach(item => {
    item.addEventListener('click', function (e) {
        let modal = e.target.getAttribute('data-modal');
        let post_id = e.target.getAttribute('data-post_id');
        let link = e.target.getAttribute('data-link');
        let a = document.querySelector('.modal[data-modal="' + modal + '"] .personal__modal__btn__apply');
        a.href = link + '&post_id=' + post_id;
    })
})

addEventListener('DOMContentLoaded', function () {
    const statistic_wrapper = document.querySelector('.statistic-wrapper');
    const statistic_filter = document.querySelector('.custom-select.personal__content__choices');
    if ( statistic_filter !== null ) {

        statistic_filter.addEventListener('change', function (e) {

            const form_data = new FormData();
            form_data.append('period', e.target.value)

            fetch(edit_brand.root_url, {
                method: 'POST', body: form_data
            })
                .then(function (response) {
                    return response.text()
                })
                .then(function (html) {
                    var parser = new DOMParser();
                    var doc = parser.parseFromString(html, "text/html");

                    // You can now even select part of that html as you would in the regular DOM
                    // Example:
                    // var docArticle = doc.querySelector('article').innerHTML;

                    statistic_wrapper.replaceChildren();
                    statistic_wrapper.append(...doc.body.querySelectorAll('.personal__content__item'))
                    console.log(doc.body);
                })
                .catch(function (err) {
                    console.log('Failed to fetch page: ', err);
                });
        });
    }
})
