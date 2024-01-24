<script setup>
    import { defineProps, ref, defineEmits } from 'vue';

    const props = defineProps({
        itemRecipeList: Array
    });

    const emits = defineEmits();

    //const UpdateKeep = (keep) => {
    //existingItems.value = keep.existingItems
    //selectedItemClick.value = keep.selectedItemClick
    //}

    const RecipeIndex = ref( props.itemRecipeList)
    

    const countUp = () => {
        if (RecipeIndex.value.length > 0){
            RecipeIndex.value = (RecipeIndex.value.length + 1) % RecipeIndex.value.length;
            emits('update-recipe-index', RecipeIndex.value);
        }
        console.log(RecipeIndex.value)
        console.log(RecipeIndex)
    };

</script>

<template>
    <div class="flex_box">
        <div class="arrow-button">
            <button @click="countUp"
                :class="{ disabled: RecipeIndex === 0 }">
                <img src="../../../../public/web_png/arrow_left.png" />
            </button>
        </div>
        <h1 v-for="(item, index) in props.itemRecipeList" :key="index">
            <span v-if="index === RecipeIndex">{{ index + 1 }}/{{ RecipeIndex }}</span>
        </h1>
        <div class="arrow-button">
            <button @click="countUp"
                :class="{ disabled: RecipeIndex === (props.itemRecipeList ? props.itemRecipeList.length - 1 : 0)}">
                <img src="../../../../public/web_png/arrow_right.png" />
            </button>
        </div>
    </div>
</template>

<style scoped>

.flex_box{
    display: flex;
    margin-left: 20px;
}

.arrow-button button{
    padding: 0;
    border: none;
    background: transparent;
}
.arrow-button img{
    display: block;
}

</style>