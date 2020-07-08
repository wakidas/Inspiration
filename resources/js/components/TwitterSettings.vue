<template>
@if($type === "article")
<meta property="og:url" content="{{ route('articles.show',$article->id) }}" />
<meta property="og:title" content="{{ $article->title }}" />
<meta property="og:description" content="{{ strip_tags($article->body) }}" />

<meta property="og:site_name" content="Inspiration" />
<meta property="og:image" content="https://binq.kiwatchi.com/images/twitter_card4.png" />

<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@nichimachikid" />

</template>
<script>
export default {
  props: [""],
  data() {
    return {
      
    };
  },
  methods: {
    
  },
  mounted() {
   
  }
};
</script>