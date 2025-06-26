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
        
        <div class="admin-profile">
          <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Admin" class="avatar">
          <div>
            <p class="admin-name">Admin User</p>
            <p class="admin-role">Super Admin</p>
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
          
          <router-link to="/questions" class="nav-item" :class="{ active: activeTab === 'questions' }" @click="activeTab = 'questions'">
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
          <p class="section-subtitle">Selamat datang kembali, Admin User. Berikut ringkasan aktivitas kursus.</p>
          
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
                <h3>1,245</h3>
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
                <h3>24</h3>
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
                <h3>358</h3>
                <p>Soal Tersedia</p>
              </div>
            </div>
            
            <div class="stat-card">
              <div class="stat-icon activity">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                </svg>
              </div>
              <div class="stat-info">
                <h3>1,024</h3>
                <p>Aktivitas Hari Ini</p>
              </div>
            </div>
          </div>
          
          <!-- Recent Activity -->
          <div class="recent-activity">
            <div class="section-header">
              <h3>Aktivitas Terbaru</h3>
              <button class="view-all">Lihat Semua</button>
            </div>
            
            <div class="activity-list">
              <div class="activity-item">
                <div class="activity-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                  </svg>
                </div>
                <div class="activity-details">
                  <p><strong>Budi Santoso</strong> menyelesaikan materi "HTML Dasar"</p>
                  <span>10 menit yang lalu</span>
                </div>
              </div>
              
              <div class="activity-item">
                <div class="activity-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                  </svg>
                </div>
                <div class="activity-details">
                  <p><strong>Admin</strong> menambahkan user baru "Siti Rahayu"</p>
                  <span>25 menit yang lalu</span>
                </div>
              </div>
              
              <div class="activity-item">
                <div class="activity-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                  </svg>
                </div>
                <div class="activity-details">
                  <p><strong>Admin</strong> mengupdate materi "CSS Lanjutan"</p>
                  <span>1 jam yang lalu</span>
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
                  <span :class="['role-badge', user.role]">{{ user.role }}</span>
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
                    <span>{{ material.questions }} Soal</span>
                  </div>
                  <div class="stat">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                      <circle cx="9" cy="7" r="4"></circle>
                      <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                      <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span>{{ material.students }} Peserta</span>
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
                  <span>Kesulitan: 
                    <span :class="['difficulty', question.difficulty]">{{ question.difficulty }}</span>
                  </span>
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
export default {
  name: 'AdminDashboard',
  data() {
    return {
      activeTab: 'dashboard',
      users: [
        {
          id: 1,
          name: 'Budi Santoso',
          email: 'budi@example.com',
          role: 'student',
          status: 'active',
          avatar: 'https://randomuser.me/api/portraits/men/41.jpg'
        },
        {
          id: 2,
          name: 'Siti Rahayu',
          email: 'siti@example.com',
          role: 'student',
          status: 'active',
          avatar: 'https://randomuser.me/api/portraits/women/32.jpg'
        },
        {
          id: 3,
          name: 'Ahmad Fauzi',
          email: 'ahmad@example.com',
          role: 'instructor',
          status: 'active',
          avatar: 'https://randomuser.me/api/portraits/men/22.jpg'
        },
        {
          id: 4,
          name: 'Dewi Anggraeni',
          email: 'dewi@example.com',
          role: 'admin',
          status: 'active',
          avatar: 'https://randomuser.me/api/portraits/women/68.jpg'
        },
        {
          id: 5,
          name: 'Rudi Hartono',
          email: 'rudi@example.com',
          role: 'student',
          status: 'inactive',
          avatar: 'https://randomuser.me/api/portraits/men/64.jpg'
        }
      ],
      materials: [
        {
          id: 1,
          title: 'HTML Dasar',
          description: 'Belajar dasar-dasar HTML untuk pemula',
          questions: 25,
          students: 120,
          status: 'published',
          lastUpdate: '2 hari lalu'
        },
        {
          id: 2,
          title: 'CSS Lanjutan',
          description: 'Menguasai teknik CSS modern dan layouting',
          questions: 32,
          students: 85,
          status: 'published',
          lastUpdate: '1 minggu lalu'
        },
        {
          id: 3,
          title: 'JavaScript Pemula',
          description: 'Pengenalan pemrograman JavaScript untuk pemula',
          questions: 45,
          students: 210,
          status: 'published',
          lastUpdate: '3 hari lalu'
        },
        {
          id: 4,
          title: 'React Fundamental',
          description: 'Membangun aplikasi web dengan React.js',
          questions: 38,
          students: 65,
          status: 'draft',
          lastUpdate: '5 hari lalu'
        }
      ],
      questions: [
        {
          id: 1,
          text: 'Manakah dari berikut ini yang BUKAN merupakan tag HTML5 semantik?',
          options: [
            '<header>',
            '<footer>',
            '<section>',
            '<div>',
            '<article>'
          ],
          answer: 'D',
          material: 'HTML Dasar',
          difficulty: 'mudah'
        },
        {
          id: 2,
          text: 'Properti CSS manakah yang digunakan untuk mengubah warna teks?',
          options: [
            'text-color',
            'font-color',
            'color',
            'text-style',
            'font-style'
          ],
          answer: 'C',
          material: 'CSS Lanjutan',
          difficulty: 'mudah'
        },
        {
          id: 3,
          text: 'Manakah dari berikut ini yang merupakan cara yang benar untuk mendeklarasikan variabel di JavaScript?',
          options: [
            'variable name;',
            'v name;',
            'var name;',
            'let name;',
            'const name;'
          ],
          answer: 'C, D, E',
          material: 'JavaScript Pemula',
          difficulty: 'sedang'
        }
      ]
    }
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

.admin-profile {
  display: flex;
  align-items: center;
  gap: 12px;
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

.stat-icon.activity {
  background: rgba(232, 67, 147, 0.1);
  color: #e84393;
}

.stat-info h3 {
  font-size: 24px;
  margin-bottom: 5px;
}

.stat-info p {
  color: #777;
  font-size: 14px;
}

/* Recent Activity */
.recent-activity {
  background: white;
  border-radius: 12px;
  padding: 25px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.view-all {
  background: transparent;
  border: none;
  color: #4a00e0;
  font-weight: 500;
  cursor: pointer;
}

.activity-list {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.activity-item {
  display: flex;
  padding: 15px 0;
  border-bottom: 1px solid #eee;
}

.activity-item:last-child {
  border-bottom: none;
}

.activity-icon {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: rgba(74, 0, 224, 0.1);
  color: #4a00e0;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 15px;
  flex-shrink: 0;
}

.activity-details p {
  margin-bottom: 5px;
  color: #333;
}

.activity-details span {
  font-size: 12px;
  color: #999;
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

.metadata {
  display: flex;
  flex-wrap: wrap;
  gap: 15px;
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
}
</style>