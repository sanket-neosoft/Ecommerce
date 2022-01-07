import axios from 'axios';
import {
    MAIN_URL
} from '@/common/Url';

// Login api call 
export function userLogin(data) {
    return axios.post(`${MAIN_URL}api/login`, data);
}

// Logout api call 
export function userLogout() {
    return axios.post(`${MAIN_URL}api/logout`, {}, {
        headers: {
            Authorization: `Bearer ${JSON.parse(localStorage.getItem('user')).access_token}`
        }
    });
}

// Register api call 
export function userRegister(data) {
    return axios.post(`${MAIN_URL}api/register`, data);
}

// Banner api call 
export function banners() {
    return axios.get(`${MAIN_URL}api/banners`);
}

// Contact us api call 
export function contactUs(data) {
    return axios.post(`${MAIN_URL}api/contactus`, data);
}

export default {
    userLogin,
    userRegister,
    banners,
    userLogout,
    contactUs
};