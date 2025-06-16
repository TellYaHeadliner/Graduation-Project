import { createSlice, PayloadAction } from '@reduxjs/toolkit';

interface titlePaymentState{
    pageTitle: string;
}

const initialState: titlePaymentState = {
    pageTitle: "Điền thông tin"
};

const pageTitleSlice = createSlice({
    name: 'pageTitle',
    initialState,
    reducers: {
        setPageTitle: (state, action: PayloadAction<string>) => {
            state.pageTitle = action.payload
        },
    },
});

export const { setPageTitle } = pageTitleSlice.actions;
export default pageTitleSlice.reducer;