<script setup>
const props = defineProps({
    itemImgSrc: String,
    hoveredItem: Number,
    itemName: String
})
</script>

<!--レシピ右側デザイン-->
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

<style scoped>
.square_triangle_arrow {
    position: relative;
    padding-left: 35px;
    display: inline-block;
}

.square_triangle_arrow::before {
    content: "";
    margin: auto;
    position: absolute;
    top: 0;
    bottom: 0;
    right: 90px;
    width: 45px;
    height: 10px;
    background: #999999;
}

.square_triangle_arrow::after {
    content: "";
    margin: auto;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 25px;
    width: 0;
    height: 0;
    border-top: 25px solid transparent;
    border-bottom: 25px solid transparent;
    border-left: 25px solid #999999;
}

.image-container {
    width: 50px;
    height: 50px;
    margin-left: 30px;
    border-left: 3px solid black;
    border-top: 3px solid black;
    border-right: 3px solid white;
    border-bottom: 3px solid white;
    background-color: #999;
    cursor: pointer;
}

.image-container img {
    width: 100%;
    height: 100%;
}

.image-container:hover {
    background-color: rgb(255, 255, 255);
    z-index: 1;
    opacity: 0.6;
}
</style>