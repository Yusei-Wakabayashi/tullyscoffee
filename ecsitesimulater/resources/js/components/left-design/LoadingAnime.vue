<script setup>
const props = defineProps({
    isLoading: Boolean
});
</script>

<!--非同期loading-->
<template>
    <div v-show="isLoading" class="loading-animation">
        <h1>Now Loading<span class="loading-dots"></span></h1>
    </div>
</template>

<style scoped>
.loading-animation {
    background-color: rgba(255, 255, 255, 0.8);
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

@keyframes loading-dots-animation {
    0% {
        content: "....";
        /* 初期の表示 */
    }

    20% {
        content: " ...";
        /* 1つ目のドットを非表示に */
    }

    40% {
        content: "  ..";
        /* 2つ目のドットも非表示に */
    }

    60% {
        content: "   .";
        /* 3つ目のドットも非表示に */
    }

    80% {
        content: "    ";
        /* 4つ目のドットも非表示に */
    }

    100% {
        content: "....";
        /* 全てのドットを表示 */
    }
}
</style>