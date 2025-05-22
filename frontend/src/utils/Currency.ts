export class Currency{
    static formatVND(price: number): string {
        if (isNaN(price)){
            return "0 VND"
        }
        const newFormatVND = new Intl.NumberFormat("vi-VN", {style: "currency", currency: "VND"}).format(price)
        return newFormatVND;
    }
}