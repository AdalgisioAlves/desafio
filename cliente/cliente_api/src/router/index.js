import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import Saldo from '@/components/Saldo'
import Saque from '@/components/Saque'
import Deposito from '@/components/Deposito'

Vue.use(Router)

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
