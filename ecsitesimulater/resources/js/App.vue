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

//カテゴリーボタン
const isArchitectureClick = ref(true);
const isColoredClick = ref(false);
const isNaturalClick = ref(false);
const isFunctionClick = ref(false);
const isRedstoneClick = ref(false);
const isToolClick = ref(false);
const isBattleClick = ref(false);
const isFoodclick = ref(false);
const isMaterialClick = ref(false);
const isAllItemClick = ref(false);
const isKeepItemClick = ref(false);


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

//建築
const setArchitectureClick = () => {
    isArchitectureClick.value = true;
    isColoredClick.value = false;
    isNaturalClick.value = false;
    isFunctionClick.value = false;
    isRedstoneClick.value = false;
    isToolClick.value = false;
    isBattleClick.value = false;
    isFoodclick.value = false;
    isMaterialClick.value = false;
    isAllItemClick.value = false;
    isKeepItemClick.value = false;
}

//色付き
const setColoredClick = () => {
    isArchitectureClick.value = false;
    isColoredClick.value = true;
    isNaturalClick.value = false;
    isFunctionClick.value = false;
    isRedstoneClick.value = false;
    isToolClick.value = false;
    isBattleClick.value = false;
    isFoodclick.value = false;
    isMaterialClick.value = false;
    isAllItemClick.value = false;
    isKeepItemClick.value = false;
}

//天然
const setNaturalClick = () => {
    isArchitectureClick.value = false;
    isColoredClick.value = false;
    isNaturalClick.value = true;
    isFunctionClick.value = false;
    isRedstoneClick.value = false;
    isToolClick.value = false;
    isBattleClick.value = false;
    isFoodclick.value = false;
    isMaterialClick.value = false;
    isAllItemClick.value = false;
    isKeepItemClick.value = false;
}

//機能的
const setFunctionClick = () => {
    isArchitectureClick.value = false;
    isColoredClick.value = false;
    isNaturalClick.value = false;
    isFunctionClick.value = true;
    isRedstoneClick.value = false;
    isToolClick.value = false;
    isBattleClick.value = false;
    isFoodclick.value = false;
    isMaterialClick.value = false;
    isAllItemClick.value = false;
    isKeepItemClick.value = false;
}

//レッドストーン
const setRedstoneClick = () => {
    isArchitectureClick.value = false;
    isColoredClick.value = false;
    isNaturalClick.value = false;
    isFunctionClick.value = false;
    isRedstoneClick.value = true;
    isToolClick.value = false;
    isBattleClick.value = false;
    isFoodclick.value = false;
    isMaterialClick.value = false;
    isAllItemClick.value = false;
    isKeepItemClick.value = false;
}

//道具と実用
const setToolClick = () => {
    isArchitectureClick.value = false;
    isColoredClick.value = false;
    isNaturalClick.value = false;
    isFunctionClick.value = false;
    isRedstoneClick.value = false;
    isToolClick.value = true;
    isBattleClick.value = false;
    isFoodclick.value = false;
    isMaterialClick.value = false;
    isAllItemClick.value = false;
    isKeepItemClick.value = false;
}

//戦闘
const setBattleClick = () => {
    isArchitectureClick.value = false;
    isColoredClick.value = false;
    isNaturalClick.value = false;
    isFunctionClick.value = false;
    isRedstoneClick.value = false;
    isToolClick.value = false;
    isBattleClick.value = true;
    isFoodclick.value = false;
    isMaterialClick.value = false;
    isAllItemClick.value = false;
    isKeepItemClick.value = false;
}

//食べ物と飲み物
const setFoodClick = () => {
    isArchitectureClick.value = false;
    isColoredClick.value = false;
    isNaturalClick.value = false;
    isFunctionClick.value = false;
    isRedstoneClick.value = false;
    isToolClick.value = false;
    isBattleClick.value = false;
    isFoodclick.value = true;
    isMaterialClick.value = false;
    isAllItemClick.value = false;
    isKeepItemClick.value = false;
}

//材料
const setMaterialClick = () => {
    isArchitectureClick.value = false;
    isColoredClick.value = false;
    isNaturalClick.value = false;
    isFunctionClick.value = false;
    isRedstoneClick.value = false;
    isToolClick.value = false;
    isBattleClick.value = false;
    isFoodclick.value = false;
    isMaterialClick.value = true;
    isAllItemClick.value = false;
    isKeepItemClick.value = false;
}

