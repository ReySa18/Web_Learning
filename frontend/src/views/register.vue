<template>
  <div class="gradient-bg min-h-screen w-full flex items-center justify-center p-4 fixed inset-0">
    <!-- Floating Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
      <div class="floating-animation absolute top-1/4 left-1/4 w-2 h-2 bg-white rounded-full opacity-30"></div>
      <div class="floating-animation absolute top-1/3 right-1/4 w-1 h-1 bg-white rounded-full opacity-40"></div>
      <div class="floating-animation absolute bottom-1/4 left-1/3 w-1.5 h-1.5 bg-white rounded-full opacity-25"></div>
      <div class="floating-animation absolute top-1/2 right-1/3 w-2 h-2 bg-white rounded-full opacity-35"></div>
      <div class="floating-animation absolute bottom-1/3 right-1/4 w-1 h-1 bg-white rounded-full opacity-30"></div>
      <div class="floating-animation absolute top-3/4 left-1/2 w-1.5 h-1.5 bg-white rounded-full opacity-40"></div>
    </div>

    <!-- Main Register Container -->
    <div class="scrollable-container w-full max-w-lg max-h-[90vh]">
      <div class="slide-in glass-effect rounded-2xl p-6 sm:p-8 w-full max-w-lg shadow-2xl">
        <!-- Header -->
        <div class="text-center mb-6 sm:mb-8">
          <div class="inline-flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 bg-white rounded-full mb-3 sm:mb-4 pulse-border">
            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
          </div>
          <h1 class="text-2xl sm:text-3xl font-bold text-white mb-1 sm:mb-2">Daftar Akun</h1>
          <p class="text-sm sm:text-base text-gray-300">Bergabunglah dengan kami hari ini</p>
        </div>

        <!-- Register Form -->
        <form @submit.prevent="handleRegister" class="space-y-4 sm:space-y-5">
          <!-- Name Input -->
          <div class="space-y-2">
            <label for="fullName" class="block text-sm font-medium text-gray-300">Nama Lengkap</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
              </div>
              <input 
                id="fullName"
                v-model="fullName"
                type="text" 
                required
                class="input-focus block w-full pl-10 pr-3 py-2 sm:py-3 text-sm sm:text-base border border-gray-600 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent"
                placeholder="Masukan nama lengkap"
              >
            </div>
          </div>

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
                class="input-focus block w-full pl-10 pr-3 py-2 sm:py-3 text-sm sm:text-base border border-gray-600 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent"
                placeholder="nama@email.com"
              >
            </div>
          </div>

          <!-- Password Input -->
          <div class="space-y-2">
            <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
              </div>
              <input 
                id="password"
                v-model="password"
                :type="showPassword ? 'text' : 'password'"
                required
                @invalid="setPasswordCustomValidity"
                @input="clearCustomValidity"
                class="input-focus block w-full pl-10 pr-12 py-2 sm:py-3 text-sm sm:text-base border border-gray-600 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent"
                placeholder="Minimal 8 karakter"
                minlength="8"
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
            <!-- Password Strength Indicator -->
            <div class="mt-1 sm:mt-2">
              <div class="flex space-x-1">
                <div 
                  v-for="i in 4" 
                  :key="i"
                  :class="[
                    'h-1 flex-1 rounded-full transition-colors',
                    getPasswordStrengthColor(i)
                  ]"
                ></div>
              </div>
              <p class="text-xs text-gray-400 mt-1">
                {{ passwordStrengthText }}
              </p>
            </div>
          </div>

          <!-- Confirm Password Input -->
          <div class="space-y-2">
            <label for="confirmPassword" class="block text-sm font-medium text-gray-300">Konfirmasi Password</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <input 
                id="confirmPassword"
                v-model="confirmPassword"
                :type="showConfirmPassword ? 'text' : 'password'"
                required
                @invalid="setPasswordCustomValidity"
                @input="clearCustomValidity"
                class="input-focus block w-full pl-10 pr-12 py-2 sm:py-3 text-sm sm:text-base border border-gray-600 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent"
                placeholder="Ulangi password"
              >
              <!-- Ikon mata di kanan -->
              <button type="button"
                      class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400"
                      @click="showConfirmPassword = !showConfirmPassword">
                <!-- Mata terlihat -->
                <svg v-if="!showConfirmPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <p v-if="confirmPassword && !passwordsMatch" class="text-xs text-red-400">
              Password tidak cocok
            </p>
          </div>

          <!-- Terms & Conditions -->
          <div class="flex items-start space-x-3">
            <input 
              id="agreeTerms" 
              v-model="agreeTerms"
              type="checkbox" 
              required
              class="h-4 w-4 text-white focus:ring-white border-gray-600 rounded bg-gray-800 mt-1"
            >
            <label for="agreeTerms" class="block text-xs sm:text-sm text-gray-300 leading-5">
              Saya setuju dengan 
              <a href="#" class="text-white hover:text-gray-300 font-medium transition-colors underline">
                Syarat & Ketentuan
              </a> 
              dan 
              <a href="#" class="text-white hover:text-gray-300 font-medium transition-colors underline">
                Kebijakan Privasi
              </a>
            </label>
          </div>

          <!-- Register Button -->
          <button 
            type="submit"
            :disabled="isLoading || !passwordsMatch || !agreeTerms"
            class="btn-hover w-full flex justify-center py-2 sm:py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm sm:text-base font-medium text-black bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white focus:ring-offset-gray-800 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            <svg v-if="isLoading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ isLoading ? 'Memproses...' : 'Daftar Sekarang' }}
          </button>
        </form>

        <!-- Divider -->
        <div class="mt-4 sm:mt-6">
          <div class="relative">
            <div class="absolute inset-0 flex items-center">
              <div class="w-full border-t border-gray-600"></div>
            </div>
            <div class="relative flex justify-center text-sm">
              <span class="px-2 bg-black text-gray-400">Atau</span>
            </div>
          </div>
        </div>

        <!-- Login Link -->
        <div class="mt-4 sm:mt-6 text-center">
          <p class="text-xs sm:text-sm text-gray-400">
            Sudah punya akun? 
            <router-link to="/login">
              <button 
                @click="$emit('go-login')" 
                class="text-white hover:text-gray-300 font-medium transition-colors underline"
                >
                Masuk Disini
              </button>
            </router-link>
          </p>
        </div>
      </div>
    </div>
    <!-- Notification -->
    <Transition name="notification">
      <div 
        v-if="notification.show"
        :class="[
          'fixed top-4 right-4 px-4 py-2 sm:px-6 sm:py-3 rounded-lg shadow-lg z-50 text-sm sm:text-base',
          notification.type === 'success' ? 'bg-green-600 text-white' : 'bg-red-600 text-white'
        ]"
      >
        {{ notification.message }}
      </div>
    </Transition>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import api from '@/api'

