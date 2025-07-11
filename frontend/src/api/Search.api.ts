import { PayloadSearchParams, SearchResponse } from "../types/SearchTypes";
import api from "./axiosConfig"
import * as qs from 'qs'

const searchApi = {
    search: (data: PayloadSearchParams & { amenties?: number[] }): Promise<SearchResponse> => {
        return api.get('/hotels/search', {
            params: data,
            paramsSerializer: {
              serialize: (params) =>
                qs.stringify(params, { arrayFormat: 'brackets' }), 
            },
        });
    }
}

export default searchApi;