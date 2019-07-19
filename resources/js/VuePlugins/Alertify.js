import alertify from 'alertifyjs';

require('alertifyjs/build/css/alertify.min.css');

const VueAlertify = {
    install(Vue) {
        window.alertify = Vue.alertify = alertify;
        Object.defineProperty(Vue.prototype, '$alertify', {
            get: function get() {
                return alertify;
            }
        });
    }
};

export default VueAlertify
