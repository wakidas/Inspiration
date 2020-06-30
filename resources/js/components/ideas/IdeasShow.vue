<template>
  <section class="p-ideasShow">
    <div class="p-ideasShow__inner">
      <ul>
        <li class="p-ideasShow__item">
          <div class="p-ideasShow__img">
            <img :src="ideaImg" alt="サムネイル画像" />
          </div>
        </li>
        <li class="p-ideasShow__item">
          <div class="p-ideasShow__title">{{ Idea.title }}</div>
        </li>
        <li class="p-ideasShow__item">
          <div class="p-ideasShow__date">
            <div class="p-ideasShow__created">投稿日: {{Idea.updated_at|formatDatetime}}</div>
            <div class="p-ideasShow__updated">投稿日: {{Idea.created_at|formatDatetime}}</div>
          </div>
        </li>
        <li class="p-ideasShow__item">
          <div class="p-ideasShow__price">¥ {{ Idea.price | addComma }}</div>
        </li>
        <li class="p-ideasShow__item">
          <div class="p-ideasShow__category"># {{ Category.name }}</div>
        </li>
        <li class="p-ideasShow__item">
          <div class="p-ideasShow__description">{{ Idea.description }}</div>
        </li>
        <li class="p-ideasShow__item">
          <div class="p-ideasShow__body">{{ Idea.body }}</div>
        </li>
        <li class="p-ideasShow__item">
          <div class="p-ideasShow__like"></div>
        </li>
        <li class="p-ideasShow__item">
          <IdeasShowButtons
            @like="like"
            @unlike="unlike"
            :is-liked-by="this.isLikedBy"
            :initial-count-likes="this.initialCountLikes"
            :is-ordered-by="this.isOrderedBy"
            :authorized="this.authorized"
            :endpoint="this.endpoint"
            :endpoint-buy="endpointBuy"
          ></IdeasShowButtons>
        </li>
        <li class="p-ideasShow__item p-ideasShow__item--review">
          <ul class="p-ideasShowReview">
            <li>
              <div class="p-ideasShowReview__title">レビューを投稿する</div>
              <form action="/reviews/create" method="POST">
                <input type="hidden" name="_token" :value="csrf" />
                <input type="hidden" name="idea_id" :value="idea.id" />
                <input type="hidden" name="user_id" :value="idea.user_id" />

                <div class="p-ideasShowReview__rate">
                  <input type="hidden" name="rate" :value="rating" />
                  <star-rating v-model="rating" :star-size="30" :fixed-points="1"></star-rating>
                </div>
                <div class="p-ideasShowReview__comment">
                  <textarea
                    class="p-ideasShowReview__comment__textarea"
                    name="comment"
                    id
                    cols="30"
                    rows="10"
                  ></textarea>
                </div>
                <!-- 送信ボタン -->
                <div class="p-ideasShowReview__submit">
                  <button type="submit" class="c-button__submit">投稿する</button>
                </div>
              </form>
            </li>
            <li>
              <ul class="p-ideasShowReview__list">
                <li v-for="item in Reviews" :key="item.id">
                  {{ item.id }}
                  <div class="p-ideasShowReview__rate">
                    <star-rating
                      v-model="item.rate"
                      :read-only="true"
                      :star-size="30"
                      :fixed-points="1"
                    ></star-rating>
                  </div>
                  <div class="p-ideasShowReview__body">{{ item.comment }}</div>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="p-ideasShow__item">
          <IdeasShowButtons
            @like="like"
            @unlike="unlike"
            :is-liked-by="this.isLikedBy"
            :initial-count-likes="this.initialCountLikes"
            :is-ordered-by="this.isOrderedBy"
            :authorized="this.authorized"
            :endpoint="this.endpoint"
            :endpoint-buy="endpointBuy"
          ></IdeasShowButtons>
        </li>
      </ul>
    </div>
  </section>
</template>

<script>
import IdeasShowButtons from "./IdeasShowButtons";
import axios from "axios";
import StarRating from "vue-star-rating";

export default {
  name: "IdeasShow",
  props: {
    idea: {
      type: Object
    },
    category: {
      type: Object
    },
    reviews: {
      type: Array
    },
    initialIsLikedBy: {
      type: Boolean,
      default: false
    },
    initialCountLikes: {
      type: Number,
      default: 0
    },
    initialIsOrderedBy: {
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
        .getAttribute("content"),
      Idea: this.idea,
      Category: this.category,
      Reviews: this.reviews[0].reviews,
      Authorized: this.authorized,
      isLikedBy: this.initialIsLikedBy,
      // isOrderedBy: this.initialIsOrderedBy,
      isOrderedBy: false,
      rating: 0
    };
  },
  computed: {
    ideaImg() {
      return this.Idea.img !== null
        ? "/storage/" + this.Idea.img
        : "/images/noimage.png";
    }
  },
  methods: {
    async like() {
      const response = await axios.put(this.endpoint);

      this.isLikedBy = true;
      this.countLikes = response.data.countLikes;
    },
    async unlike() {
      const response = await axios.delete(this.endpoint);

      this.isLikedBy = false;
      this.countLikes = response.data.countLikes;
    }
  },
  components: {
    IdeasShowButtons,
    StarRating
  }
};
</script>