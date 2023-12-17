<script setup>
const props = defineProps({
    categoryName: String,
    items: Array
})
</script>

<!--カテゴリー名-->
<template>
    <h1 class="category-name">
        {{ categoryName }}
        {{ items.length }}アイテム
    </h1>
</template>

<style scoped>
.category-name {
    border-top: 4px solid #333333;
    margin: 0px;
    padding: 0 0 0 15px;
    color: rgb(110, 110, 110);
    border-left: 3px solid #f2f2f2;
    border-right: 3px solid rgb(101, 101, 101);
}
</style>