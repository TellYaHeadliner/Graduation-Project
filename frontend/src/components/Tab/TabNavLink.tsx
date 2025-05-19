import { TabNav } from '@radix-ui/themes';
import { useLocation } from 'react-router-dom';

export default function TabNavLink() {

    const location = useLocation();
    const pathname = location.pathname;

    return (
        <TabNav.Root color="green">
            <TabNav.Link href="/khachsan" active={pathname === '/khachsan'}>
                <span className="text-white">
                    Khách sạn
                </span>
            </TabNav.Link>
            <TabNav.Link href="/khuyenmai" active={pathname === '/khuyenmai'}>
                <span className="text-white">
                    Khuyến mãi
                </span>
            </TabNav.Link>
            <TabNav.Link href="toptrending" active={pathname === '/toptrending'}>
                <span className="text-white">
                    Top trending
                </span>
            </TabNav.Link>
            <TabNav.Link href="theomua" active={pathname === '/theomua'}>
                <span className="text-white">
                    Theo mùa
                </span>
            </TabNav.Link>
        </TabNav.Root>
    )
}