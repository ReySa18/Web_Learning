import { createRouter, createWebHistory } from 'vue-router'

import Register from '../views/Register.vue'
import Login from '../views/login.vue'
import Home from '../views/home.vue'
import Kuiz from '../views/kuis.vue'
import Soal from '../views/Soal.vue'
import Kelas from '../views/kelas.vue'

import Admin from '../views/admin/admin.vue'
import UserManagement from '../views/admin/user.vue'
import InputMateri from '../views/admin/inputMateri.vue'
import Materi from '../views/admin/materi.vue'
import editMateri from '../views/admin/editMateri.vue'
import SoalManagement from '../views/admin/soal.vue'
import isiMateri from '../views/isiMateri.vue'

const routes = [
  { path: '/', name: 'Login', component: Login },
  { path: '/home', name: 'Home', component: Home },
  { path: '/register', name: 'Register', component: Register },
  { path: '/kuis', name: 'Kuiz', component: Kuiz },
  { path: '/soal', name: 'Soal', component: Soal },
  { path: '/kelas', name: 'Kelas', component: Kelas },
  { path: '/inputMateri', name: 'InputMateri', component: InputMateri },
  { path: '/materi', name: 'Materi', component: Materi },
  { path: '/editmateri/:id', name: 'EditMateri', component: editMateri },
  { path: '/admin',
    name: 'admin',
    component: Admin,
      beforeEnter: (to, from, next) => {
        const token = localStorage.getItem('auth_token')
        const role = localStorage.getItem('user_role')

        if (!token) {
          next('/home')
        } else if (role !== 'admin' && role !== 'instruktur') {
          alert('Kamu tidak memiliki hak akses!')
          next('/home')
        } else {
          next()
        } 
      }
    },
  { path: '/usermanagement', name: 'Managemen User', 
    component: UserManagement,
    beforeEnter: (to, from, next) => {
        const token = localStorage.getItem('auth_token')
        const role = localStorage.getItem('user_role')

        if (!token) {
          next('/home')
        } else if (role !== 'admin' && role !== 'instruktur') {
          alert('Kamu tidak memiliki hak akses!')
          next('/home')
        } else {
          next()
        } 
      }
  },
  { path: '/managementsoal', name: 'Manajemen Soal', component: SoalManagement },
  { path: '/isiMateri/:id', name: 'isiMateri', component: isiMateri }

]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
