import React, { useEffect } from "react";
import "../styles/profile-page.scss";
import SignUp from "../components/signup";
import ProfileComponent from "../components/profile";

const Profile = () => {
  useEffect(() => {
    let header = document.getElementById("header");
    if (header) header.classList.add("profile-header");
    let getSidebar = document.querySelector(".profile-page nav");
    let getToggle = document.querySelectorAll(".profile-page .toggle");
    let handleToggleClick = () => {
      if (getSidebar) getSidebar.classList.toggle("active");
    };
    getToggle.forEach((toggle) => {
      toggle.addEventListener("click", handleToggleClick);
    });

    return () => {
      getToggle.forEach((toggle) => {
        toggle.removeEventListener("click", handleToggleClick);
      });
    };
  }, []);
  return (
    <div className="profile-page">
      <div className="toggle ioooi" style={{ display: "none" }}>
        <i className="fas fa-bars" />
      </div>
      <nav>
        <ul>
          <li>
            <a className="toggle">
              <span className="icon">
                <i className="fas fa-bars" />
              </span>
              <span className="title">Menu</span>
            </a>
          </li>
          <li>
            <a href="#">
              <span className="icon">
                <i className="fas fa-home" />
              </span>
              <span className="title">Home</span>
            </a>
          </li>
          <li>
            <a href="#">
              <span className="icon">
                <i className="fas fa-user" />
              </span>
              <span className="title">Profile</span>
            </a>
          </li>
          <li>
            <a href="#">
              <span className="icon">
                <i className="fas fa-envelope" />
              </span>
              <span className="title">Messages</span>
            </a>
          </li>
          <li>
            <a href="#">
              <span className="icon">
                <i className="fas fa-info" />
              </span>
              <span className="title">Help</span>
            </a>
          </li>
          <li>
            <a href="#">
              <span className="icon">
                <i className="fas fa-cog" />
              </span>
              <span className="title">Setting</span>
            </a>
          </li>
          <li>
            <a href="#">
              <span className="icon">
                <i className="fas fa-lock" />
              </span>
              <span className="title">Password</span>
            </a>
          </li>
          <li>
            <a href="#">
              <span className="icon">
                <i className="fas fa-sign-out-alt" />
              </span>
              <span className="title">Sign Out</span>
            </a>
          </li>
        </ul>
      </nav>
      <div className="profile-right">
        {/* <SignUp/> */}
        <ProfileComponent/>
      </div>
    </div>
  );
};

export default Profile;
