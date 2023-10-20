<script setup>
import { ref, onMounted, computed } from 'vue'

//非同期処理の読み込み判定
const isLoading = ref(true);
//全アイテム配列
const items = ref([])
//カテゴリーアイテム
const categoryItems = ref([])

const getItem = () => {
    axios.get('/item/start')//API URL
        //通信成功時処理
        .then(response => {
            items.value = response.data
        })
        //通信失敗時処理
        .catch(error => {
            console.log(error)
        })
        //非同期の処理待ちの処理
        .finally(() => {
            isLoading.value = false; // データ読み込み完了を示す
        });
    axios.get('/item/categoly/3')//API URL
        //通信成功時処理
        .then(response => {
            categoryItems.value = response.data
        })
        //通信失敗時処理
        .catch(error => {
            console.log(error)
        })
        //非同期の処理待ちの処理
        .finally(() => {
            isLoading.value = false; // データ読み込み完了を示す
        });
}

onMounted(() => {
    getItem();
});

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
const showText = ref(false)
//アイテム画像を押した際に選択されたアイテムIDと一致したものを表示させる
const showItemDetails = (item) => {
    showText.value = true;
    selectedItemId.value = item.id;
}
</script>

<template>
    <h1>オール</h1>
    {{ categoryItems }}
    <button>建築</button>
    <button>色付きブロック</button>
    <button>天然ブロック</button>
    <button>機能</button>
    <button>レッドストーン</button>
    <button>道具と実用</button>
    <button>戦闘</button>
    <button>食べ物と飲み物</button>
    <button>材料</button>

    <input v-model="searchTerm" placeholder="アイテム名検索">
    
    <div v-if="isLoading" class="loading-animation">
        <h2>Now Loading...</h2>
    </div>

    <ul class="horizontal-list">
        <li v-for="(item, i) in filtereditems" :key="i">
            <img @click="showItemDetails(item)" @mouseover="hoveredItem = item.name" @mouseleave="hoveredItem = null"
                :src="item.pic">
            <span v-if="hoveredItem === item.name">{{ item.name }}</span>
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
                    </tr>
                    <tr>
                        <td>{{ item.item_id7 }}</td>
                        <td>{{ item.item_id8 }}</td>
                        <td>{{ item.item_id9 }}</td>
                    </tr>
                </table>
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


.loading-animation {
    background-color: rgba(255, 255, 255, 0.8);
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