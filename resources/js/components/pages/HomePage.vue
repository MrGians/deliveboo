<template>
    <div id="home-page">
        <div class="search-box">
            <img src="/img/burger_sandwich_PNG4135.png" alt="" />
            <BaseSearchBar class="text-center" :list-item="categories" />
        </div>

        <!-- TODO FOOTER -->
    </div>
</template>

<script>
import BaseHeader from "../BaseHeader.vue";
import BaseSearchBar from "../BaseSearchBar.vue";
import BaseCard from "../BaseCard.vue";
import RestaurantDetailPage from "./RestaurantDetailPage.vue";
export default {
    name: "App",
    components: {
        BaseSearchBar,
        BaseCard,
        BaseHeader,
        RestaurantDetailPage,
    },
    data() {
        return {
            placeholder: "Voglia di qualcosa di buono?",
            categories: [],
        };
    },
    methods: {
        fetchCategories() {
            axios
                .get("http://127.0.0.1:8000/api/home")
                .then((res) => {
                    const result = res.data;
                    result.forEach((element) => {
                        element.selected = false;
                    });
                    this.categories = result;
                })
                .catch(() => {
                    // todo
                })
                .then(() => {
                    // todo
                });
        },
    },
    mounted() {
        this.fetchCategories();
    },
};
</script>

<style scoped lang="scss">
@import "./../../../sass/front.scss";

#title {
    color: #fc5958;
    margin-bottom: 100px;
}

#home-page {
    min-height: 200px;
    margin-bottom: 150px;

    .search-box {
        position: relative;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;

        img {
            position: absolute;
            bottom: 100%;
            left: 30%;
            width: 25%;
            height: auto;
        }
    }
}
</style>
