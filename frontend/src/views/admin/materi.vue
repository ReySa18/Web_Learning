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
          <router-link to="/admin" class="nav-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
              <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            <span>Dashboard</span>
          </router-link>
          
          <router-link to="/admin/users" class="nav-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
              <circle cx="9" cy="7" r="4"></circle>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            <span>Manajemen User</span>
          </router-link>
          
          <router-link to="/admin/materials" class="nav-item active">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
              <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
            </svg>
            <span>Manajemen Materi</span>
          </router-link>
          
          <router-link to="/admin/questions" class="nav-item">
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
            <button class="primary-btn" @click="openAddMaterialModal">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
              </svg>
              Tambah Materi
            </button>
          </div>
        </div>
        
        <!-- Filters and Stats -->
        <div class="filters-stats">
          <div class="filter-controls">
            <div class="filter-group">
              <label>Kategori:</label>
              <select v-model="categoryFilter">
                <option value="all">Semua Kategori</option>
                <option value="matematika">Matematika</option>
                <option value="fisika">Fisika</option>
                <option value="kimia">Kimia</option>
                <option value="biologi">Biologi</option>
              </select>
            </div>
            
            <div class="filter-group">
              <label>Status:</label>
              <select v-model="statusFilter">
                <option value="all">Semua Status</option>
                <option value="published">Diterbitkan</option>
                <option value="draft">Draft</option>
              </select>
            </div>
            
            <div class="filter-group">
              <label>Urutkan:</label>
              <select v-model="sortBy">
                <option value="recent">Terbaru</option>
                <option value="oldest">Terlama</option>
                <option value="title_asc">Judul (A-Z)</option>
                <option value="title_desc">Judul (Z-A)</option>
              </select>
            </div>
          </div>
          
          <div class="user-stats">
            <div class="stat-item">
              <span class="stat-value">{{ filteredMaterials.length }}</span>
              <span class="stat-label">Total Materi</span>
            </div>
            <div class="stat-item">
              <span class="stat-value">{{ publishedCount }}</span>
              <span class="stat-label">Diterbitkan</span>
            </div>
            <div class="stat-item">
              <span class="stat-value">{{ draftCount }}</span>
              <span class="stat-label">Draft</span>
            </div>
          </div>
        </div>
        
        <!-- Materials Table -->
        <div class="users-table">
          <div class="table-header">
            <div class="table-row">
              <div class="table-cell">Judul Materi</div>
              <div class="table-cell">Kategori</div>
              <div class="table-cell">Label</div>
              <div class="table-cell">Status</div>
              <div class="table-cell">Tanggal Dibuat</div>
              <div class="table-cell">Aksi</div>
            </div>
          </div>
          
          <div class="table-body">
            <div v-for="material in paginatedMaterials" :key="material.id" class="table-row">
              <div class="table-cell">
                <div class="material-info">
                  <div class="material-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                      <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                    </svg>
                  </div>
                  <div>
                    <div class="material-title">{{ material.title }}</div>
                    <div class="material-id">ID: {{ material.id }}</div>
                  </div>
                </div>
              </div>
              <div class="table-cell">
                <div class="material-category">{{ formatCategory(material.category) }}</div>
              </div>
              <div class="table-cell">
                <div class="material-labels">
                  <span v-for="(label, index) in material.labels" :key="index" class="label-badge">
                    {{ label }}
                  </span>
                </div>
              </div>
              <div class="table-cell">
                <div class="status-container">
                  <label class="switch">
                    <input type="checkbox" v-model="material.status" true-value="published" false-value="draft" @change="toggleMaterialStatus(material)">
                    <span class="slider"></span>
                  </label>
                  <span :class="['status-badge', material.status]">
                    {{ material.status === 'published' ? 'Diterbitkan' : 'Draft' }}
                  </span>
                </div>
              </div>
              <div class="table-cell">
                <div class="create-date">{{ material.createdDate }}</div>
                <div class="update-date" v-if="material.updatedDate">Diubah: {{ material.updatedDate }}</div>
              </div>
              <div class="table-cell actions">
                <button class="icon-btn edit" @click="openEditMaterialModal(material)">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                  </svg>
                </button>
                <button class="icon-btn delete" @click="confirmDeleteMaterial(material)">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                  </svg>
                </button>
                <button class="icon-btn view" @click="viewMaterialDetails(material)">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
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
    
    <!-- Add Material Modal - Step 1 (Label Selection) -->
    <div v-if="showAddMaterialModal && showLabelStep" class="modal-overlay">
      <div class="modal">
        <div class="modal-header">
          <h3>Pilih Label Materi</h3>
          <button class="close-btn" @click="closeAddMaterialModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
          </button>
        </div>
        
        <div class="modal-body">
          <div class="form-group">
            <label>Pilih Label:</label>
            <div class="label-selection">
              <div v-for="label in availableLabels" :key="label" 
                   class="label-option" 
                   :class="{ selected: newMaterial.labels.includes(label) }"
                   @click="toggleMaterialLabel(label)">
                {{ label }}
              </div>
            </div>
          </div>
        </div>
        
        <div class="modal-footer">
          <button class="btn-cancel" @click="closeAddMaterialModal">Batal</button>
          <button class="btn-save" @click="proceedToFormStep">Lanjutkan</button>
        </div>
      </div>
    </div>
    
    <!-- Add Material Modal - Step 2 (Form Input) -->
    <div v-if="showAddMaterialModal && showFormStep" class="modal-overlay">
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
          <div class="form-group">
            <label>Judul Materi</label>
            <input type="text" v-model="newMaterial.title" placeholder="Masukkan judul materi">
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label>Kategori</label>
              <select v-model="newMaterial.category">
                <option value="matematika">Matematika</option>
                <option value="fisika">Fisika</option>
                <option value="kimia">Kimia</option>
                <option value="biologi">Biologi</option>
              </select>
            </div>
            
            <div class="form-group">
              <label>Status</label>
              <select v-model="newMaterial.status">
                <option value="published">Diterbitkan</option>
                <option value="draft">Draft</option>
              </select>
            </div>
          </div>
          
          <div class="form-group">
            <label>Label Terpilih:</label>
            <div class="selected-labels">
              <span v-for="(label, index) in newMaterial.labels" :key="index" class="label-badge">
                {{ label }}
                <span @click="removeMaterialLabel(label)" class="remove-label">×</span>
              </span>
            </div>
          </div>
          
          <div class="form-group">
            <label>Konten Materi</label>
            <textarea v-model="newMaterial.content" placeholder="Masukkan konten materi" rows="5"></textarea>
          </div>
        </div>
        
        <div class="modal-footer">
          <button class="btn-cancel" @click="backToLabelStep">Kembali</button>
          <button class="btn-save" @click="addNewMaterial">Simpan Materi</button>
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
          <div class="material-header">
            <div class="material-icon large">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
              </svg>
            </div>
            <div>
              <h4>{{ editingMaterial.title }}</h4>
              <p>ID: {{ editingMaterial.id }}</p>
            </div>
          </div>
          
          <div class="form-group">
            <label>Judul Materi</label>
            <input type="text" v-model="editingMaterial.title">
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label>Kategori</label>
              <select v-model="editingMaterial.category">
                <option value="matematika">Matematika</option>
                <option value="fisika">Fisika</option>
                <option value="kimia">Kimia</option>
                <option value="biologi">Biologi</option>
              </select>
            </div>
            
            <div class="form-group">
              <label>Status</label>
              <select v-model="editingMaterial.status">
                <option value="published">Diterbitkan</option>
                <option value="draft">Draft</option>
              </select>
            </div>
          </div>
          
          <div class="form-group">
            <label>Label:</label>
            <div class="label-selection">
              <div v-for="label in availableLabels" :key="label" 
                   class="label-option" 
                   :class="{ selected: editingMaterial.labels.includes(label) }"
                   @click="toggleEditMaterialLabel(label)">
                {{ label }}
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <label>Konten Materi</label>
            <textarea v-model="editingMaterial.content" rows="5"></textarea>
          </div>
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
import axios from 'axios';

