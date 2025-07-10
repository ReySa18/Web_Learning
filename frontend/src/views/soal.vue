<template>
  <div class="quiz-container">
    <!-- Navbar -->
    <div class="quiz-navbar">
      <button class="back-button" @click="goBack">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Kembali
      </button>
      <h1 class="quiz-title">{{ topic }} - {{ category }}</h1>
    </div>

    <div class="quiz-content">
      <!-- Overview Panel -->
      <div v-if="questions.length > 0 && !showResult" class="overview-panel">
        <h2 class="overview-title">Daftar Soal</h2>
        <div class="question-grid">
          <div 
            v-for="(question, index) in questions" 
            :key="question.id"
            class="question-card"
            :class="{
              'current': currentQuestionIndex === index,
              'answered': question.answered,
              'unanswered': !question.answered,
              'correct-answer': showAnswers && question.selected === question.correctAnswer,
              'wrong-answer': showAnswers && question.answered && question.selected !== question.correctAnswer
            }"
            @click="goToQuestion(index)"
          >
            {{ index + 1 }}
          </div>
        </div>
        <div class="progress-container">
          <div class="progress-bar">
            <div class="progress-fill" :style="{ width: progress + '%' }"></div>
          </div>
          <div class="progress-text">{{ answeredCount }} / {{ questions.length }} terjawab</div>
        </div>
      </div>

      <!-- Question Area -->
      <div v-if="questions.length > 0 && currentQuestion && !showResult" class="question-area">
        <div class="question-display">
          <div class="question-header">
            <div class="question-number">Soal {{ currentQuestionIndex + 1 }}</div>
            <div class="question-status" :class="currentQuestion.answered ? 'answered' : 'unanswered'">
              {{ currentQuestion.answered ? 'Terjawab' : 'Belum Dijawab' }}
            </div>
          </div>
          
          <div class="question-text">{{ currentQuestion.question }}</div>
          
          <div class="options-container">
            <div 
              v-for="(option, index) in currentQuestion.options" 
              :key="index"
              class="option-item"
              :class="{ 
                'selected': currentQuestion.selected === index,
                'correct': showAnswers && index === currentQuestion.correctAnswer,
                'incorrect': showAnswers && currentQuestion.selected === index && index !== currentQuestion.correctAnswer
              }"
              @click="selectOption(index)"
            >
              <div class="option-letter">{{ String.fromCharCode(65 + index) }}</div>
              <div class="option-text">{{ option }}</div>
            </div>
          </div>
        </div>

        <div class="question-navigation">
          <button 
            class="nav-button prev-button" 
            :disabled="currentQuestionIndex === 0"
            @click="prevQuestion"
          >
            Sebelumnya
          </button>
          <button 
            class="nav-button next-button" 
            :disabled="currentQuestionIndex === questions.length - 1"
            @click="nextQuestion"
          >
            Selanjutnya
          </button>
          <button 
            class="submit-button" 
            v-if="answeredCount === questions.length"
            @click="submitQuiz"
          >
            Selesaikan Latihan
          </button>
        </div>
      </div>

      <!-- Result Area -->
      <div v-if="showResult && !viewingAnswers" class="result-container">
        <h2 class="result-title">Hasil Latihan</h2>
        
        <div class="score-card">
          <div class="score-value">{{ score }}%</div>
          <div class="score-text">Skor Akhir</div>
          <div class="score-detail">
            <div class="detail-item">
              <span class="detail-label">Jawaban Benar:</span>
              <span class="detail-value">{{ correctAnswers }} / {{ questions.length }}</span>
            </div>
            <div class="detail-item">
              <span class="detail-label">Jawaban Salah:</span>
              <span class="detail-value">{{ questions.length - correctAnswers }} / {{ questions.length }}</span>
            </div>
          </div>
        </div>
        
        <div class="result-actions">
          <button class="review-button" @click="viewAnswers">
            Lihat Hasil Pengerjaan
          </button>
          <button class="restart-button" @click="restartQuiz">
            Latihan Ulang
          </button>
          <button class="exit-button" @click="goBack">
            Keluar
          </button>
        </div>
      </div>

      <!-- Review Answers Area -->
      <div v-if="viewingAnswers && showResult" class="review-container">
        <h2 class="review-title">Review Hasil Pengerjaan</h2>
        
        <div class="review-questions">
          <div v-for="(question, index) in questions" :key="index" class="review-question">
            <div class="review-question-header">
              <div class="review-question-number">Soal {{ index + 1 }}</div>
              <div class="review-status" :class="isAnswerCorrect(question) ? 'correct' : 'incorrect'">
                {{ isAnswerCorrect(question) ? 'Benar' : 'Salah' }}
              </div>
            </div>
            
            <div class="review-question-text">{{ question.question }}</div>
            
            <div class="review-options">
              <div 
                v-for="(option, optIndex) in question.options" 
                :key="optIndex"
                class="review-option"
                :class="{ 
                  'selected': question.selected === optIndex,
                  'correct': optIndex === question.correctAnswer,
                  'incorrect': question.selected === optIndex && optIndex !== question.correctAnswer
                }"
              >
                <div class="review-option-letter">{{ String.fromCharCode(65 + optIndex) }}</div>
                <div class="review-option-text">{{ option }}</div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="review-actions">
          <button class="back-to-result" @click="viewingAnswers = false">
            Kembali ke Hasil
          </button>
        </div>
      </div>

      <!-- Loading state -->
      <div v-else-if="loading" class="loading-state">
        <div class="loading-spinner"></div>
        <p>Memuat soal...</p>
      </div>

      <!-- Empty state -->
      <div v-else-if="questions.length === 0" class="empty-state">
        <div class="empty-illustration">
          <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="8" x2="12" y2="12"></line>
            <line x1="12" y1="16" x2="12.01" y2="16"></line>
          </svg>
        </div>
        <p class="empty-message">Tidak ada soal untuk kategori dan topik ini</p>
        <button class="back-button" @click="goBack">Kembali</button>
      </div>
    </div>

    <!-- Notification -->
    <div v-if="notification.show" class="notification" :class="notification.type">
      {{ notification.message }}
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'QuizPage',
  data() {
    return {
      topic: "",
      category: '',
      currentQuestionIndex: 0,
      showAnswers: false,
      showResult: false,
      viewingAnswers: false,
      loading: true,
      notification: {
        show: false,
        message: '',
        type: ''
      },
      questions: [],
      score: 0,
      correctAnswers: 0
    };
  },
  computed: {
    currentQuestion() {
      return this.questions[this.currentQuestionIndex];
    },
    answeredCount() {
      return this.questions.filter(q => q.answered).length;
    },
    progress() {
      return (this.answeredCount / this.questions.length) * 100;
    }
  },
  methods: {
    async fetchQuestions() {
      try {
        this.loading = true;
        this.questions = [];

        // Ambil parameter dari route
        const kategoriId = this.$route.params.kategori_id;
        const topikId = this.$route.params.topik_id;

        // Fetch soal berdasarkan kategori_id dan topik_id
        const response = await axios.get(`http://localhost:8000/api/soal?kategori_id=${kategoriId}&topik_id=${topikId}`);
        const soalList = response.data.data; 

        // Set judul topik dari soal pertama
        if (soalList.length > 0) {
          this.topic = soalList[0].topik.nama;
          this.category = soalList[0].kategori.nama;
        }

        // Transformasi struktur data
        this.questions = soalList.map(soal => ({
          id: soal.id,
          question: soal.pertanyaan,
          options: [
            soal.opsi_a,
            soal.opsi_b,
            soal.opsi_c,
            soal.opsi_d
          ],
          answered: false,
          selected: null,
          correctAnswer: this.getCorrectIndex(soal.jawaban_benar),
        }));

      } catch (error) {
        console.error('Error fetching questions:', error);
        this.showNotification('Gagal memuat soal', 'error');
      } finally {
        this.loading = false;
      }
    },
    async saveResultToServer() {
      try {
        const user = JSON.parse(localStorage.getItem('user'));
        if (!user || !user.id) {
          this.showNotification('User tidak ditemukan. Harap login ulang.', 'error');
          return;
        }

        const payload = {
          user_id: user.id,
          kategori_id: parseInt(this.$route.params.kategori_id),
          topik_id: parseInt(this.$route.params.topik_id),
          skor: this.score,
          jumlah_benar: this.correctAnswers,
          jumlah_salah: this.questions.length - this.correctAnswers,
          tanggal_latihan: new Date().toISOString().split('T')[0] // Format: yyyy-mm-dd
        };

        const token = localStorage.getItem('auth_token');

        const response = await axios.post('http://localhost:8000/api/hasil-latihan', payload, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });

        console.log('Hasil latihan berhasil disimpan:', response.data);

      } catch (error) {
        console.error('Gagal menyimpan hasil:', error);
        this.showNotification('Gagal menyimpan hasil latihan', 'error');
      }
    },
    getCorrectIndex(jawaban) {
      const map = { 'A': 0, 'B': 1, 'C': 2, 'D': 3 };
      const index = map[jawaban?.toUpperCase()];
      if (index === undefined) {
        console.warn(`Jawaban tidak valid: "${jawaban}"`);
        return -1;
      }
      return index;
    },
    goBack() {
      this.$router.push('/kuis');
    },
    goToQuestion(index) {
      this.currentQuestionIndex = index;
    },
    prevQuestion() {
      if (this.currentQuestionIndex > 0) {
        this.currentQuestionIndex--;
      }
    },
    nextQuestion() {
      if (this.currentQuestionIndex < this.questions.length - 1) {
        this.currentQuestionIndex++;
      }
    },
    selectOption(index) {
      if (this.showAnswers || this.viewingAnswers) return; // Tidak bisa pilih jika sudah submit
      
      this.currentQuestion.selected = index;
      this.currentQuestion.answered = true;
    },
    submitQuiz() {
      this.showAnswers = true;
      this.calculateScore();

      setTimeout(() => {
        this.showResult = true;
        this.showNotification(`Latihan berhasil diselesaikan! Skor: ${this.score}%`, "success");

        // Simpan hasil latihan ke backend
        this.saveResultToServer();

      }, 100);
    },
    calculateScore() {
      let correctCount = 0;
      this.questions.forEach(question => {
        if (question.selected === question.correctAnswer) {
          correctCount++;
        }
      });
      
      this.correctAnswers = correctCount;
      this.score = Math.round((correctCount / this.questions.length) * 100);
    },
    restartQuiz() {
      // Reset state kuis
      this.currentQuestionIndex = 0;
      this.showAnswers = false;
      this.showResult = false;
      this.viewingAnswers = false;
      this.score = 0;
      this.correctAnswers = 0;
      
      // Reset jawaban user
      this.questions.forEach(question => {
        question.answered = false;
        question.selected = null;
      });
      
      this.showNotification("Latihan dimulai ulang", "info");
    },
    viewAnswers() {
      this.viewingAnswers = true;
    },
    isAnswerCorrect(question) {
      return question.selected === question.correctAnswer;
    },
    showNotification(message, type) {
      this.notification = {
        show: true,
        message,
        type
      };
      
      setTimeout(() => {
        this.notification.show = false;
      }, 3000);
    }
  },
  mounted() {
    this.fetchQuestions();
  }
};
</script>

