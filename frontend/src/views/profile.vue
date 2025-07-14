<template>
  <div class="gradient-bg">
    <!-- Toast Notification -->
    <div v-if="toast.show" class="fixed top-4 right-4 z-[100]">
      <div class="glass-effect rounded-lg p-4 shadow-lg border border-gray-700 flex items-center animate-slide-in">
        <svg v-if="toast.type === 'success'" class="w-5 h-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <svg v-else class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-white">{{ toast.message }}</span>
      </div>
    </div>
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
              <router-link to="/kuis" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Latihan Soal</router-link>
              <router-link to="/aboutme" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">About Dev</router-link>
              <router-link to="/profile" class="nav-active text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Profile</router-link>
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
        <h1 class="text-2xl md:text-3xl font-bold text-white mb-2 md:mb-3">Profil Pengguna</h1>
        <p class="text-gray-300 text-sm md:text-base">Kelola informasi akun dan lihat riwayat pembelajaranmu</p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-8">
        <!-- Profile Card -->
        <div class="card-gradient rounded-xl p-5 md:p-6">
          <div class="flex items-center mb-6">
            <div class="w-16 h-16 md:w-20 md:h-20 bg-gray-600 rounded-full flex items-center justify-center mr-4">
              <span v-if="!userData?.avatar" class="text-white text-2xl font-bold">
                {{ userInitials }}
              </span>
              <img 
                v-else
                :src="userData?.avatar" 
                class="w-full h-full rounded-full object-cover"
                alt="User Avatar"
              >
            </div>
            <div>
              <h2 class="text-xl md:text-2xl font-bold text-white">{{ userData?.name }}</h2>
              <p class="text-gray-300 text-sm md:text-base">{{ userData?.email }}</p>
              <p class="text-gray-400 text-xs mt-1">Bergabung sejak {{ formattedJoinDate }}</p>
            </div>
          </div>

          <!-- Tab Navigation -->
          <div class="flex border-b border-gray-700 mb-6">
            <button 
              @click="activeTab = 'profile'"
              :class="[
                'pb-3 px-4 font-medium text-sm md:text-base transition-colors',
                activeTab === 'profile' 
                  ? 'text-blue-400 border-b-2 border-blue-400' 
                  : 'text-gray-400 hover:text-gray-300'
              ]"
            >
              Profil
            </button>
            <button 
              @click="activeTab = 'security'"
              :class="[
                'pb-3 px-4 font-medium text-sm md:text-base transition-colors',
                activeTab === 'security' 
                  ? 'text-blue-400 border-b-2 border-blue-400' 
                  : 'text-gray-400 hover:text-gray-300'
              ]"
            >
              Keamanan
            </button>
          </div>

          <!-- Profile Form -->
          <div v-if="activeTab === 'profile'">
            <form @submit.prevent="updateProfile">
              <div class="mb-4">
                <label class="block text-gray-300 text-sm font-medium mb-2">Nama Lengkap</label>
                <input 
                  type="text" 
                  v-model="profileForm.name"
                  class="glass-effect w-full px-4 py-2.5 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Masukkan nama lengkap"
                >
              </div>
              <div class="mb-4">
                <label class="block text-gray-300 text-sm font-medium mb-2">Email</label>
                <input 
                  type="email" 
                  v-model="profileForm.email"
                  class="glass-effect w-full px-4 py-2.5 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Masukkan email"
                >
              </div>
              <div class="flex justify-end mt-6">
                <button 
                  type="submit"
                  :disabled="isUpdatingProfile"
                  class="glass-effect px-6 py-2.5 rounded-lg font-medium text-white hover:bg-white hover:text-black transition-colors duration-300 flex items-center"
                >
                  <span v-if="isUpdatingProfile">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Menyimpan...
                  </span>
                  <span v-else>Simpan Perubahan</span>
                </button>
              </div>
            </form>
          </div>

          <!-- Security Form -->
          <div v-if="activeTab === 'security'">
            <form @submit.prevent="updatePassword">
              <div class="mb-4">
                <label class="block text-gray-300 text-sm font-medium mb-2">Password Saat Ini</label>
                <div class="relative">
                  <input 
                    :type="showCurrentPassword ? 'text' : 'password'"
                    v-model="passwordForm.currentPassword"
                    class="glass-effect w-full px-4 py-2.5 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Masukkan password saat ini"
                  >
                  <button 
                    type="button"
                    @click="showCurrentPassword = !showCurrentPassword"
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"
                  >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path v-if="showCurrentPassword" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path v-if="showCurrentPassword" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                      <path v-if="!showCurrentPassword" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                  </button>
                </div>
              </div>
              <div class="mb-4">
                <label class="block text-gray-300 text-sm font-medium mb-2">Password Baru</label>
                <div class="relative">
                  <input 
                    :type="showNewPassword ? 'text' : 'password'"
                    v-model="passwordForm.newPassword"
                    class="glass-effect w-full px-4 py-2.5 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Masukkan password baru"
                  >
                  <button 
                    type="button"
                    @click="showNewPassword = !showNewPassword"
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"
                  >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path v-if="showNewPassword" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path v-if="showNewPassword" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                      <path v-if="!showNewPassword" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                  </button>
                </div>
              </div>
              <div class="mb-4">
                <label class="block text-gray-300 text-sm font-medium mb-2">Konfirmasi Password Baru</label>
                <div class="relative">
                  <input 
                    :type="showConfirmPassword ? 'text' : 'password'"
                    v-model="passwordForm.confirmPassword"
                    class="glass-effect w-full px-4 py-2.5 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Konfirmasi password baru"
                  >
                  <button 
                    type="button"
                    @click="showConfirmPassword = !showConfirmPassword"
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"
                  >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path v-if="showConfirmPassword" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path v-if="showConfirmPassword" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                      <path v-if="!showConfirmPassword" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                  </button>
                </div>
              </div>
              <div class="flex justify-end mt-6">
                <button 
                  type="submit"
                  :disabled="isUpdatingPassword"
                  class="glass-effect px-6 py-2.5 rounded-lg font-medium text-white hover:bg-white hover:text-black transition-colors duration-300 flex items-center"
                >
                  <span v-if="isUpdatingPassword">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Mengupdate...
                  </span>
                  <span v-else>Perbarui Password</span>
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- History Card -->
        <div class="card-gradient rounded-xl p-5 md:p-6">
          <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl md:text-2xl font-bold text-white">Riwayat Hasil Latihan</h2>
            <div class="relative">
              <select v-model="historyFilter" class="glass-effect text-white px-4 py-2 rounded-lg appearance-none pr-8 text-sm md:text-base">
                <option value="all">Semua</option>
                <option value="last_month">1 Bulan Terakhir</option>
                <option value="last_3months">3 Bulan Terakhir</option>
              </select>
              <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </div>
            </div>
          </div>

          <div v-if="loadingHistory" class="flex justify-center py-8">
            <div class="loader"></div>
          </div>

          <div v-else-if="historyData.length === 0" class="text-center py-8">
            <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-300 mb-2">Belum ada riwayat latihan</h3>
            <p class="text-gray-500 max-w-md mx-auto">
              Mulailah mengerjakan latihan untuk melihat riwayat nilai di sini.
            </p>
          </div>

          <div v-else class="space-y-4 max-h-[500px] overflow-y-auto pr-2">
            <div 
              v-for="(item, index) in filteredHistory" 
              :key="index"
              class="glass-effect rounded-lg p-4 transition-all duration-300 hover:bg-gray-700/30"
            >
              <div class="flex justify-between items-start">
                <div>
                  <h3 class="text-base md:text-lg font-semibold text-white mb-1">{{ item.quiz_title }}</h3>
                  <p class="text-gray-400 text-xs md:text-sm mb-2">Diselesaikan pada {{ formatDate(item.completed_at) }}</p>
                  <div class="flex items-center">
                    <div class="mr-4">
                      <span class="text-gray-300 text-xs">Nilai</span>
                      <div class="text-lg font-bold" :class="getScoreClass(item.score)">
                        {{ item.score }}%
                      </div>
                    </div>
                    <div>
                      <span class="text-gray-300 text-xs">Pertanyaan</span>
                      <div class="text-white text-sm">{{ item.total_questions }} soal</div>
                    </div>
                  </div>
                </div>
                <div class="flex-shrink-0">
                  <div class="w-12 h-12 rounded-full flex items-center justify-center" :class="getScoreBgClass(item.score)">
                    <span class="text-white font-bold text-sm">{{ item.score }}%</span>
                  </div>
                </div>
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
                <span class="text-xs">Kuiz</span>
            </router-link>
            <router-link to="/aboutme" class="flex flex-col items-center py-2 px-3 text-gray-400 group" exact-active-class="text-white">
                <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-xs">About Dev</span>
            </router-link>
            <router-link to="/aboutme" class="flex flex-col items-center py-2 px-3 text-white relative group" exact-active-class="text-white">
                <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                <span class="text-xs">Profile</span>
                <div class="absolute top-0 w-1.5 h-1 bg-white rounded-full"></div>
            </router-link>
        </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import api from '@/api'
