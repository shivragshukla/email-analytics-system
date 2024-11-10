import axios from 'axios';

export default {
  getUser() {
    return axios.get(`/api/user`);
  },
  authenticate(apiRoute, data) {
    return axios.post(`/api/${apiRoute}`, data);
  },
  logout() {
    return axios.post(`/api/logout`, {});
  },
};
