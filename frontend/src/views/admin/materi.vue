<template>
  <div class="admin-dashboard">
    <!-- Top Navigation Bar -->
    <div class="top-nav">
      <router-link to="/admin" class="logo-container">
        <div class="logo">K</div>
        <h1>AsCodeAdmin</h1>
      </router-link>
      
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
          
          <router-link to="/usermanagement" class="nav-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
              <circle cx="9" cy="7" r="4"></circle>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            <span>Manajemen User</span>
          </router-link>
          
          <router-link to="/materi" class="nav-item active">
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
        <!-- Material Management Header -->
        <div class="section-header">
          <div>
            <h2 class="section-title">Manajemen Materi</h2>
            <p class="section-subtitle">Kelola materi kursus Anda</p>
          </div>
          <div class="actions">
            <div class="search-container">
              <input type="text" v-model="searchQuery" placeholder="Cari materi...">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
              </svg>
            </div>
            <router-link to="/inputmateri" class="primary-btn">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
              </svg>
              Tambah Materi
            </router-link>
          </div>
        </div>
        
        <!-- Filters and Stats -->
        <div class="filters-stats">
          <div class="filter-controls">
            <div class="filter-group">
              <label>Kategori:</label>
              <select v-model="categoryFilter">
                <option value="all">Semua Kategori</option>
                <option v-for="category in categories" :key="category" :value="category">{{ category }}</option>
              </select>
            </div>
            
            <div class="filter-group">
              <label>Topik:</label>
              <select v-model="topicFilter">
                <option value="all">Semua Topik</option>
                <option v-for="topic in topics" :key="topic" :value="topic">{{ topic }}</option>
              </select>
            </div>
            
            <div class="filter-group">
              <label>Urutkan:</label>
              <select v-model="sortBy">
                <option value="recent">Terbaru</option>
                <option value="oldest">Terlama</option>
                <option value="title">Judul (A-Z)</option>
                <option value="title_desc">Judul (Z-A)</option>
              </select>
            </div>
          </div>
          
          <div class="user-stats">
            <div class="stat-item">
              <span class="stat-value">{{ filteredMaterials.length }}</span>
              <span class="stat-label">Total Materi</span>
            </div>
          </div>
        </div>
        
        <!-- Materials Table -->
        <div class="users-table">
          <div class="table-header">
            <div class="table-row">
              <div class="table-cell">Judul Materi</div>
              <div class="table-cell">Kategori</div>
              <div class="table-cell">Status</div>
              <div class="table-cell">Tanggal Dibuat</div>
              <div class="table-cell">Aksi</div>
            </div>
          </div>
          
          <div class="table-body">
            <div v-for="material in paginatedMaterials" :key="material.id" class="table-row">
              <div class="table-cell">
                <div class="materi-info">
                  <div class="material-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                      <polyline points="14 2 14 8 20 8"></polyline>
                      <line x1="16" y1="13" x2="8" y2="13"></line>
                      <line x1="16" y1="17" x2="8" y2="17"></line>
                      <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                  </div>
                  <div>
                    <div class="materi-title">{{ material.title }}</div>
                    <div class="materi-id">ID: {{ material.id }}</div>
                  </div>
                </div>
              </div>
              <div class="table-cell">
                <div class="materi-category">{{ material.category }}</div>
              </div>
              <div class="table-cell">
                <div class="materi-topic">{{ material.topic }}</div>
              </div>
              <div class="table-cell">
                <div class="materi-createdAt">{{ material.createdAt }}</div>
              </div>
              
              <div class="table-cell actions">
                <router-link :to="`/editMateri/${material.id}`" class="icon-btn edit">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                  </svg>
                </router-link>
                <button class="icon-btn delete" @click="confirmDeleteMaterial(material)">
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
    
    <!-- Add Material Modal -->
    <div v-if="showAddMaterialModal" class="modal-overlay">
      <div class="modal">
        <div class="modal-header">
          <h3>Tambah Materi Baru</h3>
          <button class="close-btn" @click="closeAddMaterialModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
          </button>
        </div>
        
        <div class="modal-body">
          <p class="placeholder-text">Formulir penambahan materi akan ditampilkan di sini.</p>
        </div>
        
        <div class="modal-footer">
          <button class="btn-cancel" @click="closeAddMaterialModal">Batal</button>
          <button class="btn-save" @click="addNewMaterial">Simpan</button>
        </div>
      </div>
    </div>
    
    <!-- Edit Material Modal -->
    <div v-if="showEditMaterialModal" class="modal-overlay">
      <div class="modal">
        <div class="modal-header">
          <h3>Edit Materi</h3>
          <button class="close-btn" @click="closeEditMaterialModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
          </button>
        </div>
        
        <div class="modal-body">
          <div class="user-header">
            <div class="material-icon large">
              <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
              </svg>
            </div>
            <div>
              <h4>{{ editingMaterial.title }}</h4>
              <p>ID: {{ editingMaterial.id }}</p>
            </div>
          </div>
          
          <p class="placeholder-text">Formulir pengeditan materi akan ditampilkan di sini.</p>
        </div>
        
        <div class="modal-footer">
          <button class="btn-cancel" @click="closeEditMaterialModal">Batal</button>
          <button class="btn-save" @click="saveMaterialChanges">Simpan Perubahan</button>
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
          <p>Anda yakin ingin menghapus materi <strong>{{ materialToDelete.title }}</strong>?</p>
          <p class="warning-text">Aksi ini tidak dapat dibatalkan dan semua data materi akan dihapus permanen.</p>
        </div>
        
        <div class="modal-footer">
          <button class="btn-cancel" @click="showDeleteConfirmation = false">Batal</button>
          <button class="btn-delete" @click="deleteMaterial">Hapus Materi</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from '@/api';
