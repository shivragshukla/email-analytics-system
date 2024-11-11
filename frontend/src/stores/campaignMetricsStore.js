// src/stores/campaignMetricsStore.js

import { defineStore } from 'pinia';
import axios from 'axios';

export const useCampaignMetricsStore = defineStore('campaignMetrics', {
  state: () => ({
    metrics: [],
    selectedCampaign: null,
    loading: false,
    error: null,
  }),

  actions: {
    async fetchMetrics() {
      this.selectedCampaign =  null;
      this.loading = true;
      this.error = null;
      try {
        const response = await axios.get('/api/report/campaign-metrics');
        this.metrics = response.data.data;
      } catch (error) {
        this.error = error.message || 'Failed to fetch metrics';
      } finally {
        this.loading = false;
      }
    },

    selectCampaign(campaignId) {
      this.selectedCampaign = this.metrics.find((campaign) => campaign.id === campaignId) || null;
    },
  },
});
