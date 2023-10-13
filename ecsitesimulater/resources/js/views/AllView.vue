<script setup>
import { ref, onMounted, computed } from 'vue'

//アイテム配列
const items = ref([])
// ユーザーの検索語を格納
const searchTerm = ref('');
// カーソルがアイテム画像にホバーした際のアイテム名を格納するリファレンス
const hoveredItem = ref(null);

//アイテム名, id取得
const getItem = () => {
    axios.get('/getitems')//API URL
        //通信成功時処理
        .then(response => {
            items.value = response.data
        })
        //通信失敗時処理
        .catch(error => {
            console.log(error)
        })
}

onMounted(() => {
    getItem();
});

//アイテム名検索(アイテム名)
const filteredItems = computed(() => {
    // データベース内のアイテム名を含むアイテムだけをフィルタリング
    return items.value.filter(item =>
        item.name.includes(searchTerm.value)
    );
});
</script>

<template>
    <h1>オール</h1>
    <input v-model="searchTerm" placeholder="アイテム名検索">
    <ul class="test">
        <li v-for="(item, i) in filteredItems" :key="i">
            <img @mouseover="hoveredItem = item.name" @mouseleave="hoveredItem = null" :src="item.pic">
            <span v-if="hoveredItem === item.name">{{ item.name }}</span>
        </li>
    </ul>
</template>
  
<style>
.test li {
    margin: 15px 0;
}
</style>