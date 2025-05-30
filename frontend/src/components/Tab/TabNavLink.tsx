import { useState } from 'react';

import HotelLogo from "../../assets/hotel-logo.svg"
import TheoMua from "../../assets/theo-mua.svg"
import Discount from "../../assets/discount.svg"
import TopTrending from "../../assets/top-trending.svg"

export default function TabNavLink() {

    const [activeTab, setActiveTab ] = useState('khachsan');

    const navItems = [
        { id: 'khachsan', label: 'Khách sạn', icon: HotelLogo },
        { id: 'khuyenmai', label: 'Khuyến mãi', icon: Discount },
        { id: 'toptrending', label: 'Top trending', icon: TopTrending },
        { id: 'theomua', label: 'Theo mùa', icon: TheoMua },
    ];

    return (
        <nav className="flex gap-4 p-2">
            {navItems.map((item) => (
                <a
                    key={item.id}
                    href={`/${item.id}`}
                    onClick={() => setActiveTab(item.id)}
                    className={`flex items-center gap-1 px-2 py-1 rounded-lg border border-white text-white transition-colors duration-200 
                        ${activeTab === item.id ? 'bg-primary' : 'hover:bg-primary'}`}
                >
                    <img src={item.icon} alt="" className='w-10 h-10'/>
                    <span>{item.label}</span>
                </a>
            ))}
        </nav>
    );
}