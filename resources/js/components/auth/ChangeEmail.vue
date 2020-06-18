<template>
  <div class="p-changeEmail">
    <div class="p-changeEmail__inner">
      <div class="p-changeEmail__title">メールアドレス変更</div>

      <div class="p-changeEmail__form">
        <form method="POST" :action="endpoint">
          <input type="hidden" name="_token" :value="csrf" />

          <!-- メールアドレス -->
          <div class="p-changeEmail__formGroup">
            <label for="email" class>新しいメールアドレスを入力してください。</label>
            <div class="p-changeEmail__formItem">
              <input
                id="new_email"
                type="email"
                class="p-changeEmail__formInput @error('email') is-invalid @enderror"
                name="new_email"
                v-model="new_email"
                required
                autocomplete="email"
                placeholder="新しいメールアドレス"
              />

              <span
                class="c-error"
                role="alert"
                v-for="value in error.new_email"
                :key="value.new_email"
              >
                <strong>{{ value }}</strong>
              </span>
            </div>
          </div>

          <!-- 送信ボタン -->
          <div class="p-changeEmail__submit">
            <button type="submit" class="c-button__submit">メール送信</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["old", "errors", "endpoint"],
  data: function() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      new_email: this.old.new_email,
      error: {
        new_email: this.errors.new_email
      }
    };
  }
};
</script>
