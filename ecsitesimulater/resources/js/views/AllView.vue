<script setup>
import { ref, onMounted, computed } from 'vue';

//非同期処理の読み込み判定
const isLoading = ref(true);
//アイテム配列
const items = ref([]);
const savedBtnDisabled = ref(false)

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

// 選択したアイテムのID
const selectedItemId = ref(null);
//アイテムレシピを非表示にする
const showText = ref(false);
//アイテム画像を押した際に選択されたアイテムIDと一致したものを表示させる
const showItemDetails = (item) => {
    showText.value = true;
    selectedItemId.value = item.id;
}

//カテゴリーボタン
const buttons = ref([
    { id: 1, name: '建築' },
    { id: 2, name: '色付きブロック' },
    { id: 3, name: '天然ブロック' },
    { id: 4, name: '機能' },
    { id: 5, name: 'レッドストーン' },
    { id: 6, name: '道具と実用' },
    { id: 7, name: '戦闘' },
    { id: 8, name: '食べ物と飲み物' },
    { id: 9, name: '材料' },
]);

//カテゴリーボタンを押した際に文字を入れる(初期は全アイテム一覧表示)
const categoryName = ref('全アイテム一覧');
//カテゴリーボタンクリック時処理
const buttonClick = (id) => {
    //ボタンを押したときにisLoadingをtrueに戻してアニメーション表表示
    isLoading.value = true
    axios.get(`/item/categoly/${id}`)//API URL
        //通信成功時処理
        .then(response => {
            items.value = response.data;
            //buttonsのidと引数のidが一致した場合nameをcategoryNameに表示
            const button = buttons.value.find(button => button.id === id);
            if (button) {
                categoryName.value = button.name;
            }
        })
        //通信失敗時処理
        .catch(error => {
            console.log(error);
        })
        //非同期の処理待ちの処理
        .finally(() => {
            isLoading.value = false; // データ読み込み完了を示す
        });

    //カテゴリーボタンを押したとき検索boxの文字を消す
    searchTerm.value = ''
};

//カテゴリーボタン(全アイテム一覧)
const allItem = () => {
    //ボタンを押したときにisLoadingをtrueに戻してアニメーション表表示
    isLoading.value = true;
    //アイテムAPI
    getAllitem();
    //カテゴリーボタンを押したとき検索boxの文字を消す
    searchTerm.value = ''
    //カテゴリーボタンを押したとき文字を表示
    categoryName.value = '全アイテム一覧';
}

//カテゴリーボタン(保存アイテム一覧)
const keepItem = () => {
    //カテゴリーボタンを押したとき検索boxの文字を消す
    searchTerm.value = ''
    //カテゴリーボタンを押したとき文字を表示
    categoryName.value = '保存アイテム一覧';
}

//ローカルストレージに保存する処理(保存ボタン)
const saveItemToLocalStorage = (item) => {
    savedBtnDisabled.value = true
  // ローカルストレージに保存するアイテムのキーを定義
  const localStorageKey = 'allSavedItems';
  // ローカルストレージから既存の保存アイテムを取得
  const savedItems = JSON.parse(localStorage.getItem(localStorageKey)) || [];
  // アイテムを一つ追加
  savedItems.push(item);
  // アイテムをJSON形式に変換してローカルストレージに保存
  localStorage.setItem(localStorageKey, JSON.stringify(savedItems));
};

const saved = () => {
    
}
</script>

<template>
    <h1>オール</h1>

    <!--カテゴリーボタン-->
    <div>
        <button v-for="(button, i) in buttons" :key="i" @click="buttonClick(button.id)">{{ button.name }}</button>
        <button @click="allItem()">全アイテム一覧</button>
        <button @click="keepItem()">保存アイテム一覧</button>
    </div>

    <!--アイテム検索-->
    <input v-model="searchTerm" placeholder="アイテム名検索">

    <!--押したカテゴリーボタンの名前-->
    <h2>{{ categoryName }}</h2>

    <!--非同期の待ち時間アニメーション-->
    <div v-show="isLoading" class="loading-animation">
        <h1>Now Loading...</h1>
    </div>

    <ul class="horizontal-list">
        <!--アイテム一覧-->
        <li v-for="(item, i) in filtereditems" :key="i">
            <!--アイテム画像-->
            <img @click="showItemDetails(item)" @mouseover="hoveredItem = item.name" @mouseleave="hoveredItem = null"
                :src="item.pic">
            <!--アイテムの名前-->
            <span class="itemName" v-if="hoveredItem === item.name">{{ item.name }}</span>
            <!--アイテムレシピ-->
            <div v-if="showText && selectedItemId === item.id">
                <table>
                    <tr>
                        <td>{{ item.item_id1 }}</td>
                        <td>{{ item.item_id2 }}</td>
                        <td>{{ item.item_id3 }}</td>
                    </tr>
                    <tr>
                        <td>{{ item.item_id4 }}</td>
                        <td>{{ item.item_id5 }}</td>
                        <td>{{ item.item_id6 }}</td>
                        <td>➡</td>
                        <td><img :src="item.pic"></td>
                    </tr>
                    <tr>
                        <td>{{ item.item_id7 }}</td>
                        <td>{{ item.item_id8 }}</td>
                        <td>{{ item.item_id9 }}</td>
                    </tr>
                </table>
                <button @click="saveItemToLocalStorage(item)" :disabled="savedBtnDisabled">保存</button>
                <button>削除</button>
                <p class="note">{{ item.note }}</p>
            </div>
        </li>
    </ul>
</template>

<style>
table tr td {
    border: 2px solid black;
    padding: 20px;
}

.note {
    background-color: rgb(166, 166, 166);
}

.itemName{
    background-color: rgb(180, 180, 180);
}

.loading-animation {
    /**background-color: rgba(255, 255, 255, 0.8);**/
    background-image: url(../img/load/loading.jpg);
    color: white;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}
</style>