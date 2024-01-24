<script setup>
const props = defineProps({
    isOverworldClick: Boolean,
    isNetherTabClick: Boolean,
    isEndTabClick: Boolean,
    isAllTabClick: Boolean,
    categoryName: String,
    currentCategory: Number,
    isLoading: Boolean,
    searchTerm: String,
    getAllitem: Function,
    getEnditem: Function,
    getNetheritem: Function,
    getOverWorlditem: Function,
});

const emits = defineEmits();

//オーバーワールド
const setOverworldClick = () => {
    //emitで子コンポーネント内でデータ変更
    emits('update-category', {
        categoryName: "全アイテム一覧:",
        currentCategory: 10,
        isLoading: true,
        isOverworldClick: true,
        isNetherTabClick: false,
        isEndTabClick: false,
        isAllTabClick: false,
        searchTerm: props.searchTerm,
    });

    props.getOverWorlditem(10)
};
//ネザー
const setNetherTabClick = () => {
    //emitで子コンポーネント内でデータ変更
    emits('update-category', {
        categoryName: "全アイテム一覧:",
        currentCategory: 10,
        isLoading: true,
        isOverworldClick: false,
        isNetherTabClick: true,
        isEndTabClick: false,
        isAllTabClick: false,
        searchTerm: props.searchTerm,
    });

    props.getNetheritem(10)
};
//エンド
const setEndTabClick = () => {
    //emitで子コンポーネント内でデータ変更
    emits('update-category', {
        categoryName: "全アイテム一覧:",
        currentCategory: 10,
        isLoading: true,
        isOverworldClick: false,
        isNetherTabClick: false,
        isEndTabClick: true,
        isAllTabClick: false,
        searchTerm: props.searchTerm,
    });

    props.getEnditem(10)
};

const setAllTabClick = () => {
    //emitで子コンポーネント内でデータ変更
    emits('update-category', {
        categoryName: "全アイテム一覧:",
        currentCategory: 10,
        isLoading: true,
        isOverworldClick: false,
        isNetherTabClick: false,
        isEndTabClick: false,
        isAllTabClick: true,
        searchTerm: props.searchTerm,
    });

    props.getAllitem(10);
};
</script>

<!--ワールドボタンコンポーネント-->
<template>
    <div class="tab-container">
        <!--オーバーワールドボタン-->
        <div :class="{ 'tab-click-left': isOverworldClick, 'tab-left': !isOverworldClick, }">
            <button @click="setOverworldClick(true)"
                :class="{ 'tab-world-click': isOverworldClick, 'tab-world': !isOverworldClick, }">
                オーバーワールド
            </button>
        </div>
        <!--ネザーボタン-->
        <div :class="{ 'tab-click': isNetherTabClick, tab: !isNetherTabClick, }">
            <button @click="setNetherTabClick(true)"
                :class="{ 'tab-world-click': isNetherTabClick, 'tab-world': !isNetherTabClick, }">
                ネザー
            </button>
        </div>
        <!--エンドボタン-->
        <div :class="{ 'tab-click': isEndTabClick, tab: !isEndTabClick }">
            <button @click="setEndTabClick(true)"
                :class="{ 'tab-world-click': isEndTabClick, 'tab-world': !isEndTabClick, }">
                エンド
            </button>
        </div>
        <!--オールボタン-->
        <div :class="{ 'tab-click': isAllTabClick, 'tab-right': !isAllTabClick, }">
            <button @click="setAllTabClick(true)"
                :class="{ 'tab-world-click': isAllTabClick, 'tab-world': !isAllTabClick, }">
                オール
            </button>
        </div>
    </div>
</template>

<style scoped>
.tab {
    width: 100%;
    flex: 1;
    text-align: center;
    border-left: 3px solid #333333;
    border-right: none;
    border-bottom: 3px solid #333333;
}
.tab-container {
    display: flex;
}

.tab-click-left {
    flex: 1;
    text-align: center;
    cursor: pointer;
    border-bottom: none;
    border-left: none;
}

.tab-left {
    width: 100%;
    flex: 1;
    text-align: center;
    border-left: none;
    border-right: none;
    border-bottom: 3px solid #333333;
}

.tab-world-click {
    font-weight: bold;
    color: rgb(110, 110, 110);
    padding: 10px;
    width: 100%;
    height: 100%;
    border-top: 3px solid #f2f2f2;
    border-left: 3px solid #f2f2f2;
    border-right: 3px solid rgb(101, 101, 101);
    border-bottom: none;
    background-color: #cccccc;
    cursor: pointer;
    font-family: 'DotGothic16', sans-serif;
}

.tab-world {
    font-weight: bold;
    color: #f2f2f2;
    padding: 10px;
    width: 100%;
    height: 100%;
    border-top: 3px solid #f2f2f2;
    border-left: 3px solid #f2f2f2;
    border-right: 3px solid rgb(101, 101, 101);
    border-bottom: none;
    background-color: #999999;
    cursor: pointer;
    font-family: 'DotGothic16', sans-serif;
}

.tab-click {
    flex: 1;
    text-align: center;
    cursor: pointer;
    border-bottom: none;
    border-left: 3px solid #333333;
}

.tab-right {
    width: 100%;
    flex: 1;
    text-align: center;
    border-left: 3px solid #333333;
    border-right: none;
    border-bottom: 3px solid #333333;
}
</style>