<template>
    <div id="label" class="rounded-5" :class="{ selected: active }">
        <span>{{ label }}</span>
        <span>{{ number }}</span>
    </div>
</template>

<script>
export default {
    name: "BaseLabel",
    props: {
        label: String,
        number: String,
        active: Boolean,
    },
};
</script>

<style scoped lang="scss">
#label {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 1rem;
    border: 2px solid #4cc286;
    margin: 0.5rem 0;

    &.selected {
        border: 2px solid #fd5958;
    }
}
</style>
