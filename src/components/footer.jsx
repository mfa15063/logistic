import {useEffect, useState} from "react";
import {fetchContactDetails} from "../js/api";
import {ContactDetails} from "../models";

export default function Footer() {
    const [contactDetails, setContactDetails] = useState(JSON.parse(localStorage.contactDetails || null) || ContactDetails);
    useEffect(() => {
        fetchContactDetails().then(res => {
            try {
                if (res.success) {
                    setContactDetails(res.data);
                } else {
                    throw Error(res.message);
                }
            } catch (error) {
                console.log(error.message);
            }
        });
    }, []);
    return (
        <>
            {/* ======= Footer ======= */}
            <footer id="footer" className="footer">
                <div className="footer-content position-relative">
                    <div className="container">
                        <div className="row">
                            <div className="col-lg-4 col-md-6">
                                <div className="footer-info">
                                    <h3>UpConstruction</h3>
                                    <p>
                                        {contactDetails.address}
                                        <br/>
                                        <br/>
                                        <strong>Phone:</strong> {contactDetails.phone_no}
                                        <br/>
                                        <strong>Email:</strong> {contactDetails.email}
                                        <br/>
                                    </p>
                                    <div className="social-links d-flex mt-3">
                                        <a
                                            href="#"
                                            className="d-flex align-items-center justify-content-center"
                                        >
                                            <i className="bi bi-twitter"/>
                                        </a>
                                        <a
                                            href={contactDetails.facebook_profile}
                                            className="d-flex align-items-center justify-content-center"
                                        >
                                            <i className="bi bi-facebook"/>
                                        </a>
                                        <a
                                            href={contactDetails.instagram_profile}
                                            className="d-flex align-items-center justify-content-center"
                                        >
                                            <i className="bi bi-instagram"/>
                                        </a>
                                        <a
                                            href="#"
                                            className="d-flex align-items-center justify-content-center"
                                        >
                                            <i className="bi bi-linkedin"/>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            {/* End footer info column*/}
                            <div className="col-lg-2 col-md-3 footer-links">
                                <h4>Useful Links</h4>
                                <ul>
                                    <li>
                                        <a href="/">Home</a>
                                    </li>
                                    <li>
                                        <a href="/about">About us</a>
                                    </li>
                                    <li>
                                        <a href="#">Services</a>
                                    </li>
                                    <li>
                                        <a href="#">Terms of service</a>
                                    </li>
                                    <li>
                                        <a href="#">Privacy policy</a>
                                    </li>
                                </ul>
                            </div>
                            {/* End footer links column*/}
                            <div className="col-lg-2 col-md-3 footer-links">
                                <h4>Our Services</h4>
                                <ul>
                                    <li>
                                        <a href="#">Web Design</a>
                                    </li>
                                    <li>
                                        <a href="#">Web Development</a>
                                    </li>
                                    <li>
                                        <a href="#">Product Management</a>
                                    </li>
                                    <li>
                                        <a href="#">Marketing</a>
                                    </li>
                                    <li>
                                        <a href="#">Graphic Design</a>
                                    </li>
                                </ul>
                            </div>
                            {/* End footer links column*/}
                            <div className="col-lg-2 col-md-3 footer-links">
                                <h4>Hic solutasetp</h4>
                                <ul>
                                    <li>
                                        <a href="#">Molestiae accusamus iure</a>
                                    </li>
                                    <li>
                                        <a href="#">Excepturi dignissimos</a>
                                    </li>
                                    <li>
                                        <a href="#">Suscipit distinctio</a>
                                    </li>
                                    <li>
                                        <a href="#">Dilecta</a>
                                    </li>
                                    <li>
                                        <a href="#">Sit quas consectetur</a>
                                    </li>
                                </ul>
                            </div>
                            {/* End footer links column*/}
                            <div className="col-lg-2 col-md-3 footer-links">
                                <h4>Nobis illum</h4>
                                <ul>
                                    <li>
                                        <a href="#">Ipsam</a>
                                    </li>
                                    <li>
                                        <a href="#">Laudantium dolorum</a>
                                    </li>
                                    <li>
                                        <a href="#">Dinera</a>
                                    </li>
                                    <li>
                                        <a href="#">Trodelas</a>
                                    </li>
                                    <li>
                                        <a href="#">Flexo</a>
                                    </li>
                                </ul>
                            </div>
                            {/* End footer links column*/}
                        </div>
                    </div>
                </div>
                <div className="footer-legal text-center position-relative">
                    <div className="container">
                        <div className="copyright">
                            © Copyright{" "}
                            <strong>
                                <span>UpConstruction</span>
                            </strong>
                            . All Rights Reserved
                        </div>
                        <div className="credits">
                            {/* All the links in the footer should remain intact. */}
                            {/* You can delete the links only if you purchased the pro version. */}
                            {/* Licensing information: https://bootstrapmade.com/license/ */}
                            {/* Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/ */}
                            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                        </div>
                    </div>
                </div>
            </footer>
            {/* End Footer */}
        </>
    );
}
