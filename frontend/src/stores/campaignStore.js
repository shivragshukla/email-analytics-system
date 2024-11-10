import { defineStore } from 'pinia';
import CampaignService from '@/services/CampaignService';

export const useCampaignStore = defineStore('campaignStore', {
  state: () => ({
    campaigns: [],
    selectedCampaign: null,
    loading: false,
    errors: {},
  }),

  actions: {
    async fetchCampaigns() {
      this.loading = true;
      try {
        const response = await CampaignService.getCampaigns();
        this.campaigns = response.data.data;
        this.errors = {}
      } catch (error) {
        this.errors = error.response.data.errors;
        console.error(error);
      } finally {
        this.loading = false;
      }
    },

    async createCampaign(data) {
      try {
        const response = await CampaignService.createCampaign(data);
        this.campaigns.push(response.data.data);
        this.errors = {}
      } catch (error) {
        this.errors = error.response.data.errors
        console.error(error);
      }
    },

    async updateCampaign(id, data) {
      try {
        const response = await CampaignService.updateCampaign(id, data);
        const index = this.campaigns.findIndex((t) => t.id === id);
        if (index !== -1) {
          this.campaigns[index] = response.data.data;
        }
        this.errors = {}
      } catch (error) {
        this.errors = error.response.data.errors;
        console.error(error);
      }
    },

    async deleteCampaign(id) {
      try {
        await CampaignService.deleteCampaign(id);
        this.campaigns = this.campaigns.filter((t) => t.id !== id);
        this.errors = {}
    } catch (error) {
        this.errors = error.response.data.errors;
        console.error(error);
      }
    },

    setSelectedCampaign(campaign) {
      this.selectedCampaign = campaign;
    },

    resetSelectedCampaign() {
      this.selectedCampaign = null;
    },
  },
});
