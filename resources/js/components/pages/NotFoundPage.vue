<template>
    <div id="not-found-page">
        <div class="not-found-card shadow text-center my-5">
            <h2>Ops, pagina non trovata</h2>
            <p>Sembra che la pagina che cercavi non esista. Torna alla home per continuare a navigare.</p>
            <router-link :to="{ name: 'home' }">
                <button class="home-btn">Home</button>
            </router-link>
        </div>
    </div>
</template>

<script>
import BaseHeader from '../BaseHeader.vue';

export default {
    name: "App",
    components: {
        BaseHeader
    },
};
</script>

<style scoped lang="scss">
@import "./../../../sass/front.scss";



#not-found-page {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 5rem auto;

    .not-found-card {
        width: 50%;
        background-color: $body-bg;
        padding: 1.5rem;
        border-radius: 1.5rem;

        h2 {
            color: $tertiary;
        }

        p {
            margin: 2rem;
        }
    }

    /* Medium devices (tablets, 768px and up) */
    @media (max-width: 768px) {
        .not-found-card {
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
        margin-left: 1rem;
        transition: all 0.35s;

        &:hover {
            background-color: $tertiary;
            color: $body-bg;
            border: 2px solid $tertiary;
        }
    }
}
</style>
