<script setup>
import WorldBtn from './components/WorldBtn.vue'
import RightDesign from './components/right-design/RightDesign.vue';

import { ref, computed, onMounted } from "vue";
import axios from "axios"

const items = ref([]);//アイテム配列
const currentCategory = ref(10);//初期のcss状態(ALLカテゴリーボタン)
const isLoading = ref(true); //非同期処理の読み込み判定 (trueの間だけアニメーション表示)
const searchTerm = ref("");//ユーザーの検索語を格納
const categoryName = ref("全アイテム一覧:");//カテゴリーボタンを押した際に文字を入れる(初期は全アイテム一覧表示)
const isOverworldClick = ref(false);//オーバーワールドボタン
const isNetherTabClick = ref(false);//ネザーワールドボタン
const isEndTabClick = ref(false);//エンドワールドボタン
const isAllTabClick = ref(true);//オールボタン
const itemRecipeList = ref([]);//アイテムのレシピIDのリスト
const hoveredItem = ref(null);//カーソルがアイテム画像にホバーした際のアイテム名を格納するリファレンス
const hoveredItemRecipeName = ref(null)
const hoveredItemRecipeNote = ref(null)
const itemRecipeNote = ref('');//クラフトレシピの注意書き
const itemGetNote = ref('')//クラフト不可のものの入手場所
const itemImgSrc = ref('')//itemImgの値をセット
const itemName = ref('')
const selectedItemClick = ref(null);
// 既存のローカルストレージ内データを取得
const existingItems = JSON.parse(localStorage.getItem("saved-Minecraft-Items")) || [];

//アイテム名検索(アイテム名)
const filtereditems = computed(() => {
    // データベース内のアイテム名を含むアイテムだけをフィルタリング
    return items.value.filter((item) => item.name.includes(searchTerm.value));
});

