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

// Delete product from wishlist 
export function deleteFromWishlist(id) {
    return axios.delete(`${MAIN_URL}api/profile/deletewishlist/${id}`, {
        headers: {
            Authorization: `Bearer ${JSON.parse(localStorage.getItem('user')).access_token}`
        }
    });
}

// user wishlist api 
export function userWishlist(user_id) {
    return axios.get(`${MAIN_URL}api/profile/wishlist/${user_id}`, {
        headers: {
            Authorization: `Bearer ${JSON.parse(localStorage.getItem('user')).access_token}`
        }
    });
}

// placeorder api 
export function placeOrder(data) {
    return axios.post(`${MAIN_URL}api/placeorder`, data, {
        headers: {
            Authorization: `Bearer ${JSON.parse(localStorage.getItem('user')).access_token}`
        }
    });
}

// register order api
export function orderDetail(data) {
    return axios.post(`${MAIN_URL}api/registerorder`, data, {
        headers: {
            Authorization: `Bearer ${JSON.parse(localStorage.getItem('user')).access_token}`
        }
    });
}

// myorder api
export function myOrders(id) {
    return axios.get(`${MAIN_URL}api/myorders/${id}`, {
        headers: {
            Authorization: `Bearer ${JSON.parse(localStorage.getItem('user')).access_token}`
        }
    });
}

// get coupon details
export function getCoupon(coupon) {
    return axios.get(`${MAIN_URL}api/getcoupon/${coupon}`, {
        headers: {
            Authorization: `Bearer ${JSON.parse(localStorage.getItem('user')).access_token}`
        }
    });
}

// get used coupons list 
export function usedCoupon(id) {
    return axios.get(`${MAIN_URL}api/profile/usedcoupons/${id}`, {
        headers: {
            Authorization: `Bearer ${JSON.parse(localStorage.getItem('user')).access_token}`
        }
    });
}

// coupon count api 
export function couponCount(id) {
    return axios.get(`${MAIN_URL}api/couponcount/${id}`, {
        headers: {
            Authorization: `Bearer ${JSON.parse(localStorage.getItem('user')).access_token}`
        }
    });
}

// track order api 
export function trackOrder(data) {
    return axios.post(`${MAIN_URL}api/trackorder`, data, {
        headers: {
            Authorization: `Bearer ${JSON.parse(localStorage.getItem('user')).access_token}`
        }
    });
}

// all cms api 
export function cmss() {
    return axios.get(`${MAIN_URL}api/cms`);
}

// single cms api 
export function cms(slug) {
    return axios.get(`${MAIN_URL}api/cms/${slug}`);
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
    deleteFromWishlist,
    changePassword,
    placeOrder,
    orderDetail,
    myOrders,
    getCoupon,
    usedCoupon,
    couponCount,
    trackOrder,
    cmss,
    cms
};