<script setup>
const props = defineProps({
    setCategory: Function,
    currentCategory: Number,
    setCategoryKeep: Function
})
</script>

<!--カテゴリーボタン下部-->
<template>
    <div class="tab-category-container-bottom">
        <!--道具と実用-->
        <div class="tab-category-bottom">
            <button @click="setCategory(6)"
                :class="{ 'btn-category-bottom-click': currentCategory === 6, 'btn-category-bottom': currentCategory !== 6, }">
                <img src="../../../../public/img/tool/diamond_pickaxe.webp" />
            </button>
        </div>
        <!--戦闘-->
        <div class="tab-category-bottom">
            <button @click="setCategory(7)"
                :class="{ 'btn-category-bottom-click': currentCategory === 7, 'btn-category-bottom': currentCategory !== 7, }">
                <img src="../../../../public/img/battle/netherite_sword.webp" />
            </button>
        </div>
        <!--食べ物と飲み物-->
        <div class="tab-category-bottom">
            <button @click="setCategory(8)"
                :class="{ 'btn-category-bottom-click': currentCategory === 8, 'btn-category-bottom': currentCategory !== 8, }">
                <img src="../../../../public/img/food/golden_apple.png" />
            </button>
        </div>
        <!--材料-->
        <div class="tab-category-bottom">
            <button @click="setCategory(9)"
                :class="{ 'btn-category-bottom-click': currentCategory === 9, 'btn-category-bottom': currentCategory !== 9, }">
                <img src="../../../../public/img/material/iron_ingot.webp" />
            </button>
        </div>
        <!--オール-->
        <div class="tab-category-bottom">
            <button @click="setCategory(10)"
                :class="{ 'btn-category-bottom-click': currentCategory === 10, 'btn-category-bottom': currentCategory !== 10, }">
                <img src="../../../../public/web_png/all.png" />
            </button>
        </div>
        <!--二つ分開ける-->
        <div class="tab-category-bottom-blank"></div>
        <div class="tab-category-bottom-blank"></div>
        <!--ここまで-->

        <!--保存-->
        <div class="tab-category-bottom">
            <button @click="setCategoryKeep()"
                :class="{ 'btn-category-bottom-click': currentCategory === 11, 'btn-category-bottom': currentCategory !== 11, }">
                <img src="../../../../public/web_png/book.png" />
            </button>
        </div>
    </div>
</template>

<style scoped>
.tab-category-bottom {
    border: 3px solid #333333;
    border-top: none;
    margin: 0 0 0 5px;
    width: 60px;
    height: 60px;
}

.btn-category-bottom-click {
    width: 60px;
    height: 60px;
    background-color: #cccccc;
    border-top: none;
    border-left: 3px solid #f2f2f2;
    border-right: 3px solid rgb(101, 101, 101);
    border-bottom: 3px solid rgb(101, 101, 101);
    cursor: pointer;
}

.btn-category-bottom {
    width: 60px;
    height: 60px;
    background-color: #999999;
    border-top: none;
    border-left: 3px solid #f2f2f2;
    border-right: 3px solid rgb(101, 101, 101);
    border-bottom: 3px solid rgb(101, 101, 101);
    cursor: pointer;
}

.tab-category-bottom-blank {
    border: none;
    border-top: none;
    border-bottom: none;
    margin: 0 0 0 5px;
    width: 60px;
    height: 60px;
}

.tab-category-container-bottom {
    padding-bottom: 3px;
    display: flex;
    border-left: 3px solid #f2f2f2;
    padding-left: 5px;
    border-top: 4px solid #333333;
    border-right: 3px solid rgb(101, 101, 101);
    border-bottom: 3px solid rgb(101, 101, 101);
}

.tab-category-bottom img{
    width: 45px;
}
</style>