<script setup>
import { ref, computed, watch } from "vue";
import axios from "axios";

const searchQuery = ref("");
const courses = ref([]);
const loading = ref(false);

// Pagination states
const currentPage = ref(1);
const itemsPerPage = 1;

watch(searchQuery, async (newQuery) => {
  if (newQuery.length > 1) {
    loading.value = true;
    try {
      const response = await axios.get(`/api/courses/search?q=${newQuery}`);
      courses.value = response.data;
      currentPage.value = 1; // Reset ke halaman pertama saat pencarian baru
    } catch (error) {
      console.error("Error fetching courses:", error);
    } finally {
      loading.value = false;
    }
  } else {
    courses.value = [];
  }
});

// Computed untuk menampilkan data sesuai halaman
const paginatedCourses = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage;
  return courses.value.slice(start, start + itemsPerPage);
});

// Total halaman
const totalPages = computed(() => Math.ceil(courses.value.length / itemsPerPage));

// Navigasi Pagination
const nextPage = () => {
  if (currentPage.value < totalPages.value) {
    currentPage.value++;
  }
};

const prevPage = () => {
  if (currentPage.value > 1) {
    currentPage.value--;
  }
};
</script>

<template>
  <div class="search-container">
    <!-- Input Search -->
    <input
      v-model="searchQuery"
      type="text"
      placeholder="Search courses..."
      class="form-control search-input"
    />
    <span v-if="loading" class="loading-text">Loading...</span>

    <!-- Grid Layout untuk Cards -->
    <div v-if="paginatedCourses.length" class="course-grid">
      <div v-for="course in paginatedCourses" :key="course.id" class="course-card">
        <div class="card">
          <div class="card-image">
            <a :href="`/course/details/${course.id}/${course.course_name_slug}`">
                <img :src="`/${course.course_image}`" :alt="course.course_name" />
            </a>
            <div class="course-badges">
              <span v-if="course.bestseller" class="badge bestseller">Bestseller</span>
              <span v-if="course.highestrated" class="badge highestrated">Highestrated</span>
              <span v-if="course.discount_price === null" class="badge new">New</span>
              <span v-else class="badge discount">
                {{ Math.round((course.selling_price - course.discount_price) / course.selling_price * 100) }}%
              </span>
            </div>
          </div>
          <div class="card-body">
            <h5 class="course-title">
              <a :href="`/course/details/${course.id}/${course.course_name_slug}`">
                {{ course.course_name }}
              </a>
            </h5>
            <p class="instructor">
              <a :href="`/instructor/details/${course.instructor_id}`">
                {{ course.user?.name }}
              </a>
            </p>
            <div class="rating">
              <span class="rating-number">{{ (course.average_rating ?? 0).toFixed(1) }}</span>
              <span v-for="star in 5" :key="star" class="star" :class="star <= course.average_rating ? 'filled' : ''">★</span>
              <span class="review-count">({{ course.review_count }})</span>
            </div>
            <div class="price-container">
              <p class="price">
                <span v-if="course.discount_price === null">${{ course.selling_price }}</span>
                <span v-else>
                  ${{ course.discount_price }}
                  <span class="old-price">${{ course.selling_price }}</span>
                </span>
              </p>
              <button class="wishlist-btn" @click="addToWishlist(course.id)">
                <i class="la la-heart-o"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pagination Controls -->
    <div v-if="totalPages > 1" class="pagination">
      <button @click="prevPage" :disabled="currentPage === 1">Previous</button>
      <span>Page {{ currentPage }} of {{ totalPages }}</span>
      <button @click="nextPage" :disabled="currentPage === totalPages">Next</button>
    </div>

    <!-- Jika Tidak Ada Hasil -->
    <p v-else-if="searchQuery.length > 2 && !loading">No courses found.</p>
  </div>
</template>

<script>
function addToWishlist(courseId) {
  console.log("Added to wishlist:", courseId);
  // Implementasi wishlist bisa ditambahkan di sini
}
</script>

<style scoped>
.search-container {
  max-width: 800px;
  margin: auto;
  padding: 20px;
}

.search-input {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 15px;
}

.loading-text {
  display: block;
  text-align: center;
  color: #007bff;
}

.course-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 15px;
}

.course-card {
  background: #fff;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s;
}

.course-card:hover {
  transform: translateY(-5px);
}

.card {
  display: flex;
  flex-direction: column;
}

.card-image {
  position: relative;
}

.card-image img {
  width: 100%;
  height: 150px;
  object-fit: cover;
}

.course-badges {
  position: absolute;
  top: 10px;
  left: 10px;
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.badge {
  padding: 5px 10px;
  font-size: 12px;
  color: #fff;
  border-radius: 5px;
}

.bestseller {
  background: #ff9800;
}

.highestrated {
  background: #2196f3;
}

.new {
  background: #4caf50;
}

.discount {
  background: #e91e63;
}

.card-body {
  padding: 15px;
}

.course-title a {
  font-size: 16px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}

.course-title a:hover {
  color: #007bff;
}

.instructor a {
  font-size: 14px;
  color: #555;
  text-decoration: none;
}

.instructor a:hover {
  color: #007bff;
}

.rating {
  display: flex;
  align-items: center;
  margin-top: 10px;
}

.rating-number {
  font-size: 14px;
  font-weight: bold;
  margin-right: 5px;
}

.star {
  font-size: 14px;
  color: #ccc;
}

.filled {
  color: #ff9800;
}

.review-count {
  font-size: 12px;
  margin-left: 5px;
  color: #555;
}

.price-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 10px;
}

.price {
  font-size: 16px;
  font-weight: bold;
}

.old-price {
  text-decoration: line-through;
  color: #999;
  font-size: 14px;
  margin-left: 5px;
}

.wishlist-btn {
  background: none;
  border: none;
  cursor: pointer;
  font-size: 20px;
  color: #e91e63;
}

.wishlist-btn:hover {
  color: #c2185b;
}

.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
  margin-top: 10px;
}

.pagination button {
  padding: 5px 10px;
  border: 1px solid #ddd;
  background: #007bff;
  color: white;
  cursor: pointer;
  border-radius: 5px;
}

.pagination button:disabled {
  background: #ccc;
  cursor: not-allowed;
}

</style>
