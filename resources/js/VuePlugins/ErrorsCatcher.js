const VueErrorsCatcher = {
    install(Vue) {
        const errorsCatcher = function (response) {
            if (
                this
                &&
                this.hasOwnProperty('errors')
                &&
                response.hasOwnProperty('data')
                &&
                response.data.hasOwnProperty('errors')
            ) {
                this.errors = response.data.errors;
            }
            window.alertify.error('Не удалось выполнить операцию');
            console.error(`errorsCatcher: ${JSON.stringify(response.data.errors)}`);
        };

        Vue.errorsCatcher = errorsCatcher;

        Object.defineProperty(Vue.prototype, '$errorsCatcher', {
            get: function get() {
                return errorsCatcher;
            }
        });
    }
};

export default VueErrorsCatcher
