<script setup>
const props = defineProps({
    itemRecipeList: Array,
    hoveredItemRecipeName: String,
    itemRecipeBack: Function
});
</script>

<!--作業台-->
<template>
    <div v-if="itemRecipeList[0]?.craft_num === 2">
        <ul class="sagyou-ul">
            <li class="sagyou-li" v-for="(recipe, i) in itemRecipeList[0].recipes" :key="i" :class="{ 'no-cursor': !recipe?.pic }">
                <img class="item-img" :src="recipe?.pic" @mouseover="hoveredItemRecipeName = i"
                    @mouseleave="hoveredItemRecipeName = null" @click="itemRecipeBack(recipe)" width="49">

                <!-- アイテム名 -->
                <div class="item-name-recipe" v-if="hoveredItemRecipeName === i">
                    {{ recipe?.name }}
                </div>
            </li>
        </ul>
    </div>
</template>

<style scoped>
.sagyou-ul {
    list-style: none;
    margin: 15px 0 15px 15px;
    padding: 0;
    display: grid;
    grid-template-columns: repeat(3, 50px);
    /* 3つの列を作成し、各列の幅を50pxに設定 */
    grid-template-rows: repeat(3, 50px);
    grid-gap: 6px;

}


.sagyou-li {
    width: 49px;
    height: 49px;
    background-color: #999999;
    border-left: 3px solid #333333;
    border-top: 3px solid #333333;
    border-bottom: 5px solid #f2f2f2;
    border-right: 5px solid #f2f2f2;
    cursor: pointer;
}

.sagyou-li.no-cursor {
    cursor: default;
}

</style>