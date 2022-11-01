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
            <form id="payment-form" novalidate>
                <!-- Full Name -->
                <div class="form-group row">
                    <label
                        for="name"
                        class="col-md-8 offset-md-2 col-form-label"
                    >
                        Nome *</label
                    >
                    <div class="col-md-8 offset-md-2">
                        <input
                            id="name"
                            type="text"
                            class="mb-3 shadow form-control rounded-pill"
                            name="name"
                            required
                            autofocus
                        />
                        <span
                            id="name-error-box"
                            class="invalid-feedback"
                            role="alert"
                        >
                            <strong id="name-error-msg"></strong>
                        </span>
                    </div>
                </div>
                <!-- Email -->
                <div class="form-group row">
                    <label
                        for="email"
                        class="col-md-8 offset-md-2 col-form-label"
                    >
                        Indirizo Email *</label
                    >

                    <div class="col-md-8 offset-md-2">
                        <input
                            id="email"
                            type="email"
                            class="mb-3 shadow form-control rounded-pill"
                            name="email"
                            required
                        />
                        <span
                            id="email-error-box"
                            class="invalid-feedback"
                            role="alert"
                        >
                            <strong id="email-error-msg"></strong>
                        </span>
                    </div>
                </div>
                <!-- Address -->
                <div class="form-group row">
                    <label
                        for="address"
                        class="col-md-8 offset-md-2 col-form-label"
                    >
                        Indirizzo Consegna *</label
                    >

                    <div class="col-md-8 offset-md-2">
                        <input
                            id="address"
                            type="text"
                            class="mb-3 shadow form-control rounded-pill"
                            name="address"
                            required
                        />
                        <span
                            id="address-error-box"
                            class="invalid-feedback"
                            role="alert"
                        >
                            <strong id="address-error-msg"></strong>
                        </span>
                    </div>
                </div>
                <!-- Tel -->
                <div class="form-group row">
                    <label for="tel" class="col-md-8 offset-md-2 col-form-label"
                        >Telefono *</label
                    >

                    <div class="col-md-8 offset-md-2">
                        <input
                            id="tel"
                            type="text"
                            class="mb-3 shadow form-control rounded-pill"
                            name="tel"
                            maxlength="9"
                            required
                        />
                        <span
                            id="tel-error-box"
                            class="invalid-feedback"
                            role="alert"
                        >
                            <strong id="tel-error-msg"></strong>
                        </span>
                    </div>
                </div>
                <!-- Card Number -->
                <div class="form-group row">
                    <label
                        for="card-number"
                        class="col-md-8 offset-md-2 col-form-label"
                        >Numero Carta *</label
                    >

                    <div class="col-md-8 offset-md-2">
                        <input
                            id="card-number"
                            type="text"
                            class="mb-3 shadow form-control rounded-pill"
                            name="card-number"
                            required
                        />
                        <span
                            id="card-number-error-box"
                            class="invalid-feedback"
                            role="alert"
                        >
                            <strong id="card-number-error-msg"></strong>
                        </span>
                    </div>
                </div>
                <!-- CVV -->
                <div class="form-group row">
                    <label for="cvv" class="col-md-8 offset-md-2 col-form-label"
                        >CVV *</label
                    >

                    <div class="col-md-8 offset-md-2">
                        <input
                            id="cvv"
                            type="text"
                            class="mb-3 shadow form-control rounded-pill"
                            name="cvv"
                            maxlength="9"
                            required
                        />
                        <span
                            id="cvv-error-box"
                            class="invalid-feedback"
                            role="alert"
                        >
                            <strong id="cvv-error-msg"></strong>
                        </span>
                    </div>
                </div>
                <!-- Expiration Date -->
                <div class="form-group row">
                    <label
                        for="expiration-date"
                        class="col-md-8 offset-md-2 col-form-label"
                        >Data di Scadenza *</label
                    >

                    <div class="col-md-8 offset-md-2">
                        <input
                            id="expiration-date"
                            type="text"
                            class="mb-3 shadow form-control rounded-pill"
                            name="expiration-date"
                            maxlength="9"
                            required
                        />
                        <span
                            id="expiration-date-error-box"
                            class="invalid-feedback"
                            role="alert"
                        >
                            <strong id="expiration-date-error-msg"></strong>
                        </span>
                    </div>
                </div>
                <!-- Register button -->
                <div class="form-group row">
                    <div class="col-md-8 mx-auto text-center">
                        <input type="submit" value="Completa l'ordine" />
                    </div>
                </div>
            </form>
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
            token: null,
            authorization: "sandbox_rz76qbvt_v3t2hg846dk826w5",
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
        clientToken() {
            this.isLoading = true;

            axios
                .get("http://127.0.0.1:8000/api/orders/token")
                .then((res) => {
                    this.token = res.data.token;
                })
                .catch(() => {
                    this.errors = { http: "Si è verificato un errore" };
                })
                .then(() => {
                    this.isLoading = false;
                });

            // this.launchBraintree();
        },
        launchBraintree() {
            const form = document.querySelector("#payment-form");
            const submit = document.querySelector('input[type="submit"]');
            braintree.client.create(
                {
                    authorization: this.authorization,
                },
                (clientErr, clientInstance) => {
                    if (clientErr) {
                        console.log(clientErr);
                        return;
                    }
                    // This example shows Hosted Fields, but you can also use this
                    // client instance to create additional components here, such as
                    // PayPal or Data Collector.
                    braintree.hostedFields.create(
                        {
                            client: clientInstance,
                            id: "payment-form",
                            fields: {
                                number: {
                                    container: "#card-number",
                                    placeholder: "4111 1111 1111 1111",
                                },
                                cvv: {
                                    container: "#cvv",
                                    placeholder: "123",
                                },
                                expirationDate: {
                                    container: "#expiration-date",
                                    placeholder: "09/2023",
                                },
                            },
                        },
                        (hostedFieldsErr, hostedFieldsInstance) => {
                            if (hostedFieldsErr) {
                                console.log(hostedFieldsErr);
                                return;
                            }
                            // submit.removeAttribute('disabled');
                            form.addEventListener(
                                "submit",
                                (event) => {
                                    event.preventDefault();
                                    hostedFieldsInstance.tokenize(
                                        (tokenizeErr, payload) => {
                                            if (tokenizeErr) {
                                                console.log(tokenizeErr);
                                                return;
                                            }
                                            // If this was a real integration, this is where you would
                                            // send the nonce to your server.
                                            console.log(
                                                "Got a nonce: " + payload.nonce
                                            );
                                            document.querySelector(
                                                "#nonce"
                                            ).value = payload.nonce;
                                            form.submit();
                                        }
                                    );
                                },
                                false
                            );
                        }
                    );
                }
            );
        },
        makePayment() {
            this.isLoading = true;

            axios
                .post("http://127.0.0.1:8000/api/orders/payment")
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
    mounted() {
        this.clientToken();
        this.launchBraintree();
    },
};
</script>

<style scoped lang="scss">
@import "./../../../sass/front.scss";

.payment-form-btn {
    display: inline-block;
    padding: 0.6rem 1.2rem;
    border: 2px solid $quaternary;
    background-color: $quaternary;
    color: white;
    border-radius: 30px;
    margin-left: 1rem;
    transition: all 0.35s;
    cursor: pointer;

    &:hover {
        transform: scale(1.05);
    }

    &:disabled {
        cursor: not-allowed;
    }
}
</style>
