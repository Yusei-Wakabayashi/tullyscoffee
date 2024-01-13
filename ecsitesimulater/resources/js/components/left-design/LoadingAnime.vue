<script setup>
const props = defineProps({
    isLoading: Boolean
});
</script>

<!--非同期loading-->
<template>
    <div v-show="isLoading" class="loading-animation">
        <h1>
            <img src="../../../../public/web_png/looding_6fps.png" alt="">
            Now Loading
            <img src="../../../../public/web_png/looding_6fps.png" alt="">
        </h1>
    </div>
</template>

<style scoped>
.loading-animation {
    background-color: rgba(255, 255, 255, 0.445);
    background-position: center;
    background-size: cover;
    color: black;
    position: relative;
    animation: slide 2s infinite linear;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loading-dots::before {
    content: "....";
    display: inline-block;
    animation: loading-dots-animation 1s infinite steps(5, end);
}
</style>