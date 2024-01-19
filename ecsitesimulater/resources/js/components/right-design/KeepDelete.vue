<script setup>
import { defineProps, defineEmits, ref, computed, } from 'vue';

const props = defineProps({
    existingItems: Array, // ローカルストレージ
    selectedItemClick: Object, // アイテムの情報が入る
});

const emits = defineEmits();

// existingItemsをcomputedプロパティに変換
const existingItemsRef = ref(props.existingItems);
const existingItems = computed(() => existingItemsRef.value);

// 保存ボタンのテキスト内容を動的に設定するための算出プロパティ
const saveButtonText = computed(() => {
    return existingItems.value.some(item => item.name === props.selectedItemClick.name)
        ? '既存' : '保存';
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
        const clickItemId = props.selectedItemClick.id;
        existingItemsRef.value = existingItemsRef.value.filter(item => item.id !== clickItemId);
        localStorage.setItem("saved-Minecraft-Items", JSON.stringify(existingItemsRef.value));
        window.location.reload()
    }
};
</script>

<template>
    <div class="button-container">
        <div class="out-button">
            <button class="button-left" @click="keepItemBtn()">{{ saveButtonText }}</button>
        </div>
        <div class="out-button">
            <button class="button-right" @click="deleteItemBtn()">削除</button>
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

.button-left:hover {
    background-color: #A4e76a;
}

.button-left {
    cursor: pointer;
    display: flex;
    width: 45.2px;
    height: 30.2px;
    align-items: center;
    justify-content: center;
    background-color: #999;
    border-left: 3px solid white;
    border-top: 3px solid white;
    border-right: 3px solid #999;
    border-bottom: 3px solid #999;
}

.button-right:hover {
    background-color: #df272d;
}

.button-right {
    cursor: pointer;
    display: flex;
    width: 45.2px;
    height: 30.2px;
    align-items: center;
    justify-content: center;
    background-color: #999;
    border-left: 3px solid white;
    border-top: 3px solid white;
    border-right: 3px solid #999;
    border-bottom: 3px solid #999;
}
</style>