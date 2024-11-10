import axios from 'axios';

const API_URL = '/api/campaigns';

export default {
  getCampaigns() {
    return axios.get(API_URL);
  },
  getCampaign(id) {
    return axios.get(`${API_URL}/${id}`);
  },
  createCampaign(data) {
    return axios.post(API_URL, data);
  },
  updateCampaign(id, data) {
    return axios.put(`${API_URL}/${id}`, data);
  },
  deleteCampaign(id) {
    return axios.delete(`${API_URL}/${id}`);
  },
};
