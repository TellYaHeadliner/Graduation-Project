import { createContext, useContext, useReducer, ReactNode } from 'react';

export interface FindHotelParams {
  province: string;
  dateRange: [Date | null, Date | null];
  adults: number;
  children: number;
  rooms: number;
  withPets: boolean;
}

type FindHotelAction =
  | { type: 'SET_PROVINCE'; payload: string }
  | { type: 'SET_DATE_RANGE'; payload: [Date | null, Date | null] }
  | { type: 'SET_ADULTS'; payload: number }
  | { type: 'SET_CHILDREN'; payload: number }
  | { type: 'SET_ROOMS'; payload: number }
  | { type: 'SET_WITH_PETS'; payload: boolean };

const initialState: FindHotelParams = {
  province: '',
  dateRange: [null, null],
  adults: 2,
  children: 0,
  rooms: 1,
  withPets: false,
};

function reducer(state: FindHotelParams, action: FindHotelAction): FindHotelParams {
  switch (action.type) {
    case 'SET_PROVINCE':
      return { ...state, province: action.payload };
    case 'SET_DATE_RANGE':
      return { ...state, dateRange: action.payload };
    case 'SET_ADULTS':
      return { ...state, adults: action.payload };
    case 'SET_CHILDREN':
      return { ...state, children: action.payload };
    case 'SET_ROOMS':
      return { ...state, rooms: action.payload };
    case 'SET_WITH_PETS':
      return { ...state, withPets: action.payload };
    default:
      return state;
  }
}

const FindHotelContext = createContext<{
  state: FindHotelParams;
  dispatch: React.Dispatch<FindHotelAction>;
} | undefined>(undefined);

export function FindHotelProvider({ children }: { children: ReactNode }) {
  const [state, dispatch] = useReducer(reducer, initialState);
  return (
    <FindHotelContext.Provider value={{ state, dispatch }}>
      {children}
    </FindHotelContext.Provider>
  );
}

export function useFindHotelContext() {
  const context = useContext(FindHotelContext);
  if (!context) throw new Error('useFindHotelContext must be used within a FindHotelProvider');
  return context;
} 