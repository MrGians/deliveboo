<template>
    <div class="card rounded-5 mb-3 pb-5 shadow">
        <div>
            <h1>
                Cart ({{ $store.state.cartCount }})
            </h1>
        </div>
        <div v-if="$store.state.cart.length > 0">
            <div v-for="item in $store.state.cart" :key="item.id">
                <div class="col-6">
                    {{ item.name }}
                </div>
                <div class="col-3">
                    <button @click="DecrementButton(item)">
                        -
                    </button>
                    x{{ item.quantity }}
                    <button @click="IncrementButton(item)">
                        +
                    </button>
                </div>
                <div class="col-3">
                    <!-- {{ item.totalPrice.toFixed(2) }} -->
                    <button @click.prevent="removeFromCart(item)">
                        elimina dal carrello
                    </button>
                </div>
                <hr>
            </div>
            <div>
                Totale: {{ totalPrice }}
                <div>
                    <router-link :to="{ name: 'payment', params: { cart: this.$store.state.cart } }"><button>Prosegui con l'ordine</button></router-link>
                </div>
            </div>
        </div>
        <div v-else>
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
        }, 
        IncrementButton(item) {
            this.$store.commit('IncrementButton', item);
        },
        DecrementButton(item) {
            this.$store.commit('DecrementButton', item);
        }
    }
}
</script>

<style scoped lang="scss">
@import './../../sass/front.scss';

.card {
    padding: 2rem;
}

</style>