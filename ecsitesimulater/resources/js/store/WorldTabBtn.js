import { ref } from 'vue'

export default function () {
    const items = ref([]);//アイテム配列
    const currentCategory = ref(10);//初期のcss状態(ALLカテゴリーボタン)
    const isLoading = ref(true); //非同期処理の読み込み判定 (trueの間だけアニメーション表示)
    const searchTerm = ref("");//ユーザーの検索語を格納
    const categoryName = ref("全アイテム一覧:");//カテゴリーボタンを押した際に文字を入れる(初期は全アイテム一覧表示)
    const isOverworldClick = ref(false);//オーバーワールドボタン
    const isNetherTabClick = ref(false);//ネザーワールドボタン
    const isEndTabClick = ref(false);//エンドワールドボタン
    const isAllTabClick = ref(true);//オールボタン

    //初期の表示オールアイテム
    const getAllitem = () => {
        axios
            .get("/item/world/4")
            .then((response) => {
                items.value = response.data;
            })
            .catch((error) => {
                console.log(error);
            })
            .finally(() => {
                isLoading.value = false;
            });
    };

    //オーバーワールド
    const setOverworldClick = () => {
        categoryName.value = "全アイテム一覧:";
        currentCategory.value = 10
        isOverworldClick.value = true;
        isNetherTabClick.value = false;
        isEndTabClick.value = false;
        isAllTabClick.value = false;
        isLoading.value = true;
        searchTerm.value = "";
        axios
            .get("/item/world/1")
            .then((response) => {
                items.value = response.data;
            })
            .catch((error) => {
                console.log(error);
            })
            .finally(() => {
                isLoading.value = false;
            });
    };

    //ネザー
    const setNetherTabClick = () => {
        categoryName.value = "全アイテム一覧:";
        currentCategory.value = 10
        isOverworldClick.value = false;
        isNetherTabClick.value = true;
        isEndTabClick.value = false;
        isAllTabClick.value = false;
        isLoading.value = true;
        searchTerm.value = "";
        axios
            .get("/item/world/2")
            .then((response) => {
                items.value = response.data;
            })
            .catch((error) => {
                console.log(error);
            })
            .finally(() => {
                isLoading.value = false;
            });
    };

    //エンド
    const setEndTabClick = () => {
        categoryName.value = "全アイテム一覧:";
        currentCategory.value = 10
        isOverworldClick.value = false;
        isNetherTabClick.value = false;
        isEndTabClick.value = true;
        isAllTabClick.value = false;
        isLoading.value = true;
        searchTerm.value = "";
        axios
            .get("/item/world/3")
            .then((response) => {
                items.value = response.data;
            })
            .catch((error) => {
                console.log(error);
            })
            .finally(() => {
                isLoading.value = false;
            });
    };

    //オール
    const setAllTabClick = () => {
        categoryName.value = "全アイテム一覧:";
        currentCategory.value = 10
        isOverworldClick.value = false;
        isNetherTabClick.value = false;
        isEndTabClick.value = false;
        isAllTabClick.value = true;
        isLoading.value = true;
        searchTerm.value = "";
        //全アイテムAPI
        getAllitem();
    };

    return {
        items,
        currentCategory,
        isLoading,
        searchTerm,
        categoryName,
        isOverworldClick,
        isNetherTabClick,
        isEndTabClick,
        isAllTabClick,
        getAllitem,
        setOverworldClick,
        setNetherTabClick,
        setEndTabClick,
        setAllTabClick,
    }
}