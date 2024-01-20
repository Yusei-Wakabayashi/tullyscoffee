<script setup>
import { ref } from 'vue'
const props = defineProps({
    setCategory: Function,
    currentCategory: Number,
    categoryNames: Object
})

const hoverdName1 = ref(null);
const hoverdName2 = ref(null);
const hoverdName3 = ref(null);
const hoverdName4 = ref(null);
const hoverdName5 = ref(null);
</script>

<!--カテゴリーボタン上部-->
<template>
    <!--建築ブロックボタン-->
    <div class="tab-category">
        <button @click="setCategory(1)" @mouseover="hoverdName1 = currentCategory" @mouseleave="hoverdName1 = null"
            :class="{ 'btn-category-click': currentCategory === 1, 'btn-category': currentCategory !== 1, }">
            <img src="../../../../public/img/architecture/bricks.webp" />
        </button>
        <div class="categoryName" v-if="hoverdName1 === currentCategory">
            {{ categoryNames[1] }}
        </div>
    </div>
    <!--色付きブロックボタン-->
    <div class="tab-category">
        <button @click="setCategory(2)" @mouseover="hoverdName2 = currentCategory" @mouseleave="hoverdName2 = null"
            :class="{ 'btn-category-click': currentCategory === 2, 'btn-category': currentCategory !== 2, }">
            <img src="../../../../public/img/colored/cyan_wool.webp" />
        </button>
        <div class="categoryName" v-if="hoverdName2 === currentCategory">
            {{ categoryNames[2] }}
        </div>
    </div>
    <!--天然ブロックボタン-->
    <div class="tab-category">
        <button @click="setCategory(3)"  @mouseover="hoverdName3 = currentCategory" @mouseleave="hoverdName3 = null"
            :class="{ 'btn-category-click': currentCategory === 3, 'btn-category': currentCategory !== 3, }">
            <img src="../../../../public/img/natural/grass_block.webp" />
        </button>
        <div class="categoryName" v-if="hoverdName3 === currentCategory">
            {{ categoryNames[3] }}
        </div>
    </div>
    <!--機能的ブロックボタン-->
    <div class="tab-category">
        <button @click="setCategory(4)"  @mouseover="hoverdName4 = currentCategory" @mouseleave="hoverdName4 = null"
            :class="{ 'btn-category-click': currentCategory === 4, 'btn-category': currentCategory !== 4, }">
            <img src="../../../../public/img/function/oak_sign.webp" />
        </button>
        <div class="categoryName" v-if="hoverdName4 === currentCategory">
            {{ categoryNames[4] }}
        </div>
    </div>
    <!--レッドストーン-->
    <div class="tab-category">
        <button @click="setCategory(5)" @mouseover="hoverdName5 = currentCategory" @mouseleave="hoverdName5 = null"
            :class="{ 'btn-category-click': currentCategory === 5, 'btn-category': currentCategory !== 5, }">
            <img src="../../../../public/img/redstone/redstone.png" />
        </button>
        <div class="categoryName" v-if="hoverdName5 === currentCategory">
            {{ categoryNames[5] }}
        </div>
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