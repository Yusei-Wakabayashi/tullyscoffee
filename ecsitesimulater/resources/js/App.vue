<script setup>
import { ref, onMounted, computed } from "vue";
import axios from "axios";

const isLoading = ref(true); //非同期処理の読み込み判定 (trueの間だけアニメーション表示)
const items = ref([]); //アイテム配列
const itemRecipeList = ref([]); //アイテムのレシピIDのリスト
const searchTerm = ref(""); // ユーザーの検索語を格納
const hoveredItem = ref(null); // カーソルがアイテム画像にホバーした際のアイテム名を格納するリファレンス
const itemRecipeNote = ref(""); //クラフトレシピの注意書き
const isOverworldClick = ref(false); //オーバーワールドボタン
const isNetherTabClick = ref(false); //ネザーワールドボタン
const isEndTabClick = ref(false); //エンドワールドボタン
const isAllTabClick = ref(true); //オールボタン

//初期の表示オールアイテム
const getAllitem = () => {
    axios
        .get("/item/start")
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

//リロード時オールの全アイテムが表示される
onMounted(() => {
    getAllitem();
});

//オーバーワールド
const setOverworldClick = () => {
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
    isOverworldClick.value = false;
    isNetherTabClick.value = false;
    isEndTabClick.value = false;
    isAllTabClick.value = true;
    isLoading.value = true;
    searchTerm.value = "";
    //全アイテムAPI
    getAllitem();
};

//カテゴリーボタンを押した際に文字を入れる(初期は全アイテム一覧表示)
const categoryName = ref("全アイテム一覧");

//初期のcss状態(ALLカテゴリーボタン)
const currentCategory = ref(10);

//クリックしたものの引数をcurrentCategoryに入れてアイテム表示を変更する
const setCategory = (category) => {
    currentCategory.value = category; //cssのデザイン変化
    searchTerm.value = "";
    isLoading.value = true;
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
    //categoryに応じてcategoryNameを設定
    switch (category) {
        case 1:
            categoryName.value = "建築";
            break;
        case 2:
            categoryName.value = "色付きブロック";
            break;
        case 3:
            categoryName.value = "天然ブロック";
            break;
        case 4:
            categoryName.value = "機能的ブロック";
            break;
        case 5:
            categoryName.value = "レッドストーン";
            break;
        case 6:
            categoryName.value = "道具と実用";
            break;
        case 7:
            categoryName.value = "戦闘";
            break;
        case 8:
            categoryName.value = "食べ物と飲み物";
            break;
        case 9:
            categoryName.value = "材料";
            break;
        case 10:
            categoryName.value = "全アイテム一覧";
            break;
        case 11:
            categoryName.value = "保存アイテム一覧";
            break;
        default:
            categoryName.value = "";
    }
};

//アイテム名検索(アイテム名)
const filtereditems = computed(() => {
    // データベース内のアイテム名を含むアイテムだけをフィルタリング
    return items.value.filter((item) => item.name.includes(searchTerm.value));
});

//画像をクリックしたときのレシピ表示処理
const itemRecipe = (item) => {
    isLoading.value = true;
    itemRecipeNote.value = item.note;
    const itemRecipeID = item.id;
    axios
        .get(`/item/recipesearch/${itemRecipeID}`)
        .then((response) => {
            console.log(itemRecipeID);
            itemRecipeList.value = response.data;
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => {
            isLoading.value = false;
        });

    /**axios.get(`/item/recipe/${i}`)
      .then(response => {
          itemRecipeList.value = response.data;
      })
      .catch(error => {
          console.log(error);
      })
      .finally(() => {
          isLoading.value = false;
      });  */
};
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
                <div>
                    <div class="main">
                        <div class="tab-container">
                            <!--オーバーワールドボタン-->
                            <div :class="{ 'tab-click-left': isOverworldClick, 'tab-left': !isOverworldClick, }">
                                <button @click="setOverworldClick(true)"
                                    :class="{ 'tab-world-click': isOverworldClick, 'tab-world': !isOverworldClick, }">
                                    オーバーワールド
                                </button>
                            </div>
                            <!--ネザーボタン-->
                            <div :class="{
                                'tab-click': isNetherTabClick,
                                tab: !isNetherTabClick,
                            }" @click="setNetherTabClick(true)">
                                <button :class="{
                                    'tab-world-click': isNetherTabClick,
                                    'tab-world': !isNetherTabClick,
                                }">
                                    ネザー
                                </button>
                            </div>
                            <!--エンドボタン-->
                            <div :class="{ 'tab-click': isEndTabClick, tab: !isEndTabClick }" @click="setEndTabClick(true)">
                                <button :class="{
                                    'tab-world-click': isEndTabClick,
                                    'tab-world': !isEndTabClick,
                                }">
                                    エンド
                                </button>
                            </div>
                            <!--オールボタン-->
                            <div :class="{
                                'tab-click': isAllTabClick,
                                'tab-right': !isAllTabClick,
                            }">
                                <button @click="setAllTabClick(true)" :class="{
                                    'tab-world-click': isAllTabClick,
                                    'tab-world': !isAllTabClick,
                                }">
                                    オール
                                </button>
                            </div>
                        </div>
                        <!--カテゴリーボタン上部-->
                        <div class="tab-category-container">
                            <!--建築ブロックボタン-->
                            <div class="tab-category" @click="setCategory(1)">
                                <button :class="{
                                    'btn-category-click': currentCategory === 1,
                                    'btn-category': currentCategory !== 1,
                                }">
                                    <img src="./img/architecture/bricks.webp" />
                                </button>
                            </div>
                            <!--色付きブロックボタン-->
                            <div class="tab-category" @click="setCategory(2)">
                                <button :class="{
                                    'btn-category-click': currentCategory === 2,
                                    'btn-category': currentCategory !== 2,
                                }">
                                    <img src="./img/colored/cyan_wool.webp" />
                                </button>
                            </div>
                            <!--天然ブロックボタン-->
                            <div class="tab-category" @click="setCategory(3)">
                                <button :class="{
                                    'btn-category-click': currentCategory === 3,
                                    'btn-category': currentCategory !== 3,
                                }">
                                    <img src="./img/natural/grass_block.webp" />
                                </button>
                            </div>
                            <!--機能的ブロックボタン-->
                            <div class="tab-category" @click="setCategory(4)">
                                <button :class="{
                                    'btn-category-click': currentCategory === 4,
                                    'btn-category': currentCategory !== 4,
                                }">
                                    <img src="./img/function/oak_sign.webp" />
                                </button>
                            </div>
                            <!--レッドストーン-->
                            <div class="tab-category" @click="setCategory(5)">
                                <button :class="{
                                    'btn-category-click': currentCategory === 5,
                                    'btn-category': currentCategory !== 5,
                                }">
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
                        <!--アイテム一覧-->
                        <h1 class="title">{{ categoryName }}</h1>
                        <div class="itemlist-inline">
                            <div class="vertical-scrollable-list">
                                <!--アイテム画像-->
                                <ul>
                                    <li v-for="(item, i) in filtereditems" :key="i" class="item-container">
                                        <!--アイテム画像-->
                                        <img @mouseover="hoveredItem = item.name" @mouseleave="hoveredItem = null"
                                            :src="item.pic" @click="itemRecipe(item)" />
                                        <!--アイテム名-->
                                        <div class="item-name" v-if="hoveredItem === item.name">
                                            {{ item.name }}
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="tab-category-container-bottom">
                            <!--道具と実用-->
                            <div class="tab-category-bottom" @click="setCategory(6)">
                                <button :class="{
                                    'btn-category-bottom-click': currentCategory === 6,
                                    'btn-category-bottom': currentCategory !== 6,
                                }">
                                    <img src="./img/tool/diamond_pickaxe.webp" />
                                </button>
                            </div>
                            <!--戦闘-->
                            <div class="tab-category-bottom" @click="setCategory(7)">
                                <button :class="{
                                    'btn-category-bottom-click': currentCategory === 7,
                                    'btn-category-bottom': currentCategory !== 7,
                                }">
                                    <img src="./img/battle/netherite_sword.webp" />
                                </button>
                            </div>
                            <!--食べ物と飲み物-->
                            <div class="tab-category-bottom" @click="setCategory(8)">
                                <button :class="{
                                    'btn-category-bottom-click': currentCategory === 8,
                                    'btn-category-bottom': currentCategory !== 8,
                                }">
                                    <img src="./img/food/golden_apple.png" />
                                </button>
                            </div>
                            <!--材料-->
                            <div class="tab-category-bottom" @click="setCategory(9)">
                                <button :class="{
                                    'btn-category-bottom-click': currentCategory === 9,
                                    'btn-category-bottom': currentCategory !== 9,
                                }">
                                    <img src="./img/material/iron_ingot.webp" />
                                </button>
                            </div>
                            <!--オール-->
                            <div class="tab-category-bottom" @click="setCategory(10)">
                                <button :class="{
                                    'btn-category-bottom-click': currentCategory === 10,
                                    'btn-category-bottom': currentCategory !== 10,
                                }">
                                    <img src="./web_png/all.png" />
                                </button>
                            </div>
                            <!--二つ分開ける-->
                            <div class="tab-category-bottom-blank"></div>
                            <div class="tab-category-bottom-blank"></div>
                            <!--ここまで-->
                            <!--保存-->
                            <div class="tab-category-bottom" @click="setCategory(11)">
                                <button :class="{
                                    'btn-category-bottom-click': currentCategory === 11,
                                    'btn-category-bottom': currentCategory !== 11,
                                }">
                                    <img src="./web_png/book.png" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <!--レシピデザイン待ち-->
                    <div class="recipe">
                        <div class="recipe-inline">
                            <div v-for="(recipe, i) in itemRecipeList" :key="i">
                                <!--クラフト不可レシピ-->
                                <div class="recipe-box" v-if="recipe.crafttable_id === 1">
                                    <ul>
                                        <li class="attention-img">
                                            <img src="./web_png/attention.png" alt="" />
                                        </li>
                                    </ul>
                                </div>
                                <!--作業台レシピ-->
                                <div class="recipe-box" v-if="recipe.crafttable_id === 2">
                                    <ul>
                                        <li>{{ recipe.item_id1 }}</li>
                                        <li>{{ recipe.item_id2 }}</li>
                                        <li>{{ recipe.item_id3 }}</li>
                                        <li>{{ recipe.item_id4 }}</li>
                                        <li>{{ recipe.item_id5 }}</li>
                                        <li>{{ recipe.item_id6 }}</li>
                                        <li>{{ recipe.item_id7 }}</li>
                                        <li>{{ recipe.item_id8 }}</li>
                                        <li>{{ recipe.item_id9 }}</li>
                                    </ul>
                                </div>
                                <!--醸造台レシピ-->
                                <div class="recipe-box" v-if="recipe.crafttable_id === 3">

                                </div>
                                <!--かまどレシピ-->
                                <div class="recipe-box" v-if="recipe.crafttable_id === 4">

                                </div>
                                <!--鍛冶台レシピ-->
                                <div class="recipe-box" v-if="recipe.crafttable_id === 5">

                                </div>

                                <div class="right-side">
                                    <div class="square-button">
                                        <button type="submit">
                                            <img src="./web_png/return.png" />
                                        </button>
                                    </div>

                                    <div class="arrow_img">
                                        <p class="square_triangle_arrow">
                                            <img class="image-container" src="" alt="" />
                                        </p>
                                    </div>

                                    <div class="button-container">
                                        <div class="out-button">
                                            <button class="button-left">保存</button>
                                        </div>

                                        <div class="out-button">
                                            <button class="button-right">削除</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--仮デザイン-->
                        <h3 style="color: white; background-color: black" v-if="itemRecipeNote">
                            ※{{ itemRecipeNote }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.attention-img {
    margin: 50px;
}
</style>