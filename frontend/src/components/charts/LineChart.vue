<template>
  <div>
    <Line :data="chartData" :options="chartOptions" />
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { Line } from 'vue-chartjs';
import { Chart as ChartJS, LineElement, PointElement, CategoryScale, LinearScale, Tooltip, Legend } from 'chart.js';

// Register the necessary components
ChartJS.register(LineElement, PointElement, CategoryScale, LinearScale, Tooltip, Legend);

const props = defineProps({
  campaignData: {
    type: Object,
    required: true,
  },
});

const chartData = computed(() => ({
  labels: ['Sent', 'Delivered', 'Opened'],
  datasets: [
    {
      label: 'Emails',
      data: [
        props.campaignData.emails_sent,
        props.campaignData.emails_delivered,
        props.campaignData.emails_opened,
      ],
      borderColor: '#3B82F6',
      backgroundColor: '#BFDBFE',
      fill: true,
    },
  ],
}));

const chartOptions = {
  responsive: true,
  maintainAspectRatio: false,
  scales: {
    y: {
      beginAtZero: true,
    },
  },
};
</script>

<style scoped>
</style>
