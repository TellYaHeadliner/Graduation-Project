import { User } from '../types/UserTypes';
import { useUserInfoQuery } from "../react-query/useUserInfoQuery";

export default function useAuth() {
  const { data, isLoading, isError } = useUserInfoQuery();

  const user: User | null = isError ? null : data?.data?.user ?? null;
  return {
    user,
    loading: isLoading,
  };
}

