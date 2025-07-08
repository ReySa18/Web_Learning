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
          <router-link to="/admin" class="nav-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
              <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            <span>Dashboard</span>
          </router-link>
          
          <router-link to="/usermanagement" class="nav-item active">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
              <circle cx="9" cy="7" r="4"></circle>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            <span>Manajemen User</span>
          </router-link>
          
          <router-link to="/materi" class="nav-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
              <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
            </svg>
            <span>Manajemen Materi</span>
          </router-link>
          
          <router-link to="/managementsoal" class="nav-item">
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
        <!-- User Management Header -->
        <div class="section-header">
        <div>
          <h2 class="section-title">Manajemen User</h2>
          <p class="section-subtitle">Kelola pengguna sistem kursus Anda</p>
        </div>
        <div class="actions">
          <div class="search-container">
            <input type="text" v-model="searchQuery" placeholder="Cari pengguna...">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8"></circle>
              <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
          </div>
          <button class="primary-btn" @click="openAddUserModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="12" y1="5" x2="12" y2="19"></line>
              <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Tambah User
          </button>
        </div>
      </div>
        
        <!-- Filters and Stats -->
        <div class="filters-stats">
          <div class="filter-controls">
            <div class="filter-group">
              <label>Peran:</label>
              <select v-model="roleFilter">
                <option value="all">Semua Peran</option>
                <option value="admin">Admin</option>
                <option value="siswa">Siswa</option>
              </select>
            </div>
            
            <div class="filter-group">
              <label>Status:</label>
              <select v-model="statusFilter">
                <option value="all">Semua Status</option>
                <option value="active">Aktif</option>
                <option value="inactive">Nonaktif</option>
              </select>
            </div>
            
            <div class="filter-group">
              <label>Urutkan:</label>
              <select v-model="sortBy">
                <option value="name">Nama (A-Z)</option>
                <option value="name_desc">Nama (Z-A)</option>
                <option value="recent">Terbaru</option>
                <option value="oldest">Terlama</option>
              </select>
            </div>
          </div>
          
          <div class="user-stats">
            <div class="stat-item">
              <span class="stat-value">{{ filteredUsers.length }}</span>
              <span class="stat-label">Total Pengguna</span>
            </div>
            <div class="stat-item">
              <span class="stat-value">{{ activeUserCount }}</span>
              <span class="stat-label">Pengguna Aktif</span>
            </div>
            <div class="stat-item">
              <span class="stat-value">{{ SiswaCount }}</span>
              <span class="stat-label">Siswa</span>
            </div>
          </div>
        </div>
        
        <!-- Users Table -->
        <div class="users-table">
          <div class="table-header">
            <div class="table-row">
              <div class="table-cell">Nama Pengguna</div>
              <div class="table-cell">Email</div>
              <div class="table-cell">Peran</div>
              <div class="table-cell">Status</div>
              <div class="table-cell">Tanggal Bergabung</div>
              <div class="table-cell">Aksi</div>
            </div>
          </div>
          
          <div class="table-body">
            <div v-for="user in filteredUsers" :key="user.id" class="table-row">
              <div class="table-cell">
                <div class="user-info">
                  <img :src="user.avatar" :alt="user.name" class="avatar">
                  <div>
                    <div class="user-name">{{ user.name }}</div>
                    <div class="user-id">ID: {{ user.id }}</div>
                  </div>
                </div>
              </div>
              <div class="table-cell">
                <div class="user-email">{{ user.email }}</div>
                <div class="user-phone" v-if="user.phone">{{ user.phone }}</div>
              </div>
              <div class="table-cell">
                <select v-model="user.role" @change="updateUserRole(user)" class="role-select">
                  <option value="admin">Admin</option>
                  <option value="siswa">Siswa</option>
                </select>
              </div>
              <div class="table-cell">
                <div class="status-container">
                  <label class="switch">
                    <input type="checkbox" v-model="user.status" true-value="active" false-value="inactive" @change="toggleUserStatus(user)">
                    <span class="slider"></span>
                  </label>
                  <span :class="['status-badge', user.status]">{{ user.status === 'active' ? 'Aktif' : 'Nonaktif' }}</span>
                </div>
              </div>
              <div class="table-cell">
                <div class="join-date">{{ user.joinDate }}</div>
                <div class="last-login" v-if="user.lastLogin">Terakhir login: {{ user.lastLogin }}</div>
              </div>
              <div class="table-cell actions">
                <button class="icon-btn edit" @click="openEditUserModal(user)">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                  </svg>
                </button>
                <button class="icon-btn delete" @click="confirmDeleteUser(user)">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                  </svg>
                </button>

              </div>
            </div>
          </div>
        </div>
        
        <!-- Pagination -->
        <div class="pagination">
          <button class="pagination-btn" :disabled="currentPage === 1" @click="currentPage--">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
          </button>
          
          <button v-for="page in totalPages" :key="page" 
                  class="pagination-btn" 
                  :class="{ active: currentPage === page }"
                  @click="currentPage = page">
            {{ page }}
          </button>
          
          <button class="pagination-btn" :disabled="currentPage === totalPages" @click="currentPage++">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
          </button>
        </div>
      </div>
    </div>
    
    <!-- Add User Modal -->
    <div v-if="showAddUserModal" class="modal-overlay">
      <div class="modal">
        <div class="modal-header">
          <h3>Tambah Pengguna Baru</h3>
          <button class="close-btn" @click="closeAddUserModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
          </button>
        </div>
        
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" v-model="newUser.name" placeholder="Masukkan nama lengkap">
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label>Email</label>
              <input type="email" v-model="newUser.email" placeholder="Masukkan email">
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label>Peran</label>
              <select v-model="newUser.role">
                <option value="siswa">Siswa</option>
                <option value="admin">Admin</option>
              </select>
            </div>
            
            <div class="form-group">
              <label>Status</label>
              <select v-model="newUser.status">
                <option value="active">Aktif</option>
                <option value="inactive">Nonaktif</option>
              </select>
            </div>
          </div>
          
          <div class="form-group">
            <label>Password</label>
            <div class="password-input">
              <input :type="showPassword ? 'text' : 'password'" v-model="newUser.password" placeholder="Buat password">
              <button class="toggle-password" @click.prevent="showPassword = !showPassword">
                <svg v-if="showPassword" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                  <line x1="1" y1="1" x2="23" y2="23"></line>
                </svg>
                <svg v-else xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                  <circle cx="12" cy="12" r="3"></circle>
                </svg>
              </button>
            </div>
          </div>
        </div>
        
        <div class="modal-footer">
          <button class="btn-cancel" @click="closeAddUserModal">Batal</button>
          <button class="btn-save" @click="addNewUser">Simpan</button>
        </div>
      </div>
    </div>
    
    <!-- Edit User Modal -->
    <div v-if="showEditUserModal" class="modal-overlay">
      <div class="modal">
        <div class="modal-header">
          <h3>Edit Pengguna</h3>
          <button class="close-btn" @click="closeEditUserModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
          </button>
        </div>
        
        <div class="modal-body">
          <div class="user-header">
            <img :src="editingUser.avatar" :alt="editingUser.name" class="avatar">
            <div>
              <h4>{{ editingUser.name }}</h4>
              <p>ID: {{ editingUser.id }}</p>
            </div>
          </div>
          
          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" v-model="editingUser.name">
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label>Email</label>
              <input type="email" v-model="editingUser.email">
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label>Peran</label>
              <select v-model="editingUser.role">
                <option value="siswa">Siswa</option>
                <option value="admin">Admin</option>
              </select>
            </div>
            
            <div class="form-group">
              <label>Status</label>
              <select v-model="editingUser.status">
                <option value="active">Aktif</option>
                <option value="inactive">Nonaktif</option>
              </select>
            </div>
          </div>
          
          <div class="form-group">
            <label>Reset Password</label>
            <div class="password-input">
              <input :type="showEditPassword ? 'text' : 'password'" v-model="resetPassword" placeholder="Masukkan password baru">
              <button class="toggle-password" @click.prevent="showEditPassword = !showEditPassword">
                <svg v-if="showEditPassword" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                  <line x1="1" y1="1" x2="23" y2="23"></line>
                </svg>
                <svg v-else xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                  <circle cx="12" cy="12" r="3"></circle>
                </svg>
              </button>
            </div>
          </div>
        </div>
        
        <div class="modal-footer">
          <button class="btn-cancel" @click="closeEditUserModal">Batal</button>
          <button class="btn-save" @click="saveUserChanges">Simpan Perubahan</button>
        </div>
      </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div v-if="showDeleteConfirmation" class="modal-overlay">
      <div class="confirmation-modal">
        <div class="modal-header">
          <h3>Konfirmasi Penghapusan</h3>
        </div>
        
        <div class="modal-body">
          <p>Anda yakin ingin menghapus pengguna <strong>{{ userToDelete.name }}</strong>?</p>
          <p class="warning-text">Aksi ini tidak dapat dibatalkan dan semua data pengguna akan dihapus permanen.</p>
        </div>
        
        <div class="modal-footer">
          <button class="btn-cancel" @click="showDeleteConfirmation = false">Batal</button>
          <button class="btn-delete" @click="deleteUser">Hapus Pengguna</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { useToast } from 'vue-toastification';


