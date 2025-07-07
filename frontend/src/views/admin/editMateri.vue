<template>
  <div class="app-container">
    <div class="header">
      <h1><i class="fas fa-book"></i> FORM EDIT MATERI PEMBELAJARAN</h1>
      <h1>EDIT MATERI</h1>
    </div>

    <div v-if="loading" class="loading-container">
      <div class="spinner"></div>
      <p>Memuat data materi...</p>
    </div>

    <div v-else class="form-container">
      <div class="form-decoration"></div>
      <h2 class="form-title"><i class="fas fa-edit"></i> Formulir Edit Materi</h2>

      <div class="form-row">
        <div class="form-group">
          <label><i class="fas fa-heading"></i> JUDUL</label>
          <div class="input-wrapper">
            <i class="fas fa-heading input-icon"></i>
            <input v-model="materi.judul" type="text" class="input" placeholder="Masukkan judul materi" />
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label><i class="fas fa-tag"></i> KATEGORI</label>
          <div class="input-wrapper">
            <i class="fas fa-tag input-icon"></i>
            <select v-model="materi.kategori_id" class="input" :disabled="loadingKategori">
              <option value="" disabled>Pilih Kategori</option>
              <option v-for="kategori in kategoriList" :key="kategori.id" :value="kategori.id">
                {{ kategori.nama }}
              </option>
            </select>
            <i v-if="loadingKategori" class="fas fa-spinner fa-spin input-icon-right"></i>
          </div>
        </div>

        <div class="form-group">
          <label><i class="fas fa-bookmark"></i> TOPIK</label>
          <div class="input-wrapper">
            <i class="fas fa-bookmark input-icon"></i>
            <select v-model="materi.topik_id" class="input" :disabled="loadingTopik">
              <option value="" disabled>Pilih Topik</option>
              <option v-for="topik in topikList" :key="topik.id" :value="topik.id">
                {{ topik.nama }}
              </option>
            </select>
            <i v-if="loadingTopik" class="fas fa-spinner fa-spin input-icon-right"></i>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label><i class="fas fa-align-left"></i> DESKRIPSI</label>
        <textarea v-model="materi.deskripsi" class="textarea" placeholder="Deskripsi singkat materi"></textarea>
      </div>

      <div class="form-group">
        <label><i class="fas fa-file-alt"></i> KONTEN MATERI</label>
        <div class="editor-wrapper">
          <QuillEditor
            v-model:content="materi.konten"
            content-type="html"
            theme="snow"
            :options="editorOptions"
          />
        </div>
      </div>

      <div class="form-group">
        <label><i class="fas fa-paperclip"></i> FILE PENDUKUNG</label>
        <div class="file-upload-container" @click="triggerFileInput">
          <label class="file-upload-label">
            <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
            <span class="file-upload-text">Unggah File Pendukung Baru</span>
            <span class="file-upload-hint">Klik untuk memilih file (PDF, DOC, Gambar) atau drag & drop file di sini</span>
            <input type="file" class="file-input" ref="fileInput" @change="handleFile" />
          </label>
        </div>
        <div v-if="gambar" class="file-info">
          <i class="fas fa-file"></i> {{ gambar.name }} ({{ formatFileSize(gambar.size) }})
          <button class="remove-file" @click="removeFile">
            <i class="fas fa-times"></i> Hapus
          </button>
        </div>
        <div v-else-if="materi.gambar" class="file-info">
          <i class="fas fa-file"></i> File saat ini: {{ materi.gambar }}
        </div>
      </div>

      <div class="action-buttons">
        <button class="cancel-btn" @click="cancelEdit">
          <i class="fas fa-times"></i> Batal
        </button>
        <button class="update-btn" @click="submit" :disabled="isSubmitting">
          <template v-if="isSubmitting">
            <i class="fas fa-spinner fa-spin"></i> Memperbarui...
          </template>
          <template v-else>
            <i class="fas fa-save"></i> Update Materi
          </template>
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { useRoute, useRouter } from 'vue-router';
import { useToast } from 'vue-toastification';

