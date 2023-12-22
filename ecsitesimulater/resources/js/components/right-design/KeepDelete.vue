<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    existingItems: Array,
    selectedItemClick: Object, // オブジェクトが渡される
});

const emits = defineEmits();

// アイテムの保存メソッド
const keepItemBtn = () => {
    console.log(props.selectedItemClick)
    
    emits('update-keep', {
        existingItems: props.existingItems,
        selectedItemClick: props.selectedItemClick,
    });

    // 同じアイテムが既に保存されているか確認
    const isAlreadySaved = props.existingItems.some((item) => {
        return item.name === props.selectedItemClick.name;
    });

    // ローカルストレージに保存
    localStorage.setItem("saved-Minecraft-Items", JSON.stringify(props.existingItems));

    // アイテムがまだ保存されていない場合追加
    if (!isAlreadySaved) {
        // アイテムを保存
        props.existingItems.unshift(props.selectedItemClick);
        localStorage.setItem("saved-Minecraft-Items", JSON.stringify(props.existingItems));
    }
};

// アイテムの削除メソッド
const deleteItemBtn = () => {
    // クリックされたアイテムのIDを取得
    const clickItemId = props.selectedItemClick.id;

    // clickItemIdと異なるidを持つ要素だけを残す。一致したものは消す
    const deleteItem = props.existingItems.filter((item) => item.id !== clickItemId);

    // ローカルストレージに保存
    localStorage.setItem("saved-Minecraft-Items", JSON.stringify(deleteItem));

    window.location.reload();

    // アイテムが正常に削除された場合にのみページをリロードして保存画面のまま表示
    if (deleteItem.length > 0) {
        window.location.reload();
    }
};
</script>

<template>
    <div class="button-container">
        <div class="out-button">
            <button class="button-left" @click="keepItemBtn()">保存</button>
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