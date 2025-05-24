import AccordionCustom from "../Accordion/AccordionCustom";

export default function Footer(){
    const year = new Date().getFullYear();

    return (
        <footer className="text-center ">
            <AccordionCustom />
            © {year} Roomix. Bảo lưu mọi quyền.
        </footer>
    );
}