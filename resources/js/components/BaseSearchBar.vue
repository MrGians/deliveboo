<template>
    <div id="base-input">
        <input
            type="text"
            list="datalist"
            class="shadow rounded-5"
            :placeholder="placeholder"
            v-model="value"
            @keyup="$emit('get-input-value', value)"
        />
        <datalist id="datalist">
            <option v-for="item in listItem" :key="item.id">
                {{ item.label }}
            </option>
        </datalist>
    </div>
</template>

<script>
export default {
    name: "BaseSearchBar",
    data() {
        return {
            value: "",
        };
    },
    props: {
        placeholder: String,
        listItem: Array,
    },
};
</script>

<style scoped>
#base-input {
    width: 50%;
    z-index: 2;
}

input {
    display: inline-block;
    width: 100%;
    min-width: 200px;
    height: 30px;
    border: 3px solid transparent;
    padding: 1rem;
    font-size: 0.5rem;
}

input:focus {
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(252, 89, 88, 1);
}

input::placeholder {
    text-align: center;
    color: #2eb872;
}

@media (min-width: 576px) {
    input {
        height: 40px;
        font-size: 0.6rem;
    }
}

@media (min-width: 768px) {
    input {
        height: 50px;
        font-size: 0.8rem;
    }
}

@media (min-width: 992px) {
    input {
        height: 60px;
        font-size: 1rem;
    }
}

@media (min-width: 1200px) {
    input {
        height: 70px;
        font-size: 1.3rem;
    }
}
</style>