//全アイテム一覧
const setAllItemClick = () => {
    isArchitectureClick.value = false;
    isColoredClick.value = false;
    isNaturalClick.value = false;
    isFunctionClick.value = false;
    isRedstoneClick.value = false;
    isToolClick.value = false;
    isBattleClick.value = false;
    isFoodclick.value = false;
    isMaterialClick.value = false;
    isAllItemClick.value = true;
    isKeepItemClick.value = false;
}

//保存アイテム一覧
const setKeepItemClick = () => {
    isArchitectureClick.value = false;
    isColoredClick.value = false;
    isNaturalClick.value = false;
    isFunctionClick.value = false;
    isRedstoneClick.value = false;
    isToolClick.value = false;
    isBattleClick.value = false;
    isFoodclick.value = false;
    isMaterialClick.value = false;
    isAllItemClick.value = false;
    isKeepItemClick.value = true;
}

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
                    <!--ワールドボタン-->
                    <div class="tab-container">
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

                    <!--カテゴリーボタン-->
                    <div class="tab-category-container">
                        <!--建築-->
                        <div class="tab-category" @click="setArchitectureClick(true)">
                            <button
                                :class="{ 'btn-category-click': isArchitectureClick, 'btn-category': !isArchitectureClick }">
                                <img src="./img/architecture/bricks.webp">
                            </button>
                        </div>
                        <!--色付き-->
                        <div class="tab-category" @click="setColoredClick(true)">
                            <button :class="{ 'btn-category-click': isColoredClick, 'btn-category': !isColoredClick }">
                                <img src="./img/colored/cyan_wool.webp">
                            </button>
                        </div>
                        <!--天然-->
                        <div class="tab-category" @click="setNaturalClick(true)">
                            <button :class="{ 'btn-category-click': isNaturalClick, 'btn-category': !isNaturalClick }">
                                <img src="./img/natural/grass_block.webp">
                            </button>
                        </div>
                        <!--機能的-->
                        <div class="tab-category" @click="setFunctionClick(true)">
                            <button :class="{ 'btn-category-click': isFunctionClick, 'btn-category': !isFunctionClick }">
                                <img src="./img/function/oak_sign.webp">
                            </button>
                        </div>
                        <!--レッドストーン-->
                        <div class="tab-category" @click="setRedstoneClick(true)">
                            <button :class="{ 'btn-category-click': isRedstoneClick, 'btn-category': !isRedstoneClick }">
                                <img src="./img/redstone/redstone.png">
                            </button>
                        </div>
                        <div>
                            <input v-model="searchTerm" placeholder="検索">
                        </div>
                        <!--非同期の待ち時間アニメーション-->
                        <div v-show="isLoading" class="loading-animation">
                            <h1>Now Loading<span class="loading-dots"></span></h1>
                        </div>
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
                        <div class="tab-category-bottom" @click="setToolClick(true)">
                            <button
                                :class="{ 'btn-category-bottom-click': isToolClick, 'btn-category-bottom': !isToolClick }">
                                <img src="./img/tool/diamond_pickaxe.webp">
                            </button>
                        </div>
                        <div class="tab-category-bottom" @click="setBattleClick(true)">
                            <button
                                :class="{ 'btn-category-bottom-click': isBattleClick, 'btn-category-bottom': !isBattleClick }">
                                <img src="./img/battle/netherite_sword.webp">
                            </button>
                        </div>
                        <div class="tab-category-bottom" @click="setFoodClick(true)">
                            <button
                                :class="{ 'btn-category-bottom-click': isFoodclick, 'btn-category-bottom': !isFoodclick }">
                                <img src="./img/food/golden_apple.png">
                            </button>
                        </div>
                        <div class="tab-category-bottom" @click="setMaterialClick(true)">
                            <button
                                :class="{ 'btn-category-bottom-click': isMaterialClick, 'btn-category-bottom': !isMaterialClick }">
                                <img src="./img/material/iron_ingot.webp">
                            </button>
                        </div>
                        <div class="tab-category-bottom" @click="setAllItemClick(true)">
                            <button
                                :class="{ 'btn-category-bottom-click': isAllItemClick, 'btn-category-bottom': !isAllItemClick }">
                                <img src="">
                            </button>
                        </div>
                        <!--二つ分開ける-->
                        <div class="tab-category-bottom-blank"></div>
                        <div class="tab-category-bottom-blank"></div>
                        <!--ここまで-->
                        <div class="tab-category-bottom" @click="setKeepItemClick(true)">
                            <button
                                :class="{ 'btn-category-bottom-click': isKeepItemClick, 'btn-category-bottom': !isKeepItemClick }">
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
    </div>
</template>