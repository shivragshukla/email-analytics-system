<template>
  <div class="p-4">
    <h2 class="text-2xl font-bold mb-4">Reporting Dashboard</h2>

    <!-- Campaign Selector Dropdown -->
    <div class="mb-4">
      <label for="campaignSelect" class="block text-sm font-medium text-gray-700">Select Campaign:</label>
      <select
        id="campaignSelect"
        class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        v-model="selectedCampaignId"
        @change="handleCampaignChange"
      >
        <option value="" disabled>Select a campaign</option>
        <option v-for="campaign in metrics" :key="campaign.id" :value="campaign.id">{{ campaign.name }}</option>
      </select>
    </div>

    <!-- Loading and error messages -->
    <div v-if="loading" class="text-gray-500">Loading...</div>
    <div v-else-if="error" class="text-red-500">{{ error }}</div>

    <!-- Display Charts for Selected Campaign -->
    <div v-if="selectedCampaign" class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-white rounded-lg shadow-md p-4">
        <h3 class="text-xl font-semibold mb-2">Bar Chart</h3>
        <BarChart :campaignData="selectedCampaign" />
      </div>
      <div class="bg-white rounded-lg shadow-md p-4">
        <h3 class="text-xl font-semibold mb-2">Pie Chart</h3>
        <PieChart :campaignData="selectedCampaign" />
      </div>
      <div class="bg-white rounded-lg shadow-md p-4">
        <h3 class="text-xl font-semibold mb-2">Line Chart</h3>
        <LineChart :campaignData="selectedCampaign" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { storeToRefs } from 'pinia';
import { useCampaignMetricsStore } from '@/stores/campaignMetricsStore';
import BarChart from './charts/BarChart.vue';
import PieChart from './charts/PieChart.vue';
import LineChart from './charts/LineChart.vue';

const campaignMetricsStore = useCampaignMetricsStore();
const { fetchMetrics, selectCampaign } = campaignMetricsStore;
const { metrics, selectedCampaign, loading, error } = storeToRefs(useCampaignMetricsStore());

const selectedCampaignId = ref('');

const handleCampaignChange = () => {
  selectCampaign(selectedCampaignId.value);
};

onMounted(() => {
  fetchMetrics();
});
</script>

<style scoped>
</style>
