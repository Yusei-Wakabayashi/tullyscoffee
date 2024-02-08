<script setup>
const props = defineProps({
    itemRecipeList: Array,
    itemRecipeCountUp: Function,
    itemRecipeCountDown: Function,
    count: Number,
})
</script>

<template>
    <div class="flex_box" v-if="itemRecipeList.length > 2">
        <div class="arrow-button" v-if="count >= 1">
            <button  @click="itemRecipeCountDown()">
                <img src="../../../../public/web_png/arrow_left.png" />
            </button>
        </div>
        <h1>
            <span>{{ count + 1 }} / {{ itemRecipeList.length }}</span>
        </h1>
        <div class="arrow-button" v-if="count < itemRecipeList.length - 1">
            <button @click="itemRecipeCountUp()">
                <img src="../../../../public/web_png/arrow_right.png" />
            </button>
        </div>
    </div>
</template>

<style scoped>

.flex_box{
    display: flex;
    padding: 0 30px;
}

.arrow-button button{
    padding: 0;
    border: none;
    background: transparent;
}
.arrow-button img{
    display: block;
}

button{
    cursor: pointer;
}
</style>