<template>
    
        <input type="text" class="d-flex align-items-center justify-content-center" id="searchbar" :placeholder="placeholder">
    

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
    width: 50%;
    height: 70px;
    border: 3px solid transparent;
    padding: 12px 20px;
    border-radius: 50px;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    font-size: 1.3rem;
    
}

@media (min-width: 576px) {
    #searchbar {
        height: 40px;
        font-size: 0.6rem;
    }
}

@media (min-width: 768px) {
    #searchbar {
        height: 50px;
        font-size: 0.8rem;
    }
}

@media (min-width: 992px) {
    #searchbar {
        height: 60px;
        font-size: 1rem;
    }
}

@media (min-width: 1200px) {
    #searchbar {
        height: 70px;
        font-size: 1.3rem;
    }
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