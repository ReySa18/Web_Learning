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
              <span class="text-white text-lg md:text-xl font-bold">Petani Kode</span>
            </div>
          </div>

          <!-- Desktop Navigation -->
          <div class="hidden md:block">
            <div class="ml-6 md:ml-10 flex items-baseline space-x-3 md:space-x-4">
              <router-link to="/home" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Home</router-link>
              <router-link to="/kelas" class="nav-active text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Kelas</router-link>
              <router-link to="/kuis" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Kuiz</router-link>
              <router-link to="/profile" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">contact</router-link>
            </div>
          </div>

          <!-- Action buttons -->
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

    <!-- Main content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 main-content-spacing pb-6 md:pb-8">
      <!-- Page header -->
      <div class="mb-6 md:mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-white mb-2 md:mb-3">Daftar Materi Pembelajaran</h1>
        <p class="text-gray-300 text-sm md:text-base">Temukan materi yang sesuai dengan kebutuhan belajarmu</p>
      </div>

      <!-- Filter bubbles (PERBAIKAN DI SINI) -->
      <div class="mb-6 md:mb-8">
        <h2 class="text-lg md:text-xl font-semibold text-white mb-3 md:mb-4">Filter Materi</h2>
        <div class="flex flex-wrap gap-3">
          <button 
            v-for="(tag, index) in uniqueTags" 
            :key="index"
            @click="toggleFilter(tag.original)"
            :class="[
              'px-4 py-2 rounded-full text-sm md:text-base font-medium transition-all duration-300 transform hover:scale-105',
              isActive(tag.normalized) 
                ? getTagClass(tag.original) 
                : 'bg-gray-700 text-gray-300 hover:bg-gray-600'
            ]"
          >
            {{ tag.original }}
          </button>
        </div>
      </div>

      <!-- Material cards -->
      <div class="p-4 sm:p-6">
        <div class="flex justify-between items-center mb-4 md:mb-6">
          <h2 class="text-xl md:text-2xl font-bold text-white">
            Materi Tersedia
            <span v-if="activeFilters.length > 0" class="text-gray-400 text-base font-normal">({{ filteredArticles.length }} hasil)</span>
          </h2>
          <div class="relative">
            <select v-model="sortOption" class="glass-effect text-white px-4 py-2 rounded-lg appearance-none pr-8 text-sm md:text-base">
              <option value="newest">Terbaru</option>
              <option value="oldest">Terlama</option>
              <option value="popular">Populer</option>
            </select>
            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
              <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </div>
          </div>
        </div>

        <div v-if="loading" class="flex justify-center py-12">
          <div class="loader"></div>
        </div>
        
        <div v-else-if="filteredArticles.length === 0" class="text-center py-12">
          <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <h3 class="text-xl font-medium text-gray-300 mb-2">Materi tidak ditemukan</h3>
          <p class="text-gray-500 max-w-md mx-auto">
            Tidak ada materi yang sesuai dengan filter yang dipilih. 
            <button @click="resetFilters" class="text-blue-400 hover:text-blue-300 underline">Reset filter</button>
          </p>
        </div>

        <!-- Responsive card grid -->
        <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
          <div
            v-for="card in filteredArticles"
            :key="card.id"
            class="card-gradient rounded-xl p-4 md:p-6 card-hover transform transition-all duration-300 hover:shadow-xl"
          >
            <div class="flex items-center justify-between mb-3 md:mb-4">
              <div :class="card.tagClass" class="px-2 py-1 md:px-3 md:py-1 rounded-full">
                <span class="text-white text-xs font-medium">{{ card.tag }}</span>
              </div>
              <div class="flex items-center">
                <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                <span class="text-gray-300 text-xs">{{ card.rating.toFixed(1) }}</span>
              </div>
            </div>
            <h3 class="text-lg md:text-xl font-semibold text-white mb-2 md:mb-3 leading-tight">
              {{ card.title }}
            </h3>
            <p class="text-gray-300 text-xs md:text-sm mb-3 md:mb-4 line-clamp-2">
              {{ card.description }}
            </p>
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <div class="w-6 h-6 bg-gray-600 rounded-full flex items-center justify-center mr-2">
                  <span class="text-white text-xs font-medium">{{ card.author.charAt(0) }}</span>
                </div>
                <span class="text-gray-400 text-xs">{{ card.author }}</span>
              </div>
              <span class="text-gray-400 text-xs">{{ card.duration }} menit</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Load more button -->
      <div class="text-center mt-8 md:mt-12">
        <button 
          class="glass-effect text-white px-6 py-2.5 md:px-8 md:py-3 rounded-lg font-medium hover:bg-white hover:text-black transition-all duration-300 transform hover:-translate-y-0.5 text-sm md:text-base"
          @click="loadMore"
          :disabled="currentPage >= totalPages"
        >
          {{ currentPage >= totalPages ? 'Semua kelas telah dimuat' : 'Muat Lebih Banyak' }}
        </button>
      </div>
    </main>

    <!-- Mobile navigation -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 glass-effect border-t border-gray-700 z-40 mobile-nav-height">
        <div class="flex justify-around items-center h-full py-1.5">
            <router-link to="/home" class="flex flex-col items-center py-2 px-3 text-gray-400 group" exact-active-class="text-white">
                <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="text-xs">Home</span>
            </router-link>
            <router-link to="/materi" class="flex flex-col items-center py-2 px-3 text-white relative group" exact-active-class="text-white">
                <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                <span class="text-xs">Materi</span>
                <div class="absolute top-0 w-1.5 h-1 bg-white rounded-full"></div>
            </router-link>
            <router-link to="/kuis" class="flex flex-col items-center py-2 px-3 text-gray-400 group" exact-active-class="text-white">
                <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                <span class="text-xs">Kuiz</span>
            </router-link>
            <router-link to="/profile" class="flex flex-col items-center py-2 px-3 text-gray-400 group" exact-active-class="text-white">
                <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                <span class="text-xs">contact</span>
            </router-link>
        </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import axios from 'axios'

