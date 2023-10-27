<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios'


//非同期処理の読み込み判定
const isLoading = ref(true);
//アイテム配列
const items = ref([]);

const getAllitem = () => {
    axios.get('/item/start')//API URL
        //通信成功時処理
        .then(response => {
            items.value = response.data;
        })
        //通信失敗時処理
        .catch(error => {
            console.log(error);
        })
        //非同期の処理待ちの処理
        .finally(() => {
            isLoading.value = false; // データ読み込み完了を示す
        });
}

//リロード時全アイテムが表示される
onMounted(() => {
    getAllitem();
}
);

//(ワールドボタン)
const isOverworldClick = ref(false);
const isNetherTabClick = ref(false);
const isEndTabClick = ref(false);
const isAllTabClick = ref(true);

//オーバーワールド
const setOverworldClick = () => {
    isOverworldClick.value = true;
    isNetherTabClick.value = false;
    isEndTabClick.value = false;
    isAllTabClick.value = false;
};

//ネザー
const setNetherTabClick = () => {
    isOverworldClick.value = false;
    isNetherTabClick.value = true;
    isEndTabClick.value = false;
    isAllTabClick.value = false;
};

//エンド
const setEndTabClick = () => {
    isOverworldClick.value = false;
    isNetherTabClick.value = false;
    isEndTabClick.value = true;
    isAllTabClick.value = false;
};

//オール
const setAllTabClick = () => {
    isOverworldClick.value = false;
    isNetherTabClick.value = false;
    isEndTabClick.value = false;
    isAllTabClick.value = true;
};

//初期のcss状態(ALLカテゴリーボタン)
const currentCategory = ref('architecture');

//クリックしたものの引数をcurrentCategoryに入れて変更
const setCategory = (category) => {
    currentCategory.value = category;
};

// ユーザーの検索語を格納
const searchTerm = ref('');
// カーソルがアイテム画像にホバーした際のアイテム名を格納するリファレンス
const hoveredItem = ref(null);
//アイテム名検索(アイテム名)
const filtereditems = computed(() => {
    // データベース内のアイテム名を含むアイテムだけをフィルタリング
    return items.value.filter(item =>
        item.name.includes(searchTerm.value)
    );
});
</script>

