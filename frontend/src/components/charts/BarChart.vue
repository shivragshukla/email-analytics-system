<template>
  <div>
    <Bar :data="chartData" :options="chartOptions" />
  </div>
</template>

<script setup>
import { computed, watch } from 'vue';
import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, BarElement, CategoryScale, LinearScale, Tooltip, Legend } from 'chart.js';

ChartJS.register(BarElement, CategoryScale, LinearScale, Tooltip, Legend);

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
      backgroundColor: ['#4B5563', '#10B981', '#3B82F6'],
    },
  ],
}));

const chartOptions = {
  responsive: true,
  maintainAspectRatio: false,
  scales: {
    y: {
      beginAtZero: true,
      ticks: {
        stepSize: 1,
      },
    },
  },
};
</script>

<style scoped>
</style>
