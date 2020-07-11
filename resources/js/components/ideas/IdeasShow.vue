<template>
  <section class="p-ideasShow">
    <div class="p-ideasShow__inner">
      <ul>
        <li class="p-ideasShow__item p-ideasShow__item--img">
          <div class="p-ideasShow__img">
            <img :src="ideaImg" alt="サムネイル画像" />
          </div>
        </li>

        <!-- 編集・削除ボタン -->
        <ideas-action-buttons
          :endpoint-edit="endpointEdit"
          :endpoint-delete="endpointDelete"
          :is-ordered-at-least-one="isOrderedAtLeastOne"
          v-if="isMyIdea"
        ></ideas-action-buttons>

        <li class="p-ideasShow__item">
          <div class="p-ideasShow__title">{{ Idea.title }}</div>
        </li>
        <li class="p-ideasShow__item">
          <div class="p-ideasShow__date">
            <div class="p-ideasShow__created">更新日: {{Idea.updated_at|formatDatetime}}</div>
            <div class="p-ideasShow__updated">投稿日: {{Idea.created_at|formatDatetime}}</div>
          </div>
        </li>
        <li class="p-ideasShow__item">
          <a :href="endpointIdeaUser" class="p-ideasShow__toIdeaUser">
            <div class="p-ideasShow__user">
              <div class="p-ideasShow__user__img">
                <img
                  :src="ideaUser.img!== null?'/storage/'+ideaUser.img:'/images/noavatar.png'"
                  alt
                />
              </div>
              <div class="p-ideasShow__user__name">{{ ideaUser.name }}</div>
            </div>
          </a>
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
        <li class="p-ideasShow__item p-ideasShow__item--body">
          <div class="p-ideasShow__body" v-if="isOrderedBy || isMyIdea">{{ Idea.body }}</div>
          <div class="p-ideasShow__body" v-else>アイデアの内容は、購入したユーザーのみご覧いただけます。</div>
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
            :user-id="this.userId"
            :idea-user="this.ideaUser"
            v-if="!checkMyIdea"
          ></IdeasShowButtons>
        </li>
        <li class="p-ideasShow__item">
          <div class="p-ideasShow__likes">気になるリスト登録数：{{ countLikes }}</div>
        </li>
        <li class="p-ideasShow__item">
          <a href="#reviews" class="p-ideasShow__avgRate__link">
            <div class="p-ideasShow__avgRate">
              <div class="p-ideasShow__avgRate__item">{{ fixedRate }}</div>
              <div class="p-ideasShow__avgRate__item">
                <star-rating
                  v-model="this.Rate"
                  :read-only="true"
                  :star-size="15"
                  :fixed-points="1"
                  :show-rating="false"
                  :increment="0.1"
                ></star-rating>
              </div>
              <div class="p-ideasShow__avgRate__item">( {{ this.ReviewCount }} )</div>
            </div>
          </a>
        </li>
        <li class="p-ideasShow__item">
          <div class="p-ideasShow__twitter">
            <a
              target="_blank"
              :href="'https://twitter.com/intent/tweet?text=Inspiration そのアイデア、形にしませんか%3F&url='+endpointForTwitter"
            >
              <img src="/images/tw-icon.svg" alt="twitterシェア" />
            </a>
            <span class="p-ideasShow__twitter__text">SHARE</span>
          </div>
        </li>
        <li class="p-ideasShow__item p-ideasShow__item--review">
          <ul id="reviews" class="p-ideasShowReview">
            <li
              class="p-ideasShowReview__item p-ideasShowReview__item--post"
              v-if="!checkMyIdea && isOrderedBy"
            >
              <div class="p-ideasShowReview__title">レビューを投稿する</div>
              <form id="form" action="/reviews/create" method="POST">
                <input type="hidden" name="_token" :value="csrf" />
                <input type="hidden" name="idea_id" :value="idea.id" />
                <input type="hidden" name="user_id" :value="userId" />

                <div class="p-ideasShowReview__rate js-validTarget" v-if="!isReviewedBy">
                  <input type="hidden" class name="rate" :value="rating" />
                  <star-rating v-model="rating" :star-size="20" :fixed-points="1"></star-rating>
                  <span class="c-error" role="alert" v-for="value in error.rate" :key="value.rate">
                    <strong>{{ value }}</strong>
                  </span>
                </div>
                <div class="p-ideasShowReview__comment js-validTarget">
                  <textarea
                    class="p-ideasShowReview__comment__textarea"
                    name="comment"
                    cols="30"
                    rows="10"
                    v-model="comment"
                    required
                    :disabled="disabled"
                    :placeholder="placeholder"
                  ></textarea>
                  <span
                    class="c-error"
                    role="alert"
                    v-for="value in error.comment"
                    c
                    :key="value.comment"
                  >
                    <strong>{{ value }}</strong>
                  </span>
                </div>
                <!-- 送信ボタン -->
                <div class="p-ideasShowReview__submit" v-if="!isReviewedBy">
                  <button type="submit" class="c-button__submit">投稿する</button>
                </div>
              </form>
            </li>
            <li class="p-ideasShowReview__item p-ideasShowReview__item--allTitle">
              <div class="p-ideasShowReview__title">投稿されたレビュー一覧</div>
            </li>
            <li>
              <ul class="p-ideasShowReview__list">
                <li v-for="item in Reviews" :key="item.id">
                  <div class="p-ideasShowReview__rateDate">
                    <star-rating
                      v-model="item.rate"
                      :read-only="true"
                      :star-size="15"
                      :fixed-points="1"
                    ></star-rating>
                    <div
                      class="p-ideasShowReview__created"
                    >投稿日： {{ item.created_at|formatDatetime }}</div>
                  </div>
                  <a :href="'/users/'+item.user_id" class="p-ideasShow__toReviewUser">
                    <div class="p-ideasShowReview__user">
                      <div class="p-ideasShowReview__user__img">
                        <img
                          :src="item.user.img!== null?'/storage/'+item.user.img:'/images/noavatar.png'"
                          alt
                        />
                      </div>
                      <div class="p-ideasShowReview__user__name">{{ item.user.name }}</div>
                    </div>
                  </a>
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
            :user-id="this.userId"
            :idea-user="this.ideaUser"
            v-if="!checkMyIdea"
          ></IdeasShowButtons>
        </li>
      </ul>
    </div>
  </section>
