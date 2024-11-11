<template>
    <div class="mt-4 p-6 max-w-lg mx-auto bg-white rounded-xl shadow-md space-y-4">
        <h2 class="text-xl font-bold">Send Campaign Emails</h2>
  
        <!-- Campaign Selection Dropdown -->
        <div class="mb-4">
            <label class="block mb-1">Select Campaign</label>
            <select v-model="selectedCampaign" class="w-full border rounded px-3 py-2">
            <option disabled value="">Select a campaign</option>
            <option v-for="campaign in campaigns" :key="campaign.id" :value="campaign.id">
                {{ campaign.name }}
            </option>
            </select>
        </div>
        <!-- Recipient Emails Input -->
        <div class="mb-4">
            <label class="block mb-1">Recipient Emails</label>
            <input v-model="recipientEmails" type="text" placeholder="Enter emails, separated by commas" class="w-full border rounded px-3 py-2">
            <p class="text-xs text-gray-500">Separate multiple emails with commas.</p>
        </div>
      
        <!-- Send Button -->
        <button
            @click="sendEmail"
            :disabled="sending || !selectedCampaign || !recipientEmails"
            class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 disabled:bg-gray-300"
        >
            <span v-if="sending">Sending...</span>
            <span v-else>Send Emails</span>
        </button>
  
        <!-- Error Message -->
        <p v-if="sendError" class="text-red-500 text-sm mt-2">{{ sendError }}</p>
    </div>
  </template>
  
  <script>
  import { ref, onMounted } from 'vue';
  import { useCampaignStore } from '@/stores/campaignStore';
  import { useSendEmailStore } from '@/stores/sendEmailStore';
  import { storeToRefs } from 'pinia';
  
  export default {
    setup() {
      const campaignStore = useCampaignStore();
      const sendEmailStore = useSendEmailStore();

      const { sendEmails } = sendEmailStore;

       const { fetchCampaigns } = campaignStore;
       const { campaigns } = storeToRefs(useCampaignStore());
       const { errors } = storeToRefs(useSendEmailStore());

      const selectedCampaign = ref('');
      const recipientEmails = ref('');
      const sending = ref(false);
      const sendError = ref(null);
  
      onMounted(() => {
        fetchCampaigns();
      });
  
      const sendEmail = async () => {
        try {
          sending.value = true;
          sendError.value = null;
          await sendEmails(
            selectedCampaign.value,
            {recipients : recipientEmails.value},
            //recipientEmails.value.split(',').map(email => email.trim())
          );
          alert('Emails sent successfully!');
          selectedCampaign.value = '';
          recipientEmails.value = '';
        } catch (error) {
          sendError.value = errors || 'An error occurred while sending emails.';
        } finally {
          sending.value = false;
        }
      };
  
      return {
        campaigns,
        selectedCampaign,
        recipientEmails,
        sending,
        sendError,
        errors,
        sendEmail,
      };
    },
  };
  </script>
  
  <style scoped>
  /* Add Tailwind CSS here or configure your Tailwind in project setup */
  </style>
  