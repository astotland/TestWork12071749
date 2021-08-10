import Vue from 'vue'
import VueRouter from 'vue-router'
import GuestList from '../views/GuestList.vue'
import Guest from '../views/Guest.vue'
import Main from '../views/Main.vue'
import DrinksList from '../views/DrinksList.vue'
import Drink from '../views/Drink.vue'
import FoodList from '../views/FoodList.vue'
import Food from '../views/Food.vue'


Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Main',
    component: Main
  },
  {
    path: '/guests',
    name: 'GuestList',
    component: GuestList
  },
  {
    path: '/guests/create',
    name: 'Guest',
    component: Guest
  },
  {
    path: '/guests/:id',
    name: 'Guest',
    component: Guest
  },
  {
    path: '/drinks',
    name: 'drinks',
    component: DrinksList
  },
  {
    path: '/drinks/create',
    name: 'Drink',
    component: Drink
  },
  {
    path: '/drinks/:id',
    name: 'Drink',
    component: Drink
  },
  {
    path: '/food',
    name: 'food',
    component: FoodList
  },
  {
    path: '/food/create',
    name: 'Food',
    component: Food
  },
  {
    path: '/food/:id',
    name: 'Food',
    component: Food
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
