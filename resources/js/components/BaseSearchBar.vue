<template>
    <div>
        <input type="text" class="d-flex align-items-center justify-content-center" id="searchbar" :placeholder="placeholder">
    </div>

</template>

<script>
export default {
    name: 'BaseSearchBar',
    props: {
        placeholder: String,
    }
}
</script>

<style scoped>
#searchbar {

    display: inline-block;
    width: 450px;
    height: 70px;
    border: 3px solid transparent;
    padding: 12px 20px;
    border-radius: 50px;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    font-size: 20px;
    
}

#searchbar:focus {
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(252, 89, 88, 1);
}

#searchbar::placeholder {
    text-align: center;
    color: #2EB872;
}



</style>