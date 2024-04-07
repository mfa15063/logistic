import {useEffect, useState} from "react";
import {ContactDetails} from "../models";
import {fetchContactDetails} from "../js/api";
import {getMapUrl} from "../js/constants";

let Contact = () => {
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
    return (<>
        {/* ======= #main ======= */}
        <main id="main">
            {/* ======= Breadcrumbs ======= */}
            <div className="breadcrumbs d-flex align-items-center"
                 style={{backgroundImage: 'url("/assets/img/breadcrumbs-bg.jpg")'}}>
                <div className="container position-relative d-flex flex-column align-items-center">
                    <h2>Contact</h2>
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li>Contact</li>
                    </ol>
                </div>
            </div>
            {/* End Breadcrumbs */}
            {/* ======= Contact Section ======= */}
            <section id="contact" className="contact py-4">
                <div className="container" data-aos="fade-up" data-aos-delay={100}>
                    <div className="row gy-4">
                        <div className="col-lg-12">
                            <form action="forms/contact.php" method="post" role="form" className="php-email-form">
                                <div className="row gy-4">
                                    <h2>Personal Information</h2>
                                    <div className="col-lg-6 form-group">
                                        <input type="text" name="name" className="form-control" id="name"
                                               placeholder="First Name" required/>
                                    </div>
                                    <div className="col-lg-6 form-group">
                                        <input type="text" name="name" className="form-control" id="name"
                                               placeholder="Last Name" required/>
                                    </div>
                                    <div className="col-lg-6 form-group">
                                        <input type="email" className="form-control" name="email" id="email"
                                               placeholder="Your Email" required/>
                                    </div>
                                    <div className="col-lg-6 form-group">
                                        <input type="email" className="form-control" name="email" id="email"
                                               placeholder="Mobile Number" required/>
                                    </div>
                                </div>
                                <div className="row gy-4">
                                    <h2>Company Information</h2>
                                    <div className="col-lg-6 form-group">
                                        <input type="text" className="form-control" name="email" id="email"
                                               placeholder="Company Name" required/>
                                    </div>
                                    <div className="col-lg-6 form-group">
                                        <input type="url" className="form-control" name="email" id="email"
                                               placeholder="Website URL" required/>
                                    </div>
                                    <div className="col-lg-12 form-group">
                                        <input type="text" className="form-control" name="email" id="email"
                                               placeholder="Address" required/>
                                    </div>
                                    <div className="col-lg-6 form-group">
                                        <input type="text" className="form-control" name="email" id="email"
                                               placeholder="City" required/>
                                    </div>
                                    <div className="col-lg-6 form-group">
                                        <input type="text" className="form-control" name="email" id="email"
                                               placeholder="Country" required/>
                                    </div>
                                </div>
                                <div className="row gy-4">
                                    <h2>Inquiry</h2>
                                    <div className="col-lg-6 form-group">
                                        <select className="form-control" name="email" id="email"
                                                required>
                                            <option value="">Select Inquiry Title</option>
                                        </select>
                                    </div>
                                </div>
                                <div className="form-group">
                                    <div className="col-lg-12 form-group">
                                            <textarea className="form-control" name="message" rows={6}
                                                      placeholder="Inquery Details"
                                                      required defaultValue={""}/>
                                    </div>
                                </div>
                                <div className="my-3">
                                    <div className="loading">Loading</div>
                                    <div className="error-message"/>
                                    <div className="sent-message">Your message has been sent. Thank you!</div>
                                </div>
                                <div className="text-center">
                                    <button type="submit">Send Message</button>
                                </div>
                            </form>
                        </div>
                        {/* End Contact Form */}
                        <div className="col-lg-6">
                            <div
                                className="info-item  d-flex flex-column justify-content-center align-items-center">
                                <i className="bi bi-map"/>
                                <h3>Our Address</h3>
                                <p>{contactDetails.address}</p>
                            </div>
                        </div>
                        {/* End Info Item */}
                        <div className="col-lg-3 col-md-6">
                            <div className="info-item d-flex flex-column justify-content-center align-items-center">
                                <i className="bi bi-envelope"/>
                                <h3>Email Us</h3>
                                <p>{contactDetails.email}</p>
                            </div>
                        </div>
                        {/* End Info Item */}
                        <div className="col-lg-3 col-md-6">
                            <div
                                className="info-item  d-flex flex-column justify-content-center align-items-center">
                                <i className="bi bi-telephone"/>
                                <h3>Call Us</h3>
                                <p>{contactDetails.phone_no}</p>
                            </div>
                        </div>
                        {/* End Info Item */}
                    </div>
                    <div className="row gy-4 mt-1">
                        <div className="col-lg-12 ">
                            <iframe src={getMapUrl(contactDetails.location)}
                                    style={{border: 0, width: '100%', height: 200}} allowFullScreen/>
                        </div>
                        {/* End Google Maps */}
                    </div>
                </div>
            </section>
            {/* End Contact Section */}
        </main>
        {/* End #main */}

    </>);
}

export default Contact;