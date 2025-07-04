<template>
  <div class="app-container">
    <div class="header">
      <h1><i class="fas fa-book"></i> FORM INPUT MATERI PEMBELAJARAN</h1>
      <h1>INPUT MATERI</h1>
    </div>

    <div class="form-container">
      <div class="form-decoration"></div>
      <h2 class="form-title"><i class="fas fa-pen"></i> Formulir Materi Baru</h2>

      <div class="form-row">
        <div class="form-group">
          <label><i class="fas fa-heading"></i> JUDUL</label>
          <div class="input-wrapper">
            <i class="fas fa-heading input-icon"></i>
            <input v-model="judul" type="text" class="input" placeholder="Masukkan judul materi" />
          </div>
        </div>

        <div class="form-group">
          <label><i class="fas fa-tag"></i> LABEL</label>
          <div class="input-wrapper">
            <i class="fas fa-tag input-icon"></i>
            <input v-model="label" type="text" class="input" placeholder="Masukkan label/kategori" />
          </div>
        </div>
      </div>

      <div class="form-group">
        <label><i class="fas fa-align-left"></i> DESKRIPSI</label>
        <textarea v-model="deskripsi" class="textarea" placeholder="Deskripsi singkat materi"></textarea>
      </div>

      <div class="form-group">
        <label><i class="fas fa-file-alt"></i> KONTEN MATERI</label>
        <div class="editor-wrapper">
          <QuillEditor
            v-model:content="konten"
            content-type="html"
            theme="snow"
            :options="editorOptions"
          />
        </div>
      </div>

      <div class="form-group">
        <div class="file-upload-container" @click="triggerFileInput">
          <label class="file-upload-label">
            <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
            <span class="file-upload-text">Unggah File Pendukung</span>
            <span class="file-upload-hint">Klik untuk memilih file (PDF, DOC, Gambar) atau drag & drop file di sini</span>
            <input type="file" class="file-input" ref="fileInput" @change="handleFile" />
          </label>
        </div>
        <div v-if="gambar" class="file-info">
          <i class="fas fa-file"></i> {{ gambar.name }} ({{ formatFileSize(gambar.size) }})
        </div>
      </div>

      <div class="submit-button">
        <button @click="submit">
          <i class="fas fa-save"></i> Simpan Materi
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { useRouter } from 'vue-router';

const router = useRouter();

// Form fields
const judul = ref('');
const label = ref('');
const deskripsi = ref('');
const konten = ref('');
const gambar = ref(null);
const fileInput = ref(null);

// Editor options
const editorOptions = {
  modules: {
    toolbar: [
      [{ header: [1, 2, false] }],
      ['bold', 'italic', 'underline'],
      ['image', 'code-block']
    ]
  },
  placeholder: 'Tulis konten materi di sini...'
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

const formatFileSize = (size) => {
  const kb = size / 1024;
  if (kb < 1024) return `${kb.toFixed(1)} KB`;
  return `${(kb / 1024).toFixed(2)} MB`;
};

// Submit function
const submit = async () => {
  // Validasi sederhana
  if (!judul.value || !label.value || !deskripsi.value) {
    alert('Judul, label, dan deskripsi wajib diisi.');
    return;
  }

  const formData = new FormData();
  formData.append('judul', judul.value);
  formData.append('label', label.value);
  formData.append('deskripsi', deskripsi.value);
  formData.append('konten', konten.value || '');
  if (gambar.value) {
    formData.append('gambar', gambar.value);
  }

  const token = localStorage.getItem('auth_token');
  if (!token) {
    alert('Token tidak ditemukan. Anda harus login terlebih dahulu.');
    return;
  }

  try {
    const response = await axios.post('http://localhost:8000/api/materi', formData, {
      headers: {
        Authorization: `Bearer ${token}`,
        'Content-Type': 'multipart/form-data'
      }
    });

    console.log('Sukses:', response.data);
    alert('Materi berhasil disubmit!');
    // Redirect ke halaman manajemen materi
    router.push('/materi'); // Ubah path sesuai route kamu

    // Reset form
    judul.value = '';
    label.value = '';
    deskripsi.value = '';
    konten.value = '';
    gambar.value = null;
  } catch (error) {
    console.error('Gagal mengirim materi:', error);
    alert('Terjadi kesalahan saat mengirim data');
  }
};
</script>



<style scoped>
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
    
    .submit-button {
      display: flex;
      justify-content: flex-end;
      margin-top: 30px;
    }
    
    .submit-button button {
      padding: 16px 40px;
      background: linear-gradient(to right, #4361ee, #3a0ca3);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
      display: flex;
      align-items: center;
      gap: 12px;
      position: relative;
      overflow: hidden;
      z-index: 1;
    }
    
    .submit-button button::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
      transition: 0.5s;
      z-index: -1;
    }
    
    .submit-button button:hover::before {
      left: 100%;
    }
    
    .submit-button button:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(67, 97, 238, 0.4);
    }
    
    .submit-button button:active {
      transform: translateY(0);
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
    
    .notification {
      position: fixed;
      top: 20px;
      right: 20px;
      padding: 15px 25px;
      background: #4ade80;
      color: white;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
      display: flex;
      align-items: center;
      gap: 10px;
      z-index: 1000;
      transform: translateX(150%);
      transition: transform 0.3s ease;
    }
    
    .notification.show {
      transform: translateX(0);
    }
    
    .notification.error {
      background: #f87171;
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
      
      .submit-button button {
        width: 100%;
        justify-content: center;
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