import api from "./axiosConfig";
import { AmentityResponse } from "../types/AmentityTypes";

const amentityApi = {
    getAmentites: (): Promise<AmentityResponse> => {
        return api.get('/amenities')
    }
}

export default amentityApi;