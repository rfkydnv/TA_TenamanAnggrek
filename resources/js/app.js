/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
// import Vue from "vue";
import { ValidationProvider, ValidationObserver ,extend } from 'vee-validate';
import * as rules from 'vee-validate/dist/rules';
import id from 'vee-validate/dist/locale/id';
import accounting from 'accounting';
import VueJqueryMask from 'vue-jquery-mask';

// loop over all rules
for (let rule in rules) {
    extend(rule, {
        ...rules[rule], // add the rule
        message: id.messages[rule] // add its message
    });
}
extend('password', {
    validate: (value, { other }) => value === other,
    message: 'password konfirmasi tidak sama.',
    params: [{ name: 'other', isTarget: true }]
});

extend('date', {
    computesRequired: true,
    validate: value => {
        const isEmpty = !!(!value || value.length < 10);
        return{
            valid: !isEmpty,
            required:true
        };
        return true;
    },
    message: value =>{return 'format tanggal harus lengkap Ex. 01-12-1970'}
});

require('./bootstrap');
window.Vue = require('vue');
window.VeeValidate = require('vee-validate');
window.Vue.use(window.VeeValidate);
window.accounting = accounting;

Vue.filter('rupiah', (val) => {
  return accounting.formatMoney(val, "Rp", 0, ".", ",");
});

Vue.filter('numeric', (val) => {
  return accounting.formatMoney(val, "", 0, ".", ",");
});


// window.Pjax = require('pjax');
// import pjaxAdapter from 'vue-pjax-adapter';

// window.Vue.use(pjaxAdapter, {
//     targetSelector: '.core-content-body',
// });
// Register it globally

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
// Vue.use(clipboard);
Vue.component('validation-provider', ValidationProvider);
Vue.component('validation-observer', ValidationObserver);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('date-picker', require('./components/Date-picker.vue').default);
Vue.component('time-picker', require('./components/Time-picker.vue').default);
Vue.component('multi-select', require('./components/Multiselect.vue').default);
Vue.component('select-2-url', require('./components/Select2Url.vue').default);
// Vue.directive('select-2', {
//     inserted: function (el, binding, vnode) {
//         let options = binding.value || {};
//         // console.log(el.attributes[1].value);

        // if(el.attributes[1].value != ""){

        // }

//         $(el).select2(options).on("select2:select", (e) => {
//             el.dispatchEvent(new Event('change', { target: e.target }));
//         });
//     },
//     update: function (el, binding, vnode) {
//         for (var i = 0; i < vnode.data.directives.length; i++) {
//             if (vnode.data.directives[i].name == "model") {
//                 $(el).val(vnode.data.directives[i].value);
//             }
//         }

//         $(el).trigger("change");
//     }
// });


Vue.directive('checkbox', {
    inserted: function (el, binding, vnode) {
        let input = $(el);
        let options = binding.value || {};
        if (input.val() !== "") {
            console.log(input);
            if(input.val() === "0"){
                input.prop("checked", false);
            }else{
                input.prop("checked", true);
            }
        }else{
            input.prop("checked", true);
        };
    }
});

Vue.use(VueJqueryMask);

