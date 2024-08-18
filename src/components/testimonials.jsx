import React from 'react';
import { Carousel } from 'react-bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

const Testimonials = () => {
    return (
        <section id="testimonials" className="testimonials section-bg">
            <div className="container" data-aos="fade-up">
                <div className="section-header">
                    <h2>Testimonials</h2>
                    <p>
                        Hear what our satisfied clients have to say about their experience with CarryShipment's reliable and efficient logistics services.
                    </p>
                </div>
                <Carousel>
                    <Carousel.Item className="mb-3">
                        <div className="testimonial-wrap">
                            <div className="testimonial-item">
                                <img
                                    src="assets/img/testimonials/testimonials-1.jpg"
                                    className="testimonial-img"
                                    alt="Client"
                                />
                                <h3>Michael Johnson</h3>
                                <h4>Business Owner</h4>
                                <div className="stars">
                                    {[...Array(5)].map((_, i) => (
                                        <i key={i} className="bi bi-star-fill" />
                                    ))}
                                </div>
                                <p>
                                    <i className="bi bi-quote quote-icon-left" />
                                    CarryShipment has consistently provided top-notch service. Our goods always arrive on time and in perfect condition. Their professional approach and attention to detail have significantly contributed to our smooth operations. We couldn’t ask for a better partner in logistics, and their customer support is second to none.
                                    <i className="bi bi-quote quote-icon-right" />
                                </p>
                            </div>
                        </div>
                    </Carousel.Item>
                    <Carousel.Item className="mb-3">
                        <div className="testimonial-wrap">
                            <div className="testimonial-item">
                                <img
                                    src="assets/img/testimonials/testimonials-2.jpg"
                                    className="testimonial-img"
                                    alt="Client"
                                />
                                <h3>Sarah Williams</h3>
                                <h4>Logistics Manager</h4>
                                <div className="stars">
                                    {[...Array(5)].map((_, i) => (
                                        <i key={i} className="bi bi-star-fill" />
                                    ))}
                                </div>
                                <p>
                                    <i className="bi bi-quote quote-icon-left" />
                                    Their attention to detail and commitment to customer satisfaction is unmatched. We rely on CarryShipment for all our city-to-city shipments, and they have never let us down. The efficiency with which they handle our cargo and their proactive communication make them an invaluable part of our supply chain. The reliability and cost-effectiveness of their services are crucial to our operations.
                                    <i className="bi bi-quote quote-icon-right" />
                                </p>
                            </div>
                        </div>
                    </Carousel.Item>
                    <Carousel.Item className="mb-3">
                        <div className="testimonial-wrap">
                            <div className="testimonial-item">
                                <img
                                    src="assets/img/testimonials/testimonials-3.jpg"
                                    className="testimonial-img"
                                    alt="Client"
                                />
                                <h3>David Brown</h3>
                                <h4>Entrepreneur</h4>
                                <div className="stars">
                                    {[...Array(5)].map((_, i) => (
                                        <i key={i} className="bi bi-star-fill" />
                                    ))}
                                </div>
                                <p>
                                    <i className="bi bi-quote quote-icon-left" />
                                    CarryShipment’s services are reliable and cost-effective. Our business has grown thanks to their dependable transportation network. They offer a seamless experience from booking to delivery, and their competitive pricing has allowed us to manage our logistics budget more efficiently. We appreciate their commitment to excellence and look forward to continuing our partnership with them.
                                    <i className="bi bi-quote quote-icon-right" />
                                </p>
                            </div>
                        </div>
                    </Carousel.Item>
                    {/* Add more Carousel.Items for additional testimonials */}
                </Carousel>
            </div>
        </section>
    );
};

export default Testimonials;
