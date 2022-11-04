<template>
    <section id="restaurant-detail">
        
            <!-- Card Restaurant -->
            <div id="card-restaurant" class="row justify-content-center mb-5">
                <div class="col-7 head-col">
                    <div class="card rounded-5 p-2 shadow">
                        <div class="text-center">
                            <div id="logo">
                                <img class="text-logo" :src="'/storage/' + detailRestaurant.logo" />
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
                
                <div class="col-5 head-col h-100" v-if="$store.state.cart.length > 0">
                    <ShoppingCart></ShoppingCart>
                </div>

            </div>
        
        
        

        <BaseModal v-if="showModal" @close="closeModal()" @reset="resetCart()">
        <!--
            you can use custom content here to overwrite
            default content
        -->
            <h3 slot="header" class="text-tertiary">Attenzione</h3>
            <div class="p-2" slot="body">
                <p>Puoi ordinare solo da un ristorante per volta. Vuoi iniziare un nuovo ordine? <strong>Se inizi un nuovo ordine il carrello si svuoterà.</strong></p>
            </div>
        </BaseModal>

        <!-- Cart -->

        <!-- Menu -->
        
            <div class="row justify-content-center">
                <div class="col-12 foot-col">
                    <div class="card rounded-5 mb-3 pb-5 p-2 shadow">
                        <div v-for="item in detailRestaurant.products" :key="item.id" class="row restaurant_dishes">
                            <div class="col-3 p-2">
                                <img :src="'/storage/' + item.image" alt="" class="restaurant_dishes_img">
                            </div>
                            <div class="col-6 p-2">
                                <ul class="information-dishes">
                                    <li class="name_dishes">{{ item.name }}</li>
                                    <li class="description">{{ item.description }}</li>
                                    <li class="price-dishes">€{{
                                            item.price.toFixed(2)
                                    }}</li>
                                </ul>
                            </div>
                            <div class="col-3 p-2 text-center">
                                <button class="button-add-to-cart" @click="addToCart(item)">Aggiungi all'ordine</button>
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
                this.removeFromCart(item);
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
        },
        closeModal() {
            this.showModal = false;
            window.history.back();

        },
        removeFromCart() {
            this.$store.commit('removeFromCart', item);
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

.text-tertiary {
    color: $tertiary;
}

.h-100 {
    height: 100%;
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
    padding: 0px 15px;
}

.col-5 {
  flex: 0 0 41.66666667%;
  max-width: 41.66666667%;
}

.col-6 {
    flex: 0 0 50%;
    max-width: 50%;
    padding: 0px 15px;
}

.col-7 {
    flex: 0 0 58.33333333%;
    max-width: 58.33333333%;
}

.col-12 {
    flex: 0 0 100%;
    max-width: 100%;
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 3px solid $secondary;
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

.p-2 {
  padding: 1rem;
}

#logo > img {
    max-width: 150px;
}



/* CARD RESTAURANT */
#card-restaurant {
    margin-bottom: 100px;
    min-height: 700px;

    .head-col {
        padding: 1rem;
    }

}

.foot-col {
    padding: 0 1rem;
}




.card {
    background-color: #fff;
    overflow: hidden;
}

.text-logo {
    border-radius: 50%;
    background-color: $quaternary;
    padding: 20px;
    border: 1px solid #fff;
    color: #fff;
}

ul.information-restaurant {
    padding-top: 50px;
}

li {
    list-style-type: none;
    font-size: 0.8rem;
    padding-bottom: 20px;
}

.title-restaurant-card {
    font-size: 1.7rem;
    color: $tertiary;
    font-weight: bold;
    padding-bottom: 30px;
}

.category {
    font-size: 0.9rem;
    font-weight: bold;
}

.option {
    font-weight: bold;
    padding-bottom: 30px;
    font-size: 0.75rem;
}

.p-iva {
    padding-bottom: 30px;
    font-size: 12px;
    color: $primary;
}

/* CARD RESTAURANT */

/* MENU */



.restaurant_dishes {
    padding: 0 50px;
    align-items: center;
    border-bottom: 1.5px solid $secondary;
}

.restaurant_dishes_img {
    max-width: 100%;
    height: auto;

}

.name_dishes {
    font-size: 20px;
    color: $tertiary;
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
    color: $secondary;
    margin-right: 10px;
}

.price-dishes {
    font-weight: bold;
    font-size: 17px;
}

.button-add-to-cart {
    display: inline-block;
    padding: 0.6rem 1.2rem;
    border: 2px solid $quaternary;
    background-color: $quaternary;
    color: white;
    border-radius: 30px;
    margin-left: 1rem;
    transition: all 0.35s;
    margin-bottom: 1.5rem;

    &:hover {
        background-color: white;
        color: $quaternary;
    }
}



/* MENU */



@media (max-width: 1200px) {
    .container {
        max-width: 1140px;
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
    .button-add-to-cart {
        padding: 1rem 1.6rem;
    }
}

@media (max-width: 992px) {
    .container {
        max-width: 960px;
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
    .button-add-to-cart {
        padding: 0.6rem 1.2rem;
    }
    #card-restaurant {
        flex-direction: column;
        & > .head-col {
            width: 100%;
            max-width: 100%;
        }
    }
}

@media (max-width: 768px) {
    .container {
        max-width: 720px;
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
    .button-add-to-cart {
        padding: 0.6rem 1.2rem;
    }
}

@media (max-width: 576px) {
    .container {
        max-width: 540px;
    }
    .restaurant_dishes {
        display: flex;
        justify-content: center;
        align-items: center;
        & > [class^="col-"] {
            max-width: 100%;
            flex: 0 0 100%;
        }
    }
    .button-add-to-cart {
        padding: 1rem 1.6rem;
    }
}

</style>

