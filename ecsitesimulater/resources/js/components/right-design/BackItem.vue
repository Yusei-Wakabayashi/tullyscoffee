<script setup>
import { ref } from 'vue'
const props = defineProps({
    
});

const itemBackList = ref([])

const addItemRecipe = () => {
    
}
</script>

<template>
    <div class="square-button">
        <button class="back-btn" @click="addItemRecipe()">
            <img src="../../../../public/web_png/return.png" />
        </button>
    </div>
</template>

<style scoped>
.square-button button {
    width: 35px;
    height: 30px;
    margin: 0 0 15px 65px;
    text-align: center;
    background-color: #cccccc;
    color: #000;
    border-left: 3px solid black;
    border-top: 3px solid black;
    border-right: 3px solid white;
    border-bottom: 3px solid white;
    cursor: pointer;
}

.square-button button img {
    width: 25px;
    height: 20px;
    margin-top: 3px;
    object-fit: cover;
}

</style>