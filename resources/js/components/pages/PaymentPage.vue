<template>
    <div id="payment-page" class="row">
        <!-- Page Loader -->
        <BaseLoader v-if="isLoading" />
        <!-- Shows the errors recovered -->
        <h2 v-else-if="hasErrors" class="text-center">{{ errors.http }}</h2>
        <!-- Form to make Order -->
        <div class="col-10">
            <div class="order-form card rounded-5 shadow">
                <div class="text-center">
                    <h3>Completa il tuo ordine</h3>
                </div>
                <!-- TODO form here -->
                <div class="card-body">
                    <form id="payment-form" class="col-10" novalidate>
                        <!-- Full Name -->
                        <div class="form-group">
                            <label for="name" class="col-form-label">
                                Nome *</label
                            >
                            <div>
                                <input
                                    v-model.trim="form.name"
                                    id="name"
                                    type="text"
                                    class="shadow form-control rounded-5"
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
                        <div class="form-group">
                            <label for="email" class="col-form-label">
                                Indirizo Email *</label
                            >

                            <div>
                                <input
                                    v-model.trim="form.email"
                                    id="email"
                                    type="email"
                                    class="shadow form-control rounded-5"
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
                        <div class="form-group">
                            <label for="address" class="col-form-label">
                                Indirizzo Consegna *</label
                            >

                            <div>
                                <input
                                    v-model.trim="form.address"
                                    id="address"
                                    type="text"
                                    class="shadow form-control rounded-5"
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
                        <div class="form-group">
                            <label for="tel" class="col-form-label"
                                >Telefono *</label
                            >

                            <div>
                                <input
                                    v-model.trim="form.tel"
                                    id="tel"
                                    type="text"
                                    class="shadow form-control rounded-5"
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
                        <div class="form-group">
                            <label for="card-number" class="col-form-label"
                                >Numero Carta *</label
                            >

                            <div>
                                <div
                                    id="card-number"
                                    class="shadow form-control rounded-5"
                                ></div>
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
                        <div class="form-group">
                            <label for="cvv" class="col-form-label"
                                >CVV *</label
                            >

                            <div>
                                <div
                                    id="cvv"
                                    class="shadow form-control rounded-5"
                                ></div>
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
                        <div class="form-group">
                            <label for="expiration-date" class="col-form-label"
                                >Data di Scadenza *</label
                            >

                            <div>
                                <div
                                    id="expiration-date"
                                    class="shadow form-control rounded-5"
                                ></div>
                                <span
                                    id="expiration-date-error-box"
                                    class="invalid-feedback"
                                    role="alert"
                                >
                                    <strong
                                        id="expiration-date-error-msg"
                                    ></strong>
                                </span>
                            </div>
                        </div>
                        <!-- submit button -->
                        <div class="form-group">
                            <div class="text-center">
                                <input
                                    class="payment-form-btn"
                                    id="payment-button"
                                    type="submit"
                                    value="Pay"
                                    disabled
                                />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
            form: {
                name: "",
                email: "",
                address: "",
                tel: "",
            },
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
                    // Insert your tokenization key here
                    authorization: this.authorization,
                },
                function (clientErr, clientInstance) {
                    if (clientErr) {
                        console.error(clientErr);
                        return;
                    }

                    // Create a hostedFields component to initialize the form

                    braintree.hostedFields.create(
                        {
                            client: clientInstance,
                            // Customize the Hosted Fields.
                            // More information can be found at:
                            // https://developers.braintreepayments.com/guides/hosted-fields/styling/javascript/v3
                            styles: {
                                input: {
                                    "font-size": "14px",
                                },
                                "input.invalid": {
                                    color: "red",
                                },
                                "input.valid": {
                                    color: "green",
                                },
                            },
                            // Configure which fields in your card form will be generated by Hosted Fields instead
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
                                    placeholder: "10/2022",
                                },
                            },
                        },
                        function (hostedFieldsErr, instance) {
                            if (hostedFieldsErr) {
                                console.error(hostedFieldsErr);
                                return;
                            }

                            // Once the fields are initialized enable the submit button
                            submit.removeAttribute("disabled");

                            // Initialize the form submit event
                            form.addEventListener(
                                "submit",
                                function (event) {
                                    event.preventDefault();
                                    // When the user clicks on the 'Submit payment' button this code will send the
                                    // encrypted payment information in a variable called a payment method nonce
                                    instance.tokenize(function (
                                        tokenizeErr,
                                        payload
                                    ) {
                                        if (tokenizeErr) {
                                            console.error(tokenizeErr);
                                            return;
                                        }

                                        axios.post(
                                            "http://127.0.0.1:8000/api/orders/payment",
                                            {
                                                form: this.form,
                                                paymentMethodNonce:
                                                    payload.nonce,
                                            }
                                        );
                                    });
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

#payment-page {
    justify-content: center;

    h3 {
        padding: 2rem 0;
    }

    .col-10 {
        flex: 0 0 83.33333333%;
        max-width: 83.33333333%;
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
        padding-bottom: 3rem;
        margin-top: 3rem;

        & .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1.25rem;
        }
    }
}
#payment-form {
    padding: 0 1rem;
    margin: 0 auto;
    .form-group {
        margin-bottom: 1rem;

        .col-form-label {
            padding-top: calc(0.375rem + 1px);
            padding-bottom: calc(0.375rem + 1px);
            margin-bottom: 0;
            font-size: inherit;
            line-height: 1.5;
        }

        .form-control {
            height: 40px;
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid $primary;
            -webkit-transition: 0.5s;
            transition: 0.5s;
            outline: none;
        }
    }
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
}
</style>
