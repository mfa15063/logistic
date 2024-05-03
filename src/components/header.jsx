import {useEffect, useRef, useState} from "react";
import {fetchContactDetails} from "../js/api";
import {ContactDetails} from "../models";
import {Link} from "react-router-dom";
import {scrollToElement, scrollToTop} from "../js/constants";

export default function Header(props) {
    const mobileNavShow = useRef(null);
    const mobileNavHide = useRef(null);
    const [userLogin, setUserLogin] = useState(false);

    const mobileNavToggle = (e) => {
        e = e.target;
        if (e.classList.contains("mobile-nav-show")) {
            document.querySelector('body').classList.add('mobile-nav-active');
            mobileNavShow.current.classList.add('d-none');
            mobileNavHide.current.classList.remove('d-none');
        } else if (e.classList.contains("mobile-nav-hide")) {
            document.querySelector('body').classList.remove('mobile-nav-active');
            mobileNavShow.current.classList.remove('d-none');
            mobileNavHide.current.classList.add('d-none');
        }
    }

    useEffect(()=>{
        if (window.sessionStorage.authToken !== undefined)
            setUserLogin(true);
    }, []);

    return (
        <>
            {/* ======= Header ======= */}
            <header id="header" className={"header d-flex align-items-center " + props?.className}>
                <div className="container-fluid container-xl d-flex align-items-center justify-content-between">
                    <Link to="/" id="site-logo" className="logo d-flex align-items-center">
                        {/* Uncomment the line below if you also wish to use an image logo */}
                        <img src="assets/img/logo.png" alt="Logo"/>
                        {/* <h1>UpConstruction<span>.</span></h1> */}
                    </Link>
                    <i className="mobile-nav-toggle mobile-nav-show bi bi-list" ref={mobileNavShow} onClick={mobileNavToggle}/>
                    <i className="mobile-nav-toggle mobile-nav-hide d-none bi bi-x" ref={mobileNavHide} onClick={mobileNavToggle}/>
                    <nav id="navbar" className="navbar">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><a href="/about">About</a></li>
                            <li><Link to="/services">Services</Link></li>
                            <li><a href="/track-shipment">Track Shipment</a></li>
                            <li><a href="/contact">Contact</a></li>
                            <li className="dropdown d-none d-lg-block"><Link to="/profile"><span>Account</span> <i
                                className="bi bi-chevron-down dropdown-indicator"/></Link>
                                <ul>
                                    <li><a href="#">Profile</a></li>
                                    <li><a href="#">Profile 2</a></li>
                                    <li><a href="#">Profile 3</a></li>
                                    <li><a href="#" display-if={userLogin}>Logout</a></li>
                                </ul>
                            </li>
                            <li className="d-lg-none" display-if={userLogin}><Link to="/profile">Account</Link></li>
                            <li className="d-lg-none" display-if={!userLogin}><Link to="/signin">Login</Link></li>
                            <li className="d-lg-none" display-if={!userLogin}><Link to="/signup">Register</Link></li>
                        </ul>
                    </nav>
                    {/* .navbar */}
                </div>
            </header>
            {/* End Header */}
        </>
    );
}