import { useRouter } from 'vue-router'

const router = useRouter()
const activeTab = ref('profile')
const historyFilter = ref('all')
const showCurrentPassword = ref(false)
const showNewPassword = ref(false)
const showConfirmPassword = ref(false)
const isUpdatingProfile = ref(false)
const isUpdatingPassword = ref(false)
const loadingHistory = ref(true)
const showDropdown = ref(false)

const toast = ref({
  show: false,
  message: '',
  type: 'success' // 'success' or 'error'
})

// Show toast notification
const showToast = (message, type = 'success') => {
  toast.value = {
    show: true,
    message,
    type
  }
  
  // Auto hide after 3 seconds
  setTimeout(() => {
    toast.value.show = false
  }, 3000)
}

// Data user
const userData = ref({
  name: '',
  email: '',
  avatar: '',
  created_at: ''
})

// Form data
const profileForm = ref({
  name: '',
  email: ''
})

const passwordForm = ref({
  currentPassword: '',
  newPassword: '',
  confirmPassword: ''
})

// History data
const historyData = ref([])

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

// Format tanggal bergabung
const formattedJoinDate = computed(() => {
  if (!userData.value.created_at) return ''
  const date = new Date(userData.value.created_at)
  return date.toLocaleDateString('id-ID', {
    year: 'numeric',
    month: 'long'
  })
})

