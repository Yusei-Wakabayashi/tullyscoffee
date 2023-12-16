<script setup>
import Index from '../store/index.js'

const { isLoading } = Index()
</script>

<template>
    <div v-show="isLoading" class="loading-animation">
        <h1>Now Loading<span class="loading-dots"></span></h1>
    </div>
</template>