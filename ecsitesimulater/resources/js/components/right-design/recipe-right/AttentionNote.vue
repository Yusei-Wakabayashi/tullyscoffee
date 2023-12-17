<script setup>
const props = defineProps({
    hoveredItemRecipeNote: String,
    itemRecipeNote: String
})
</script>

<template>
    <div>
        <!--後でitemGetNoteを追加する-->
        <div class="box" @mouseover="hoveredItemRecipeNote = itemRecipeNote" @mouseleave="hoveredItemRecipeNote = null">
            ?
            <div class="item-name-note" v-if="hoveredItemRecipeNote === itemRecipeNote">
                {{ itemRecipeNote }}
            </div>
        </div>
    </div>
</template>