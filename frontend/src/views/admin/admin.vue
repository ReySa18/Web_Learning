<template>
  <div class="admin-dashboard">
    <!-- Top Navigation Bar -->
    <div class="top-nav">
      <div class="logo-container">
        <div class="logo">K</div>
        <h1>KursusAdmin</h1>
      </div>
      
      <div class="admin-info">
        <div class="notification">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
          </svg>
          <span class="notification-badge">3</span>
        </div>
        
        <div class="admin-profile-container" ref="profileContainer">
          <div class="admin-profile" @click="toggleDropdown">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Admin" class="avatar">
            <div>
                <p class="admin-name">{{ adminProfile?.name || 'Admin User' }}</p>
                <p class="admin-role">{{ adminProfile?.role ? getRoleName(adminProfile.role) : 'Super Admin' }}</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dropdown-icon">
              <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
          </div>
          <div v-if="showDropdown" class="dropdown-menu">
            <button @click="logout">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                <polyline points="16 17 21 12 16 7"></polyline>
                <line x1="21" y1="12" x2="9" y2="12"></line>
              </svg>
              Logout
            </button>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
      <!-- Sidebar Navigation -->
      <div class="sidebar">
        <nav class="admin-nav">
          <router-link to="/admin" class="nav-item" :class="{ active: activeTab === 'dashboard' }" @click="activeTab = 'dashboard'">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
              <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            <span>Dashboard</span>
          </router-link>
          
          <router-link to="/usermanagement" class="nav-item" :class="{ active: activeTab === 'users' }" @click="activeTab = 'users'">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
              <circle cx="9" cy="7" r="4"></circle>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            <span>Manajemen User</span>
          </router-link>
          
          <router-link to="/materi" class="nav-item" :class="{ active: activeTab === 'materials' }" @click="activeTab = 'materials'">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
              <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
            </svg>
            <span>Manajemen Materi</span>
          </router-link>
          
          <router-link to="/managementsoal" class="nav-item" :class="{ active: activeTab === 'questions' }" @click="activeTab = 'questions'">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"></circle>
              <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
              <line x1="12" y1="17" x2="12.01" y2="17"></line>
            </svg>
            <span>Manajemen Soal</span>
          </router-link>
        </nav>
      </div>
      
      <!-- Content Area -->
      <div class="content">
        <!-- Dashboard View -->
        <div v-if="activeTab === 'dashboard'" class="dashboard-view">
          <h2 class="section-title">Dashboard Admin</h2>
          <p class="section-subtitle">Selamat datang kembali, Admin. Berikut ringkasan aktivitas kursus.</p>
          
          <!-- Stats Cards -->
          <div class="stats-grid">
            <div class="stat-card">
              <div class="stat-icon users">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                  <circle cx="9" cy="7" r="4"></circle>
                  <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                  <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
              </div>
              <div class="stat-info">
                <h3>{{ totalUsers }}</h3>
                <p>Total Pengguna</p>
              </div>
            </div>
            
            <div class="stat-card">
              <div class="stat-icon courses">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                  <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                </svg>
              </div>
              <div class="stat-info">
                <h3>{{ totalMaterials }}</h3>
                <p>Materi Kursus</p>
              </div>
            </div>
            
            <div class="stat-card">
              <div class="stat-icon questions">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"></circle>
                  <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                  <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
              </div>
              <div class="stat-info">
                <h3>{{ totalQuestions }}</h3>
                <p>Soal Tersedia</p>
              </div>
            </div>
          </div>
          
          <!-- Preview Sections - DIUBAH MENJADI SUSUN KE BAWAH -->
          <div class="preview-grid">
            <!-- User Preview -->
            <div class="preview-section">
              <div class="section-header">
                <h3>Pengguna Terbaru</h3>
                <router-link to="/usermanagement" class="view-all">Lihat Semua</router-link>
              </div>
              <div class="preview-list">
                <div v-for="user in recentUsers" :key="user.id" class="preview-item">
                  <div class="user-info">
                    <img :src="user.avatar" :alt="user.name" class="avatar">
                    <div>
                      <p class="user-name">{{ user.name }}</p>
                      <p class="user-email">{{ user.email }}</p>
                    </div>
                  </div>
                  <span :class="['role-badge', user.role]">{{ getRoleName(user.role) }}</span>
                </div>
              </div>
            </div>
            
            <!-- Material Preview -->
            <div class="preview-section">
              <div class="section-header">
                <h3>Materi Terbaru</h3>
                <router-link to="/materi" class="view-all">Lihat Semua</router-link>
              </div>
              <div class="preview-list">
                <div v-for="material in recentMaterials" :key="material.id" class="preview-item">
                  <div class="material-info">
                    <h4>{{ material.title }}</h4>
                    <p>{{ material.description }}</p>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Question Preview -->
            <div class="preview-section">
              <div class="section-header">
                <h3>Soal Terbaru</h3>
                <router-link to="/managementsoal" class="view-all">Lihat Semua</router-link>
              </div>
              <div class="preview-list">
                <div v-for="question in recentQuestions" :key="question.id" class="preview-item">
                  <div class="question-info">
                    <p><strong>Soal #{{ question.id }}</strong>: {{ question.text }}</p>
                    <div class="metadata">
                      <span>Topik: {{ question.material }}</span>
                      <span>Kategori: {{ question.kategori }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- User Management View -->
        <div v-if="activeTab === 'users'" class="user-management">
          <div class="section-header">
            <h2 class="section-title">Manajemen User</h2>
            <button class="primary-btn">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
              </svg>
              Tambah User
            </button>
          </div>
          
          <div class="users-table">
            <div class="table-header">
              <div class="table-row">
                <div class="table-cell">Nama</div>
                <div class="table-cell">Email</div>
                <div class="table-cell">Peran</div>
                <div class="table-cell">Status</div>
                <div class="table-cell">Aksi</div>
              </div>
            </div>
            
            <div class="table-body">
              <div v-for="user in users" :key="user.id" class="table-row">
                <div class="table-cell">
                  <div class="user-info">
                    <img :src="user.avatar" :alt="user.name" class="avatar">
                    <span>{{ user.name }}</span>
                  </div>
                </div>
                <div class="table-cell">{{ user.email }}</div>
                <div class="table-cell">
                  <span :class="['role-badge', user.role]">{{ getRoleName(user.role) }}</span>
                </div>
                <div class="table-cell">
                  <span :class="['status-badge', user.status]">{{ user.status }}</span>
                </div>
                <div class="table-cell actions">
                  <button class="icon-btn edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                      <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                  </button>
                  <button class="icon-btn delete">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="3 6 5 6 21 6"></polyline>
                      <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Material Management View -->
        <div v-if="activeTab === 'materials'" class="material-management">
          <div class="section-header">
            <h2 class="section-title">Manajemen Materi</h2>
            <button class="primary-btn">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
              </svg>
              Tambah Materi
            </button>
          </div>
          
          <div class="materials-grid">
            <div v-for="material in materials" :key="material.id" class="material-card">
              <div class="material-header">
                <div class="material-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                  </svg>
                </div>
                <div class="material-actions">
                  <button class="icon-btn edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                      <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                  </button>
                  <button class="icon-btn delete">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="3 6 5 6 21 6"></polyline>
                      <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    </svg>
                  </button>
                </div>
              </div>
              <div class="material-body">
                <h3>{{ material.title }}</h3>
                <p>{{ material.description }}</p>
                <div class="material-stats">
                  <div class="stat">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <circle cx="12" cy="12" r="10"></circle>
                      <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                      <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                  </div>
                  <div class="stat">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                      <circle cx="9" cy="7" r="4"></circle>
                      <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                      <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                  </div>
                </div>
              </div>
              <div class="material-footer">
                <span :class="['status-badge', material.status]">{{ material.status }}</span>
                <span class="date">{{ material.lastUpdate }}</span>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Question Management View -->
        <div v-if="activeTab === 'questions'" class="question-management">
          <div class="section-header">
            <h2 class="section-title">Manajemen Soal</h2>
            <div class="actions">
              <select class="filter-select">
                <option>Semua Materi</option>
                <option>HTML Dasar</option>
                <option>CSS Lanjutan</option>
                <option>JavaScript Pemula</option>
              </select>
              <button class="primary-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="12" y1="5" x2="12" y2="19"></line>
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Tambah Soal
              </button>
            </div>
          </div>
          
          <div class="questions-container">
            <div v-for="question in questions" :key="question.id" class="question-card">
              <div class="question-header">
                <h3>Soal #{{ question.id }}</h3>
                <div class="question-actions">
                  <button class="icon-btn edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                      <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                  </button>
                  <button class="icon-btn delete">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="3 6 5 6 21 6"></polyline>
                      <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    </svg>
                  </button>
                </div>
              </div>
              
              <div class="question-body">
                <p>{{ question.text }}</p>
                
                <div class="options">
                  <div v-for="(option, index) in question.options" :key="index" class="option">
                    <div class="option-letter">{{ String.fromCharCode(65 + index) }}</div>
                    <div class="option-text">{{ option }}</div>
                  </div>
                </div>
              </div>
              
              <div class="question-footer">
                <div class="metadata">
                  <span>Materi: {{ question.material }}</span>
                  <span>Jawaban: {{ question.answer }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { useToast } from 'vue-toastification';

export default {
  name: 'AdminDashboard',
  data() {
    return {
      activeTab: 'dashboard',
      showDropdown: false,
      users: [],
      materials: [],
      questions: [],
      adminProfile: null // Tambah state untuk profil admin
    }
  },
  computed: {
    totalUsers() {
      return this.users.length;
    },
    totalMaterials() {
      return this.materials.length;
    },
    totalQuestions() {
      return this.questions.length;
    },
    recentUsers() {
      return this.users.slice(0, 3);
    },
    recentMaterials() {
      return this.materials.slice(0, 3);
    },
    recentQuestions() {
      return this.questions.slice(0, 3);
    }
  },
  methods: {
    getRoleName(role) {
      const roles = {
        'student': 'Siswa',
        'admin': 'Admin'
      };
      return roles[role] || role;
    },
    toggleDropdown() {
      this.showDropdown = !this.showDropdown;
    },
    logout() {
      localStorage.removeItem('auth_token');
      this.$router.push('/');
    },
    handleClickOutside(event) {
      if (this.showDropdown && !this.$refs.profileContainer.contains(event.target)) {
        this.showDropdown = false;
      }
    },
    formatDate(dateString) {
      if (!dateString) return '-';
      const options = { year: 'numeric', month: 'long', day: 'numeric' };
      return new Date(dateString).toLocaleDateString('id-ID', options);
    },
    async fetchAdminProfile() {
      try {
        const token = localStorage.getItem('auth_token');
        const response = await axios.get('http://localhost:8000/api/user', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        this.adminProfile = response.data;
      } catch (error) {
        console.error('Gagal memuat profil admin:', error);
        useToast().error('Gagal memuat profil admin');
      }
    },
    async fetchUsers() {
      const toast = useToast();
      try {
        const token = localStorage.getItem('auth_token');
        const response = await axios.get('http://localhost:8000/api/users', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });

        this.users = response.data.map(user => ({
          ...user,
          status: 'active',
          avatar: user.avatar || this.getRandomAvatar(),
          joinDate: this.formatDate(user.created_at),
          lastLogin: '-'
        }));
      } catch (error) {
        console.error('Gagal memuat user:', error);
        toast.error('Gagal memuat data pengguna dari server.');
      }
    },
    async fetchMaterials() {
      const toast = useToast();
      try {
        const token = localStorage.getItem('auth_token');
        const response = await axios.get('http://localhost:8000/api/materi', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });

        this.materials = response.data.map(item => ({
          id: item.id,
          title: item.judul,
          description: item.deskripsi || 'Tidak ada deskripsi',
          status: item.status || 'published',
          lastUpdate: this.formatDate(item.updated_at),
          created_at: item.created_at
        }));
      } catch (error) {
        console.error('Gagal memuat materi:', error);
        toast.error('Gagal memuat materi dari server');
      }
    },
    async fetchSoals() {
      const toast = useToast();
      try {
        const token = localStorage.getItem('auth_token');
        const response = await axios.get('http://localhost:8000/api/soal', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });

        this.questions = response.data.map(item => ({
          id: item.id,
          text: item.pertanyaan,
          material: item.topik?.nama || 'Tidak ada topik',
          kategori: item.kategori?.nama,
          options: [
            item.opsi_a,
            item.opsi_b,
            item.opsi_c,
            item.opsi_d
          ],
          answer: item.jawaban_benar,
          created_at: item.created_at
        }));
      } catch (error) {
        console.error('Gagal memuat soal:', error);
        toast.error('Gagal memuat soal dari server');
      }
    },
    getRandomAvatar() {
      const randomId = Math.floor(Math.random() * 100);
      return `https://randomuser.me/api/portraits/men/${randomId}.jpg`;
    }
  },
  async mounted() {
    // Panggil semua fungsi fetch
    await this.fetchAdminProfile();
    await this.fetchUsers();
    await this.fetchMaterials();
    await this.fetchSoals();
    
    document.addEventListener('click', this.handleClickOutside);
  },
  beforeUnmount() {
    document.removeEventListener('click', this.handleClickOutside);
  }
}
</script>

