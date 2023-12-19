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
    </div>
</template>

<style scoped>
img{
    cursor: pointer;
}
</style>