import axios, { AxiosInstance, AxiosResponse } from 'axios'

import { ApiError } from "../types/api"

const api: AxiosInstance = axios.create({
  baseURL: import.meta.env.VITE_API_URL || "http://127.0.0.1:8000/api/v1",
  timeout: 30000,
  headers: {
    "Content-Type": "application/json",
    "Accept": "application/json",
  },
  withXSRFToken: true,
  withCredentials: true,
  
});

api.interceptors.response.use(
    <T>(response: AxiosResponse<T>) => response.data,
    (error: any) => {
    if (error.response?.status === 401){
      console.warn("Phiên đăng nhập đã hết hạn");
    }
    const apiError: ApiError = {
        message: error.response?.data?.message,
        status: error.status,
        statusText: error.response?.statusText
    };
    return Promise.reject(apiError)
    }
)

export default api;