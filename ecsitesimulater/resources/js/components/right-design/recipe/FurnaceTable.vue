<script setup>
const props = defineProps({
    itemRecipeList: Array,
    hoveredItemRecipeName: String,
});
</script>

<!--かまど-->
<template>
    <div class="kamado" v-if="itemRecipeList[0]?.craft_num === 4">
        <ul class="kamado-ul">
            <li v-for="(recipe, i) in itemRecipeList[0].recipes" :key="i">
                <img :src="recipe.pic" @mouseover="hoveredItemRecipeName = i" @mouseleave="hoveredItemRecipeName = null">

                <!-- アイテム名 -->
                <div class="item-name-recipe" v-if="hoveredItemRecipeName === i">
                    {{ recipe.name }}
                </div>
            </li>
        </ul>
    </div>
</template>

<style scoped>

</style>