</template>

<script>
import IdeasShowButtons from "./IdeasShowButtons";
import IdeasActionButtons from "./IdeasActionButtons";

import axios from "axios";
import StarRating from "vue-star-rating";

export default {
  name: "IdeasShow",
  props: {
    old: {},
    errors: {},
    idea: {
      type: Object
    },
    ideaUser: {
      type: Object
    },
    userId: {
      type: Number
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
    isOrderedAtLeastOne: {
      type: Boolean
    },
    initialIsReviewedBy: {
      type: Boolean,
      default: false
    },
    authorized: {
      type: Boolean,
      default: false
    },
    avgRate: {
      type: Number
    },
    reviewCount: {
      type: Number
    },
    endpoint: {
      type: String
    },
    endpointBuy: {
      type: String
    },
    endpointForTwitter: {
      type: String
    },
    endpointIdeaUser: {
      type: String
    },
    endpointEdit: {
      type: String
    },
    endpointDelete: {
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
      countLikes: this.initialCountLikes,
      isOrderedBy: this.initialIsOrderedBy,
      isReviewedBy: this.initialIsReviewedBy,
      isMyIdea: "",
      Rate: this.avgRate,
      ReviewCount: this.reviewCount,
      endpointReviewUser: "",
      placeholder: this.initialIsReviewedBy ? "すでにレビュー投稿済みです" : "",
      disabled: this.initialIsReviewedBy ? true : false,
      rating: this.old.rate ? Number(this.old.rate) : 0,
      comment: this.old.comment ? this.old.comment : "",
      error: {
        rate: this.errors.rate,
        comment: this.errors.comment
      }
    };
  },
  computed: {
    ideaImg() {
      return this.Idea.img !== null
        ? "/storage/" + this.Idea.img
        : "/images/noimage.png";
    },
    checkMyIdea() {
      this.userId === this.ideaUser.id
        ? (this.isMyIdea = true)
        : (this.isMyIdea = false);
      return this.isMyIdea;
    },
    fixedRate() {
      return this.Rate ? this.Rate.toFixed(1) : "";
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
    IdeasActionButtons,
    StarRating
  }
};
</script>