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
          
          <router-link to="/usermanagement" class="nav-item">
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
          
          <router-link to="/managementsoal" class="nav-item active">
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
        <!-- Question Management Header -->
        <div class="section-header">
          <div>
            <h2 class="section-title">Manajemen Soal</h2>
            <p class="section-subtitle">Kelola soal evaluasi kursus Anda</p>
          </div>
          <div class="actions">
            <div class="search-container">
              <input type="text" v-model="searchQuery" placeholder="Cari soal...">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
              </svg>
            </div>
            <button class="primary-btn" @click="openAddSoalModal">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
              </svg>
              Tambah Soal
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
                <option v-for="kategori in categories" :value="kategori.nama" :key="kategori.id">{{ kategori.nama }}</option>
              </select>
            </div>
            
            <div class="filter-group">
              <label>Topik:</label>
              <select v-model="topicFilter">
                <option value="all">Semua Topik</option>
                <option v-for="topik in topics" :value="topik.nama" :key="topik.id">{{ topik.nama }}</option>
              </select>
            </div>
            
            <div class="filter-group">
              <label>Urutkan:</label>
              <select v-model="sortBy">
                <option value="recent">Terbaru</option>
                <option value="oldest">Terlama</option>
              </select>
            </div>
          </div>
          
          <div class="user-stats">
            <div class="stat-item">
              <span class="stat-value">{{ filteredSoals.length }}</span>
              <span class="stat-label">Total Soal</span>
            </div>
          </div>
        </div>
        
        <!-- managementsoal Table -->
        <div class="users-table">
          <div class="table-header">
            <div class="table-row">
              <div class="table-cell">Pertanyaan</div>
              <div class="table-cell">Topik</div>
              <div class="table-cell">Kategori</div>
              <div class="table-cell">Jawaban Benar</div>
              <div class="table-cell">Aksi</div>
            </div>
          </div>
          
          <div class="table-body">
            <div v-for="soal in paginatedSoals" :key="soal.id" class="table-row">
              <div class="table-cell">
                <div class="soal-info">
                  <div class="soal-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <circle cx="12" cy="12" r="10"></circle>
                      <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                      <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                  </div>
                  <div>
                    <div class="soal-title">{{ truncateText(soal.pertanyaan, 60) }}</div>
                    <div class="soal-id">ID: {{ soal.id }}</div>
                  </div>
                </div>
              </div>
              <div class="table-cell">
                <div class="soal-topic">{{ soal.topik }}</div>
              </div>
              <div class="table-cell">
                <div class="soal-category">{{ soal.kategori }}</div>
              </div>
              <div class="table-cell">
                <div class="correct-answer">
                  <span class="answer-badge">{{ soal.jawaban_benar }}</span>
                </div>
              </div>
              
              <div class="table-cell actions">
                <button class="icon-btn edit" @click="openEditSoalModal(soal)">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                  </svg>
                </button>
                <button class="icon-btn delete" @click="confirmDeleteSoal(soal)">
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
    
    <!-- Add Question Modal -->
    <div v-if="showAddSoalModal" class="modal-overlay">
      <div class="modal">
        <div class="modal-header">
          <h3>Tambah Soal Baru</h3>
          <button class="close-btn" @click="closeAddSoalModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
          </button>
        </div>
        
        <div class="modal-body">
          <div class="form-group">
            <label>Pertanyaan</label>
            <textarea v-model="newSoal.pertanyaan" rows="3" placeholder="Masukkan pertanyaan"></textarea>
          </div>
          
          <div class="form-group">
            <label>Topik</label>
            <select v-model="newSoal.topik">
              <option v-for="topik in topics" :value="topik.id" :key="topik.id">{{ topik.nama }}</option>
            </select>
          </div>
          
          <div class="form-group">
            <label>Kategori</label>
            <select v-model="newSoal.kategori">
              <option v-for="kategori in categories" :value="kategori.id" :key="kategori.id">{{ kategori.nama }}</option>
            </select>
          </div>
          
          <div class="form-group">
            <label>Pilihan Jawaban</label>
            <div class="option-input">
              <div class="option-row">
                <span class="option-letter">A.</span>
                <input type="text" v-model="newSoal.pilihan.A" placeholder="Pilihan A">
              </div>
              <div class="option-row">
                <span class="option-letter">B.</span>
                <input type="text" v-model="newSoal.pilihan.B" placeholder="Pilihan B">
              </div>
              <div class="option-row">
                <span class="option-letter">C.</span>
                <input type="text" v-model="newSoal.pilihan.C" placeholder="Pilihan C">
              </div>
              <div class="option-row">
                <span class="option-letter">D.</span>
                <input type="text" v-model="newSoal.pilihan.D" placeholder="Pilihan D">
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <label>Jawaban Benar</label>
            <div class="correct-answer-selector">
              <button v-for="option in ['A', 'B', 'C', 'D']" 
                      :key="option" 
                      class="answer-option"
                      :class="{ selected: newSoal.jawaban_benar === option }"
                      @click="newSoal.jawaban_benar = option">
                {{ option }}
              </button>
            </div>
          </div>
        </div>
        
        <div class="modal-footer">
          <button class="btn-cancel" @click="closeAddSoalModal">Batal</button>
          <button class="btn-save" @click="addNewSoal">Simpan</button>
        </div>
      </div>
    </div>
    
    <!-- Edit Question Modal -->
    <div v-if="showEditSoalModal" class="modal-overlay">
      <div class="modal">
        <div class="modal-header">
          <h3>Edit Soal</h3>
          <button class="close-btn" @click="closeEditSoalModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
          </button>
        </div>
        
        <div class="modal-body">
          <div class="user-header">
            <div class="soal-icon large">
              <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
              </svg>
            </div>
            <div>
              <h4>ID: {{ editingSoal.id }}</h4>
              <p>Topik: {{ editingSoal.topik }}, Kategori: {{ editingSoal.kategori }}</p>
            </div>
          </div>
          
          <div class="form-group">
            <label>Pertanyaan</label>
            <textarea v-model="editingSoal.pertanyaan" rows="3" placeholder="Masukkan pertanyaan"></textarea>
          </div>
          
          <div class="form-group">
            <label>Topik</label>
            <select v-model="editingSoal.topik">
              <option v-for="topik in topics" :value="topik.id" :key="topik.id">{{ topik.nama }}</option>
            </select>
          </div>
          
          <div class="form-group">
            <label>Kategori</label>
            <select v-model="editingSoal.kategori">
              <option v-for="kategori in categories" :value="kategori.id" :key="kategori.id">{{ kategori.nama }}</option>
            </select>
          </div>
          
          <div class="form-group">
            <label>Pilihan Jawaban</label>
            <div class="option-input">
              <div class="option-row">
                <span class="option-letter">A.</span>
                <input type="text" v-model="editingSoal.pilihan.A" placeholder="Pilihan A">
              </div>
              <div class="option-row">
                <span class="option-letter">B.</span>
                <input type="text" v-model="editingSoal.pilihan.B" placeholder="Pilihan B">
              </div>
              <div class="option-row">
                <span class="option-letter">C.</span>
                <input type="text" v-model="editingSoal.pilihan.C" placeholder="Pilihan C">
              </div>
              <div class="option-row">
                <span class="option-letter">D.</span>
                <input type="text" v-model="editingSoal.pilihan.D" placeholder="Pilihan D">
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <label>Jawaban Benar</label>
            <div class="correct-answer-selector">
              <button v-for="option in ['A', 'B', 'C', 'D']" 
                      :key="option" 
                      class="answer-option"
                      :class="{ selected: editingSoal.jawaban_benar === option }"
                      @click="editingSoal.jawaban_benar = option">
                {{ option }}
              </button>
            </div>
          </div>
        </div>
        
        <div class="modal-footer">
          <button class="btn-cancel" @click="closeEditSoalModal">Batal</button>
          <button class="btn-save" @click="saveSoalChanges">Simpan Perubahan</button>
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
          <p>Anda yakin ingin menghapus soal berikut?</p>
          <p><strong>{{ soalToDelete.pertanyaan }}</strong></p>
          <p class="warning-text">Aksi ini tidak dapat dibatalkan dan data soal akan dihapus permanen.</p>
        </div>
        
        <div class="modal-footer">
          <button class="btn-cancel" @click="showDeleteConfirmation = false">Batal</button>
          <button class="btn-delete" @click="deleteSoal">Hapus Soal</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useToast } from 'vue-toastification';
