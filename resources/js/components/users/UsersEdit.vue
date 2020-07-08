<template>
<div class="p-usersEdit">
  <div class="p-usersEdit__inner">
      <div class="p-usersEdit__title">
          プロフィール編集
      </div>
      <form id="form" :action="endpoint" method="POST" enctype="multipart/form-data" class="p-usersEdit__form">
        <input type="hidden" name="_token" :value="csrf" />

        <!-- 画像 -->
        <div class="p-usersEdit__formGroup p-usersEdit__formGroup--img js-validTarget">
          <label class="p-usersEdit__formLabel">
            画像
            <span class="c-icon__formLabel c-icon__formLabel--optional">任意</span>
          </label>
          <div class="p-usersEdit__formItem">
            <div class="p-usersEdit__imgWrap">
              <div
                class="p-usersEdit__imgDelete js-usersEdit__imgDelete"
                @click="deleteImg"
                v-show="imgFlg"
              >
                <img src="/images/close.svg" alt />
              </div>
              <label
                for="image"
                class="p-usersEdit__imgLabel js-usersEdit__imgLabel"
                :style="{ backgroundImage: uploadImage}"
              >
                <input type="hidden" id="js-img__deleteFlg" name="deleteFlg" v-model="deleteFlg" />
                <input
                  id="image"
                  name="img"
                  type="file"
                  class="p-usersEdit__imgInput js-usersEdit__imgInput"
                  @change="previewImg"
                />
              </label>
            </div>
            <span class="c-error" role="alert" v-for="value in error.price" :key="value.price">
              <strong>{{ value }}</strong>
            </span>
          </div>
        </div>

        <!-- 名前 -->
        <div class="p-usersEdit__formGroup js-validTarget">
          <label class="p-usersEdit__formLabel">
            名前
            <span class="c-icon__formLabel c-icon__formLabel--required">必須</span>
          </label>
          <div class="p-usersEdit__formItem">
            <input type="text" class="p-usersEdit__formInput" name="name" placeholder="50文字以内で入力してください" v-model="name" required />
            <span class="c-error" role="alert" v-for="value in error.name" :key="value.name">
              <strong>{{ value }}</strong>
            </span>
          </div>
        </div>

        <!-- コメント -->
        <div class="p-usersEdit__formGroup js-validTarget">
          <label class="p-usersEdit__formLabel">
            自己紹介
            <span class="c-icon__formLabel c-icon__formLabel--optional">任意</span>
          </label>
          <div class="p-usersEdit__formItem p-usersEdit__formItem--comment">
            <textarea
            name="comment" 
            class="p-usersEdit__formInput p-usersEdit__formInput--comment"
            v-model="comment" placeholder="140文字以内で入力してください"
          ></textarea>
            <span class="c-error" role="alert" v-for="value in error.comment" :key="value.comment">
              <strong>{{ value }}</strong>
            </span>
          </div>
        </div>
          
          <!-- 送信ボタン -->
        <div class="p-usersEdit__submit">
          <button type="submit" class="c-button__submit">更新する</button>
        </div>
      </form>
  </div>
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
    endpoint:{
      type: String
    },
    user:{
      type: Object
    }
  },
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      User: this.user,
      name: this.old.name ? this.old.name : this.user.name,
      comment: this.old.comment ? this.old.comment : this.user.comment,
      img: this.user.img,
      imgFlg: "",
      uploadImage: "",
      deleteFlg: "",
      error: {
        name: this.errors.name,
        comment: this.errors.comment,
      }
    };
  },
  computed: {
  },
  methods: {
    // ===============================
    //imgFlgのセット
    // ===============================
    setImgFlg() {
      this.imgFlg = this.img
        ? true
        : $(".js-usersEdit__imgInput").val() !== ""
        ? true
        : false;
      return this.imgFlg;
    },
    // ===============================
    //背景画像のセット
    // ===============================
    setInitialBackgroundImage: function() {
      this.uploadImage = this.img
        ? "url(/storage/" + this.img + ")"
        : "url('/images/avatar-plus2.png')";
      return this.uploadImage;
    },
    
    // ===============================
    //画像アップロード時に発火。
    //画像をプレビューするためのメソッド
    // ===============================
    previewImg() {
      let $fileInput = $(".js-usersEdit__imgInput");
      let file = $fileInput.prop("files")[0];
      let $previewArea = $(".js-usersEdit__imgLabel");
      let deleteFlg = $("#js-img__deleteFlg");
      let fileReader = new FileReader();
      
      fileReader.onload = (event) => {
        this.uploadImage =  "url('" + event.target.result + "')";
      };
      // 画像読み込み
      fileReader.readAsDataURL(file);

      this.setImgFlg();
      this.deleteFlg = null;
    },

    // ===============================
    //画像を削除するメソッド
    // ===============================
    deleteImg() {
      let $fileInput = $(".js-usersEdit__imgInput");
      let deleteFlg = $("#js-img__deleteFlg");
      let $previewArea = $(".js-usersEdit__imgLabel");

      $fileInput.val("");
      this.img = "";
      this.setImgFlg();

      this.uploadImage = "url('/images/avatar-plus2.png')";
      this.deleteFlg = 1;
    }
  },
  mounted() {
    this.setImgFlg();
    this.setInitialBackgroundImage();
  }
};
</script>