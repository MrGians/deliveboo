<template>
    <section id="restaurant-detail">
        <div class="container">
            <!-- Card Restaurant -->
            <div id="card-restaurant" class="row justify-content-center mb-5">
                <div class="col-md-7">
                    <div class="card rounded-5 mt-5 mb-5 shadow">
                        <div class="text-center">
                            <div id="logo">
                                <img class="text-logo" :src="'storage/' + detailRestaurant.logo" />
                            </div>
                            <div class="card-body">
                                <ul class="information-restaurant">
                                    <li class="title-restaurant-card">{{ detailRestaurant.name }}</li>
                                    <li class="category" v-for="category in detailRestaurant.categories" :key="category.id">
                                        <span>{{ category.label }} </span>
                                    </li>
                                    <li class="description">{{ detailRestaurant.description }}</li>
                                    <li class="address">{{ detailRestaurant.address }}</li>
                                    <li class="option">Consegna gratis | Oridne minimo 10€</li>
                                    <li class="p-iva">{{ detailRestaurant.p_iva }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        

        <BaseModal v-if="showModal" @reset="resetCart()">
        <!--
            you can use custom content here to overwrite
            default content
        -->
            <h3 slot="header">Attenzione</h3>
            <div class="container" slot="body">
                <p>Puoi ordinare solo da un ristorante per volta. Il carrello si svuoterà.</p>
            </div>
        </BaseModal>

        <!-- Cart -->
        <div class="container">
            <ShoppingCart></ShoppingCart>
        </div>

        <!-- Menu -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card rounded-5 mb-3 pb-5 shadow">
                        <div v-for="item in detailRestaurant.products" :key="item.id" class="row restaurant_dishes">
                            <div class="col-3">
                                <img :src="item.image" alt="" class="restaurant_dishes_img">
                            </div>
                            <div class="col-6">
                                <ul class="information-dishes">
                                    <li class="name_dishes">{{ item.name }}</li>
                                    <li class="description">{{ item.description }}</li>
                                    <li class="price-dishes"><i class="fa-solid fa-money-bill"></i>{{
                                            item.price.toFixed(2)
                                    }}</li>
                                </ul>
                            </div>
                            <div class="col-3">
                                <button class="add-cart" @click="addToCart(item)">Aggiungi all'ordine</button>
                            </div>
                            <hr>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
</template>

<script>
import BaseModal from '../BaseModal.vue';
import ShoppingCart from '../ShoppingCart.vue';
export default {
    components: { ShoppingCart, BaseModal },
    name: 'RestaurantDetailPage',
    data() {
        return {
            detailRestaurant: [],
            showModal: false,
            cart: [],
        }
    },
    methods: {
        addToCart(item) {
            let found = this.$store.state.cart.find(product => product.id == item.id);
            let foundOther = this.$store.state.cart.find(product => product.restaurant_id !== item.restaurant_id);
            
            if(foundOther) {
                this.showModal = true;
            }
            
            if (found) {

                found.quantity++;
                found.totalPrice = found.quantity * found.price;
                
            } else {
                this.$store.state.cart.push(item);
                
                Vue.set(item, 'quantity', 1);
                Vue.set(item, 'totalPrice', item.price);
                
            }
            
            
            this.$store.state.cartCount++;

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
            this.$store.commit('saveCart');

        },
        fetchRestaurant() {
            axios.get('http://127.0.0.1:8000/api/restaurants/' + this.$route.params.id)
                .then((res) => {
                    this.detailRestaurant = res.data;
                    
                });
        },
        resetCart(state) {
            window.localStorage.removeItem('cart', JSON.stringify(this.$store.state.cart));
            window.localStorage.removeItem('cartCount', this.$store.state.cartCount);
            this.$store.state.cart = [];
            this.$store.state.cartCount = 0;
            this.showModal = false;
        }
        
        
    },
    computed: {
        updatedCart() {
            this.$store.state.cart['cart_id'] = this.detailRestaurant.id;
            console.log(this.$store.state.cart);
            return this.$store.state.cart
        }
    },
    mounted() {
        this.fetchRestaurant()
    },
    

}
</script>

<style scoped lang="scss">
@import "./../../../sass/front.scss";

/* UTILS */
.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.justify-content-center {
    justify-content: center;
}

.mb-5 {
    margin-bottom: 3rem;
}

.mb-3 {
    margin-bottom: 1rem;
}

.col-3 {
    flex: 0 0 25%;
    max-width: 25%;
    padding: 0px 10px;
}

.col-6 {
    flex: 0 0 50%;
    max-width: 50%;
    padding: 0px 10px;
}

.col-md-7 {
    flex: 0 0 58.33333333%;
    max-width: 58.33333333%;
}

.col-md-12 {
    flex: 0 0 100%;
    max-width: 100%;
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem;
}

.rounded-5 {
    border-radius: 50px;
}

.mt-5 {
    margin-top: 3rem;
}

.pb-5 {
    padding-bottom: 3rem;
}

/* UTILS */
#logo {
    position: absolute;
    top: -10px;
    left: 50%;
    transform: translate(-50%);
}

/* CARD RESTAURANT */
#card-restaurant {
    margin-bottom: 100px;
}

.card {
    background-color: #fff;
}

.text-logo {
    border-radius: 50%;
    background-color: #2fb871;
    padding: 20px;
    border: 1px solid #fff;
    color: #fff;
}

ul.information-restaurant {
    padding-top: 50px;
}

li {
    list-style-type: none;
    font-size: 14px;
    padding-bottom: 20px;
}

.title-restaurant-card {
    font-size: 30px;
    color: #fc5958;
    font-weight: bold;
    padding-bottom: 30px;
}

.category {
    font-size: 16px;
    font-weight: bold;
}

.option {
    font-weight: bold;
    padding-bottom: 30px;
    font-size: 12px;
}

.p-iva {
    padding-bottom: 30px;
    font-size: 12px;
    color: #666;
}

/* CARD RESTAURANT */

/* MENU */
.restaurant_dishes {
    padding: 50px 20px;
    align-items: center;
}

.restaurant_dishes_img {
    max-width: 100%;
}

.name_dishes {
    font-size: 20px;
    color: #fc5958;
    font-weight: bold;
    padding-bottom: 10px;
}

.category-dishes {
    font-weight: bold;
}

.description-dishes {
    padding-bottom: 25px;
}

.allergens-dishes {
    padding-bottom: 5px;
}

.fa-solid {
    color: #ffbd42;
    margin-right: 10px;
}

.price-dishes {
    font-weight: bold;
    font-size: 17px;
}

.add-cart {
    padding: 40px 25px;
    background-color: #ffbd42;
    border-radius: 30px;
    color: #fff;
    font-weight: bold;
}

/* MENU */
@media (min-width: 576px) {
    .container {
        max-width: 540px;
    }
}

@media (min-width: 768px) {
    .container {
        max-width: 720px;
    }
}

@media (min-width: 992px) {
    .container {
        max-width: 960px;
    }
}

@media (min-width: 1200px) {
    .container {
        max-width: 1140px;
    }
}
</style>>

