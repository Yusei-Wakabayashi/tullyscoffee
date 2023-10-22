<script setup>
import WorldsHeader from './components/WorldsHeader.vue';
</script>

<template>
    <WorldsHeader />
</template>
<style>
body {
    border: 2px solid black;
}

.all {
    background-color: rgb(195, 195, 195);
}

.search {
    padding: 10px;
}

.recipe{
    border: 2px solid red;
}

table tr td {
    border: 2px solid black;
    padding: 20px;
}

.note {
    background-color: rgb(255, 255, 255);
    padding: 10px;
}

.btn {
    padding: 10px;
    margin: 5px;
}

.save {
    background-color: rgb(71, 207, 71);
    padding: 5px 20px;
    font-weight: bold;
}

.delete {
    background-color: rgb(236, 63, 63);
    padding: 5px 20px;
    font-weight: bold;
}

.item-list {
    display: flex;
    flex-wrap: wrap;
}

.item {
    text-align: center;
    cursor: pointer;
}

.item img {
    width: 60px;
    height: 60px;
    border: 3px solid rgb(54, 54, 54);
    margin: 5px;
    background-color: rgb(145, 145, 145);
}

.item-container {
    position: relative;
    display: inline-block;
}

.item-name {
    white-space: nowrap;
    display: inline-block;
    padding: 7px;
    background: rgb(35, 35, 35);
    color: #fff;
    text-align: center;
    position: absolute;
    font-weight: bold;
    top: -20px;
    left: 50px;
    z-index: 1;
}
</style>