import React, { Component } from "react";
import { Link, Outlet } from "react-router-dom";
import "../styles/side-bar.scss";

class SideBar extends Component {
  componentDidMount() {
    require("../js/side-bar");
  }

  render() {
    const { isLoggedIn } = this.props.all?.globals;

    return (
      <div className="profile-page">
        <Link className="toggle mobile-toggle" style={{ display: "none" }}>
          <i className="fas fa-bars" />
        </Link>
        <nav>
          <ul>
            <li>
              <Link className="toggle">
                <span className="icon">
                  <i className="fas fa-bars" />
                </span>
                <span className="title">Menu</span>
              </Link>
            </li>
            <li display-if={isLoggedIn}>
              <Link to="/profile">
                <span className="icon">
                  <i className="fas fa-user" />
                </span>
                <span className="title">Profile</span>
              </Link>
            </li>
            <li display-if={!isLoggedIn}>
              <Link to="/signup">
                <span className="icon">
                  <i className="fas fa-user" />
                </span>
                <span className="title">Sign Up</span>
              </Link>
            </li>
            <li display-if={!isLoggedIn}>
              <Link to="/signin">
                <span className="icon">
                  <i className="fas fa-user" />
                </span>
                <span className="title">Sign In</span>
              </Link>
            </li>
          </ul>
        </nav>
        <div className="profile-right">
          <Outlet />
        </div>
      </div>
    );
  }
}

export default SideBar;
