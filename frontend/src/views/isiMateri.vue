<template>
  <div class="gradient-bg">
    <!-- Floating animation dots -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
      <div class="floating-animation absolute top-[15%] left-[10%] md:top-1/4 md:left-1/4 w-1.5 h-1.5 md:w-2 md:h-2 bg-white rounded-full opacity-20"></div>
      <div class="floating-animation absolute top-[20%] right-[10%] md:top-1/3 md:right-1/4 w-1 h-1 bg-white rounded-full opacity-30"></div>
      <div class="floating-animation absolute bottom-[15%] left-[15%] md:bottom-1/4 md:left-1/3 w-1.5 h-1.5 bg-white rounded-full opacity-15"></div>
      <div class="floating-animation absolute top-1/2 right-[15%] md:right-1/3 w-1.5 h-1.5 md:w-2 md:h-2 bg-white rounded-full opacity-25"></div>
      <div class="floating-animation absolute bottom-[20%] right-[10%] md:bottom-1/3 md:right-1/4 w-1 h-1 bg-white rounded-full opacity-20"></div>
    </div>

    <!-- Header dengan tombol kembali dan latihan soal -->
    <nav class="glass-effect border-b border-gray-700 sticky top-0 z-50 navbar-height">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
        <div class="flex justify-between items-center h-full">
          <div class="flex items-center">
            <button @click="goBack" class="text-gray-300 hover:text-white flex items-center transition-colors">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
              </svg>
              <span class="text-sm">Kembali</span>
            </button>
          </div>

          <router-link to="/home" class="flex items-center">
            <div class="flex-shrink-0 flex items-center">
              <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center mr-2 md:mr-3">
                <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
              </div>
              <span class="text-white text-lg md:text-xl font-bold">Asteria Code</span>
            </div>
          </router-link>

          <div class="flex items-center">
            <router-link :to="`/kuis/${materiId}`">
              <button class="glass-effect text-white px-4 py-1.5 md:px-5 md:py-2 rounded-lg font-medium hover:bg-white hover:text-black transition-all duration-300 text-sm md:text-base flex items-center">
                <svg class="w-4 h-4 md:w-5 md:h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                Latihan Soal
              </button>
            </router-link>
          </div>
        </div>
      </div>
    </nav>

    <!-- Konten utama materi -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 main-content-spacing pb-6 md:pb-8">
      <div v-if="loading" class="text-center py-12">
        <div class="text-gray-300">Memuat materi...</div>
      </div>

      <div v-else-if="error" class="text-center py-12">
        <div class="text-red-400 mb-4">Gagal memuat materi</div>
        <button @click="fetchMateri()" class="glass-effect text-white px-4 py-2 rounded-lg font-medium">
          Coba Lagi
        </button>
      </div>

      <div v-else class="glass-effect rounded-xl p-6 md:p-8">
        <!-- Header materi -->
        <div class="mb-6 flex flex-wrap items-center justify-between">
          <div>
            <div :class="tagClass" class="px-3 py-1 rounded-full inline-block mb-3">
              <span class="text-white text-xs md:text-sm font-medium">{{ materi.kategori?.nama || 'Pemrograman' }}</span>
            </div>
            <h1 class="text-2xl md:text-3xl font-bold text-white mb-3">{{ materi.judul }}</h1>
            <div class="flex items-center text-gray-400 text-sm">
              <span class="mr-4">Oleh: @admin</span>
              <span>{{ formatDate(materi.created_at) }}</span>
            </div>
          </div>
          <button @click="toggleBookmark" class="p-2 rounded-full hover:bg-white/10 transition-colors">
            <svg v-if="isBookmarked" class="w-6 h-6 text-red-400" fill="currentColor" viewBox="0 0 24 24">
              <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            <svg v-else class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
          </button>
        </div>

        <!-- Konten materi -->
        <div class="prose prose-invert max-w-none">
          <div v-html="materi.konten"></div>
        </div>

        <!-- Tombol download jika ada gambar -->
        <div v-if="materi.gambar" class="mt-6">
          <a
            :href="`https://asteriacode.my.id/storage/${materi.gambar}`"
            :download="materi.gambar.split('/').pop()"
            class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
            </svg>
            Unduh Lampiran
          </a>
        </div>

        <!-- Navigasi materi -->
        <div class="mt-12 pt-6 border-t border-gray-700 flex flex-wrap justify-between">
          <button
            v-if="prevMateri"
            @click="goToMateri(prevMateri.id)"
            class="glass-effect text-white px-4 py-2 rounded-lg font-medium mb-3 sm:mb-0 flex items-center"
          >
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            {{ prevMateri.judul }}
          </button>
          <div v-else></div> <!-- untuk menjaga tata letak -->

          <button
            v-if="nextMateri"
            @click="goToMateri(nextMateri.id)"
            class="glass-effect text-white px-4 py-2 rounded-lg font-medium flex items-center ml-auto"
          >
            {{ nextMateri.judul }}
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
          </button>
        </div>
      </div>
    </main>


    <!-- Mobile navigation -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 glass-effect border-t border-gray-700 z-40 mobile-nav-height">
      <div class="flex justify-around items-center h-full py-1.5">
        <router-link to="/home" class="flex flex-col items-center py-2 px-3 text-white relative group" exact-active-class="text-white">
          <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
          </svg>
          <span class="text-xs">Home</span>
        </router-link>
        <router-link to="/kelas" class="flex flex-col items-center py-2 px-3 text-white group" exact-active-class="text-white">
          <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
          </svg>
          <span class="text-xs">Materi</span>
        </router-link>
        <router-link to="/kuis" class="flex flex-col items-center py-2 px-3 text-gray-400 group" exact-active-class="text-white">
          <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
          </svg>
          <span class="text-xs">Latihan Soal</span>
        </router-link>
        <router-link to="/aboutme" class="flex flex-col items-center py-2 px-3 text-gray-400 group" exact-active-class="text-white">
          <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span class="text-xs">About Me</span>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import api from '@/api';

