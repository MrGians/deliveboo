<template>
    <div id="order-success-page">
        <div class="order-success-card shadow text-center my-5">
            <i class="bi bi-check-circle-fill"></i>
            <h2>Ordine effettuato con successo!</h2>
            <p>
                Controlla la tua casella di posta per vedere il resoconto con
                tutte le informazioni sul tuo ordine!
            </p>
            <router-link :to="{ name: 'home' }">
                <button class="home-btn">Torna alla Homepage</button>
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "OrderSuccessPage",
};
</script>

<style scoped lang="scss">
@import "./../../../sass/front.scss";

#order-success-page {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 5rem auto;

    .order-success-card {
        width: 50%;
        background-color: $body-bg;
        padding: 1.5rem;
        border-radius: 1.5rem;

        .bi-check-circle-fill {
            color: $quaternary;
            font-size: 4rem;
        }
        h2 {
            color: $quaternary;
            margin-top: 1rem;
        }

        p {
            margin: 1rem;
        }
    }

    /* Medium devices (tablets, 768px and up) */
    @media (max-width: 768px) {
        .order-success-card {
            width: 100%;
        }
    }

    .home-btn {
        display: inline-block;
        padding: 0.6rem 1.2rem;
        border: 2px solid $secondary;
        background-color: $secondary;
        color: $body-bg;
        font-weight: 700;
        border-radius: 30px;
        margin-top: 1rem;
        transition: all 0.35s;
        cursor: pointer;

        &:hover {
            background-color: $quaternary;
            color: $body-bg;
            border: 2px solid $quaternary;
        }
    }
}
</style>
