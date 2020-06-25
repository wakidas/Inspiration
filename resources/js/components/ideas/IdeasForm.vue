<template>
  <div class="p-create__inner">
    <div class="p-create__title">アイデア投稿</div>
    <form :action="endpoint" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="_token" :value="csrf" />

      <!-- タイトル -->
      <div class="p-create__formGroup">
        <label class="p-create__formLabel">
          タイトル
          <span class="c-icon__formLabel c-icon__formLabel--required">必須</span>
        </label>
        <div class="p-create__formItem">
          <input type="text" class="p-create__formInput" name="title" v-model="title" required />
          <span class="c-error" role="alert" v-for="value in error.title" :key="value.title">
            <strong>{{ value }}</strong>
          </span>
        </div>
      </div>

      <!--　カテゴリ -->
      <div class="p-create__formGroup">
        <label class="p-create__formLabel">
          カテゴリー
          <span class="c-icon__formLabel c-icon__formLabel--required">必須</span>
        </label>
        <div class="p-create__formItem p-create__formItem--category">
          <select
            name="category_id"
            class="p-create__formInput p-create__formInput--category"
            required
            v-model="category"
          >
            <option value="選択してください" disabled>選択してください</option>
            <option
              v-for="item in categories"
              :key="item.id"
              :value="item.id"
              :selected="{ true: item.id==category }"
            >{{ item.name }}</option>
          </select>
          <span class="c-error" role="alert" v-for="value in error.category" :key="value.category">
            <strong>{{ value }}</strong>
          </span>
        </div>
      </div>

      <!-- 説明 -->
      <div class="p-create__formGroup">
        <label class="p-create__formLabel">
          説明
          <span class="c-icon__formLabel c-icon__formLabel--required">必須</span>
        </label>
        <div class="p-create__formItem">
          <textarea
            name="description"
            type="text"
            class="p-create__formInput"
            v-model="description"
            required
          ></textarea>
          <span
            class="c-error"
            role="alert"
            v-for="value in error.description"
            :key="value.description"
          >
            <strong>{{ value }}</strong>
          </span>
        </div>
      </div>
      <!-- アイデアの内容 -->
      <div class="p-create__formGroup">
        <label class="p-create__formLabel">
          アイデアの内容
          <span class="c-icon__formLabel c-icon__formLabel--required">必須</span>
        </label>
        <div class="p-create__formItem">
          <textarea name="body" type="text" class="p-create__formInput" v-model="body" required></textarea>
          <span class="c-error" role="alert" v-for="value in error.body" :key="value.body">
            <strong>{{ value }}</strong>
          </span>
        </div>
      </div>

      <!-- 価格 -->
      <div class="p-create__formGroup">
        <label class="p-create__formLabel">
          価格
          <span class="c-icon__formLabel c-icon__formLabel--required">必須</span>
        </label>
        <div class="p-create__formItem p-create__formItem--price">
          <div class="p-create__priceWrap">
            <input name="price" type="number" class="p-create__formInput" v-model="price" required />
            <span class="p-create__price__text">円</span>
          </div>
          <span class="c-error" role="alert" v-for="value in error.price" :key="value.price">
            <strong>{{ value }}</strong>
          </span>
        </div>
      </div>

      <!-- 画像 -->
      <div class="p-create__formGroup">
        <label class="p-create__formLabel">
          サムネイル画像
          <span class="c-icon__formLabel c-icon__formLabel--optional">任意</span>
        </label>
        <div class="p-create__formItem">
          <div class="p-create__imgWrap">
            <div
              class="p-create__imgDelete js-create__imgDelete"
              @click="deleteImg"
              v-show="imgFlg"
            >
              <img src="/images/close.svg" alt />
            </div>
            <label
              for="image"
              class="p-create__imgLabel js-create__imgLabel"
              :style="{ backgroundImage: backgroundImage}"
            >
              <input type="hidden" id="js-img__deleteFlg" name="deleteFlg" v-model="deleteFlg" />
              <input
                id="image"
                name="img"
                type="file"
                class="p-create__imgInput js-create__imgInput"
                @change="previewImg"
              />
            </label>
          </div>
          <span class="c-error" role="alert" v-for="value in error.price" :key="value.price">
            <strong>{{ value }}</strong>
          </span>
        </div>
      </div>

      <!-- 送信ボタン -->
      <div class="p-create__submit">
        <button type="submit" class="c-button__submit">投稿する</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  props: {
    old: {
      type: Array
    },
    errors: {
      type: Array
    },
    endpoint: {
      type: String
    },
    categories: {
      type: Array
    },
    idea: {
      type: Object
    }
  },
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),

      Categories: this.categories,
      // Category: '選択してください',
      title: this.old.title ? this.old.title : this.idea.title,
      category: this.old.category_id
        ? this.old.category_id
        : this.idea.category_id
        ? this.idea.category_id
        : "選択してください",
      description: this.old.description
        ? this.old.description
        : this.idea.description,
      body: this.old.body ? this.old.body : this.idea.body,
      price: this.old.price ? this.old.price : this.idea.price,
      img: this.idea.img,
      imgFlg: "",
      backgroundImage: "",
      deleteFlg: "",
      error: {
        title: this.errors.title,
        category: this.errors.category,
        body: this.errors.body,
        price: this.errors.price
      }
    };
  },
  computed: {},
  methods: {
    // ===============================
    //imgFlgのセット
    // ===============================
    setImgFlg() {
      this.imgFlg = this.img
        ? true
        : $(".js-create__imgInput").val() !== ""
        ? true
        : false;
      return this.imgFlg;
    },
    // ===============================
    //背景画像のセット
    // ===============================
    setBackgroundImage() {
      this.backgroundImage = this.img
        ? "url(/storage/" + this.img + ")"
        : "url('/images/noimage.png')";
      return this.backgroundImage;
    },
    // ===============================
    //画像アップロード時に発火。
    //画像をプレビューするためのメソッド
    // ===============================
    previewImg() {
      let $fileInput = $(".js-create__imgInput");
      let file = $fileInput.prop("files")[0];
      let $previewArea = $(".js-create__imgLabel");
      let deleteFlg = $("#js-img__deleteFlg");
      let fileReader = new FileReader();

      fileReader.onload = function(event) {
        //読み込んだデータをbackground-imageに設定
        $previewArea.css(
          "background-image",
          "url(" + event.target.result + ")"
        );
      };

      // 画像読み込み
      fileReader.readAsDataURL(file);
      this.setImgFlg();
      this.deleteFlg = "";
    },

    // ===============================
    //画像を削除するメソッド
    // ===============================
    deleteImg() {
      let $fileInput = $(".js-create__imgInput");
      let deleteFlg = $("#js-img__deleteFlg");

      $fileInput.val("");
      this.img = "";
      this.setImgFlg();
      this.setBackgroundImage();

      this.deleteFlg = 1;
    }
  },
  mounted() {
    this.setImgFlg();
    this.setBackgroundImage();
  }
};
</script>