import { Link } from "react-router-dom";
import {HeroSection, Testimonials, Chat} from "../components/exports";
import { scrollToElement } from "../js/constants";
import React, {useEffect, useState} from "react";
import {ContactDetails} from "../models";
import {fetchContactDetails} from "../js/api";

function Home() {
  let [contactDetails, setContactDetails] = useState(JSON.parse(localStorage.contactDetails || null) || ContactDetails);
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
      <HeroSection />
      {/* <Link to="about">new</Link> */}
      {/* <StatusBar status="Picked up" /> */}
      {/* ======= #main ======= */}
      <main id="main">
        {/* ======= Get Started Section ======= */}
        <section id="get-started" className="get-started section-bg">
          <div className="container">
            <div className="row justify-content-between gy-4">
              <div
                  className="col-lg-6 d-flex align-items-center"
                  data-aos="fade-up"
              >
                <div className="content">
                  <h3>Welcome to <span className="site-name-primary">Carry Shipment</span></h3>
                  <p>
                    Unlock the full potential of your logistics with Carry Shipment. Beyond shipping, we optimize every step, from sourcing to delivery. Our experts craft customizable solutions that drive efficiency and growth. With our commitment to being <strong>Fast, Reliable, Global</strong>, we ensure your goods reach their destination seamlessly and on time.
                  </p>
                </div>
              </div>
              <div className="col-lg-5" data-aos="fade">
                <form
                    action="forms/quote.php"
                    method="post"
                    className="php-email-form"
                >
                  <h3>Location</h3>
                  <p>
                    Find us easily and plan your visit. Our office is situated in a convenient location, and we are always here to assist with your shipping needs. As part of our commitment to being <strong>Fast, Reliable, Global</strong>, we ensure our services are accessible and responsive.
                  </p>
                  <div className="row gy-3">
                    <div className="col-md-12">
                      <iframe src={"https://www.google.com/maps/embed/v1/place?key=AIzaSyA5DW0zd4-Myw4JuPdAEqYA3Es8cRlza7c&q=" + contactDetails.location}
                              style={{border: 0, width: '100%', height: 200}} frameBorder="0" allowFullScreen/>
                    </div>
                  </div>
                </form>
              </div>
              {/* End Quote Form */}
            </div>
          </div>
        </section>
        {/* End Get Started Section */}
        {/* ======= Constructions Section ======= */}
        <section id="constructions" className="constructions">
          <div className="container" data-aos="fade-up">
            <div className="section-header">
              <h3 style={{fontSize: "36px"}}>What We <span className="site-name-primary">Offer</span></h3>
              <p></p>
            </div>
            <div className="row gy-4">
              <div className="col-lg-6" data-aos="fade-up" data-aos-delay={100}>
                <div className="card-item" style={{ margin: 0, padding: 0 }}>
                  <div className="row" style={{ margin: 0, padding: 0 }}>
                    <div className="col-xl-5" style={{ margin: 0, padding: 0 }}>
                      <div
                          className="card-bg"
                          style={{
                            backgroundImage: "url(assets/img/Sone.png.jpg)",
                            height: "340px",
                          }}
                      />
                    </div>
                    <div className="col-xl-7 d-flex align-items-center">
                      <div className="card-body  lh-1">
                        <h4 className="card-title">Land Freight</h4>
                        <p>
                          CarryShipment brings exceptional expertise and extensive experience in road and rail transport. Leveraging our vast network, we excel at balancing time, cost, and performance to meet your specific needs efficiently. Our focus is on delivering optimal solutions that align with your logistics goals and operational requirements.
                        </p>
                        <Link
                            to="/services" scroll-to="#service-1" onClick={scrollToElement}
                            className="readmore stretched-link learn-more-link"
                        >
                          Learn more <i className="bi bi-arrow-right fs-4 ps-2 learn-more-icon" />
                        </Link>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              {/* End Card Item */}
              <div className="col-lg-6" data-aos="fade-up" data-aos-delay={200}>
                <div className="card-item" style={{ margin: 0, padding: 0 }}>
                  <div className="row" style={{ margin: 0, padding: 0 }}>
                    <div className="col-xl-5" style={{ margin: 0, padding: 0 }}>
                      <div
                          className="card-bg"
                          style={{
                            backgroundImage: "url(assets/img/Stwo.jpg)",
                            height: "340px",
                          }}
                      />
                    </div>
                    <div className="col-xl-7 d-flex align-items-center">
                      <div className="card-body lh-1">
                        <h4 className="card-title">
                          Warehousing Distribution
                        </h4>
                        <p>
                          Simplify your warehousing needs with CarryShipment. Our freight consolidation services with a trusted logistics partner help reduce unnecessary costs. Whether you have one pallet or one hundred, we offer integrated supply chain solutions that ensure efficient handling and storage of your goods. Our services are designed to optimize your inventory management and operational efficiency.
                        </p>
                        <Link
                            to="/services" scroll-to="#service-2" onClick={scrollToElement}
                            className="readmore stretched-link learn-more-link"
                        >
                          Learn more <i className="bi bi-arrow-right fs-4 ps-2 learn-more-icon" />
                        </Link>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              {/* End Card Item */}
              <div className="col-lg-6" data-aos="fade-up" data-aos-delay={300}>
                <div className="card-item" style={{ margin: 0, padding: 0 }}>
                  <div className="row" style={{ margin: 0, padding: 0 }}>
                    <div className="col-xl-5" style={{ margin: 0, padding: 0 }}>
                      <div
                          className="card-bg"
                          style={{
                            backgroundImage: "url(assets/img/Sthree.jpg)",
                            height: "340px",
                          }}
                      />
                    </div>
                    <div className="col-xl-7 d-flex  align-items-center">
                      <div className="card-body  lh-1">
                        <h4 className="card-title">
                          Intermodal/Multimodal Freight
                        </h4>
                        <p>
                          CarryShipment’s intermodal transportation services combine both road and rail options to offer you greater flexibility and increased capacity. Our solutions provide reliable lead times and significantly reduce your carbon footprint. By integrating multiple modes of transport, we ensure cost-effective and efficient delivery that meets your logistics needs.
                        </p>
                        <Link
                            to="/services" scroll-to="#service-3" onClick={scrollToElement}
                            className="readmore stretched-link learn-more-link"
                        >
                          Learn more <i className="bi bi-arrow-right fs-4 ps-2 learn-more-icon" />
                        </Link>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              {/* End Card Item */}
              <div className="col-lg-6" data-aos="fade-up" data-aos-delay={400}>
                <div className="card-item" style={{ margin: 0, padding: 0 }}>
                  <div className="row" style={{ margin: 0, padding: 0 }}>
                    <div className="col-xl-5" style={{ margin: 0, padding: 0 }}>
                      <div
                          className="card-bg"
                          style={{
                            backgroundImage: "url(assets/img/Sfour.jpg)",
                            height: "340px",

                          }}
                      />
                    </div>
                    <div className="col-xl-7 d-flex  align-items-center">
                      <div className="card-body lh-1">
                        <h4 className="card-title">Reverse Supply Chain</h4>
                        <p>
                          CarryShipment has developed a comprehensive reverse logistics program to manage product returns effectively. Our system allows you to recoup revenue while minimizing environmental impacts. We handle the entire process of returns, ensuring that your reverse logistics operations are streamlined and cost-efficient.
                        </p>
                        <Link
                            to="/services" scroll-to="#service-4" onClick={scrollToElement}
                            className="readmore stretched-link learn-more-link"
                        >
                          Learn more <i className="bi bi-arrow-right fs-4 ps-2 learn-more-icon" />
                        </Link>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="col-lg-6" data-aos="fade-up" data-aos-delay={400}>
                <div className="card-item" style={{ margin: 0, padding: 0 }}>
                  <div className="row" style={{ margin: 0, padding: 0 }}>
                    <div className="col-xl-5" style={{ margin: 0, padding: 0 }}>
                      <div
                          className="card-bg"
                          style={{
                            backgroundImage: "url(assets/img/Sfive.jpg)",
                            height: "340px",
                          }}
                      />
                    </div>
                    <div className="col-xl-7 d-flex  align-items-center">
                      <div className="card-body  lh-1">
                        <h4 className="card-title">Hazardous Freight</h4>
                        <p>
                          CarryShipment expertly handles dangerous goods, including solids, liquids, and gases. We manage hazardous cargo such as perfumes, batteries, hair spray, and other chemicals with care and compliance. Our specialized services ensure the safe and secure transportation of these sensitive items, adhering to all safety regulations and standards.
                        </p>
                        <Link
                            to="/services" scroll-to="#service-5" onClick={scrollToElement}
                            className="readmore stretched-link learn-more-link"
                        >
                          Learn more <i className="bi bi-arrow-right fs-4 ps-2 learn-more-icon" />
                        </Link>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="col-lg-6" data-aos="fade-up" data-aos-delay={400}>
                <div className="card-item" style={{ margin: 0, padding: 0 }}>
                  <div className="row" style={{ margin: 0, padding: 0 }}>
                    <div className="col-xl-5" style={{ margin: 0, padding: 0 }}>
                      <div
                          className="card-bg"
                          style={{
                            backgroundImage: "url(assets/img/Ssix.jpg)",
                            height: "340px",
                          }}
                      />
                    </div>
                    <div className="col-xl-7 d-flex  align-items-center">
                      <div className="card-body  lh-1">
                        <h4 className="card-title">Integration</h4>
                        <p>
                          CarryShipment offers personalized consolidation services on a global scale for both outbound and inbound shipments. No matter the mode of transport, our freight consolidation solutions are cost-effective and time-saving. We ensure the safety of your shipments while optimizing your logistics and reducing overall transportation costs.
                        </p>
                        <Link
                            to="/services" scroll-to="#service-6" onClick={scrollToElement}
                            className="readmore stretched-link learn-more-link"
                        >
                          Learn more <i className="bi bi-arrow-right fs-4 ps-2 learn-more-icon" />
                        </Link>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="col-lg-6" data-aos="fade-up" data-aos-delay={400}>
                <div className="card-item" style={{ margin: 0, padding: 0 }}>
                  <div className="row" style={{ margin: 0, padding: 0 }}>
                    <div className="col-xl-5" style={{ margin: 0, padding: 0 }}>
                      <div
                          className="card-bg"
                          style={{
                            backgroundImage: "url(assets/img/Sseven.jpg)",
                            height: "357px",
                          }}
                      />
                    </div>
                    <div className="col-xl-7 d-flex  align-items-center">
                      <div className="card-body  lh-1">
                        <h4 className="card-title">Freight Insurance</h4>
                        <p>
                          At CarryShipment, we handle the complexities of cargo insurance, addressing the risks associated with uninsured shipments. Our comprehensive insurance coverage safeguards against potential external causes of loss or damage during transit. We simplify the insurance process, ensuring your freight is protected throughout the shipping journey.
                        </p>
                        <Link
                            to="/services" scroll-to="#service-7" onClick={scrollToElement}
                            className="readmore stretched-link learn-more-link"
                        >
                          Learn more <i className="bi bi-arrow-right fs-4 ps-2 learn-more-icon" />
                        </Link>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="col-lg-6" data-aos="fade-up" data-aos-delay={400}>
                <div className="card-item" style={{ margin: 0, padding: 0 }}>
                  <div className="row" style={{ margin: 0, padding: 0 }}>
                    <div className="col-xl-5" style={{ margin: 0, padding: 0 }}>
                      <div
                          className="card-bg"
                          style={{
                            backgroundImage: "url(assets/img/Seight.jpg)",
                            height: "357px",
                          }}
                      />
                    </div>
                    <div className="col-xl-7 d-flex  align-items-center">
                      <div className="card-body  lh-1">
                        <h4 className="card-title">Exceptional cargo</h4>
                        <p className="col-12">
                          Fueled by a deep passion, we tackle our customers'
                          singular logistical hurdles.
                        </p>
                        <p>
                          Expertly managing bulk and break bulk shipments, CarryShipment specializes in handling heavy lifts and over-dimensional cargo. We orchestrate seamless relocations of entire plants and master the art of lashing and chocking. Our precise survey services ensure that all aspects of your bulk cargo are handled with utmost accuracy and care.

                        </p>
                        <Link
                            to="/services" scroll-to="#service-8" onClick={scrollToElement}
                            className="readmore stretched-link learn-more-link"
                        >
                          Learn more <i className="bi bi-arrow-right fs-4 ps-2 learn-more-icon" />
                        </Link>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              {/* End Card Item */}
            </div>
          </div>
        </section>
        {/* End Constructions Section */}
        {/* ======= Services Section ======= */}
        <section id="services" className="services section-bg">
          <div className="container" data-aos="fade-up">
            <div className="section-header">
              <h2>HOW WE DO IT</h2>
              <p>Our skilled team provides tailored, strategic solutions designed to effectively address and resolve your business challenges.</p>
            </div>
            <div className="row gy-4">
              <div
                  className="col-lg-4 col-md-6"
                  data-aos="fade-up"
                  data-aos-delay={100}
              >
                <div className="service-item  position-relative">
                  <div className="icon p-2">
                    <i className="fa-solid fa-arrow-up-from-ground-water fs-4 ps-3 pt-1" />
                  </div>
                  <h3>Your ocean freight Solution</h3>
                  <p>
                    We ensure the timely and cost-effective shipment of your valuable cargo to its destination via ocean transport with CarryShipment.
                  </p>
                </div>
              </div>
              {/* End Service Item */}
              <div
                  className="col-lg-4 col-md-6"
                  data-aos="fade-up"
                  data-aos-delay={200}
              >
                <div className="service-item position-relative">
                  <div className="icon p-2 ">
                    <i className="fa-solid fa-mountain-city fs-4 ps-3 pt-1" />
                  </div>
                  <h3>Land transportation services </h3>
                  <p>
                    Optimize your supply chain with CarryShipment's international road freight services tailored for efficient ground transportation.
                  </p>
                </div>
              </div>
              {/* End Service Item */}
              <div
                  className="col-lg-4 col-md-6"
                  data-aos="fade-up"
                  data-aos-delay={300}
              >
                <div className="service-item position-relative">
                  <div className="icon  p-2">
                    <i className="fa-solid fa-warehouse fs-4 ps-3 pt-1" />
                  </div>
                  <h3>Warehousing</h3>
                  <p>
                    Ensure the effective and secure storage of your items by utilizing our warehousing services, expertly packaging and safeguarding your belongings.
                  </p>
                </div>
              </div>
              {/* End Service Item */}
              <div
                  className="col-lg-4 col-md-6"
                  data-aos="fade-up"
                  data-aos-delay={400}
              >
                <div className="service-item position-relative">
                  <div className="icon  p-2">
                    <i className="fa-solid fa-trowel-bricks fs-3 ps-3" />
                  </div>
                  <h3>Our exclusive services</h3>
                  <p>
                    Our warehousing services have gained a global reputation for being exceptionally reliable, secure, and cost-effective. We take pride in consistently providing top-notch warehousing solutions at the most competitive prices in the industry.
                  </p>
                </div>
              </div>
              {/* End Service Item */}
              <div
                  className="col-lg-4 col-md-6"
                  data-aos="fade-up"
                  data-aos-delay={500}
              >
                <div className="service-item position-relative">
                  <div className="icon  p-2">
                    <i className="fa-solid fa-boxes-packing fs-4 ps-3 pt-1" />
                  </div>
                  <h3>Packaging And Safe Storage</h3>
                  <p>
                    Efficiently and securely pack and store your belongings to ensure their safety in storage.
                  </p>
                </div>
              </div>
              {/* End Service Item */}
              <div
                  className="col-lg-4 col-md-6"
                  data-aos="fade-up"
                  data-aos-delay={600}
              >
                <div className="service-item position-relative">
                  <div className="icon  p-2 ">
                    <i className="fa-solid fa-truck-pickup fs-3 ps-3" />
                  </div>
                  <h3> Cargo</h3>
                  <p>
                    Efficiently transport any cargo from one location to another promptly, saving both time and costs.
                  </p>
                </div>
              </div>
              <div
                  className="col-lg-4 col-md-6"
                  data-aos="fade-up"
                  data-aos-delay={600}
              >
                <div className="service-item position-relative">
                  <div className="icon  p-2 ">
                    <i className="bi bi-cone-striped fs-3 ps-3" />
                  </div>
                  <h3> Ground Transport</h3>
                  <p>
                    Explore ground transportation choices suitable for all visitors, regardless of your requirements, timetable, or destination.
                  </p>
                </div>
              </div>
              <div
                  className="col-lg-4 col-md-6"
                  data-aos="fade-up"
                  data-aos-delay={600}
              >
                <div className="service-item position-relative">
                  <div className="icon  p-2 ">
                    <i className="fa-solid fa-map-location-dot fs-3 ps-3" />
                  </div>
                  <h3>Delivery from one door to another</h3>
                  <p>
                    Our proficiency in transportation management and strategic planning enables us to create a tailored solution.
                  </p>
                </div>
              </div>
              <div
                  className="col-lg-4 col-md-6"
                  data-aos="fade-up"
                  data-aos-delay={600}
              >
                <div className="service-item position-relative">
                  <div className="icon  p-2 ">
                    <i className="fa-solid fa-earth-europe fs-2 ps-3" />
                  </div>
                  <h3> Global Transportation</h3>
                  <p>
                    Specializing in the international forwarding of goods and providing related comprehensive logistic services.
                  </p>
                </div>
              </div>

              {/* End Service Item */}
            </div>
          </div>
        </section>
        {/* End Services Section */}
        {/* ======= Alt Services Section ======= */}
        <section id="alt-services" className="alt-services">
          <div className="container" data-aos="fade-up">
            <div className="row justify-content-around gy-4">
              <div
                className="col-lg-6 img-bg"
                style={{ backgroundImage: "url(assets/img/alt-services.jpg)" }}
                data-aos="zoom-in"
                data-aos-delay={100}
              />
              <div className="col-lg-5 d-flex flex-column justify-content-center">
                <h3>Dedicated to Delivering Excellence in Every Project</h3>
                <p>
                  From strategic planning to execution, our team ensures that your project meets the highest standards of quality and efficiency.
                </p>
                <div
                    className="icon-box d-flex position-relative"
                    data-aos="fade-up"
                    data-aos-delay={100}
                >
                  <i className="bi bi-gear flex-shrink-0" />
                  <div>
                    <h4>
                      <a href className="stretched-link">
                        Comprehensive Planning
                      </a>
                    </h4>
                    <p>
                      We meticulously plan every detail to ensure seamless execution, minimizing risks and maximizing efficiency.
                    </p>
                  </div>
                </div>
                {/* End Icon Box */}
                <div
                    className="icon-box d-flex position-relative"
                    data-aos="fade-up"
                    data-aos-delay={200}
                >
                  <i className="bi bi-person-lines-fill flex-shrink-0" />
                  <div>
                    <h4>
                      <a href className="stretched-link">
                        Expert Team
                      </a>
                    </h4>
                    <p>
                      Our experienced professionals bring their industry expertise to every project, ensuring top-tier results.
                    </p>
                  </div>
                </div>
                {/* End Icon Box */}
                <div
                    className="icon-box d-flex position-relative"
                    data-aos="fade-up"
                    data-aos-delay={300}
                >
                  <i className="bi bi-tools flex-shrink-0" />
                  <div>
                    <h4>
                      <a href className="stretched-link">
                        Advanced Tools and Technology
                      </a>
                    </h4>
                    <p>
                      We utilize cutting-edge tools and technology to streamline processes, reduce costs, and deliver superior outcomes.
                    </p>
                  </div>
                </div>
                {/* End Icon Box */}
                <div
                    className="icon-box d-flex position-relative"
                    data-aos="fade-up"
                    data-aos-delay={400}
                >
                  <i className="bi bi-shield-check flex-shrink-0" />
                  <div>
                    <h4>
                      <a href className="stretched-link">
                        Safety and Compliance
                      </a>
                    </h4>
                    <p>
                      Safety is our priority. We adhere to strict safety protocols and regulatory standards to ensure the well-being of our team and
                      the quality of our work.
                    </p>
                  </div>
                </div>
                {/* End Icon Box */}
              </div>
            </div>
          </div>
        </section>
        {/* End Alt Services Section */}
        {/* ======= Features Section ======= */}
        <section id="features" className="features section-bg">
          <div className="container" data-aos="fade-up">
            <ul className="nav nav-tabs row  g-2 d-flex">
              <li className="nav-item col-6 col-md-3">
                <a
                  className="nav-link active show"
                  data-bs-toggle="tab"
                  data-bs-target="#tab-1"
                >
                  <h4>Nationwide Coverage</h4>
                </a>
              </li>
              {/* End tab nav item */}
              <li className="nav-item col-6 col-md-3">
                <a
                  className="nav-link"
                  data-bs-toggle="tab"
                  data-bs-target="#tab-2"
                >
                  <h4>Dependable Logistics</h4>
                </a>
                {/* End tab nav item */}
              </li>
              <li className="nav-item col-6 col-md-3">
                <a
                  className="nav-link"
                  data-bs-toggle="tab"
                  data-bs-target="#tab-3"
                >
                  <h4>Cost-Effective Strategies</h4>
                </a>
              </li>
              {/* End tab nav item */}
              <li className="nav-item col-6 col-md-3">
                <a
                  className="nav-link"
                  data-bs-toggle="tab"
                  data-bs-target="#tab-4"
                >
                  <h4>Professional Expertise</h4>
                </a>
              </li>
              {/* End tab nav item */}
            </ul>
            <div className="tab-content">
              <div className="tab-pane active show" id="tab-1">
                <div className="row">
                  <div
                      className="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center"
                      data-aos="fade-up"
                      data-aos-delay={100}
                  >
                    <h3>Nationwide Coverage</h3>
                    <p className="fst-italic">
                      Our extensive transport network ensures comprehensive coverage across
                      the entire country, delivering your cargo with unparalleled efficiency
                      and precision.
                    </p>
                    <ul>
                      <li>
                        <i className="bi bi-check2-all" /> We are equipped to handle
                        logistics across all regions, meeting your distribution needs
                        seamlessly.
                      </li>
                      <li>
                        <i className="bi bi-check2-all" /> Our services span urban and rural
                        areas, ensuring timely deliveries wherever you need them.
                      </li>
                      <li>
                        <i className="bi bi-check2-all" /> We utilize a fleet of
                        state-of-the-art vehicles, maintained to the highest standards for
                        reliability and safety.
                      </li>
                    </ul>
                  </div>
                  <div
                      className="col-lg-6 order-1 order-lg-2 text-center"
                      data-aos="fade-up"
                      data-aos-delay={200}
                  >
                    <img
                        src="assets/img/nation-wide.jpg"
                        alt="Nationwide Coverage"
                        className="img-fluid"
                    />
                  </div>
                </div>
              </div>
              {/* End tab content item */}
              <div className="tab-pane" id="tab-2">
                <div className="row">
                  <div
                      className="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center"
                      data-aos="fade-up"
                      data-aos-delay={100}
                  >
                    <h3>Dependable Logistics</h3>
                    <p className="fst-italic">
                      Count on our commitment to dependable logistics solutions. We
                      prioritize punctuality and safety in every delivery.
                    </p>
                    <ul>
                      <li>
                        <i className="bi bi-check2-all" /> We meticulously manage every
                        phase of the transport process to ensure your shipments are
                        delivered as scheduled and in optimal condition.
                      </li>
                      <li>
                        <i className="bi bi-check2-all" /> Our tracking systems provide
                        real-time updates, giving you peace of mind at every stage of
                        transit.
                      </li>
                      <li>
                        <i className="bi bi-check2-all" /> Our logistics team is available
                        24/7 to address any concerns and ensure smooth operations.
                      </li>
                    </ul>
                  </div>
                  <div
                      className="col-lg-6 order-1 order-lg-2 text-center"
                      data-aos="fade-up"
                      data-aos-delay={200}
                  >
                    <img
                        src="assets/img/truck image 8.jpg"
                        alt="Dependable Logistics"
                        className="img-fluid"
                    />
                  </div>
                </div>
              </div>
              {/* End tab content item */}
              <div className="tab-pane" id="tab-3">
                <div className="row">
                  <div
                      className="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center"
                      data-aos="fade-up"
                      data-aos-delay={100}
                  >
                    <h3>Cost-Effective Strategies</h3>
                    <p className="fst-italic">
                      We offer cost-effective logistics strategies designed to optimize your
                      budget without compromising on quality.
                    </p>
                    <ul>
                      <li>
                        <i className="bi bi-check2-all" /> Our solutions leverage advanced
                        technologies and efficient processes to provide competitive pricing
                        and superior service.
                      </li>
                      <li>
                        <i className="bi bi-check2-all" /> We continuously analyze and
                        refine our processes to ensure maximum efficiency and cost savings.
                      </li>
                      <li>
                        <i className="bi bi-check2-all" /> Our transparent pricing model
                        ensures you get the best value for your investment.
                      </li>
                    </ul>
                  </div>
                  <div
                      className="col-lg-6 order-1 order-lg-2 text-center"
                      data-aos="fade-up"
                      data-aos-delay={200}
                  >
                    <img
                        src="assets/img/Truck16.jpg"
                        alt="Cost-Effective Strategies"
                        className="img-fluid"
                    />
                  </div>
                </div>
              </div>
              {/* End tab content item */}
              <div className="tab-pane" id="tab-4">
                <div className="row">
                  <div
                      className="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center"
                      data-aos="fade-up"
                      data-aos-delay={100}
                  >
                    <h3>Professional Expertise</h3>
                    <p className="fst-italic">
                      Our team of seasoned logistics experts brings a wealth of knowledge
                      and experience to every project.
                    </p>
                    <ul>
                      <li>
                        <i className="bi bi-check2-all" /> We apply a strategic approach to
                        address your transport needs, offering tailored solutions that align
                        with industry best practices.
                      </li>
                      <li>
                        <i className="bi bi-check2-all" /> Our team undergoes continuous
                        training to stay ahead of industry trends and regulations.
                      </li>
                      <li>
                        <i className="bi bi-check2-all" /> We take pride in our exceptional
                        customer service, ensuring that your logistics needs are met with
                        professionalism and care.
                      </li>
                    </ul>
                  </div>
                  <div
                      className="col-lg-6 order-1 order-lg-2 text-center"
                      data-aos="fade-up"
                      data-aos-delay={200}
                  >
                    <img
                        src="assets/img/Truck27.jpg"
                        alt="Professional Expertise"
                        className="img-fluid"
                    />
                  </div>
                </div>
              </div>
              {/* End tab content item */}
            </div>

          </div>
        </section>
        {/* End Features Section */}
        {/* ======= Testimonials Section ======= */}
        <Testimonials />
        {/* End Testimonials Section */}
        {/* <Chat />*/}
      </main>
      {/* End #main */}
    </>
  );
}

export default Home;
