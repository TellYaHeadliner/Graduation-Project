import React, { useState } from 'react';

interface DiscountItemProps {
  discountCode: string;
  description: string;
  dateDiscount: Date;
}

export default function DiscountItem({
  discountCode,
  description,
  dateDiscount,
}: DiscountItemProps) {
  const [copied, setCopied] = useState(false);

  const handleCopy = async () => {
    try {
      await navigator.clipboard.writeText(discountCode);
      setCopied(true);
      setTimeout(() => setCopied(false), 2000);
    } catch (err) {
      console.error('Lỗi khi copy:', err);
    }
  };

  return (
    <div className="rounded-lg border border-gray-300 p-3 shadow-sm bg-white space-y-2">
      <div className="flex items-center gap-2 text-sm text-gray-600">
        <span>Nhập mã:</span>
        <button
          onClick={handleCopy}
          className="px-2 py-0.5 bg-blue-100 text-blue-600 font-semibold rounded hover:bg-blue-200 text-xs"
        >
          {copied ? '✅ Đã copy' : discountCode}
        </button>
      </div>

      <p className="text-sm font-medium text-gray-800">{description}</p>

      <div className="text-xs text-gray-400">
        Hạn sử dụng: {dateDiscount.toLocaleDateString('vi-VN')}
      </div>
    </div>
  );
}
