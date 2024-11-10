<template>
    <div class="container mx-auto p-6">
      <h1 class="text-2xl font-bold mb-4">Campaigns</h1>
      <button @click="openModalForCreate" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">Add New Campaign</button>
  
      <!-- Modal Component -->
      <Modal
        v-if="isModalOpen"
        :title="modalTitle"
        :confirm-button-text="modalConfirmText"
        :onClose="closeModal"
        :onConfirm="confirmModalAction"
      >
        <div>
            <div class="mb-4">
                <label class="block mb-1">Name</label>
                <input v-model="formData.name" type="text" class="w-full border rounded px-3 py-2">
                <p v-if="errors.name" class="flex">
                    <span class="text-red-400 text-sm m-2 p-2">{{
                        errors.name[0]
                    }}</span>
                </p>
            </div>
            <div class="mb-4">
                <label class="block mb-1">Subject</label>
                <input v-model="formData.subject" type="text" class="w-full border rounded px-3 py-2">
                <p v-if="errors.subject" class="flex">
                    <span class="text-red-400 text-sm m-2 p-2">{{
                        errors.subject[0]
                    }}</span>
                </p>
            </div>
            <div class="mb-4">
                <label class="block mb-1">From Name</label>
                <input v-model="formData.from_name" type="text" class="w-full border rounded px-3 py-2">
                <p v-if="errors.from_name" class="flex">
                    <span class="text-red-400 text-sm m-2 p-2">{{
                        errors.from_name[0]
                    }}</span>
                </p>
            </div>
            <div class="mb-4">
                <label class="block mb-1">From Address</label>
                <input v-model="formData.from_address" type="email" class="w-full border rounded px-3 py-2">
                <p v-if="errors.from_address" class="flex">
                    <span class="text-red-400 text-sm m-2 p-2">{{
                        errors.from_address[0]
                    }}</span>
                </p>
            </div>
            <div class="mb-4">
                <label class="block mb-1">Template</label>
                <select v-model="formData.template_id" class="w-full border rounded px-3 py-2">
                    <option value="">-- Select a Template --</option>
                    <option v-for="template in templates" :key="template.id" :value="template.id">{{ template.name }}</option>
                </select>
                <p v-if="errors.template_id" class="flex">
                    <span class="text-red-400 text-sm m-2 p-2">{{
                        errors.template_id[0]
                    }}</span>
                </p>
            </div>
        </div>
      </Modal>
  
      <!-- Template List Table -->
      <div class="bg-white shadow rounded">
        <table class="w-full table-auto">
          <thead>
            <tr class="bg-gray-200">
              <th class="px-4 py-2 text-left">Name</th>
              <th class="px-4 py-2 text-left">Subject</th>
              <th class="px-4 py-2 text-left">From Name</th>
              <th class="px-4 py-2 text-left">From Address</th>
              <th class="px-4 py-2 text-left">Template</th>
              <th class="px-4 py-2">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="campaign in campaigns" :key="campaign.id" class="border-b">
              <td class="px-4 py-2">{{ campaign.name }}</td>
              <td class="px-4 py-2">{{ campaign.subject }}</td>
              <td class="px-4 py-2">{{ campaign.from_name }}</td>
              <td class="px-4 py-2">{{ campaign.from_address }}</td>
              <td class="px-4 py-2">{{ campaign.template?.name }}</td>
              <td class="px-4 py-2 text-center">
                <button @click="openModalForEdit(campaign)" class="bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500">Edit</button>
                <button @click="deleteTemplate(campaign.id)" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 ml-2">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>

<script>
import { ref, reactive, onMounted } from 'vue';
import { useCampaignStore } from '../stores/campaignStore';
import { useTemplateStore } from '../stores/templateStore';
import Modal from './Modal.vue';
import { storeToRefs } from 'pinia';

export default {
  components: { Modal },

  setup() {
    const campaignStore = useCampaignStore();
    const templateStore = useTemplateStore();

    const { fetchCampaigns, createCampaign, updateCampaign, deleteCampaign } = campaignStore;
    const { fetchTemplates } = templateStore;
    const { campaigns, errors } = storeToRefs (useCampaignStore());
    const { templates } = storeToRefs (useTemplateStore());

    const isModalOpen = ref(false);
    const modalTitle = ref('');
    const modalConfirmText = ref('');
    const formData = reactive({ name: '', subject: '', from_name: '', from_address: '', template_id: null });
    const currentCampaignId = ref(null);

    const openModalForCreate = () => {
      errors.value = {};
      modalTitle.value = 'Create Campaign';
      modalConfirmText.value = 'Create';
      formData.name = '';
      formData.subject = '';
      formData.from_name = '';
      formData.from_address = '';
      formData.template_id = null;
      currentCampaignId.value = null;
      isModalOpen.value = true;
    };

    const openModalForEdit = (campaign) => {
      errors.value = {};
      modalTitle.value = 'Edit Campaign';
      modalConfirmText.value = 'Update';
      formData.name = campaign.name;
      formData.subject = campaign.subject;
      formData.from_name = campaign.from_name;
      formData.from_address = campaign.from_address;
      formData.template_id = campaign.template_id;
      currentCampaignId.value = campaign.id;
      isModalOpen.value = true;
    };

    const closeModal = () => {
      isModalOpen.value = false;
    };

    const confirmModalAction = async () => {
      if (currentCampaignId.value) {
        await updateCampaign(currentCampaignId.value, formData);
      } else {
        await createCampaign({ ...formData });
      }
      if(Object.keys(errors.value).length === 0) {
          closeModal();
          fetchCampaigns();
      }
      
    };

      onMounted(() => {
          errors.value = {}
          fetchCampaigns();
          fetchTemplates()
      });


    return {
      campaigns,
      templates,
      errors,
      formData,
      isModalOpen,
      modalTitle,
      modalConfirmText,
      openModalForCreate,
      openModalForEdit,
      closeModal,
      confirmModalAction,
      deleteCampaign,
    };
  },
};
</script>

<style scoped>
</style>
