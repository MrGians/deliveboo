// import Vue Router
import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import HomePage from "./components/pages/HomePage";
import RestaurantDetailPage from "./components/pages/RestaurantDetailPage"
import NotFoundPage from "./components/pages/NotFoundPage";

const routes = new VueRouter({
    mode: "history",
    linkExactActiveClass: "active",
    linkActiveClass: "active",
    routes: [
        { path: "/", component: HomePage, name: "home" },
        { path: "/restaurant/:id", component: RestaurantDetailPage, name: "restaurant.show" },
        { path: "*", component: NotFoundPage, name: "not-found" },
    ],
});

export default routes;
