<template>
  <div class="gradient-bg">
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
      <!-- Floating animations -->
      <div class="floating-animation absolute top-[15%] left-[10%] md:top-1/4 md:left-1/4 w-1.5 h-1.5 md:w-2 md:h-2 bg-white rounded-full opacity-20"></div>
      <div class="floating-animation absolute top-[20%] right-[10%] md:top-1/3 md:right-1/4 w-1 h-1 bg-white rounded-full opacity-30"></div>
      <div class="floating-animation absolute bottom-[15%] left-[15%] md:bottom-1/4 md:left-1/3 w-1.5 h-1.5 bg-white rounded-full opacity-15"></div>
      <div class="floating-animation absolute top-1/2 right-[15%] md:right-1/3 w-1.5 h-1.5 md:w-2 md:h-2 bg-white rounded-full opacity-25"></div>
      <div class="floating-animation absolute bottom-[20%] right-[10%] md:bottom-1/3 md:right-1/4 w-1 h-1 bg-white rounded-full opacity-20"></div>
    </div>

    <!-- Enhanced navigation -->
    <nav class="glass-effect border-b border-gray-700 sticky top-0 z-50 navbar-height">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
        <div class="flex justify-between items-center h-full">
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

          <!-- Desktop Navigation -->
          <div class="hidden md:block">
            <div class="ml-6 md:ml-10 flex items-baseline space-x-3 md:space-x-4">
              <router-link to="/home" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Home</router-link>
              <router-link to="/kelas" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Materi</router-link>
              <router-link to="/kuis" class="nav-active  text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Latihan Soal</router-link>
              <router-link to="/aboutme" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">About Dev</router-link>
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
      <div class="mb-6 md:mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-white mb-1 md:mb-2">Kuis Pembelajaran 📚</h1>
        <p class="text-gray-300 text-sm md:text-base">Uji pengetahuanmu dengan kuis-kuis menarik berikut ini!</p>
        
        <!-- Loading state -->
        <div v-if="loading" class="text-center py-12">
          <div class="inline-block animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500 mb-4"></div>
          <p class="text-gray-400">Memuat kuis...</p>
        </div>

        <!-- Error state -->
        <div v-else-if="error" class="text-center py-12">
          <div class="inline-block p-4 bg-red-500/20 rounded-full mb-4">
            <svg class="w-12 h-12 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <p class="text-red-400 mb-4">Gagal memuat data kuis</p>
          <button @click="fetchQuizzes" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
            Coba Lagi
          </button>
        </div>

        <!-- Content when data is loaded -->
        <template v-else>
          <!-- Category filter -->
          <div class="mt-4 flex flex-wrap gap-2">
            <button 
              v-for="(category, index) in categories" 
              :key="index"
              @click="filterByCategory(category)"
              :class="[
                'px-3 py-1.5 rounded-full text-xs md:text-sm font-medium transition-colors',
                selectedCategory === category 
                  ? 'bg-blue-500 text-white' 
                  : 'bg-gray-700 text-gray-300 hover:bg-gray-600'
              ]"
            >
              {{ category }}
            </button>
          </div>
        </template>
      </div>

      <!-- Quiz cards grid -->
      <div v-if="!loading && !error" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
        <div
          v-for="quiz in filteredQuizzes"
          :key="quiz.id"
          class="card-gradient rounded-xl p-4 md:p-6 card-hover transform transition-all duration-300 hover:shadow-xl"
        >
          <div class="flex items-center justify-between mb-3 md:mb-4">
            <div :class="getTagClass(quiz.kategori_id)" class="px-2 py-1 md:px-3 md:py-1 rounded-full">
              <span class="text-white text-xs font-medium">{{ quiz.kategori.nama }}</span>
            </div>
          </div>
          
          <h3 class="text-lg md:text-xl font-semibold text-white mb-2 md:mb-3 leading-tight">{{ quiz.topik.nama }} {{ quiz.kategori.nama }}</h3>
          
          <div class="flex items-center justify-between">
            <div class="text-gray-400 text-xs">
              ID: {{ quiz.kategori_id }}-{{ quiz.topik_id }}
            </div>
            <button 
              @click="startQuiz(quiz)"
              class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-md text-xs font-medium transition-colors"
            >
              Mulai Kuis
            </button>
          </div>
        </div>
      </div>

      <!-- Empty state -->
      <div v-if="!loading && !error && filteredQuizzes.length === 0" class="text-center py-12">
        <div class="inline-block p-4 bg-gray-800 rounded-full mb-4">
          <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
          </svg>
        </div>
        <p class="text-gray-400 mb-4">Tidak ada kuis yang tersedia</p>
        <button 
          v-if="selectedCategory !== 'Semua'" 
          @click="selectedCategory = 'Semua'"
          class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md"
        >
          Tampilkan Semua Kuis
        </button>
      </div>
    </main>

    <!-- Enhanced mobile navigation with active indicator -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 glass-effect border-t border-gray-700 z-40 mobile-nav-height">
        <div class="flex justify-around items-center h-full py-1.5">
            <router-link to="/home"class="flex flex-col items-center py-2 px-3 text-gray-400 group" exact-active-class="text-white">
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
                <div class="absolute top-0 w-1.5 h-1 bg-white rounded-full"></div>
            </router-link>
            <router-link to="/aboutme" class="flex flex-col items-center py-2 px-3 text-gray-400 group" exact-active-class="text-white">
                <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-xs">About Dev</span>
            </router-link>
        </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import api from '@/api';

