<script setup>
import { ref, computed, onMounted } from "vue";
import axios from "axios"

// 左側デザインコンポーネント
import WorldBtn from './components/left-design/WorldBtn.vue'; // ワールドボタン
import TopCategory from './components/left-design/TopCategory.vue' // 上部カテゴリーボタン
import LoadingAnime from './components/left-design/LoadingAnime.vue' // ローディングアニメーション
import CategoryName from './components/left-design/CategoryName.vue' // カテゴリー名
import ItemList from './components/left-design/ItemList.vue' // アイテム一覧
import BottomCategory from "./components/left-design/BottomCategory.vue"; // 下部カテゴリーボタン

//右側デザインコンポーネント
import NotCraft from './components/right-design/NotCraft.vue' // クラフト不可
import SagyouCraft from './components/right-design/SagyouTable.vue'; // 作業台
import BrewingTable from './components/right-design/BrewingTable.vue'; // 醸造台
import FurnaceTable from './components/right-design/FurnaceTable.vue'; // かまど
import BlacksmithTable from './components/right-design/BlacksmithTable.vue' // 鍛冶台
import AttentionNote from './components/right-design/AttentionNote.vue' // アイテム注意書き
import BackBtn from './components/right-design/BackItem.vue' // アイテムレシピ戻るボタン
import ResultImg from './components/right-design/ResultImg.vue'; // クラフト結果画像
import KeepdeleteBtn from './components/right-design/keepdeleteBtn.vue' // 保存削除ボタン

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
const hoveredItemRecipeName = ref(null)
const itemRecipeNote = ref(''); // クラフトレシピの注意書き
const itemGetNote = ref('') // クラフト不可のものの入手場所
const itemImgSrc = ref('') // itemImgの値をセット
const itemName = ref('') // レシピの結果画像文字
const selectedItemClick = ref(null);

//アイテム名検索(アイテム名)
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

//クリックしたものの引数をcurrentCategoryに入れてアイテム表示を変更する
const setCategory = (category) => {
    currentCategory.value = category; //cssのデザイン変化
    searchTerm.value = "";
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

    console.log(item)
    axios
        .get(`/item/recipesearch/${itemId}`)
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

// 既存のローカルストレージ内データを取得
const existingItems = JSON.parse(localStorage.getItem("saved-Minecraft-Items")) || [];

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
    getAllitem(10);
});

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
                        <TopCategory :setCategory="setCategory" :currentCategory="currentCategory" />
                        <!--検索ボックス-->
                        <input v-model="searchTerm" placeholder="検索" />
                    </div>
                    <!--非同期の待ち時間アニメーション-->
                    <LoadingAnime :isLoading="isLoading" />
                    <!--カテゴリ名前-->
                    <CategoryName :categoryName="categoryName" :items="items" />
                    <!--アイテム一覧-->
                    <ItemList :filtereditems="filtereditems" :hoveredItem="hoveredItem" :itemRecipe="itemRecipe" />
                    <!--カテゴリーボタン下部-->
                    <BottomCategory :setCategoryKeep="setCategoryKeep" :setCategory="setCategory"
                        :currentCategory="currentCategory" />
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
                            :itemRecipe="itemRecipe" />
                        <!--醸造台-->
                        <BrewingTable :itemRecipeList="itemRecipeList" :hoveredItemRecipeName="hoveredItemRecipeName" />
                        <!--かまど-->
                        <FurnaceTable :itemRecipeList="itemRecipeList" :hoveredItemRecipeName="hoveredItemRecipeName" />
                        <!--鍛冶台-->
                        <BlacksmithTable :itemRecipeList="itemRecipeList" :hoveredItemRecipeName="hoveredItemRecipeName" />
                        <!--レシピ右側-->
                        <div class="right-side" v-if="itemImgSrc">
                            <!--後でこのあたりにitemGetNoteを追加する-->
                            <!--注意書き-->
                            <AttentionNote :itemRecipeNote="itemRecipeNote" />
                            <!--アイテムを戻るボタン-->
                            <BackBtn />
                            <!--レシピ右側の画像-->
                            <ResultImg :itemImgSrc="itemImgSrc" :hoveredItem="hoveredItem" :itemName="itemName" />
                            <!--保存、削除ボタン-->
                            <KeepdeleteBtn :keepItemBtn="keepItemBtn" :deleteItemBtn="deleteItemBtn" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>