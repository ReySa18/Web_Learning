<template>
  <div class="gradient-bg min-h-screen w-full flex items-center justify-center p-4 fixed inset-0">
    <!-- Floating Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
      <div class="floating-animation absolute top-1/4 left-1/4 w-2 h-2 bg-white rounded-full opacity-30"></div>
      <div class="floating-animation absolute top-1/3 right-1/4 w-1 h-1 bg-white rounded-full opacity-40"></div>
      <div class="floating-animation absolute bottom-1/4 left-1/3 w-1.5 h-1.5 bg-white rounded-full opacity-25"></div>
      <div class="floating-animation absolute top-1/2 right-1/3 w-2 h-2 bg-white rounded-full opacity-35"></div>
      <div class="floating-animation absolute bottom-1/3 right-1/4 w-1 h-1 bg-white rounded-full opacity-30"></div>
    </div>

    <!-- Main Login Container -->
    <div class="slide-in glass-effect rounded-2xl p-8 w-full max-w-md shadow-2xl">
      <!-- Header -->
      <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full mb-4 pulse-border">
          <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
          </svg>
        </div>
        <h1 class="text-3xl font-bold text-white mb-2">Selamat Datang</h1>
        <p class="text-gray-300">Masuk ke akun Anda</p>
      </div>

      <!-- Login Form -->
      <form @submit.prevent="handleLogin" class="space-y-6">
        <!-- Email Input -->
        <div class="space-y-2">
          <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
              </svg>
            </div>
            <input 
              id="email"
              v-model="email"
              type="email" 
              required
              class="input-focus block w-full pl-10 pr-3 py-3 border border-gray-600 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent"
              placeholder="nama@email.com"
            >
          </div>
        </div>

        <!-- Password Input -->
        <div class="space-y-2">
          <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
          <div class="relative">
            <!-- Ikon kunci di kiri -->
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
              </svg>
            </div>

            <!-- Input password -->
            <input 
              id="password"
              v-model="password"
              :type="showPassword ? 'text' : 'password'"
              required
              class="input-focus block w-full pl-10 py-3 border border-gray-600 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent"
              :class="password.length > 0 ? 'pr-12' : 'pr-3'"
              placeholder="••••••••"
            >

            <!-- Ikon mata di kanan -->
            <button type="button"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400"
                    @click="showPassword = !showPassword">
              <!-- Mata terlihat -->
              <svg v-if="!showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>

              <!-- Mata dicoret -->
              <svg v-else class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.05 10.05 0 012.141-3.528m3.368-2.379A9.973 9.973 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.973 9.973 0 01-4.293 5.043M3 3l18 18" />
              </svg>
            </button>
          </div>
        </div>


        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input 
              id="remember-me" 
              v-model="rememberMe"
              type="checkbox" 
              class="h-4 w-4 text-white focus:ring-white border-gray-600 rounded bg-gray-800"
            >
            <label for="remember-me" class="ml-2 block text-sm text-gray-300">
              Ingat saya
            </label>
          </div>
        </div>

        <!-- Login Button -->
        <button 
          type="submit"
          :disabled="isLoading"
          class="btn-hover w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-black bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white focus:ring-offset-gray-800 disabled:opacity-50 disabled:cursor-not-allowed"
        >
          <svg v-if="isLoading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          {{ isLoading ? 'Memproses...' : 'Masuk' }}
        </button>
      </form>

      <!-- Divider -->
      <div class="mt-6">
        <div class="relative">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-600"></div>
          </div>
          <div class="relative flex justify-center text-sm">
            <span class="px-2 bg-black text-gray-400">Atau</span>
          </div>
        </div>
      </div>

      <!-- Register Link -->
      <div class="mt-6 text-center">
        <p class="text-gray-400">
          Belum punya akun? 
          <router-link to="/register">
            <button 
              @click="$emit('go-register')" 
              class="text-white hover:text-gray-300 font-medium transition-colors underline"
            >
              Daftar sekarang
            </button>
          </router-link>
        </p>
      </div>
    </div>

    <!-- Notification -->
    <Transition name="notification">
      <div 
        v-if="notification.show"
        :class="[
          'fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50',
          notification.type === 'success' ? 'bg-green-600 text-white' : 'bg-red-600 text-white'
        ]"
      >
        {{ notification.message }}
      </div>
    </Transition>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import api from '@/api'
import { useRouter } from 'vue-router'

defineEmits(['go-register'])

const router = useRouter()

const email = ref('')
const password = ref('')
const rememberMe = ref(false)
const showPassword = ref(false)
const isLoading = ref(false)
const notification = ref({
  show: false,
  message: '',
  type: 'success'
})

const handleLogin = async () => {
  if (!email.value || !password.value) {
    showNotification('Mohon isi email dan password.', 'error')
    return
  }

  isLoading.value = true

  try {
    // ⬇️ Kirim email & password
    const response = await api.post('/login', {
      email: email.value,
      password: password.value
    })

    const { token, user } = response.data

    if (!token || !user) {
      throw new Error('Token atau data pengguna tidak ditemukan.')
    }

    // ⬇️ Simpan data ke localStorage
    localStorage.setItem('auth_token', token)
    localStorage.setItem('user', JSON.stringify(user))
    localStorage.setItem('user_role', user.role)

    showNotification('Login berhasil! Selamat datang.', 'success')

    // ⬇️ Arahkan sesuai role
    if (user.role === 'admin') {
      router.push('/admin')
    } else {
      router.push('/home')
    }

    // Reset form
    email.value = ''
    password.value = ''
  } catch (error) {
    const message =
      error.response?.data?.message ||
      error.message ||
      'Terjadi kesalahan saat login.'
    showNotification(message, 'error')
  } finally {
    isLoading.value = false
  }
}

const showNotification = (message, type) => {
  notification.value = {
    show: true,
    message,
    type
  }

  setTimeout(() => {
    notification.value.show = false
  }, 3000)
}
</script>





<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

* {
  font-family: 'Inter', sans-serif;
}

.gradient-bg {
  background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #000000 100%);
  min-height: 100vh;
  min-width: 100vw;
}

/* Ensure full screen coverage */
html, body {
  margin: 0;
  padding: 0;
  height: 100%;
  overflow-x: hidden;
}

.glass-effect {
  backdrop-filter: blur(10px);
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.floating-animation {
  animation: float 6s ease-in-out infinite;
}

.floating-animation:nth-child(2) {
  animation-delay: -2s;
}

.floating-animation:nth-child(3) {
  animation-delay: -4s;
}

@keyframes float {
  0%, 100% { transform: translateY(0px) rotate(0deg); }
  50% { transform: translateY(-20px) rotate(180deg); }
}

.pulse-border {
  animation: pulse-border 2s infinite;
}

@keyframes pulse-border {
  0% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4); }
  70% { box-shadow: 0 0 0 10px rgba(255, 255, 255, 0); }
  100% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0); }
}

.slide-in {
  animation: slideIn 0.8s ease-out;
}

@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.input-focus {
  transition: all 0.3s ease;
}

.input-focus:focus {
  transform: translateY(-2px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.btn-hover {
  transition: all 0.3s ease;
}

.btn-hover:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
}

/* Notification transitions */
.notification-enter-active,
.notification-leave-active {
  transition: all 0.3s ease;
}

.notification-enter-from {
  opacity: 0;
  transform: translateX(100%);
}

.notification-leave-to {
  opacity: 0;
  transform: translateX(100%);
}
</style>