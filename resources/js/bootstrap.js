import axios from 'axios';
window.axios = axios;
require("leaflet");
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
