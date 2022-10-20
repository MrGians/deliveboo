<template>
    <header id="navbar" class="d-flex align-items-center justify-content-around">
        <div id="logo">
            <h1 class="font-weight-bold">Deliveboo</h1>
        </div>

        <div id="button">
            <a href="/admin">Accedi</a>
        </div>
    </header>
</template>

<script>
export default {
    name: 'BaseHeader',
}
</script>

<style scoped>
h1 {
    color: #fc5958;
}

a {
    text-decoration-style: none;
    color: black;

}

#navbar {
    height: 90px;
}

</style>