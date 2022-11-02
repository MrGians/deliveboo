import { forEach } from 'lodash';
import Vue from 'vue';

import Vuex from 'vuex';

window.Vuex = Vuex;

Vue.use(Vuex);


let cart = window.localStorage.getItem('cart');
let cartCount = window.localStorage.getItem('cartCount');

let store = {
    state: {
        cart: cart ? JSON.parse(cart) : [],
        cartCount: cartCount ? parseInt(cartCount) : 0,
    },
    mutations: {
        /*addToCart(state, item) {
            let found = state.cart.find(product => product.id == item.id);

            
            if (found) {
                found.quantity++;
                found.totalPrice = found.quantity * found.price;
            } else {
                state.cart.push(item);

                Vue.set(item, 'quantity', 1);
                Vue.set(item, 'totalPrice', item.price);

            }

            state.cartCount++;

            this.commit('saveCart');

        },*/
        removeFromCart(state, item) {
            let index = state.cart.indexOf(item);

            if (index > -1) {
                let product = state.cart[index];
                state.cartCount -= product.quantity;

                state.cart.splice(index, 1);
            }
            this.commit('saveCart');
        },
        IncrementButton(state, item) {
            let index = state.cart.indexOf(item);

            let product = state.cart[index];

            product.quantity++;
            product.totalPrice = product.quantity * product.price;
            state.cartCount++;

            this.commit('saveCart');
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
            this.commit('saveCart');

        },
        saveCart(state) {
            window.localStorage.setItem('cart', JSON.stringify(state.cart));
            window.localStorage.setItem('cartCount', state.cartCount);
        },
        /*resetCart(state) {
            window.localStorage.removeItem('cart', JSON.stringify(this.$store.state.cart));
            window.localStorage.removeItem('cartCount', this.$store.state.cartCount);
            this.$store.state.cart = [];
            this.$store.state.cartCount = 0;
            this.$router.push({ name: "restaurants" });
        }*/
    }
};


export default store;