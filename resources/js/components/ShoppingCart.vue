<template>
    <div class="card rounded-5 mb-3 pb-5 shadow">
        <div v-for="(product, index) in products" :key="index" class="row">
            <div class="col-6">
                <span>{{ product.title }}</span>
            </div>
            <div class="col-3">
                <span>Quantità: </span>
                <input type="number" placeholder="quantity" min="1" v-model="product.qty">
            </div>
            <div class="col-3">
                <span>{{ product.price}}</span>
                <button @click="removeProduct(index)" class="add-cart">Rimuovi</button>
            </div>
            <hr>
        </div>
        <div class="row" v-show="products.length === 0">
            <div class="col-md-12">
                <span>Il carrello è vuoto</span>
            </div>
        </div>
        <div class="row" v-show="products.length > 0">
            <div class="col-6"></div>
            <div class="col-3">
                <span>Cart Total:  </span>
            </div>
            <div class="col-3">
                <span>{{ Total }}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:'ShoppingCart',
    props:{
       products: Array 
    },
    computed:{
        Total() {
        let total = 0;
        this.products.forEach(product => {
            total += (product.price * product.qty);
        });
        return total;
        }
    },
    methods: {
        removeProduct(index) {
        this.products.splice(index, 1)
        }
    }
}
</script>

<style scoped lang="scss">
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
</style>