import { useMemo } from "react";
import { useLocation } from "react-router-dom";

export default function useFindHotel(){
    const location = useLocation();

    const queryFindHotel = useMemo(() => {
        const queryParams = new URLSearchParams(location.search)
        const provinceFromQuery = queryParams.get("province") ?? "";
        const startDateFromQuery = queryParams.get("startDate") ? new Date(queryParams.get("startDate")!) : null;
        const endDateFromQuery = queryParams.get("endDate") ? new Date(queryParams.get("endDate")!) : null;
        const adultsFromQuery = queryParams.get("adults") ? parseInt(queryParams.get("adults")!) : null;
        const childrenFromQuery = queryParams.get("children") ? parseInt(queryParams.get("children")!) : null;
        const roomsFromQuery = queryParams.get("rooms") ? parseInt(queryParams.get("rooms")!) : null;
        const withPetsFromQuery = queryParams.get("withPets") === "true";

        return { provinceFromQuery, startDateFromQuery, endDateFromQuery, adultsFromQuery, childrenFromQuery, roomsFromQuery, withPetsFromQuery}
    }, [location.search])
    
    return queryFindHotel
}