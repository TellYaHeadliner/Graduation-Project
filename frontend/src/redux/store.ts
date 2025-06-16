import { configureStore } from "@reduxjs/toolkit"

import authSlice from './slices/authSlice';
import findHotelSlice from './slices/findHotelSlices';
import pageTitleSlice from './slices/titlePaymentSlice';

export const store = configureStore({
    reducer: {
        auth: authSlice,
        findHotel: findHotelSlice,
        pageTitleSlice: pageTitleSlice
    },
    devTools: true
});

export type RootState = ReturnType<typeof store.getState>;
export type AppDispatch = typeof store.dispatch
export default store;