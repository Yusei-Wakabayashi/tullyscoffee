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

<style scoped>
.kaji-ul {
    display: flex;
    list-style: none;
    margin: 75px 0 0 5px;
}

.kaji-li{
    width: 49px;
    height: 49px;
    margin-left: 3px;
    background-color: #999999;
    border-left: 3px solid #333333;
    border-top: 3px solid #333333;
    border-bottom: 3px solid #f2f2f2;
    border-right: 3px solid #f2f2f2;

}
</style>