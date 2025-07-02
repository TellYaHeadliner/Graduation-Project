import { createContext, useContext, useState, ReactNode } from "react";

export interface FilterState {
    stars: number[];         // VD: [5, 4]
    amentityIds: number[];   // Các tiện nghi con được chọn (id)
    minPrice: number;
    maxPrice: number;
    numberRoom: number;
    nightCount: number;
}

interface FilterContextType {
    filter: FilterState;
    updateStars: (stars: number[]) => void;
    updateAmentities: (ids: number[]) => void;
    updatePriceRange: (min: number, max: number) => void;
    updateNumberRoom: (room: number) => void;
    updateNightCount: (night: number) => void;
    resetFilter: () => void;
}

const defaultFilter: FilterState = {
    stars: [],
    amentityIds: [],
    minPrice: 0,
    maxPrice: 10000000,
    numberRoom: 1,
    nightCount: 1,
};

const FilterContext = createContext<FilterContextType | undefined>(undefined);

export function FilterProvider({ children }: { children: ReactNode }) {
    const [filter, setFilter] = useState<FilterState>(defaultFilter);

    const updateStars = (stars: number[]) => {
        setFilter(prev => ({ ...prev, stars }));
    };

    const updateAmentities = (ids: number[]) => {
        setFilter(prev => ({ ...prev, amentityIds: ids }));
    };

    const updatePriceRange = (min: number, max: number) => {
        setFilter(prev => ({ ...prev, minPrice: min, maxPrice: max }));
    };

    const updateNumberRoom = (room: number) => {
        setFilter(prev => ({ ...prev, numberRoom: room }));
    };

    const updateNightCount = (night: number) => {
        setFilter(prev => ({ ...prev, nightCount: night }));
    };

    const resetFilter = () => {
        setFilter(defaultFilter);
    };

    return (
        <FilterContext.Provider value={{
            filter,
            updateStars,
            updateAmentities,
            updatePriceRange,
            updateNumberRoom,
            updateNightCount,
            resetFilter
        }}>
            {children}
        </FilterContext.Provider>
    );
}

export function useFilter() {
    const context = useContext(FilterContext);
    if (!context) {
        throw new Error("useFilter must be used within a FilterProvider");
    }
    return context;
}
