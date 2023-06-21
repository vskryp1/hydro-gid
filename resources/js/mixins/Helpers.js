import _ from "lodash";

export default {
    data(){
        return {
            /*Data*/
            __dataLoading: false,
            __dataRoute: '',

            /*Paginate*/
            __paginateLoading: false,
            __paginate: null,
            __paginateQuery: {
                page: 1,
                per_page: 12,
                search: null
            },
            __paginateRoute: null
        }
    },
    methods: {

        /*Helper Functions*/
        __errorResponse(error){
            if (error.response.status === 422){
                for (const [key, value] of Object.entries(error.response.data.errors)) {
                    this.errors.add({
                        field: key,
                        msg: value[0] || value
                    })
                }
            }
            this.$store.commit("setAlert",
                {type: 'error', message: error.response.data.message || error.response.status}
            );
        },

        __makeId(length = 9){
            let result = '';
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            const charactersLength = characters.length;
            for (let i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        },

        __formatAmount(value, currency = 'USD', minFraction = 2, maxFraction= 2) {
            return value || ~value ? (Number(value)).toLocaleString('en-US', {
                style: 'currency',
                currency: currency,
                minimumFractionDigits: minFraction,
                maximumFractionDigits: maxFraction
            }) : null
        },

        __copyObject(obj){
            return JSON.parse(JSON.stringify(obj));
        },

        __cutText(text, length){
            return text.length > length? text.slice(0, length)+'...': text;
        },

        __valToText(val){
            return val.replaceAll("_", " ").replace(/\b\w/g, l => l.toUpperCase())
        },

        /*Validation*/
        __addressError(val, field){
            val?
                this.errors.add({field: field, msg: 'Please select valid address'}):
                this.errors.remove(field)
        },

        /*Requests*/
        __getData(options = {loader: false, route: null, params: {}, locals: []}) {

            if (options.loader){
                this.$store.commit('loader', true)
            }

            this.$data.__dataLoading = true;
            const route = this.$store.state.path + (options.route || this.$data.__dataRoute);
            axios.get(route, {params: options.params || {}})
                .then(response => {

                    for (const [objKey, objValue] of Object.entries(response.data)) {
                        const value = objValue && typeof objValue === 'object' && !Array.isArray(objValue) ?
                            {...objValue} : objValue;

                        options.locals && options.locals.includes(_.camelCase(objKey))?
                            this.$data['__'+_.camelCase(objKey)] = value:
                            this[_.camelCase(objKey)] = value;
                    }
                    this.$data.__dataLoading = false;

                    if (options.loader){
                        setTimeout(() => this.$store.commit('loader', false), 250);
                    }
                })
                .catch(error => {
                    this.$data.__dataLoading = false;
                    this.__errorResponse(error);
                    if (options.loader){
                        setTimeout(() => this.$store.commit('loader', false), 250);
                    }
                })
        },

        __getPaginate(q = {}, options = {route: null, loader: false}){
            if (options.loader){
                this.$store.commit('loader', true)
            }
            for (const [key, value] of Object.entries(q)) {
                this.$data.__paginateQuery[key] = value;
            }
            if (!q.page){
                this.$data.__paginateQuery.page = 1;
            }
            this.__paginateLoading = true;
            axios.get(this.$store.state.path + (options.route || this.$data.__paginateRoute),{ params: this.$data.__paginateQuery })
                .then(response => {
                    this.$data.__paginateLoading = false;
                    this.$data.__paginate = response.data;
                })
                .catch(error => {
                    this.$data.__paginateLoading = false;
                    this.__errorResponse(error);
                    if (options.loader){
                        setTimeout(() => this.$store.commit('loader', false), 250);
                    }
                })
        },

        /*Routes*/
        __getRouteQuery(){
            let uri = window.location.href.split('?');
            if(uri.length === 2) {
                let vars = uri[1].split('&');
                let getVars = {};
                let tmp = '';
                vars.forEach(function(v) {
                    tmp = v.split('=');
                    if(tmp.length === 2)
                        getVars[tmp[0]] = tmp[1];
                });
                return getVars;
            }
            return {}
        },

        /*Middlewares*/
        __middlewareAuth(callback, args = null){
            this.$store.state.user?
                callback(args):
                this.$store.commit('login', {callback: callback, args: args});
        },
    },
}
