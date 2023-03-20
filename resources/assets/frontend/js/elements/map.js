var markers = [ {
    latlng: [50.006109, 36.231036],
    title: 'г. Харьков, ул. Мироносицкая 46 (М "Университет")'
},
 {
    latlng: [50.394021, 30.489859],
    title: 'г. Киев, ул. Васильковская 30 (М "Васильковская", вход со стороны ул.Сумская)'
}];

var map = null;

var mSelect = document.querySelector('#markers');
mSelect.innerHTML += markers.map((n, i) => `<option value="${i}">${n.title}</option>`).join('')
mSelect.addEventListener('change', function() {
    var marker = markers[this.value];
    if (marker) {
        map.setCenter({
            lat: marker.latlng[0],
            lng: marker.latlng[1]
        })
        map.setZoom(17);
    }
})

function initialize() {
    map = new google.maps.Map(document.getElementById("map_canvas"), {
        zoom: 12,
        center: new google.maps.LatLng(50.45225789, 30.56053162),
        mapTypeId: google.maps.MapTypeId.roadmap

    });

    markers.forEach(n => new google.maps.Marker({
        position: new google.maps.LatLng(...n.latlng),
        map: map,
        title: n.title
    }));
}

google.maps.event.addDomListener(window, 'load', initialize);

/* map start*/
// function myMap(mapItem) {
//     var coords = mapItem.data('coords').split(/\s*,\s*/);
//     var myLatlng = new google.maps.LatLng(coords[0], coords[1]);
//     var myCenter = new google.maps.LatLng(coords[0], coords[1]);
//
//     if (mapItem.length > 0) {
//         var mapOptions = {
//             zoom: 17,
//             center: myCenter,
//             scrollwheel: false,
//             disableDefaultUI: false,
//             mapTypeId: google.maps.MapTypeId.ROADMAP
//         };
//         var map = new google.maps.Map(document.getElementById(mapItem[0].id), mapOptions);
//         var marker = new google.maps.Marker({
//             position: myLatlng,
//             map: map,
//             icon: 'images/marker.png'
//         });
//     }
// }

if ($("#map").length) {
    initialize($("#map"));
}

if ($("#map-pickup").length) {
    initialize($("#map-pickup"));
}

if ($("#map-pickup1").length) {
    initialize($("#map-pickup1"));
}

if ($("#map-pickup2").length) {
    initialize($("#map-pickup2"));
}

if ($("#map-pickup3").length) {
    initialize($("#map-pickup3"));
}
/* map end*/
