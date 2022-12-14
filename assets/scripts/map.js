var map = document.getElementById('map');
if (typeof map !== "undefined" && map !== null) {
    var script = document.createElement('script');
    script.src = 'https://maps.googleapis.com/maps/api/js?key=' + map_data.google_api + '&callback=initMap';
    script.async = true;

    var markers_arr = map_data.brands;

    function initMap() {
        let directionsService = new google.maps.DirectionsService();
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 48.516245706561484, lng: 32.25828303343775},
            zoom: 15,
            style: [
                {
                    "featureType": "landscape.natural.landcover",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "landscape.natural.terrain",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.attraction",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.attraction",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.government",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.place_of_worship",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit.station.airport",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit.station.bus",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit.station.rail",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                }
            ]
        });
        let directionsRenderer = new google.maps.DirectionsRenderer();
        directionsRenderer.setMap(map);

        // ZOOM BUTTONS
        function initZoomControl(map) {
            document.querySelector('.zoom-control-in').onclick = function () {
                map.setZoom(map.getZoom() + 1);
            };
            document.querySelector('.zoom-control-out').onclick = function () {
                map.setZoom(map.getZoom() - 1);
            };
            map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(
                document.querySelector('.zoom-control')
            );
        }

        // FULLSCREEN BUTTON
        function initFullscreenControl(map) {
            const elementToSendFullscreen = map.getDiv().firstChild;
            const fullscreenControl = document.querySelector('.fullscreen-control');
            map.controls[google.maps.ControlPosition.RIGHT_TOP].push(fullscreenControl);
            fullscreenControl.onclick = function () {
                if (isFullscreen(elementToSendFullscreen)) {
                    exitFullscreen();
                } else {
                    requestFullscreen(elementToSendFullscreen);
                }
            };
            document.onwebkitfullscreenchange =
                document.onmsfullscreenchange =
                    document.onmozfullscreenchange =
                        document.onfullscreenchange =
                            function () {
                                if (isFullscreen(elementToSendFullscreen)) {
                                    fullscreenControl.classList.add('is-fullscreen');
                                } else {
                                    fullscreenControl.classList.remove('is-fullscreen');
                                }
                            };
        }

        function isFullscreen(element) {
            return (
                (document.fullscreenElement ||
                    document.webkitFullscreenElement ||
                    document.mozFullScreenElement ||
                    document.msFullscreenElement) == element
            );
        }

        function requestFullscreen(element) {
            if (element.requestFullscreen) {
                element.requestFullscreen();
            } else if (element.webkitRequestFullScreen) {
                element.webkitRequestFullScreen();
            } else if (element.mozRequestFullScreen) {
                element.mozRequestFullScreen();
            } else if (element.msRequestFullScreen) {
                element.msRequestFullScreen();
            }
        }

        function exitFullscreen() {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        }

        initZoomControl(map);
        initFullscreenControl(map);

        let svgMarker = {
            path: 'M18 0C8.05884 0 0 8.05884 0 18C0 33 18 48 18 48C18 48 36 33 36 18C36 8.05884 27.9412 0 18 0ZM18 24C14.6863 24 12 21.3137 12 18C12 14.6862 14.6863 12 18 12C21.3137 12 24 14.6862 24 18C24 21.3137 21.3137 24 18 24Z',
            fillColor: '#e8Ba06',
            fillOpacity: 1,
            strokeWeight: 0,
            anchor: new google.maps.Point(15, 30),
        };
        let currentSvgMarker = {
            path: 'M18 0C8.05884 0 0 8.05884 0 18C0 33 18 48 18 48C18 48 36 33 36 18C36 8.05884 27.9412 0 18 0ZM18 24C14.6863 24 12 21.3137 12 18C12 14.6862 14.6863 12 18 12C21.3137 12 24 14.6862 24 18C24 21.3137 21.3137 24 18 24Z',
            fillColor: 'blue',
            fillOpacity: 1,
            strokeWeight: 0,
            anchor: new google.maps.Point(15, 30),
        };

        // MARKERS
        markers = [];
        if (markers_arr !== null && typeof markers_arr !== 'undefined') {
            markers_arr.forEach(function (element) {
                var needest_view = {
                    category: element.cats,
                    id: element.ID,
                    position: {lat: element.post_location.lat, lng: element.post_location.lng},
                    title: element.post_title,
                    description: element.post_title,
                    image: element.thumb,
                    post_type: element.post_type,
                    innerModal: {
                        star: '5',
                        title: element.post_title,
                        permalink: element.permalink,
                        category: element.cats,
                        category_label: element.cats_label,
                        moreText: element.post_excerpt,
                        address: element.post_location_str,
                        phones: [element.phone_number],
                        order_online: element.order_page,
                        email: element.email,
                        links: {
                            fb: element.facebook,
                            in: element.instagram,
                            yt: element.youtube,
                            vb: element.viber,
                            tg: element.telegram,
                            wb: element.site,
                        },
                    },
                };
                markers.push(needest_view);
            });
        }

        let createDirection = document.querySelector('.create-direction');

        let myLocation = document.querySelector('.find-my-location');
        if ('geolocation' in navigator) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var currentLatitude = position.coords.latitude;
                var currentLongitude = position.coords.longitude;

                let currentMarker = new google.maps.Marker({
                    position: {lat: currentLatitude, lng: currentLongitude},
                    map: map,
                    icon: currentSvgMarker,
                });
                createDirection.setAttribute('data-position', `{"lat":${position.coords.latitude}, "lng":${position.coords.longitude}}`);
            });
        }

        let prevMarker = {};

        myLocation.addEventListener('click', function () {
            if ('geolocation' in navigator) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var currentLatitude = position.coords.latitude;
                    var currentLongitude = position.coords.longitude;
                    if (!prevMarker) {
                        prevMarker.setMap(null);
                    }
                    let currentMarker = new google.maps.Marker({
                        position: {lat: currentLatitude, lng: currentLongitude},
                        map: map,
                        icon: currentSvgMarker,
                        center: map.setCenter(new google.maps.LatLng(currentLatitude, currentLongitude)),
                    });
                    prevMarker = currentMarker;
                    createDirection.setAttribute('data-position', `{"lat":${position.coords.latitude}, "lng":${position.coords.longitude}`);
                });
            }
        });

        function calculateAndDisplayRoute(
            directionsRenderer,
            directionsService,
            Dest,
            Curr
        ) {
            directionsService.route({
                origin: Curr,
                destination: Dest,
                travelMode: google.maps.TravelMode.WALKING,
            })
                .then((result) => {
                    directionsRenderer.setDirections(result);
                })
                .catch((e) => {
                    console.error('Directions request failed due to ' + e);
                });
        }

        let mapInfoWindow = new google.maps.InfoWindow();
        let mapModal = document.querySelector('.map-modal');
        let brandList = mapModal.querySelector('.map-modal-allmarkers');
        let mapInform = mapModal.querySelector('.map-modal-individualmarker');
        let toBrandList = mapModal.querySelector('.from-marker__forward-button');
        let nameOfBrand = mapInform.querySelector('.from-marker__name-of-brand');
        let categoriesOfBrand = mapInform.querySelector('.from-marker__category-of-brand');
        let anotherText = mapInform.querySelector('.from-marker__another-text');
        let brandAddress = mapInform.querySelector('.brand-address-item');
        let brandPhone = mapInform.querySelector('.brand-phone-item');
        let brandMail = mapInform.querySelector('.brand-mail-item');
        let fb = mapInform.querySelector('.facebook');
        let inst = mapInform.querySelector('.instagram');
        let youtube = mapInform.querySelector('.youtube');
        let viber = mapInform.querySelector('.viber');
        let telegram = mapInform.querySelector('.telegram');
        let site = mapInform.querySelector('.site');
        let categoryHead = document.querySelector('.map-category__head');
        let mapCategory = document.querySelector('.map-category');
        let all = document.querySelectorAll('.categories__item');
        let order_online = mapInform.querySelector('.order-online-map');
        let activeMarkers = [];

        let closeMapModal = document.querySelector('.map-modal__close');
        let openMapModal = document.querySelector('.open-modal');
        closeMapModal.addEventListener('click', function () {
            mapModal.classList.add('hidden');
            openMapModal.classList.remove('hidden');
        });
        openMapModal.addEventListener('click', function () {
            this.classList.add('hidden');
            mapModal.classList.remove('hidden')
        });


        let newSlide;

        function newsSlideClick(marker, data) {
            createDirection.setAttribute('data-location', `{"lat":${data.position.lat}, "lng":${data.position.lng}}`);
            mapInfoWindow.setContent('<div class="marker-popup"> <div class="marker-logo"><svg width="36" height="48" viewBox="0 0 36 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 0C8.05884 0 0 8.05884 0 18C0 33 18 48 18 48C18 48 36 33 36 18C36 8.05884 27.9412 0 18 0ZM18 24C14.6863 24 12 21.3137 12 18C12 14.6862 14.6863 12 18 12C21.3137 12 24 14.6862 24 18C24 21.3137 21.3137 24 18 24Z" fill="#E8BA06"/></svg></div> <div class="marker-text"><p>' + data.description + '</p></div></div>');
            mapInfoWindow.open(map, marker);
            brandList.classList.add('hidden');
            mapInform.classList.remove('hidden');
            nameOfBrand.innerHTML = '<a href="' + data.innerModal.permalink + '">' + data.innerModal.title + '</a>';
            categoriesOfBrand.innerHTML = data.innerModal.category_label;
            anotherText.innerHTML = data.innerModal.moreText;
            if (typeof data.innerModal.address !== 'undefined' && data.innerModal.address !== false) {
                brandAddress.innerHTML = data.innerModal.address;
            }
            if (typeof data.innerModal.email !== 'undefined' && data.innerModal.email !== null) {
                brandMail.innerHTML = data.innerModal.email;
                brandMail.setAttribute('href', `mailto:${data.innerModal.email}`);
            }
            if (typeof data.innerModal.links.fb !== 'undefined') {
                fb.setAttribute('href', data.innerModal.links.fb);
            } else {
                fb.classList.add('d-none');
            }
            if (typeof data.innerModal.links.yt !== 'undefined') {
                youtube.setAttribute('href', data.innerModal.links.yt);
            } else {
                youtube.classList.add('d-none');
            }
            if (typeof data.innerModal.links.in !== 'undefined') {
                inst.setAttribute('href', data.innerModal.links.in);
            } else {
                inst.classList.add('d-none');
            }
            if (typeof data.innerModal.order_online !== 'undefined') {
                order_online.setAttribute('href', data.innerModal.order_online);
                order_online.setAttribute('target', '_blank');
            } else {
                order_online.classList.add('d-none');
            }
            if (typeof data.innerModal.links.vb !== 'undefined') {
                viber.setAttribute('href', data.innerModal.links.vb);
            } else {
                viber.classList.add('d-none');
            }
            if (typeof data.innerModal.links.wb !== 'undefined') {
                site.setAttribute('href', data.innerModal.links.wb);
            } else {
                site.classList.add('d-none');
            }
            if (typeof data.innerModal.links.tg !== 'undefined') {
                telegram.setAttribute('href', data.innerModal.links.tg);
            } else {
                telegram.classList.add('d-none');
            }
            viber.setAttribute('href', data.innerModal.links.vb);
            telegram.setAttribute('href', data.innerModal.links.tg);
            site.setAttribute('href', data.innerModal.links.wb);

            mapInfoWindow.setContent('<div class="marker-popup"> <div class="marker-logo"><svg width="36" height="48" viewBox="0 0 36 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 0C8.05884 0 0 8.05884 0 18C0 33 18 48 18 48C18 48 36 33 36 18C36 8.05884 27.9412 0 18 0ZM18 24C14.6863 24 12 21.3137 12 18C12 14.6862 14.6863 12 18 12C21.3137 12 24 14.6862 24 18C24 21.3137 21.3137 24 18 24Z" fill="#E8BA06"/></svg></div> <div class="marker-text"><p>' + data.description + '</p></div></div>');
            let phones = [];
            if (data.innerModal.phones !== null) {
                data.innerModal.phones.forEach(function (cur) {
                    let item = `<a href="tel:${cur}">${cur}</a>`
                    phones.push(item);
                    brandPhone.innerHTML = phones;
                });
            }
            toBrandList.addEventListener('click', function () {
                brandList.classList.remove('hidden');
                mapInform.classList.add('hidden');
                mapInfoWindow.close();
            });
            closeMapModal.addEventListener('click', function () {
                brandList.classList.remove('hidden');
                mapInform.classList.add('hidden');
                mapModal.classList.add('hidden');
                openMapModal.classList.remove('hidden');
                mapInfoWindow.close();
            });
        }

        for (let i = 0; i < markers.length; i++) {
            newSlide = document.createElement('div');
            newSlide.setAttribute('class', 'map-category__item');
            newSlide.setAttribute('data-category', markers[i].category);
            newSlide.setAttribute('data-id', markers[i].id);
            newSlide.innerHTML = `<div class="map-category__image"><img src=${markers[i].image}></div><div class="map-category__title">${markers[i].description}</div>`;
            mapCategory.append(newSlide);
            let data = markers[i];
            let marker = new google.maps.Marker({
                position: data.position,
                map: map,
                icon: svgMarker,

                inner: data,
            });
            newSlide.addEventListener('click', function () {
                newsSlideClick(marker, data)
            }, false);
            google.maps.event.addListener(marker, 'click', function (e) {
                createDirection.setAttribute('data-location', `{"lat":${markers[i].position.lat}, "lng":${markers[i].position.lng}}`);
                brandList.classList.add('hidden');
                mapInform.classList.remove('hidden');
                nameOfBrand.innerHTML = '<a href="' + markers[i].innerModal.permalink + '">' + markers[i].innerModal.title + '</a>';
                categoriesOfBrand.innerHTML = markers[i].innerModal.category_label;
                anotherText.innerHTML = markers[i].innerModal.moreText;
                if (typeof markers[i].innerModal.address !== 'undefined' && markers[i].innerModal.address !== false) {
                    brandAddress.innerHTML = markers[i].innerModal.address;
                }
                if (typeof markers[i].innerModal.email !== 'undefined' && markers[i].innerModal.email !== null) {
                    brandMail.innerHTML = markers[i].innerModal.email;
                    brandMail.setAttribute('href', `mailto:${markers[i].innerModal.email}`);
                }
                if (typeof markers[i].innerModal.links.fb !== 'undefined') {
                    fb.setAttribute('href', markers[i].innerModal.links.fb);
                } else {
                    fb.classList.add('d-none');
                }
                if (typeof markers[i].innerModal.links.yt !== 'undefined') {
                    youtube.setAttribute('href', markers[i].innerModal.links.yt);
                } else {
                    youtube.classList.add('d-none');
                }
                if (typeof markers[i].innerModal.links.in !== 'undefined') {
                    inst.setAttribute('href', markers[i].innerModal.links.in);
                } else {
                    inst.classList.add('d-none');
                }
                if (typeof markers[i].innerModal.order_online !== 'undefined') {
                    order_online.setAttribute('href', markers[i].innerModal.order_online);
                    order_online.setAttribute('target', '_blank');
                } else {
                    order_online.classList.add('d-none');
                }
                if (typeof markers[i].innerModal.links.vb !== 'undefined') {
                    viber.setAttribute('href', markers[i].innerModal.links.vb);
                } else {
                    viber.classList.add('d-none');
                }
                if (typeof markers[i].innerModal.links.wb !== 'undefined') {
                    site.setAttribute('href', markers[i].innerModal.links.wb);
                } else {
                    site.classList.add('d-none');
                }
                if (typeof markers[i].innerModal.links.tg !== 'undefined') {
                    telegram.setAttribute('href', markers[i].innerModal.links.tg);
                } else {
                    telegram.classList.add('d-none');
                }
                mapInfoWindow.setContent('<div class="marker-popup"> <div class="marker-logo"><svg width="36" height="48" viewBox="0 0 36 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 0C8.05884 0 0 8.05884 0 18C0 33 18 48 18 48C18 48 36 33 36 18C36 8.05884 27.9412 0 18 0ZM18 24C14.6863 24 12 21.3137 12 18C12 14.6862 14.6863 12 18 12C21.3137 12 24 14.6862 24 18C24 21.3137 21.3137 24 18 24Z" fill="#E8BA06"/></svg></div> <div class="marker-text"><p>' + data.description + '</p></div></div>');
                let phones = [];
                if (data.innerModal.phones !== null) {
                    data.innerModal.phones.forEach(function (cur) {
                        let item = `<a href="tel:${cur}">${cur}</a>`
                        phones.push(item);
                        brandPhone.innerHTML = phones;
                    })
                }
                mapInfoWindow.open(map, marker);
                toBrandList.addEventListener('click', function () {
                    brandList.classList.remove('hidden');
                    mapInform.classList.add('hidden');
                    mapInfoWindow.close();
                });
                closeMapModal.addEventListener('click', function () {
                    brandList.classList.remove('hidden');
                    mapInform.classList.add('hidden');
                    mapModal.classList.add('hidden');
                    openMapModal.classList.remove('hidden');
                    mapInfoWindow.close();
                });
            });
            activeMarkers.push(marker);
        }

        for (let i = 0; i < all.length; i++) {
            all[i].addEventListener('click', function () {
                let title = this.querySelector('.item__title').textContent;
                categoryHead.innerHTML = title;

                let mapCatChildren = mapCategory.querySelectorAll('.map-category__item');
                mapCatChildren.forEach(el => {
                    el.classList.add('hidden');
                });

                let mapCatItems = mapCategory.querySelectorAll(`.map-category__item`);
                mapCatItems.forEach(el => {
                    let data_category = el.getAttribute('data-category');
                    if (data_category.indexOf(this.getAttribute('data-category')) >= 0) {
                        el.classList.remove('hidden');
                    }
                });
                // const sliderMapCategoryUpd = document.querySelector();
                const flktySliderBrandCategoryUpd = new Flickity('.map-category', {
                    cellSelector: '.map-category__item:not(.hidden)',
                    pageDots: false,
                    prevNextButtons: true,
                    cellAlign: 'left',
                    freeScroll: true,
                    wrapAround: true,
                    arrowShape: 'M 100 45.5 C 100 43.777344 99.34375 42.125 98.167969 40.90625 C 96.996094 39.6875 95.40625 39 93.75 39 L 21.347656 39 L 48.179688 11.109375 C 49.355469 9.886719 50.011719 8.234375 50.011719 6.507812 C 50.011719 4.78125 49.355469 3.125 48.179688 1.90625 C 47.007812 0.6875 45.414062 0 43.757812 0 C 42.097656 0 40.503906 0.6875 39.332031 1.90625 L 1.835938 40.898438 C 1.253906 41.503906 0.792969 42.21875 0.476562 43.007812 C 0.164062 43.796875 0 44.644531 0 45.5 C 0 46.355469 0.164062 47.203125 0.476562 47.992188 C 0.792969 48.78125 1.253906 49.496094 1.835938 50.101562 L 39.332031 89.09375 C 40.503906 90.3125 42.097656 91 43.757812 91 C 45.414062 91 47.007812 90.3125 48.179688 89.09375 C 49.355469 87.875 50.011719 86.21875 50.011719 84.492188 C 50.011719 82.765625 49.355469 81.113281 48.179688 79.890625 L 21.347656 52 L 93.75 52 C 95.40625 52 96.996094 51.3125 98.167969 50.09375 C 99.34375 48.875 100 47.222656 100 45.5 Z M 100 45.5 ',
                });
                flktySliderBrandCategoryUpd.on('dragStart', () => flktySliderBrandCategoryUpd.slider.style.pointerEvents = 'none');
                flktySliderBrandCategoryUpd.on('dragEnd', () => flktySliderBrandCategoryUpd.slider.style.pointerEvents = 'auto');
                flktySliderBrandCategoryUpd.reloadCells();

                for (let j = 0; j < markers.length; j++) {
                    if (markers[j].category === all[i].dataset.category) {
                        mapCategory.append(newSlide);
                    }
                    let buttonCategory = document.querySelectorAll('.switch-btn');
                    let brandsBusiness = document.querySelector('.brands-business');
                    let interestingPlaces = document.querySelector('.map-interesting-places');
                    window.addEventListener('click', function () {
                        if (buttonCategory[0].classList.contains('active')) {
                            brandsBusiness.classList.remove('hidden')
                        } else {
                            brandsBusiness.classList.add('hidden')
                        }
                        if (buttonCategory[0].classList.contains('active')) {
                            interestingPlaces.classList.add('hidden')
                        } else {
                            interestingPlaces.classList.remove('hidden')
                        }
                    })

                    let closeMapModal = document.querySelector('.map-modal__close');
                    let mapModal = document.querySelector('.map-modal');
                    let openMapModal = document.querySelector('.open-modal')
                    closeMapModal.addEventListener('click', function () {
                        mapModal.classList.add('hidden');
                        openMapModal.classList.remove('hidden')
                    })
                    openMapModal.addEventListener('click', function () {
                        this.classList.add('hidden');
                        mapModal.classList.remove('hidden')
                    })
                }
                //const sliderMapCategory = document.querySelector('.map-category');
                const flktySliderBrandCategory = new Flickity('.map-category', {
                    cellSelector: '.map-category__item:not(.hidden)',
                    pageDots: false,
                    prevNextButtons: true,
                    cellAlign: 'left',
                    freeScroll: true,
                    wrapAround: true,
                    fade: true,
                    arrowShape: 'M 100 45.5 C 100 43.777344 99.34375 42.125 98.167969 40.90625 C 96.996094 39.6875 95.40625 39 93.75 39 L 21.347656 39 L 48.179688 11.109375 C 49.355469 9.886719 50.011719 8.234375 50.011719 6.507812 C 50.011719 4.78125 49.355469 3.125 48.179688 1.90625 C 47.007812 0.6875 45.414062 0 43.757812 0 C 42.097656 0 40.503906 0.6875 39.332031 1.90625 L 1.835938 40.898438 C 1.253906 41.503906 0.792969 42.21875 0.476562 43.007812 C 0.164062 43.796875 0 44.644531 0 45.5 C 0 46.355469 0.164062 47.203125 0.476562 47.992188 C 0.792969 48.78125 1.253906 49.496094 1.835938 50.101562 L 39.332031 89.09375 C 40.503906 90.3125 42.097656 91 43.757812 91 C 45.414062 91 47.007812 90.3125 48.179688 89.09375 C 49.355469 87.875 50.011719 86.21875 50.011719 84.492188 C 50.011719 82.765625 49.355469 81.113281 48.179688 79.890625 L 21.347656 52 L 93.75 52 C 95.40625 52 96.996094 51.3125 98.167969 50.09375 C 99.34375 48.875 100 47.222656 100 45.5 Z M 100 45.5 ',
                });
                flktySliderBrandCategory.on('dragStart', () => flktySliderBrandCategory.slider.style.pointerEvents = 'none');
                flktySliderBrandCategory.on('dragEnd', () => flktySliderBrandCategory.slider.style.pointerEvents = 'auto');
            });
            let categories = document.querySelectorAll('.categories');

            for (let j = 0; j < categories.length; j++) {
                let category = categories[j].querySelectorAll('.categories__item');

                for (let k = 0; k < category.length; k++) {
                    category[k].addEventListener('click', function () {

                        for (let g = 0; g < category.length; g++) {
                            const element = category[g];
                            element.classList.remove('active');
                        }
                        if (!this.classList.contains('active')) {
                            this.classList.add('active');
                        }
                    })
                }
            }
            let buttonCategory = document.querySelectorAll('.switch-btn');

            for (let j = 0; j < buttonCategory.length; j++) {
                buttonCategory[j].addEventListener('click', function () {
                    buttonCategory[0].classList.remove('active') || buttonCategory[1].classList.remove('active');
                    if (!this.classList.contains('active')) {
                        this.classList.add('active');
                    } else {
                        this.classList.remove('active');
                    }
                })
            }
            let brandsBusiness = document.querySelector('.brands-business');
            let interestingPlaces = document.querySelector('.map-interesting-places');
            window.addEventListener('click', function () {
                if (buttonCategory[0].classList.contains('active')) {
                    brandsBusiness.classList.remove('hidden');
                } else {
                    brandsBusiness.classList.add('hidden');
                }
                if (buttonCategory[0].classList.contains('active')) {
                    interestingPlaces.classList.add('hidden');
                } else {
                    interestingPlaces.classList.remove('hidden');
                }
            })
        }

        let categoryItem = document.getElementsByClassName('categories__item');
        for (let i = 0; i < categoryItem.length; i++) {
            categoryItem[i].addEventListener('click', function () {
                let category = this.getAttribute('data-category');
                sortMarkers(activeMarkers, category, map);
            });
        }

        var map_search_input = document.querySelector('#searchform-map input');
        var delayTimer;
        map_search_input.addEventListener('keyup', function () {
            clearTimeout(delayTimer);
            delayTimer = setTimeout(function () {
                map_ajax();
            }, 1000);
        });
        var map_search_form = document.getElementById('searchform-map');
        map_search_form.addEventListener('submit', function (e) {
            e.preventDefault();
            map_ajax();
        });

        function map_ajax() {
            let search_query = map_search_input.value;
            jQuery.ajax({
                url: map_data.root_url,
                type: 'POST',
                data: {
                    action: 'map_search',
                    search_query: search_query
                },
                success: function (data) {
                    var new_markers = JSON.parse(data);
                    for (let i = 0; i < activeMarkers.length; i++) {
                        activeMarkers[i].setMap(null);
                    }
                    var active_slides = document.querySelectorAll('.map-category__item');
                    active_slides.forEach(el => {
                        el.classList.add('search-hide');
                    })
                    new_markers.forEach(function (id) {
                        search_markers(activeMarkers, id, map);
                        active_slides.forEach(el => {
                            if (el.dataset.id == id) {
                                el.classList.remove('search-hide');
                            }
                        });
                    });
                    var flktySliderBrandCategoryUpdd = new Flickity('.map-category', {
                        cellSelector: '.map-category__item:not(.search-hide)',
                        pageDots: false,
                        prevNextButtons: true,
                        cellAlign: 'left',
                        freeScroll: true,
                        wrapAround: true,
                        arrowShape: 'M 100 45.5 C 100 43.777344 99.34375 42.125 98.167969 40.90625 C 96.996094 39.6875 95.40625 39 93.75 39 L 21.347656 39 L 48.179688 11.109375 C 49.355469 9.886719 50.011719 8.234375 50.011719 6.507812 C 50.011719 4.78125 49.355469 3.125 48.179688 1.90625 C 47.007812 0.6875 45.414062 0 43.757812 0 C 42.097656 0 40.503906 0.6875 39.332031 1.90625 L 1.835938 40.898438 C 1.253906 41.503906 0.792969 42.21875 0.476562 43.007812 C 0.164062 43.796875 0 44.644531 0 45.5 C 0 46.355469 0.164062 47.203125 0.476562 47.992188 C 0.792969 48.78125 1.253906 49.496094 1.835938 50.101562 L 39.332031 89.09375 C 40.503906 90.3125 42.097656 91 43.757812 91 C 45.414062 91 47.007812 90.3125 48.179688 89.09375 C 49.355469 87.875 50.011719 86.21875 50.011719 84.492188 C 50.011719 82.765625 49.355469 81.113281 48.179688 79.890625 L 21.347656 52 L 93.75 52 C 95.40625 52 96.996094 51.3125 98.167969 50.09375 C 99.34375 48.875 100 47.222656 100 45.5 Z M 100 45.5 ',
                    });
                    flktySliderBrandCategoryUpdd.reloadCells();
                }
            });
        }

        createDirection.addEventListener('click', function () {
            let Dest = JSON.parse(this.getAttribute('data-location'));
            let Curr = JSON.parse(this.getAttribute('data-position'));
            // let Curr = { lat: 48.516245706561484, lng: 32.25828303343775};
            calculateAndDisplayRoute(directionsRenderer, directionsService, Dest, Curr);
        });

        function sortMarkers(array, category, map) {
            for (let i = 0; i < array.length; i++) {
                array[i].setMap(null);

                if (arrayInArray(array[i].inner.category, category) || category === 'all') {
                    //if(array[i].inner.category===category||category==='all') {
                    array[i].setMap(map);
                }
            }
        }

        function arrayInArray(source, target) { //source - масив в якому шукаємо target - масиви, які шукаємо
            let __tmp_target = [];
            if (target.constructor === Array) {
                __tmp_target = target;
            } else {
                __tmp_target.push(target);
            }
            for (let i = 0; i < __tmp_target.length; i++) {
                if (source.includes(__tmp_target[i])) {
                    return true
                }
            }
            return false
        }

        function search_markers(array, id, map) {
            for (let i = 0; i < array.length; i++) {
                if (array[i].inner.id === id) {
                    array[i].setMap(map);
                }
            }
        }

        const flktySliderBrandCategory = new Flickity('.map-category', {
            pageDots: false,
            prevNextButtons: true,
            cellAlign: 'left',
            freeScroll: true,
            wrapAround: true,
            arrowShape: 'M 100 45.5 C 100 43.777344 99.34375 42.125 98.167969 40.90625 C 96.996094 39.6875 95.40625 39 93.75 39 L 21.347656 39 L 48.179688 11.109375 C 49.355469 9.886719 50.011719 8.234375 50.011719 6.507812 C 50.011719 4.78125 49.355469 3.125 48.179688 1.90625 C 47.007812 0.6875 45.414062 0 43.757812 0 C 42.097656 0 40.503906 0.6875 39.332031 1.90625 L 1.835938 40.898438 C 1.253906 41.503906 0.792969 42.21875 0.476562 43.007812 C 0.164062 43.796875 0 44.644531 0 45.5 C 0 46.355469 0.164062 47.203125 0.476562 47.992188 C 0.792969 48.78125 1.253906 49.496094 1.835938 50.101562 L 39.332031 89.09375 C 40.503906 90.3125 42.097656 91 43.757812 91 C 45.414062 91 47.007812 90.3125 48.179688 89.09375 C 49.355469 87.875 50.011719 86.21875 50.011719 84.492188 C 50.011719 82.765625 49.355469 81.113281 48.179688 79.890625 L 21.347656 52 L 93.75 52 C 95.40625 52 96.996094 51.3125 98.167969 50.09375 C 99.34375 48.875 100 47.222656 100 45.5 Z M 100 45.5 ',
        });
        flktySliderBrandCategory.on('dragStart', () => flktySliderBrandCategory.slider.style.pointerEvents = 'none');
        flktySliderBrandCategory.on('dragEnd', () => flktySliderBrandCategory.slider.style.pointerEvents = 'auto');
        let interestingPlaces = document.querySelector('.interesting-places-content .places-box-wrapper');
        if (typeof interestingPlaces !== 'undefined' && interestingPlaces !== null) {
            let createDirectionBtn = interestingPlaces.querySelectorAll('.create-direction');
            createDirectionBtn.forEach(el => {
                if ('geolocation' in navigator) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var currentLatitude = position.coords.latitude;
                        var currentLongitude = position.coords.longitude;
                        el.setAttribute('data-location', `{"lat": ${position.coords.latitude}, "lng": ${position.coords.longitude}}`);
                    });
                }
                el.addEventListener('click', function () {
                    let Dest = JSON.parse(el.getAttribute('data-direction'));
                    let Curr = JSON.parse(el.getAttribute('data-location'));
                    calculateAndDisplayRoute(directionsRenderer, directionsService, Dest, Curr);
                });
            })
        }
    }

    const flktySliderBrandCategories = new Flickity('.brands-business', {
        pageDots: false,
        prevNextButtons: true,
        cellAlign: 'right',
        wrapAround: true,
        arrowShape: 'M 100 45.5 C 100 43.777344 99.34375 42.125 98.167969 40.90625 C 96.996094 39.6875 95.40625 39 93.75 39 L 21.347656 39 L 48.179688 11.109375 C 49.355469 9.886719 50.011719 8.234375 50.011719 6.507812 C 50.011719 4.78125 49.355469 3.125 48.179688 1.90625 C 47.007812 0.6875 45.414062 0 43.757812 0 C 42.097656 0 40.503906 0.6875 39.332031 1.90625 L 1.835938 40.898438 C 1.253906 41.503906 0.792969 42.21875 0.476562 43.007812 C 0.164062 43.796875 0 44.644531 0 45.5 C 0 46.355469 0.164062 47.203125 0.476562 47.992188 C 0.792969 48.78125 1.253906 49.496094 1.835938 50.101562 L 39.332031 89.09375 C 40.503906 90.3125 42.097656 91 43.757812 91 C 45.414062 91 47.007812 90.3125 48.179688 89.09375 C 49.355469 87.875 50.011719 86.21875 50.011719 84.492188 C 50.011719 82.765625 49.355469 81.113281 48.179688 79.890625 L 21.347656 52 L 93.75 52 C 95.40625 52 96.996094 51.3125 98.167969 50.09375 C 99.34375 48.875 100 47.222656 100 45.5 Z M 100 45.5 ',
    });
    flktySliderBrandCategories.on('dragStart', () => flktySliderBrandCategories.slider.style.pointerEvents = 'none');
    flktySliderBrandCategories.on('dragEnd', () => flktySliderBrandCategories.slider.style.pointerEvents = 'auto');

    const flktySliderBrandCategories2 = new Flickity('.map-interesting-places', {
        pageDots: false,
        prevNextButtons: true,
        cellAlign: 'right',
        wrapAround: true,
        arrowShape: 'M 100 45.5 C 100 43.777344 99.34375 42.125 98.167969 40.90625 C 96.996094 39.6875 95.40625 39 93.75 39 L 21.347656 39 L 48.179688 11.109375 C 49.355469 9.886719 50.011719 8.234375 50.011719 6.507812 C 50.011719 4.78125 49.355469 3.125 48.179688 1.90625 C 47.007812 0.6875 45.414062 0 43.757812 0 C 42.097656 0 40.503906 0.6875 39.332031 1.90625 L 1.835938 40.898438 C 1.253906 41.503906 0.792969 42.21875 0.476562 43.007812 C 0.164062 43.796875 0 44.644531 0 45.5 C 0 46.355469 0.164062 47.203125 0.476562 47.992188 C 0.792969 48.78125 1.253906 49.496094 1.835938 50.101562 L 39.332031 89.09375 C 40.503906 90.3125 42.097656 91 43.757812 91 C 45.414062 91 47.007812 90.3125 48.179688 89.09375 C 49.355469 87.875 50.011719 86.21875 50.011719 84.492188 C 50.011719 82.765625 49.355469 81.113281 48.179688 79.890625 L 21.347656 52 L 93.75 52 C 95.40625 52 96.996094 51.3125 98.167969 50.09375 C 99.34375 48.875 100 47.222656 100 45.5 Z M 100 45.5 ',
    });
    flktySliderBrandCategories2.on('dragStart', () => flktySliderBrandCategories2.slider.style.pointerEvents = 'none');
    flktySliderBrandCategories2.on('dragEnd', () => flktySliderBrandCategories2.slider.style.pointerEvents = 'auto');
    document.head.appendChild(script);
}

