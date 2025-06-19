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
              <router-link to="/kelas" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Kelas</router-link>
              <router-link to="/kuis" class="nav-active  text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Kuiz</router-link>
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
            <div class="w-7 h-7 md:w-8 md:h-8 bg-gray-600 rounded-full flex items-center justify-center">
              <span class="text-white text-xs md:text-sm font-medium">JD</span>
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
      </div>

      <!-- Quiz cards grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
        <div
          v-for="quiz in filteredQuizzes"
          :key="quiz.id"
          class="card-gradient rounded-xl p-4 md:p-6 card-hover transform transition-all duration-300 hover:shadow-xl"
        >
          <div class="flex items-center justify-between mb-3 md:mb-4">
            <div :class="quiz.tagClass" class="px-2 py-1 md:px-3 md:py-1 rounded-full">
              <span class="text-white text-xs font-medium">{{ quiz.category }}</span>
            </div>
            <div class="flex items-center">
              <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
              </svg>
              <span class="text-gray-300 text-xs">{{ quiz.difficulty }}</span>
            </div>
          </div>
          
          <h3 class="text-lg md:text-xl font-semibold text-white mb-2 md:mb-3 leading-tight">{{ quiz.title }}</h3>
          <div class="flex items-center text-gray-300 text-xs md:text-sm mb-3 md:mb-4">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
            </svg>
            {{ quiz.questionCount }} soal • {{ quiz.duration }} menit
          </div>
          
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <div class="w-6 h-6 bg-gray-600 rounded-full flex items-center justify-center mr-2">
                <span class="text-white text-xs font-medium">{{ quiz.authorInitials }}</span>
              </div>
              <span class="text-gray-400 text-xs">{{ quiz.author }}</span>
            </div>
            <button 
              @click="startQuiz(quiz.id)"
              class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-md text-xs font-medium transition-colors"
            >
              Mulai Kuis
            </button>
          </div>
        </div>
      </div>

      <!-- Active quiz section -->
      <div class="mt-10">
        <h2 class="text-xl md:text-2xl font-bold text-white mb-4 md:mb-6">Kuis yang Sedang Berlangsung</h2>
        
        <div v-if="activeQuizzes.length > 0" class="grid grid-cols-1 gap-4 md:gap-6">
          <div 
            v-for="quiz in activeQuizzes" 
            :key="quiz.id"
            class="card-gradient rounded-xl p-4 md:p-6"
          >
            <div class="flex items-center justify-between mb-3">
              <div class="flex items-center">
                <div :class="quiz.tagClass" class="px-2 py-1 rounded-full mr-3">
                  <span class="text-white text-xs font-medium">{{ quiz.category }}</span>
                </div>
                <span class="text-gray-300 text-xs bg-yellow-500/20 px-2 py-1 rounded">Dalam Proses</span>
              </div>
              <span class="text-gray-400 text-xs">{{ quiz.progress }}/{{ quiz.questionCount }} soal</span>
            </div>
            
            <h3 class="text-lg font-semibold text-white mb-2">{{ quiz.title }}</h3>
            
            <div class="w-full bg-gray-700 rounded-full h-2 mb-3">
              <div 
                class="progress-bar h-2 rounded-full" 
                :style="{ width: `${(quiz.progress / quiz.questionCount) * 100}%` }"
              ></div>
            </div>
            
            <div class="flex justify-between">
              <button 
                @click="continueQuiz(quiz.id)"
                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors"
              >
                Lanjutkan
              </button>
              <button 
                @click="resetQuiz(quiz.id)"
                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors"
              >
                Ulangi
              </button>
            </div>
          </div>
        </div>
        
        <div v-else class="text-center py-8">
          <div class="inline-block p-4 bg-gray-800 rounded-full mb-4">
            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
          </div>
          <p class="text-gray-400">Belum ada kuis yang sedang berlangsung. Pilih kuis di atas untuk memulai!</p>
        </div>
      </div>

      <!-- Completed quizzes section -->
      <div class="mt-10">
        <h2 class="text-xl md:text-2xl font-bold text-white mb-4 md:mb-6">Kuis yang Telah Selesai</h2>
        
        <div v-if="completedQuizzes.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
          <div 
            v-for="quiz in completedQuizzes" 
            :key="quiz.id"
            class="card-gradient rounded-xl p-4 md:p-6"
          >
            <div class="flex items-center justify-between mb-3">
              <div :class="quiz.tagClass" class="px-2 py-1 rounded-full">
                <span class="text-white text-xs font-medium">{{ quiz.category }}</span>
              </div>
              <span class="text-green-400 text-xs bg-green-500/20 px-2 py-1 rounded">Selesai</span>
            </div>
            
            <h3 class="text-lg font-semibold text-white mb-2">{{ quiz.title }}</h3>
            
            <div class="flex items-center mb-4">
              <svg class="w-5 h-5 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
              </svg>
              <span class="text-white font-medium">{{ quiz.score }}/100</span>
            </div>
            
            <div class="flex justify-between">
              <button 
                @click="reviewQuiz(quiz.id)"
                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-md text-xs font-medium transition-colors"
              >
                Lihat Hasil
              </button>
              <button 
                @click="retakeQuiz(quiz.id)"
                class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1.5 rounded-md text-xs font-medium transition-colors"
              >
                Ulangi
              </button>
            </div>
          </div>
        </div>
        
        <div v-else class="text-center py-8">
          <div class="inline-block p-4 bg-gray-800 rounded-full mb-4">
            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <p class="text-gray-400">Belum ada kuis yang selesai. Selesaikan kuis untuk melihat hasilnya di sini!</p>
        </div>
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
                <span class="text-xs">Kelas</span>
            </router-link>
            <router-link to="/kuis" class="flex flex-col items-center py-2 px-3 text-gray-400 group" exact-active-class="text-white">
                <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                <span class="text-xs">Kuiz</span>
                <div class="absolute top-0 w-1.5 h-1 bg-white rounded-full"></div>
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
import { ref, computed } from 'vue';

