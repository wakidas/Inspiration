<template>
  <div class="c-idea__card js-ideaCard">
    <a :href="endpoint">
      <div class="c-idea__card__inner">
        <div class="c-idea__card__category">{{Category.name}}</div>
        <div class="c-idea__card__img">
          <img :src="ideaImg" alt />
        </div>
        <div class="c-idea__card__priceAndDate">
          <div class="c-idea__card__price">¥ {{ Idea.price | addComma }}</div>
          <div class="c-idea__card__date">
            <div class="c-idea__card__created">投稿日: {{ formatDatetime(Idea.created_at) }}</div>
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
            <div class="c-idea__card__like__count">{{ countLikes}}</div>
          </div>
          <div class="c-idea__card__review">
            <div class="c-idea__card__review__rate">{{ fixedRate }}</div>
            <div class="c-idea__card__review__rate">
              <star-rating
                v-model="this.Rate"
                :read-only="true"
                :star-size="15"
                :fixed-points="1"
                :show-rating="false"
                :increment="0.1"
              ></star-rating>
            </div>
            <div class="c-idea__card__review__rate">( {{ this.ReviewCount }} )</div>
          </div>
        </div>
        <div class="c-idea__card__user">
          <div class="c-idea__card__user__img">
            <img :src="userImg" alt />
          </div>
          <div class="c-idea__card__user__name">{{ User.name }}</div>
        </div>
      </div>
    </a>
  </div>
</template>
<script>
import StarRating from "vue-star-rating";
import moment from "moment";

export default {
  props: {
    endpoint: {
      type: String
    },
    idea: {
      type: Object
    },
    user: {
      type: Object
    },
    category: {
      type: Object
    },
    likesCount: {
      type: Object,
      required: false
    },
    avgRate: {
      type: Number
    },
    reviewCount: {
      type: Number
    }
  },
  data() {
    return {
      Idea: this.idea,
      User: this.user,
      Category: this.category,
      LikesCount: this.likesCount,
      Rate: this.avgRate,
      ReviewCount: this.reviewCount
    };
  },
  computed: {
    userImg() {
      return this.User.img !== null
        ? "/storage/" + this.User.img
        : "/images/noavatar.png";
    },
    ideaImg() {
      return this.Idea.img !== null
        ? "/storage/" + this.Idea.img
        : "/images/noimage.png";
    },
    countLikes() {
      return this.LikesCount ? this.LikesCount : 0;
    },
    formatDatetime: function() {
      return function(date) {
        return moment(date).format("YY/MM/DD");
      };
    },
    fixedRate() {
      return this.Rate ? this.Rate.toFixed(1) : "";
    }
  },
  components: {
    StarRating
  }
};
</script>