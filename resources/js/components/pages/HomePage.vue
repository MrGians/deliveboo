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
import BaseSearchBar from "../BaseSearchBar.vue";
import BaseCard from "../BaseCard.vue";
export default {
    name: "App",
    components: {
        BaseSearchBar,
        BaseCard,
    },
    data() {
        return {
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
