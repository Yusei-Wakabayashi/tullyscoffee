<script setup>
import { ref } from 'vue'
const props = defineProps({
    itemRecipeNote: String
})

const hoveredItemRecipeNote = ref(null)
</script>

<!--注意書き-->
<template>
    <div v-if="itemRecipeNote.length">
        <div class="box" @mouseover="hoveredItemRecipeNote = itemRecipeNote" @mouseleave="hoveredItemRecipeNote = null">
            ?
            <div class="item-name-note" v-if="hoveredItemRecipeNote === itemRecipeNote">
                {{ itemRecipeNote }}
            </div>
        </div>
    </div>
    <div v-if="itemRecipeNote.length === 0">
        <div class="box-none">
            <div class="item-name-note" v-if="hoveredItemRecipeNote === itemRecipeNote">
                {{ itemRecipeNote }}
            </div>
        </div>
    </div>
</template>

<style scoped>
.box {
    width: 30px;
    height: 30px;
    margin-left: 168px;
    background-color: #999999;
    border-left: 3px solid #333333;
    border-top: 3px solid #333333;
    border-bottom: 3px solid #f2f2f2;
    border-right: 3px solid #f2f2f2;
    box-sizing: border-box;
}
.box-none {
    width: 30px;
    height: 30px;
    margin-left: 168px;
}
</style>