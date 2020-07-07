// =====================================
// 共通モジュール
// =====================================
import jquery from "jquery";
window.$ = jquery;
window.Vue = require('vue');

// =====================================
// jsファイル
// =====================================
require('./components/footerFixed');
require('./components/drawerMenu');
require('./components/setBodyBgColor');
require('./components/jquery.validate/jquery.validate.js');
require('./components/jquery.validate/localization/messages_ja.js');
require('./components/validate');

require('./components/filter');
// =====================================
// Vueコンポーネントのインポート
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
import IdeasForm from "./components/ideas/IdeasForm";
import IdeasShow from "./components/ideas/IdeasShow";

//ユーザーページ
import UsersProfile from "./components/users/UsersProfile";
import UsersEdit from "./components/users/UsersEdit";

//マイページ
import MypageSettings from "./components/mypage/MypageSettings";
import MypageTabs from "./components/mypage/MypageTabs";
import MypageIdeas from "./components/mypage/MypageIdeas";
import MypageReviews from "./components/mypage/MypageReviews";

//vueコンポーネンとの宣言
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
        IdeasForm,
        IdeasShow,
        UsersProfile,
        UsersEdit,
        MypageSettings,
        MypageTabs,
        MypageIdeas,
        MypageReviews
    },
});
