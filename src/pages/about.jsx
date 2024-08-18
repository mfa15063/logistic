import {Testimonials} from "../components/exports";

function About() {
  return (
    <main id="main">
      {/* ======= Breadcrumbs ======= */}
      <div
        className="breadcrumbs d-flex align-items-center"
        style={{ backgroundImage: 'url("assets/img/breadcrumbs-bg.jpg")' }}
      >
        <div
          className="container position-relative d-flex flex-column align-items-center"
          data-aos="fade"
        >
          <h2>About</h2>
          <ol>
            <li>
              <a href="/">Home</a>
            </li>
            <li>About</li>
          </ol>
        </div>
      </div>
      {/* End Breadcrumbs */}

      {/* ======= Get Started Section ======= */}
      <section id="get-started" className="get-started section-bg">
        <div className="container">
          <div className="row justify-content-between gy-4">
            <div
                className="col-lg-12 d-flex align-items-center text-center"
                data-aos="fade-up"
            >
              <div className="content about-content">
                <h3>Welcome to <span className="site-name-primary">Carry Shipment</span></h3>
                <p>
                  At Carry Shipment, headquartered in the USA, we are dedicated to delivering innovative and customized supply chain solutions
                  that meet the unique needs of our global clientele. Through our cutting-edge technology and a deeply collaborative approach,
                  we ensure seamless integration across all levels of our operations. Our commitment is to empower our clients with efficient,
                  reliable, and scalable solutions that drive success in a dynamic marketplace.
                </p>
              </div>
            </div>
            {/* End Quote Form */}
          </div>
        </div>
      </section>
      {/* End Get Started Section */}
      {/* ======= About Section ======= */}
      <section id="about" className="about">
        <div className="container" data-aos="fade-up">
          <div className="row position-relative">
            <div
              className="col-lg-7 about-img"
              style={{ backgroundImage: "url(/assets/img/ship-image.jpg)" }}
            />
            <div className="col-lg-7">
              <div className="our-story">
                <h4>Est 2024</h4>
                <h3>Our Story</h3>
                <p>
                  Our journey began with a commitment to delivering excellence in every aspect of our services.
                  Over the years, we've built a reputation for reliability and quality, driven by our dedication to meeting the unique
                  needs of our clients.

                  Our story is one of innovation, persistence, and growth. We believe in creating lasting relationships through trust, integrity,
                  and exceptional service. Every project we undertake is a testament to our unwavering commitment to our clients' success.
                </p>
                <ul>
                  <li>
                    <i className="bi bi-check-circle" />{" "}
                    <span>We ensure that every step of the process is carried out with precision and attention to detail.</span>
                  </li>
                  <li>
                    <i className="bi bi-check-circle" />{" "}
                    <span>Our team is dedicated to providing solutions that are tailored to meet the specific needs of each client.</span>
                  </li>
                  <li>
                    <i className="bi bi-check-circle" />{" "}
                    <span>We leverage our industry expertise to offer insights and strategies that drive success.</span>
                  </li>
                </ul>
                <p>
                  Our commitment to quality and customer satisfaction has been the cornerstone of our success. As we continue to grow, we remain
                  focused on delivering the best possible outcomes for our clients.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      {/* End About Section */}
      {/* ======= Stats Counter Section ======= */}
      <section id="stats-counter" className="stats-counter section-bg">
        <div className="container">
          <div className="row gy-4">
            <div className="col-lg-3 col-md-6">
              <div className="stats-item d-flex align-items-center w-100 h-100">
                <i className="bi bi-emoji-smile color-blue flex-shrink-0" />
                <div>
                  <span
                    data-purecounter-start={0}
                    data-purecounter-end={232}
                    data-purecounter-duration={1}
                    className="purecounter"
                  />
                  <p>Happy Clients</p>
                </div>
              </div>
            </div>
            {/* End Stats Item */}
            <div className="col-lg-3 col-md-6">
              <div className="stats-item d-flex align-items-center w-100 h-100">
                <i className="bi bi-journal-richtext color-orange flex-shrink-0" />
                <div>
                  <span
                    data-purecounter-start={0}
                    data-purecounter-end={521}
                    data-purecounter-duration={1}
                    className="purecounter"
                  />
                  <p>Projects</p>
                </div>
              </div>
            </div>
            {/* End Stats Item */}
            <div className="col-lg-3 col-md-6">
              <div className="stats-item d-flex align-items-center w-100 h-100">
                <i className="bi bi-headset color-green flex-shrink-0" />
                <div>
                  <span
                    data-purecounter-start={0}
                    data-purecounter-end={1463}
                    data-purecounter-duration={1}
                    className="purecounter"
                  />
                  <p>Hours Of Support</p>
                </div>
              </div>
            </div>
            {/* End Stats Item */}
            <div className="col-lg-3 col-md-6">
              <div className="stats-item d-flex align-items-center w-100 h-100">
                <i className="bi bi-people color-pink flex-shrink-0" />
                <div>
                  <span
                    data-purecounter-start={0}
                    data-purecounter-end={15}
                    data-purecounter-duration={1}
                    className="purecounter"
                  />
                  <p>Hard Workers</p>
                </div>
              </div>
            </div>
            {/* End Stats Item */}
          </div>
        </div>
      </section>
      {/* End Stats Counter Section */}
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
      {/* ======= Alt Services Section 2 ======= */}
      <section id="alt-services-2" className="alt-services section-bg">
        <div className="container" data-aos="fade-up">
          <div className="row justify-content-around gy-4">
            <div className="col-lg-5 d-flex flex-column justify-content-center">
              <h3>Comprehensive Shipping Solutions</h3>
              <p>
                At CarryShipment, we provide a full suite of land-based shipping services tailored to meet your needs. From efficient freight management to secure warehousing, our solutions ensure your shipments are handled with precision and care.
              </p>
              <div
                  className="icon-box d-flex position-relative"
                  data-aos="fade-up"
                  data-aos-delay={100}
              >
                <i className="bi bi-truck flex-shrink-0" />
                <div>
                  <h4>
                    <a href className="stretched-link">
                      Reliable Land Freight
                    </a>
                  </h4>
                  <p>
                    Benefit from our extensive experience in road and rail transport. We optimize time, cost, and performance to meet your logistics needs efficiently.
                  </p>
                </div>
              </div>
              {/* End Icon Box */}
              <div
                  className="icon-box d-flex position-relative"
                  data-aos="fade-up"
                  data-aos-delay={200}
              >
                <i className="bi bi-box-seam flex-shrink-0" />
                <div>
                  <h4>
                    <a href className="stretched-link">
                      Expert Warehousing
                    </a>
                  </h4>
                  <p>
                    Simplify your warehousing with our integrated solutions. Whether you need to store one pallet or a hundred, we provide efficient and cost-effective storage options.
                  </p>
                </div>
              </div>
              {/* End Icon Box */}
              <div
                  className="icon-box d-flex position-relative"
                  data-aos="fade-up"
                  data-aos-delay={300}
              >
                <i className="bi bi-arrow-right-circle flex-shrink-0" />
                <div>
                  <h4>
                    <a href className="stretched-link">
                      Intermodal Solutions
                    </a>
                  </h4>
                  <p>
                    Utilize our road and rail transport services for increased flexibility and capacity. Enjoy reliable lead times and a reduced carbon footprint.
                  </p>
                </div>
              </div>
              {/* End Icon Box */}
              <div
                  className="icon-box d-flex position-relative"
                  data-aos="fade-up"
                  data-aos-delay={400}
              >
                <i className="bi bi-arrow-repeat flex-shrink-0" />
                <div>
                  <h4>
                    <a href className="stretched-link">
                      Reverse Logistics
                    </a>
                  </h4>
                  <p>
                    Manage product returns efficiently with our end-to-end reverse logistics program, helping you recover revenue and minimize environmental impact.
                  </p>
                </div>
              </div>
              {/* End Icon Box */}
            </div>
            <div
                className="col-lg-6 img-bg"
                style={{ backgroundImage: "url(assets/img/alt-services-2.jpg)" }}
                data-aos="zoom-in"
                data-aos-delay={100}
            />
          </div>
        </div>
      </section>
      {/* End Alt Services Section 2 */}
      {/* ======= Testimonials Section ======= */}
        <Testimonials />
      {/* End Testimonials Section */}
    </main>
  );
}

export default About;
