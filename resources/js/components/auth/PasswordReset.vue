<template>
  <div class="p-passwordReset">
    <div class="p-passwordReset__inner">
      <div class="p-passwordReset__title">新しいパスワードを設定</div>
      <div class="p-passwordReset__form">
        <form method="POST" :action="endpoint">
          <input type="hidden" name="_token" :value="csrf" />
          <input type="hidden" name="token" :value="token" />
          <!-- メールアドレス -->
          <div class="p-passwordReset__formGroup">
            <label for="email" class>メールアドレス</label>
            <div class="p-passwordReset__formItem">
              <input
                id="email"
                type="email"
                class="p-passwordReset__formInput"
                name="email"
                v-model="email"
                required
                autocomplete="email"
              />

              <span class="c-error" role="alert" v-for="value in error.email" :key="value.email">
                <strong>{{ value }}</strong>
              </span>
            </div>
          </div>

          <!-- パスワード -->
          <div class="p-passwordReset__formGroup">
            <label for="password" class>パスワード</label>
            <div class="p-passwordReset__formItem">
              <input
                id="password"
                type="password"
                class="p-passwordReset__formInput"
                name="password"
                v-model="password"
                required
              />
              <span class="c-error" role="alert" v-for="value in error.password" :key="value.id">
                <strong>{{ value }}</strong>
              </span>
            </div>
          </div>

          <!-- パスワード確認 -->
          <div class="p-passwordReset__formGroup">
            <label for="password_confirmation" class>パスワード確認</label>
            <div class="p-passwordReset__formItem">
              <input
                id="password_confirmation"
                type="password"
                class="p-passwordReset__formInput"
                name="password_confirmation"
                v-model="password_confirmation"
                required
              />
            </div>
          </div>

          <!-- 送信ボタン -->
          <div class="p-passwordReset__submit">
            <button type="submit" class="c-button__submit">送信</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["token", "old", "errors", "endpoint"],
  data: function() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      email: this.old.email,
      password: "",
      password_confirmation: "",
      error: {
        email: this.errors.email,
        password: this.errors.password
      }
    };
  }
};
</script>
