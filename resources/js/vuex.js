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
        addToCart(state, item) {
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

            /*if (state.cart.length === 0 || item.restaurant_id === state.cart.item.restaurant_id) {
                state.cart.push(item);
            }
            if (item.restaurant_id !== state.cart.item.restaurant_id) {
                this.showModal = true;
            }*/

            // Se il carrello é vuoto oppure il restaurant id dell'item che si vuole aggiungere é = al restaurant id degli item già presenti nel carrello allora aggiungi al carrello.
            // Se il restaurant id dell' item che si vuole aggiungere é diverso dal restaurant id dell'item già presente nel carrello.
            // Allora crea un popup con due pulsanti 
            // 1 - per cancellare tutti gli item già presenti nel carrello e aggingere quello che si desidera committare- e 
            // 2 - con il tasto "annulla" fa sparire il popup.
            this.commit('saveCart');

        },
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
        }
    }
};


export default store;