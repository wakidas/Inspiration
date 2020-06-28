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
            :initial-is-liked-by="this.isLikedBy"
            :initial-count-likes="this.initialCountLikes"
            :authorized="this.authorized"
            :endpoint="this.endpoint"
          ></IdeasShowButtons>
        </li>
        <li class="p-ideasShow__item">レビュー</li>
        <li class="p-ideasShow__item">
          <IdeasShowButtons
            @like="like"
            :initial-is-liked-by="this.isLikedBy"
            :initial-count-likes="this.initialCountLikes"
            :authorized="this.authorized"
            :endpoint="this.endpoint"
          ></IdeasShowButtons>
        </li>
      </ul>
    </div>
  </section>
</template>

<script>
import IdeasShowButtons from "./IdeasShowButtons";
import axios from "axios";

export default {
  name: "IdeasShow",
  props: {
    idea: {
      type: Object
    },
    category: {
      type: Object
    },
    initialIsLikedBy: {
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
  data() {
    return {
      Idea: this.idea,
      Category: this.category,
      Authorized: this.authorized,
      isLikedBy: this.initialIsLikedBy
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
      console.log("親のlike!");
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
    IdeasShowButtons
  }
};
</script>