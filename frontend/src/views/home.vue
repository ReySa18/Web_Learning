<template>
  <div class="gradient-bg">
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
      <div class="floating-animation absolute top-[15%] left-[10%] md:top-1/4 md:left-1/4 w-1.5 h-1.5 md:w-2 md:h-2 bg-white rounded-full opacity-20"></div>
      <div class="floating-animation absolute top-[20%] right-[10%] md:top-1/3 md:right-1/4 w-1 h-1 bg-white rounded-full opacity-30"></div>
      <div class="floating-animation absolute bottom-[15%] left-[15%] md:bottom-1/4 md:left-1/3 w-1.5 h-1.5 bg-white rounded-full opacity-15"></div>
      <div class="floating-animation absolute top-1/2 right-[15%] md:right-1/3 w-1.5 h-1.5 md:w-2 md:h-2 bg-white rounded-full opacity-25"></div>
      <div class="floating-animation absolute bottom-[20%] right-[10%] md:bottom-1/3 md:right-1/4 w-1 h-1 bg-white rounded-full opacity-20"></div>
    </div>

    <!-- Improved navigation with consistent height -->
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
              <span class="text-white text-lg md:text-xl font-bold">Petani Kode</span>
            </div>
          </div>

          <!-- Desktop Navigation -->
          <div class="hidden md:block">
            <div class="ml-6 md:ml-10 flex items-baseline space-x-3 md:space-x-4">
              <router-link to="/home" class="nav-active text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Home</router-link>
              <router-link to="/kelas" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Kelas</router-link>
              <router-link to="/kuis" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Kuiz</router-link>
              <router-link to="/profile" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">contact</router-link>
            </div>
          </div>

          <!-- Action buttons with responsive spacing -->
          <div class="flex items-center space-x-3 md:space-x-4">
            <button class="text-gray-300 hover:text-white transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
            </button>
            <button class="text-gray-300 hover:text-white transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5-5-5h5v-5a7.5 7.5 0 011-3.5"></path>
              </svg>
            </button>
            <button class="w-7 h-7 md:w-8 md:h-8 bg-gray-600 rounded-full flex items-center justify-center">
              <span class="text-white text-xs md:text-sm font-medium">U</span>
            </button>
          </div>
        </div>
      </div>
    </nav>

    <!-- Main content with proper top spacing -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 main-content-spacing pb-6 md:pb-8">
      <div class="mb-6 md:mb-8">
        <div class="flex items-center mb-3 md:mb-4">
          <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs md:text-sm font-medium mr-2 md:mr-3">UPDATE</span>
          <div class="pulse-dot w-2 h-2 bg-green-400 rounded-full"></div>
        </div>
        <h1 class="text-2xl md:text-3xl font-bold text-white mb-1 md:mb-2">Apa yang baru di Petani Kode? 🔥</h1>
        <p class="text-gray-300 text-sm md:text-base">Baca Materi terbaru yang masih fresh dan hangat.</p>
      </div>

      <!-- Responsive card grid -->
      <div class="p-6">
        <h1 class="text-2xl font-bold text-white mb-4">Kumpulan Materi</h1>

        <div v-if="loading" class="text-gray-300">Memuat materi...</div>
        <div v-else-if="articles.length === 0" class="text-gray-300">Belum ada materi.</div>

        <!-- Responsive card grid -->
        <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
          <div
            v-for="card in articles"
            :key="card.id"
            class="card-gradient rounded-xl p-4 md:p-6 card-hover transform transition-all duration-300 hover:shadow-xl"
          >
            <div class="flex items-center justify-between mb-3 md:mb-4">
              <div :class="card.tagClass" class="px-2 py-1 md:px-3 md:py-1 rounded-full">
                <span class="text-white text-xs font-medium">{{ card.tag }}</span>
              </div>
              <svg
                v-if="card.icon === 'heart'"
                class="w-7 h-7 md:w-8 md:h-8 text-red-400"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                ></path>
              </svg>
            </div>
            <h3 class="text-lg md:text-xl font-semibold text-white mb-2 md:mb-3 leading-tight">
              {{ card.title }}
            </h3>
            <p class="text-gray-300 text-xs md:text-sm mb-3 md:mb-4 line-clamp-2">
              {{ card.description }}
            </p>
            <div class="flex items-center justify-between">
              <span class="text-gray-400 text-xs">{{ card.author }}</span>
              <div class="progress-bar h-1.5 md:h-2 rounded-full" :style="{ width: card.progressWidth }"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Load more button with responsive sizing -->
      <div class="text-center mt-8 md:mt-12">
        <router-link to="/kelas">
          <button class="glass-effect text-white px-6 py-2.5 md:px-8 md:py-3 rounded-lg font-medium hover:bg-white hover:text-black transition-all duration-300 transform hover:-translate-y-0.5 text-sm md:text-base">
            Muat Lebih Banyak Kelas
          </button>
        </router-link>
      </div>
    </main>

    <!-- Enhanced mobile navigation with active indicator -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 glass-effect border-t border-gray-700 z-40 mobile-nav-height">
        <div class="flex justify-around items-center h-full py-1.5">
            <router-link to="/home"class="flex flex-col items-center py-2 px-3 text-white relative group" exact-active-class="text-white">
                <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="text-xs">Home</span>
                <div class="absolute top-0 w-1.5 h-1 bg-white rounded-full"></div>
            </router-link>
            <router-link to="/kelas" class="flex flex-col items-center py-2 px-3 text-gray-400 group" exact-active-class="text-white">
                <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                <span class="text-xs">Materi</span>
            </router-link>
            <router-link to="/kuis" class="flex flex-col items-center py-2 px-3 text-gray-400 group" exact-active-class="text-white">
                <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                <span class="text-xs">Kuiz</span>
            </router-link>
            <router-link to="/admin" class="flex flex-col items-center py-2 px-3 text-gray-400 group" exact-active-class="text-white">
                <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                <span class="text-xs">contact</span>
            </router-link>
        </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const articles = ref([])
