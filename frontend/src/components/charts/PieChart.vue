<template>
  <div>
    <Pie :data="chartData" :options="chartOptions" />
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { Pie } from 'vue-chartjs';
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js';

ChartJS.register(ArcElement, Tooltip, Legend);

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
};
</script>

<style scoped>
</style>
