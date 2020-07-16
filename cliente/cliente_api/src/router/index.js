import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import Saldo from '@/components/Saldo'
import Saque from '@/components/Saque'
import Deposito from '@/components/Deposito'
import axios from 'axios'
import VueAxios from 'vue-axios'
//axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*'
Vue.use(Router) 
Vue.use(VueAxios,axios)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'HelloWorld',
      component: HelloWorld
    },
    {
      path: '/saldo',
      name: 'Saldo',
      component: Saldo
    },
    {
      path: '/saque',
      name: 'Saque',
      component: Saque
    },
    {
      path: '/deposito',
      name: 'Deposito',
      component: Deposito
    }
  ]
})