const articles = ref([])
const filteredArticles = ref([])
const loading = ref(true)
const activeFilters = ref([])
const sortOption = ref('newest')
const currentPage = ref(1)
const itemsPerPage = 6

// Fungsi untuk normalisasi tag
const normalizeTag = (tag) => tag.toLowerCase().trim()

// Komputed untuk mendapatkan tag unik dengan versi normalized dan original
const uniqueTags = computed(() => {
  const tagsMap = new Map()
  articles.value.forEach(article => {
    const normalized = normalizeTag(article.tag)
    if (!tagsMap.has(normalized)) {
      tagsMap.set(normalized, {
        normalized,
        original: article.tag
      })
    }
  })
  return Array.from(tagsMap.values())
})

// Cek apakah tag aktif
const isActive = (normalizedTag) => {
  return activeFilters.value.some(filter => 
    normalizeTag(filter) === normalizedTag
  )
}

// Ambil data dari API
const fetchMateri = async () => {
  try {
    loading.value = true
    const response = await axios.get('http://localhost:8000/api/materi')
    const data = response.data

    articles.value = data.map(item => ({
      id: item.id,
      tag: item.label,
      tagClass: getTagClass(item.label),
      title: item.judul,
      description: item.deskripsi,
      author: '@admin',
      duration: Math.floor(Math.random() * 30) + 15,
      rating: parseFloat((Math.random() * 2 + 3).toFixed(1)),
      progressWidth: `${Math.floor(Math.random() * 50) + 30}px`,
    }))

    applyFilters()
  } catch (error) {
    console.error('Gagal mengambil data materi:', error)
  } finally {
    loading.value = false
  }
}

// Filter berdasarkan tag
const toggleFilter = (tag) => {
  const index = activeFilters.value.indexOf(tag)
  if (index > -1) {
    activeFilters.value.splice(index, 1)
  } else {
    activeFilters.value.push(tag)
  }
  currentPage.value = 1
  applyFilters()
}

// Reset filter
const resetFilters = () => {
  activeFilters.value = []
  currentPage.value = 1
  applyFilters()
}

// Terapkan filter + sort + pagination
const applyFilters = () => {
  let result = [...articles.value]

  // Filter berdasarkan tag (case-insensitive)
  if (activeFilters.value.length > 0) {
    const normalizedFilters = activeFilters.value.map(normalizeTag)
    result = result.filter(article => 
      normalizedFilters.includes(normalizeTag(article.tag)))
  }

  // Sort
  switch (sortOption.value) {
    case 'newest':
      result.sort((a, b) => b.id - a.id)
      break
    case 'oldest':
      result.sort((a, b) => a.id - b.id)
      break
    case 'popular':
      result.sort((a, b) => b.rating - a.rating)
      break
  }

  // Pagination
  const start = 0
  const end = currentPage.value * itemsPerPage
  filteredArticles.value = result.slice(start, end)
}

// Load more
const loadMore = () => {
  currentPage.value++
  applyFilters()
}

// Styling tag (case-insensitive)
const getTagClass = (label) => {
  const normalizedLabel = normalizeTag(label)
  switch (normalizedLabel) {
    case 'python': return 'tag-gradient'
    case 'java': return 'tag-gradient-2'
    case 'c': return 'tag-gradient-3'
    case 'algoritma': return 'tag-gradient'
    case 'database': return 'tag-gradient-2'
    case 'oop': return 'tag-gradient-3'
    case 'web': return 'tag-gradient-4'
    case 'javascript': return 'tag-gradient-5'
    default: return 'tag-gradient-6'
  }
}

// Pantau perubahan opsi sorting
watch(sortOption, () => {
  currentPage.value = 1
  applyFilters()
})

onMounted(() => {
  fetchMateri()
})
</script>

<style scoped>
/* Include all styles from home.vue */
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

.tag-gradient { background: linear-gradient(45deg, #3b82f6, #1d4ed8); }
.tag-gradient-2 { background: linear-gradient(45deg, #f59e0b, #d97706); }
.tag-gradient-3 { background: linear-gradient(45deg, #ef4444, #dc2626); }
.tag-gradient-4 { background: linear-gradient(45deg, #8b5cf6, #7c3aed); }
.tag-gradient-5 { background: linear-gradient(45deg, #06b6d4, #0891b2); }
.tag-gradient-6 { background: linear-gradient(45deg, #10b981, #059669); }

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
  
  /* Adjust filter bubbles for small screens */
  .flex-wrap > button {
    font-size: 0.75rem;
    padding: 0.4rem 0.8rem;
  }
}

@media (min-width: 1024px) {
  .main-content-spacing {
    padding-top: calc(64px + 2rem);
  }
}
</style>