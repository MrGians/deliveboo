<template>
    <div id="restaurants-page" class="container">
        <BaseLoader v-if="isLoading" />
        <h2 v-else-if="hasErrors" class="text-center">{{ errors.http }}</h2>
        <div v-else class="row">
            <!-- Search Restaurants by Categories Filter -->
            <div class="col-12">
                <BaseSearchBar
                    :list-item="categories"
                    @selected-list="setCategories"
                />
            </div>
            <!-- Result of the Search | Restaurants List -->
            <div
                v-show="restaurants.length > 0"
                class="col restaurants-box"
                v-for="restaurant in restaurants"
                :key="restaurant.id"
            >
                <BaseCard :item="restaurant" />
            </div>
            <div v-if="restaurants.length == 0" class="col-12">
                <h2 class="text-center">
                    Non sono stati trovati Ristoranti con questi filtri di
                    ricerca.
                </h2>
            </div>
        </div>
    </div>
</template>

<script>
import BaseSearchBar from "../BaseSearchBar.vue";
import BaseLoader from "../BaseLoader.vue";
import BaseCard from "../BaseCard.vue";
export default {
    name: "RestaurantsPage",
    components: { BaseCard, BaseSearchBar, BaseLoader },
    data() {
        return {
            categories: [],
            restaurants: [],
            selectedCategories: [],
            isFirstSearch: true,
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
        fetchRestaurants() {
            this.isLoading = true;

            const routeParam = this.$route.params.filter;

            if (this.isFirstSearch && !routeParam) {
                this.selectedCategories = [0];
                this.isFirstSearch = false;
            }
            if (this.isFirstSearch && routeParam) {
                this.selectedCategories = routeParam;
                if (routeParam.length == 0) {
                    this.selectedCategories = [0];
                }
            }

            axios
                .get(
                    `http://127.0.0.1:8000/api/restaurants?categories=${this.selectedCategories}`
                )
                .then((res) => {
                    this.restaurants = res.data;

                    this.categories.forEach((el, i) => {
                        if (el.selected) this.selectedCategories.push(el.id);
                    });
                })
                .catch(() => {
                    this.errors = { http: "Si è verificato un errore" };
                })
                .then(() => {
                    this.isLoading = false;
                });
        },
        fetchCategories() {
            this.isLoading = true;

            axios
                .get("http://127.0.0.1:8000/api/home")
                .then((res) => {
                    const result = res.data;
                    result.forEach((element, i) => {
                        element.selected = false;

                        if (this.selectedCategories.includes(element.id)) {
                            element.selected = true;
                        }
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
        setCategories(value) {
            if (this.isFirstSearch) {
                const routeParam = this.$route.params.filter;
                routeParam.forEach((param) => {
                    if (!value.includes(param)) value.push(param);
                });
                this.isFirstSearch = false;
            }

            this.selectedCategories = value;
            this.fetchRestaurants();
            this.selectedCategories = [];
        },
    },
    beforeMount() {
        this.fetchCategories();
    },
    mounted() {
        this.fetchRestaurants();
    },
};
</script>

<style scoped lang="scss">
@import "./../../../sass/front.scss";

#restaurants-page {
    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;

        & > * {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
            height: 100%;
        }

        .col {
            flex: 0 0 100%;
            max-width: 100%;

            &.restaurants-box {
                display: flex;
                justify-content: space-between;
                flex-wrap: wrap;

                & > * {
                    margin-bottom: 1rem;
                }
            }
        }

        @media (min-width: 576px) {
            .col {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }
        @media (min-width: 768px) {
            .col {
                flex: 0 0 calc(100% / 3);
                max-width: calc(100% / 3);
            }
        }
    }
}
</style>
