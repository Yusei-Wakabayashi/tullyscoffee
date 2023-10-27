<script setup>
import { ref, onMounted, computed } from 'vue';

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
    { id: 1, name: '建築', pic: '/img/architecture/bricks.webp' },
    { id: 2, name: '色付きブロック', pic: '/img/colored/cyan_wool.webp' },
    { id: 3, name: '天然ブロック', pic: '/img/natural/grass_block.webp' },
    { id: 4, name: '機能', pic: '/img/function/oak_sign.webp' },
    { id: 5, name: 'レッドストーン', pic: '/img/redstone/redstone.png' },
    { id: 6, name: '道具と実用', pic: 'img/tool/diamond_pickaxe.webp' },
    { id: 7, name: '戦闘', pic: 'img/battle/netherite_sword.webp' },
    { id: 8, name: '食べ物と飲み物', pic: 'img/food/golden_apple.png' },
    { id: 9, name: '材料', pic: 'img/material/iron_ingot.webp' },
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
            //buttonsのidと引数のidが一致した部分のnameをcategoryNameに表示
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

const save = ref('保存')
//カテゴリーボタン(保存アイテム一覧)
const keepItem = () => {
    //カテゴリーボタンを押したとき検索boxの文字を消す
    searchTerm.value = ''
    //カテゴリーボタンを押したとき文字を表示
    categoryName.value = '保存アイテム一覧';
}




//ローカルストレージに保存する処理(保存ボタン)
const saveItemToLocalStorage = (item) => {
    save.value = '保存済み'
    //ローカルストレージに保存するアイテムのキーを定義
    const localStorageKey = 'allSavedItems';
    //ローカルストレージから既存の保存アイテムを取得
    const savedItems = JSON.parse(localStorage.getItem(localStorageKey));
    //アイテムを一つ追加
    savedItems.push(item);
    //アイテムをJSON形式に変換してローカルストレージに保存
    localStorage.setItem(localStorageKey, JSON.stringify(savedItems));
};

//保存を押したときに保存済みに変わる
const SaveButtonDisabled = computed(() => {
    return save.value === '保存済み';
});

//ローカルストレージから削除する処理(削除ボタン)
const removeItemFromLocalStorage = (item) => {
    const localStorageKey = 'allSavedItems';
    //ローカルストレージから既存の保存アイテムを取得
    const savedItems = JSON.parse(localStorage.getItem(localStorageKey));
    //アイテムを削除
    const updatedItems = savedItems.filter(savedItem => savedItem.id !== item.id);
    //アイテムをJSON形式に変換してローカルストレージに保存
    localStorage.setItem(localStorageKey, JSON.stringify(updatedItems));
    //削除を押したら保存済みから保存に戻る
    if (updatedItems) {
        save.value = '保存'
    }
}

</script>

<template>
    <div class="all">

        <div class="world">
            <button><router-link to="/overWorld">オーバーワールド</router-link></button>
            <button><router-link to="/nether">ネザー</router-link></button>
            <button><router-link to="/end">エンド</router-link></button>
            <button><router-link to="/">オール</router-link></button>
            <router-view />
        </div>
        <h1>オール</h1>
        <!--カテゴリーボタン-->
        <div>
            <button class="btn" v-for="(button, i) in buttons" :key="i" @click="buttonClick(button.id)">
                <img :src="button.pic" width="50">
            </button>
            <button class="btn" @click="allItem()">全アイテム一覧</button>
            <button class="btn" @click="keepItem()">保存アイテム一覧</button>
        </div>

        <!--アイテム検索-->
        <input class="search" v-model="searchTerm" placeholder="アイテム名検索">

        <!--押したカテゴリーボタンの名前-->
        <h2>{{ categoryName }}</h2>

        <!--非同期の待ち時間アニメーション-->
        <div v-show="isLoading" class="loading-animation">
            <h1>Now Loading<span class="loading-dots"></span></h1>
        </div>

        <div class="item-list">
            <div class="item" v-for="(item, i) in filtereditems" :key="i">
                <div @click="showItemDetails(item)" class="item-container">
                    <!--アイテム画像-->
                    <img @mouseover="hoveredItem = item.name" @mouseleave="hoveredItem = null" :src="item.pic">
                    <!--アイテム名-->
                    <div class="item-name" v-if="hoveredItem === item.name">{{ item.name }}</div>
                </div>
                <!--アイテムレシピ-->
                <div class="recipe" v-if="showText && selectedItemId === item.id">
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
                            <img :src="item.pic">
                        </tr>
                        <tr>
                            <td>{{ item.item_id7 }}</td>
                            <td>{{ item.item_id8 }}</td>
                            <td>{{ item.item_id9 }}</td>
                        </tr>
                    </table>
                    <!--保存ボタン-->
                    <button class="save" @click="saveItemToLocalStorage(item)" :disabled="SaveButtonDisabled">{{ save
                    }}</button>
                    <!--削除ボタン-->
                    <button class="delete" @click="removeItemFromLocalStorage(item)">削除</button>
                    <!--アイテムレシピ注意書き-->
                    <p class="note">※{{ item.note }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.loading-animation {
    /**background-color: rgba(255, 255, 255, 0.8);**/
    background-image: url(../img/load/loading.jpg);
    background-position: center;
    background-size: cover;
    color: white;
    position: relative;
    animation: slide 2s infinite linear;
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

.loading-dots::before {
    content: "....";
    display: inline-block;
    animation: loading-dots-animation 1s infinite steps(5, end);
}

@keyframes loading-dots-animation {
    0% {
        content: "....";
        /* 初期の表示 */
    }

    20% {
        content: " ...";
        /* 1つ目のドットを非表示に */
    }

    40% {
        content: "  ..";
        /* 2つ目のドットも非表示に */
    }

    60% {
        content: "   .";
        /* 3つ目のドットも非表示に */
    }

    80% {
        content: "    ";
        /* 4つ目のドットも非表示に */
    }

    100% {
        content: "....";
        /* 全てのドットを表示 */
    }
}




body {
    border: 2px solid black;
}

.all {
    background-color: rgb(195, 195, 195);
}

.search {
    padding: 10px;
}

.recipe {
    border: 2px solid red;
}

table tr td {
    border: 2px solid black;
    padding: 20px;
}

.note {
    background-color: rgb(255, 255, 255);
    padding: 10px;
}

.btn {
    padding: 10px;
    margin: 5px;
}

.save {
    background-color: rgb(71, 207, 71);
    padding: 5px 20px;
    font-weight: bold;
}

.delete {
    background-color: rgb(236, 63, 63);
    padding: 5px 20px;
    font-weight: bold;
}

.item-list {
    display: flex;
    flex-wrap: wrap;
}

.item {
    text-align: center;
    cursor: pointer;
}

.item img {
    width: 60px;
    height: 60px;
    border: 3px solid rgb(54, 54, 54);
    margin: 5px;
    background-color: rgb(145, 145, 145);
}

.item-container {
    position: relative;
    display: inline-block;
}

.item-name {
    white-space: nowrap;
    display: inline-block;
    padding: 7px;
    background: rgb(35, 35, 35);
    color: #fff;
    text-align: center;
    position: absolute;
    font-weight: bold;
    top: -20px;
    left: 50px;
    z-index: 1;
}
</style>