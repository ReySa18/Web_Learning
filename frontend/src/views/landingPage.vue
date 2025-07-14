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

    <!-- Navigation bar -->
    <nav class="glass-effect border-b border-gray-700 sticky top-0 z-50 navbar-height">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
        <div class="flex justify-between items-center h-full">
          <router-link to="/" class="flex items-center">
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
              <a href="#" @click.prevent="showLoginNotification" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Home</a>
              <a href="#" @click.prevent="showLoginNotification" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Materi</a>
              <a href="#" @click.prevent="showLoginNotification" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Latihan Soal</a>
              <a href="#" @click.prevent="showLoginNotification" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">About Dev</a>
            </div>
          </div>

          <!-- Login button -->
          <div class="flex items-center">
            <button @click="redirectToLogin" class="glass-effect text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-white hover:text-black transition-colors">
              Login
            </button>
          </div>
        </div>
      </div>
    </nav>

    <!-- Hero section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-24 md:pt-24 md:pb-32">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div>
          <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight">
            Belajar Coding <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">Lebih Mudah</span> 
            &amp; Menyenangkan
          </h1>
          <p class="text-gray-300 text-lg mb-8 max-w-lg">
            Platform belajar coding interaktif dengan materi terstruktur, latihan soal untuk membangun portfolio impianmu.
          </p>
          <div class="flex flex-wrap gap-4">
            <button @click="showLoginNotification" class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-3 rounded-lg font-medium hover:from-blue-600 hover:to-purple-700 transition-all transform hover:-translate-y-0.5 shadow-lg">
              Mulai Belajar Sekarang
            </button>
            <button @click="showLoginNotification" class="glass-effect text-white px-6 py-3 rounded-lg font-medium hover:bg-white hover:text-black transition-all transform hover:-translate-y-0.5">
              Lihat Kelas
            </button>
          </div>
        </div>
        <div class="relative">
          <div class="relative z-10">
            <div class="card-gradient rounded-2xl p-6 shadow-2xl transform rotate-3">
              <div class="bg-gray-800 rounded-lg overflow-hidden">
                <div class="p-4 border-b border-gray-700 flex items-center">
                  <div class="flex space-x-2">
                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                    <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                  </div>
                  <div class="text-gray-400 text-sm ml-4">index.py</div>
                </div>
                <div class="p-6 font-mono text-sm">
                  <div class="text-purple-400">def</div>
                  <div class="text-yellow-300 ml-4">main</div>
                  <div class="text-white">():</div>
                  <div class="text-blue-400 ml-4">print</div>
                  <div class="text-green-400">("Hello, World!")</div>
                  <br>
                  <div class="text-purple-400">if</div>
                  <div class="text-white"> __name__ == </div>
                  <div class="text-green-400">"__main__"</div>
                  <div class="text-white">:</div>
                  <div class="text-yellow-300 ml-4">main</div>
                  <div class="text-white">()</div>
                </div>
              </div>
            </div>
          </div>
          <div class="absolute -bottom-6 -right-6 w-full h-full bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl transform rotate-3 opacity-20 blur-xl"></div>
        </div>
      </div>
    </section>

    <!-- Features section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
      <div class="text-center mb-16">
        <span class="inline-block bg-gradient-to-r from-blue-500 to-purple-600 text-white px-4 py-1 rounded-full text-sm font-medium mb-4">
          FITUR UNGGULAN
        </span>
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Apa yang Kamu Dapatkan</h2>
        <p class="text-gray-400 max-w-2xl mx-auto">Platform belajar coding terbaik dengan fitur-fitur lengkap untuk membantu perjalanan belajarmu</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="card-gradient rounded-2xl p-6 hover:shadow-xl transition-all">
          <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center mb-6">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
          </div>
          <h3 class="text-xl font-bold text-white mb-3">Materi Terstruktur</h3>
          <p class="text-gray-300 mb-4">Belajar dengan kurikulum yang dirancang khusus untuk pemula hingga mahir dengan langkah-langkah jelas.</p>
          <button @click="showLoginNotification" class="text-blue-400 hover:text-blue-300 font-medium flex items-center">
            Pelajari lebih lanjut
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </button>
        </div>

        <div class="card-gradient rounded-2xl p-6 hover:shadow-xl transition-all">
          <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center mb-6">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-bold text-white mb-3">Latihan Interaktif</h3>
          <p class="text-gray-300 mb-4">Praktik langsung dengan challenge coding dan sistem penilaian otomatis untuk menguji pemahamanmu.</p>
          <button @click="showLoginNotification" class="text-blue-400 hover:text-blue-300 font-medium flex items-center">
            Pelajari lebih lanjut
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </button>
        </div>

        <div class="card-gradient rounded-2xl p-6 hover:shadow-xl transition-all">
          <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center mb-6">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-bold text-white mb-3">Tampilan Histori</h3>
          <p class="text-gray-300 mb-4">Dengan adanya hisori latihan, kamu dapat tracking seberapa jauh kamu sudh level up.</p>
          <button @click="showLoginNotification" class="text-blue-400 hover:text-blue-300 font-medium flex items-center">
            Pelajari lebih lanjut
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </button>
        </div>
      </div>
    </section>

    <!-- Popular courses section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
      <div class="text-center mb-16">
        <span class="inline-block bg-gradient-to-r from-blue-500 to-purple-600 text-white px-4 py-1 rounded-full text-sm font-medium mb-4">
          KELAS POPULER
        </span>
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Mulai Perjalanan Coding-mu</h2>
        <p class="text-gray-400 max-w-2xl mx-auto">Pilih dari berbagai kelas terbaik yang dirancang untuk membantumu menjadi developer profesional</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="card-gradient rounded-2xl overflow-hidden hover:shadow-xl transition-all">
          <div class="h-48 bg-gradient-to-r from-blue-600 to-indigo-700 relative">
            <div class="absolute top-4 right-4 bg-yellow-500 text-black px-3 py-1 rounded-full text-xs font-bold">
              POPULER
            </div>
          </div>
          <div class="p-6">
            <div class="flex justify-between items-start mb-4">
              <div>
                <div class="bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-medium inline-block mb-2">
                  Python
                </div>
                <h3 class="text-xl font-bold text-white">Python untuk Pemula</h3>
              </div>
              <div class="flex items-center">
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                <span class="text-white ml-1">4.9</span>
              </div>
            </div>
            <p class="text-gray-300 mb-6">Pelajari dasar-dasar Python dengan proyek nyata untuk membangun pondasi yang kuat.</p>
            <div class="flex justify-between items-center">
              <div class="flex items-center">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-gray-400 text-sm ml-2">8 Minggu</span>
              </div>
              <button @click="showLoginNotification" class="text-blue-400 hover:text-blue-300 font-medium">
                Lihat Kelas
              </button>
            </div>
          </div>
        </div>

        <div class="card-gradient rounded-2xl overflow-hidden hover:shadow-xl transition-all">
          <div class="h-48 bg-gradient-to-r from-green-600 to-teal-700"></div>
          <div class="p-6">
            <div class="flex justify-between items-start mb-4">
              <div>
                <div class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-medium inline-block mb-2">
                  Web Dev
                </div>
                <h3 class="text-xl font-bold text-white">Pengenalan Bahasa C</h3>
              </div>
              <div class="flex items-center">
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                <span class="text-white ml-1">4.8</span>
              </div>
            </div>
            <p class="text-gray-300 mb-6">Kuasai bahasa C yang menjadi awal dari semua bahasa.</p>
            <div class="flex justify-between items-center">
              <div class="flex items-center">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-gray-400 text-sm ml-2">12 Minggu</span>
              </div>
              <button @click="showLoginNotification" class="text-blue-400 hover:text-blue-300 font-medium">
                Lihat Kelas
              </button>
            </div>
          </div>
        </div>

        <div class="card-gradient rounded-2xl overflow-hidden hover:shadow-xl transition-all">
          <div class="h-48 bg-gradient-to-r from-purple-600 to-pink-700"></div>
          <div class="p-6">
            <div class="flex justify-between items-start mb-4">
              <div>
                <div class="bg-purple-500 text-white px-3 py-1 rounded-full text-xs font-medium inline-block mb-2">
                  Mobile
                </div>
                <h3 class="text-xl font-bold text-white">C++ untuk Pemula</h3>
              </div>
              <div class="flex items-center">
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                <span class="text-white ml-1">4.7</span>
              </div>
            </div>
            <p class="text-gray-300 mb-6">Pelajari OOP dari Bahasa C menjadi Bahasa C++</p>
            <div class="flex justify-between items-center">
              <div class="flex items-center">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-gray-400 text-sm ml-2">10 Minggu</span>
              </div>
              <button @click="showLoginNotification" class="text-blue-400 hover:text-blue-300 font-medium">
                Lihat Kelas
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="text-center mt-12">
        <button @click="showLoginNotification" class="glass-effect text-white px-6 py-3 rounded-lg font-medium hover:bg-white hover:text-black transition-all duration-300 transform hover:-translate-y-0.5">
          Lihat Semua Kelas
        </button>
      </div>
    </section>

    <!-- CTA section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
      <div class="glass-effect rounded-3xl p-8 md:p-12 text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">Siap Memulai Perjalanan Coding-mu?</h2>
        <p class="text-gray-300 max-w-2xl mx-auto mb-8">Bergabunglah dengan ribuan siswa lainnya yang telah berhasil menjadi developer profesional melalui platform kami.</p>
        <div class="flex flex-wrap justify-center gap-4">
          <button @click="redirectToLogin" class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-8 py-3 rounded-lg font-medium hover:from-blue-600 hover:to-purple-700 transition-all transform hover:-translate-y-0.5 shadow-lg">
            Login Sekarang
          </button>
          <button @click="redirectToRegister" class="glass-effect text-white px-8 py-3 rounded-lg font-medium hover:bg-white hover:text-black transition-all transform hover:-translate-y-0.5">
            Daftar Akun Baru
          </button>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-8 border-t border-gray-800">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
          <div class="flex items-center mb-6">
            <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center mr-2">
              <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
              </svg>
            </div>
            <span class="text-white text-xl font-bold">Asteria Code</span>
          </div>
          <p class="text-gray-400 mb-6">Platform belajar coding terbaik untuk semua kalangan.</p>
          <div class="flex space-x-4">
            <a href="#" class="text-gray-400 hover:text-white">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path>
              </svg>
            </a>
            <a href="#" class="text-gray-400 hover:text-white">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
              </svg>
            </a>
            <a href="#" class="text-gray-400 hover:text-white">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"></path>
              </svg>
            </a>
          </div>
        </div>

        <div>
          <h3 class="text-white text-lg font-semibold mb-4">Produk</h3>
          <ul class="space-y-3">
            <li><a href="#" @click.prevent="showLoginNotification" class="text-gray-400 hover:text-white">Kelas</a></li>
            <li><a href="#" @click.prevent="showLoginNotification" class="text-gray-400 hover:text-white">Latihan Soal</a></li>
            <li><a href="#" @click.prevent="showLoginNotification" class="text-gray-400 hover:text-white">Komunitas</a></li>
            <li><a href="#" @click.prevent="showLoginNotification" class="text-gray-400 hover:text-white">Blog</a></li>
          </ul>
        </div>

        <div>
          <h3 class="text-white text-lg font-semibold mb-4">Perusahaan</h3>
          <ul class="space-y-3">
            <li><a href="#" @click.prevent="showLoginNotification" class="text-gray-400 hover:text-white">Tentang Kami</a></li>
            <li><a href="#" @click.prevent="showLoginNotification" class="text-gray-400 hover:text-white">Karir</a></li>
            <li><a href="#" @click.prevent="showLoginNotification" class="text-gray-400 hover:text-white">Kontak</a></li>
            <li><a href="#" @click.prevent="showLoginNotification" class="text-gray-400 hover:text-white">Partner</a></li>
          </ul>
        </div>

        <div>
          <h3 class="text-white text-lg font-semibold mb-4">Dukungan</h3>
          <ul class="space-y-3">
            <li><a href="#" @click.prevent="showLoginNotification" class="text-gray-400 hover:text-white">Bantuan</a></li>
            <li><a href="#" @click.prevent="showLoginNotification" class="text-gray-400 hover:text-white">FAQ</a></li>
            <li><a href="#" @click.prevent="showLoginNotification" class="text-gray-400 hover:text-white">Syarat & Ketentuan</a></li>
            <li><a href="#" @click.prevent="showLoginNotification" class="text-gray-400 hover:text-white">Kebijakan Privasi</a></li>
          </ul>
        </div>
      </div>

      <div class="mt-12 pt-8 border-t border-gray-800 text-center">
        <p class="text-gray-500 text-sm">© 2023 Asteria Code. Hak cipta dilindungi.</p>
      </div>
    </footer>

    <!-- Mobile navigation -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 glass-effect border-t border-gray-700 z-40 mobile-nav-height">
      <div class="flex justify-around items-center h-full py-1.5">
        <a href="#" @click.prevent="showLoginNotification" class="flex flex-col items-center py-2 px-3 text-white relative group">
          <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
          </svg>
          <span class="text-xs">Home</span>
          <div class="absolute top-0 w-1.5 h-1 bg-white rounded-full"></div>
        </a>
        <a href="#" @click.prevent="showLoginNotification" class="flex flex-col items-center py-2 px-3 text-gray-400 group">
          <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
          </svg>
          <span class="text-xs">Materi</span>
        </a>
        <a href="#" @click.prevent="showLoginNotification" class="flex flex-col items-center py-2 px-3 text-gray-400 group">
          <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
          </svg>
          <span class="text-xs">Latihan Soal</span>
        </a>
        <a href="#" @click.prevent="showLoginNotification" class="flex flex-col items-center py-2 px-3 text-gray-400 group">
          <svg class="w-5 h-5 mb-0.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span class="text-xs">About Dev</span>
        </a>
      </div>
    </div>

    <!-- Login notification modal -->
    <div v-if="showNotification" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
      <div class="glass-effect rounded-xl p-6 max-w-sm w-full transform transition-all duration-300 scale-95 animate-scale-in">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-bold text-white">Akses Diperlukan</h3>
          <button @click="showNotification = false" class="text-gray-400 hover:text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
        <p class="text-gray-300 mb-6">Silakan login atau daftar akun untuk mengakses fitur ini.</p>
        <div class="flex flex-col space-y-3">
          <button @click="redirectToLogin" class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-4 py-3 rounded-lg font-medium hover:from-blue-600 hover:to-purple-700 transition-all">
            Login ke Akun Saya
          </button>
          <button @click="redirectToRegister" class="glass-effect text-white px-4 py-3 rounded-lg font-medium hover:bg-white hover:text-black transition-all">
            Daftar Akun Baru
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const showNotification = ref(false);

// Show login notification
const showLoginNotification = () => {
  showNotification.value = true;
};

// Redirect to login page
const redirectToLogin = () => {
  router.push('/login');
  showNotification.value = false;
};

// Redirect to register page (if available)
const redirectToRegister = () => {
  router.push('/register'); // Ganti dengan route register jika ada
  showNotification.value = false;
};
</script>

<style scoped>
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

.nav-active {
  background: rgba(255, 255, 255, 0.2);
  border-bottom: 2px solid white;
}

@keyframes pulse-dot {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.5; }
}

/* Animation for modal */
@keyframes scale-in {
  0% {
    transform: scale(0.95);
    opacity: 0;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}

.animate-scale-in {
  animation: scale-in 0.3s ease-out forwards;
}

/* Responsive adjustments */
@media (max-width: 640px) {
  .gradient-bg {
    padding-bottom: 56px; /* Space for bottom nav */
  }
  
  .card-gradient {
    padding: 16px;
  }
  
  .floating-animation {
    animation-duration: 8s; /* Slower on mobile */
  }
}
</style>
