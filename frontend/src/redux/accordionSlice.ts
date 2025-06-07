import { createSlice, PayloadAction } from '@reduxjs/toolkit';

interface AccordionState {
  comfortCommon: boolean;
  support: boolean;
  star: boolean;
  rate: boolean;
}

const initialState: AccordionState = {
  comfortCommon: false,
  support: false,
  star: false,
  rate: false,
};

const accordionSlice = createSlice({
  name: 'accordion',
  initialState,
  reducers: {
    toggleComfortCommon: (state) => {
      state.comfortCommon = !state.comfortCommon;
    },
    toggleSupport: (state) => {
      state.support = !state.support;
    },
    toggleStar: (state) => {
      state.star = !state.star;
    },
    toggleRate: (state) => {
      state.rate = !state.rate;
    },
    setAccordionState: (state, action: PayloadAction<Partial<AccordionState>>) => {
      return { ...state, ...action.payload };
    },
  },
});

export const {
  toggleComfortCommon,
  toggleSupport,
  toggleStar,
  toggleRate,
  setAccordionState,
} = accordionSlice.actions;

export default accordionSlice.reducer; 