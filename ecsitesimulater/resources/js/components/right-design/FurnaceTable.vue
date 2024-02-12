<script setup>
const props = defineProps({
    itemRecipeList: Array,
    hoveredItemRecipeName: String,
    itemRecipeBack: Function,
    count: Number
});
</script>

<!--かまど-->
<template>
    <div class="kamado" v-if="itemRecipeList[count]?.craft_num === 4">
        <ul class="kamado-ul">
            <li v-for="(recipe, i) in itemRecipeList[count].recipes" :key="i">
                <img class="item-img" :src="recipe.pic" v-if="recipe.pic !== '/img/fire.png'" @mouseover="hoveredItemRecipeName = i"
                    @mouseleave="hoveredItemRecipeName = null" @click="itemRecipeBack(recipe, i)">
                <img v-if="recipe.pic === '/img/fire.png'" src="/img/fire.png">
                <!-- アイテム名 -->
                <div class="item-name-recipe" v-if="hoveredItemRecipeName === i">
                    {{ recipe.name }}
                </div>
            </li>
        </ul>
    </div>
</template>

<style scoped>
.kamado-ul {
    list-style: none;
    margin: 20px 50px 0 70px;
}

.item-img {
    cursor: pointer;
}


.kamado li {

    width: 49px;
    height: 49px;
    text-align: center;
    margin-bottom: 5px;
    background-color: #999999;
    border-left: 3px solid #333333;
    border-top: 3px solid #333333;
    border-bottom: 3px solid #f2f2f2;
    border-right: 3px solid #f2f2f2;
}

.kamado li:nth-child(2) {
    background-color: transparent;
    border: none;
}

.kamado img {
    width: 49px;
    height: 49px;
}
</style>