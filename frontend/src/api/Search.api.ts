import { PayloadSearchParams, SearchResponse } from "../types/SearchTypes";
import api from "./axiosConfig";

const searchApi = {
    search: (data: PayloadSearchParams): Promise<SearchResponse> => {
        return api.post('/hotels/search', data);
    }
}

export default searchApi;