<template>
    <div class="position">
        <div class="split">
            <div>
                <div class="main">
                    <div class="tab-container">
                        <!--オーバーワールドボタン-->
                        <div :class="{ 'tab-click-left': isOverworldClick, 'tab-left': !isOverworldClick }"
                            @click="setOverworldClick(true)">
                            <button
                                :class="{ 'tab-world-click': isOverworldClick, 'tab-world': !isOverworldClick }">オーバーワールド</button>
                        </div>
                        <!--ネザーボタン-->
                        <div :class="{ 'tab-click': isNetherTabClick, 'tab': !isNetherTabClick }"
                            @click="setNetherTabClick(true)">
                            <button
                                :class="{ 'tab-world-click': isNetherTabClick, 'tab-world': !isNetherTabClick }">ネザー</button>
                        </div>
                        <!--エンドボタン-->
                        <div :class="{ 'tab-click': isEndTabClick, 'tab': !isEndTabClick }" @click="setEndTabClick(true)">
                            <button :class="{ 'tab-world-click': isEndTabClick, 'tab-world': !isEndTabClick }">エンド</button>
                        </div>
                        <!--オールボタン-->
                        <div :class="{ 'tab-click': isAllTabClick, 'tab-right': !isAllTabClick }"
                            @click="setAllTabClick(true)">
                            <button :class="{ 'tab-world-click': isAllTabClick, 'tab-world': !isAllTabClick }">オール</button>
                        </div>
                    </div>
                    <!--カテゴリーボタン上部-->
                    <div class="tab-category-container">
                        <!--建築ブロックボタン-->
                        <div class="tab-category" @click="setCategory('architecture')">
                            <button
                                :class="{ 'btn-category-click': currentCategory === 'architecture', 'btn-category': currentCategory !== 'architecture' }">
                                <img src="./img/architecture/bricks.webp">
                            </button>
                        </div>
                        <!--色付きブロックボタン-->
                        <div class="tab-category" @click="setCategory('colored')">
                            <button
                                :class="{ 'btn-category-click': currentCategory === 'colored', 'btn-category': currentCategory !== 'colored' }">
                                <img src="./img/colored/cyan_wool.webp">
                            </button>
                        </div>
                        <!--天然ブロックボタン-->
                        <div class="tab-category" @click="setCategory('natural')">
                            <button
                                :class="{ 'btn-category-click': currentCategory === 'natural', 'btn-category': currentCategory !== 'natural' }">
                                <img src="./img/natural/grass_block.webp">
                            </button>
                        </div>
                        <!--機能的ブロックボタン-->
                        <div class="tab-category" @click="setCategory('function')">
                            <button
                                :class="{ 'btn-category-click': currentCategory === 'function', 'btn-category': currentCategory !== 'function' }">
                                <img src="./img/function/oak_sign.webp">
                            </button>
                        </div>
                        <!--レッドストーン-->
                        <div class="tab-category" @click="setCategory('redstone')">
                            <button
                                :class="{ 'btn-category-click': currentCategory === 'redstone', 'btn-category': currentCategory !== 'redstone' }">
                                <img src="./img/redstone/redstone.png">
                            </button>
                        </div>
                        <!--検索ボックス-->
                        <input v-model="searchTerm" placeholder="検索">
                    </div>
                    <!--非同期の待ち時間アニメーション-->
                    <div v-show="isLoading" class="loading-animation">
                        <h1>Now Loading<span class="loading-dots"></span></h1>
                    </div>
                    <!--アイテム一覧-->
                    <h1 class="title">装飾ブロック</h1>
                    <div class="itemlist-inline">
                        <div class="vertical-scrollable-list">
                            <!--アイテム画像-->
                            <ul>
                                <li v-for="(item, i) in filtereditems" :key="i" class="item-container">
                                    <!--アイテム画像-->
                                    <img @mouseover="hoveredItem = item.name" @mouseleave="hoveredItem = null"
                                        :src="item.pic">
                                    <!--アイテム名-->
                                    <div class="item-name" v-if="hoveredItem === item.name">{{ item.name }}</div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="tab-category-container-bottom">
                        <div class="tab-category-bottom" @click="setCategory('tool')">
                            <button
                                :class="{ 'btn-category-bottom-click': currentCategory === 'tool', 'btn-category-bottom': currentCategory !== 'tool' }">
                                <img src="./img/tool/diamond_pickaxe.webp">
                            </button>
                        </div>
                        <div class="tab-category-bottom" @click="setCategory('battle')">
                            <button
                                :class="{ 'btn-category-bottom-click': currentCategory === 'battle', 'btn-category-bottom': currentCategory !== 'battle' }">
                                <img src="./img/battle/netherite_sword.webp">
                            </button>
                        </div>
                        <div class="tab-category-bottom" @click="setCategory('food')">
                            <button
                                :class="{ 'btn-category-bottom-click': currentCategory === 'food', 'btn-category-bottom': currentCategory !== 'food' }">
                                <img src="./img/food/golden_apple.png">
                            </button>
                        </div>
                        <div class="tab-category-bottom" @click="setCategory('material')">
                            <button
                                :class="{ 'btn-category-bottom-click': currentCategory === 'material', 'btn-category-bottom': currentCategory !== 'material' }">
                                <img src="./img/material/iron_ingot.webp">
                            </button>
                        </div>
                        <div class="tab-category-bottom" @click="setCategory('all')">
                            <button
                                :class="{ 'btn-category-bottom-click': currentCategory === 'all', 'btn-category-bottom': currentCategory !== 'all' }">
                                <img src="">
                            </button>
                        </div>
                        <!--二つ分開ける-->
                        <div class="tab-category-bottom-blank"></div>
                        <div class="tab-category-bottom-blank"></div>
                        <!--ここまで-->
                        <div class="tab-category-bottom" @click="setCategory('keep')">
                            <button
                                :class="{ 'btn-category-bottom-click': currentCategory === 'keep', 'btn-category-bottom': currentCategory !== 'keep' }">
                                <img src="">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="recipe">
                    <div class="recipe-inline">

                    </div>
                </div>
            </div>
        </div>
</div></template>