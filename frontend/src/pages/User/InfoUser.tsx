import MainLayout from "../../layouts/MainLayout";

import useTitle from "../../hooks/useTitle";
import ProfileTabs from "../../components/DataList/DataListInfoUser";

export default function InfoUser() {
    useTitle("Thông tin cá nhân");

    return (
        <MainLayout>
            <ProfileTabs />
        </MainLayout>
    )
}