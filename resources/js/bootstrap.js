import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Set CSRF token for AJAX requests
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

// Keep session alive by making a request every 30 minutes
setInterval(() => {
    axios.get('/').catch(() => {
        // Ignore errors, just to keep session alive
    });
}, 30 * 60 * 1000); // 30 minutes
