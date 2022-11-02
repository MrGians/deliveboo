// import Vue Router
import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import HomePage from "./components/pages/HomePage";
import RestaurantsPage from "./components/pages/RestaurantsPage";
import RestaurantDetailPage from "./components/pages/RestaurantDetailPage";
import NotFoundPage from "./components/pages/NotFoundPage";

const routes = new VueRouter({
    mode: "history",
    linkExactActiveClass: "active",
    linkActiveClass: "active",
    routes: [
        { path: "/", component: HomePage, name: "home" },
        {
            path: "/restaurants",
            component: RestaurantsPage,
            name: "restaurants",
        },
        {
            path: "/restaurant/:id",
            component: RestaurantDetailPage,
            name: "restaurant-detail",
        },
        { path: "*", component: NotFoundPage, name: "not-found" },
    ],
});



export default routes;
