import { configureStore } from "@reduxjs/toolkit"

// Mẫu reducer sẽ có thay đổi
// import sampleCounterSlice  from "./sampleCounterSlice"
import authSlice from './authSlice';

export const store = configureStore({
    reducer: {
        auth: authSlice
    },
});

export type RootState = ReturnType<typeof store.getState>;
export type AppDispatch = typeof store.dispatch
export default store;