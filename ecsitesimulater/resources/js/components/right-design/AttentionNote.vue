<script setup>
import { ref } from 'vue'
const props = defineProps({
    itemRecipeNote: String
})

const hoveredItemRecipeNote = ref(null)
var maxLength = 25;
function insertLineBreaks(text) {
    // 改行後のテキストを格納するための変数
    let result = '';
    
    // 文字列を指定の文字数で分割して、改行を挿入する
    for (let i = 0; i < text.length; i += maxLength) {
        result += text.substr(i, maxLength) + '\n';
    }
    
    return result;
}

// 改行を挿入する前のテキスト
// const originalText = 'この文章は改行して表示されます。これはテスト用の文章で、指定の文字数で改行するJavaScriptの関数を使っています。';

// 指定の文字数で改行を挿入した後のテキスト
// const textWithLineBreaks = insertLineBreaks(originalText, 20);
</script>

<!--注意書き-->
<template>
    <div v-if="itemRecipeNote.length">
        <div class="box" @mouseover="hoveredItemRecipeNote = itemRecipeNote" @mouseleave="hoveredItemRecipeNote = null">
            ?
            <div style="white-space: pre-wrap;" class="item-name-note" v-if="hoveredItemRecipeNote === itemRecipeNote">
                {{ insertLineBreaks(itemRecipeNote) }}
            </div>
        </div>
    </div>
    <div v-else-if="itemRecipeNote.length === 0">
        <div class="box-none">
            <div class="item-name-note" v-if="hoveredItemRecipeNote === itemRecipeNote">
                {{ insertLineBreaks(itemrecipeNote) }}
            </div>
        </div>
    </div>
</template>

<style scoped>
.box {
    width: 30px;
    height: 30px;
    margin-left: 168px;
    background-color: #999999;
    border-left: 3px solid #333333;
    border-top: 3px solid #333333;
    border-bottom: 3px solid #f2f2f2;
    border-right: 3px solid #f2f2f2;
    box-sizing: border-box;
}
.box-none {
    width: 30px;
    height: 30px;
    margin-left: 168px;
}
</style>