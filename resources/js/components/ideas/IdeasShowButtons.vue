<template>
  <div class="p-ideasShow__buttons">
    <div class="p-ideasShow__like">
      <a
        href="javascript:void(0)"
        class="p-ideasShow__button p-ideasShow__button--like"
        @click="clickLike"
      >{{ likeButtonText }}</a>
    </div>
    <div class="p-ideasShow__buy">
      <a href="javascript:void(0)" class="p-ideasShow__button p-ideasShow__button--buy">購入する</a>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: {
    isLikedBy: {
      type: Boolean,
      default: false
    },
    initialCountLikes: {
      type: Number,
      default: 0
    },
    authorized: {
      type: Boolean,
      default: false
    },
    endpoint: {
      type: String
    }
  },
  computed: {
    likeButtonText() {
      return this.isLikedBy
        ? "気になるリストに入っています"
        : "気になるリストへ追加";
    }
  },
  methods: {
    clickLike() {
      if (!this.authorized) {
        let confirm_result = window.confirm(
          "いいね機能はログイン中のみ使用できます。ログイン画面へいきますか？"
        );
        if (confirm_result) {
          window.location.href = "/login";
        } else {
          return false;
        }
      }
      this.isLikedBy ? this.unlike() : this.like();
    },
    async like() {
      this.$emit("like");
    },
    async unlike() {
      this.$emit("unlike");
    }
  }
};
</script>