import jquery from "jquery";
window.$ = jquery;

// =====================================
// Vueコンポーネント
// =====================================
//共通
import FlashMessage from "./components/FlashMessage";

//ユーザー認証関係
import RegisterForm from "./components/auth/RegisterForm";
import LoginForm from "./components/auth/LoginForm";
import PasswordEmail from "./components/auth/PasswordEmail";
import PasswordReset from "./components/auth/PasswordReset";
import ChangeEmail from "./components/auth/ChangeEmail";
import ChangePassword from "./components/auth/ChangePassword";

//アイデアページ
import IdeasSearchBox from "./components/ideas/IdeasSearchBox";
import IdeasList from "./components/ideas/IdeasList";

// =====================================
// jsファイル
// =====================================
require('./components/footerFixed');
require('./components/drawerMenu');

window.Vue = require('vue');



//vueコンポーネントを使用する
const app = new Vue({
    el: "#app",
    components: {
        FlashMessage,
        LoginForm,
        PasswordEmail,
        PasswordReset,
        ChangeEmail,
        ChangePassword,
        RegisterForm,
        IdeasSearchBox,
        IdeasList,
    }
});