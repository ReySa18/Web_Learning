<template>
  <div class="gradient-bg">
    <!-- Background floating dots -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
      <div class="floating-animation absolute top-[15%] left-[10%] md:top-1/4 md:left-1/4 w-1.5 h-1.5 md:w-2 md:h-2 bg-white rounded-full opacity-20"></div>
      <div class="floating-animation absolute top-[20%] right-[10%] md:top-1/3 md:right-1/4 w-1 h-1 bg-white rounded-full opacity-30"></div>
      <div class="floating-animation absolute bottom-[15%] left-[15%] md:bottom-1/4 md:left-1/3 w-1.5 h-1.5 bg-white rounded-full opacity-15"></div>
      <div class="floating-animation absolute top-1/2 right-[15%] md:right-1/3 w-1.5 h-1.5 md:w-2 md:h-2 bg-white rounded-full opacity-25"></div>
      <div class="floating-animation absolute bottom-[20%] right-[10%] md:bottom-1/3 md:right-1/4 w-1 h-1 bg-white rounded-full opacity-20"></div>
    </div>

    <!-- Navigation -->
    <nav class="glass-effect border-b border-gray-700 sticky top-0 z-50 navbar-height">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
        <div class="flex justify-between items-center h-full">
          <div class="flex items-center">
            <div class="flex-shrink-0 flex items-center">
              <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center mr-2 md:mr-3">
                <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
              </div>
              <span class="text-white text-lg md:text-xl font-bold">Asteria Code</span>
            </div>
          </div>

          <!-- Desktop Navigation -->
          <div class="hidden md:block">
            <div class="ml-6 md:ml-10 flex items-baseline space-x-3 md:space-x-4">
              <router-link to="/home" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Home</router-link>
              <router-link to="/kelas" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Materi</router-link>
              <router-link to="/kuis" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Latihan Soal</router-link>
              <router-link to="/aboutme" class="nav-active text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">About Me</router-link>
            </div>
          </div>

          <!-- Action buttons -->
          <div class="flex items-center space-x-3 md:space-x-4 relative">
            <div class="relative">
              <button 
                @click="toggleDropdown"
                class="flex items-center space-x-2 focus:outline-none"
              >
                <!-- Avatar user -->
                <div class="w-8 h-8 md:w-10 md:h-10 bg-gray-600 rounded-full flex items-center justify-center">
                  <!-- Tampilkan inisial jika tidak ada avatar -->
                  <span v-if="!userData?.avatar" class="text-white text-sm font-medium">
                    {{ userInitials }}
                  </span>
                  <!-- Tampilkan gambar jika ada avatar -->
                  <img 
                    v-else
                    :src="userData?.avatar" 
                    class="w-full h-full rounded-full object-cover"
                    alt="User Avatar"
                  >
                </div>
                <!-- Nama user (hanya tampil di desktop) -->
                <span class="hidden md:inline text-white text-sm font-medium">
                  {{ userData?.name }}
                </span>
                <!-- Icon dropdown -->
                <svg 
                  class="w-4 h-4 text-gray-300 transition-transform duration-200" 
                  :class="{ 'rotate-180': showDropdown }"
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>

              <!-- Dropdown menu -->
              <div 
                v-if="showDropdown"
                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 glass-effect border border-gray-700 z-50"
              >
                <router-link 
                  to="/profile" 
                  class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white"
                  @click="showDropdown = false"
                >
                  Profile
                </router-link>
                <a 
                  href="#" 
                  class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white"
                  @click="logout"
                >
                  Logout
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- Main content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 main-content-spacing pb-6 md:pb-8">
      <!-- Page header -->
      <div class="mb-6 md:mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-white mb-2 md:mb-3">Tentang Saya</h1>
        <p class="text-gray-300 text-sm md:text-base">Pembuat Asteria Code dan pengembang web</p>
      </div>

      <!-- Profile Section -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
        <!-- Left Column - Profile Card -->
        <div class="lg:col-span-1">
          <div class="card-gradient rounded-xl p-5 md:p-6">
            <div class="flex flex-col items-center">
              <div class="w-32 h-32 md:w-40 md:h-40 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center mb-4 overflow-hidden">
                <img 
                  src="/images/foto.png"
                  class="w-full h-full object-cover"
                  alt="Developer Photo"
                >
              </div>
              <h2 class="text-xl md:text-2xl font-bold text-white mb-1">Reymondo Saputra S</h2>
              <p class="text-blue-400 text-sm md:text-base mb-3">Tech Antusiast</p>
              <div class="flex space-x-3 mb-4">
                <a href="https://github.com/ReySa18" class="p-2 glass-effect rounded-full hover:bg-blue-500 transition-colors">
                  <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                  </svg>
                </a>
                <a href="https://www.linkedin.com/in/reymondosaputra/" class="p-2 glass-effect rounded-full hover:bg-blue-500 transition-colors">
                  <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                  </svg>
                </a>
                <a href="https://www.instagram.com/reyabcdhl_/" class="p-2 glass-effect rounded-full hover:bg-blue-500 transition-colors">
                  <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.204-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.646.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.645-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.281.2-6.704 2.617-6.904 6.904-.059 1.28-.073 1.688-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.281 2.617 6.704 6.904 6.904 1.28.058 1.688.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.281-.2 6.704-2.617 6.904-6.904.058-1.28.072-1.688.072-4.948 0-3.259-.014-3.667-.072-4.947-.2-4.281-2.617-6.704-6.904-6.904-1.28-.059-1.688-.073-4.948-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.44-.645 1.44-1.44s-.645-1.44-1.44-1.44z"/>
                  </svg>
                </a>
              </div>
              <div class="w-full glass-effect rounded-lg p-4 mb-4">
                <h3 class="text-white text-sm font-medium mb-2">Kontak</h3>
                <div class="space-y-2">
                  <div class="flex items-center">
                    <svg class="w-4 h-4 text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="text-gray-300 text-sm">simbolon.reymondo1@gmail.com</span>
                  </div>
                  <div class="flex items-center">
                    <svg class="w-4 h-4 text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <span class="text-gray-300 text-sm">+62 851 6301 8093</span>
                  </div>
                  <div class="flex items-center">
                    <svg class="w-4 h-4 text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="text-gray-300 text-sm">Depok, Indonesia</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column - Bio and Skills -->
        <div class="lg:col-span-2">
          <div class="card-gradient rounded-xl p-5 md:p-6 mb-6 md:mb-8">
            <h2 class="text-xl md:text-2xl font-bold text-white mb-4">Tentang Saya</h2>
            <p class="text-gray-300 text-sm md:text-base mb-4">
              Halo! Saya Reymondo Saputra S, seorang antusias teknologi yang gemar mengeksplorasi dunia 
              pengembangan web dan teknologi modern. Dengan ketertarikan kuat pada inovasi digital, saya 
              menciptakan Asteria Code sebagai wadah pembelajaran pemrograman yang menyenangkan, interaktif, 
              dan mudah diakses oleh siapa pun.
            </p>
            <p class="text-gray-300 text-sm md:text-base mb-4">
              Saya percaya bahwa siapa saja bisa belajar coding—asal diberikan materi yang tepat dan pendekatan 
              yang mendukung. Melalui Asteria Code, saya ingin membangun lingkungan belajar yang inklusif, ramah, 
              dan memberdayakan, terutama bagi mereka yang baru memulai perjalanan di dunia teknologi.
            </p>
            <p class="text-gray-300 text-sm md:text-base">
              Selain mengembangkan platform ini, saya juga aktif dalam komunitas IT. 
              📲 Yuk terhubung! Jangan ragu untuk menyapa saya di media sosial yang sudah saya bagikan — 
              saya selalu terbuka untuk diskusi, kolaborasi, atau sekadar berbagi semangat belajar teknologi.
            </p>
          </div>

          <div class="card-gradient rounded-xl p-5 md:p-6 mb-6 md:mb-8">
            <h2 class="text-xl md:text-2xl font-bold text-white mb-4">Keahlian Teknis</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div v-for="(skill, index) in skills" :key="index" class="glass-effect p-4 rounded-lg">
                <div class="flex items-center mb-2">
                  <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3" :class="skill.colorClass">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                  </div>
                  <span class="text-white font-medium">{{ skill.name }}</span>
                </div>
              </div>
            </div>
          </div>

          <div class="card-gradient rounded-xl p-5 md:p-6">
            <h2 class="text-xl md:text-2xl font-bold text-white mb-4">Pendidikan</h2>
            <div class="space-y-4">
              <div class="glass-effect p-4 rounded-lg">
                <div class="flex justify-between items-start">
                  <div>
                    <h3 class="text-white font-medium">Sistem Informasi</h3>
                    <p class="text-blue-400 text-sm">Universitas Gunadarma</p>
                  </div>
                  <span class="text-gray-400 text-sm">2022 - Present</span>
                </div>
                <p class="text-gray-300 text-sm mt-2">IPK: 3.97/4.00 | Konsentrasi pada Pengembangan Web, dan Machine Learning</p>
              </div>
              <div class="glass-effect p-4 rounded-lg">
                <div class="flex justify-between items-start">
                  <div>
                    <h3 class="text-white font-medium">ACA Cloud Computing Certification</h3>
                    <p class="text-blue-400 text-sm">Alibaba Cloud</p>
                  </div>
                  <span class="text-gray-400 text-sm">2024</span>
                </div>
                <p class="text-gray-300 text-sm mt-2">Fokus pada konsep dasar komputasi awan serta produk inti Alibaba Cloud seperti Elastic Compute Service (ECS), Object Storage Service (OSS), Server Load Balancer (SLB), dan Relational Database Service (RDS).</p>
              </div>
              <div class="glass-effect p-4 rounded-lg">
                <div class="flex justify-between items-start">
                  <div>
                    <h3 class="text-white font-medium">Belajar Back-End Pemula dengan JavaScript</h3>
                    <p class="text-blue-400 text-sm">Dicoding Indonesia</p>
                  </div>
                  <span class="text-gray-400 text-sm">2024</span>
                </div>
                <p class="text-gray-300 text-sm mt-2">Fokus pada Pengenalan ke Back-End, Dasar-Dasar Node.js, Membangun Web Service menggunakan Node.js, Deploy Web Service, Mengonsumsi dan Menguji RESTful API menggunakan Postman.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Mobile navigation -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 glass-effect border-t border-gray-700 z-40 mobile-nav-height">
        <div class="flex justify-around items-center h-full py-1.5">
            <router-link to="/home" class="flex flex-col items-center py-2 px-3 text-gray-400 group" exact-active-class="text-white">
                <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="text-xs">Home</span>
            </router-link>
            <router-link to="/kelas" class="flex flex-col items-center py-2 px-3 text-gray-400 group" exact-active-class="text-white">
                <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                <span class="text-xs">Materi</span>
            </router-link>
            <router-link to="/kuis" class="flex flex-col items-center py-2 px-3 text-gray-400 group" exact-active-class="text-white">
                <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                <span class="text-xs">Latihan Soal</span>
            </router-link>
            <router-link to="/aboutme" class="flex flex-col items-center py-2 px-3 text-white relative group" exact-active-class="text-white">
                <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-xs">About Me</span>
                <div class="absolute top-0 w-1.5 h-1 bg-white rounded-full"></div>
            </router-link>
        </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter()

