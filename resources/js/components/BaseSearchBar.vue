<template>
    <div id="base-input">
        <div class="multiselect">
            <div class="select-box" @click="showCheckboxes">
                <span>Seleziona una Categoria</span>
            </div>
            <div id="checkboxes" :class="{ 'd-flex': expanded }">
                <div class="item" v-for="item in listItem" :key="item.id">
                    <label
                        :for="item.label"
                        :class="{ selected: item.selected }"
                    >
                        {{ item.label }}</label
                    >
                    <input
                        type="checkbox"
                        :id="item.label"
                        @click="click(item)"
                        hidden
                    />
                </div>
            </div>
        </div>
        <router-link
            v-if="$route.name == 'home' && list.length > 0"
            class="search-btn"
            :to="{
                name: 'restaurants',
                params: { filter: list },
            }"
            >Cerca</router-link
        >
        <button
            v-if="$route.name !== 'home'"
            class="search-btn"
            @click="sendList"
        >
            Cerca
        </button>
    </div>
</template>

<script>
export default {
    name: "BaseSearchBar",
    data() {
        return {
            expanded: false,
            list: [],
        };
    },
    props: {
        listItem: Array,
    },
    methods: {
        click(item) {
            // Push item in list if was never pushed before
            if (!this.list.includes(item.id)) {
                this.list.push(item.id);
                item.selected = true;
            }
            // Check & Remove item from the list if was pushed before
            else {
                for (let i = 0; i <= this.list.length - 1; i++) {
                    if (this.list[i] == item.id) {
                        this.list.splice(i, 1);
                        item.selected = false;
                    }
                }
            }
        },
        sendList() {
            this.$emit("selected-list", this.list);
        },
        showCheckboxes() {
            this.expanded = !this.expanded;
        },
    },
};
</script>

<style scoped lang="scss">
@import "./../../sass/front.scss";

#base-input {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.multiselect {
    width: 100%;

    .select-box {
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        font-size: 1.3rem;
        color: white;
        background-color: $tertiary;
        border: 2px solid black;
    }

    #checkboxes {
        display: none;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        border: 2px solid black;
        border-top: none;

        &.d-flex {
            display: flex;
        }
        & .item {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 25%;
            height: 40px;
            border: 1px solid black;

            & label {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
                height: 100%;
                color: white;
                background-color: $secondary;
            }
            & label.selected {
                background-color: $quaternary;
            }
        }
    }
}
.search-btn {
    align-self: baseline;
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
</style>
