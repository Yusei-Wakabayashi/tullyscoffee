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