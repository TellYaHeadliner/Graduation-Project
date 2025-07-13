export interface ApiError {
  message: string;
  status: number;
  statusText?: string;
  redirect?: string;
}

export interface ApiResponse<T> {
  message: string;
  data: T;
  status?: number;
  statusText?: string;
}


