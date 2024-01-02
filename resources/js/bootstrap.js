/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

function updateLoket(event) {
    // Mendapatkan elemen-elemen loket
    var cs = document.getElementById('cs');
    var teller = document.getElementById('teller');

    // Menggabungkan nilai loket dan kode_antrian
    var kode =  event.message.kode_antrian;
    
    var layanan = event.message.type_antrian;
    let loketCT = event.message.loket_antrian;

    // Memperbarui elemen loket1
    if (layanan == "customer_service") {
        cs.querySelector('.loket2').innerHTML = kode;
        cs.querySelector('.loket').innerHTML = "Loket "+loketCT;
    }
    // Memperbarui elemen loket2
    else if (layanan == "teller") {
        teller.querySelector('.loket2').innerHTML = kode;
        teller.querySelector('.loket').innerHTML = "Loket "+loketCT;
    }
}

function loket(event){
    var loket = event.message.loket_antrian;

    for (var i = 1; i <= 5; i++) {
        var loketElement = document.getElementById('loket' + i);

        if (loketElement && i == loket) {
            loketElement.querySelector('.loket2').innerHTML = event.message.kode_antrian;
        }
    }
}



window.Echo.channel('message').listen('.my-event', (event) => {
    console.log("Listen Berhasil");
    console.log(event.message.kode_antrian);
    console.log(event.message.type_antrian);
    console.log(event.message.loket_antrian);
    loket(event);
    updateLoket(event);

});

