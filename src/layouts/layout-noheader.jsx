import { Outlet } from "react-router-dom";



function LayoutWithOutHeader() {

    let header = document.getElementById("header");
    if (header) header.remove();
    console.log(5);

    return (
        <Outlet />
    );
}

export default LayoutWithOutHeader;