import { useToast } from 'vue-toastification';

export default {
  name: 'MaterialManagement',
  setup() {
    const toast = useToast();
    return { toast };
  },
  data() {
    return {
      adminProfile: null,
      showDropdown: false,
      searchQuery: '',
      categoryFilter: 'all',
      topicFilter: 'all',
      sortBy: 'recent',
      currentPage: 1,
      itemsPerPage: 8,
      showAddMaterialModal: false,
      showEditMaterialModal: false,
      showDeleteConfirmation: false,
      newMaterial: {
        id: '',
        title: '',
        category: '',
        status: 'draft',
        createdAt: ''
      },
      editingMaterial: {},
      materialToDelete: {},
      categories: ['C', 'C++', 'Python'],
      topics: [],
      materials: []
    };
  },
  computed: {
    filteredMaterials() {
      let filtered = this.materials;
      if (this.searchQuery) {
        const query = this.searchQuery.toLowerCase();
        filtered = filtered.filter(material =>
          material.title.toLowerCase().includes(query) ||
          material.category.toLowerCase().includes(query)
        );
      }
      if (this.categoryFilter !== 'all') {
        filtered = filtered.filter(material => material.category === this.categoryFilter);
      }
      if (this.topicFilter !== 'all') {
        filtered = filtered.filter(material => material.topic === this.topicFilter);
      }
      if (this.sortBy === 'recent') {
        filtered.sort((a, b) => new Date(b.createdAt) - new Date(a.createdAt));
      } else if (this.sortBy === 'oldest') {
        filtered.sort((a, b) => new Date(a.createdAt) - new Date(b.createdAt));
      } else if (this.sortBy === 'title') {
        filtered.sort((a, b) => a.title.localeCompare(b.title));
      } else if (this.sortBy === 'title_desc') {
        filtered.sort((a, b) => b.title.localeCompare(a.title));
      }
      return filtered;
    },
    publishedCount() {
      return this.materials.filter(m => m.status === 'published').length;
    },
    draftCount() {
      return this.materials.filter(m => m.status === 'draft').length;
    },
    totalPages() {
      return Math.ceil(this.filteredMaterials.length / this.itemsPerPage);
    },
    paginatedMaterials() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      return this.filteredMaterials.slice(start, start + this.itemsPerPage);
    }
  },
  methods: {
    getRoleName(role) {
      const roles = {
        student: 'Siswa',
        admin: 'Admin'
      };
      return roles[role] || role;
    },
    async fetchAdminProfile() {
      try {
        const response = await api.get('/user');
        this.adminProfile = response.data;
      } catch (error) {
        console.error('Gagal memuat profil admin:', error);
        this.toast.error('Gagal memuat profil admin');
      }
    },
    async fetchMaterials() {
      try {
        const response = await api.get('/materi');
        this.materials = response.data.map(item => ({
          id: item.id,
          title: item.judul,
          category: item.kategori?.nama,
          topic: item.topik?.nama,
          createdAt: this.formatDate(item.created_at)
        }));
      } catch (error) {
        this.toast.error('Gagal memuat materi dari server');
        console.error(error);
      }
    },
    async fetchTopics() {
      try {
        const response = await api.get('/topik');
        this.topics = response.data.map(t => t.nama);
      } catch (error) {
        this.toast.error('Gagal memuat topik dari server');
        console.error(error);
      }
    },
    formatDate(dateStr) {
      const date = new Date(dateStr);
      return date.toLocaleDateString('id-ID', {
        day: '2-digit',
        month: 'short',
        year: 'numeric'
      });
    },
    openAddMaterialModal() {
      this.newMaterial = {
        id: '',
        title: '',
        category: '',
        createdAt: this.getCurrentDate(),
        status: 'draft'
      };
      this.showAddMaterialModal = true;
    },
    closeAddMaterialModal() {
      this.showAddMaterialModal = false;
    },
    openEditMaterialModal(material) {
      this.editingMaterial = { ...material };
      this.showEditMaterialModal = true;
    },
    closeEditMaterialModal() {
      this.showEditMaterialModal = false;
    },
    confirmDeleteMaterial(material) {
      this.materialToDelete = { ...material };
      this.showDeleteConfirmation = true;
    },
    getCurrentDate() {
      const now = new Date();
      return now.toLocaleDateString('id-ID', {
        day: '2-digit',
        month: 'short',
        year: 'numeric'
      });
    },
    addNewMaterial() {
      const newId = 'MAT' + String(this.materials.length + 1).padStart(3, '0');
      const newMat = { ...this.newMaterial, id: newId };
      this.materials.unshift(newMat);
      this.closeAddMaterialModal();
      this.toast.success(`Materi "${newMat.title}" berhasil ditambahkan`, {
        timeout: 3000,
        position: 'top-right'
      });
    },
    saveMaterialChanges() {
      const index = this.materials.findIndex(m => m.id === this.editingMaterial.id);
      if (index !== -1) {
        this.materials[index] = { ...this.editingMaterial };
        this.closeEditMaterialModal();
        this.toast.success(`Perubahan materi "${this.editingMaterial.title}" berhasil disimpan`, {
          timeout: 3000,
          position: 'top-right'
        });
      }
    },
    async deleteMaterial() {
      const token = localStorage.getItem('auth_token');
      const id = this.materialToDelete.id;
      const index = this.materials.findIndex(m => m.id === id);

      if (!token) {
        this.toast.error('Token tidak ditemukan. Silakan login ulang.');
        return;
      }

      if (index === -1) {
        this.toast.error('Materi tidak ditemukan dalam daftar.');
        return;
      }

      try {
        await api.delete(`/materi/${id}`);

        const deletedTitle = this.materialToDelete.title;
        this.materials.splice(index, 1);
        this.showDeleteConfirmation = false;

        this.toast.success(`Materi "${deletedTitle}" berhasil dihapus`, {
          timeout: 3000,
          position: 'top-right'
        });

      } catch (error) {
        console.error('Error deleting material:', error);
        this.toast.error(`Gagal menghapus materi: ${error.response?.data?.message || error.message}`);
      }
    },
    toggleDropdown() {
      this.showDropdown = !this.showDropdown;
    },
    logout() {
      localStorage.removeItem('token');
      this.$router.push('/login');
    },
    handleClickOutside(event) {
      if (this.showDropdown && !this.$refs.profileContainer.contains(event.target)) {
        this.showDropdown = false;
      }
    }
  },
  mounted() {
    document.addEventListener('click', this.handleClickOutside);
    this.fetchMaterials();
    this.fetchTopics();
    this.fetchAdminProfile();
  },
  beforeUnmount() {
    document.removeEventListener('click', this.handleClickOutside);
  }
};
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
.materi-topic {
  padding: 4px 10px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 500;
  display: inline-block;
  background: rgba(74, 0, 224, 0.1);
  color: #4a00e0;
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
  align-items: center;
  background: #f8f9fa;
  font-weight: 600;
  color: #495057;
}

