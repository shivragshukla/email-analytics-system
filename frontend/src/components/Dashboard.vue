<script setup>
import axios from "axios";
import { onMounted } from "vue";


onMounted(async () => {
    const data = await axios.get("/api/user");
    console.log(data)
});
</script>
<template>
  <div class="max-w-7xl mx-auto">
  </div>
</template>