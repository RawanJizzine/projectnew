import Vue from 'vue'
Vue.component('data-table',require('./component/DataTable.vue').default);
const dataTable= new Vue({
    el: '#data-table',
});
