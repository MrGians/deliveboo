<template>
    <div class="card rounded-5 mb-3 pb-5 shadow">
        <div class="row">
            <h1>
                Cart ({{ $store.state.cartCount }})
            </h1>
        </div>
        <div v-if="$store.state.cart.length > 0">
            <div class="row" v-for="item in $store.state.cart" :key="item.id">
                <div class="col-6">
                    {{ item.title }}
                </div>
                <div class="col-3">
                    x{{ item.quantity }}
                </div>
                <div class="col-3">
                    - {{ item.totalPrice }}
                    <button @click.prevent="removeFromCart(item)">
                        elimina dal carrello
                    </button>
                </div>
                <hr>
            </div>
            <div class="row">
                Totale: {{ totalPrice }}
            </div>
        </div>
        <div v-else class="row">
            Il carrello è vuoto
        </div>
    </div>
</template>

<script>
export default {
    name: 'ShoppingCart',
    computed: {
        totalPrice() {
            let total = 0;

            for (let item of this.$store.state.cart) {
                total += item.totalPrice;
            }

            return total.toFixed(2);
        }
    },
    methods: {
        removeFromCart(item) {
            this.$store.commit('removeFromCart', item);
        }
    }
}
</script>

<style>

</style>