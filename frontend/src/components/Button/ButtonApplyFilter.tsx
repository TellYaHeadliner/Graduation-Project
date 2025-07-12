import { Button } from "@radix-ui/themes";
import { useFilter } from "../../context/FilterContext";
import { useLocation, useNavigate} from "react-router-dom";
import { useMemo } from "react";

export default function ButtonApplyFilter(){
    const { filter } = useFilter();
    const location = useLocation();
    const navigate = useNavigate();

    const queryParams = useMemo(() => {
        const params = new URLSearchParams(location.search);
        return {
            address: params.get("address") || "",
            checkin: params.get("checkin") || "",
            checkout: params.get("checkout") || "",
            guest: Number(params.get("guest") || "0"),
            children: Number(params.get("children") || "0"),
        };
    }, [location.search])

    const handleApply = () => {
        const queryParts: string[] = [];

        queryParts.push(`address=${encodeURIComponent(queryParams.address)}`);
        queryParts.push(`checkin=${queryParams.checkin}`);
        queryParts.push(`checkout=${queryParams.checkout}`);
        queryParts.push(`guest=${queryParams.guest}`);
        queryParts.push(`children=${queryParams.children}`);

        if (filter.amenities){
            filter.amenities.forEach((id) => {
                queryParts.push(`amenities[]=${id}`);
            });
        }

        if (filter.stars.length > 0){
            queryParts.push(`min_rating=${filter.stars}`);
        }
        
        if (filter.minPrice > 0){
            queryParts.push(`min_price=${filter.minPrice}`);
        }

        if (filter.maxPrice > 0 && filter.maxPrice > filter.minPrice){
            queryParts.push(`max_price=${filter.maxPrice}`);

        }

        const query = queryParts.join("&");
        const decodedQuery = decodeURIComponent(query)
        navigate(`/search?${decodedQuery}`)

    };

    return (
        <Button color="blue" onClick={handleApply}>
            Áp dụng bộ lọc
        </Button>
    )
}