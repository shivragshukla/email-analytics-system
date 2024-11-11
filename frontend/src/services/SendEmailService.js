import axios from 'axios';

const API_URL = '/api/campaigns';

export default {
  sendEmails(id, data) {
    return axios.post(`${API_URL}/${id}/send`, data);
  },
};
