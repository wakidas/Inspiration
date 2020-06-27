// =====================================
// nodeモジュールのインポート
// =====================================
import moment from "moment";

// =====================================
// グローバルの vue filter
// =====================================
Vue.filter('addComma', function (val) {
        return Number(val).toLocaleString();
        }
);
Vue.filter('formatDatetime',function (date) {
        return moment(date).format("YY/MM/DD");
        }
);