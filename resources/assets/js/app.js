require('./bootstrap');

window.Vue = require('vue');

Vue.component('books', require('./components/Books.vue'));

const app = new Vue({
    el: '#app',
});
