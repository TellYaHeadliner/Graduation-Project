import AccordionCustom from "../Accordion/AccordionCustom";
import FooterInfoStatic from "./FooterInfoStatic";

export default function Footer(){
    const year = new Date().getFullYear();

    return (
        <footer className="text-center ">
            <div className="sm:hidden">
                <AccordionCustom />
            </div>

            <div className="hidden sm:flex">
                <FooterInfoStatic />
            </div>
            
            © {year} Roomix. Bảo lưu mọi quyền.
        </footer>
    );
}