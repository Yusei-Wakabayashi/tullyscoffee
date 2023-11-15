<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios'


//非同期処理の読み込み判定 (trueの間だけアニメーション表示)
const isLoading = ref(true);
//アイテム配列
const items = ref([]);

//初期の表示オールアイテム
const getAllitem = () => {
    axios.get('/item/start')
        .then(response => {
            items.value = response.data;
        })
        .catch(error => {
            console.log(error);
        })
        .finally(() => {
            isLoading.value = false;
        });
}

//リロード時オールの全アイテムが表示される
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
    isLoading.value = true
    searchTerm.value = ''
    axios.get('/item/world/1')
        .then(response => {
            items.value = response.data;
        })
        .catch(error => {
            console.log(error);
        })
        .finally(() => {
            isLoading.value = false;
        });
};

//ネザー
const setNetherTabClick = () => {
    isOverworldClick.value = false;
    isNetherTabClick.value = true;
    isEndTabClick.value = false;
    isAllTabClick.value = false;
    isLoading.value = true
    searchTerm.value = ''
    axios.get('/item/world/2')
        .then(response => {
            items.value = response.data;
        })
        .catch(error => {
            console.log(error);
        })
        .finally(() => {
            isLoading.value = false;
        });
};

//エンド
const setEndTabClick = () => {
    isOverworldClick.value = false;
    isNetherTabClick.value = false;
    isEndTabClick.value = true;
    isAllTabClick.value = false;
    isLoading.value = true
    searchTerm.value = ''
    //ネザーAPI
    axios.get('/item/world/3')
        .then(response => {
            items.value = response.data;
        })
        .catch(error => {
            console.log(error);
        })
        .finally(() => {
            isLoading.value = false;
        });
};

//オール
const setAllTabClick = () => {
    isOverworldClick.value = false;
    isNetherTabClick.value = false;
    isEndTabClick.value = false;
    isAllTabClick.value = true;
    isLoading.value = true
    searchTerm.value = ''
    //全アイテムAPI
    getAllitem()
};

//カテゴリーボタンを押した際に文字を入れる(初期は全アイテム一覧表示)
const categoryName = ref('全アイテム一覧');

//初期のcss状態(ALLカテゴリーボタン)
const currentCategory = ref(10);

//クリックしたものの引数をcurrentCategoryに入れてアイテム表示を変更する
const setCategory = (category) => {
    currentCategory.value = category;
    searchTerm.value = ''
    isLoading.value = true
    axios.get(`/item/categoly/${category}`)
        .then(response => {
            items.value = response.data;
        })
        .catch(error => {
            console.log(error);
        })
        .finally(() => {
            isLoading.value = false;
        });
    //categoryに応じてcategoryNameを設定
    switch (category) {
        case 1:
            categoryName.value = '建築';
            break;
        case 2:
            categoryName.value = '色付きブロック';
            break;
        case 3:
            categoryName.value = '天然ブロック';
            break;
        case 4:
            categoryName.value = '機能的ブロック';
            break;
        case 5:
            categoryName.value = 'レッドストーン';
            break;
        case 6:
            categoryName.value = '道具と実用';
            break;
        case 7:
            categoryName.value = '戦闘';
            break;
        case 8:
            categoryName.value = '食べ物と飲み物';
            break;
        case 9:
            categoryName.value = '材料';
            break;
        case 10:
            categoryName.value = '全アイテム一覧';
            break;
        case 11:
            categoryName.value = '保存アイテム一覧';
            break
        default:
            categoryName.value = '';
    }
};

