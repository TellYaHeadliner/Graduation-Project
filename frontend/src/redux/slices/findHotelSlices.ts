import { createSlice, PayloadAction } from '@reduxjs/toolkit';

interface FindHotelState {
  province: string;
  dateRange: [Date | null, Date | null];
  adults: number;
  children: number;
  rooms: number;
  withPets: boolean;
}

const initialState: FindHotelState = {
  province: '',
  dateRange: [null, null],
  adults: 2,
  children: 0,
  rooms: 1,
  withPets: false,
};

const findHotelSlice = createSlice({
  name: 'findHotel',
  initialState,
  reducers: {
    setProvince(state, action: PayloadAction<string>) {
      state.province = action.payload;
    },
    setDateRange(state, action: PayloadAction<[Date | null, Date | null]>) {
      state.dateRange = action.payload;
    },
    setAdults(state, action: PayloadAction<number>) {
      state.adults = action.payload;
    },
    setChildren(state, action: PayloadAction<number>) {
      state.children = action.payload;
    },
    setRooms(state, action: PayloadAction<number>) {
      state.rooms = action.payload;
    },
    setWithPets(state, action: PayloadAction<boolean>) {
      state.withPets = action.payload;
    },
    setAll(state, action: PayloadAction<Partial<FindHotelState>>) {
      Object.assign(state, action.payload);
    }
  },
});

export const {
  setProvince,
  setDateRange,
  setAdults,
  setChildren,
  setRooms,
  setWithPets,
  setAll,
} = findHotelSlice.actions;

export default findHotelSlice.reducer;
