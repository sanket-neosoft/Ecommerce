import axios from 'axios';
import toastr from "toastr";
import store from '../store';
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

// Account details api 
export function accountDetails() {
    return axios.get(`${MAIN_URL}api/profile`, {
        headers: {
            Authorization: `Bearer ${JSON.parse(localStorage.getItem('user')).access_token}`
        }
    });
}

// Update accounts detail api
export function updateAccountDetails(data) {
    return axios.post(`${MAIN_URL}api/profile/update`, data, {
        headers: {
            Authorization: `Bearer ${JSON.parse(localStorage.getItem('user')).access_token}`
        }
    })
}

// Update user password api
export function changePassword(password) {
    return axios.post(`${MAIN_URL}api/profile/changepassword`, password, {
        headers: {
            Authorization: `Bearer ${JSON.parse(localStorage.getItem('user')).access_token}`
        }
    })
}


// Add to Cart Logic
export function addToCart(id) {
    let products_id = [];
    if (localStorage.getItem("cart") != undefined) {
        products_id = JSON.parse(localStorage.getItem("cart"));
        if (products_id.find(product => product.id === id)) {
            toastr.error("Product already added to cart");
        } else {
            let product = {
                id: id,
                quantity: 1
            }
            products_id.push(product);
            localStorage.setItem("cart", JSON.stringify(products_id));
            toastr.success("Product added to cart.");
        }
    } else {
        let product = {
            id: id,
            quantity: 1
        }
        products_id.push(product);
        localStorage.setItem("cart", JSON.stringify(products_id));
        toastr.success("Product added to cart.");
    }
    store.dispatch("addToCart", products_id);
}

// Add product to wishlist 
export function addToWishList(data) {
    return axios.post(`${MAIN_URL}api/profile/addwishlist`, data, {
        headers: {
            Authorization: `Bearer ${JSON.parse(localStorage.getItem('user')).access_token}`
        }
    });
}

export function userWishlist(user_id) {
    return axios.get(`${MAIN_URL}api/profile/wishlist/${user_id}`, {
        headers: {
            Authorization: `Bearer ${JSON.parse(localStorage.getItem('user')).access_token}`
        }
    });
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
    productDetails,
    accountDetails,
    updateAccountDetails,
    addToCart,
    userWishlist,
    changePassword
};