const router = useRouter()

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

// Toggle dropdown
const toggleDropdown = () => {
  showDropdown.value = !showDropdown.value
}

// Ambil data user dari API
const fetchUser = async () => {
  try {
    const token = localStorage.getItem('auth_token');
    const response = await api.get('/user')
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
  router.push({ name: 'landingPage' })
}

// Tutup dropdown ketika klik di luar
const handleClickOutside = (event) => {
  const dropdown = document.querySelector('.relative > div')
  if (dropdown && !dropdown.contains(event.target)) {
    showDropdown.value = false
  }
}


// Kategori untuk filter
const categories = ref(['Semua']);
const selectedCategory = ref('Semua');

// Data kuis
const quizzes = ref([]);
const loading = ref(true);
const error = ref(false);

// Ambil kuis dari API
const fetchQuizzes = async () => {
  try {
    loading.value = true;
    error.value = false;

    const response = await api.get('/latihan/list');
    quizzes.value = response.data.data;

    // Ambil nama kategori unik untuk filter
    const uniqueCategories = [...new Set(quizzes.value.map(q => q.kategori.nama))];
    categories.value = ['Semua', ...uniqueCategories];

  } catch (err) {
    console.error('Gagal mengambil data kuis:', err);
    error.value = true;
  } finally {
    loading.value = false;
  }
};



// Kelas warna berdasarkan kategori ID
const getTagClass = (kategori_id) => {
  const classes = [
    'tag-gradient',
    'tag-gradient-2',
    'tag-gradient-3',
    'tag-gradient-4',
    'tag-gradient-5',
    'tag-gradient-6'
  ];
  return classes[kategori_id % classes.length] || 'tag-gradient';
};

// Filter kuis berdasarkan kategori
const filteredQuizzes = computed(() => {
  if (selectedCategory.value === 'Semua') {
    return quizzes.value;
  }
  return quizzes.value.filter(quiz => quiz.kategori.nama === selectedCategory.value);
});

// Ganti filter kategori
const filterByCategory = (category) => {
  selectedCategory.value = category;
};

// Navigasi ke halaman soal kuis
const startQuiz = (quiz) => {
  router.push({
    name: 'Soal',
    params: {
      kategori_id: quiz.kategori_id,
      topik_id: quiz.topik_id
    }
  });
};

// Fetch saat komponen dimount
onMounted(() => {
  fetchQuizzes();
  fetchUser()
  document.addEventListener('click', handleClickOutside)
});
</script>


<style>


/* Reset untuk Vue app wrapper jika ada */
.vue-app, [data-v-app] {
  margin: 0 !important;
  padding: 0 !important;
}

/* Reuse styles from home.vue */
.gradient-bg {
  background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #000000 100%);
  min-height: 100vh;
  width: 100vw;
  margin: 0;
  padding: 0;
  position: relative;
  left: 0;
  top: 0;
  font-family: 'Inter', sans-serif;
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

.floating-animation:nth-child(2) {
  animation-delay: -2s;
}

.floating-animation:nth-child(3) {
  animation-delay: -4s;
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

.progress-bar {
  background: linear-gradient(90deg, #4ade80, #22c55e);
}

/* Tag gradients */
.tag-gradient { background: linear-gradient(45deg, #3b82f6, #1d4ed8); }
.tag-gradient-2 { background: linear-gradient(45deg, #f59e0b, #d97706); }
.tag-gradient-3 { background: linear-gradient(45deg, #ef4444, #dc2626); }
.tag-gradient-4 { background: linear-gradient(45deg, #8b5cf6, #7c3aed); }
.tag-gradient-5 { background: linear-gradient(45deg, #06b6d4, #0891b2); }
.tag-gradient-6 { background: linear-gradient(45deg, #10b981, #059669); }

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
