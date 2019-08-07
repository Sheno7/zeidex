import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import Category from '@/components/category/index.vue';
import Product from '@/components/product/index.vue';
import axios from 'axios'

Vue.use(VueRouter);
Vue.prototype.$http = axios
Vue.config.productionTip = false


const routes=[
  {path:'/category',component:Category},
  {path:'/product',component:Product},
]
const router=new VueRouter({
  routes
});
new Vue({
  render: h => h(App),
  router
}).$mount('#app')
