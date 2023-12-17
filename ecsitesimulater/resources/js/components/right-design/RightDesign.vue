<script setup>
//レシピコンポーネント
import NotCraft from './recipe/NotCraft.vue'
import SagyouCraft from './recipe/SagyouTable.vue';
import BrewingTable from './recipe/BrewingTable.vue';
import FurnaceTable from './recipe/FurnaceTable.vue';
import BlacksmithTable from './recipe/BlacksmithTable.vue'

//レシピ右側コンポーネント
import AttentionNote from './recipe-right/AttentionNote.vue'
import BackBtn from './recipe-right/BackItem.vue'
import ResultImg from './recipe-right/ResultImg.vue';
import KeepdeleteBtn from './recipe-right/keepdeleteBtn.vue'

const props = defineProps({
    itemRecipeList: Array,
    hoveredItemRecipeName: String,
    itemRecipe: Function,
    itemImgSrc: String,
    itemName: String,
    itemRecipeNote: String,
    keepItemBtn: Function,
    deleteItemBtn: Function,
    hoveredItem: Number,
    hoveredItemRecipeNote: String
})
</script>

<template>
    <div class="recipe">
        <div class="recipe-inline">
            <div class="recipe-box">
                <!--クラフト不可-->
                <NotCraft :itemRecipeList="itemRecipeList" />
                <!--作業台-->
                <SagyouCraft :itemRecipeList="itemRecipeList" :hoveredItemRecipeName="hoveredItemRecipeName"
                    :itemRecipe="itemRecipe" />
                <!--醸造台-->
                <BrewingTable :itemRecipeList="itemRecipeList" :hoveredItemRecipeName="hoveredItemRecipeName" />
                <!--かまど-->
                <FurnaceTable :itemRecipeList="itemRecipeList" :hoveredItemRecipeName="hoveredItemRecipeName" />
                <!--鍛冶台-->
                <BlacksmithTable :itemRecipeList="itemRecipeList" :hoveredItemRecipeName="hoveredItemRecipeName" />
                
                <!--レシピ右側-->
                <div class="right-side" v-if="itemImgSrc">
                    <!--注意書き-->
                    <AttentionNote :itemRecipeNote="itemRecipeNote" :hoverdItemRecipeNote="hoveredItemRecipeNote" />
                    <!--アイテムを戻るボタン-->
                    <BackBtn />
                    <!--レシピ右側の画像-->
                    <ResultImg :itemImgSrc="itemImgSrc" :hoveredItem="hoveredItem" :itemName="itemName" />
                    <!--保存、削除ボタン-->
                    <KeepdeleteBtn :keepItemBtn="keepItemBtn" :deleteItemBtn="deleteItemBtn" />
                </div>
            </div>
        </div>
    </div>
</template>