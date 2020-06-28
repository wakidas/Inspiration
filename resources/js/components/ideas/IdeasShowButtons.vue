<template>
  <div class="p-ideasShow__buttons">
    <div class="p-ideasShow__like">
      <a
        href="javascript:void(0)"
        class="p-ideasShow__button p-ideasShow__button--like"
        :class="{'isliked':this.isLikedBy}"
        @click="clickLike"
      >{{ likeButtonText }}</a>
    </div>
    <div class="p-ideasShow__buy p-ideasShow__buy--ordered" v-if="isOrderedBy">
      <button class="p-ideasShow__button p-ideasShow__button--buy">{{buyButtonText}}</button>
    </div>
    <div class="p-ideasShow__buy" v-else>
      <form :action="endpointBuy" method="POST">
        <input type="hidden" name="_token" :value="csrf" />
        <button class="p-ideasShow__button p-ideasShow__button--buy" type="submit">{{buyButtonText}}</button>
      </form>
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
    isOrderedBy: {
      type: Boolean,
      default: false
    },
    authorized: {
      type: Boolean,
      default: false
    },
    endpoint: {
      type: String
    },
    endpointBuy: {
      type: String
    }
  },
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")
    };
  },
  computed: {
    likeButtonText() {
      return this.isLikedBy
        ? "気になるリストに入っています"
        : "気になるリストへ追加";
    },
    buyButtonText() {
      return this.isOrderedBy ? "購入済みです" : "購入する";
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