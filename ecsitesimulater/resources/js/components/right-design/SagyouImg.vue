<script setup>
const props = defineProps({
    itemRecipeList: Array,
    count: Number
});
</script>

<template>
  <div>
    <div v-if="itemRecipeList[count]?.craft_num !== 1" class="craft">
      <img v-if="itemRecipeList[count]?.craft_num === 2" class="" src="../../../../public/web_png/sagyoudai.webp" alt="">
      <img v-if="itemRecipeList[count]?.craft_num === 3" src="../../../../public/web_png/jouzoudai.webp" alt="">
      <img v-if="itemRecipeList[count]?.craft_num === 4" src="../../../../public/web_png/kamado.webp" alt="">
      <img v-if="itemRecipeList[count]?.craft_num === 5" src="../../../../public/web_png/kajidai.webp" alt="">
    </div>
  </div>
</template>

<style scoped>
.craft  {
  position: absolute;
  margin-top: 30px;
  opacity: 0.8;
  width: 30px;
  height: 30px;
  margin-left: 40px;
  background-color: #999999;
  border-left: 3px solid #333333;
  border-top: 3px solid #333333;
  border-bottom: 3px solid #f2f2f2;
  border-right: 3px solid #f2f2f2;
  box-sizing: border-box;
}
.craft img{
  width: 25px;
  height: 25px;
}
</style>
