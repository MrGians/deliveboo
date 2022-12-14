require("./bootstrap");

window.Vue = require("vue");

import App from "./components/App.vue";
import router from "./router.js";
import store from './vuex.js';

const app = new Vue({
    el: "#root",
    render: (h) => h(App),
    router,
    store: new Vuex.Store(store),
});