export default {
  name: 'MaterialManagement',
  data() {
    return {
      searchQuery: '',
      categoryFilter: 'all',
      statusFilter: 'all',
      sortBy: 'recent',
      currentPage: 1,
      itemsPerPage: 8,
      showAddMaterialModal: false,
      showEditMaterialModal: false,
      showDeleteConfirmation: false,
      showLabelStep: true,
      showFormStep: false,
      availableLabels: ['Pemula', 'Menengah', 'Lanjutan', 'Teori', 'Praktik', 'Latihan', 'Evaluasi'],
      newMaterial: {
        id: '',
        title: '',
        category: 'matematika',
        labels: [],
        content: '',
        status: 'published',
        createdDate: this.getCurrentDate(),
        updatedDate: ''
      },
      editingMaterial: {},
      materialToDelete: {},
      materials: [
        {
          id: 'MAT-001',
          title: 'Aljabar Dasar',
          category: 'matematika',
          labels: ['Pemula', 'Teori'],
          content: 'Konsep dasar aljabar untuk pemula...',
          status: 'published',
          createdDate: '10 Mei 2024',
          updatedDate: '15 Mei 2024'
        },
        {
          id: 'MAT-002',
          title: 'Hukum Newton',
          category: 'fisika',
          labels: ['Menengah', 'Teori', 'Latihan'],
          content: 'Penjelasan tiga hukum Newton dalam fisika...',
          status: 'published',
          createdDate: '12 Mei 2024',
          updatedDate: '14 Mei 2024'
        },
        {
          id: 'MAT-003',
          title: 'Stoikiometri',
          category: 'kimia',
          labels: ['Menengah', 'Praktik'],
          content: 'Perhitungan kimia dasar dalam stoikiometri...',
          status: 'draft',
          createdDate: '15 Mei 2024',
          updatedDate: ''
        },
        {
          id: 'MAT-004',
          title: 'Sel dan Jaringan',
          category: 'biologi',
          labels: ['Pemula', 'Teori'],
          content: 'Pengenalan struktur sel dan jaringan makhluk hidup...',
          status: 'published',
          createdDate: '8 Mei 2024',
          updatedDate: '10 Mei 2024'
        },
        {
          id: 'MAT-005',
          title: 'Trigonometri',
          category: 'matematika',
          labels: ['Menengah', 'Latihan'],
          content: 'Konsep trigonometri dan penerapannya...',
          status: 'published',
          createdDate: '5 Mei 2024',
          updatedDate: '7 Mei 2024'
        },
        {
          id: 'MAT-006',
          title: 'Termodinamika',
          category: 'fisika',
          labels: ['Lanjutan', 'Teori'],
          content: 'Prinsip dasar termodinamika dan hukum-hukumnya...',
          status: 'draft',
          createdDate: '18 Mei 2024',
          updatedDate: ''
        },
        {
          id: 'MAT-007',
          title: 'Reaksi Redoks',
          category: 'kimia',
          labels: ['Menengah', 'Praktik', 'Evaluasi'],
          content: 'Konsep reaksi reduksi-oksidasi dalam kimia...',
          status: 'published',
          createdDate: '3 Mei 2024',
          updatedDate: '5 Mei 2024'
        },
        {
          id: 'MAT-008',
          title: 'Genetika Dasar',
          category: 'biologi',
          labels: ['Menengah', 'Teori'],
          content: 'Pengantar genetika dan pewarisan sifat...',
          status: 'published',
          createdDate: '20 Mei 2024',
          updatedDate: '21 Mei 2024'
        },
        {
          id: 'MAT-009',
          title: 'Kalkulus Diferensial',
          category: 'matematika',
          labels: ['Lanjutan', 'Teori'],
          content: 'Dasar-dasar kalkulus diferensial dan aplikasinya...',
          status: 'draft',
          createdDate: '22 Mei 2024',
          updatedDate: ''
        },
        {
          id: 'MAT-010',
          title: 'Optika Geometri',
          category: 'fisika',
          labels: ['Menengah', 'Praktik'],
          content: 'Studi tentang cahaya dan sifat-sifatnya...',
          status: 'published',
          createdDate: '19 Mei 2024',
          updatedDate: '20 Mei 2024'
        }
      ]
    };
  },
  computed: {
    filteredMaterials() {
      let filtered = this.materials;

      if (this.searchQuery) {
        const query = this.searchQuery.toLowerCase();
        filtered = filtered.filter(material =>
          material.title.toLowerCase().includes(query) ||
          material.content.toLowerCase().includes(query) ||
          material.labels.some(label => label.toLowerCase().includes(query))
        );
      }

      if (this.categoryFilter !== 'all') {
        filtered = filtered.filter(material => material.category === this.categoryFilter);
      }

      if (this.statusFilter !== 'all') {
        filtered = filtered.filter(material => material.status === this.statusFilter);
      }

      if (this.sortBy === 'title_asc') {
        filtered.sort((a, b) => a.title.localeCompare(b.title));
      } else if (this.sortBy === 'title_desc') {
        filtered.sort((a, b) => b.title.localeCompare(a.title));
      } else if (this.sortBy === 'recent') {
        filtered.sort((a, b) => new Date(b.createdDate) - new Date(a.createdDate));
      } else if (this.sortBy === 'oldest') {
        filtered.sort((a, b) => new Date(a.createdDate) - new Date(b.createdDate));
      }

      return filtered;
    },
    publishedCount() {
      return this.materials.filter(material => material.status === 'published').length;
    },
    draftCount() {
      return this.materials.filter(material => material.status === 'draft').length;
    },
    totalPages() {
      return Math.ceil(this.filteredMaterials.length / this.itemsPerPage);
    },
    paginatedMaterials() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.filteredMaterials.slice(start, end);
    }
  },
  methods: {
    getCurrentDate() {
      const now = new Date();
      return now.toLocaleDateString('id-ID', {
        day: '2-digit',
        month: 'short',
        year: 'numeric'
      });
    },
    formatCategory(category) {
      const categories = {
        matematika: 'Matematika',
        fisika: 'Fisika',
        kimia: 'Kimia',
        biologi: 'Biologi'
      };
      return categories[category] || category;
    },
    openAddMaterialModal() {
      this.newMaterial = {
        id: 'MAT-' + Math.floor(1000 + Math.random() * 9000),
        title: '',
        category: 'matematika',
        labels: [],
        content: '',
        status: 'published',
        createdDate: this.getCurrentDate(),
        updatedDate: ''
      };
      this.showLabelStep = true;
      this.showFormStep = false;
      this.showAddMaterialModal = true;
    },
    closeAddMaterialModal() {
      this.showAddMaterialModal = false;
    },
    proceedToFormStep() {
      if (this.newMaterial.labels.length > 0) {
        this.showLabelStep = false;
        this.showFormStep = true;
      } else {
        this.$toast.warning('Pilih setidaknya satu label untuk materi');
      }
    },
    backToLabelStep() {
      this.showLabelStep = true;
      this.showFormStep = false;
    },
    toggleMaterialLabel(label) {
      if (this.newMaterial.labels.includes(label)) {
        this.newMaterial.labels = this.newMaterial.labels.filter(l => l !== label);
      } else {
        this.newMaterial.labels.push(label);
      }
    },
    toggleEditMaterialLabel(label) {
      if (this.editingMaterial.labels.includes(label)) {
        this.editingMaterial.labels = this.editingMaterial.labels.filter(l => l !== label);
      } else {
        this.editingMaterial.labels.push(label);
      }
    },
    removeMaterialLabel(label) {
      this.newMaterial.labels = this.newMaterial.labels.filter(l => l !== label);
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
    addNewMaterial() {
      this.materials.unshift({ ...this.newMaterial });
      this.showAddMaterialModal = false;
      this.$toast.success('Materi berhasil ditambahkan');
    },
    saveMaterialChanges() {
      const index = this.materials.findIndex(m => m.id === this.editingMaterial.id);
      if (index !== -1) {
        this.materials[index] = { 
          ...this.editingMaterial,
          updatedDate: this.getCurrentDate()
        };
      }
      this.showEditMaterialModal = false;
      this.$toast.success('Perubahan materi berhasil disimpan');
    },
    deleteMaterial() {
      this.materials = this.materials.filter(material => material.id !== this.materialToDelete.id);
      this.showDeleteConfirmation = false;
      this.$toast.info('Materi berhasil dihapus');
    },
    toggleMaterialStatus(material) {
      this.$toast.info(`Status materi "${material.title}" diubah menjadi ${material.status === 'published' ? 'Diterbitkan' : 'Draft'}`);
    },
    viewMaterialDetails(material) {
      this.$toast.info(`Melihat detail materi: ${material.title}`);
    }
  }
}
</script>

