<script setup>
const props = defineProps({
    filtereditems: Array,
    hoveredItem: Number,
    itemRecipe: Function,
    scrolled: Number
});
</script>

<!--アイテム一覧画面-->
<template>
    <div class="itemlist-inline">
        <div class="vertical-scrollable-list" @scroll="(e)=>{scrolled=e.target.scrollTop}">
            <ul>
                <li v-for="(item, i) in filtereditems" :key="i" class="item-container">
                    <!--アイテム名-->
                    <div class="item-name" v-if="hoveredItem === i" :style="'top:'+ (parseInt((i) /8)*57.2 + 170 - scrolled)+'px'">
                        {{ item.name }}
                    </div>
                    <!--アイテム画像-->
                    <img class="item-img" @mouseover="hoveredItem = i" @mouseleave="hoveredItem = null" :src="item.pic"
                        @click="itemRecipe(item)" />
                </li>
            </ul>
        </div>
    </div>
</template>

<style scoped>
.itemlist-inline {
    border-left: 3px solid #f2f2f2;
    border-right: 3px solid rgb(101, 101, 101);
}

.vertical-scrollable-list {
    height: 276px;
    width: 526px;
    overflow-y: scroll;
    overflow-x: hidden;
    padding-right: 20px;
    cursor: pointer;
}


.vertical-scrollable-list img {
    width: 49px;
    height: 49px;
    cursor: pointer;
}

.vertical-scrollable-list ul {
    list-style: none;
    padding: 0 0 0 10px;
    margin: 0;
}

.vertical-scrollable-list li {
    display: inline-block;
    vertical-align: top;
    width: 50px;
    height: 50px;
    background-color: #999999;
    border-left: 3px solid #333333;
    border-top: 3px solid #333333;
    border-bottom: 5px solid #f2f2f2;
    border-right: 5px solid #f2f2f2;
}

/* スクロールバーの横幅を変更 */
::-webkit-scrollbar {
    width: 50px;
}

/* スクロールバーのトラック（背景部分*/
::-webkit-scrollbar-track {
    background: #999999;
    margin: 0 0 20px 0;
    border-top: 3px solid #333333;
    border-left: 3px solid #333333;
    border-right: 3px solid #f2f2f2;
    border-bottom: 3px solid #f2f2f2;

}

/* スクロールバーのスクロールノブ（長方形に変更*/
::-webkit-scrollbar-thumb {
    background: #afafaf;
    border-top: 3px solid #f2f2f2;
    border-left: 3px solid #333333;
    border-right: 3px solid #f2f2f2;
    border-bottom: 3px solid #333333;
    height: 60px;
}
</style>