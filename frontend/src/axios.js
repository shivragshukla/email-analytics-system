import axios from 'axios'
import { AUTH_TOKEN } from './constant';

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

axios.defaults.baseURL = import.meta.env.VITE_API_URL;
axios.defaults.headers.common['Authorization'] = `Bearer ${AUTH_TOKEN}`;
axios.defaults.headers.common['Accept'] = 'application/json';

export default axios;

