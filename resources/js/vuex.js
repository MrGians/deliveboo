import { forEach } from "lodash";
import Vue from "vue";

import Vuex from "vuex";

window.Vuex = Vuex;

Vue.use(Vuex);

let cart = window.localStorage.getItem("cart");
let cartCount = window.localStorage.getItem("cartCount");

let store = {
    state: {
        cart: cart ? JSON.parse(cart) : [],
        cartCount: cartCount ? parseInt(cartCount) : 0,
    },
    mutations: {
        removeFromCart(state, item) {
            let index = state.cart.indexOf(item);

            if (index > -1) {
                let product = state.cart[index];
                state.cartCount -= product.quantity;

                state.cart.splice(index, 1);
            }
            this.commit("saveCart");
        },
        IncrementButton(state, item) {
            let index = state.cart.indexOf(item);

            let product = state.cart[index];

            product.quantity++;
            product.totalPrice = product.quantity * product.price;
            state.cartCount++;

            this.commit("saveCart");
        },
        DecrementButton(state, item) {
            let index = state.cart.indexOf(item);

            let product = state.cart[index];

            product.quantity--;
            product.totalPrice -= product.price;

            if (!(product.quantity < 1)) {
                state.cartCount--;
            }

            if (product.quantity < 1) {
                product.quantity = 1;
                product.totalPrice = product.price;
            }
            this.commit("saveCart");
        },
        saveCart(state) {
            window.localStorage.setItem("cart", JSON.stringify(state.cart));
            window.localStorage.setItem("cartCount", state.cartCount);
        },
    },
};

export default store;
