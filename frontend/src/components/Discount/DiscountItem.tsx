import { useState } from 'react';

interface DiscountItemProps {
  discountType: number;
  discountCode: string;
  discountValue: number;
  minDiscountValue: number;
  maxDiscountValue: number;
  startDate: string;
  endDate: string;
  total: number;
}

export default function DiscountItem({
  discountCode,
  startDate,
  endDate,
  discountType,
  discountValue,
  maxDiscountValue,
  minDiscountValue,
  total }: DiscountItemProps) {
  const [copied, setCopied] = useState(false);
  const isEligible = total >= minDiscountValue;
  
  const handleCopy = async () => {
    if (!isEligible) return;
    try {
      await navigator.clipboard.writeText(discountCode);
      setCopied(true);
      setTimeout(() => setCopied(false), 2000);
    } catch (err) {
      console.error('Lỗi khi copy:', err);
    }
  };

  const formatDate = (dateString: string) => {
    const [year, month, day] = dateString.split("-")
    return `${Number(day)}/${Number(month)}/${year}`;
  }

  const renderDiscountValue = () => {
    if (discountType === 1) {
      return `${discountValue}% (tối đa ${maxDiscountValue.toLocaleString()}₫)`;
    } else {
      return `${discountValue.toLocaleString()}₫`;
    }
  };

  return (
    <div
      className={`rounded-xl border p-4 shadow-sm space-y-2 transition-all duration-300 ${
        isEligible
          ? 'border-gray-200 bg-white'
          : 'border-gray-100 bg-gray-50 opacity-60 pointer-events-none'
      }`}
    >
      <div className="flex items-center justify-between">
        <div className="text-sm font-semibold text-gray-700">Mã giảm giá</div>
        <button
          onClick={handleCopy}
          className={`px-2 py-1 text-xs rounded transition ${
            isEligible
              ? 'bg-blue-100 text-blue-600 hover:bg-blue-200'
              : 'bg-gray-200 text-gray-500 cursor-not-allowed'
          }`}
        >
          {copied ? 'Đã áp dụng' : discountCode}
        </button>
      </div>

      <div className="text-sm text-gray-600">
        Giảm: <span className="font-medium text-black">{renderDiscountValue()}</span>
      </div>

      <div className="text-xs text-gray-500">
        Áp dụng cho đơn từ: <strong>{minDiscountValue.toLocaleString()}₫</strong>
      </div>

      <div className="text-xs text-gray-400">
        Hạn dùng: {formatDate(startDate)} - {formatDate(endDate)}
      </div>

      {!isEligible && (
        <div className="text-xs text-red-500 font-semibold">
          * Không đủ điều kiện để áp dụng
        </div>
      )}
    </div>
  );
}
