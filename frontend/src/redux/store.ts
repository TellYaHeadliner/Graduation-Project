import { configureStore } from "@reduxjs/toolkit"

import authSlice from './slices/authSlice';
import findHotelSlice from './slices/findHotelSlices';

export const store = configureStore({
    reducer: {
        auth: authSlice,
        findHotel: findHotelSlice
    },
    devTools: true
});

export type RootState = ReturnType<typeof store.getState>;
export type AppDispatch = typeof store.dispatch
export default store;