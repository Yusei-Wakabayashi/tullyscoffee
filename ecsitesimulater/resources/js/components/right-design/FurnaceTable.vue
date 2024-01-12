<script setup>
const props = defineProps({
    itemRecipeList: Array,
    hoveredItemRecipeName: String,
    itemRecipeBack: Function
});
</script>

<!--かまど-->
<template>
    <div class="kamado" v-if="itemRecipeList[0]?.craft_num === 4">
        <ul class="kamado-ul">
            <li v-for="(recipe, i) in itemRecipeList[0].recipes" :key="i">
                <img :src="recipe.pic" @mouseover="hoveredItemRecipeName = i" @mouseleave="hoveredItemRecipeName = null"
                    @click="itemRecipeBack(recipe)">

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
  cursor: pointer;
}
.kamado li:nth-child(2){
  background-color: transparent;
  border: none;
}

.kamado img{
  width: 49px;
}

</style>