const loading = ref(true)

const fetchMateri = async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/materi')
    articles.value = response.data.map((item) => ({
      id: item.id,
      tag: item.kategori?.nama,
      tagClass: getTagClass(item.kategori?.nama),
      title: item.judul,
      description: item.deskripsi,
      author: '@admin',
    }))
  } catch (error) {
    console.error('Gagal mengambil data materi:', error)
  } finally {
    loading.value = false
  }
}

const getTagClass = (label) => {
    // Sesuaikan warna label dengan class Tailwind milikmu
  switch (label.toLowerCase()) {
    case 'python':
      return 'tag-gradient'
    case 'java':
      return 'tag-gradient-2'
    case 'c':
      return 'tag-gradient-3'
    default:
      return 'tag-gradient-5'
  }
}

const getRandomProgressWidth = () => {
  // Simulasi progressWidth acak
  const widths = ['32px', '40px', '48px', '56px', '64px', '72px', '80px']
  return widths[Math.floor(Math.random() * widths.length)]
}

onMounted(() => {
  fetchMateri()
})
</script>


<style>
/* Import Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

/* Global reset untuk full screen */
*, *::before, *::after {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html {
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  font-family: 'Inter', sans-serif;
}

body {
  margin: 0 !important;
  padding: 0 !important;
  width: 100%;
  height: 100%;
  overflow-x: hidden;
  font-family: 'Inter', sans-serif;
}

#app {
  margin: 0 !important;
  padding: 0 !important;
  width: 100vw;
  min-height: 100vh;
  position: relative;
}

/* Reset untuk Vue app wrapper jika ada */
.vue-app, [data-v-app] {
  margin: 0 !important;
  padding: 0 !important;
}

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

/* Fixed navbar height for consistency */
.navbar-height {
  height: 64px; /* 16 * 4 = 64px (h-16) */
}

/* Proper spacing for main content to always be below navbar */
.main-content-spacing {
  padding-top: calc(64px + 1.5rem); /* navbar height + extra spacing */
}

/* Mobile navigation height */
.mobile-nav-height {
  height: 56px; /* Consistent mobile nav height */
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

.floating-animation:nth-child(2) {
  animation-delay: -2s;
}

.floating-animation:nth-child(3) {
  animation-delay: -4s;
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

.progress-bar {
  background: linear-gradient(90deg, #4ade80, #22c55e);
}

.pulse-dot {
  animation: pulse-dot 2s infinite;
}

@keyframes pulse-dot {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.5; }
}

.tag-gradient { background: linear-gradient(45deg, #3b82f6, #1d4ed8); }
.tag-gradient-2 { background: linear-gradient(45deg, #f59e0b, #d97706); }
.tag-gradient-3 { background: linear-gradient(45deg, #ef4444, #dc2626); }
.tag-gradient-4 { background: linear-gradient(45deg, #8b5cf6, #7c3aed); }
.tag-gradient-5 { background: linear-gradient(45deg, #06b6d4, #0891b2); }
.tag-gradient-6 { background: linear-gradient(45deg, #10b981, #059669); }

/* New responsive additions */
.line-clamp-2 {
  display: -webkit-box;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Smoother transitions */
.transition-colors {
  transition: color 0.2s ease, background-color 0.2s ease;
}

/* Responsive adjustments */
@media (max-width: 640px) {
  .gradient-bg {
    padding-bottom: 56px; /* Space for bottom nav */
  }
  
  .main-content-spacing {
    padding-top: calc(64px + 1rem); /* Slightly less spacing on mobile */
  }
  
  .card-gradient {
    padding: 16px;
  }
  
  .floating-animation {
    animation-duration: 8s; /* Slower on mobile */
  }
}

@media (max-width: 480px) {
  .main-content-spacing {
    padding-top: calc(64px + 0.75rem); /* Even tighter on very small screens */
  }
}

/* Large screen adjustments */
@media (min-width: 1024px) {
  .main-content-spacing {
    padding-top: calc(64px + 2rem); /* More generous spacing on desktop */
  }
}
</style>