export interface ApiError {
  message: string;
  code?: string;
}

export interface ApiResponse<T> {
  data: T;
  status: number;
  statusText: string;
}
