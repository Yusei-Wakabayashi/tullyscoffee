<script setup>
const props = defineProps({
    keepItemBtn: Function,
    deleteItemBtn: Function
})
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