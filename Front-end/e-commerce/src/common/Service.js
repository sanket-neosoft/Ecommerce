import axios from 'axios';

import {
    MAIN_URL
} from '@/common/Url';
export function userLogin(data) {
    return axios.post(`${MAIN_URL}api/login`, data);
}
export function userLogout() {
    return axios.post(`${MAIN_URL}api/logout`, {}, {
        headers: {
            Authorization: `Bearer ${JSON.parse(localStorage.getItem('user')).access_token}`
        }
    });
}
export function userRegister(data) {
    return axios.post(`${MAIN_URL}api/register`, data);
}
export function banners() {
    return axios.get(`${MAIN_URL}api/banners`);
}
export default {
    userLogin,
    userRegister,
    banners,
    userLogout
};