const route = useRoute();
const router = useRouter();
const toast = useToast();

// Data materi
const materi = ref({
  id: '',
  judul: '',
  kategori_id: '',
  topik_id: '',
  deskripsi: '',
  konten: '',
  gambar: ''
});

const gambar = ref(null);
const fileInput = ref(null);
const loading = ref(true);
const isSubmitting = ref(false);
const loadingKategori = ref(false);
const loadingTopik = ref(false);

// Data dropdown
const kategoriList = ref([]);
const topikList = ref([]);

// Editor options
const editorOptions = {
  modules: {
    toolbar: [
      [{ header: [1, 2, false] }],
      ['bold', 'italic', 'underline'],
      [{ list: 'ordered' }, { list: 'bullet' }],
      ['link', 'image', 'code-block']
    ]
  },
  placeholder: 'Tulis konten materi di sini...'
};

// Fetch kategori dari API
const fetchKategori = async () => {
  loadingKategori.value = true;
  try {
    const token = localStorage.getItem('auth_token');
    const response = await axios.get('http://localhost:8000/api/kategori', {
      headers: {
        Authorization: `Bearer ${token}`
      }
    });
    kategoriList.value = response.data;
  } catch (error) {
    console.error('Gagal mengambil data kategori:', error);
    toast.error('Gagal mengambil data kategori');
  } finally {
    loadingKategori.value = false;
  }
};

// Fetch topik dari API
const fetchTopik = async () => {
  loadingTopik.value = true;
  try {
    const token = localStorage.getItem('auth_token');
    const response = await axios.get('http://localhost:8000/api/topik', {
      headers: {
        Authorization: `Bearer ${token}`
      }
    });
    topikList.value = response.data;
  } catch (error) {
    console.error('Gagal mengambil data topik:', error);
    toast.error('Gagal mengambil data topik');
  } finally {
    loadingTopik.value = false;
  }
};

// File handling
const triggerFileInput = () => {
  fileInput.value.click();
};

const handleFile = (event) => {
  const file = event.target.files[0];
  if (file) {
    gambar.value = file;
  }
};

const removeFile = () => {
  gambar.value = null;
  materi.value.gambar = '';
};

const formatFileSize = (size) => {
  const kb = size / 1024;
  if (kb < 1024) return `${kb.toFixed(1)} KB`;
  return `${(kb / 1024).toFixed(2)} MB`;
};

// Load data materi
const loadMateri = async () => {
  try {
    const token = localStorage.getItem('auth_token');
    if (!token) {
      toast.error('Token tidak ditemukan. Anda harus login terlebih dahulu.');
      return;
    }

    const response = await axios.get(`http://localhost:8000/api/materi/${route.params.id}`, {
      headers: {
        Authorization: `Bearer ${token}`
      }
    });
    
    materi.value = response.data;
    loading.value = false;
  } catch (error) {
    console.error('Gagal memuat data materi:', error);
    toast.error('Gagal memuat data materi');
    loading.value = false;
  }
};

// Submit function untuk update
const submit = async () => {
  if (!materi.value.judul || !materi.value.kategori_id || !materi.value.topik_id || !materi.value.deskripsi) {
    toast.error('Judul, kategori, topik, dan deskripsi wajib diisi.');
    return;
  }

  isSubmitting.value = true;

  const formData = new FormData();
  formData.append('_method', 'PUT');
  formData.append('judul', materi.value.judul);
  formData.append('kategori_id', materi.value.kategori_id);
  formData.append('topik_id', materi.value.topik_id);
  formData.append('deskripsi', materi.value.deskripsi);
  formData.append('konten', materi.value.konten || '');

  if (gambar.value) {
    formData.append('gambar', gambar.value);
  }

  const token = localStorage.getItem('auth_token');
  if (!token) {
    toast.error('Token tidak ditemukan. Anda harus login terlebih dahulu.');
    isSubmitting.value = false;
    return;
  }

  try {
    const response = await axios.post(`http://localhost:8000/api/materi/${route.params.id}`, formData, {
      headers: {
        Authorization: `Bearer ${token}`,
        'Content-Type': 'multipart/form-data'
      }
    });

    toast.success('Materi berhasil diperbarui!');
    setTimeout(() => {
      router.push('/materi');
    }, 1500);
  } catch (error) {
    console.error('Gagal mengupdate materi:', error);
    
    let errorMessage = 'Terjadi kesalahan saat mengupdate materi';
    if (error.response && error.response.data && error.response.data.message) {
      errorMessage = error.response.data.message;
    }
    
    toast.error(errorMessage);
  } finally {
    isSubmitting.value = false;
  }
};

