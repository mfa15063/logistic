import React, {useState, useEffect, useRef} from "react";
import { Link, Outlet } from "react-router-dom";
import "../styles/side-bar.scss";
import { fetchUserProfile } from "../js/api";

export default function SideBar(props) {
    const [loading, setLoading] = useState(true);
    const sideNav = useRef(null);

    const handleToggleClick = () => {
        sideNav.current.classList.toggle("active");
    };

    useEffect(() => {
        if (window.sessionStorage.authToken) {
            fetchData();
        } else {
            setLoading(false);
        }
    }, []); // Only run once on mount

    const fetchData = async () => {
        const { setUser } = props.all;

        try {
            const userData = await fetchUserProfile();
            if (userData.success) {
                setUser({
                    ...userData.data,
                    isLoggedIn: true,
                });
            }
        } finally {
            setLoading(false);
        }
    };

    return (
        <div className="profile-page">
            <Link display-if={!loading} className="toggle mobile-toggle" style={{ display: "none" }} onClick={handleToggleClick}>
                <i className="fas fa-bars" />
            </Link>
            <nav ref={sideNav} display-if={!loading}>
                <ul>
                    <li>
                        <Link className="toggle" onClick={handleToggleClick}>
                            <span className="icon">
                                <i className="fas fa-bars" />
                            </span>
                            <span className="title">Menu</span>
                        </Link>
                    </li>
                    <li>
                        <Link to="/profile">
                            <span className="icon">
                                <i className="fas fa-user" />
                            </span>
                            <span className="title">Profile</span>
                        </Link>
                    </li>
                    <li>
                        <Link to="/edit-profile">
                            <span className="icon">
                                <i className="fas fa-user-edit" />
                            </span>
                            <span className="title">Edit Profile</span>
                        </Link>
                    </li>
                </ul>
            </nav>
            {!loading ? (
                <div className="profile-right gradient-custom-2">
                    <Outlet />
                </div>
            ) : (
                <div className="profile-right">
                    <div id="preloader" style={{ position: "relative" }}></div>
                </div>
            )}
        </div>
    );
}
