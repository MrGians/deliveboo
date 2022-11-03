<template>
    <div id="payment-page" class="row">
        <!-- Page Loader -->
        <BaseLoader v-if="isLoading" />
        <!-- Shows the errors recovered -->
        <h2 v-else-if="hasErrors" class="text-center">{{ errors.http }}</h2>
        <!-- Form to make Order -->
        <div v-show="!isLoading && !hasErrors" class="col-10">
            <div class="order-form card rounded-5 shadow">
                <div class="text-center">
                    <h3>Completa il tuo ordine</h3>
                </div>
                <!-- TODO form here -->
                <div class="card-body">
                    <form
                        @submit.prevent="sendForm"
                        id="payment-form"
                        class="col-10"
                        novalidate
                    >
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
                        <!-- Card -->
                        <div id="dropin-wrapper">
                            <div id="checkout-message"></div>
                            <div id="dropin-container"></div>
                            <button id="submit-button">Check Card</button>
                        </div>
                        <button type="submit">submit</button>
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
                paymentMethodNonce: "",
                cartOrder: this.$route.params.cart,
            },
            isValid: false,
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
        sendForm() {
            this.launchBraintree();

            this.formValidation();

            if (this.isValid) {
                this.makePayment();
            }
        },
        launchBraintree() {
            const form = document.getElementById("payment-form");
            const button = document.querySelector("#submit-button");

            let paymentMethodNonce = "";

            braintree.dropin.create(
                {
                    // Insert your tokenization key here
                    authorization: this.authorization,
                    container: "#dropin-container",
                },
                (createErr, instance) => {
                    form.addEventListener("submit", () => {
                        instance.requestPaymentMethod(
                            (requestPaymentMethodErr, payload) => {
                                if (requestPaymentMethodErr) {
                                    console.log(requestPaymentMethodErr);
                                }
                                // Custom payment validation
                                paymentMethodNonce = "";
                                if (payload) {
                                    paymentMethodNonce = payload.nonce;
                                    this.form.paymentMethodNonce =
                                        paymentMethodNonce;
                                }
                            }
                        );
                    });
                }
            );
        },
        formValidation() {
            // | 'name' field & box errors
            const nameInput = document.getElementById("name");
            const nameErrorMsg = document.getElementById("name-error-msg");

            // | 'email' field & box errors
            const emailInput = document.getElementById("email");
            const emailErrorMsg = document.getElementById("email-error-msg");

            // | 'address' field & box errors
            const addressInput = document.getElementById("address");
            const addressErrorMsg =
                document.getElementById("address-error-msg");

            // | 'tel' field & box errors
            const telInput = document.getElementById("tel");
            const telErrorMsg = document.getElementById("tel-error-msg");

            let isValid = true;
            // Validate Name
            nameInput.className = "shadow form-control rounded-5";
            nameErrorMsg.innerText = "";
            if (!this.form.name) {
                nameInput.classList.add("is-invalid");
                nameErrorMsg.innerText = "Il nome è obbligatorio";
                isValid = false;
            } else if (this.form.name.length > 100) {
                nameInput.classList.add("is-invalid");
                nameErrorMsg.innerText =
                    "Il nome può contenere massimo 100 caratteri";
                isValid = false;
            }
            // Validate Email
            emailInput.className = "shadow form-control rounded-5";
            emailErrorMsg.innerText = "";
            if (!this.form.email) {
                emailInput.classList.add("is-invalid");
                emailErrorMsg.innerText = "l'email è obbligatoria";
                isValid = false;
            } else if (
                this.form.email &&
                !this.form.email.match(
                    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                )
            ) {
                emailInput.classList.add("is-invalid");
                emailErrorMsg.innerText =
                    "l'email deve essere in un formato valido (example@gmail.com)";
                isValid = false;
            }
            // Validate Address
            addressInput.className = "shadow form-control rounded-5";
            addressErrorMsg.innerText = "";
            if (!this.form.address) {
                addressInput.classList.add("is-invalid");
                addressErrorMsg.innerText =
                    "L'indirizzo di consegna è obbligatorio";
                isValid = false;
            }
            // Validate Tel
            telInput.className = "shadow form-control rounded-5";
            telErrorMsg.innerText = "";
            if (!this.form.tel) {
                telInput.classList.add("is-invalid");
                telErrorMsg.innerText = "Il numero di Telefono è obbligatorio";
                isValid = false;
            } else if (this.form.tel && this.form.tel.length !== 9) {
                telInput.classList.add("is-invalid");
                telErrorMsg.innerText =
                    "Il numero di Telefono deve essere di 9 cifre";
                isValid = false;
            }
            // Validate Payment Method
            if (!this.form.paymentMethodNonce.length) {
                isValid = false;
            }

            return (this.isValid = isValid);
        },
        makePayment() {
            this.isLoading = true;

            axios
                .post("http://127.0.0.1:8000/api/orders/payment", this.form)
                .then((res) => {
                    console.log(res.data);
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

            &.is-invalid {
                border-color: #dc3545;
            }
        }
        & .invalid-feedback {
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #dc3545;
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
