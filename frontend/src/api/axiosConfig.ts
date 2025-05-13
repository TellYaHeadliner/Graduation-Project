import axios, { AxiosInstance, InternalAxiosRequestConfig, AxiosResponse } from 'axios'

import { ApiError } from "../types/api"

const api: AxiosInstance = axios.create({
  baseURL: process.env.REACT_APP_API_URL || "http://localhost:8000/api",
  timeout: 10000,
  headers: {
    "Content-Type": "application/json",
  },
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
            sessionStorage.removeItem('token');
            window.location.href = '/login';
        }
    const apiError: ApiError = {
        message: error.response?.data?.messsage || 'Đã có lỗi xảy ra',
        code: error.response?.status?.toString(),
    };
    return Promise.reject(apiError)
    }
)