//初期の表示オールアイテム
const getAllitem = () => {
    axios
        .get("/item/world/4")
        .then((response) => {
            items.value = response.data;
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => {
            isLoading.value = false;
        });
};

//オーバーワールド
const setOverworldClick = () => {
    categoryName.value = "全アイテム一覧:";
    currentCategory.value = 10
    isOverworldClick.value = true;
    isNetherTabClick.value = false;
    isEndTabClick.value = false;
    isAllTabClick.value = false;
    isLoading.value = true;
    searchTerm.value = "";
    axios
        .get("/item/world/1")
        .then((response) => {
            items.value = response.data;
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => {
            isLoading.value = false;
        });
};

//ネザー
const setNetherTabClick = () => {
    categoryName.value = "全アイテム一覧:";
    currentCategory.value = 10
    isOverworldClick.value = false;
    isNetherTabClick.value = true;
    isEndTabClick.value = false;
    isAllTabClick.value = false;
    isLoading.value = true;
    searchTerm.value = "";
    axios
        .get("/item/world/2")
        .then((response) => {
            items.value = response.data;
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => {
            isLoading.value = false;
        });
};

//エンド
const setEndTabClick = () => {
    categoryName.value = "全アイテム一覧:";
    currentCategory.value = 10
    isOverworldClick.value = false;
    isNetherTabClick.value = false;
    isEndTabClick.value = true;
    isAllTabClick.value = false;
    isLoading.value = true;
    searchTerm.value = "";
    axios
        .get("/item/world/3")
        .then((response) => {
            items.value = response.data;
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => {
            isLoading.value = false;
        });
};

//オール
const setAllTabClick = () => {
    categoryName.value = "全アイテム一覧:";
    currentCategory.value = 10
    isOverworldClick.value = false;
    isNetherTabClick.value = false;
    isEndTabClick.value = false;
    isAllTabClick.value = true;
    isLoading.value = true;
    searchTerm.value = "";
    //全アイテムAPI
    getAllitem();
};

//クリックしたものの引数をcurrentCategoryに入れてアイテム表示を変更する
const setCategory = (category) => {
    currentCategory.value = category; //cssのデザイン変化
    searchTerm.value = "";
    isLoading.value = true;
    if (isOverworldClick.value === true) {
        axios
            .get(`/item/catwar/1/${category}`)
            .then((response) => {
                console.log(category)
                items.value = response.data;
            })
            .catch((error) => {
                console.log(error);
            })
            .finally(() => {
                isLoading.value = false;
            });
    } else if (isNetherTabClick.value === true) {
        axios
            .get(`/item/catwar/2/${category}`)
            .then((response) => {
                items.value = response.data;
            })
            .catch((error) => {
                console.log(error);
            })
            .finally(() => {
                isLoading.value = false;
            });
    } else if (isEndTabClick.value === true) {
        axios
            .get(`/item/catwar/3/${category}`)
            .then((response) => {
                items.value = response.data;
            })
            .catch((error) => {
                console.log(error);
            })
            .finally(() => {
                isLoading.value = false;
            });
    } else if (isAllTabClick.value === true) {
        axios
            .get(`/item/categoly/${category}`)
            .then((response) => {
                items.value = response.data;
            })
            .catch((error) => {
                console.log(error);
            })
            .finally(() => {
                isLoading.value = false;
            });
    }
    //categoryに応じてcategoryNameを設定
    switch (category) {
        case 1:
            categoryName.value = "建築:";
            break;
        case 2:
            categoryName.value = "色付きブロック:";
            break;
        case 3:
            categoryName.value = "天然ブロック:";
            break;
        case 4:
            categoryName.value = "機能的ブロック:";
            break;
        case 5:
            categoryName.value = "レッドストーン:";
            break;
        case 6:
            categoryName.value = "道具と実用:";
            break;
        case 7:
            categoryName.value = "戦闘:";
            break;
        case 8:
            categoryName.value = "食べ物と飲み物:";
            break;
        case 9:
            categoryName.value = "材料:";
            break;
        case 10:
            categoryName.value = "全アイテム一覧:";
            break;
        default:
            categoryName.value = "";
    }
};

// 保存ボタンメソッド
const setCategoryKeep = () => {
    categoryName.value = "保存アイテム一覧:";
    currentCategory.value = 11;
    getSavedItems();
    items.value = existingItems.value; // 保存されたアイテムだけを表示する
}

//画像をクリックしたときのレシピ表示処理
const itemRecipe = (item) => {
    isLoading.value = true;
    itemRecipeNote.value = item.note;
    itemGetNote.value = item.howtoget;
    const itemId = item.id;
    const itemImg = item.pic
    itemName.value = item.name
    itemImgSrc.value = itemImg; //アイテム一覧の押したアイテム画像を入れる
    selectedItemClick.value = item // クリックされたときにitemを入れて保存メソッドで使う
    axios
        .get(`/item/recipesearch/${itemId}`)
        .then((response) => {
            console.log(response.data)
            itemRecipeList.value = response.data;
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => {
            isLoading.value = false;
        });
};

// アイテムの保存メソッド
const keepItemBtn = () => {

    // 同じアイテムが既に保存されているか確認
    const isAlreadySaved = existingItems.some((item) => {
        return item.name === selectedItemClick.value.name;
    });

    // ローカルストレージに保存
    localStorage.setItem("saved-Minecraft-Items", JSON.stringify(existingItems));

    // アイテムがまだ保存されていない場合追加
    if (!isAlreadySaved) {
        // アイテムを保存
        existingItems.unshift(selectedItemClick.value);
        localStorage.setItem("saved-Minecraft-Items", JSON.stringify(existingItems));
    }
};

// アイテムの削除メソッド
const deleteItemBtn = () => {

    // クリックされたアイテムのIDを取得
    const clickItemId = selectedItemClick.value.id;

    // clickItemIdと異なるidを持つ要素だけを残す。一致したものは消す
    const deleteItem = existingItems.filter((item) => item.id !== clickItemId);

    // ローカルストレージに保存
    localStorage.setItem("saved-Minecraft-Items", JSON.stringify(deleteItem));

    window.location.reload();

    // アイテムが正常に削除された場合にのみページをリロードして保存画面のまま表示
    if (existingItems.length - 1) {
        window.location.reload();
    }
};

// ローカルストレージから保存されたアイテムを取得するメソッド
const getSavedItems = () => {
    const savedItems = JSON.parse(localStorage.getItem("saved-Minecraft-Items")) || [];
    existingItems.value = savedItems;
};



onMounted(() => {

    //リロード時オールの全アイテムが表示される
    getAllitem();

    // 保存ボタンが押されているときにsetSavedItems()を呼び出して表示
    if (currentCategory.value === 11) {
        getSavedItems();
    }
});
</script>
 
<template>
    <div :class="{
        'whole-nether': isNetherTabClick,
        'whole-overworld': !isNetherTabClick,
        'whole-end': isEndTabClick,
        'whole-all': isAllTabClick,
    }">
        <!--タイトルロゴ画像-->
        <div class="title-rogo">
            <img src="./web_png/05rogo.png" width="500" alt="" />
        </div>
        <div class="position">
            <div class="split">
                <!--左側デザイン-->
                <div class="main">
                    <!--ワールドボタン-->
                    <WorldBtn :isOverworldClick="isOverworldClick" :isNetherTabClick="isNetherTabClick"
                        :isEndTabClick="isEndTabClick" :isAllTabClick="isAllTabClick" :setOverworldClick="setOverworldClick"
                        :setNetherTabClick="setNetherTabClick" :setEndTabClick="setEndTabClick"
                        :setAllTabClick="setAllTabClick" />


                    <!--カテゴリーボタン上部-->
                    <div class="tab-category-container">
                        <!--建築ブロックボタン-->
                        <div class="tab-category">
                            <button @click="setCategory(1)"
                                :class="{ 'btn-category-click': currentCategory === 1, 'btn-category': currentCategory !== 1, }">
                                <img src="./img/architecture/bricks.webp" />
                            </button>
                        </div>
                        <!--色付きブロックボタン-->
                        <div class="tab-category">
                            <button @click="setCategory(2)"
                                :class="{ 'btn-category-click': currentCategory === 2, 'btn-category': currentCategory !== 2, }">
                                <img src="./img/colored/cyan_wool.webp" />
                            </button>
                        </div>
                        <!--天然ブロックボタン-->
                        <div class="tab-category">
                            <button @click="setCategory(3)"
                                :class="{ 'btn-category-click': currentCategory === 3, 'btn-category': currentCategory !== 3, }">
                                <img src="./img/natural/grass_block.webp" />
                            </button>
                        </div>
                        <!--機能的ブロックボタン-->
                        <div class="tab-category">
                            <button @click="setCategory(4)"
                                :class="{ 'btn-category-click': currentCategory === 4, 'btn-category': currentCategory !== 4, }">
                                <img src="./img/function/oak_sign.webp" />
                            </button>
                        </div>
                        <!--レッドストーン-->
                        <div class="tab-category">
                            <button @click="setCategory(5)"
                                :class="{ 'btn-category-click': currentCategory === 5, 'btn-category': currentCategory !== 5, }">
                                <img src="./img/redstone/redstone.png" />
                            </button>
                        </div>
                        <!--検索ボックス-->
                        <input v-model="searchTerm" placeholder="検索" />
                    </div>
                    <!--非同期の待ち時間アニメーション-->
                    <div v-show="isLoading" class="loading-animation">
                        <h1>Now Loading<span class="loading-dots"></span></h1>
                    </div>
                    <!--カテゴリ名前-->
                    <h1 class="title">
                        {{ categoryName }}
                        {{ items.length }}アイテム
                    </h1>
                    <!--アイテム一覧-->
                    <div class="itemlist-inline">
                        <div class="vertical-scrollable-list">
                            <ul>
                                <li v-for="(item, i) in filtereditems" :key="i" class="item-container">
                                    <!--アイテム画像-->
                                    <img class="item-img" @mouseover="hoveredItem = i" @mouseleave="hoveredItem = null"
                                        :src="item.pic" @click="itemRecipe(item)" />
                                    <!--アイテム名-->
                                    <div class="item-name" v-if="hoveredItem === i">
                                        {{ item.name }}
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--カテゴリーボタン下部-->
                    <div>
                        <div class="tab-category-container-bottom">
                            <!--道具と実用-->
                            <div class="tab-category-bottom">
                                <button @click="setCategory(6)"
                                    :class="{ 'btn-category-bottom-click': currentCategory === 6, 'btn-category-bottom': currentCategory !== 6, }">
                                    <img src="./img/tool/diamond_pickaxe.webp" />
                                </button>
                            </div>
                            <!--戦闘-->
                            <div class="tab-category-bottom">
                                <button @click="setCategory(7)"
                                    :class="{ 'btn-category-bottom-click': currentCategory === 7, 'btn-category-bottom': currentCategory !== 7, }">
                                    <img src="./img/battle/netherite_sword.webp" />
                                </button>
                            </div>
                            <!--食べ物と飲み物-->
                            <div class="tab-category-bottom">
                                <button @click="setCategory(8)"
                                    :class="{ 'btn-category-bottom-click': currentCategory === 8, 'btn-category-bottom': currentCategory !== 8, }">
                                    <img src="./img/food/golden_apple.png" />
                                </button>
                            </div>
                            <!--材料-->
                            <div class="tab-category-bottom">
                                <button @click="setCategory(9)"
                                    :class="{ 'btn-category-bottom-click': currentCategory === 9, 'btn-category-bottom': currentCategory !== 9, }">
                                    <img src="./img/material/iron_ingot.webp" />
                                </button>
                            </div>
                            <!--オール-->
                            <div class="tab-category-bottom">
                                <button @click="setCategory(10)"
                                    :class="{ 'btn-category-bottom-click': currentCategory === 10, 'btn-category-bottom': currentCategory !== 10, }">
                                    <img src="./web_png/all.png" />
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
                                    <img src="./web_png/book.png" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <!--右側デザイン-->
                <RightDesign :itemRecipeList="itemRecipeList" :hoveredItemRecipeName="hoveredItemRecipeName"
                    :itemRecipe="itemRecipe" :itemImgSrc="itemImgSrc" :itemRecipeNote="itemRecipeNote" :itemName="itemName"
                    :keepItemBtn="keepItemBtn" :deleteItemBtn="deleteItemBtn" :hoveredItem="hoveredItem"
                    :hoveredItemRecipeNote="hoveredItemRecipeNote" />
            </div>
        </div>
    </div>
</template>