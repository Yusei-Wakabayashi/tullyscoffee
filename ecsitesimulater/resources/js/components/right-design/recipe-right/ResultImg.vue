<script setup>
const props = defineProps({
    itemImgSrc: String,
    hoveredItem: Number,
    itemName: String
})
</script>

<template>
    <div class="arrow_img">
        <div class="square_triangle_arrow">
            <img class="image-container" :src="itemImgSrc" @mouseover="hoveredItem = itemName"
                @mouseleave="hoveredItem = null" />
            <div class="item-name" v-if="hoveredItem === itemName">
                {{ itemName }}
            </div>
        </div>
    </div>
</template>