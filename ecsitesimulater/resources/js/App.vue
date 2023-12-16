<script setup>
import Index from './store/index.js'
import SearchBox from './components/SearchBox.vue';
import { onMounted } from "vue";

const { items,
    currentCategory,
    isLoading,
    searchTerm,
    categoryName,
    isOverworldClick,
    isNetherTabClick,
    isEndTabClick,
    isAllTabClick,
    itemRecipeList,
    hoveredItem,
    hoveredItemRecipeName,
    itemRecipeNote,
    itemImgSrc,
    itemName,
    selectedItemClick,
    existingItems,
    filtereditems,
    getAllitem,
    setOverworldClick,
    setNetherTabClick,
    setEndTabClick,
    setAllTabClick,
    setCategory,
    setCategoryKeep,
    itemRecipe,
    keepItemBtn,
    deleteItemBtn,
    getSavedItems } = Index()


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
                        <!--検索ボックスコンポーネント-->
                        <SearchBox v-model="searchTerm" />
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
                            <div class="tab-category-bottom" @click="setCategoryKeep()">
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
            </div>
            <div>
                <!--右側デザイン-->
                <div class="recipe">
                    <div class="recipe-inline">
                        <div class="recipe-box">
                            <!--クラフト不可-->
                            <div v-if="itemRecipeList[0]?.craft_num === 1">
                                <ul>
                                    <li class="attention-img" v-for="(recipe, i) in itemRecipeList[0].recipes" :key="i">
                                        <img :src="recipe" alt="">
                                    </li>
                                </ul>
                            </div>
                            <!--作業台-->
                            <div v-if="itemRecipeList[0]?.craft_num === 2">
                                <ul class="sagyou-ul">
                                    <li class="sagyou-li" v-for="(recipe, i) in itemRecipeList[0].recipes" :key="i">
                                        <img class="item-img" :src="recipe?.pic" @mouseover="hoveredItemRecipeName = i"
                                            @mouseleave="hoveredItemRecipeName = null" @click="itemRecipe(recipe)"
                                            width="49">

                                        <!-- アイテム名 -->
                                        <div class="item-name-recipe" v-if="hoveredItemRecipeName === i">
                                            {{ recipe?.name }}
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!--醸造台-->
                            <div v-if="itemRecipeList[0]?.craft_num === 3">
                                <ul>
                                    <li v-for="(recipe, i) in itemRecipeList[0].recipes" :key="i">
                                        <img :src="recipe.pic" @mouseover="hoveredItemRecipeName = i"
                                            @mouseleave="hoveredItemRecipeName = null">

                                        <!-- アイテム名 -->
                                        <div class="item-name-recipe" v-if="hoveredItemRecipeName === i">
                                            {{ recipe.name }}
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!--かまど-->
                            <div class="kamado" v-if="itemRecipeList[0]?.craft_num === 4">
                                <ul class="kamado-ul">
                                    <li v-for="(recipe, i) in itemRecipeList[0].recipes" :key="i">
                                        <img :src="recipe.pic" @mouseover="hoveredItemRecipeName = i"
                                            @mouseleave="hoveredItemRecipeName = null">

                                        <!-- アイテム名 -->
                                        <div class="item-name-recipe" v-if="hoveredItemRecipeName === i">
                                            {{ recipe.name }}
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!--鍛冶台-->
                            <div class="kaji" v-if="itemRecipeList[0]?.craft_num === 5">
                                <ul class="kaji-ul">
                                    <li class="kaji-li" v-for="(recipe, i) in itemRecipeList[0].recipes" :key="i">
                                        <img class="item-img" :src="recipe?.pic" @mouseover="hoveredItemRecipeName = i"
                                            @mouseleave="hoveredItemRecipeName = null" width="49">

                                        <!-- アイテム名 -->
                                        <div class="item-name-recipe" v-if="hoveredItemRecipeName === i">
                                            {{ recipe?.name }}
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <!--レシピの右側デザイン-->
                            <div class="right-side" v-if="itemImgSrc">
                                <!--注意書き-->
                                <div class="box" @mouseover="hoveredItem = itemRecipeNote" @mouseleave="hoveredItem = null">
                                    ?
                                    <div class="item-name-note" v-if="hoveredItem === itemRecipeNote">
                                        {{ itemRecipeNote }}
                                    </div>
                                </div>
                                <!--矢印ボタン-->
                                <div class="square-button">
                                    <button type="submit">
                                        <img src="./web_png/return.png" />
                                    </button>
                                </div>
                                <!--レシピ右側の画像-->
                                <div class="arrow_img">
                                    <div class="square_triangle_arrow">
                                        <img class="image-container" :src="itemImgSrc" @mouseover="hoveredItem = itemName"
                                            @mouseleave="hoveredItem = null" />
                                        <div class="item-name" v-if="hoveredItem === itemName">
                                            {{ itemName }}
                                        </div>
                                    </div>
                                </div>
                                <!--保存、削除ボタン-->
                                <div class="button-container">
                                    <div class="out-button">
                                        <button class="button-left" @click="keepItemBtn()">保存</button>
                                    </div>
                                    <div class="out-button">
                                        <button class="button-right" @click="deleteItemBtn()">削除</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>