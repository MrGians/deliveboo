<template>
    <div class="col-3">
        <div id="image" class="d-flex align-items-center justify-content-center">
            <img src="/img/burger_sandwich_PNG4135.png" alt="card" class="img-fluid">
        </div>
    </div>
</template>


<script>
export default {
    name: 'BaseCard'
}

</script>

<style scoped>

#image {
    background-color: #FFBD42;
    padding: 20px 40px;
    border-radius: 20px;
}
.col-3 {
    flex: 0 0 25%;
    max-width: 25%;
    padding: 10px;
}

.img-fluid {
    max-width: 100%;
    height: auto;
}

</style>