// Data user
const userData = ref({
  name: '',
  email: '',
  avatar: ''
})

const showDropdown = ref(false)

// Ambil inisial dari nama user
const userInitials = computed(() => {
  if (!userData.value.name) return 'U'
  const names = userData.value.name.split(' ')
  return names
    .slice(0, 2)
    .map(n => n[0])
    .join('')
    .toUpperCase()
})

// Keahlian
const skills = ref([
  { name: 'JavaScript', progressColor: 'bg-blue-500', colorClass: 'bg-blue-600' },
  { name: 'Vue.js',progressColor: 'bg-green-500', colorClass: 'bg-green-600' },
  { name: 'Python',progressColor: 'bg-cyan-500', colorClass: 'bg-cyan-600' },
  { name: 'Node.js', progressColor: 'bg-emerald-500', colorClass: 'bg-emerald-600' },
  { name: 'PHP & Laravel', level: '80%', progressColor: 'bg-red-500', colorClass: 'bg-red-600' },
  { name: 'Database', level: '85%', progressColor: 'bg-purple-500', colorClass: 'bg-purple-600' },
  { name: 'UI/UX Design', progressColor: 'bg-pink-500', colorClass: 'bg-pink-600' }
])

// Toggle dropdown
const toggleDropdown = () => {
  showDropdown.value = !showDropdown.value
}

