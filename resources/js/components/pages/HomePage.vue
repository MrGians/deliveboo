<template>
    <div id="home-page">
        <div id="searchbar-container" class="container padding d-flex align-items-center justify-content-center">
            <BaseSearchBar :placeholder="placeholder"></BaseSearchBar>
        </div>

        <div id="home-page-content">
            <div id="title" class="text-center">
                <h1>Le cucine più amate</h1>
            </div>

            <div id="filters-cards">
                <BaseCard></BaseCard>
            </div>
        </div>
    </div>
</template>

<script>
import BaseSearchBar from '../BaseSearchBar.vue';
import BaseCard from '../BaseCard.vue';
export default {
    name: "App",
    components: {
       BaseSearchBar,
       BaseCard
    },
    data() {
        return {
            placeholder: 'Voglia di qualcosa di buono?',
        };
    },
};
</script>

<style scoped>

#title {
    color: #fc5958;
}

</style>
