<template>
  <div class="c-auth">
    <div class="c-auth__logo">
      <a href="/" class="c-auth__logo__link">
        <img src="/images/logo.png" alt="Inspiration" />
      </a>
    </div>
    <div class="c-auth__inner">
      <div class="c-auth__title">ログイン</div>
      <div class="c-auth__form">
        <form method="POST" :action="endpointLogin">
          <input type="hidden" name="_token" :value="csrf" />

          <!-- メールアドレス -->
          <div class="c-auth__formGroup">
            <label for="email" class="c-auth__formLabel">
              メールアドレス
              <span class="c-auth__formLabel__icon c-auth__formLabel__icon--required">必須</span>
            </label>
            <div class="c-auth__formItem">
              <input
                id="email"
                type="email"
                class="c-auth__formInput @error('email') is-invalid @enderror"
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
          <div class="c-auth__formGroup">
            <label for="password" class="c-auth__formLabel">
              パスワード
              <span class="c-auth__formLabel__icon c-auth__formLabel__icon--required">必須</span>
            </label>
            <div class="c-auth__formItem">
              <input
                id="password"
                type="password"
                class="c-auth__formInput @error('password') is-invalid @enderror"
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
          <div class="c-auth__formGroup p-login__formGroup p-login__formGroup--remember">
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
          <div class="c-auth__submit p-login__submit">
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