// Ambil data user dari API
const fetchUser = async () => {
  try {
    const token = localStorage.getItem('auth_token');
    const response = await axios.get('http://localhost:8000/api/user', {
      headers: {
        Authorization: `Bearer ${token}`
      }
    })
    userData.value = response.data
  } catch (error) {
    console.error('Gagal mengambil data user:', error)
  }
}

// Fungsi logout
const logout = () => {
  // Hapus token dari localStorage
  localStorage.removeItem('auth_token')
  // Redirect ke halaman login
  router.push({ name: 'Login' })
}

// Tutup dropdown ketika klik di luar
const handleClickOutside = (event) => {
  const dropdown = document.querySelector('.relative > div')
  if (dropdown && !dropdown.contains(event.target)) {
    showDropdown.value = false
  }
}

// Simulasi pengambilan data user
onMounted(() => {
  fetchUser()
  document.addEventListener('click', handleClickOutside)
})
</script>

<style scoped>
/* Include all styles from kelas.vue */
.gradient-bg {
  background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #000000 100%);
  min-height: 100vh;
  width: 100vw;
  margin: 0;
  padding: 0;
  position: relative;
  left: 0;
  top: 0;
}

.navbar-height {
  height: 64px;
}

.main-content-spacing {
  padding-top: calc(64px + 1.5rem);
}