<style>
.vue-app, [data-v-app] {
  margin: 0 !important;
  padding: 0 !important;
}

.quiz-container {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  width: 100vw;
  background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #000000 100%);
  color: #ffffff;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.quiz-navbar {
  display: flex;
  align-items: center;
  padding: 20px;
  background: rgba(10, 10, 10, 0.8);
  border-bottom: 1px solid #333;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
  position: sticky;
  top: 0;
  z-index: 100;
}

.back-button {
  display: flex;
  align-items: center;
  gap: 8px;
  background: linear-gradient(to right, #4a00e0, #8e2de2);
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 50px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.back-button:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 15px rgba(142, 45, 226, 0.4);
}

.back-button:active {
  transform: translateY(0);
}

.quiz-title {
  flex: 1;
  text-align: center;
  margin: 0;
  font-size: 1.8rem;
  font-weight: 700;
  letter-spacing: 0.5px;
  background: linear-gradient(to right, #00c6ff, #0072ff);
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.quiz-content {
  display: flex;
  flex: 1;
  padding: 20px;
  gap: 20px;
  max-width: 1400px;
  margin: 0 auto;
  width: 100%;
}

.overview-panel {
  flex: 0 0 280px;
  background: rgba(30, 30, 30, 0.8);
  border-radius: 15px;
  padding: 20px;
  border: 1px solid #333;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
  backdrop-filter: blur(5px);
  display: flex;
  flex-direction: column;
}

.overview-title {
  margin-top: 0;
  margin-bottom: 20px;
  font-size: 1.4rem;
  color: #e0e0e0;
  text-align: center;
  padding-bottom: 10px;
  border-bottom: 1px solid #444;
}

.question-grid {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 12px;
  margin-bottom: 20px;
}

.question-card {
  display: flex;
  align-items: center;
  justify-content: center;
  aspect-ratio: 1;
  border-radius: 10px;
  font-weight: 700;
  font-size: 1.2rem;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.question-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}

.unanswered {
  background: rgba(60, 60, 60, 0.7);
  border: 2px solid #444;
  color: #aaa;
}

.answered {
  background: linear-gradient(135deg, #00b09b, #96c93d);
  color: white;
  border: 2px solid #00b09b;
}

.current {
  background: linear-gradient(135deg, #2193b0, #6dd5ed);
  color: white;
  border: 2px solid #2193b0;
  transform: scale(1.1);
  box-shadow: 0 0 20px rgba(33, 147, 176, 0.5);
}

.progress-container {
  margin-top: auto;
}

.progress-bar {
  height: 10px;
  background: #333;
  border-radius: 5px;
  overflow: hidden;
  margin-bottom: 10px;
}

.progress-fill {
  height: 100%;
  background: linear-gradient(to right, #4facfe, #00f2fe);
  border-radius: 5px;
  transition: width 0.5s ease;
}

.progress-text {
  text-align: center;
  font-size: 0.9rem;
  color: #aaa;
}

.question-area {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.question-display {
  background: rgba(30, 30, 30, 0.8);
  border-radius: 15px;
  padding: 30px;
  border: 1px solid #333;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
  backdrop-filter: blur(5px);
  flex: 1;
}

.question-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 25px;
  padding-bottom: 15px;
  border-bottom: 1px solid #444;
}

.question-number {
  font-size: 1.6rem;
  font-weight: 700;
  color: #4facfe;
}

.question-status {
  padding: 6px 15px;
  border-radius: 20px;
  font-size: 0.9rem;
  font-weight: 600;
}

.answered {
  background: rgba(0, 176, 155, 0.2);
  color: #00b09b;
}

.unanswered {
  background: rgba(255, 100, 100, 0.2);
  color: #ff6464;
}

.question-text {
  font-size: 1.3rem;
  line-height: 1.6;
  margin-bottom: 30px;
  color: #e0e0e0;
}

.options-container {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.option-item {
  display: flex;
  align-items: center;
  padding: 18px 20px;
  border-radius: 12px;
  background: rgba(50, 50, 50, 0.7);
  border: 2px solid #444;
  cursor: pointer;
  transition: all 0.3s ease;
}

.option-item:hover {
  background: rgba(70, 70, 70, 0.7);
  transform: translateX(5px);
}

.selected {
  background: rgba(33, 147, 176, 0.2);
  border-color: #2193b0;
  box-shadow: 0 0 15px rgba(33, 147, 176, 0.3);
}

.correct {
  background: rgba(0, 176, 155, 0.2);
  border-color: #00b09b;
  box-shadow: 0 0 15px rgba(0, 176, 155, 0.3);
}

.option-letter {
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #444;
  border-radius: 50%;
  margin-right: 15px;
  font-weight: 700;
  font-size: 1.1rem;
}

.selected .option-letter, .correct .option-letter {
  background: linear-gradient(135deg, #2193b0, #6dd5ed);
  color: white;
}

.option-text {
  font-size: 1.1rem;
  line-height: 1.5;
}

.question-navigation {
  display: flex;
  justify-content: space-between;
  gap: 15px;
}

.nav-button, .submit-button {
  padding: 14px 30px;
  border: none;
  border-radius: 50px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.prev-button {
  background: linear-gradient(to right, #8e2de2, #4a00e0);
  color: white;
}

.next-button {
  background: linear-gradient(to right, #00c6ff, #0072ff);
  color: white;
  margin-left: auto;
}

.submit-button {
  background: linear-gradient(to right, #00b09b, #96c93d);
  color: white;
  margin-left: 10px;
}

.nav-button:hover, .submit-button:hover {
  transform: translateY(-3px);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.nav-button:disabled, .submit-button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  transform: none;
  box-shadow: none;
}

.notification {
  position: fixed;
  bottom: 30px;
  left: 50%;
  transform: translateX(-50%);
  padding: 15px 30px;
  border-radius: 50px;
  font-weight: 600;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
  z-index: 1000;
  animation: fadeInOut 3s forwards;
}

@keyframes fadeInOut {
  0% { opacity: 0; bottom: 0; }
  10% { opacity: 1; bottom: 30px; }
  90% { opacity: 1; bottom: 30px; }
  100% { opacity: 0; bottom: 0; }
}

.success {
  background: linear-gradient(to right, #00b09b, #96c93d);
  color: white;
}

.info {
  background: linear-gradient(to right, #4a00e0, #8e2de2);
  color: white;
}

.loading-state, .empty-state {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  color: #aaa;
  font-size: 1.2rem;
}

.empty-state button {
  margin-top: 20px;
  padding: 10px 20px;
  background: linear-gradient(to right, #4a00e0, #8e2de2);
  color: white;
  border: none;
  border-radius: 50px;
  cursor: pointer;
}

/* Result Container */
.result-container {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 30px;
  text-align: center;
}

.result-title {
  font-size: 2rem;
  margin-bottom: 30px;
  color: #4facfe;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.score-card {
  background: rgba(30, 30, 30, 0.8);
  border-radius: 20px;
  padding: 40px;
  width: 100%;
  max-width: 500px;
  border: 1px solid #333;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
  backdrop-filter: blur(5px);
  margin-bottom: 40px;
}

.score-value {
  font-size: 4rem;
  font-weight: 800;
  margin-bottom: 10px;
  background: linear-gradient(to right, #00b09b, #96c93d);
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
}

.score-text {
  font-size: 1.5rem;
  color: #aaa;
  margin-bottom: 30px;
}

.score-detail {
  display: flex;
  justify-content: space-around;
  gap: 20px;
  margin-top: 30px;
}

.detail-item {
  flex: 1;
  padding: 15px;
  border-radius: 10px;
  background: rgba(40, 40, 40, 0.7);
}

.detail-label {
  display: block;
  font-size: 0.9rem;
  color: #aaa;
  margin-bottom: 5px;
}

.detail-value {
  display: block;
  font-size: 1.5rem;
  font-weight: 700;
}

.result-actions {
  display: flex;
  flex-direction: column;
  gap: 15px;
  width: 100%;
  max-width: 500px;
}

.review-button {
  background: linear-gradient(to right, #4a00e0, #8e2de2);
  color: white;
  padding: 16px 30px;
  border: none;
  border-radius: 50px;
  font-size: 1.1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.restart-button {
  background: linear-gradient(to right, #00c6ff, #0072ff);
  color: white;
  padding: 16px 30px;
  border: none;
  border-radius: 50px;
  font-size: 1.1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.exit-button {
  background: linear-gradient(to right, #ff416c, #ff4b2b);
  color: white;
  padding: 16px 30px;
  border: none;
  border-radius: 50px;
  font-size: 1.1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.review-button:hover, .restart-button:hover, .exit-button:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
}

/* Option incorrect style */
.incorrect {
  background: rgba(255, 100, 100, 0.2);
  border-color: #ff6464;
  box-shadow: 0 0 15px rgba(255, 100, 100, 0.3);
}

.incorrect .option-letter {
  background: linear-gradient(135deg, #ff416c, #ff4b2b);
  color: white;
}

/* Review Container */
.review-container {
  flex: 1;
  padding: 20px;
  overflow-y: auto;
}

.review-title {
  text-align: center;
  font-size: 1.8rem;
  margin-bottom: 20px;
  color: #4facfe;
}

.review-questions {
  display: flex;
  flex-direction: column;
  gap: 30px;
  max-width: 800px;
  margin: 0 auto;
}

.review-question {
  background: rgba(30, 30, 30, 0.8);
  border-radius: 15px;
  padding: 25px;
  border: 1px solid #333;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
}

.review-question-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
  padding-bottom: 15px;
  border-bottom: 1px solid #444;
}

.review-question-number {
  font-size: 1.4rem;
  font-weight: 700;
  color: #4facfe;
}

.review-status {
  padding: 6px 15px;
  border-radius: 20px;
  font-size: 0.9rem;
  font-weight: 600;
}

.review-status.correct {
  background: rgba(0, 176, 155, 0.2);
  color: #00b09b;
}

.review-status.incorrect {
  background: rgba(255, 100, 100, 0.2);
  color: #ff6464;
}

.review-question-text {
  font-size: 1.2rem;
  line-height: 1.6;
  margin-bottom: 20px;
  color: #e0e0e0;
}

.review-options {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.review-option {
  display: flex;
  align-items: center;
  padding: 15px;
  border-radius: 10px;
  background: rgba(50, 50, 50, 0.7);
  border: 2px solid #444;
}

.review-option.correct {
  background: rgba(0, 176, 155, 0.2);
  border-color: #00b09b;
}

.review-option.incorrect {
  background: rgba(255, 100, 100, 0.2);
  border-color: #ff6464;
}

.review-option.selected {
  background: rgba(33, 147, 176, 0.2);
  border-color: #2193b0;
}

.review-option-letter {
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #444;
  border-radius: 50%;
  margin-right: 12px;
  font-weight: 700;
  font-size: 1rem;
}

.review-option.correct .review-option-letter {
  background: linear-gradient(135deg, #00b09b, #96c93d);
  color: white;
}

.review-option.incorrect .review-option-letter {
  background: linear-gradient(135deg, #ff416c, #ff4b2b);
  color: white;
}

.review-option.selected .review-option-letter {
  background: linear-gradient(135deg, #2193b0, #6dd5ed);
  color: white;
}

.review-option-text {
  font-size: 1rem;
  line-height: 1.5;
}

.review-actions {
  display: flex;
  justify-content: center;
  margin-top: 30px;
}

.back-to-result {
  background: linear-gradient(to right, #4a00e0, #8e2de2);
  color: white;
  padding: 12px 25px;
  border: none;
  border-radius: 50px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.back-to-result:hover {
  transform: translateY(-3px);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

/* Loading state */
.loading-state {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  color: #aaa;
  font-size: 1.2rem;
}

.loading-spinner {
  width: 50px;
  height: 50px;
  border: 5px solid rgba(255, 255, 255, 0.1);
  border-radius: 50%;
  border-top: 5px solid #4facfe;
  animation: spin 1s linear infinite;
  margin-bottom: 20px;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Empty state */
.empty-state {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 30px;
}

.empty-illustration {
  margin-bottom: 20px;
}

.empty-illustration svg {
  stroke: #4facfe;
}

.empty-message {
  font-size: 1.3rem;
  color: #aaa;
  margin-bottom: 25px;
  max-width: 400px;
}

.empty-state .back-button {
  background: linear-gradient(to right, #4a00e0, #8e2de2);
  color: white;
  padding: 10px 25px;
  font-size: 1rem;
}

/* Class untuk kartu soal di overview */
.correct-answer {
  background: linear-gradient(135deg, #00b09b, #96c93d);
  border: 2px solid #00b09b;
}

.wrong-answer {
  background: linear-gradient(135deg, #ff416c, #ff4b2b);
  border: 2px solid #ff416c;
}

/* Responsive Design */
@media (max-width: 992px) {
  .quiz-content {
    flex-direction: column;
  }
  
  .overview-panel {
    flex: 0 0 auto;
  }
  
  .question-grid {
    grid-template-columns: repeat(10, 1fr);
    overflow-x: auto;
    padding: 10px 0;
  }
  
  .question-card {
    min-width: 45px;
  }
}

@media (max-width: 768px) {
  .quiz-navbar {
    padding: 15px;
  }
  
  .quiz-title {
    font-size: 1.5rem;
  }
  
  .back-button {
    padding: 8px 15px;
    font-size: 0.9rem;
  }
  
  .question-display {
    padding: 20px;
  }
  
  .question-text {
    font-size: 1.1rem;
  }
  
  .option-text {
    font-size: 1rem;
  }
  
  .question-navigation {
    flex-wrap: wrap;
  }
  
  .nav-button, .submit-button {
    padding: 12px 20px;
    font-size: 0.9rem;
    flex: 1;
    min-width: 120px;
  }
  
  .question-grid {
    grid-template-columns: repeat(5, 1fr);
  }

  .score-card {
    padding: 30px 20px;
  }
  
  .score-value {
    font-size: 3rem;
  }
  
  .result-actions {
    flex-direction: column;
  }
  
  .score-detail {
    flex-direction: column;
  }
}

@media (max-width: 480px) {
  .quiz-content {
    padding: 15px;
  }
  
  .overview-panel {
    padding: 15px;
  }
  
  .question-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
  }
  
  .question-status {
    align-self: flex-start;
  }
  
  .question-grid {
    grid-template-columns: repeat(5, 1fr);
    gap: 8px;
  }
  
  .question-card {
    font-size: 1rem;
  }
  
  .option-item {
    padding: 14px;
  }
  
  .option-letter {
    width: 30px;
    height: 30px;
    margin-right: 12px;
  }

  .result-title {
    font-size: 1.8rem;
  }
  
  .score-value {
    font-size: 2.5rem;
  }
  
  .score-text {
    font-size: 1.2rem;
  }
  
  .review-question {
    padding: 15px;
  }
}
</style>