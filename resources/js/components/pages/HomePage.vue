<template>
    <div id="home-page">
        <header>
            <div id="background-food">
                <BaseHeader></BaseHeader>
                <div id="searchbar-container" class="container padding d-flex align-items-center justify-content-center">
                    <BaseSearchBar :placeholder="placeholder"></BaseSearchBar>
                </div>
            </div>
        </header>

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
import BaseHeader from '../BaseHeader.vue';
import BaseSearchBar from '../BaseSearchBar.vue';
import BaseCard from '../BaseCard.vue';
import RestaurantDetailPage from './RestaurantDetailPage.vue';
export default {
    name: "App",
    components: {
       BaseSearchBar,
       BaseCard,
       BaseHeader,
       RestaurantDetailPage
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

header {
    background-image: url('/img/jumbotron.png');
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    margin-bottom: 50px;
}

#background-food {
    
    
    background-image: url('/img/burger_sandwich_PNG4135.png');
    background-repeat: no-repeat;
    background-position: right;
    background-size: 55%;
}


</style>
