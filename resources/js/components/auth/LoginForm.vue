<template>
  <div class="p-login">
    <div class="p-login__logo">
      <a href="/" class="p-login__logo__link">
        <img src="/images/logo.png" alt="Inspiration" />
      </a>
    </div>
    <div class="p-login__inner">
      <div class="p-login__title">ログイン</div>
      <div class="p-login__form">
        <form method="POST" :action="endpointLogin">
          <input type="hidden" name="_token" :value="csrf" />

          <!-- メールアドレス -->
          <div class="p-login__formGroup">
            <label for="email" class="p-login__formLabel">
              メールアドレス
              <span class="c-formLabel c-formLabel--required">必須</span>
            </label>
            <div class="p-login__formItem">
              <input
                id="email"
                type="email"
                class="p-login__formInput @error('email') is-invalid @enderror"
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
          <div class="p-login__formGroup">
            <label for="password" class="p-login__formLabel">
              パスワード
              <span class="c-formLabel c-formLabel--required">必須</span>
            </label>
            <div class="p-login__formItem">
              <input
                id="password"
                type="password"
                class="p-login__formInput @error('password') is-invalid @enderror"
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

          <!-- ログインしたままにする -->
          <div class="p-login__formGroup p-login__formGroup--remember">
            <input
              class="p-login__formInput p-login__formInput--remember"
              type="checkbox"
              name="remember"
              id="remember"
            />
            <label class="p-login__formCheck" for="remember">ログインしたままにする</label>
          </div>

          <div class="p-login__passreset">
            パスワードを忘れた方は
            <span>
              <a :href="endpointRequest" class="p-login__resetLink">こちら</a>
            </span>
          </div>

          <!-- 送信ボタン -->
          <div class="p-login__submit">
            <button type="submit" class="c-button__submit">ログインする</button>
          </div>

          <!-- 登録画面への導線 -->
          <div class="p-login__toRegister">
            まだ登録されていない方は
            <a class="p-login__toRegister__link" href="/register">こちら</a>
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
      remember: this.old.remember,
      error: {
        email: this.errors.email,
        password: this.errors.password
      }
    };
  }
};
</script>
