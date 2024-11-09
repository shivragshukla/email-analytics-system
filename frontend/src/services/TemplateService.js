import axios from 'axios';

const API_URL = 'http://localhost:8000/api/templates';

export default {
  getTemplates() {
    return axios.get(API_URL);
  },
  getTemplate(id) {
    return axios.get(`${API_URL}/${id}`);
  },
  createTemplate(data) {
    return axios.post(API_URL, data);
  },
  updateTemplate(id, data) {
    return axios.put(`${API_URL}/${id}`, data);
  },
  deleteTemplate(id) {
    return axios.delete(`${API_URL}/${id}`);
  },
};
