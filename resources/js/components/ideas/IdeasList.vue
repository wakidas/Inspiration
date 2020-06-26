<template>
  <div class="c-idea__card">
    <div class="c-idea__card__inner">
      <div class="c-idea__card__category">{{Category.name}}</div>
      <div class="c-idea__card__img">
        <img :src="ideaImg" alt />
      </div>
      <div class="c-idea__card__priceAndDate">
        <div class="c-idea__card__price">¥ {{Idea.price}}</div>
        <div class="c-idea__card__date">
          <div class="c-idea__card__created">投稿日: {{ formatDatetime(Idea.updated_at) }}</div>
          <div class="c-idea__card__updated">更新日: {{ formatDatetime(Idea.updated_at) }}</div>
        </div>
      </div>
      <div class="c-idea__card__title">{{Idea.title}}</div>
      <div class="c-idea__card__description">{{Idea.description}}</div>
      <div class="c-idea__card__likeAndReview">
        <div class="c-idea__card__like">
          <div class="c-idea__card__like__img">
            <img src="/images/like-icon_w.svg" alt="いいねアイコン" />
          </div>
          <div class="c-idea__card__like__count">{{ likesCount }}</div>
        </div>
        <div class="c-idea__card__review">{{Idea.description}}</div>
      </div>
      <div class="c-idea__card__user">
        <div class="c-idea__card__user__img">
          <img :src="userImg" alt />
        </div>
        <div class="c-idea__card__user__name">{{ User.name }}</div>
      </div>
    </div>
  </div>
</template>
<script>
import moment from "moment";

export default {
  props: {
    idea: {
      type: Object
    },
    user: {
      type: Object
    },
    category: {
      type: Object
    },
    like: {
      type: Object
    }
  },
  data() {
    return {
      Idea: this.idea,
      User: this.user,
      Category: this.category,
      LikesCount: this.likesCount
    };
  },
  computed: {
    userImg() {
      return this.User.img !== null ? this.User.img : "/images/noavatar.png";
    },
    ideaImg() {
      return this.Idea.img !== null
        ? "/storage/" + this.Idea.img
        : "/images/noimage.png";
    },
    likesCount() {
      return this.LikesCount ? this.LikesCount : 0;
    },
    formatDatetime: function() {
      return function(date) {
        return moment(date).format("YY/MM/DD");
      };
    }
  }
};
</script>