<script setup>
const props = defineProps({
    itemImgSrc: String,
    hoveredItem: Number,
    itemName: String,
    itemNumGet: Number
})
</script>

<!--レシピ右側デザイン-->
<template>
    <div class="arrow_img">
        <div class="square_triangle_arrow">
            <div class="flex-box">
                <img class="image-container" :src="itemImgSrc" @mouseover="hoveredItem = itemName"
                @mouseleave="hoveredItem = null" />
                <div class="item-name-result" v-if="hoveredItem === itemName">
                    {{ itemName }}
                </div>
                <div class="numbox" v-if="itemNumGet > 1">
                    <!--クラフトしたときのアイテム数-->
                    <h4>{{ itemNumGet }}</h4>
                </div>
                <div class="numbox" v-if="itemNumGet === 0">
                    <!--クラフトしたときのアイテム数-->
                    <h4></h4>
                </div>
            </div>

        </div>
            
    </div>
</template>

<style scoped>
.item-name-result {
    margin: -10% 0;
    white-space: nowrap;
    display: inline;
    padding: 7px;
    background: rgb(35, 35, 35, 0.7);
    color: #fff;
    text-align: center;
    position: absolute;
    font-weight: bold;
    z-index: 1;
    transform: translateX(110px);
}   
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
    right: 118px;
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
    left: 60px;
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

.image-container{
    margin-left: 60px;
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

.numbox{
    width: 30px;
    height: 30px;
    color: white;
    position: relative;
    right: 25px;
    top: 5px;
}

.flex-box{
    display: flex;
}

.numbox{
    margin-top: 24px;
}
</style>