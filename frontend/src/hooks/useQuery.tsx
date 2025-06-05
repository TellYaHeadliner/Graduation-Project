import { useSearchParams } from "react-router-dom";

export default function useQuery() {
    const [searchParams] = useSearchParams();

    return {
        query : searchParams.get("query") || "",
        pronvice: searchParams.get("pronvice") || "",
        startDate : searchParams.get("startDate")|| "",
        endDate : searchParams.get("endDate") || "",
        adults : searchParams.get("adults") || "",
        children : searchParams.get("children") || "",
        rooms : searchParams.get("rooms") || "",
        withPets : searchParams.get("withPets") || false
    }
}