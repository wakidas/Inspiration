<template>
  <li class="p-ideasShow__item p-ideasShow__item--action">
    <div class="p-ideasShow__action">
      <a :href="endpointEdit">
        <img src="/images/idea-edit.svg" alt="編集ボタン" />
      </a>
    </div>
    <div class="p-ideasShow__action" @click="this.delete">
      <form id="idea-delete" method="POST" :action="endpointDelete">
        <input type="hidden" name="_token" :value="csrf" />
        <img src="/images/idea-delete.svg" alt="削除ボタン" />
      </form>
    </div>
  </li>
</template>

<script>
import axios from "axios";

export default {
  props: {
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
        .getAttribute("content")
    };
  },
  computed: {},
  methods: {
    delete(e) {
      e.preventDefault();
      const confirm_result = window.confirm(
        "このアイデアを削除します。よろしいですか？"
      );
      if (confirm_result) {
        $("#idea-delete").submit();
      } else {
        return false;
      }
    }
  }
};
</script>