// ユーザーの検索語を格納
const searchTerm = ref('');
// カーソルがアイテム画像にホバーした際のアイテム名を格納するリファレンス
const hoveredItem = ref(null)
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
                        <div :class="{ 'tab-click-left': isOverworldClick, 'tab-left': !isOverworldClick }">
                            <button @click="setOverworldClick(true)"
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
                        <div :class="{ 'tab-click': isAllTabClick, 'tab-right': !isAllTabClick }">
                            <button @click="setAllTabClick(true)"
                                :class="{ 'tab-world-click': isAllTabClick, 'tab-world': !isAllTabClick }">オール</button>
                        </div>
                    </div>
                    <!--カテゴリーボタン上部-->
                    <div class="tab-category-container">
                        <!--建築ブロックボタン-->
                        <div class="tab-category" @click="setCategory(1)">
                            <button
                                :class="{ 'btn-category-click': currentCategory === 1, 'btn-category': currentCategory !== 1 }">
                                <img src="./img/architecture/bricks.webp">
                            </button>
                        </div>
                        <!--色付きブロックボタン-->
                        <div class="tab-category" @click="setCategory(2)">
                            <button
                                :class="{ 'btn-category-click': currentCategory === 2, 'btn-category': currentCategory !== 2 }">
                                <img src="./img/colored/cyan_wool.webp">
                            </button>
                        </div>
                        <!--天然ブロックボタン-->
                        <div class="tab-category" @click="setCategory(3)">
                            <button
                                :class="{ 'btn-category-click': currentCategory === 3, 'btn-category': currentCategory !== 3 }">
                                <img src="./img/natural/grass_block.webp">
                            </button>
                        </div>
                        <!--機能的ブロックボタン-->
                        <div class="tab-category" @click="setCategory(4)">
                            <button
                                :class="{ 'btn-category-click': currentCategory === 4, 'btn-category': currentCategory !== 4 }">
                                <img src="./img/function/oak_sign.webp">
                            </button>
                        </div>
                        <!--レッドストーン-->
                        <div class="tab-category" @click="setCategory(5)">
                            <button
                                :class="{ 'btn-category-click': currentCategory === 5, 'btn-category': currentCategory !== 5 }">
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
                    <h1 class="title">{{ categoryName }}</h1>
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
                        <div class="tab-category-bottom" @click="setCategory(6)">
                            <button
                                :class="{ 'btn-category-bottom-click': currentCategory === 6, 'btn-category-bottom': currentCategory !== 6 }">
                                <img src="./img/tool/diamond_pickaxe.webp">
                            </button>
                        </div>
                        <div class="tab-category-bottom" @click="setCategory(7)">
                            <button
                                :class="{ 'btn-category-bottom-click': currentCategory === 7, 'btn-category-bottom': currentCategory !== 7 }">
                                <img src="./img/battle/netherite_sword.webp">
                            </button>
                        </div>
                        <div class="tab-category-bottom" @click="setCategory(8)">
                            <button
                                :class="{ 'btn-category-bottom-click': currentCategory === 8, 'btn-category-bottom': currentCategory !== 8 }">
                                <img src="./img/food/golden_apple.png">
                            </button>
                        </div>
                        <div class="tab-category-bottom" @click="setCategory(9)">
                            <button
                                :class="{ 'btn-category-bottom-click': currentCategory === 9, 'btn-category-bottom': currentCategory !== 9 }">
                                <img src="./img/material/iron_ingot.webp">
                            </button>
                        </div>
                        <div class="tab-category-bottom" @click="setCategory(10)">
                            <button
                                :class="{ 'btn-category-bottom-click': currentCategory === 10, 'btn-category-bottom': currentCategory !== 10 }">
                            </button>
                        </div>
                        <!--二つ分開ける-->
                        <div class="tab-category-bottom-blank"></div>
                        <div class="tab-category-bottom-blank"></div>
                        <!--ここまで-->
                        <div class="tab-category-bottom" @click="setCategory(11)">
                            <button
                                :class="{ 'btn-category-bottom-click': currentCategory === 11, 'btn-category-bottom': currentCategory !== 11 }">
                                <img src="">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <!--レシピデザイン待ち-->
                <div class="recipe">
                    <div class="recipe-inline">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>