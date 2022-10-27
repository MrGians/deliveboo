<template>
<section id="restaurant-detail">
    <div class="container">
        <!-- Card Restaurant -->
        <div id="card-restaurant" class="row justify-content-center mb-5">
            <div class="col-md-7">
                <div class="card rounded-5 mt-5 mb-5 shadow">
                    <div class="text-center">
                        <div id="logo">
                            <span class="text-logo">LOGO</span>
                        </div>
                        <div class="card-body">
                            <ul class="information-restaurant">
                                <li class="title-restaurant-card">Nome Ristorante</li>
                                <li class="category">Categoria 1 Categoria 2</li>
                                <li class="address">Via delle Belle Arti 2a, Bologna, 40162</li>
                                <li class="option">Consegna gratis | Oridne minimo 10€</li>
                                <li class="p-iva">P.IVA: 006354267</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CART -->
    <div class="container">
        <ShoppingCart :products="cartProducts"/>
    </div>

    <!-- Menu -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card rounded-5 mb-3 pb-5 shadow">
                    <div v-for="product in products" :key="product.id" class="row restaurant_dishes">
                        <div class="col-3">
                            <img src="../../../../public/img/piatto_1.jpg" alt="" class="restaurant_dishes_img">
                        </div>
                        <div class="col-6">
                            <ul class="information-dishes">
                                <li class="name_dishes">{{ product.title }}</li>
                                <li class="price-dishes"><i class="fa-solid fa-money-bill"></i>{{ product.price }}</li>
                                <li>
                                    <input type="number" placeholder="quantity" min="1" v-model="product.qty">
                                </li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <button @click="addToCart(product)" class="add-cart">Aggiungi all'ordine</button>
                        </div>
                    </div>
                    <hr>
                    <!-- <div class="row restaurant_dishes">
                        <div class="col-3">
                            <img src="../../../../public/img/piatto_1.jpg" alt="" class="restaurant_dishes_img">
                        </div>
                        <div class="col-6">
                            <ul class="information-dishes">
                                <li class="name_dishes">Nome piatto</li>
                                <li class="category-dishes">Categoria 1 - Categoria 2</li>
                                <li class="description-dishes">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit error commodi omnis! Minus quae molestias</li>
                                <li class="allergens-dishes"><i class="fa-solid fa-wheat-awn"></i>Allergeni</li>
                                <li class="price-dishes"><i class="fa-solid fa-money-bill"></i>23.70</li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <a href="#" class="add-cart">Aggiungi all'ordine</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

</section>
</template>

<script>
import ShoppingCart from '../ShoppingCart.vue'
export default {
  components: { ShoppingCart },
    name: 'RestaurantDetailPage',
    data () {
        return {
            products: [
                {id: 1,title: 'Macbook Pro', price: 2500.00, qty: 1, image: 'http://lorempixel.com/150/150/'},  
                {id: 2,title: 'Asus ROG Gaming',price: 1000.00, qty: 1,image: 'http://lorempixel.com/150/150/'},  
                {id: 3,title: 'Amazon Kindle',price: 150.00,qty: 1,image: 'http://lorempixel.com/150/150/'},  
                {id: 4,title: 'Another Product',price: 10, qty: 1, image: 'http://lorempixel.com/150/150/'},  
            ],
            cartProducts: [],
        }
    },

    
    methods: {
        addToCart(productToAdd) {

            let productInCart = this.cartProducts.filter(product => product.id === productToAdd.id);
            let isProductInCart = productInCart.length > 0;

            if (isProductInCart === false) {
                this.cartProducts.push(Vue.util.extend({}, productToAdd));
            } else {
                productInCart[0].qty = parseInt(productInCart[0].qty) + parseInt(productToAdd.qty);
            }
            
            productToAdd.qty = 1;
        }
    } 
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

.justify-content-center{
    justify-content: center;
}

.mb-5{
    margin-bottom: 3rem;  
}
.mb-3{
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

.mt-5{
    margin-top: 3rem;
}

.pb-5{
  padding-bottom: 3rem;
}
/* UTILS */
#logo{
    position: absolute;
    top: -10px;
    left: 50%;
    transform: translate(-50%);
}


/* CARD RESTAURANT */
#card-restaurant{
    margin-bottom: 100px;
}

.card{
    background-color: #fff;
}
.text-logo{
    border-radius: 50%;
    background-color: #2fb871;
    padding: 20px;
    border: 1px solid #fff;
    color: #fff;
}

ul.information-restaurant{
    padding-top: 50px;
}

li{
    list-style-type: none;
    font-size: 14px;
    padding-bottom: 20px;
}

.title-restaurant-card{
    font-size: 30px;
    color: #fc5958;
    font-weight: bold;
    padding-bottom: 30px;
}

.category{
    font-size: 16px;
    font-weight: bold;
}

.option{
    font-weight: bold;
    padding-bottom: 30px;
    font-size: 12px;
}

.p-iva{
    padding-bottom: 30px;
    font-size: 12px;
    color: #666;
}
/* CARD RESTAURANT */

/* MENU */
.restaurant_dishes{
    padding: 50px 20px;
    align-items: center;
}
.restaurant_dishes_img{
    max-width: 100%;
}

.name_dishes{
    font-size: 20px;
    color: #fc5958;
    font-weight: bold;
    padding-bottom: 10px;
}

.category-dishes{
    font-weight: bold;
}

.description-dishes{
    padding-bottom: 25px;
}

.allergens-dishes{
    padding-bottom: 5px;
}

.fa-solid{ 
    color: #ffbd42;
    margin-right: 10px;
}

.price-dishes{
    font-weight: bold;
    font-size: 17px;
}

.add-cart{
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