export default {
  name: 'UserManagement',
  data() {
    return {
      adminProfile: null,
      showDropdown: false,
      searchQuery: '',
      roleFilter: 'all',
      statusFilter: 'all',
      sortBy: 'recent',
      currentPage: 1,
      itemsPerPage: 8,
      showAddUserModal: false,
      showEditUserModal: false,
      showDeleteConfirmation: false,
      showPassword: false,
      showEditPassword: false,
      resetPassword: '',
      newUser: {
        id: '',
        name: '',
        email: '',
        phone: '',
        role: 'siswa',
        status: 'active',
        password: '',
        joinDate: this.getCurrentDate(),
        lastLogin: '',
        avatar: ''
      },
      editingUser: {},
      userToDelete: {},
      users: [], // <-- Awalnya kosong, akan diisi dari API
    };
  },
  computed: {
    filteredUsers() {
      let filtered = this.users;

      if (this.searchQuery) {
        const query = this.searchQuery.toLowerCase();
        filtered = filtered.filter(user =>
          user.name.toLowerCase().includes(query) ||
          user.email.toLowerCase().includes(query) ||
          (user.phone && user.phone.includes(query))
        );
      }

      if (this.roleFilter !== 'all') {
        filtered = filtered.filter(user => user.role === this.roleFilter);
      }

      if (this.statusFilter !== 'all') {
        filtered = filtered.filter(user => user.status === this.statusFilter);
      }

      if (this.sortBy === 'name') {
        filtered.sort((a, b) => a.name.localeCompare(b.name));
      } else if (this.sortBy === 'name_desc') {
        filtered.sort((a, b) => b.name.localeCompare(a.name));
      } else if (this.sortBy === 'recent') {
        filtered.sort((a, b) => new Date(b.joinDate) - new Date(a.joinDate));
      } else if (this.sortBy === 'oldest') {
        filtered.sort((a, b) => new Date(a.joinDate) - new Date(b.joinDate));
      }

      return filtered;
    },
    activeUserCount() {
      return this.users.filter(user => user.status === 'active').length;
    },
    SiswaCount() {
      return this.users.filter(user => user.role === 'siswa').length;
    },
    totalPages() {
      return Math.ceil(this.filteredUsers.length / this.itemsPerPage);
    },
    paginatedUsers() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.filteredUsers.slice(start, end);
    }
  },
  methods: {
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
          status: 'active', // default value
          phone: user.phone || '',
          avatar: this.getRandomAvatar(),
          joinDate: this.formatDate(user.created_at), // Gunakan tanggal dari server
          lastLogin: '-' // Placeholder
        }));
      } catch (error) {
        console.error('Gagal memuat user:', error);
        toast.error('Gagal memuat data pengguna dari server.');
      }
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
    getCurrentDate() {
      const now = new Date();
      return now.toLocaleDateString('id-ID', {
        day: '2-digit',
        month: 'short',
        year: 'numeric'
      });
    },
    formatDate(dateString) {
      if (!dateString) return this.getCurrentDate();
      
      const date = new Date(dateString);
      return date.toLocaleDateString('id-ID', {
        day: '2-digit',
        month: 'short',
        year: 'numeric'
      });
    },
    getRandomAvatar() {
      const gender = Math.random() > 0.5 ? 'men' : 'women';
      const id = Math.floor(Math.random() * 99);
      return `https://randomuser.me/api/portraits/${gender}/${id}.jpg`;
    },
    openAddUserModal() {
      this.newUser = {
        id: '',
        name: '',
        email: '',
        phone: '',
        role: 'siswa',
        status: 'active',
        password: '',
        joinDate: this.getCurrentDate(),
        lastLogin: '',
        avatar: this.getRandomAvatar()
      };
      this.showAddUserModal = true;
    },
    closeAddUserModal() {
      this.showAddUserModal = false;
    },
    openEditUserModal(user) {
    this.editingUser = JSON.parse(JSON.stringify(user));
    this.showEditUserModal = true;
    },
    closeEditUserModal() {
      this.showEditUserModal = false;
      this.resetPassword = '';
    },
    confirmDeleteUser(user) {
      this.userToDelete = { ...user };
      this.showDeleteConfirmation = true;
    },
    // Di method addNewUser
    async addNewUser() {
      try {
        const token = localStorage.getItem('auth_token');
        const toast = useToast();
        
        // Gunakan endpoint yang benar sesuai route Laravel
        const response = await axios.post('http://localhost:8000/api/admin/users', {
          name: this.newUser.name,
          email: this.newUser.email,
          password: this.newUser.password,
          role: this.newUser.role,
        }, {
          headers: {
            Authorization: `Bearer ${token}`,
            'Content-Type': 'application/json'
          }
        });

        // Perbaiki cara menambahkan user baru ke state
        this.users.push({
          ...response.data.user,
          avatar: this.getRandomAvatar(),
          joinDate: this.getCurrentDate(),
          lastLogin: '-',
          status: 'active',
          phone: ''
        });
        
        this.showAddUserModal = false;
        toast.success('Pengguna berhasil ditambahkan');
      } catch (error) {
        console.error('Gagal tambah user:', error);
        
        if (error.response) {
          console.error('Detail error:', error.response.data);
          
          // Tampilkan pesan error spesifik dari server
          if (error.response.data.errors) {
            const errors = Object.values(error.response.data.errors).flat();
            toast.error(errors.join(', ') || 'Gagal menambahkan pengguna.');
          } else {
            toast.error(error.response.data.message || 'Gagal menambahkan pengguna.');
          }
        } else {
          toast.error('Terjadi kesalahan jaringan atau server.');
        }
      }
    },
    async saveUserChanges() {
      const toast = useToast();
      const token = localStorage.getItem('auth_token');

      const payload = {
        name: this.editingUser.name,
        email: this.editingUser.email,
        role: this.editingUser.role,
        ...(this.resetPassword ? { password: this.resetPassword } : {})
      };

      try {
        await axios.put(
          `http://localhost:8000/api/admin/users/${this.editingUser.id}`,
          payload,
          {
            headers: {
              Authorization: `Bearer ${token}`,
              'Content-Type': 'application/json'
            }
          }
        );

        // Update array lokal
        const index = this.users.findIndex(u => u.id === this.editingUser.id);
        if (index !== -1) {
          this.users[index] = {
            ...this.users[index], 
            ...this.editingUser, 
          };
        }

        this.showEditUserModal = false;
        this.resetPassword = '';
        toast.success('Perubahan pengguna berhasil disimpan');
      } catch (error) {
        console.error('Gagal menyimpan perubahan:', error);

        if (error.response?.data?.errors) {
          const errors = Object.values(error.response.data.errors).flat();
          toast.error(errors.join(', '));
        } else {
          toast.error(error.response?.data?.message || 'Terjadi kesalahan saat menyimpan perubahan');
        }
      }
    },

    async deleteUser() {
      const token = localStorage.getItem('auth_token');
      const toast = useToast();
      try {
        const response = await axios.delete(`http://localhost:8000/api/users/${this.userToDelete.id}`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });

        // Hapus dari daftar lokal
        this.users = this.users.filter(user => user.id !== this.userToDelete.id);

        this.showDeleteConfirmation = false;
        toast.success('Pengguna berhasil dihapus');
      } catch (error) {
        console.error('Gagal menghapus user:', error);
        toast.error('Gagal menghapus pengguna dari server.');
      }
    },
    updateUserRole(user) {
      toast.info(`Peran ${user.name} diubah menjadi ${user.role}`);
    },
    toggleUserStatus(user) {
      toast.info(`Status ${user.name} diubah menjadi ${user.status}`);
    },
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
      localStorage.removeItem('token');
      this.$router.push('/');
    },
    handleClickOutside(event) {
      if (this.showDropdown && !this.$refs.profileContainer.contains(event.target)) {
        this.showDropdown = false;
      }
    }
  },
  mounted() {
    this.fetchAdminProfile();
    this.fetchUsers();
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

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 25px;
  gap: 20px;
  flex-wrap: wrap;
}

