<template>
<section id="restaurant-detail">
    <div class="jumbotron">
        <div class="container">
            <!-- LOGO -->
            <div id="title">
                <h1>Deliveboo</h1>
            </div>
        
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
    </div>

    <!-- Menu -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card rounded-5 mt-5 pb-5 shadow">
                    <div class="row restaurant_dishes">
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
                    </div>
                    <hr>
                    <div class="row restaurant_dishes">
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
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
</template>

<script>
export default {

}
</script>

<style scoped>
.jumbotron{
    background-image: url('/img/header_dettaglio_ristorante.png');
    background-repeat: no-repeat;
    background-position: top;
    background-size: cover;
    margin-bottom: 50px;
}

#title{
    color: #fc5958;
    font-size: 30px;
    padding-top: 20px;
    margin-bottom: 100px;
}

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
</style>>

