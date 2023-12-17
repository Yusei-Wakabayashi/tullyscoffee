<script setup>
const props = defineProps({
    setCategory: Function,
    currentCategory: Number,
})
</script>

<!--カテゴリーボタン上部-->
<template>
        <!--建築ブロックボタン-->
        <div class="tab-category">
            <button @click="setCategory(1)"
                :class="{ 'btn-category-click': currentCategory === 1, 'btn-category': currentCategory !== 1, }">
                <img src="../../../../public/img/architecture/bricks.webp" />
            </button>
        </div>
        <!--色付きブロックボタン-->
        <div class="tab-category">
            <button @click="setCategory(2)"
                :class="{ 'btn-category-click': currentCategory === 2, 'btn-category': currentCategory !== 2, }">
                <img src="../../../../public/img/colored/cyan_wool.webp" />
            </button>
        </div>
        <!--天然ブロックボタン-->
        <div class="tab-category">
            <button @click="setCategory(3)"
                :class="{ 'btn-category-click': currentCategory === 3, 'btn-category': currentCategory !== 3, }">
                <img src="../../../../public/img/natural/grass_block.webp" />
            </button>
        </div>
        <!--機能的ブロックボタン-->
        <div class="tab-category">
            <button @click="setCategory(4)"
                :class="{ 'btn-category-click': currentCategory === 4, 'btn-category': currentCategory !== 4, }">
                <img src="../../../../public/img/function/oak_sign.webp" />
            </button>
        </div>
        <!--レッドストーン-->
        <div class="tab-category">
            <button @click="setCategory(5)"
                :class="{ 'btn-category-click': currentCategory === 5, 'btn-category': currentCategory !== 5, }">
                <img src="../../../../public/img/redstone/redstone.png" />
            </button>
        </div>
</template>

<style scoped>
.tab-category-container img {
    width: 45px;
}
.tab-category {
    border: 3px solid #333333;
    border-bottom: none;
    margin: 5px 0 0 5px;
    width: 60px;
    height: 60px;
}

.btn-category-click {
    width: 60px;
    height: 60px;
    background-color: #cccccc;
    border-top: 3px solid #f2f2f2;
    border-left: 3px solid #f2f2f2;
    border-right: 3px solid rgb(101, 101, 101);
    border-bottom: none;
    cursor: pointer;
}


.btn-category {
    width: 60px;
    height: 60px;
    background-color: #999999;
    border-top: 3px solid #f2f2f2;
    border-left: 3px solid #f2f2f2;
    border-right: 3px solid rgb(101, 101, 101);
    border-bottom: none;
    cursor: pointer;
}
</style>