// Categories for filtering
const categories = ref(['Semua', 'Pemrograman', 'Algoritma', 'Database', 'Web Development', 'Struktur Data']);
const selectedCategory = ref('Semua');

// Quiz data
const quizzes = ref([
  {
    id: 1,
    title: "Dasar Pemrograman C++",
    category: "Pemrograman",
    questionCount: 15,
    duration: 20,
    difficulty: "Mudah",
    author: "Budi Setiawan",
    authorInitials: "BS",
    tagClass: "tag-gradient",
  },
  {
    id: 2,
    title: "Struktur Data: Linked List",
    category: "Struktur Data",
    questionCount: 10,
    duration: 15,
    difficulty: "Sedang",
    author: "Ani Rahayu",
    authorInitials: "AR",
    tagClass: "tag-gradient-4",
  },
  {
    id: 3,
    title: "Algoritma Sorting",
    category: "Algoritma",
    questionCount: 12,
    duration: 18,
    difficulty: "Sedang",
    author: "Citra Dewi",
    authorInitials: "CD",
    tagClass: "tag-gradient-3",
  },
  {
    id: 4,
    title: "SQL Dasar",
    category: "Database",
    questionCount: 14,
    duration: 20,
    difficulty: "Mudah",
    author: "Dedi Pratama",
    authorInitials: "DP",
    tagClass: "tag-gradient-6",
  },
  {
    id: 5,
    title: "JavaScript Modern",
    category: "Web Development",
    questionCount: 20,
    duration: 30,
    difficulty: "Sulit",
    author: "Eka Surya",
    authorInitials: "ES",
    tagClass: "tag-gradient-2",
  },
  {
    id: 6,
    title: "Object-Oriented Programming",
    category: "Pemrograman",
    questionCount: 18,
    duration: 25,
    difficulty: "Sedang",
    author: "Fajar Nugraha",
    authorInitials: "FN",
    tagClass: "tag-gradient-5",
  },
]);

// Active quizzes (in progress)
const activeQuizzes = ref([
  {
    id: 3,
    title: "Algoritma Sorting",
    category: "Algoritma",
    questionCount: 12,
    progress: 5,
    tagClass: "tag-gradient-3",
  }
]);

// Completed quizzes
const completedQuizzes = ref([
  {
    id: 1,
    title: "Dasar Pemrograman C++",
    category: "Pemrograman",
    questionCount: 15,
    score: 85,
    tagClass: "tag-gradient",
  },
  {
    id: 4,
    title: "SQL Dasar",
    category: "Database",
    questionCount: 14,
    score: 92,
    tagClass: "tag-gradient-6",
  }
]);

// Filter quizzes by category
const filteredQuizzes = computed(() => {
  if (selectedCategory.value === 'Semua') {
    return quizzes.value;
  }
  return quizzes.value.filter(quiz => quiz.category === selectedCategory.value);
});

// Filter function
const filterByCategory = (category) => {
  selectedCategory.value = category;
};

// Quiz actions
const startQuiz = (id) => {
  const quiz = quizzes.value.find(q => q.id === id);
  if (quiz) {
    // Check if already active
    if (!activeQuizzes.value.some(q => q.id === id)) {
      activeQuizzes.value.push({
        ...quiz,
        progress: 0
      });
    }
    alert(`Memulai kuis: ${quiz.title}`);
  }
};

const continueQuiz = (id) => {
  const quiz = activeQuizzes.value.find(q => q.id === id);
  if (quiz) {
    alert(`Melanjutkan kuis: ${quiz.title}`);
  }
};

const resetQuiz = (id) => {
  const index = activeQuizzes.value.findIndex(q => q.id === id);
  if (index !== -1) {
    activeQuizzes.value.splice(index, 1);
  }
};

const reviewQuiz = (id) => {
  const quiz = completedQuizzes.value.find(q => q.id === id);
  if (quiz) {
    alert(`Melihat hasil kuis: ${quiz.title}`);
  }
};

const retakeQuiz = (id) => {
  const quiz = quizzes.value.find(q => q.id === id);
  if (quiz) {
    // Remove from completed if exists
    const completedIndex = completedQuizzes.value.findIndex(q => q.id === id);
    if (completedIndex !== -1) {
      completedQuizzes.value.splice(completedIndex, 1);
    }
    
    // Add to active
    if (!activeQuizzes.value.some(q => q.id === id)) {
      activeQuizzes.value.push({
        ...quiz,
        progress: 0
      });
    }
    alert(`Mengulang kuis: ${quiz.title}`);
  }
};
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