<script setup>
const props = defineProps({
    itemRecipeList: Array,
    hoveredItemRecipeName: String,
    itemRecipe: Function
});
</script>

<!--作業台-->
<template>
    <div v-if="itemRecipeList[0]?.craft_num === 2">
        <ul class="sagyou-ul">
            <li class="sagyou-li" v-for="(recipe, i) in itemRecipeList[0].recipes" :key="i">
                <img class="item-img" :src="recipe?.pic" @mouseover="hoveredItemRecipeName = i"
                    @mouseleave="hoveredItemRecipeName = null" @click="itemRecipe(recipe)" width="49">

                <!-- アイテム名 -->
                <div class="item-name-recipe" v-if="hoveredItemRecipeName === i">
                    {{ recipe?.name }}
                </div>
            </li>
        </ul>
    </div>
</template>