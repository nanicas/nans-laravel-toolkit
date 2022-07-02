
// nice select
$(document).ready(function () {

    $('.filters_menu li').click(function () {
        $('.filters_menu li').removeClass('active');
        $(this).addClass('active');

        var data = $(this).attr('data-filter');
        $grid.isotope({
            filter: data
        });
    });

    var $grid = $(".grid").isotope({
        itemSelector: ".all",
        percentPosition: false,
        masonry: {
            columnWidth: ".all"
        }
    });

    // client section owl carousel
    $(".client_owl-carousel").owlCarousel({
        loop: true,
        margin: 0,
        dots: false,
        nav: true,
        navText: [],
        autoplay: true,
        autoplayHoverPause: true,
        navText: [
            '<i data-feather="chevrons-left" aria-hidden="true"></i>',
            '<i data-feather="chevrons-right" aria-hidden="true"></i>'
        ],
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            1000: {
                items: 2
            }
        }
    });

    feather.replace();

    //$('select').niceSelect();
});

/** google_map js **/
function myMap() {

    const myLatLng = {lat: -22.2078949, lng: -49.6545122};

    var mapProp = {
        center: myLatLng,
        zoom: 18
    };
    var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

    new google.maps.Marker({
        position: myLatLng,
        map,
        title: "Localização",
    });
}

// to get current year
function getYear() {
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    document.querySelector("#displayYear").innerHTML = currentYear;
}

getYear();

