import { Component } from "react";
import { Outlet } from "react-router-dom";
import { Footer } from "../components/exports";

class LayoutWithHeader extends Component {
  render() {
    return (
      <>
        <Outlet />
        <Footer />
      </>
    );
  }
}

export default LayoutWithHeader;
