<template>
    <div class="card">
        <div class="card-header rounded-5">
            <img
                :src="'storage/' + item.logo"
                :alt="item.name"
                class="img-fluid"
            />
        </div>
        <div class="card-body">
            <h4 class="title text-center">
                {{ item.name }}
            </h4>
            <div class="categories text-center rounded-5">
                <span v-for="category in item.categories" :key="category.id"
                    >{{ category.label }}
                </span>
            </div>
            <ul class="list">
                <li>
                    <i class="fa-solid fa-location-dot"></i>
                    <span>{{ item.address }}</span>
                </li>
                <li>
                    <i class="fa-solid fa-star"></i>
                    <span>Voto: <strong> 5.00</strong></span>
                </li>
                <li>
                    <i class="fa-solid fa-money-check-dollar"></i>
                    <span><strong>Consegna Gratis</strong></span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: "BaseCard",
    props: {
        item: Object,
    },
};
</script>

<style scoped lang="scss">
@import "./../../sass/front.scss";

.card {
    background-color: $secondary;
    border-radius: 30px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    .card-header {
        overflow: hidden;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .card-body {
        flex-grow: 1;
        padding: 1rem;
        border: 4px solid $secondary;
        border-top: none;
        border-radius: 30px;
        background-color: white;
        & .title {
            padding: 0.5rem;
            color: $tertiary;
        }

        .categories {
            font-weight: bold;
            border: 1px solid $quaternary;
        }
    }

    .list {
        margin-top: 1rem;

        & > li {
            display: flex;

            & > i {
                color: $secondary;
                margin-right: 1rem;
            }
        }
    }
}
</style>