// Fungsi batal edit
const cancelEdit = () => {
  router.push('/materi');
};

onMounted(() => {
  loadMateri();
  fetchKategori();
  fetchTopik();
});
</script>

<style scoped>
/* Tambahkan style untuk input-icon-right */
.input-icon-right {
  position: absolute;
  right: 15px;
  top: 50%;
  transform: translateY(-50%);
  color: #94a3b8;
  font-size: 1.1rem;
}

/* Tambahkan style untuk select agar mirip dengan input */
.input-wrapper select.input {
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  background: #f8fafc;
  cursor: pointer;
}

/* Tambahkan style untuk loading spinner di button */
button:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

/* Style yang sudah ada sebelumnya tetap dipertahankan */
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
  background: linear-gradient(135deg, #f5f7fa 0%, #e2e7f0 100%);
  min-height: 100vh;
  padding: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.app-container {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 30px;
  padding: 20px 30px;
  background: linear-gradient(to right, #4361ee, #3a0ca3);
  color: white;
  border-radius: 16px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
  position: relative;
  overflow: hidden;
}

.header::before {
  content: '';
  position: absolute;
  top: -50px;
  right: -50px;
  width: 200px;
  height: 200px;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 50%;
}

.header::after {
  content: '';
  position: absolute;
  bottom: -30px;
  left: -30px;
  width: 100px;
  height: 100px;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 50%;
}

.header h1 {
  font-weight: 600;
  font-size: 1.8rem;
  display: flex;
  align-items: center;
  gap: 12px;
  z-index: 2;
}

.header i {
  background: rgba(255, 255, 255, 0.2);
  width: 50px;
  height: 50px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.4rem;
}

.form-container {
  background: white;
  border-radius: 16px;
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  padding: 40px;
  margin-bottom: 40px;
  position: relative;
}

.form-title {
  font-size: 1.8rem;
  color: #2c3e50;
  margin-bottom: 30px;
  padding-bottom: 20px;
  border-bottom: 2px solid #f0f4f8;
  display: flex;
  align-items: center;
  gap: 15px;
  position: relative;
}

.form-title::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100px;
  height: 3px;
  background: linear-gradient(to right, #4361ee, #3a0ca3);
  border-radius: 3px;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 30px;
  margin-bottom: 30px;
}

.form-group {
  margin-bottom: 25px;
  position: relative;
}

label {
  display: block;
  margin-bottom: 10px;
  font-weight: 600;
  color: #2c3e50;
  font-size: 1rem;
  display: flex;
  align-items: center;
  gap: 8px;
}

label i {
  color: #4361ee;
  font-size: 1.1rem;
}

.input-wrapper {
  position: relative;
}

.input, .textarea {
  width: 100%;
  padding: 16px 20px 16px 45px;
  border: 1px solid #dbe4f1;
  border-radius: 12px;
  font-size: 1rem;
  transition: all 0.3s ease;
  background: #f8fafc;
  color: #334155;
}

.input:focus, .textarea:focus {
  outline: none;
  border-color: #4361ee;
  box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
  background: white;
}

.input-icon {
  position: absolute;
  left: 15px;
  top: 50%;
  transform: translateY(-50%);
  color: #94a3b8;
  font-size: 1.1rem;
}

.textarea {
  min-height: 120px;
  resize: vertical;
  padding-left: 20px;
}

.editor-wrapper {
  margin: 20px 0;
  border: 1px solid #dbe4f1;
  border-radius: 12px;
  overflow: hidden;
  background: white;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.file-upload-container {
  background: #f0f7ff;
  border: 2px dashed #4361ee;
  border-radius: 12px;
  padding: 30px;
  text-align: center;
  margin: 30px 0;
  transition: all 0.3s;
  cursor: pointer;
  position: relative;
  overflow: hidden;
}

.file-upload-container:hover {
  background: #e1eeff;
  border-color: #3a0ca3;
}

.file-upload-label {
  display: flex;
  flex-direction: column;
  align-items: center;
  cursor: pointer;
  position: relative;
  z-index: 2;
}

.file-upload-icon {
  font-size: 2.8rem;
  color: #4361ee;
  margin-bottom: 15px;
}

.file-upload-text {
  font-size: 1.2rem;
  color: #4361ee;
  font-weight: 600;
  margin-bottom: 10px;
}

.file-upload-hint {
  color: #64748b;
  font-size: 0.95rem;
  max-width: 500px;
  margin: 0 auto;
}

.file-input {
  display: none;
}

.file-info {
  margin-top: 15px;
  padding: 12px 15px;
  background: #e1eeff;
  border-radius: 8px;
  display: flex;
  align-items: center;
  gap: 10px;
  font-weight: 500;
  color: #334155;
  border-left: 4px solid #4361ee;
}

.file-info i {
  color: #4361ee;
}

.remove-file {
  margin-left: auto;
  padding: 6px 12px;
  background: #f87171;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 5px;
  font-size: 0.9rem;
  transition: all 0.2s;
}

.remove-file:hover {
  background: #ef4444;
}

.action-buttons {
  display: flex;
  justify-content: flex-end;
  gap: 15px;
  margin-top: 30px;
}

.cancel-btn, .update-btn {
  padding: 16px 40px;
  border: none;
  border-radius: 12px;
  font-size: 1.1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  display: flex;
  align-items: center;
  gap: 12px;
  position: relative;
  overflow: hidden;
  z-index: 1;
}

.cancel-btn {
  background: #f1f5f9;
  color: #64748b;
}

.cancel-btn:hover {
  background: #e2e8f0;
  transform: translateY(-2px);
}

.update-btn {
  background: linear-gradient(to right, #4361ee, #3a0ca3);
  color: white;
}

.update-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(67, 97, 238, 0.4);
}

.form-decoration {
  position: absolute;
  width: 300px;
  height: 300px;
  border-radius: 50%;
  background: linear-gradient(135deg, rgba(67, 97, 238, 0.05) 0%, rgba(58, 12, 163, 0.05) 100%);
  top: -150px;
  right: -150px;
  z-index: 0;
}

@keyframes slideIn {
  from { transform: translateX(100%); opacity: 0; }
  to { transform: translateX(0); opacity: 1; }
}

.loading-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 40px;
  background: white;
  border-radius: 16px;
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
}

.spinner {
  width: 50px;
  height: 50px;
  border: 5px solid #f0f4f8;
  border-top: 5px solid #4361ee;
  border-radius: 50%;
  animation: spin 1s linear infinite;
  margin-bottom: 20px;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Responsiveness */
@media (max-width: 900px) {
  .form-row {
    grid-template-columns: 1fr;
    gap: 20px;
  }
  
  .header {
    flex-direction: column;
    text-align: center;
    gap: 15px;
    padding: 20px;
  }
  
  .header h1 {
    font-size: 1.5rem;
  }
  
  .form-container {
    padding: 25px;
  }
  
  .form-title {
    font-size: 1.5rem;
  }
  
  .action-buttons {
    flex-direction: column;
    gap: 10px;
  }
  
  .cancel-btn, .update-btn {
    width: 100%;
    justify-content: center;
  }
}

@media (max-width: 480px) {
  body {
    padding: 15px;
  }
  
  .app-container {
    padding: 0;
  }
  
  .form-container {
    padding: 20px 15px;
    border-radius: 12px;
  }
  
  .header {
    padding: 15px;
    border-radius: 12px;
  }
  
  .header h1 {
    font-size: 1.3rem;
  }
  
  .file-upload-container {
    padding: 20px;
  }
}
</style>