<template>
    <div id="home-page">
       
        <div id="background-food">
                
            <div id="searchbar-container" class="container padding d-flex align-items-center justify-content-center">
                <BaseSearchBar :placeholder="placeholder" @keyup.enter="fetchCategories()"></BaseSearchBar>
            </div>
        </div>
        


        <div id="home-page-content">
            <div id="title" class="text-center">
                <h1>Le cucine più amate</h1>
            </div>

            <div id="filters-cards" class="container">
                <div class="row">
                    <BaseCard v-for="index in 16" :key="index"></BaseCard>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BaseHeader from '../BaseHeader.vue';
import BaseSearchBar from '../BaseSearchBar.vue';
import BaseCard from '../BaseCard.vue';
export default {
    name: "App",
    components: {
       BaseSearchBar,
       BaseCard,
       BaseHeader
    },
    data() {
        return {
            placeholder: 'Voglia di qualcosa di buono?',
            categories: [],
            selectedCategory: null,
        };
    },
    methods: {
        fetchCategories() {
            axios.get('http://127.0.0.1:8000/api/home')
            .then((res) => {
                this.categories = res.data;
            })
            .catch(() => {
                // todo
            }) 
            .then(() => {
                // todo
            })
        }, 
        sendCategory() {
            this.selectedCategory = 2;
            axios.get('http://127.0.0.1:8000/api/filter-restaurants', this.selectedCategory)
            .then(() => {
                // todo data errors
            })
            .catch(() => {
                // todo
            }) 
            .then(() => {
                // todo
            })
        }
    }, 
    mounted() {
        this.fetchCategories();
    },
};
</script>

<style scoped>

#title {
    color: #fc5958;
    margin-bottom: 100px;
}

#home-page{
    min-height: 200px;
    margin-bottom: 150px;
}



#background-food {
    
    
    background-image: url('/img/burger_sandwich_PNG4135.png');
    background-repeat: no-repeat;
    background-position: center right;
    background-size: 45%;
    margin-bottom: 100px;
}

#home-page-content {
    min-height: 800px;
}

@media (min-width: 576px) {
    .container {
        max-width: 540px;
    }
}

@media (min-width: 768px) {
    .container {
        max-width: 720px;
    }
}

@media (min-width: 992px) {
    .container {
        max-width: 960px;
    }
}

@media (min-width: 1200px) {
    .container {
        max-width: 1140px;
    }
}



</style>
