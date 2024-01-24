<script setup>
import { ref } from 'vue'
const props = defineProps({
    setCategory: Function,
    currentCategory: Number,
    setCategoryKeep: Function,
    categoryNames: Object
})

const hoverdName6 = ref(null);
const hoverdName7 = ref(null);
const hoverdName8 = ref(null);
const hoverdName9 = ref(null);
const hoverdName10 = ref(null);
const hoverdName11 = ref(null);

const categoryKeepName = {
    11: '保存'
}
</script>

<!--カテゴリーボタン下部-->
<template>
    <div class="tab-category-container-bottom">
        <!--道具と実用-->
        <div class="tab-category-bottom">
            <button @click="setCategory(6)" @mouseover="hoverdName6 = currentCategory" @mouseleave="hoverdName6 = null"
                :class="{ 'btn-category-bottom-click': currentCategory === 6, 'btn-category-bottom': currentCategory !== 6, }">
                <img src="../../../../public/img/tool/diamond_pickaxe.webp" />
            </button>
            <div class="categoryName" v-if="hoverdName6 === currentCategory">
                {{ categoryNames[6] }}
            </div>
        </div>
        <!--戦闘-->
        <div class="tab-category-bottom">
            <button @click="setCategory(7)" @mouseover="hoverdName7 = currentCategory" @mouseleave="hoverdName7 = null"
                :class="{ 'btn-category-bottom-click': currentCategory === 7, 'btn-category-bottom': currentCategory !== 7, }">
                <img src="../../../../public/img/battle/netherite_sword.webp" />
            </button>
            <div class="categoryName" v-if="hoverdName7 === currentCategory">
                {{ categoryNames[7] }}
            </div>
        </div>
        <!--食べ物と飲み物-->
        <div class="tab-category-bottom">
            <button @click="setCategory(8)"  @mouseover="hoverdName8 = currentCategory" @mouseleave="hoverdName8 = null"
                :class="{ 'btn-category-bottom-click': currentCategory === 8, 'btn-category-bottom': currentCategory !== 8, }">
                <img src="../../../../public/img/food/golden_apple.png" />
            </button>
            <div class="categoryName" v-if="hoverdName8 === currentCategory">
                {{ categoryNames[8] }}
            </div>
        </div>
        <!--材料-->
        <div class="tab-category-bottom">
            <button @click="setCategory(9)"  @mouseover="hoverdName9 = currentCategory" @mouseleave="hoverdName9 = null"
                :class="{ 'btn-category-bottom-click': currentCategory === 9, 'btn-category-bottom': currentCategory !== 9, }">
                <img src="../../../../public/img/material/iron_ingot.webp" />
            </button>
            <div class="categoryName" v-if="hoverdName9 === currentCategory">
                {{ categoryNames[9] }}
            </div>
        </div>
        <!--オール-->
        <div class="tab-category-bottom">
            <button @click="setCategory(10)"  @mouseover="hoverdName10 = currentCategory" @mouseleave="hoverdName10 = null"
                :class="{ 'btn-category-bottom-click': currentCategory === 10, 'btn-category-bottom': currentCategory !== 10, }">
                <img src="../../../../public/web_png/all.png" />
            </button>
            <div class="categoryName" v-if="hoverdName10 === currentCategory">
                {{ categoryNames[10] }}
            </div>
        </div>
        <!--二つ分開ける-->
        <div class="tab-category-bottom-blank"></div>
        <div class="tab-category-bottom-blank"></div>
        <!--ここまで-->

        <!--保存-->
        <div class="tab-category-bottom">
            <button @click="setCategoryKeep()" @mouseover="hoverdName11 = currentCategory" @mouseleave="hoverdName11 = null"
                :class="{ 'btn-category-bottom-click': currentCategory === 11, 'btn-category-bottom': currentCategory !== 11, }">
                <img src="../../../../public/web_png/book.png" />
            </button>
            <div class="categoryName" v-if="hoverdName11 === currentCategory">
                {{ categoryKeepName[11] }}
            </div>
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

.tab-category-bottom img {
    width: 45px;
}

.categoryName {
    white-space: nowrap;
    display: inline;
    padding: 7px;
    background: rgb(35, 35, 35, 0.7);
    color: #fff;
    text-align: center;
    position: absolute;
    font-weight: bold;
    z-index: 1;
    transform: translateX(1px);
}
</style>