const route = useRoute()
const router = useRouter()

const materiId = ref(route.params.id)
const materi = ref({})
const allMateri = ref([])
const loading = ref(true)
const error = ref(null)
const isBookmarked = ref(false)

// Ambil data materi berdasarkan ID
const fetchMateri = async (id) => {
  try {
    loading.value = true
    error.value = null

    // Ambil materi detail
    const response = await api.get(`/materi/${id}`)
    materi.value = response.data

    // Ambil semua materi untuk navigasi prev/next
    const materiListResponse = await api.get('/materi')
    allMateri.value = materiListResponse.data
  } catch (err) {
    console.error('Gagal memuat materi:', err)
    error.value = 'Gagal memuat data materi. Silakan coba lagi.'
  } finally {
    loading.value = false
  }
}

// Navigasi ke materi lain
const goToMateri = (id) => {
  materiId.value = id
  router.push({ name: 'isiMateri', params: { id } })
  window.scrollTo(0, 0)
}

// Pantau perubahan route
watch(() => route.params.id, (newId) => {
  materiId.value = newId
  fetchMateri(newId)
})

// Bookmark toggle
const toggleBookmark = () => {
  isBookmarked.value = !isBookmarked.value
}

// Format tanggal
const formatDate = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('id-ID', {
    year: 'numeric', month: 'long', day: 'numeric'
  })
}

// Hitung materi dengan kategori yang sama
const sameKategoriMateri = computed(() => {
  return allMateri.value.filter(m => m.kategori_id === materi.value.kategori?.id)
})

const currentIndex = computed(() => {
  return sameKategoriMateri.value.findIndex(m => m.id === parseInt(materiId.value))
})

const prevMateri = computed(() => {
  return currentIndex.value > 0
    ? sameKategoriMateri.value[currentIndex.value - 1]
    : null
})

const nextMateri = computed(() => {
  return currentIndex.value < sameKategoriMateri.value.length - 1
    ? sameKategoriMateri.value[currentIndex.value + 1]
    : null
})


// Kembali ke halaman sebelumnya
const goBack = () => {
  router.push('/kelas')
}

