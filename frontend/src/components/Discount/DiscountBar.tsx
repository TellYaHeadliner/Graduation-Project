import { useState } from 'react';
import DiscountItem from './DiscountItem';

export default function DiscountBar() {
  const [copied, setCopied] = useState(false);

  return (
    <div className="border-2 border-orange-400 bg-white rounded-lg p-4 max-w-md">
        <p className="text-sm font-medium text-black mb-2">Mã ưu đãi:</p>
        <DiscountItem 
          discountCode="ANDROIDONL50"
          description="Giảm 50.000đ"
          dateDiscount={new Date("2025-07-01")}
        />
    </div>
  );
}