// Filter history berdasarkan pilihan
const filteredHistory = computed(() => {
  const now = new Date()
  const threeMonthsAgo = new Date()
  threeMonthsAgo.setMonth(now.getMonth() - 3)
  
  const oneMonthAgo = new Date()
  oneMonthAgo.setMonth(now.getMonth() - 1)
  
  return historyData.value.filter(item => {
    const completedDate = new Date(item.completed_at)
    
    if (historyFilter.value === 'last_month') {
      return completedDate >= oneMonthAgo
    } else if (historyFilter.value === 'last_3months') {
      return completedDate >= threeMonthsAgo
    }
    return true
  })
})

// Format tanggal
const formatDate = (dateString) => {
  const date = new Date(dateString)
  return date.toLocaleDateString('id-ID', {
    day: 'numeric',
    month: 'long',
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  })
}

// Format durasi
const formatDuration = (seconds) => {
  const minutes = Math.floor(seconds / 60)
  const remainingSeconds = seconds % 60
  return `${minutes} menit ${remainingSeconds} detik`
}

// Kelas untuk skor
const getScoreClass = (score) => {
  if (score >= 85) return 'text-green-400'
  if (score >= 70) return 'text-blue-400'
  if (score >= 60) return 'text-yellow-400'
  return 'text-red-400'
}

const getScoreBgClass = (score) => {
  if (score >= 85) return 'bg-green-500/30'
  if (score >= 70) return 'bg-blue-500/30'
  if (score >= 60) return 'bg-yellow-500/30'
  return 'bg-red-500/30'
}

// Toggle dropdown
const toggleDropdown = () => {
  showDropdown.value = !showDropdown.value
}

// Ambil data user dari API
const fetchUser = async () => {
  try {
    const response = await api.get('/user')
    userData.value = response.data
    profileForm.value = {
      name: response.data.name,
      email: response.data.email
    }
  } catch (error) {
    console.error('Gagal mengambil data user:', error)
  }
}

// Ambil history dari API
const fetchHistory = async () => {
  try {
    loadingHistory.value = true
    const response = await api.get('/hasil-latihan')

    // Map data supaya formatnya cocok
    historyData.value = response.data.map(item => ({
      id: item.id,
      quiz_title: `${item.topik?.nama || 'Topik'} - ${item.kategori?.nama || 'Kategori'}`,
      score: item.skor,
      completed_at: item.created_at,
      total_questions: item.jumlah_benar + item.jumlah_salah
    }))
  } catch (error) {
    console.error('Gagal mengambil data history:', error)
  } finally {
    loadingHistory.value = false
  }
}


// Update profil
const updateProfile = async () => {
  try {
    isUpdatingProfile.value = true
    await api.put('/user', profileForm.value)
    
    // Update data user
    userData.value.name = profileForm.value.name
    userData.value.email = profileForm.value.email
    
    showToast('Profil berhasil diperbarui!', 'success')
  } catch (error) {
    console.error('Gagal memperbarui profil:', error)
    showToast('Terjadi kesalahan saat memperbarui profil', 'error')
  } finally {
    isUpdatingProfile.value = false
  }
}

// Update password
const updatePassword = async () => {
  try {
    if (passwordForm.value.newPassword !== passwordForm.value.confirmPassword) {
      showToast('Password baru dan konfirmasi password tidak cocok', 'error')
      return
    }
    
    isUpdatingPassword.value = true
    await api.put('/user/password', {
      current_password: passwordForm.value.currentPassword,
      new_password: passwordForm.value.newPassword
    })
    
    showToast('Password berhasil diperbarui!', 'success')
    passwordForm.value = {
      currentPassword: '',
      newPassword: '',
      confirmPassword: ''
    }
  } catch (error) {
    console.error('Gagal memperbarui password:', error)
    if (error.response && error.response.data.message) {
      showToast(error.response.data.message, 'error')
    } else {
      showToast('Terjadi kesalahan saat memperbarui password', 'error')
    }
  } finally {
    isUpdatingPassword.value = false
  }
}


// Fungsi logout
const logout = () => {
  // Hapus token dari localStorage
  localStorage.removeItem('auth_token')
  // Redirect ke halaman login
  router.push({ name: 'landingPage' })
}

onMounted(() => {
  fetchUser()
  fetchHistory()
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

/* Input styling */
input.glass-effect {
  background: rgba(30, 30, 30, 0.5);
  transition: all 0.3s ease;
}

input.glass-effect:focus {
  outline: none;
  box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
}

/* Toast animation */
@keyframes slide-in {
  from {
    transform: translateX(100%);
    opacity: 0;
  }
  to {
    transform: translateX(0);
    opacity: 1;
  }
}

.animate-slide-in {
  animation: slide-in 0.3s ease-out forwards;
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
