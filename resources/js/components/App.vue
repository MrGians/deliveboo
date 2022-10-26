<template>
    <div class="content">
        <!-- Main Header -->
        <BaseHeader :routeName="$route.name" />
        <!-- Main page content with vue routes -->
        <main class="container">
            <router-view></router-view>
        </main>
        <!-- Main Footer -->
        <BaseFooter></BaseFooter>
    </div>
</template>

<script>
import BaseHeader from "./BaseHeader.vue";
import BaseFooter from "./BaseFooter.vue";
import BaseSearchBar from "./BaseSearchBar.vue";

export default {
    name: "App",
    components: { BaseHeader, BaseFooter, BaseSearchBar },
};
</script>

<style lang="scss">
@import "/../../sass/front.scss";
</style>
