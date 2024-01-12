<script setup>
import { computed } from 'vue';

const props = defineProps({
    existingItems: Array,
    selectedItemClick: Object,
});

const emits = defineEmits();

// 保存ボタンのテキスト内容を動的に設定するための算出プロパティ
const saveButtonText = computed(() => {
    return props.existingItems.some(item => item.name === props.selectedItemClick.name) // アイテム名を比較
        ? '既存'
        : '保存';
});

const keepItemBtn = () => {
    emits('update-keep', {
        existingItems: props.existingItems,
        selectedItemClick: props.selectedItemClick,
    });

    const isAlreadySaved = props.existingItems.some(item => item.name === props.selectedItemClick.name);

    if (!isAlreadySaved) {
        props.existingItems.unshift(props.selectedItemClick);
        localStorage.setItem("saved-Minecraft-Items", JSON.stringify(props.existingItems));

        // 更新後のテキストを反映
        saveButtonText.value = '既存';
        window.alert('保存完了')
    }

    // ローカルストレージに保存
    localStorage.setItem("saved-Minecraft-Items", JSON.stringify(props.existingItems));
};

const deleteItemBtn = () => {
    const clickItemId = props.selectedItemClick.id;
    const deleteItem = props.existingItems.filter(item => item.id !== clickItemId);

    localStorage.setItem("saved-Minecraft-Items", JSON.stringify(deleteItem));

    window.location.reload();

    if (deleteItem.length > 0) {
        window.location.reload();
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