<style scoped>
/* Custom styles for Material Management */
.material-info {
  display: flex;
  align-items: center;
  gap: 12px;
}

.material-icon {
  width: 40px;
  height: 40px;
  background: #f0f7ff;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #4a00e0;
}

.material-icon.large {
  width: 50px;
  height: 50px;
}

.material-icon svg {
  width: 24px;
  height: 24px;
}

.material-icon.large svg {
  width: 28px;
  height: 28px;
}

.material-title {
  font-weight: 500;
}

.material-id {
  font-size: 12px;
  color: #777;
}

.material-category {
  font-weight: 500;
  padding: 5px 12px;
  background: #f0f7ff;
  border-radius: 20px;
  display: inline-block;
  color: #4a00e0;
}

.material-labels {
  display: flex;
  flex-wrap: wrap;
  gap: 5px;
}

.label-badge {
  padding: 4px 10px;
  background: #f0f7ff;
  border-radius: 20px;
  font-size: 12px;
  color: #4a00e0;
  display: flex;
  align-items: center;
  gap: 5px;
}

.remove-label {
  cursor: pointer;
  font-size: 14px;
  font-weight: bold;
}

.label-selection {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 5px;
}

.label-option {
  padding: 8px 15px;
  background: #f5f7fa;
  border-radius: 20px;
  font-size: 14px;
  cursor: pointer;
  transition: all 0.2s ease;
}

.label-option:hover {
  background: #eef2f7;
}

.label-option.selected {
  background: #4a00e0;
  color: white;
}

.selected-labels {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 5px;
}

.material-header {
  display: flex;
  align-items: center;
  gap: 15px;
  margin-bottom: 20px;
}

.material-header h4 {
  font-size: 18px;
  margin-bottom: 5px;
}

textarea {
  width: 100%;
  padding: 10px 15px;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 14px;
  font-family: 'Inter', sans-serif;
  resize: vertical;
  min-height: 100px;
  transition: all 0.3s ease;
}

textarea:focus {
  border-color: #8e2de2;
  outline: none;
  box-shadow: 0 0 0 3px rgba(142, 45, 226, 0.1);
}

/* Base Styles */
.admin-dashboard {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  background-color: #f5f7fa;
  font-family: 'Inter', sans-serif;
}

</style>