<template>
  <div class="p-register">
    <div class="p-register__logo">
      <a href="/" class="p-register__logo__link">
        <img src="/images/logo.png" alt="Inspiration" />
      </a>
    </div>
    <div class="p-register__inner">
      <div class="p-register__title">新規登録</div>
      <div class="p-register__form">
        <form method="POST" :action="endpointLogin">
          <input type="hidden" name="_token" :value="csrf" />

          <!-- メールアドレス -->
          <div class="p-register__formGroup">
            <label for="email" class>メールアドレス</label>
            <div class="p-register__formItem">
              <input
                id="email"
                type="email"
                class="p-register__formInput"
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
          <div class="p-register__formGroup">
            <label for="password" class>パスワード</label>
            <div class="p-register__formItem">
              <input
                id="password"
                type="password"
                class="p-register__formInput"
                name="password"
                v-model="password"
                required
                autocomplete="current-password"
              />
              <span class="c-error" role="alert" v-for="value in error.password" :key="value.id">
                <strong>{{ value }}</strong>
              </span>
            </div>
          </div>

          <!-- パスワード 再入力 -->
          <div class="p-register__formGroup">
            <label for="password" class>パスワード（再入力）</label>
            <div class="p-register__formItem">
              <input
                id="password"
                type="password"
                class="p-register__formInput"
                name="password-confirm"
                v-model="passwordConfirm"
                required
              />
            </div>
          </div>

          <!-- 送信ボタン -->
          <div class="p-register__submit">
            <button type="submit" class="c-button__submit">登録する</button>
          </div>

          <!-- ログイン画面への導線 -->
          <div class="p-register__toLogin">
            ログインは
            <a class="p-register__toLogin__link" href="/login">こちら</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["old", "errors", "endpointLogin", "endpointRequest"],
  data: function() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      email: this.old.email,
      password: "",
      passwordConfirm: "",
      error: {
        email: this.errors.email,
        password: this.errors.password
      }
    };
  }
};
</script>