const router = useRouter()
// Reactive data
const fullName = ref('')
const email = ref('')
const phone = ref('')
const password = ref('')
const confirmPassword = ref('')
const showPassword = ref(false)
const showConfirmPassword = ref(false)
const agreeTerms = ref(false)
const newsletter = ref(false)
const isLoading = ref(false)
const notification = ref({
  show: false,
  message: '',
  type: 'success'
})

const setPasswordCustomValidity = (event) => {
  if (event.target.validity.valueMissing) {
    event.target.setCustomValidity('Silakan isi kata sandi Anda.')
  } else if (event.target.validity.tooShort) {
    event.target.setCustomValidity('Kata sandi minimal 8 karakter.')
  } else {
    event.target.setCustomValidity('')
  }
}

const clearCustomValidity = (event) => {
  event.target.setCustomValidity('')
}
  
// Computed properties
const passwordsMatch = computed(() => {
  return password.value === confirmPassword.value
})

const passwordStrength = computed(() => {
  const pwd = password.value
  let strength = 0

  if (pwd.length >= 8) strength++
  if (/[A-Z]/.test(pwd)) strength++
  if (/[0-9]/.test(pwd)) strength++
  if (/[^A-Za-z0-9]/.test(pwd)) strength++

  return strength
})

const passwordStrengthText = computed(() => {
  const strength = passwordStrength.value
  if (strength === 0) return 'Masukkan password'
  if (strength === 1) return 'Password lemah'
  if (strength === 2) return 'Password sedang'
  if (strength === 3) return 'Password kuat'
  return 'Password sangat kuat'
})

