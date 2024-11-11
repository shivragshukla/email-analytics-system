import { defineStore } from 'pinia';
import SendEmailService from '@/services/SendEmailService';

export const useSendEmailStore = defineStore('sendEmailStore', {
  state: () => ({
    sending: false,
    errors: null,
  }),

  actions: {
    async sendEmails(campaignId, recipientEmails) {
      this.sending = true;
      this.errors = null;
      try {
        const response = await SendEmailService.sendEmails(campaignId, recipientEmails);
        return response.data;
      } catch (error) {
          this.errors = error.response?.data?.message || 'Failed to send emails';
        throw error;
      } finally {
          this.sending = false;
      }
    },
  },
});
