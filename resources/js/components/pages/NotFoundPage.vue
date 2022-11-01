<template>
    <div id="not-found-page">
        <header>
            <div id="card-container" class="not-fpund-card shadow text-center">
                <h3>Ops, pagina non trovata</h3>
                <p>Sembra che la pagina che cercavi non esista. Torna alla home per scegliere fra Fortunatamente,
                    però, abbiamomigliaia di ristoranti pronti a consegnare a casa tua!</p>
                <button type="submit" form="nameform" value="Home" class="home-btn">Home</button>
            </div>
        </header>
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

#title,
h3 {
    color: $tertiary;
    font-size: 2rem;
}

#not-found-page {
    position: relative;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;

    .not-fpund-card {
        width: 40em;
        background-color: $body-bg;
        padding: 3.5em;
        border-radius: 30px;
    }
    
    p {
        margin: 2rem;
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
