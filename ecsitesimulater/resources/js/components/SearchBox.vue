<script setup>
import Index from '../store/index.js'

const { searchTerm } = Index()
</script>

<template>
    <input v-model="searchTerm" placeholder="検索" />
</template>