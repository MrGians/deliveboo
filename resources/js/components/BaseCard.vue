<template>
    <div class="card">
        <div class="card-image rounded-5">
            <img
                src="/img/burger_sandwich_PNG4135.png"
                alt="placeholder"
                class="img-fluid"
            />
        </div>
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: "BaseCard",
};
</script>

<style scoped lang="scss">
.card {
    margin-bottom: 1.5rem;
    .card-image {
        background-color: #ffbd42;
        padding: 1rem 2rem;
    }

    .img-fluid {
        max-width: 100%;
        height: auto;
    }

    ul {
        list-style-position: inside;
        list-style-type: none;
        margin-top: 1rem;

        & > li {
            font-size: 0.7rem;
            display: flex;
            justify-content: space-between;

            & > i {
                color: #ffbd42;
            }

            & > span {
                width: 85%;
            }
        }
    }

    .restaurant-name {
        color: #fd5958;
    }
}
</style>
