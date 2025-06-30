/* eslint-disable react-refresh/only-export-components */
import { createContext, useContext, useReducer, ReactNode, useEffect } from 'react';

export interface FindRoomParams {
  dateRange: [string | null, string | null];
  adults: number;
  children: number;
  rooms: number;
}

type FindRoomAction =
  | { type: 'SET_DATE_RANGE'; payload: [string | null, string | null] }
  | { type: 'SET_ADULTS'; payload: number }
  | { type: 'SET_CHILDREN'; payload: number }
  | { type: 'SET_ROOMS'; payload: number };

const initialState: FindRoomParams = {
  dateRange: [null, null],
  adults: 0,
  children: 0,
  rooms: 0,
};

function reducer(state: FindRoomParams, action: FindRoomAction): FindRoomParams {
  switch (action.type) {
    case 'SET_DATE_RANGE':
      return { ...state, dateRange: action.payload };
    case 'SET_ADULTS':
      return { ...state, adults: action.payload };
    case 'SET_CHILDREN':
      return { ...state, children: action.payload };
    case 'SET_ROOMS':
      return { ...state, rooms: action.payload };
    default:
      return state;
  }
}

const FindRoomContext = createContext<{
  state: FindRoomParams;
  dispatch: React.Dispatch<FindRoomAction>;
} | undefined>(undefined);

export function FindRoomProvider({ children }: { children: ReactNode }) {
  const getInitialState = (): FindRoomParams => {
    const saved = localStorage.getItem('findRoom');
    return saved ? JSON.parse(saved) : initialState;
  };

  const [state, dispatch] = useReducer(reducer, getInitialState());


  useEffect(() => {
    localStorage.setItem('findRoom', JSON.stringify(state));
  }, [state]);

  return (
    <FindRoomContext.Provider value={{ state, dispatch }}>
      {children}
    </FindRoomContext.Provider>
  );
}

export function useFindRoomContext() {
  const context = useContext(FindRoomContext);
  if (!context) throw new Error('useFindRoomContext must be used within a FindRoomProvider');
  return context;
} 