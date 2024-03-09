import React from "react";
import "../styles/track-shipment.scss";
import StatusBar from "../components/status-bar";

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
        <div
          className="card p-4 border border-2"
          style={{ marginTop: "-35px" }}
        >
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
          <div
            className=" p-4 border border-2 mt-5 mb-4">
          
            <div className="row justify-content-center align-items-center">
              <div className="col-lg-12 col-md-6 col-12">
                <div className="container">
                  <div className="row justify-content-center align-items-center">
                    <div className="col-3">
                      <img src="https://img.freepik.com/free-vector/isometric-laptop-with-shopping-cart-keypad_1262-16544.jpg?size=626&ext=jpg&ga=GA1.1.153145685.1709292001&semt=ais" alt="nothing" className="col-12 bg-white rounded-circle" />
                    </div>
                    <div className="col-9 d-flex flex-column justify-content-center">
                      <p className="text-primary font-monospace track-shipment">Delivery status</p>
                      <h4 className="text-primary track-shipment">
                        package picked by resipent
                      </h4>
                      <small className="mt-2 track-shipment">
                        18:05 <i class="bi bi-dot"></i> <span className="text-info"> 2023-12=05</span>
                      </small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <StatusBar status='Picked up'/>
        <div className="mt-5">
          <div
            className="p-4 border border-2 mt-5 track-shipment"
          >
            <h4 className="text-primary py-5">Shipping information</h4>
            <div className="col-12">
              <div className="container">
                <div className="row">
                  <div className="col-3">
                    <small className="fw-semibold col-12">shipping number</small>
                  </div>
                  <div className="col-3">
                    <p className="col-12">986654335</p>
                  </div>
                  <div className="col-md-6 col-5 d-flex justify-content-center">
                    <p className="fw-bold">selected option</p>
                  </div>
                  <div className="col-3">
                    <small className="fw-semibold">Booking no</small>
                  </div>
                  <div className="col-3">
                    <p >9866545</p>
                  </div>
                  <div className=" col-6 d-flex justify-content-center">
                    <p className="me-4">
                      {" "}
                      <i class="bi bi-check text-success fs-bold fs-4 "></i>    notification 
                    </p>
                  </div>
                  <div className="col-3">
                    <small className="fw-semibold">invoice reference</small>
                  </div>
                  <div className="col-3">
                    <p>Lorem ipsum</p>
                  </div>
                  <div className="col-md-6 col-5 d-flex justify-content-center">
                    <p className="ms-5">  <i class="bi bi-check text-success fs-bold fs-4 "></i>  climate compateted</p>
                  </div>
                  <div className="col-3">
                    <small className="fw-semibold">invoice reference</small>
                  </div>
                  <div className="col-3">
                    <p >Lorem ipsum</p>
                  </div>
                </div>

                <div className="row">
                  <div className="col-3">
                    <small className="fw-semibold col-12">invoice reference</small>
                  </div>
                  <div className="col-3">
                    <p className="col-12">Lorem ipsum</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div className="border-top border-bottom  border-start border-end border-2">
          <div className="row justify-content-center align-items-center">
            <div className="col-lg-12 col-md-6 col-12">
              <div className="container">
                <div className="row align-items-center pt-3 pb-3">
                  <div className="col-md-3 col-6">
                    <small className="fw-semibold ps-4">number of percent <i class="bi bi-dot"></i> 
                    <span className="fw-light">1</span>  </small>

                  </div>
                  <div className="col-md-3 col-6">
                    <small className="fw-semibold">weight of goods <i class="bi bi-dot"></i>
                    <span className="fw-light">3kg</span>
                    </small>
                  </div>
                  <div className="col-md-3 col-6 ps-5 ps-md-0">
                    <small className="fw-semibold">
                      volumn <i class="bi bi-dot"></i>  <span className="fw-light">0.0008 <sup>2</sup></span>
                  
                    </small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      
        <div className="mb-5 p-4 border border-2">
        <div className="row justify-content-center align-items-center">
  <div className="col-lg-12 col-md-6 col-12">
    <div className="container">
      <div className="row">
        <div className="col-md-6 col-12">
          <div className="row align-items-center">
            <div className="col-3 text-center">
              <div className="rounded-circle bg-success" style={{ width: '60px', height: '60px' ,display:"flex",justifyContent:"center",
              alignItems:"center"}}>
                <i className="bi bi-check fs-1 text-white"></i>
              </div>
            </div>
            <div className="col-9">
              <h6 className="text-primary">Fixed prices</h6>
              <p className="w-100">Our prices are always what you pay, simple and secure with shipLink</p>
            </div>
          </div>
        </div>
        <div className="col-md-6 col-12">
          <div className="row align-items-center">
            <div className="col-3 text-center">
              <div className="rounded-circle bg-success-emphasis p-3" style={{ backgroundColor: "grey", width: '60px', height: '60px',display:"flex",justifyContent:"center",
              alignItems:"center" }}>
                <i className="bi bi-telephone-plus-fill fs-4 text-white"></i>
              </div>
            </div>
            <div className="col-9">
              <h6 className="text-primary">Customer Services</h6>
              <p className="w-75">Phone: 010-20-708-<br/>E-mail: order@gmail.com</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>

      </div>

      {/* End Tracking Section */}
      <div className="fixed-buttons">
        <button
          className="btn btn-primary rounded-circle fixed-prev"
          style={{ position: 'fixed', top: '50%', transform: 'translateY(-50%)', right: '10px' }}
        >
        
          <i className="bi bi-chevron-left"></i>
        </button>
        <button
          className="btn btn-primary rounded-circle fixed-next"
          style={{ position: 'fixed', top: '50%', transform: 'translateY(-50%)', l: '10px' }}
        >
          <i className="bi bi-chevron-right"></i>
        </button>
      </div>
     
    </main>
  );
};

export default TrackShipment;
