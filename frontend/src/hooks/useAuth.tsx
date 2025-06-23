/* eslint-disable no-console */
import { useEffect, useState } from "react";
import { User } from '../types/UserTypes';
import authApi from "../api/Auth.api";


export default function useAuth(){
    const [user, setUser] = useState<User | null>(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchUser = async () => {
            try {
              const userInfoResponse = await authApi.userInfo();
              setUser(userInfoResponse.data.user);
              setLoading(false);
            } catch (error) {
              setUser(null);
              console.error(error)
              setLoading(false)
            } 
        };
        fetchUser();
    }, [user]);

    return { user, loading };
}

