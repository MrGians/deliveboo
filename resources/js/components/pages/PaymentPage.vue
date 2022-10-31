<template>
    <div id="payment-page">
        <!-- Page Loader -->
        <BaseLoader v-if="isLoading" />
        <!-- Shows the errors recovered -->
        <h2 v-else-if="hasErrors" class="text-center">{{ errors.http }}</h2>
        <!-- Form to make Order -->
        <div v-else class="order-form">
            <h3>Sono il form dell'ordine</h3>
            <!-- TODO form here -->
        </div>
    </div>
</template>

<script>
import BaseLoader from "../BaseLoader.vue";
export default {
    name: "PaymentPage",
    components: {
        BaseLoader,
    },
    data() {
        return {
            isLoading: false,
            errors: {},
        };
    },
    computed: {
        hasErrors() {
            return Object.keys(this.errors).length;
        },
    },
    methods: {
        makePayment() {
            this.isLoading = true;

            axios
                .get("http://127.0.0.1:8000/api/orders/payment")
                .then((res) => {
                    // code here
                })
                .catch(() => {
                    this.errors = { http: "Si è verificato un errore" };
                })
                .then(() => {
                    this.isLoading = false;
                });
        },
    },
};
</script>

<style scoped lang="scss">
@import "./../../../sass/front.scss";
</style>
