<script setup>
const props = defineProps({
    itemRecipeList: Array,
    hoveredItemRecipeName: String,
    itemRecipe: Function
});
</script>

<!--かまど-->
<template>
    <div class="kamado" v-if="itemRecipeList[0]?.craft_num === 4">
        <ul class="kamado-ul">
            <li v-for="(recipe, i) in itemRecipeList[0].recipes" :key="i">
                <img :src="recipe.pic" @mouseover="hoveredItemRecipeName = i" @mouseleave="hoveredItemRecipeName = null"
                    @click="itemRecipe(recipe)">

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
    margin: 15px 50px 0 70px;
}

img{
    cursor: pointer;
}
</style>