.mobile-nav-height {
  height: 56px;
}

.glass-effect {
  backdrop-filter: blur(10px);
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.card-gradient {
  background: linear-gradient(135deg, #2a2a2a 0%, #333333 50%, #2a2a2a 100%);
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.floating-animation {
  animation: float 6s ease-in-out infinite;
}

.rotate-180 {
  transform: rotate(180deg);
}

@keyframes float {
  0%, 100% { 
    transform: translateY(0px) rotate(0deg) scale(1);
    opacity: 0.2;
  }
  50% { 
    transform: translateY(-15px) rotate(5deg) scale(1.05);
    opacity: 0.3;
  }
}

.card-hover {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-hover:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
}

.nav-active {
  background: rgba(255, 255, 255, 0.2);
  border-bottom: 2px solid white;
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-box-orient: vertical;
  overflow: hidden;
  -webkit-line-clamp: 2;
}

.transition-colors {
  transition: color 0.2s ease, background-color 0.2s ease;
}

/* Loader animation */
.loader {
  border: 4px solid rgba(255, 255, 255, 0.1);
  border-left-color: #3b82f6;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

/* Scrollbar styling */
::-webkit-scrollbar {
  width: 6px;
}

::-webkit-scrollbar-track {
  background: rgba(255, 255, 255, 0.05);
  border-radius: 10px;
}

::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.2);
  border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
  background: rgba(255, 255, 255, 0.3);
}

/* Responsive adjustments */
@media (max-width: 640px) {
  .gradient-bg {
    padding-bottom: 56px;
  }
  
  .main-content-spacing {
    padding-top: calc(64px + 1rem);
  }
  
  .card-gradient {
    padding: 16px;
  }
  
  .floating-animation {
    animation-duration: 8s;
  }
}

@media (max-width: 480px) {
  .main-content-spacing {
    padding-top: calc(64px + 0.75rem);
  }
}

@media (min-width: 1024px) {
  .main-content-spacing {
    padding-top: calc(64px + 2rem);
  }
}
</style>
[file content end]