import axios from 'axios';

export default {
  name: 'ManagementSoal',
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
      showAddSoalModal: false,
      showEditSoalModal: false,
      showDeleteConfirmation: false,
      newSoal: {
        id: '',
        pertanyaan: '',
        topik: '',
        kategori: '',
        pilihan: { A: '', B: '', C: '', D: '' },
        jawaban_benar: 'A',
        createdAt: ''
      },
      editingSoal: {
        id: '',
        pertanyaan: '',
        topik: '',
        kategori: '',
        pilihan: { A: '', B: '', C: '', D: '' },
        jawaban_benar: 'A'
      },
      soalToDelete: {},
      categories: [],
      topics: [],
      soals: []
    };
  },
  computed: {
    filteredSoals() {
    let filtered = this.soals;
    const query = this.searchQuery.toLowerCase();

    if (this.searchQuery) {
        filtered = filtered.filter(soal =>
        soal.pertanyaan.toLowerCase().includes(query) ||
        soal.topik.toLowerCase().includes(query) ||
        soal.kategori.toLowerCase().includes(query)
        );
    }

    if (this.categoryFilter !== 'all') {
        filtered = filtered.filter(soal => soal.kategori === this.categoryFilter);
    }

    if (this.topicFilter !== 'all') {
        filtered = filtered.filter(soal => soal.topik === this.topicFilter);
    }

    if (this.sortBy === 'recent') {
        filtered.sort((a, b) => new Date(b.createdAt) - new Date(a.createdAt));
    } else if (this.sortBy === 'oldest') {
        filtered.sort((a, b) => new Date(a.createdAt) - new Date(b.createdAt));
    }

    return filtered;
    },

    totalPages() {
      return Math.ceil(this.filteredSoals.length / this.itemsPerPage);
    },
    paginatedSoals() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.filteredSoals.slice(start, end);
    }
  },
  methods: {
    truncateText(text, maxLength) {
      return text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
    },
    async fetchCategories() {
        try {
            const token = localStorage.getItem('auth_token');
            const response = await axios.get('http://localhost:8000/api/kategori', {
            headers: { Authorization: `Bearer ${token}` }
            });
            this.categories = response.data; // Jangan .map(item => item.nama)
        } catch (error) {
            console.error('Gagal memuat kategori:', error);
            this.toast.error('Gagal memuat kategori');
        }
    },

    async fetchTopics() {
        try {
            const token = localStorage.getItem('auth_token');
            const response = await axios.get('http://localhost:8000/api/topik', {
            headers: { Authorization: `Bearer ${token}` }
            });
            this.topics = response.data; // Jangan .map(item => item.nama)
        } catch (error) {
            console.error('Gagal memuat topik:', error);
            this.toast.error('Gagal memuat topik');
        }
    },

    getKategoriId(nama) {
    const found = this.categories.find(k => k.nama === nama);
    return found ? found.id : null;
    },

    getTopikId(nama) {
    const found = this.topics.find(t => t.nama === nama);
    return found ? found.id : null;
    },
    async fetchSoals() {
      try {
        const token = localStorage.getItem('auth_token');
        const response = await axios.get('http://localhost:8000/api/soal', {
          headers: { Authorization: `Bearer ${token}` }
        });

        this.soals = response.data.map(item => ({
          id: item.id,
          pertanyaan: item.pertanyaan,
          topik: item.topik?.nama || '',
          kategori: item.kategori?.nama || '',
          pilihan: {
            A: item.opsi_a || '',
            B: item.opsi_b || '',
            C: item.opsi_c || '',
            D: item.opsi_d || ''
          },
          jawaban_benar: item.jawaban_benar || 'A',
          createdAt: item.created_at || new Date().toISOString()
        }));
      } catch (error) {
        this.toast.error('Gagal memuat soal dari server');
        console.error('❌ Gagal memuat soal:', error);
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
    openAddSoalModal() {
      this.newSoal = {
        id: '',
        pertanyaan: '',
        topik: '',
        kategori: '',
        pilihan: { A: '', B: '', C: '', D: '' },
        jawaban_benar: 'A',
        createdAt: this.getCurrentDate()
      };
      this.showAddSoalModal = true;
    },
    closeAddSoalModal() {
      this.showAddSoalModal = false;
    },
    openEditSoalModal(soal) {
      this.editingSoal = { ...soal };
      this.showEditSoalModal = true;
    },
    closeEditSoalModal() {
      this.showEditSoalModal = false;
    },
    confirmDeleteSoal(soal) {
      this.soalToDelete = { ...soal };
      this.showDeleteConfirmation = true;
    },
    getCurrentDate() {
      return new Date().toISOString();
    },
    async addNewSoal() {
      try {
        const token = localStorage.getItem('auth_token');

        const payload = {
        kategori_id: this.newSoal.kategori,
        topik_id: this.newSoal.topik,       
        pertanyaan: this.newSoal.pertanyaan,
        opsi_a: this.newSoal.pilihan.A,
        opsi_b: this.newSoal.pilihan.B,
        opsi_c: this.newSoal.pilihan.C,
        opsi_d: this.newSoal.pilihan.D,
        jawaban_benar: this.newSoal.jawaban_benar
        };

        await axios.post('http://localhost:8000/api/soal', payload, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });

        this.toast.success('Soal berhasil ditambahkan!');
        this.fetchSoals();
        this.closeAddSoalModal();
      } catch (error) {
        console.log(error.response?.data?.errors);
        this.toast.error('Terjadi kesalahan saat menyimpan soal');
        console.error(error);
      }
    },
    async saveSoalChanges() {
      const token = localStorage.getItem('auth_token');

      const payload = {
        kategori_id: this.editingSoal.kategori,
        topik_id: this.editingSoal.topik,
        pertanyaan: this.editingSoal.pertanyaan,
        opsi_a: this.editingSoal.pilihan.A,
        opsi_b: this.editingSoal.pilihan.B,
        opsi_c: this.editingSoal.pilihan.C,
        opsi_d: this.editingSoal.pilihan.D,
        jawaban_benar: this.editingSoal.jawaban_benar
      };

      try {
        await axios.put(`http://localhost:8000/api/soal/${this.editingSoal.id}`, payload, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });

        this.toast.success('Soal berhasil diperbarui!');
        this.fetchSoals(); // refresh list soal dari server
        this.closeEditSoalModal();
      } catch (error) {
        this.toast.error('Gagal memperbarui soal');
        console.error('❌ Error saat update soal:', error);
      }
    },
    async deleteSoal() {
      const id = this.soalToDelete.id;
      const token = localStorage.getItem('auth_token');

      try {
        await axios.delete(`http://localhost:8000/api/soal/${id}`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });

        this.toast.success('Soal berhasil dihapus');
        this.fetchSoals(); 
        this.showDeleteConfirmation = false;
      } catch (error) {
        this.toast.error('Gagal menghapus soal');
        console.error('❌ Error saat menghapus soal:', error);
      }
    },
    getRoleName(role) {
      const roles = {
        'student': 'Siswa',
        'admin': 'Admin'
      };
      return roles[role] || role;
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
    document.addEventListener('click', this.handleClickOutside);
    this.fetchAdminProfile();
    this.fetchSoals();
    this.fetchCategories();
    this.fetchTopics();
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
  grid-template-columns: 3fr 1fr 1fr 1fr auto;
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

.soal-info {
  display: flex;
  align-items: center;
  gap: 12px;
}

.soal-icon {
  width: 40px;
  height: 40px;
  background: #f0f5ff;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #4a00e0;
}

.soal-icon.large {
  width: 60px;
  height: 60px;
  border-radius: 12px;
}

.soal-title {
  font-weight: 500;
  line-height: 1.4;
}

.soal-id {
  font-size: 12px;
  color: #777;
}

.soal-topic, .soal-category {
  padding: 4px 10px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 500;
  display: inline-block;
}

.soal-topic {
  background: rgba(74, 0, 224, 0.1);
  color: #4a00e0;
}

.soal-category {
  background: rgba(46, 204, 113, 0.1);
  color: #2ecc71;
}

.correct-answer .answer-badge {
  display: inline-block;
  width: 28px;
  height: 28px;
  border-radius: 50%;
  background: #4a00e0;
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
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
  width: 600px;
  max-width: 90%;
  max-height: 90vh;
  overflow-y: auto;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.confirmation-modal {
  background: white;
  border-radius: 12px;
  width: 500px;
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

.form-group textarea,
.form-group select {
  width: 100%;
  padding: 10px 15px;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 14px;
  transition: all 0.3s ease;
  font-family: 'Inter', sans-serif;
}

.form-group textarea:focus,
.form-group select:focus {
  border-color: #8e2de2;
  outline: none;
  box-shadow: 0 0 0 3px rgba(142, 45, 226, 0.1);
}

.option-input {
  border: 1px solid #eee;
  border-radius: 8px;
  overflow: hidden;
}

.option-row {
  display: flex;
  align-items: center;
  padding: 10px;
  border-bottom: 1px solid #eee;
}

.option-row:last-child {
  border-bottom: none;
}

.option-letter {
  font-weight: bold;
  width: 24px;
  margin-right: 10px;
}

.option-row input {
  flex: 1;
  padding: 8px;
  border: 1px solid #ddd;
  border-radius: 6px;
  font-size: 14px;
}

.option-row input:focus {
  border-color: #8e2de2;
  outline: none;
}

.correct-answer-selector {
  display: flex;
  gap: 10px;
}

.answer-option {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: #f5f7fa;
  border: 2px solid #ddd;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  cursor: pointer;
  transition: all 0.2s ease;
}

.answer-option:hover {
  background: #eef2f7;
}

.answer-option.selected {
  background: #4a00e0;
  color: white;
  border-color: #4a00e0;
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
    grid-template-columns: 2fr 1fr 1fr 1fr auto;
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
      "pertanyaan pertanyaan"
      "topik kategori"
      "jawaban jawaban"
      "actions actions";
    gap: 15px;
    padding: 15px;
  }
  
  .table-cell:nth-child(1) {
    grid-area: pertanyaan;
  }
  
  .table-cell:nth-child(2) {
    grid-area: topik;
  }
  
  .table-cell:nth-child(3) {
    grid-area: kategori;
  }
  
  .table-cell:nth-child(4) {
    grid-area: jawaban;
  }
  
  .table-cell:nth-child(5) {
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
      "pertanyaan"
      "topik"
      "kategori"
      "jawaban"
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