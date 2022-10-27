<template>
    <div id="restaurants-page" class="container">
        <div class="row">
            <!-- Search Restaurants by Categories Filter -->
            <div class="col-12">
                <BaseSearchBar
                    :list-item="categories"
                    @selected-list="setCategories"
                />
            </div>
            <div class="col-12 restaurants-box">
                <BaseCard
                    v-for="restaurant in restaurants"
                    :key="restaurant.p_iva"
                >
                    <h4 class="restaurant-name">{{ restaurant.name }}</h4>
                    <div class="restaurant-category">
                        <span
                            v-for="category in restaurant.categories"
                            :key="category.id"
                            >{{ category.label }}
                        </span>
                    </div>
                    <ul>
                        <li>
                            <i class="fa-solid fa-location-dot"></i>
                            <span>{{ restaurant.address }}</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-star"></i>
                            <span
                                ><strong> 5.00</strong> | Recensioni:
                                943534</span
                            >
                        </li>
                        <li>
                            <i class="fa-solid fa-money-check-dollar"></i>
                            <span><strong>Consegna Gratis</strong></span>
                        </li>
                    </ul>
                </BaseCard>
            </div>
        </div>
    </div>
</template>

<script>
import BaseLabel from "../BaseLabel.vue";
import BaseSearchBar from "../BaseSearchBar.vue";
import BaseCard from "../BaseCard.vue";
export default {
    name: "RestaurantsPage",
    components: { BaseLabel, BaseCard, BaseSearchBar },
    data() {
        return {
            categories: [],
            restaurants: [],
            selectedCategories: [],
            isFirstSearch: true,
        };
    },
    methods: {
        fetchRestaurants() {
            const routeParam = this.$route.params.filter;

            if (this.isFirstSearch && !routeParam) {
                this.selectedCategories = [0];
                this.isFirstSearch = false;
            }
            if (this.isFirstSearch && routeParam) {
                if (routeParam.length == 0) {
                    this.selectedCategories = [0];
                }
                this.selectedCategories = routeParam;
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
                    // todo
                })
                .then(() => {
                    // todo
                });
        },
        fetchCategories() {
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
                    // todo
                })
                .then(() => {
                    // todo
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
        console.log("before mount");
        console.log(this.selectedCategories);
    },
    mounted() {
        console.log("mount");
        console.log(this.selectedCategories);
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

            &.restaurants-box {
                display: flex;
                justify-content: space-between;
                flex-wrap: wrap;

                & > * {
                    width: 30%;
                }

                .restaurant-category {
                    font-size: 0.7rem;
                    font-weight: bold;
                }
            }
        }
    }
}
</style>
