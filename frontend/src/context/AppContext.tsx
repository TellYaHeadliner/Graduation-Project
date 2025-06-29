/* eslint-disable react-refresh/only-export-components */
import { createContext, useContext, useReducer, ReactNode } from 'react';
import { QueryClient, QueryClientProvider } from "@tanstack/react-query"

// Types

interface AppState {
  pageTitle: string;
}

interface Action { type: 'SET_PAGE_TITLE'; payload: string };

const initialState: AppState = {
  pageTitle: '',
};

function reducer(state: AppState, action: Action): AppState {
  switch (action.type) {
    case 'SET_PAGE_TITLE':
      return { ...state, pageTitle: action.payload };
    default:
      return state;
  }
}

// Context
const AppContext = createContext<{
  state: AppState;
  dispatch: React.Dispatch<Action>;
} | undefined>(undefined);

const queryClient = new QueryClient({
    defaultOptions: {
      queries: {
        retry: 1,
        refetchOnWindowFocus: false,
        staleTime: 1000 * 60
      },
      mutations: {
        retry: 0
      }
    }
})

// Provider component
export function AppProvider({ children }: { children: ReactNode }) {
  const [state, dispatch] = useReducer(reducer, initialState);

  return (
    <QueryClientProvider client={queryClient}>
      <AppContext.Provider value={{ state, dispatch }}>
      {children}
      </AppContext.Provider>
    </QueryClientProvider>
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