.section-title {
  font-size: 24px;
  font-weight: 700;
  color: #333;
  margin-bottom: 5px;
}

.section-subtitle {
  color: #666;
  font-size: 14px;
}

.actions {
  display: flex;
  gap: 15px;
  flex-wrap: wrap;
}

.search-container {
  position: relative;
  display: flex;
  align-items: center;
}

.search-container input {
  padding: 10px 15px 10px 40px;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 14px;
  width: 250px;
  transition: all 0.3s ease;
}

.search-container input:focus {
  border-color: #8e2de2;
  outline: none;
  box-shadow: 0 0 0 3px rgba(142, 45, 226, 0.1);
}

.search-container svg {
  position: absolute;
  left: 15px;
  color: #777;
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
  font-size: 14px;
}

.primary-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(142, 45, 226, 0.3);
}

/* Filters and Stats */
.filters-stats {
  display: flex;
  justify-content: space-between;
  margin-bottom: 25px;
  flex-wrap: wrap;
  gap: 20px;
}

.filter-controls {
  display: flex;
  gap: 15px;
  flex-wrap: wrap;
}

.filter-group {
  display: flex;
  flex-direction: column;
}

.filter-group label {
  font-size: 13px;
  color: #666;
  margin-bottom: 5px;
}

.filter-group select {
  padding: 8px 12px;
  border: 1px solid #ddd;
  border-radius: 6px;
  background: white;
  font-size: 14px;
  min-width: 150px;
}

