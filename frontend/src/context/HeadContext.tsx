import { createContext, useContext, useReducer, ReactNode } from 'react';

interface TitleState {
    title: string;
}

interface TitleAction { type: 'SET_TITLE'; payload: string }

const initialState: TitleState = {
    title: 'Trang chủ'
};

function reducer(state: TitleState, action: TitleAction): TitleState {
    switch (action.type) {
        case 'SET_TITLE':
            return { ...state, title: action.payload };
        default:
            return state;
    }
}

const HeadContext = createContext<{
    state: TitleState;
    dispatch: React.Dispatch<TitleAction>;
} | undefined>(undefined);

export function HeadProvider({ children }: { children: ReactNode }) {
    const [state, dispatch] = useReducer(reducer, initialState);
    return (
        <HeadContext.Provider value={{ state, dispatch }}>
            {children}
        </HeadContext.Provider>
    );
}

export function useHeadContext() {
    const context = useContext(HeadContext);
    if (!context) throw new Error('useHeadContext must be used within a HeadProvider');
    return context;
} 