<style scoped>
/* Base Styles */
.admin-dashboard {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  background-color: #f5f7fa;
  font-family: 'Inter', sans-serif;
}

/* Top Navigation */
.top-nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 30px;
  background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%);
  color: white;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  z-index: 100;
}

.logo-container {
  display: flex;
  align-items: center;
  gap: 12px;
}

.logo {
  width: 40px;
  height: 40px;
  background: linear-gradient(135deg, #4a00e0, #8e2de2);
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  font-size: 20px;
}

.logo-container h1 {
  font-size: 18px;
  font-weight: 700;
}

.admin-info {
  display: flex;
  align-items: center;
  gap: 20px;
}

.notification {
  position: relative;
  cursor: pointer;
}

.notification-badge {
  position: absolute;
  top: -5px;
  right: -5px;
  background: #ff4757;
  color: white;
  font-size: 10px;
  width: 18px;
  height: 18px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* ADMIN PROFILE DROPDOWN STYLES */
.admin-profile-container {
  position: relative;
}

.admin-profile {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 5px 10px;
  border-radius: 8px;
  cursor: pointer;
  transition: background 0.3s;
}

.admin-profile:hover {
  background: rgba(255, 255, 255, 0.1);
}

.dropdown-icon {
  transition: transform 0.3s;
}

.admin-profile:hover .dropdown-icon {
  transform: rotate(180deg);
}

.avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  overflow: hidden;
}

.avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.admin-name {
  font-weight: 600;
  font-size: 14px;
  margin-bottom: 2px;
}

.admin-role {
  font-size: 12px;
  color: #aaa;
}

/* Dropdown menu */
.dropdown-menu {
  position: absolute;
  top: 100%;
  right: 0;
  background: white;
  min-width: 180px;
  border-radius: 8px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
  z-index: 1000;
  margin-top: 5px;
  overflow: hidden;
}

.dropdown-menu button {
  display: flex;
  align-items: center;
  gap: 10px;
  width: 100%;
  padding: 12px 15px;
  background: none;
  border: none;
  text-align: left;
  color: #333;
  font-size: 14px;
  cursor: pointer;
  transition: background 0.2s;
}

.dropdown-menu button:hover {
  background: #f5f7fa;
}

.dropdown-menu button svg {
  width: 16px;
  height: 16px;
}

/* Main Content */
.main-content {
  display: flex;
  flex: 1;
}

/* Sidebar */
.sidebar {
  width: 250px;
  background: #1a1a1a;
  color: white;
  padding: 20px 0;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  z-index: 90;
}

.admin-nav {
  display: flex;
  flex-direction: column;
  gap: 5px;
  padding: 0 15px;
}

.nav-item {
  display: flex;
  align-items: center;
  padding: 12px 15px;
  border-radius: 8px;
  color: #ddd;
  text-decoration: none;
  transition: all 0.3s ease;
  font-size: 14px;
  gap: 12px;
}

.nav-item:hover {
  background: rgba(255, 255, 255, 0.1);
  color: #fff;
}

.nav-item.active {
  background: linear-gradient(135deg, #4a00e0, #8e2de2);
  color: #fff;
  box-shadow: 0 4px 15px rgba(74, 0, 224, 0.3);
}

/* Content Area */
.content {
  flex: 1;
  padding: 30px;
  overflow-y: auto;
}

.section-title {
  font-size: 24px;
  font-weight: 700;
  color: #333;
  margin-bottom: 10px;
}

.section-subtitle {
  color: #666;
  margin-bottom: 30px;
}

/* Stats Grid */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;
  margin-bottom: 30px;
}

.stat-card {
  background: white;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
  display: flex;
  transition: all 0.3s ease;
}

.stat-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.stat-icon {
  width: 50px;
  height: 50px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 15px;
}

.stat-icon.users {
  background: rgba(74, 0, 224, 0.1);
  color: #4a00e0;
}

.stat-icon.courses {
  background: rgba(0, 184, 148, 0.1);
  color: #00b894;
}

.stat-icon.questions {
  background: rgba(9, 132, 227, 0.1);
  color: #0984e3;
}

.stat-info h3 {
  font-size: 24px;
  margin-bottom: 5px;
}

.stat-info p {
  color: #777;
  font-size: 14px;
}

/* Preview Grid Styles - DIUBAH MENJADI SUSUN KE BAWAH */
.preview-grid {
  display: flex;
  flex-direction: column;
  gap: 25px;
  margin-top: 30px;
}

.preview-section {
  background: white;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.preview-list {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.preview-item {
  padding: 15px;
  border-radius: 8px;
  border: 1px solid #eee;
  transition: all 0.3s ease;
}

.preview-item:hover {
  border-color: #8e2de2;
  box-shadow: 0 4px 10px rgba(142, 45, 226, 0.1);
}

.user-info {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 10px;
}

.user-info .avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
}

.user-name {
  font-weight: 600;
  margin-bottom: 3px;
}

.user-email {
  font-size: 13px;
  color: #666;
}

.material-info h4 {
  font-size: 16px;
  margin-bottom: 8px;
}

.material-info p {
  font-size: 14px;
  color: #666;
  margin-bottom: 10px;
  display: -webkit-box;
  line-clamp: 2;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.material-stats {
  display: flex;
  gap: 15px;
  font-size: 13px;
  color: #666;
}

.question-info p {
  margin-bottom: 10px;
  line-height: 1.5;
  display: -webkit-box;
  line-clamp: 3;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.metadata {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  font-size: 13px;
  color: #666;
}

.difficulty {
  padding: 3px 8px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 500;
}

.difficulty.mudah {
  background: rgba(46, 204, 113, 0.1);
  color: #2ecc71;
}

.difficulty.sedang {
  background: rgba(241, 196, 15, 0.1);
  color: #f1c40f;
}

.difficulty.sulit {
  background: rgba(231, 76, 60, 0.1);
  color: #e74c3c;
}

.role-badge {
  padding: 5px 10px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 500;
}

.role-badge.student {
  background: rgba(9, 132, 227, 0.1);
  color: #0984e3;
}

.role-badge.instructor {
  background: rgba(0, 184, 148, 0.1);
  color: #00b894;
}

.role-badge.admin {
  background: rgba(232, 67, 147, 0.1);
  color: #e84393;
}

.status-badge {
  padding: 5px 10px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 500;
}

.status-badge.active {
  background: rgba(46, 204, 113, 0.1);
  color: #2ecc71;
}

.status-badge.inactive {
  background: rgba(255, 71, 87, 0.1);
  color: #ff4757;
}

.status-badge.published {
  background: rgba(46, 204, 113, 0.1);
  color: #2ecc71;
}

.status-badge.draft {
  background: rgba(241, 196, 15, 0.1);
  color: #f1c40f;
}

/* Buttons */
.primary-btn {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px 20px;
  background: linear-gradient(135deg, #4a00e0, #8e2de2);
  color: white;
  border: none;
  border-radius: 8px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
}

.primary-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(142, 45, 226, 0.3);
}

.view-all {
  background: transparent;
  border: none;
  color: #4a00e0;
  font-weight: 500;
  cursor: pointer;
  text-decoration: none;
  font-size: 14px;
}

/* User Management */
.users-table {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.table-header {
  background: #f8f9fa;
  font-weight: 600;
  color: #495057;
}

.table-row {
  display: grid;
  grid-template-columns: 2fr 2fr 1fr 1fr 1fr;
  padding: 15px 20px;
  border-bottom: 1px solid #eee;
}

.table-body .table-row:hover {
  background: #f8f9fa;
}

.table-cell {
  display: flex;
  align-items: center;
}

.user-info {
  display: flex;
  align-items: center;
  gap: 10px;
}

.user-info .avatar {
  width: 36px;
  height: 36px;
}

.actions {
  display: flex;
  gap: 10px;
}

.icon-btn {
  width: 32px;
  height: 32px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: transparent;
  border: none;
  cursor: pointer;
  transition: all 0.3s ease;
}

.icon-btn.edit {
  color: #3498db;
}

.icon-btn.edit:hover {
  background: rgba(52, 152, 219, 0.1);
}

.icon-btn.delete {
  color: #e74c3c;
}

.icon-btn.delete:hover {
  background: rgba(231, 76, 60, 0.1);
}

/* Material Management */
.materials-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 25px;
}

.material-card {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
}

.material-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.material-header {
  display: flex;
  justify-content: space-between;
  padding: 20px;
  background: linear-gradient(135deg, #4a00e0, #8e2de2);
  color: white;
}

.material-icon {
  width: 50px;
  height: 50px;
  border-radius: 12px;
  background: rgba(255, 255, 255, 0.2);
  display: flex;
  align-items: center;
  justify-content: center;
}

.material-actions {
  display: flex;
  gap: 10px;
}

.material-body {
  padding: 20px;
}

.material-body h3 {
  font-size: 18px;
  margin-bottom: 10px;
}

.material-body p {
  color: #666;
  font-size: 14px;
  margin-bottom: 20px;
}

.material-stats {
  display: flex;
  justify-content: space-between;
}

.stat {
  display: flex;
  align-items: center;
  font-size: 14px;
  color: #666;
  gap: 8px;
}

.material-footer {
  display: flex;
  justify-content: space-between;
  padding: 15px 20px;
  background: #f8f9fa;
  border-top: 1px solid #eee;
}

.material-footer .date {
  font-size: 12px;
  color: #999;
}

/* Question Management */
.actions {
  display: flex;
  gap: 15px;
}

.filter-select {
  padding: 10px 15px;
  border: 1px solid #e0e0e0;
  border-radius: 8px;
  font-size: 14px;
  background: white;
}

.questions-container {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
  gap: 25px;
}

.question-card {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.question-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  background: #f8f9fa;
  border-bottom: 1px solid #eee;
}

.question-header h3 {
  font-size: 16px;
  font-weight: 600;
}

.question-body {
  padding: 20px;
}

.question-body p {
  font-weight: 500;
  margin-bottom: 20px;
  line-height: 1.6;
}

.options {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.option {
  display: flex;
  gap: 10px;
}

.option-letter {
  width: 28px;
  height: 28px;
  border-radius: 50%;
  background: #f8f9fa;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 500;
  flex-shrink: 0;
}

.question-footer {
  padding: 15px 20px;
  background: #f8f9fa;
  border-top: 1px solid #eee;
}

/* Responsive Styles */
@media (max-width: 992px) {
  .sidebar {
    width: 70px;
  }
  
  .nav-item span {
    display: none;
  }
  
  .nav-item {
    justify-content: center;
  }
  
  .materials-grid, .questions-container {
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  }
}

@media (max-width: 768px) {
  .main-content {
    flex-direction: column;
  }
  
  .sidebar {
    width: 100%;
    padding: 10px 0;
  }
  
  .admin-nav {
    flex-direction: row;
    overflow-x: auto;
    padding: 0 10px;
  }
  
  .nav-item {
    padding: 10px 15px;
    white-space: nowrap;
  }
  
  .content {
    padding: 20px;
  }
  
  .top-nav {
    padding: 15px;
  }
  
  .logo-container h1 {
    font-size: 16px;
  }
  
  .admin-name, .admin-role {
    display: none;
  }
  
  .table-row {
    grid-template-columns: 1fr 1fr;
    grid-template-areas: 
      "user user"
      "email email"
      "role status"
      "actions actions";
    gap: 10px;
  }
  
  .table-cell:nth-child(1) {
    grid-area: user;
  }
  
  .table-cell:nth-child(2) {
    grid-area: email;
  }
  
  .table-cell:nth-child(3) {
    grid-area: role;
  }
  
  .table-cell:nth-child(4) {
    grid-area: status;
  }
  
  .table-cell:nth-child(5) {
    grid-area: actions;
    justify-content: center;
  }
}

@media (max-width: 576px) {
  .stats-grid {
    grid-template-columns: 1fr;
  }
  
  .materials-grid, .questions-container {
    grid-template-columns: 1fr;
  }
  
  .section-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 15px;
  }
  
  .actions {
    width: 100%;
    flex-direction: column;
  }
  
  .filter-select, .primary-btn {
    width: 100%;
  }
  
  .table-row {
    grid-template-columns: 1fr;
    grid-template-areas: 
      "user"
      "email"
      "role"
      "status"
      "actions";
  }
  
  /* Adjust dropdown for mobile */
  .admin-profile {
    padding: 5px;
  }
  
  .admin-name, .admin-role {
    display: none;
  }
  
  .dropdown-menu {
    min-width: 140px;
  }
}
</style>