// Class warna tag kategori
const tagClass = computed(() => {
  const kategori = materi.value.kategori?.nama?.toLowerCase() || ''
  switch (kategori) {
    case 'python': return 'tag-gradient'
    case 'java': return 'tag-gradient-2'
    case 'c': return 'tag-gradient-3'
    case 'javascript': return 'tag-gradient-4'
    case 'html': return 'tag-gradient-5'
    default: return 'tag-gradient-6'
  }
})

// Mulai saat komponen dimount
onMounted(() => {
  fetchMateri(materiId.value)
})
</script>

<style scoped>
/* Impor gaya yang sama dengan home.vue */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html, body {
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  font-family: 'Inter', sans-serif;
  overflow-x: hidden;
}

.gradient-bg {
  background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #000000 100%);
  min-height: 100vh;
  width: 100vw;
  margin: 0;
  padding: 0;
  position: relative;
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

.floating-animation {
  animation: float 6s ease-in-out infinite;
}

.floating-animation:nth-child(2) { animation-delay: -2s; }
.floating-animation:nth-child(3) { animation-delay: -4s; }

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

/* Gaya untuk tag */
.tag-gradient { background: linear-gradient(45deg, #3b82f6, #1d4ed8); }
.tag-gradient-2 { background: linear-gradient(45deg, #f59e0b, #d97706); }
.tag-gradient-3 { background: linear-gradient(45deg, #ef4444, #dc2626); }
.tag-gradient-4 { background: linear-gradient(45deg, #8b5cf6, #7c3aed); }
.tag-gradient-5 { background: linear-gradient(45deg, #06b6d4, #0891b2); }
.tag-gradient-6 { background: linear-gradient(45deg, #10b981, #059669); }

/* Gaya untuk konten materi */
.prose :deep(h1), 
.prose :deep(h2), 
.prose :deep(h3), 
.prose :deep(h4) {
  color: white;
  margin-top: 1.5em;
  margin-bottom: 0.8em;
  font-weight: 600;
}

.prose :deep(h1) { font-size: 1.875rem; line-height: 2.25rem; }
.prose :deep(h2) { font-size: 1.5rem; line-height: 2rem; }
.prose :deep(h3) { font-size: 1.25rem; line-height: 1.75rem; }
.prose :deep(h4) { font-size: 1.125rem; line-height: 1.75rem; }

.prose :deep(p) {
  color: #d1d5db;
  margin-bottom: 1.2em;
  line-height: 1.75;
}

.prose :deep(a) {
  color: #60a5fa;
  text-decoration: underline;
}

.prose :deep(ul), 
.prose :deep(ol) {
  padding-left: 1.5em;
  margin-bottom: 1.5em;
  color: #d1d5db;
}

.prose :deep(li) {
  margin-bottom: 0.5em;
}

.prose :deep(code) {
  background: rgba(107, 114, 128, 0.3);
  color: #f3f4f6;
  padding: 0.2em 0.4em;
  border-radius: 0.25rem;
  font-family: 'Fira Code', monospace;
}

.prose :deep(pre) {
  background: #1f2937;
  border-radius: 0.5rem;
  padding: 1.25rem;
  overflow-x: auto;
  margin-bottom: 1.5em;
}

.prose :deep(pre code) {
  background: none;
  padding: 0;
  color: #e5e7eb;
  font-size: 0.875rem;
}

.prose :deep(blockquote) {
  border-left: 4px solid #4b5563;
  padding-left: 1.5rem;
  margin: 1.5em 0;
  color: #d1d5db;
  font-style: italic;
}

/* Responsif */
@media (max-width: 768px) {
  .main-content-spacing {
    padding-top: calc(64px + 1rem);
  }
  
  .prose :deep(h1) { font-size: 1.5rem; }
  .prose :deep(h2) { font-size: 1.3rem; }
  .prose :deep(h3) { font-size: 1.15rem; }
}

@media (max-width: 480px) {
  .main-content-spacing {
    padding-top: calc(64px + 0.75rem);
  }
  
  .glass-effect {
    padding: 1rem;
  }
  
  .prose :deep(pre) {
    padding: 0.75rem;
    font-size: 0.75rem;
  }
}
</style>