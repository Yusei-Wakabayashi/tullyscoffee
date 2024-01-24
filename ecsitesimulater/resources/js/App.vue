<script setup>
import { ref, computed, onMounted } from "vue";
import axios from "axios";

// 左側デザインコンポーネント
import WorldBtn from './components/left-design/WorldBtn.vue'; // ワールドボタン
import TopCategory from './components/left-design/TopCategory.vue'; // 上部カテゴリーボタン
import LoadingAnime from './components/left-design/LoadingAnime.vue'; // ローディングアニメーション
import CategoryName from './components/left-design/CategoryName.vue'; // カテゴリー名
import ItemList from './components/left-design/ItemList.vue'; // アイテム一覧
import BottomCategory from "./components/left-design/BottomCategory.vue"; // 下部カテゴリーボタン

//右側デザインコンポーネント
import NotCraft from './components/right-design/NotCraft.vue'; // クラフト不可
import SagyouCraft from './components/right-design/SagyouTable.vue'; // 作業台  
import BrewingTable from './components/right-design/BrewingTable.vue'; // 醸造台
import FurnaceTable from './components/right-design/FurnaceTable.vue'; // かまど
import BlacksmithTable from './components/right-design/BlacksmithTable.vue'; // 鍛冶台
import AttentionNote from './components/right-design/AttentionNote.vue'; // アイテム注意書き
import BackItem from "./components/right-design/BackItem.vue";
import ResultImg from './components/right-design/ResultImg.vue'; // クラフト結果画像
import KeepdeleteBtn from './components/right-design/KeepDelete.vue'; // 保存削除ボタン
import Multiplerecipe from "./components/right-design/Multiplerecipe.vue";

const items = ref([]); // アイテム配列
const currentCategory = ref(10); // 初期のcss状態(ALLカテゴリーボタン)
const isLoading = ref(true);  // 非同期処理の読み込み判定 (trueの間だけアニメーション表示)
const searchTerm = ref(""); // ユーザーの検索語を格納
const categoryName = ref("全アイテム一覧:"); // カテゴリーボタンを押した際に文字を入れる(初期は全アイテム一覧表示)
const isOverworldClick = ref(false); // オーバーワールドボタン
const isNetherTabClick = ref(false); // ネザーワールドボタン
const isEndTabClick = ref(false); // エンドワールドボタン
const isAllTabClick = ref(true); // オールボタン
const itemRecipeList = ref([]); // アイテムのレシピIDのリスト
const hoveredItem = ref(null); // カーソルがアイテム画像にホバーした際のアイテム名を格納するリファレンス
const hoveredItemRecipeName = ref(null);
const itemRecipeNote = ref(''); // クラフトレシピの注意書き
const itemRecipeGet = ref('') // クラフト不可のものの入手場所
const itemImgSrc = ref(''); // itemImgの値をセット
const itemNumGet = ref('')
const itemName = ref(''); // レシピの結果画像文字
const selectedItemClick = ref(null);
const itemBackList = ref([]) // 1つ前のアイテムレシピを入れる

//アイテム名比較
const filtereditems = computed(() => {
    // データベース内のアイテム名を含むアイテムだけをフィルタリング
    return items.value.filter((item) => item.name.includes(searchTerm.value));
});

