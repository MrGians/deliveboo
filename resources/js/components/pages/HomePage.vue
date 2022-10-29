<template>
    <div id="home-page">
        <!-- Page Loader -->
        <BaseLoader v-if="isLoading" />
        <!-- Category restaurants filter for search -->
        <div v-else class="search-box">
            <img src="/img/burger_sandwich_PNG4135.png" alt="" />
            <BaseSearchBar class="text-center" :list-item="categories" />
        </div>
        <!-- Shows the errors recovered -->
        <h2 v-if="hasErrors" class="text-center">{{ errors.http }}</h2>
    </div>
</template>

<script>
import BaseSearchBar from "../BaseSearchBar.vue";
import BaseCard from "../BaseCard.vue";
import BaseLoader from "../BaseLoader.vue";
export default {
    name: "App",
    components: {
        BaseSearchBar,
        BaseCard,
        BaseLoader,
    },
    data() {
        return {
            categories: [],
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
        fetchCategories() {
            this.isLoading = true;

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
                    this.errors = { http: "Si è verificato un errore" };
                })
                .then(() => {
                    this.isLoading = false;
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

#home-page {
    .search-box {
        position: relative;
        width: 80%;
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;

        img {
            position: absolute;
            top: -50px;
            left: -50px;
            width: 40%;
            height: auto;
        }
        @media (min-width: 576px) {
            img {
                top: -80px;
                left: -80px;
            }
        }
        @media (min-width: 768px) {
            img {
                top: -100px;
                left: -100px;
            }
        }
        @media (min-width: 992px) {
            img {
                top: -150px;
                left: -150px;
            }
        }
    }
}
</style>
