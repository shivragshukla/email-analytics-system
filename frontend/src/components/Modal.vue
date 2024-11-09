<!-- src/components/Modal.vue -->
<template>
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
      <div class="bg-white p-6 rounded shadow-lg max-w-lg w-full">
        <h2 class="text-xl font-bold mb-4">{{ title }}</h2>
        <slot></slot>
        <div class="mt-4 flex justify-end">
          <button @click="closeModal" class="bg-gray-300 px-4 py-2 rounded mr-2">Cancel</button>
          <button @click="confirmAction" class="bg-blue-500 text-white px-4 py-2 rounded">{{ confirmButtonText }}</button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      title: String,
      confirmButtonText: String,
      onClose: Function,
      onConfirm: Function,
    },
    methods: {
      closeModal() {
        this.onClose();
      },
      confirmAction() {
        this.onConfirm();
      },
    },
  };
  </script>
  