// Modified handleRegister with axios request to backend
const handleRegister = async () => {
  if (!fullName.value || !email.value || !password.value || !confirmPassword.value) {
    showNotification('Mohon lengkapi semua field', 'error')
    return
  }

  if (!passwordsMatch.value) {
    showNotification('Password tidak cocok', 'error')
    return
  }

  if (!agreeTerms.value) {
    showNotification('Anda harus menyetujui syarat & ketentuan', 'error')
    return
  }

  if (passwordStrength.value < 2) {
    showNotification('Password terlalu lemah. Gunakan kombinasi huruf, angka, dan simbol', 'error')
    return
  }

  isLoading.value = true

  try {
    const response = await api.post('/register', {
      name: fullName.value,
      email: email.value,
      password: password.value
    })

    // Jika sukses
    console.log('✅ REGISTER SUCCESS:', response.data)
    showNotification(response.data.message || 'Registrasi berhasil!', 'success')

    // Reset form
    fullName.value = ''
    email.value = ''
    phone.value = ''
    password.value = ''
    confirmPassword.value = ''
    agreeTerms.value = false
    newsletter.value = false

    // Arahkan ke halaman login setelah 2 detik
    setTimeout(() => {
      router.push('/login') // atau '/' sesuai rute login kamu
    }, 1000)
  } catch (error) {
    console.error('❌ REGISTER ERROR:', error)
    if (error.response && error.response.status === 422) {
      // Validasi error dari backend (misal email sudah dipakai)
      const errors = error.response.data.errors
      if (errors) {
        showNotification(Object.values(errors).flat()[0], 'error') // Ambil pesan error pertama
      } else {
        showNotification('Terjadi kesalahan validasi.', 'error')
      }
    } else {
      showNotification('Terjadi kesalahan server. Silakan coba lagi.', 'error')
    }
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

  // Hide notification after 4 seconds
  setTimeout(() => {
    notification.value.show = false
  }, 4000)
}

const getPasswordStrengthColor = (index) => {
  const strength = passwordStrength.value
  if (index <= strength) {
    if (strength === 1) return 'bg-red-500'
    if (strength === 2) return 'bg-yellow-500'
    if (strength === 3) return 'bg-blue-500'
    if (strength === 4) return 'bg-green-500'
  }
  return 'bg-gray-600'
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
  width: 100%;
  max-height: 85vh; /* Slightly less than container */
  overflow-y: auto;
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

.floating-animation:nth-child(4) {
  animation-delay: -1s;
}

.floating-animation:nth-child(5) {
  animation-delay: -3s;
}

.floating-animation:nth-child(6) {
  animation-delay: -5s;
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
/* Enhanced scrollbar styling */
.glass-effect::-webkit-scrollbar {
  width: 8px;
}

.glass-effect::-webkit-scrollbar-track {
  background: rgba(255, 255, 255, 0.05);
  border-radius: 4px;
}

.glass-effect::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.3);
  border-radius: 4px;
  border: 2px solid transparent;
  background-clip: content-box;
}

.glass-effect::-webkit-scrollbar-thumb:hover {
  background: rgba(255, 255, 255, 0.5);
}

/* Responsive adjustments */
@media (max-height: 700px) {
  .glass-effect {
    max-height: 80vh;
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

/* Responsive adjustments */

@media (max-height: 600px) {
  .glass-effect {
    max-height: 75vh;
  }
}

@media (max-height: 500px) {
  .glass-effect {
    max-height: 70vh;
  }
}

@media (max-width: 480px) {
  .floating-animation {
    display: none; /* Hide floating elements on small screens */
  }
  
  .glass-effect {
    padding: 1.25rem;
  }
  
  .input-focus {
    font-size: 0.875rem;
  }
  
  .btn-hover {
    font-size: 0.875rem;
    padding: 0.75rem 1rem;
  }
}

@media (max-width: 350px) {
  .text-2xl {
    font-size: 1.5rem;
  }
  
  .text-sm {
    font-size: 0.75rem;
  }
}
</style>