.user-stats {
  display: flex;
  gap: 20px;
  background: white;
  padding: 15px 25px;
  border-radius: 10px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.stat-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 0 10px;
}

.stat-item:not(:last-child) {
  border-right: 1px solid #eee;
}

.stat-value {
  font-size: 24px;
  font-weight: 700;
  color: #4a00e0;
}

.stat-label {
  font-size: 13px;
  color: #777;
}

/* Users Table */
.users-table {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
  margin-bottom: 25px;
}

.table-header {
  background: #f8f9fa;
  font-weight: 600;
  color: #495057;
}

.table-row {
  display: grid;
  grid-template-columns: 2fr 1.5fr 1fr 1fr 1.5fr auto;
  padding: 15px 20px;
  border-bottom: 1px solid #eee;
}

.table-body .table-row:hover {
  background: #fafbff;
}

.table-cell {
  display: flex;
  align-items: center;
  font-size: 14px;
}

.user-info {
  display: flex;
  align-items: center;
  gap: 12px;
}

.user-info .avatar {
  width: 40px;
  height: 40px;
}

.user-name {
  font-weight: 500;
}

.user-id {
  font-size: 12px;
  color: #777;
}

.user-email {
  font-weight: 500;
}

.user-phone {
  font-size: 12px;
  color: #777;
  margin-top: 3px;
}

