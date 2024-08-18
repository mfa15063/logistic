import { Link } from "react-router-dom";

export default function HeroSection() {
  return (
    <>
      {/* ======= Hero Section ======= */}
      <section id="hero" className="hero">
        <div className="info d-flex align-items-center">
          <div className="container">
            <div className="row justify-content-center">
              <div className="col-lg-9 col-md-10 col-12 text-center">
                <h2 data-aos="fade-down">
                  Fast, Reliable, Global
                </h2>
                <p data-aos="fade-up">
                  From city to city across the nation, we ensure your shipments are handled with unmatched speed and reliability. Our dedicated team and extensive network streamline your supply chain, delivering your goods efficiently, cost-effectively, and on time.
                </p>
                <Link to={"track-shipment"}>
                  <a
                      data-aos="fade-up"
                      data-aos-delay={200}
                      href="#get-started"
                      className="btn-get-started"
                  >
                    Track Your Shipment
                  </a>
                </Link>
              </div>
            </div>
          </div>
        </div>
        <div
            id="hero-carousel"
            className="carousel slide"
            data-bs-ride="carousel"
            data-bs-interval={5000}
        >
          <div
              className="carousel-item active"
              style={{
                backgroundImage:
                    "url(assets/img/hero-carousel/Header.jpg)",
              }}
          />
          <div
              className="carousel-item"
              style={{
                backgroundImage:
                    "url(assets/img/hero-carousel/HeaderTwo.jpg)",
              }}
          />
          <div
              className="carousel-item"
              style={{
                backgroundImage:
                    "url(assets/img/hero-carousel/Headerthree.jpg)",
              }}
          />
          <a
              className="carousel-control-prev"
              href="#hero-carousel"
              role="button"
              data-bs-slide="prev"
          >
            <span
                className="carousel-control-prev-icon bi bi-chevron-left"
                aria-hidden="true"
            />
          </a>
          <a
              className="carousel-control-next"
              href="#hero-carousel"
              role="button"
              data-bs-slide="next"
          >
            <span
                className="carousel-control-next-icon bi bi-chevron-right"
                aria-hidden="true"
            />
          </a>
        </div>
      </section>
      {/* End Hero Section */}
    </>
  );
}
