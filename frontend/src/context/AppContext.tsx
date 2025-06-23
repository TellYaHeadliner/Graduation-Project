/* eslint-disable react-refresh/only-export-components */
import { createContext, useContext, useReducer, ReactNode } from 'react';

// Types
interface AuthState {
  isAuthenticated: boolean;
}

interface FindHotelState {
  province: string;
  dateRange: [Date | null, Date | null];
  adults: number;
  children: number;
  rooms: number;
  withPets: boolean;
}

interface PageTitleState {
  pageTitle: string;
}

interface AppState {
  auth: AuthState;
  findHotel: FindHotelState;
  pageTitle: PageTitleState;
}

// Initial state
const initialState: AppState = {
  auth: {
    isAuthenticated: false,
  },
  findHotel: {
    province: '',
    dateRange: [null, null],
    adults: 2,
    children: 0,
    rooms: 1,
    withPets: false,
  },
  pageTitle: {
    pageTitle: "Điền thông tin"
  }
};

// Action types
type Action =
  | { type: 'LOGIN' }
  | { type: 'LOGOUT' }
  | { type: 'SET_PROVINCE'; payload: string }
  | { type: 'SET_DATE_RANGE'; payload: [Date | null, Date | null] }
  | { type: 'SET_ADULTS'; payload: number }
  | { type: 'SET_CHILDREN'; payload: number }
  | { type: 'SET_ROOMS'; payload: number }
  | { type: 'SET_WITH_PETS'; payload: boolean }
  | { type: 'SET_PAGE_TITLE'; payload: string };

// Reducer
function reducer(state: AppState, action: Action): AppState {
  switch (action.type) {
    case 'LOGIN':
      return {
        ...state,
        auth: { ...state.auth, isAuthenticated: true }
      };
    case 'LOGOUT':
      return {
        ...state,
        auth: { ...state.auth, isAuthenticated: false }
      };
    case 'SET_PROVINCE':
      return {
        ...state,
        findHotel: { ...state.findHotel, province: action.payload }
      };
    case 'SET_DATE_RANGE':
      return {
        ...state,
        findHotel: { ...state.findHotel, dateRange: action.payload }
      };
    case 'SET_ADULTS':
      return {
        ...state,
        findHotel: { ...state.findHotel, adults: action.payload }
      };
    case 'SET_CHILDREN':
      return {
        ...state,
        findHotel: { ...state.findHotel, children: action.payload }
      };
    case 'SET_ROOMS':
      return {
        ...state,
        findHotel: { ...state.findHotel, rooms: action.payload }
      };
    case 'SET_WITH_PETS':
      return {
        ...state,
        findHotel: { ...state.findHotel, withPets: action.payload }
      };
    case 'SET_PAGE_TITLE':
      return {
        ...state,
        pageTitle: { pageTitle: action.payload }
      };
    default:
      return state;
  }
}

// Context
const AppContext = createContext<{
  state: AppState;
  dispatch: React.Dispatch<Action>;
} | undefined>(undefined);

// Provider component
export function AppProvider({ children }: { children: ReactNode }) {
  const [state, dispatch] = useReducer(reducer, initialState);

  return (
    <AppContext.Provider value={{ state, dispatch }}>
      {children}
    </AppContext.Provider>
  );
}

// Custom hook to use the context
export function useAppContext() {
  const context = useContext(AppContext);
  if (context === undefined) {
    throw new Error('useAppContext must be used within an AppProvider');
  }
  return context;
} 