<template>
    <div id="home-page">
        <div class="search-box">
            <img src="/img/burger_sandwich_PNG4135.png" alt="" />
            <BaseSearchBar
                class="text-center"
                :placeholder="placeholder"
                :list-item="categories"
                @get-input-value="setCategory"
            />

            <router-link
                class="search-btn"
                :to="{
                    name: 'restaurants',
                    params: { filter: selectedCategory },
                }"
                >Cerca</router-link
            >
        </div>

        <!-- TODO FOOTER -->
    </div>
</template>

<script>
import BaseHeader from "../BaseHeader.vue";
import BaseSearchBar from "../BaseSearchBar.vue";
import BaseCard from "../BaseCard.vue";
import RestaurantDetailPage from './RestaurantDetailPage.vue';
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
            selectedCategory: null,
        };
    },
    methods: {
        fetchCategories() {
            axios
                .get("http://127.0.0.1:8000/api/home")
                .then((res) => {
                    this.categories = res.data;
                })
                .catch(() => {
                    // todo
                })
                .then(() => {
                    // todo
                });
        },
        setCategory(value) {
            this.selectedCategory = value;
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
            bottom: -250%;
            left: 0;
            width: 40%;
            height: auto;
        }
        .search-btn {
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
}

#background-food {
    background-image: url("/img/burger_sandwich_PNG4135.png");
    background-repeat: no-repeat;
    background-position: center right;
    background-size: 45%;
    margin-bottom: 100px;
}

#home-page-content {
    min-height: 800px;
}

@media (min-width: 576px) {
    .container {
        max-width: 540px;
    }
}

@media (min-width: 768px) {
    .container {
        max-width: 720px;
    }
}

@media (min-width: 992px) {
    .container {
        max-width: 960px;
    }
}

@media (min-width: 1200px) {
    .container {
        max-width: 1140px;
    }
}
</style>
