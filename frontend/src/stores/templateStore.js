import { defineStore } from 'pinia';
import TemplateService from '@/services/TemplateService';

export const useTemplateStore = defineStore('templateStore', {
  state: () => ({
    templates: [],
    selectedTemplate: null,
    loading: false,
    errors: {},
  }),

  actions: {
    async fetchTemplates() {
      this.loading = true;
      try {
        const response = await TemplateService.getTemplates();
        this.templates = response.data.data;
        this.errors = {}
      } catch (error) {
        this.errors = error.response.data.errors;
        console.error(error);
      } finally {
        this.loading = false;
      }
    },

    async createTemplate(data) {
      try {
        const response = await TemplateService.createTemplate(data);
        this.templates.push(response.data.data);
        this.errors = {}
      } catch (error) {
        this.errors = error.response.data.errors
        console.error(error);
      }
    },

    async updateTemplate(id, data) {
      try {
        const response = await TemplateService.updateTemplate(id, data);
        const index = this.templates.findIndex((t) => t.id === id);
        if (index !== -1) {
          this.templates[index] = response.data.data;
        }
        this.errors = {}
      } catch (error) {
        this.errors = error.response.data.errors;
        console.error(error);
      }
    },

    async deleteTemplate(id) {
      try {
        await TemplateService.deleteTemplate(id);
        this.templates = this.templates.filter((t) => t.id !== id);
        this.errors = {}
    } catch (error) {
        this.errors = error.response.data.errors;
        console.error(error);
      }
    },

    setSelectedTemplate(template) {
      this.selectedTemplate = template;
    },

    resetSelectedTemplate() {
      this.selectedTemplate = null;
    },
  },
});
