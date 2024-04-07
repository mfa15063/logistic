let Contact = () => {
    let embeded = `                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3477.0448507150404!2d71.70229397460321!3d29.368975950259646!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x393b913f9b54fb89%3A0x8c6d9ca4809a6d3b!2sTech%20Thrill!5e0!3m2!1sen!2sus!4v1712471376061!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    `;
    let parser = new DOMParser();
    embeded = parser.parseFromString(embeded, 'text/html');
    embeded.url = embeded.querySelector('iframe').getAttribute('src');
    return (
        <>
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
                <section id="contact" className="contact">
                    <div className="container" data-aos="fade-up" data-aos-delay={100}>
                        <div className="row gy-4">
                            <div className="col-lg-6">
                                <div
                                    className="info-item  d-flex flex-column justify-content-center align-items-center">
                                    <i className="bi bi-map"/>
                                    <h3>Our Address</h3>
                                    <p>A108 Adam Street, New York, NY 535022</p>
                                </div>
                            </div>
                            {/* End Info Item */}
                            <div className="col-lg-3 col-md-6">
                                <div className="info-item d-flex flex-column justify-content-center align-items-center">
                                    <i className="bi bi-envelope"/>
                                    <h3>Email Us</h3>
                                    <p>contact@example.com</p>
                                </div>
                            </div>
                            {/* End Info Item */}
                            <div className="col-lg-3 col-md-6">
                                <div
                                    className="info-item  d-flex flex-column justify-content-center align-items-center">
                                    <i className="bi bi-telephone"/>
                                    <h3>Call Us</h3>
                                    <p>+1 5589 55488 55</p>
                                </div>
                            </div>
                            {/* End Info Item */}
                        </div>
                        <div className="row gy-4 mt-1">
                            <div className="col-lg-12 ">
                                <iframe src={embeded.url} style={{border: 0, width: '100%', height: 200}} allowFullScreen/>
                            </div>
                            {/* End Google Maps */}
                            <div className="col-lg-6">
                                <form action="forms/contact.php" method="post" role="form" className="php-email-form">
                                    <div className="row gy-4">
                                        <div className="col-lg-6 form-group">
                                            <input type="text" name="name" className="form-control" id="name"
                                                   placeholder="Your Name" required/>
                                        </div>
                                        <div className="col-lg-6 form-group">
                                            <input type="email" className="form-control" name="email" id="email"
                                                   placeholder="Your Email" required/>
                                        </div>
                                    </div>
                                    <div className="form-group">
                                        <input type="text" className="form-control" name="subject" id="subject"
                                               placeholder="Subject" required/>
                                    </div>
                                    <div className="form-group">
                                        <textarea className="form-control" name="message" rows={5} placeholder="Message"
                                                  required defaultValue={""}/>
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
                        </div>
                    </div>
                </section>
                {/* End Contact Section */}
            </main>
            {/* End #main */}

        </>
    );
}

export default Contact;