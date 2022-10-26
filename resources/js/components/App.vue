<template>
    <div class="content">
        

        
        <BaseHeader></BaseHeader>
        
        <main class="container">
            <router-view></router-view>
        </main>

        <BaseFooter></BaseFooter>
    </div>
</template>

<script>
import BaseHeader from './BaseHeader.vue';
import BaseFooter from './BaseFooter.vue';


export default {
    name: "App",
    components: { BaseHeader, BaseFooter }
};
</script>

<style lang="scss">
@import '/../../sass/front.scss';

.content {
    background-image: url('/img/jumbotron.png');
    background-repeat: no-repeat;
    background-position: top;
    background-size: contain;
}


</style>
