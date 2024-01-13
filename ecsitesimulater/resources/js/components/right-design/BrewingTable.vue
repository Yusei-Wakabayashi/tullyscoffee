<script setup>
const props = defineProps({
    itemRecipeList: Array,
    hoveredItemRecipeName: String,
    itemRecipe: Function
});
</script>

<!--醸造台-->
<template>
    <div v-if="itemRecipeList[0]?.craft_num === 3">
        <div class="brewing-flex">
            
        <ul>
            <li v-for="(recipe, i) in itemRecipeList[0].recipes" :key="i">
                <img :src="recipe.pic" @mouseover="hoveredItemRecipeName = i" @mouseleave="hoveredItemRecipeName = null"
                    @click="itemRecipe(recipe)">

                <!-- アイテム名 -->
                <div class="item-name-recipe" v-if="hoveredItemRecipeName === i">
                    {{ recipe.name }}
                </div>
            </li>
        </ul>
        <div class="box">
            </div>

        </div>
        
    </div>
</template>
<style scoped>

.brewing-flex {
    display: flex;
    position: relative;
}

.brewing-flex ul {
    margin-top: 13px;
}

.brewing-flex li {
    position: relative; 
    z-index: 1;
    list-style: none;
    width: 49px;
    height: 49px;
    margin: 5px 32px 0 90px;
    text-align: center;
    background-color: #999999;
    border-left: 3px solid #333333;
    border-top: 3px solid #333333;
    border-bottom: 3px solid #f2f2f2;
    border-right: 3px solid #f2f2f2;
}

li:nth-child(2) {
    margin-left: 25px;
}

.box {
    position: absolute;
    z-index: 2; 
    width: 5px;
    height: 69px;
    margin: 69.6px 0 0 112px;
    text-align: center;
    background-color: #999999;
    border-left: 3px solid #333333;
    border-right: 3px solid #f2f2f2;
}

img {
    width: 49px;
    height: 49px;
    text-align: center;
}

</style>