//オーバーワールドアイテム
const getOverWorlditem = (category) => {
    axios
        .get(`/item/catwar/1/${category}`)
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
//ネザーワールドアイテム
const getNetheritem = (category) => {
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
}
//エンドワールドアイテム
const getEnditem = (category) => {
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
}
//オールアイテム
const getAllitem = (category) => {
    axios
        .get(`/item/catwar/4/${category}`)
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

// カテゴリー名のオブジェクト
const categoryNames = {
    1: "建築",
    2: "色付きブロック",
    3: "天然ブロック",
    4: "機能的ブロック",
    5: "レッドストーン",
    6: "道具と実用",
    7: "戦闘",
    8: "食べ物と飲み物",
    9: "材料",
    10: "全アイテム一覧",
};

//クリックしたものの引数をcurrentCategoryに入れてアイテム表示を変更する
const setCategory = (category) => {
    currentCategory.value = category; //cssのデザイン変化

    isLoading.value = true;
    if (isOverworldClick.value === true) {
        getOverWorlditem(category)
    } else if (isNetherTabClick.value === true) {
        getNetheritem(category)
    } else if (isEndTabClick.value === true) {
        getEnditem(category)
    } else if (isAllTabClick.value === true) {
        getAllitem(category)
    }

    //カテゴリー名を変更
    categoryName.value = categoryNames[category];
};

// 保存ボタンメソッド
const setCategoryKeep = () => {
    categoryName.value = "保存アイテム一覧";
    currentCategory.value = 11;
    getSavedItems();
    items.value = existingItems.value; // 保存されたアイテムだけを表示する
}

// 既存のローカルストレージ内データを取得
const existingItems = JSON.parse(localStorage.getItem("saved-Minecraft-Items")) || [];

// ローカルストレージから保存されたアイテムを取得するメソッド
const getSavedItems = () => {
    const savedItems = JSON.parse(localStorage.getItem("saved-Minecraft-Items")) || [];
    existingItems.value = savedItems;
};

//アイテム一覧から画像をクリックしたときのレシピ表示処理
const itemRecipe = (item) => {
    isLoading.value = true; // ローディング
    itemRecipeNote.value = item.note; // アイテムの注意書き
    itemRecipeGet.value = item.howtoget // クラフト不可のアイテムの入手方法
    itemName.value = item.name
    itemNumGet.value = item.order
    itemImgSrc.value = item.pic; //アイテム一覧の押したアイテム画像を入れる
    selectedItemClick.value = item // クリックされたときにitemを入れて保存メソッドで使う

    if (itemBackList.value.length > 0) {
        itemBackList.value = []
    }
    itemBackList.value.push(item)

    console.log(itemBackList.value)

    axios
        .get(`/item/recipesearch/${item.id}`)
        .then((response) => {
            itemRecipeList.value = response.data;
            console.log(response.data)
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => {
            isLoading.value = false;
        });
};

//アイテムレシピの中の画像をクリックしたときのレシピ表示処理
const itemRecipeBack = (item) => {
    isLoading.value = true;
    itemRecipeNote.value = item.note;
    itemRecipeGet.value = item.howtoget
    itemName.value = item.name
    itemNumGet.value = item.order
    itemImgSrc.value = item.pic;
    selectedItemClick.value = item

    itemBackList.value.push(item)// 一個前のアイテムレシピを入れていく
    console.log(itemBackList.value)
    axios
        .get(`/item/recipesearch/${item.id}`)
        .then((response) => {
            itemRecipeList.value = response.data;
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => {
            isLoading.value = false;
        });
};

// 押した時に一個前のレシピに戻るメソッド
const itemBack = () => {
    // itemBackList にアイテムがあるかどうかを確認
    if (itemBackList.value.length > 1) {
        // itemBackListの末尾からアイテムレシピを取り出す
        itemBackList.value.pop();
        const lastItem = itemBackList.value[itemBackList.value.length - 1]

        // lastItemが存在する場合
        if (lastItem) {
            isLoading.value = true;
            itemRecipeNote.value = lastItem.note;
            itemRecipeGet.value = lastItem.howtoget;
            itemName.value = lastItem.name;
            itemImgSrc.value = lastItem.pic;
            selectedItemClick.value = lastItem;
            itemNumGet.value = lastItem.order

            axios
                .get(`/item/recipesearch/${lastItem.id}`)
                .then((response) => {
                    itemRecipeList.value = response.data;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    isLoading.value = false;
                });
        }
    }
};

onMounted(() => {
    //リロード時オールの全アイテムが表示される
    getAllitem(10);
});

//ワールドコンポーネントで値をemitsで変更するためのもの
const UpdateLoading = (payload) => {
    categoryName.value = payload.categoryName
    currentCategory.value = payload.currentCategory
    isLoading.value = payload.isLoading;
    isAllTabClick.value = payload.isAllTabClick
    isNetherTabClick.value = payload.isNetherTabClick
    isEndTabClick.value = payload.isEndTabClick
    isOverworldClick.value = payload.isOverworldClick
    searchTerm.value = payload.searchTerm
}

//保存削除ボタンコンポーネントで値をemitsで変更するためのもの
const UpdateKeep = (keep) => {
    existingItems.value = keep.existingItems
    selectedItemClick.value = keep.selectedItemClick
    items.value = keep.items
}
</script>
 
<template>
    <div :class="{
        'whole-nether': isNetherTabClick,
        'whole-overworld': isOverworldClick,
        'whole-end': isEndTabClick,
        'whole-all': isAllTabClick,
    }">
        <!--タイトルロゴ画像-->
        <div class="title-rogo">
            <img src="../../public/web_png/05rogo.png" width="500" alt="" />
        </div>
        <div class="position">
            <div class="split">
                <!--左側デザイン-->
                <div class="main">
                    <!--ワールドボタン-->
                    <WorldBtn :isOverworldClick="isOverworldClick" :isNetherTabClick="isNetherTabClick"
                        :isEndTabClick="isEndTabClick" :isAllTabClick="isAllTabClick" :categoryName="categoryName"
                        :currentCategory="currentCategory" :isLoading="isLoading" :searchTerm="searchTerm"
                        :getAllitem="getAllitem" :getNetheritem="getNetheritem" :getEnditem="getEnditem"
                        :getOverWorlditem="getOverWorlditem" @update-category="UpdateLoading" />
                    <!--カテゴリー上部-->
                    <div class="tab-category-container">
                        <TopCategory :setCategory="setCategory" :currentCategory="currentCategory" :categoryNames="categoryNames" />
                        <!--検索ボックス-->
                        <input v-model="searchTerm" placeholder="検索 ．．．" />
                    </div>
                    <!--非同期の待ち時間アニメーション-->
                    <LoadingAnime :isLoading="isLoading" />
                    <!--カテゴリ名前-->
                    <CategoryName :categoryName="categoryName" :items="items" />
                    <!--アイテム一覧-->
                    <ItemList :filtereditems="filtereditems" :hoveredItem="hoveredItem" :itemRecipe="itemRecipe" />
                    <!--カテゴリーボタン下部-->
                    <BottomCategory :setCategoryKeep="setCategoryKeep" :setCategory="setCategory"
                        :currentCategory="currentCategory" :categoryNames="categoryNames" />
                </div>
            </div>
            <!--右側デザイン-->
            <div class="recipe">
                <div class="recipe-inline">
                    <div class="recipe-box">
                        <!--クラフト不可-->
                        <NotCraft :itemRecipeList="itemRecipeList" />
                        <!--作業台-->
                        <SagyouCraft :itemRecipeList="itemRecipeList" :hoveredItemRecipeName="hoveredItemRecipeName"
                            :itemRecipeBack="itemRecipeBack" />
                        <!--醸造台-->
                        <BrewingTable :itemRecipeList="itemRecipeList" :hoveredItemRecipeName="hoveredItemRecipeName"
                            :itemRecipeBack="itemRecipeBack" />
                        <!--かまど-->
                        <FurnaceTable :itemRecipeList="itemRecipeList" :hoveredItemRecipeName="hoveredItemRecipeName"
                            :itemRecipeBack="itemRecipeBack" />
                        <!--鍛冶台-->
                        <BlacksmithTable :itemRecipeList="itemRecipeList" :hoveredItemRecipeName="hoveredItemRecipeName"
                            :itemRecipeBack="itemRecipeBack" />
                        <!--レシピ右側-->
                        <div class="right-side" v-if="itemImgSrc">

                            <!--注意書き-->
                            <AttentionNote :itemRecipeNote="itemRecipeNote" />
                            <!--アイテムを戻るボタン-->
                            <BackItem :itemBackList="itemBackList" :itemBack="itemBack" />
                            <!--レシピ右側の画像-->
                            <ResultImg :itemImgSrc="itemImgSrc" :hoveredItem="hoveredItem" :itemName="itemName" :itemNumGet="itemNumGet" />
                            <!--保存、削除ボタン-->
                            <KeepdeleteBtn :existingItems="existingItems" :selectedItemClick="selectedItemClick"
                                @update-keep="UpdateKeep" :items="items" :getSavedItems="getSavedItems" />
                        </div>
                        <h3 style="color: red">{{ itemRecipeGet }}</h3>
                    </div>
                    <Multiplerecipe />
                </div>
            </div>
        </div>
    </div>
</template>