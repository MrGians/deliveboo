<template>
    <div class="content">
        <BaseHeader></BaseHeader>

        <main class="container">
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
import BaseHeader from './BaseHeader.vue';
export default {
    name: "App",
    components: { BaseHeader }
};
</script>