.table-row {
  display: grid;
  grid-template-columns: 2fr 1.5fr 1fr 1.5fr auto;
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

.materi-info {
  display: flex;
  align-items: center;
  font-size: 14px;
}

.materi-info .avatar {
  width: 40px;
  height: 40px;
}

.materi-title {
  font-weight: 500;
}

.materi-id {
  font-size: 12px;
  color: #777;
}

.materi-category {
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

.materi-createdAt {
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
    grid-template-columns: 2fr 1.5fr 1fr 1fr auto;
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
/* Custom styles for Material Management */
.material-icon {
  width: 40px;
  height: 40px;
  background: #f0f5ff;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #4a00e0;
}

.material-icon.large {
  width: 60px;
  height: 60px;
  border-radius: 12px;
}

.placeholder-text {
  text-align: center;
  padding: 20px;
  color: #777;
  font-style: italic;
  background: #f9f9f9;
  border-radius: 8px;
  margin: 20px 0;
}

.status-badge {
  padding: 6px 12px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 500;
  display: inline-block;
}

.status-badge.published {
  background: rgba(46, 204, 113, 0.1);
  color: #2ecc71;
}

.status-badge.draft {
  background: rgba(241, 196, 15, 0.1);
  color: #f1c40f;
}

.status-badge.archived {
  background: rgba(149, 165, 166, 0.1);
  color: #95a5a6;
}

/* Responsive adjustments */
@media (max-width: 992px) {
  .table-row {
    grid-template-columns: 1fr 1fr;
    grid-template-areas: 
      "title title"
      "category status"
      "date date"
      "actions actions";
    gap: 15px;
    padding: 15px;
  }
  
  .table-cell:nth-child(1) {
    grid-area: title;
  }
  
  .table-cell:nth-child(2) {
    grid-area: category;
  }
  
  .table-cell:nth-child(3) {
    grid-area: date;
  }
  
  .table-cell:nth-child(4) {
    grid-area: status;
  }
  
  .table-cell:nth-child(5) {
    grid-area: actions;
    justify-content: flex-end;
  }
}

@media (max-width: 576px) {
  .table-row {
    grid-template-columns: 1fr;
    grid-template-areas: 
      "title"
      "category"
      "date"
      "status"
      "actions";
  }
}
</style>