<template>
    <div class="loader">
        <div class="spinner-border text-info" role="status">
            <span class="sr-only">Caricamento...</span>
        </div>
    </div>
</template>

<script>
export default {
    name: "BaseLoader",
};
</script>

<style scoped lang="scss">
@import "./../../sass/front.scss";

.loader {
    background-color: rgba($color: $primary, $alpha: 0.5);
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    & > .spinner-border {
        display: inline-block;
        height: 100px;
        width: 100px;
        vertical-align: text-bottom;
        border: 0.25em solid $secondary;
        border-right-color: transparent;
        border-radius: 50%;
        animation: spinner-border 0.75s linear infinite;

        @keyframes spinner-border {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        & .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }
    }
}
</style>
