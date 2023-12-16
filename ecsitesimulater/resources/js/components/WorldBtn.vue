<script setup>
const props = defineProps({
    isOverworldClick: Boolean,
    isNetherTabClick: Boolean,
    isEndTabClick: Boolean,
    isAllTabClick: Boolean,
    setOverworldClick: Function,
    setNetherTabClick: Function,
    setEndTabClick: Function,
    setAllTabClick: Function,
});
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