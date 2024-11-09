
<template>
    <div class="container mx-auto p-6">
      <h1 class="text-2xl font-bold mb-4">Templates</h1>
      <button @click="openModalForCreate" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">Add New Template</button>
  
      <!-- Modal Component -->
      <Modal
        v-if="isModalOpen"
        :title="modalTitle"
        :confirm-button-text="modalConfirmText"
        :onClose="closeModal"
        :onConfirm="confirmModalAction"
      >
        <div>
          <label class="block text-sm font-medium mb-1">Name</label>
          <input v-model="formData.name" type="text" class="w-full p-2 border rounded mb-4" required />
          <div v-if="errors.name" class="flex">
            <span class="text-red-400 text-sm m-2 p-2">{{
                errors.name[0]
            }}</span>
            </div>
            
          <label class="block text-sm font-medium mb-1">Content</label>
          <textarea v-model="formData.content" class="w-full p-2 border rounded" required></textarea>
          <div v-if="errors.content" class="flex">
            <span class="text-red-400 text-sm m-2 p-2">{{
                errors.content[0]
            }}</span>
            </div>
        </div>
      </Modal>
  
      <!-- Template List Table -->
      <div class="bg-white shadow rounded">
        <table class="w-full table-auto">
          <thead>
            <tr class="bg-gray-200">
              <th class="px-4 py-2 text-left">Name</th>
              <th class="px-4 py-2 text-left">Content</th>
              <th class="px-4 py-2">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="template in templates" :key="template.id" class="border-b">
              <td class="px-4 py-2">{{ template.name }}</td>
              <td class="px-4 py-2">{{ template.content }}</td>
              <td class="px-4 py-2 text-center">
                <button @click="openModalForEdit(template)" class="bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500">Edit</button>
                <button @click="deleteTemplate(template.id)" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 ml-2">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  <script>
  import { ref, reactive, onMounted } from 'vue';
  import { useTemplateStore } from '../stores/templateStore';
  import Modal from './Modal.vue';
  import { storeToRefs } from 'pinia';
  
  export default {
    components: { Modal },
  
    setup() {
      const templateStore = useTemplateStore();
      const { fetchTemplates, createTemplate, updateTemplate, deleteTemplate } = templateStore;
      const { templates, errors } = storeToRefs (useTemplateStore());
  
      const isModalOpen = ref(false);
      const modalTitle = ref('');
      const modalConfirmText = ref('');
      const formData = reactive({ name: '', content: '' });
      const currentTemplateId = ref(null);
  
      const openModalForCreate = () => {
        errors.value = {};
        modalTitle.value = 'Create Template';
        modalConfirmText.value = 'Create';
        formData.name = '';
        formData.content = '';
        currentTemplateId.value = null;
        isModalOpen.value = true;
      };
  
      const openModalForEdit = (template) => {
        errors.value = {};
        modalTitle.value = 'Edit Template';
        modalConfirmText.value = 'Update';
        formData.name = template.name;
        formData.content = template.content;
        currentTemplateId.value = template.id;
        isModalOpen.value = true;
      };
  
      const closeModal = () => {
        isModalOpen.value = false;
      };
  
      const confirmModalAction = async () => {
        if (currentTemplateId.value) {
          await updateTemplate(currentTemplateId.value, formData);
        } else {
          await createTemplate({ ...formData });
        }
        if(Object.keys(errors.value).length === 0) {
            closeModal();
            fetchTemplates();
        }
        
      };

        onMounted(() => {
            errors.value = {}
            fetchTemplates();
        });

  
      return {
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
        deleteTemplate,
      };
    },
  };
  </script>
  
  <style scoped>
  </style>
  