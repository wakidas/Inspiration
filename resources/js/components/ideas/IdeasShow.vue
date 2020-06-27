<template>
  <section class="p-ideasShow">
    <div class="p-ideasShow__inner">
      <div class="p-ideasShow__img">
        <img :src="ideaImg" alt="サムネイル画像" />
      </div>
      <div class="p-ideasShow__title">{{ Idea.title }}</div>
      <div class="p-ideasShow__date">
        <div class="p-ideasShow__created"></div>
        <div class="p-ideasShow__updated"></div>
      </div>
      <div class="p-ideasShow__price">{{ Idea.price }}</div>
      <div class="p-ideasShow__category">{{ Category.name }}</div>
      <div class="p-ideasShow__description">{{ Idea.description }}</div>
      <div class="p-ideasShow__body">{{ Idea.body }}</div>
      <div class="p-ideasShow__like"></div>
      <IdeasShowButtons></IdeasShowButtons>
    </div>
  </section>
</template>

<script>
import IdeasShowButtons from "./IdeasShowButtons";

export default {
  name: "IdeasShow", // ← これが記入されているか
  props: {
    idea: {
      type: Object
    },
    category: {
      type: Object
    }
  },
  data() {
    return {
      Idea: this.idea,
      Category: this.category
    };
  },
  computed: {
    ideaImg() {
      return this.Idea.img !== null
        ? "/storage/" + this.Idea.img
        : "/images/noimage.png";
    }
  },
  components: {
    IdeasShowButtons
  }
};
</script>