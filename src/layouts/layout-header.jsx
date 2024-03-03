import { Component } from "react";
import { Outlet } from "react-router-dom";
import { Footer } from "../components/exports";
import Wattsapp from "../pages/Wattsapp";

class LayoutWithHeader extends Component {
  render() {
    return (
      <>
        <Outlet />
       
        <Footer />
        <Wattsapp/>
      </>
    );
  }
}

export default LayoutWithHeader;
