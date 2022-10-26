<template>
    <div id="restaurants-page" class="container">
        <div class="row">
            <div class="col-4">
                <BaseLabel
                    v-for="category in categories"
                    :key="category"
                    :label="category.label"
                    :number="category.quantity"
                    :active="category.selected"
                />
            </div>
            <div class="col-8">
                <BaseCard v-for="n in 10" :key="n">
                    <h4 class="restaurant-name">Nome Ristorante</h4>
                    <h6 class="restaurant-category">
                        Categoria 1 - Categoria 2
                    </h6>
                    <ul>
                        <li>
                            <i class="fa-solid fa-location-dot"></i>
                            <span>Via Inventata n.6, Portogallo, 43532</span>
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
import BaseCard from "../BaseCard.vue";
export default {
    name: "RestaurantsPage",
    components: { BaseLabel, BaseCard },
    data() {
        return {
            categories: [
                {
                    label: "pizzeria",
                    quantity: "24",
                    selected: false,
                },
                {
                    label: "rosticceria",
                    quantity: "34",
                    selected: true,
                },
                {
                    label: "gourmet",
                    quantity: "19",
                    selected: false,
                },
                {
                    label: "latino-americano",
                    quantity: "57",
                    selected: false,
                },
            ],
        };
    },
};
</script>

<style scoped lang="scss">
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
        }
    }
}
</style>
