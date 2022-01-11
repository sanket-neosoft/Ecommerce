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

// Product api call
export function products() {
    return axios.get(`${MAIN_URL}api/products`);
}

// Category api call
export function categories() {
    return axios.get(`${MAIN_URL}api/categories`);
}

// Category products api call
export function categoryProducts(id) {
    return axios.get(`${MAIN_URL}api/category/products/${id}`);
}

// Contact us api call 
export function contactUs(data) {
    return axios.post(`${MAIN_URL}api/contactus`, data);
}

// Product details api
export function productDetails(id) {
    return axios.get(`${MAIN_URL}api/product/${id}`);
}

export default {
    userLogin,
    userRegister,
    banners,
    userLogout,
    contactUs,
    products,
    categories,
    categoryProducts,
    productDetails
};