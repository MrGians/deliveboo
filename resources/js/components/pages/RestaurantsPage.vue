<template>
    <div id="restaurants-page" class="container">
        <div class="row">
            <div class="col-12">
                <div class="search-box">
                    <BaseSearchBar
                        placeholder="Cerca una categoria di ristorante"
                        :list-item="categories"
                        @get-input-value="setCategory"
                    />
                    <div class="search-btn" @click="fetchRestaurants">
                        Cerca
                    </div>
                </div>
            </div>
            <div class="col-4">
                <BaseLabel
                    v-for="category in categories"
                    :key="category.id"
                    :label="category.label"
                    :number="category.quantity"
                    :active="category.selected"
                />
            </div>
            <div class="col-8">
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
            selectedCategory: null,
        };
    },
    methods: {
        fetchRestaurants() {
            console.log("sono il send category");
            let selectedCategory = this.$route.params.filter;

            axios
                .get(
                    `http://127.0.0.1:8000/api/restaurants?search=${
                        this.selectedCategory || selectedCategory
                    }`
                )
                .then((res) => {
                    this.restaurants = res.data;
                })
                .catch(() => {
                    // todo
                })
                .then(() => {
                    // todo
                    console.log("post finish");
                });
        },
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
        this.fetchRestaurants();
        this.fetchCategories();
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
            .search-box {
                position: relative;
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                margin-bottom: 2rem;
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
        .col-4 {
            flex: 0 0 33.33333333%;
            max-width: 33.33333333%;
        }

        .col-8 {
            flex: 0 0 66.66666667%;
            max-width: 66.66666667%;

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
</style>
