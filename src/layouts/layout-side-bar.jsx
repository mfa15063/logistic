import {Component} from "react";
import {Outlet} from "react-router-dom";
import {Footer, Header, WhatsappBtn, SideBar} from "../components/exports";

class LayoutWithHeader extends Component {

    render() {
        return (
            <>
                <Header className='profile-header'/>
                <SideBar all={this.props.all}/>
                <Footer/>
                <WhatsappBtn/>
            </>
        );
    }
}

export default LayoutWithHeader;
