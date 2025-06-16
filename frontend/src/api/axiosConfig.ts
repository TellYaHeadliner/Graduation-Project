import axios, { AxiosInstance, InternalAxiosRequestConfig, AxiosResponse } from 'axios'
import Cookies from 'js-cookie';

import { ApiError } from "../types/api"

const api: AxiosInstance = axios.create({
  baseURL: import.meta.env.VITE_API_URL || "http://127.0.0.1:9000/api/v1",
  timeout: 10000,
  headers: {
    "Content-Type": "application/json",
    "X-Requested-With": "XMLHttpRequest",
    "Cache-Control": "no-cache",
    "Accept": "application/json"
  },
  withXSRFToken: true,
  withCredentials: true
});

api.interceptors.request.use(
  (config: InternalAxiosRequestConfig) => {
    const token = localStorage.getItem("token");
    if (token) {
      config.headers.set("Authorization", `Bearer ${token}`);
    }
    return config;
  },
  (error: unknown) => Promise.reject(error)
);


api.interceptors.response.use(
    <T>(response: AxiosResponse<T>) => response.data,
    (error: any) => {
        if (error.response?.status === 401){
            Cookies.remove('token');
            window.location.href = '/login';
        }
    const apiError: ApiError = {
        message: error.response?.data?.messsage || 'Đã có lỗi xảy ra',
        code: error.response?.status?.toString(),
    };
    return Promise.reject(apiError)
    }
)

export default api;