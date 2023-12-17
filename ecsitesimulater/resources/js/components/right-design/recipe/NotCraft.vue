<script setup>
const props = defineProps({itemRecipeList: Array});
</script>

<!--クラフト不可-->
<template>
    <div v-if="itemRecipeList[0]?.craft_num === 1">
        <ul>
            <li class="attention-img" v-for="(recipe, i) in itemRecipeList[0].recipes" :key="i">
                <img :src="recipe" alt="">
            </li>
        </ul>
    </div>
</template>