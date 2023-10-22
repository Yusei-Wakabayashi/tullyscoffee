
<template>
    <div class="world">
        <button><router-link to="/overWorld">オーバーワールド</router-link></button>
        <button><router-link to="/nether">ネザー</router-link></button>
        <button><router-link to="/end">エンド</router-link></button>
        <button><router-link to="/">オール</router-link></button>
        <router-view />
    </div>
</template>

<style scoped>
.world {
    background-color: rgb(195, 195, 195);
}

button{
    margin: 10px;
    padding: 10px;
}

a{
    text-decoration: none;
    color: black;
    font-weight: bold;
}
</style>