import {Component} from "react";
import {Outlet} from "react-router-dom";
import {Footer, Header, WhatsappBtn} from "../components/exports";

class LayoutWithHeader extends Component {
    render() {
        return (
            <>
                <Header/>
                <Outlet/>
                <Footer/>
                <WhatsappBtn/>
            </>
        );
    }
}

export default LayoutWithHeader;
