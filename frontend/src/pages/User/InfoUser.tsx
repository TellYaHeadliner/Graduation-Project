import MainLayout from "../../layouts/MainLayout";

import useTitle from "../../hooks/useTitle";
import ProfileTabs from "../../components/DataList/DataListInfoUser";
import LoadingPage from "../LoadingPage";
import useAuth from "../../hooks/useAuth";

export default function InfoUser() {
    useTitle("Thông tin cá nhân");

    const { user } = useAuth()

    if (!user) {
        return (
            <LoadingPage />
        )
    }

    return (
        <MainLayout>
            <ProfileTabs user={user}/>
        </MainLayout>
    )
}