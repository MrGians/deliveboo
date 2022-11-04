<template>
    <div class="card rounded-5 mb-3 pb-5 shadow">
        <div class="text-center">
            <h1 class="mb-5 text-tertiary">
                Carrello
            </h1>
        </div>
        <div v-if="$store.state.cart.length > 0">
            <div v-for="item in $store.state.cart" :key="item.id" id="cart-product" class="text-center">
                <div class="mb-3">
                    <strong>{{ item.name }}</strong>
                </div>
                <div class="mb-3">
                    <button @click="DecrementButton(item)" class="button button-increment">
                        -
                    </button>
                    <strong>{{ item.quantity }}</strong>
                    <button @click="IncrementButton(item)" class="button button-increment">
                        +
                    </button>
                </div>
                <div class="mb-3">
                    <!-- {{ item.totalPrice.toFixed(2) }} -->
                    <button @click.prevent="removeFromCart(item)" class="button button-remove">
                        Elimina
                    </button>
                </div>
            </div>
            <div class="text-center total-box">
                <div class="mb-3">
                    <strong>Totale:</strong>  
                    <span>{{ totalPrice }}</span>
                </div>
                <div>
                    <router-link :to="{ name: 'payment', params: { cart: this.$store.state.cart } }"><button class="button button-order">Prosegui con l'ordine</button></router-link>
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

#cart-product {
    border-bottom: 2px solid $secondary;
    padding: 1.5rem 0;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    & > * {
        margin-left: 0.5rem;
        margin-right: 0.5rem;
    }
}
.card {
    
    padding: 2rem;
}

.mb-3 {
    margin-bottom: 0.5rem;
}

.mb-5 {
    margin-bottom: 1.5rem;
}

.text-tertiary {
    color: $tertiary;
    font-size: 1.8rem;
}

.total-box {
    margin-top: 1.5rem;
}

.button {
    display: inline-block;
    padding: 0.4rem 0.6rem;
    border: 2px solid $tertiary;
    background-color: $tertiary;
    color: white;
    border-radius: 30px;
    transition: all 0.35s;
    cursor: pointer;

    &:hover {
        background-color: white;
        color: $tertiary;
    }
}

.button-remove {
    border: 2px solid $tertiary;
    background-color: $tertiary;
    &:hover {
        background-color: white;
        color: $tertiary;
    }
}

.button-increment{
    border: 2px solid $secondary;
    background-color: $secondary;
    border-radius: 5px;
    padding: 0.1rem 0.3rem;
    &:hover {
        background-color: white;
        color: $secondary;
    }
}

.button-order {
    border: 2px solid $quaternary;
    background-color: $quaternary;
    &:hover {
        background-color: white;
        color: $quaternary;
    }
}

@media (max-width: 992px) {
    #cart-product {
        flex-direction: row;
    }
}

</style>