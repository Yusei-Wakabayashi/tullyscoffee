<script setup>
const props = defineProps({
    itemRecipeList: Array,
    hoveredItemRecipeName: String,
});
</script>

<!--鍛冶台-->
<template>
    <div class="kaji" v-if="itemRecipeList[0]?.craft_num === 5">
        <ul class="kaji-ul">
            <li class="kaji-li" v-for="(recipe, i) in itemRecipeList[0].recipes" :key="i">
                <img class="item-img" :src="recipe?.pic" @mouseover="hoveredItemRecipeName = i"
                    @mouseleave="hoveredItemRecipeName = null" width="49">

                <!-- アイテム名 -->
                <div class="item-name-recipe" v-if="hoveredItemRecipeName === i">
                    {{ recipe?.name }}
                </div>
            </li>
        </ul>
    </div>
</template>