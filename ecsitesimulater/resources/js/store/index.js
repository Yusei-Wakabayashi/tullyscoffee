import { ref, computed } from "vue";
import axios from "axios"

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
    const itemRecipeList = ref([]);//アイテムのレシピIDのリスト
    const hoveredItem = ref(null);//カーソルがアイテム画像にホバーした際のアイテム名を格納するリファレンス
    const hoveredItemRecipeName = ref(null)
    const itemRecipeNote = ref("");//クラフトレシピの注意書き
    const itemImgSrc = ref('')//itemImgの値をセット
    const itemName = ref('')
    const selectedItemClick = ref(null);
    // 既存のローカルストレージ内データを取得
    const existingItems = JSON.parse(localStorage.getItem("saved-Minecraft-Items")) || [];

    //アイテム名検索(アイテム名)
    const filtereditems = computed(() => {
        // データベース内のアイテム名を含むアイテムだけをフィルタリング
        return items.value.filter((item) => item.name.includes(searchTerm.value));
    });

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

    //クリックしたものの引数をcurrentCategoryに入れてアイテム表示を変更する
    const setCategory = (category) => {
        currentCategory.value = category; //cssのデザイン変化
        searchTerm.value = "";
        isLoading.value = true;
        if (isOverworldClick.value === true) {
            axios
                .get(`/item/catwar/1/${category}`)
                .then((response) => {
                    console.log(category)
                    items.value = response.data;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    isLoading.value = false;
                });
        } else if (isNetherTabClick.value === true) {
            axios
                .get(`/item/catwar/2/${category}`)
                .then((response) => {
                    items.value = response.data;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    isLoading.value = false;
                });
        } else if (isEndTabClick.value === true) {
            axios
                .get(`/item/catwar/3/${category}`)
                .then((response) => {
                    items.value = response.data;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    isLoading.value = false;
                });
        } else if (isAllTabClick.value === true) {
            axios
                .get(`/item/categoly/${category}`)
                .then((response) => {
                    items.value = response.data;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    isLoading.value = false;
                });
        }
        //categoryに応じてcategoryNameを設定
        switch (category) {
            case 1:
                categoryName.value = "建築:";
                break;
            case 2:
                categoryName.value = "色付きブロック:";
                break;
            case 3:
                categoryName.value = "天然ブロック:";
                break;
            case 4:
                categoryName.value = "機能的ブロック:";
                break;
            case 5:
                categoryName.value = "レッドストーン:";
                break;
            case 6:
                categoryName.value = "道具と実用:";
                break;
            case 7:
                categoryName.value = "戦闘:";
                break;
            case 8:
                categoryName.value = "食べ物と飲み物:";
                break;
            case 9:
                categoryName.value = "材料:";
                break;
            case 10:
                categoryName.value = "全アイテム一覧:";
                break;
            default:
                categoryName.value = "";
        }
    };

    // 保存ボタンメソッド
    const setCategoryKeep = () => {
        categoryName.value = "保存アイテム一覧:";
        currentCategory.value = 11;
        getSavedItems();
        items.value = existingItems.value; // 保存されたアイテムだけを表示する
    }

    //画像をクリックしたときのレシピ表示処理
    const itemRecipe = (item) => {
        isLoading.value = true;
        itemRecipeNote.value = item.note;
        const itemId = item.id;
        const itemImg = item.pic
        itemName.value = item.name
        itemImgSrc.value = itemImg; //アイテム一覧の押したアイテム画像を入れる
        selectedItemClick.value = item // クリックされたときにitemを入れて保存メソッドで使う
        axios
            .get(`/item/recipesearch/${itemId}`)
            .then((response) => {
                console.log(response.data)
                itemRecipeList.value = response.data;
            })
            .catch((error) => {
                console.log(error);
            })
            .finally(() => {
                isLoading.value = false;
            });
    };

    // アイテムの保存メソッド
    const keepItemBtn = () => {

        // 同じアイテムが既に保存されているか確認
        const isAlreadySaved = existingItems.some((item) => {
            return item.name === selectedItemClick.value.name;
        });

        // ローカルストレージに保存
        localStorage.setItem("saved-Minecraft-Items", JSON.stringify(existingItems));

        // アイテムがまだ保存されていない場合追加
        if (!isAlreadySaved) {
            // アイテムを保存
            existingItems.unshift(selectedItemClick.value);
            localStorage.setItem("saved-Minecraft-Items", JSON.stringify(existingItems));
        }
    };

    // アイテムの削除メソッド
    const deleteItemBtn = () => {

        // クリックされたアイテムのIDを取得
        const clickItemId = selectedItemClick.value.id;

        // clickItemIdと異なるidを持つ要素だけを残す。一致したものは消す
        const deleteItem = existingItems.filter((item) => item.id !== clickItemId);

        // ローカルストレージに保存
        localStorage.setItem("saved-Minecraft-Items", JSON.stringify(deleteItem));

        window.location.reload();

        // アイテムが正常に削除された場合にのみページをリロードして保存画面のまま表示
        if (existingItems.length - 1) {
            window.location.reload();
        }
    };

    // ローカルストレージから保存されたアイテムを取得するメソッド
    const getSavedItems = () => {
        const savedItems = JSON.parse(localStorage.getItem("saved-Minecraft-Items")) || [];
        existingItems.value = savedItems;
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
        itemRecipeList,
        hoveredItem,
        hoveredItemRecipeName,
        itemRecipeNote,
        itemImgSrc,
        itemName,
        selectedItemClick,
        existingItems,
        filtereditems,
        getAllitem,
        setOverworldClick,
        setNetherTabClick,
        setEndTabClick,
        setAllTabClick,
        setCategory,
        setCategoryKeep,
        itemRecipe,
        keepItemBtn,
        deleteItemBtn,
        getSavedItems
    }
}