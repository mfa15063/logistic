import { Outlet } from "react-router-dom";
import Footer from "../components/footer";

function LayoutWithHeader() {
    return (
        <>
            <Outlet />
            <Footer />
        </>
    );
}

export default LayoutWithHeader;