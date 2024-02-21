import React from "react";
import "../styles/track-shipment.scss";

const TrackShipment = () => {
  return (
    <main id="main" className="track-shipment">
      {/* ======= Breadcrumbs ======= */}
      <div
        className="breadcrumbs d-flex align-items-center"
        style={{ backgroundImage: 'url("assets/img/breadcrumbs-bg.jpg")' }}
      >
        <div
          className="container position-relative d-flex flex-column align-items-center"
          data-aos="fade"
        >
          <h2>Track Shipment</h2>
          <ol>
            <li>
              <a href="/">Home</a>
            </li>
            <li>Track Shipment</li>
          </ol>
        </div>
      </div>
      {/* End Breadcrumbs */}
      {/* ======= Tracking ======= */}
      <div className="container custom-container">
        <div className="card p-4 border border-2" style={{marginTop: "-35px"}}>
          <div className="row justify-content-center align-items-center">
            <label className="col-12 col-lg-3 mb-3 mb-lg-0">
              Shipment Id or User Id:
            </label>
            <div className="col-12 col-md-8 col-lg-6 mb-4 mb-md-0">
              <input type="text" className="form-control" />
            </div>
            <div className="col-7 col-md-4 col-lg-3">
              <button className="btn btn-primary col-12">Track</button>
            </div>
          </div>
        </div>

        <div className="mt-5">
            Proceed
        </div>
      </div>
      {/* End Tracking Section */}
    </main>
  );
};

export default TrackShipment;