.role-select {
  padding: 6px 10px;
  border: 1px solid #ddd;
  border-radius: 6px;
  background: white;
  font-size: 14px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.role-select:hover {
  border-color: #8e2de2;
}

.status-container {
  display: flex;
  align-items: center;
  gap: 10px;
}

.switch {
  position: relative;
  display: inline-block;
  width: 40px;
  height: 22px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  transition: .4s;
  border-radius: 34px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}

input:checked + .slider {
  background-color: #2ecc71;
}

input:checked + .slider:before {
  transform: translateX(18px);
}

.status-badge {
  padding: 4px 10px;
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

.join-date {
  font-weight: 500;
}

.last-login {
  font-size: 12px;
  color: #777;
  margin-top: 3px;
}

.actions {
  display: flex;
  gap: 8px;
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

.icon-btn.view {
  color: #9b59b6;
}

.icon-btn.view:hover {
  background: rgba(155, 89, 182, 0.1);
}

/* Pagination */
.pagination {
  display: flex;
  justify-content: center;
  gap: 8px;
  margin-top: 20px;
}

.pagination-btn {
  width: 36px;
  height: 36px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: white;
  border: 1px solid #ddd;
  cursor: pointer;
  transition: all 0.3s ease;
  font-size: 14px;
}

.pagination-btn:hover {
  border-color: #8e2de2;
  color: #8e2de2;
}

.pagination-btn.active {
  background: linear-gradient(135deg, #4a00e0, #8e2de2);
  color: white;
  border-color: #8e2de2;
}

.pagination-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

/* Modal */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
}

.modal {
  background: white;
  border-radius: 12px;
  width: 500px;
  max-width: 90%;
  max-height: 90vh;
  overflow-y: auto;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.confirmation-modal {
  background: white;
  border-radius: 12px;
  width: 400px;
  max-width: 90%;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  border-bottom: 1px solid #eee;
}

.modal-header h3 {
  font-size: 20px;
  font-weight: 600;
  color: #333;
}

.close-btn {
  background: transparent;
  border: none;
  color: #777;
  cursor: pointer;
  padding: 5px;
}

.close-btn:hover {
  color: #333;
}

.modal-body {
  padding: 20px;
}

.user-header {
  display: flex;
  align-items: center;
  gap: 15px;
  margin-bottom: 20px;
}

.user-header .avatar {
  width: 60px;
  height: 60px;
}

.user-header h4 {
  font-size: 18px;
  margin-bottom: 5px;
}

.user-header p {
  color: #777;
  font-size: 14px;
}

.form-group {
  margin-bottom: 20px;
}

.form-group label {
  display: block;
  margin-bottom: 8px;
  font-size: 14px;
  color: #555;
  font-weight: 500;
}

.form-group input, 
.form-group select {
  width: 100%;
  padding: 10px 15px;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 14px;
  transition: all 0.3s ease;
}

.form-group input:focus, 
.form-group select:focus {
  border-color: #8e2de2;
  outline: none;
  box-shadow: 0 0 0 3px rgba(142, 45, 226, 0.1);
}

.form-row {
  display: flex;
  gap: 15px;
}

.form-row .form-group {
  flex: 1;
}

.password-input {
  position: relative;
}

.password-input input {
  padding-right: 40px;
}

.toggle-password {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  background: transparent;
  border: none;
  color: #777;
  cursor: pointer;
  padding: 5px;
}

.warning-text {
  color: #e74c3c;
  font-weight: 500;
  margin-top: 10px;
}

.modal-footer {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  padding: 15px 20px;
  border-top: 1px solid #eee;
}

.btn-cancel, .btn-delete, .btn-save {
  padding: 10px 20px;
  border-radius: 8px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
  font-size: 14px;
}

.btn-cancel {
  background: #f5f7fa;
  border: 1px solid #ddd;
  color: #555;
}

.btn-cancel:hover {
  background: #eef2f7;
}

.btn-save {
  background: linear-gradient(135deg, #4a00e0, #8e2de2);
  border: none;
  color: white;
}

.btn-save:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(142, 45, 226, 0.3);
}

.btn-delete {
  background: #ff4757;
  border: none;
  color: white;
}

.btn-delete:hover {
  background: #ff2e43;
}

/* Responsive Styles */
@media (max-width: 1200px) {
  .table-row {
    grid-template-columns: 2fr 1.5fr 1fr 1fr 1fr;
  }
  
  .table-cell:last-child {
    grid-column: span 1;
  }
}

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
  
  .section-header {
    flex-direction: column;
    align-items: flex-start;
  }
  
  .actions {
    width: 100%;
  }
  
  .search-container input {
    width: 100%;
  }
  
  .filters-stats {
    flex-direction: column;
  }
  
  .table-row {
    grid-template-columns: 1fr 1fr;
    grid-template-areas: 
      "user user"
      "email role"
      "status date"
      "actions actions";
    gap: 15px;
    padding: 15px;
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
    grid-area: date;
  }
  
  .table-cell:nth-child(6) {
    grid-area: actions;
    justify-content: flex-end;
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
  
  .form-row {
    flex-direction: column;
    gap: 0;
  }
}

@media (max-width: 576px) {
  .table-row {
    grid-template-columns: 1fr;
    grid-template-areas: 
      "user"
      "email"
      "role"
      "status"
      "date"
      "actions";
  }
  
  .filter-controls {
    flex-direction: column;
    width: 100%;
  }
  
  .filter-group select {
    width: 100%;
  }
  
  .user-stats {
    width: 100%;
    justify-content: space-between;
  }
  
  .stat-item {
    padding: 0;
  }
  
  .stat-item:not(:last-child) {
    border-right: none;
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