require("./bootstrap");

window.Vue = require("vue");

import App from "./components/App.vue";
import router from "./router.js";

const app = new Vue({
    el: "#app",
    render: (h) => h(App),
    router,
});
