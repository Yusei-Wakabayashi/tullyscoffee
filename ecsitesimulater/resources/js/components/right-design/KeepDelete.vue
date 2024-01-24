<script setup>
import { defineProps, defineEmits, ref, computed, } from 'vue';

const props = defineProps({
    existingItems: Array, // ローカルストレージ
    selectedItemClick: Object, // アイテムの情報が入る
    items: Array,
    getSavedItems: Function
});

const emits = defineEmits();

// existingItemsをcomputedプロパティに変換
const existingItemsRef = ref(props.existingItems);
const existingItems = computed(() => existingItemsRef.value);

// 保存ボタンのテキスト内容を動的に変更する算出プロパティ
const saveButtonText = computed(() => {
    return existingItems.value.some(item => item.name === props.selectedItemClick.name)
        ? '既存' : '保存';
});

// 選択されたアイテムがローカルストレージに入っているかどうかを判定する算出プロパティ
const hasItemsInLocalStorage = computed(() => {
    return existingItems.value.some(item => item.id === props.selectedItemClick.id);
});

const keepItemBtn = () => {
    emits('update-keep', {
        existingItems: existingItems.value,
        selectedItemClick: props.selectedItemClick,
    });
    const isAlreadySaved = existingItems.value.some(item => item.name === props.selectedItemClick.name);

    if (!isAlreadySaved) {
        existingItemsRef.value.unshift(props.selectedItemClick);
        localStorage.setItem("saved-Minecraft-Items", JSON.stringify(existingItemsRef.value));

        // 更新後のテキストを反映
        saveButtonText.value = '既存';
        window.alert('保存完了');
    }

    // ローカルストレージに保存
    localStorage.setItem("saved-Minecraft-Items", JSON.stringify(existingItemsRef.value));
};

const deleteItemBtn = () => {
    if (saveButtonText.value === "既存") {
        existingItemsRef.value = existingItemsRef.value.filter(item => item.id !== props.selectedItemClick.id);
        localStorage.setItem("saved-Minecraft-Items", JSON.stringify(existingItemsRef.value));
        props.getSavedItems();
        emits('update-keep', {
            items: existingItemsRef.value
        })
    }
};
</script>

<template>
    <div class="button-container">
        <div class="out-button">
            <button class="button-left" @click="keepItemBtn()"
                :style="{ 'background-color': !hasItemsInLocalStorage ? '#A4e76a' : '#ccc' }">{{ saveButtonText }}</button>
        </div>
        <div class="out-button">
            <button class="button-right" @click="deleteItemBtn()"
                :style="{ 'background-color': hasItemsInLocalStorage ? '#df272d' : '#ccc' }">削除</button>
        </div>
    </div>
</template>

<style scoped>
.button-container {
    display: flex;
    margin-left: 55px;
    margin-top: 15px;
}

.out-button {
    border: 3px solid #000;
    margin-left: 17px;
}

.button-left {
    cursor: pointer;
    display: flex;
    width: 45.2px;
    height: 30.2px;
    align-items: center;
    justify-content: center;
    border-left: 3px solid white;
    border-top: 3px solid white;
    border-right: 3px solid #999;
    border-bottom: 3px solid #999;
}

.button-right {
    cursor: pointer;
    display: flex;
    width: 45.2px;
    height: 30.2px;
    align-items: center;
    justify-content: center;
    border-left: 3px solid white;
    border-top: 3px solid white;
    border-right: 3px solid #999;
    border-bottom: 3px solid #999;
}

.button-right.red-button {
    background-color: #df272d;
    /* 赤色に変更 */
}

.button-right.disabled {
    cursor: not-allowed;
}
</style>