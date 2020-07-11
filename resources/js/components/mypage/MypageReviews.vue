<template>
  <div class="p-mypage__reviews__item">
    <div class="p-mypage__reviews__user">
      <div class="p-mypage__reviews__userImg" :style="'background-image: url('+userImg+')'"></div>
      <div class="p-mypage__reviews__userName">{{ user.name}}</div>
    </div>
    <div class="p-mypage__reviews__reviewRate">
      <star-rating v-model="review.rate" :read-only="true" :star-size="10" :fixed-points="1"></star-rating>
    </div>
    <div class="p-mypage__reviews__reviewComment">{{ review.comment}}</div>
    <div class="p-mypage__reviews__idea">
      <div class="p-mypage__reviews__ideaTitle">購入した商品： {{ review.ideas.title}}</div>
      <div class="p-mypage__reviews__toIdeaShow">
        <a :href="endpoint">詳細を見る</a>
      </div>
    </div>
  </div>
</template>
<script>
import StarRating from "vue-star-rating";

export default {
  props: {
    review: {
      type: Object
    },
    user: {
      type: Object
    },
    endpoint: {
      type: String
    },
    type: {
      type: String
    }
  },
  data() {
    return {};
  },
  computed: {
    userImg() {
      return this.review.users.img !== null
        ? "/storage/" + this.user.img
        : "/images/noavatar.png";
    },
    ideaImg() {
      return this.idea.img !== null
        ? "/storage/" + this.idea.img
        : "/images/noimage.png";
    }
  },
  methods: {},
  mounted() {},
  components: {
    StarRating
  }
};
</script>