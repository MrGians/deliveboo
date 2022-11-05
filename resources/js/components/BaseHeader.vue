<template>
    <header :class="headerHeigth">
        <div id="navbar" class="container">
            <router-link :to="{ name: 'home' }">
                <h1 id="logo">Deliveboo</h1>
            </router-link>

            <a id="access" href="/admin">Accedi</a>
        </div>
    </header>
</template>

<script>
export default {
    name: "BaseHeader",
    props: {
        routeName: String,
    },
    computed: {
        headerHeigth() {
            return this.routeName == "home" ? "long-header" : "short-header";
        },
    },
};
</script>

<style scoped lang="scss">
@import "./../../sass/front.scss";

header {
    background-image: url("/img/jumbotron.png");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: bottom center;

    &.long-header {
        min-height: 350px;
    }
    &.short-header {
        min-height: 250px;
    }
}
#navbar {
    min-height: 100px;
    display: flex;
    justify-content: space-between;
    align-items: center;

    #logo {
        font-size: 2.5rem;
        color: $tertiary;
    }

    #access {
        display: inline-block;
        padding: 0.6rem 1.2rem;
        border: 2px solid $tertiary;
        background-color: $tertiary;
        color: white;
        border-radius: 30px;
        margin-left: 1rem;
        transition: all 0.35s;

        &:hover {
            background-color: white;
            color: $tertiary;
        }
    }
}
</style>
