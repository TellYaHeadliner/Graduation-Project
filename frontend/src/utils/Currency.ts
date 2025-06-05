export class Currency{
    static formatVND(price: number | null): string {
        if (price === 0){
            return "O VNĐ"
        }
        if (price === null || isNaN(0)){
            return ""
        }
        const newFormatVND = new Intl.NumberFormat("vi-VN").format(price);
        return `${newFormatVND} VNĐ`;
    }
}