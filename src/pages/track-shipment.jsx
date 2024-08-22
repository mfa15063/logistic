import React, { useEffect, useRef, useState } from "react";
import "../styles/track-shipment.scss";
import StatusBar from "../components/status-bar";
import {fetchContactDetails, fetchShipmentDetails} from "../js/api";
import {useParams, Link, useNavigate} from "react-router-dom";
import {ContactDetails} from "../models";
import { Modal, Button } from 'react-bootstrap';
import {IMAGE_SERVER} from "../js/constants";

const TrackShipment = () => {
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);
  const [contactDetails, setContactDetails] = useState(JSON.parse(localStorage.contactDetails || null) || ContactDetails);
  const [shipmentData, setShipmentData] = useState(null);
  const { clientID } = useParams();
  const inputID = useRef();
  const navigate = useNavigate();
  const [showModal, setShowModal] = useState(false);
  const [selectedShipment, setSelectedShipment] = useState(null);

  const handleShowModal = (shipment) => {
    setSelectedShipment(shipment);
    setShowModal(true);
  };

  const handleCloseModal = () => setShowModal(false);

  const handleTracking = async (e) => {
    e && e.preventDefault();
    let clientID = inputID.current?.value;
    if (clientID?.trim()) {
      navigate("/track-shipment/" + clientID);
    }
  };
  const formatDateAndTime = (dateTimeString) => {
    const dateTime = new Date(dateTimeString);
    const formattedDate = dateTime.toLocaleDateString("en-US", {
      year: "numeric",
      month: "long",
      day: "numeric",
    });
    const formattedTime = dateTime.toLocaleTimeString("en-US", {
      hour: "numeric",
      minute: "numeric",
    });
    return { date: formattedDate, time: formattedTime };
  };
  useEffect(() => {
    if (clientID) {
      setLoading(true);
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
      fetchShipmentDetails(clientID).then(orders => {
        try {

          if (orders.success) {
            setShipmentData(orders.data);
          } else {
            throw Error(orders.message);
          }
          setError(null);
        } catch (error) {
          setShipmentData(null);
          setError("Shipment not found!");
        } finally {
          setLoading(false);
        }
      });
    } else setError(null);
  }, [clientID]);
  return (
    <main id="main" className="track-shipment">
      {/* ======= Breadcrumbs ======= */}
      <div
        className="breadcrumbs d-flex align-items-center"
        style={{ backgroundImage: 'url("assets/img/track-breadcrumbs.png")' }}
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
          <p display-if={clientID?.startsWith('order_')} className="text-warning fs-5 bg-dark px-2">
            Order Id : {clientID}
          </p>
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
              Shipment/User Id:
            </label>
            <div className="col-12 col-md-8 col-lg-6 mb-4 mb-md-0">
              <input
                type="text"
                className="form-control"
                ref={inputID}
                disabled={loading}
                onKeyDown={(e) => {
                  e.key === "Enter" && handleTracking(e);
                }}
              />
            </div>
            <div className="col-7 col-md-4 col-lg-3">
              <button
                className="btn btn-primary col-12"
                onClick={handleTracking}
                disabled={loading}
              >
                {(!loading && "Track") || "Loading..."}
              </button>
            </div>
          </div>
        </div>
        <div
          id="preloader"
          display-if={loading}
          style={{ position: "relative" }}
        ></div>

        <div className="alert alert-danger mt-5" display-if={error} role="alert">
          {error}
        </div>

        {!loading &&
          shipmentData &&
          shipmentData.map((shipment, index) => {
            let statusUpdatedAt = formatDateAndTime(shipment.updated_at);
            let statusColor;
            if (shipment.status === "Rejected") {
              statusColor = "text-danger";
            } else if (shipment.status === "Delivered") {
              statusColor = "text-success";
            } else {
              statusColor = "text-primary";
            }
            return (
              <div key={index}>
                <div className="mt-5">
                  <div className="p-4 border border-2 mt-5 mb-4">
                    <div className="row justify-content-center align-items-center">
                      <div className="col-12">
                        <div className="container">
                          <div className="row justify-content-center align-items-center">
                            <div className="col-lg-3 col-md-4 col-12 text-center mb-4 mb-md-0 px-5 px-md-0">
                              <img
                                  src="https://img.freepik.com/free-vector/isometric-laptop-with-shopping-cart-keypad_1262-16544.jpg?size=626&ext=jpg&ga=GA1.1.153145685.1709292001&semt=ais"
                                  alt="Shipment"
                                  className="img-fluid bg-white rounded-circle px-5 px-md-0"
                              />
                              <div className="d-none d-md-block" style={{ height: "300px" }} display-if={shipment.location}></div>
                            </div>
                            <div className="col-lg-9 col-md-8 d-flex flex-column justify-content-center">
                              <p className="text-primary font-monospace track-shipment d-flex flex-column flex-md-row justify-content-between align-items-center">
                                Delivery status of {shipment.id}
                                <button
                                    className="btn btn-primary ms-3"
                                    onClick={() => handleShowModal(shipment)}
                                >
                                  Read More >>
                                </button>
                              </p>
                              <h4 className={`${statusColor} track-shipment text-center text-md-start mt-4`}>
                                {shipment.status}
                              </h4>
                              <StatusBar status={shipment.status} />
                              {shipment.location && (
                                  <iframe
                                      src={`https://www.google.com/maps/embed/v1/place?key=AIzaSyA5DW0zd4-Myw4JuPdAEqYA3Es8cRlza7c&q=${shipment.location}`}
                                      style={{ border: 0, width: "100%", height: 300 }}
                                      frameBorder="0"
                                      allowFullScreen
                                      title="Shipment Location"
                                  />
                              )}
                              <small className="text-center text-md-start mt-2 track-shipment">
                                {statusUpdatedAt.time} <i className="bi bi-dot"></i>{" "}
                                <span className="text-info">{statusUpdatedAt.date}</span>
                              </small>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            );
          })}

        <Modal show={showModal} onHide={handleCloseModal} size="lg">
          <Modal.Header closeButton>
            <Modal.Title>Shipping Info</Modal.Title>
          </Modal.Header>
          <Modal.Body style={{height: "70vh", overflowY: "auto"}}>
            {selectedShipment && (
            <div>
                <iframe display-if={selectedShipment.location} src={"https://www.google.com/maps/embed/v1/place?key=AIzaSyA5DW0zd4-Myw4JuPdAEqYA3Es8cRlza7c&q="
                    + selectedShipment.location}
                        style={{border: 0, width: '100%', height: 300}} frameBorder="0" allowFullScreen/>
                  <h4 className="text-primary py-5">Shipping Information:</h4>
                  <div className="container">
                    <div className="row">
                      <div className="col-12 row m-0 p-0">
                        <h5 className="col-3">Shipping ID:</h5>
                        <p className="col-9 text-primary">{selectedShipment.id}</p>
                      </div>
                      <div
                          className="col-12 row m-0 p-0 text-danger"
                          display-if={
                              selectedShipment.rejection_reason &&
                              selectedShipment.status === "Rejected"
                          }
                      >
                        <h5 className="col-3">Rejection Reason:</h5>
                        <p className="col-9">{selectedShipment.rejection_reason}</p>
                      </div>
                      <div
                          className="col-12 row m-0 p-0"
                          display-if={selectedShipment.price}
                      >
                        <h5 className="col-3">Price:</h5>
                        <p className="col-9">{selectedShipment.price} USD</p>
                      </div>
                      <div className="col-12 row m-0 p-0 mb-3">
                        <h5 className="col-12">Received From:</h5>
                        <p className="col-12 row m-0 p-0 ps-5">
                          <b className="col-3">User Name:</b>
                          <span className="col-9">
                  {selectedShipment.client.name}
                </span>
                          <b
                              className="col-3"
                              display-if={selectedShipment.received_address}
                          >
                            Street Address:
                          </b>
                          <span
                              className="col-9"
                              display-if={selectedShipment.received_address}
                          >
                  {selectedShipment.received_address}
                </span>
                          <b
                              className="col-3"
                              display-if={selectedShipment.received_city}
                          >
                            City:
                          </b>
                          <span
                              className="col-9"
                              display-if={selectedShipment.received_city}
                          >
                  {selectedShipment.received_city}
                </span>
                          <b
                              className="col-3"
                              display-if={selectedShipment.received_country}
                          >
                            Country:
                          </b>
                          <span
                              className="col-9"
                              display-if={selectedShipment.received_country}
                          >
                  {selectedShipment.received_country}
                </span>
                          <b
                              className="col-3"
                              display-if={selectedShipment.received_date}
                          >
                            Date:
                          </b>
                          <span
                              className="col-9"
                              display-if={selectedShipment.received_date}
                          >
                  {selectedShipment.received_date}
                </span>
                        </p>
                      </div>
                      <div className="col-12 row m-0 p-0 mb-3">
                        <h5 className="col-12">Delivered To:</h5>
                        <p className="col-12 row m-0 p-0 ps-5">
                          <b
                              className="col-3"
                              display-if={selectedShipment.receiver_name}
                          >
                            Receiver Name:
                          </b>
                          <span
                              className="col-9"
                              display-if={selectedShipment.receiver_name}
                          >
                  {selectedShipment.receiver_name}
                </span>
                          <b
                              className="col-3"
                              display-if={selectedShipment.delivered_address}
                          >
                            Street Address:
                          </b>
                          <span
                              className="col-9"
                              display-if={selectedShipment.delivered_address}
                          >
                  {selectedShipment.delivered_address}
                </span>
                          <b
                              className="col-3"
                              display-if={selectedShipment.delivered_city}
                          >
                            City:
                          </b>
                          <span
                              className="col-9"
                              display-if={selectedShipment.delivered_city}
                          >
                  {selectedShipment.delivered_city}
                </span>
                          <b
                              className="col-3"
                              display-if={selectedShipment.delivered_country}
                          >
                            Country:
                          </b>
                          <span
                              className="col-9"
                              display-if={selectedShipment.delivered_country}
                          >
                  {selectedShipment.delivered_country}
                </span>
                          <b
                              className="col-3"
                              display-if={selectedShipment.delivered_date}
                          >
                            Date:
                          </b>
                          <span
                              className="col-9"
                              display-if={selectedShipment.delivered_date}
                          >
                  {selectedShipment.delivered_date}
                </span>
                        </p>
                        <img style={{height: "400px", objectFit: "contain", objectPosition: "left"}} src={IMAGE_SERVER + selectedShipment.product_pic} display-if={selectedShipment.product_pic} />
                      </div>
                    </div>
                  </div>
                </div>
            )}
          </Modal.Body>
          <Modal.Footer>
            <Button variant="secondary" onClick={handleCloseModal}>
              Close
            </Button>
          </Modal.Footer>
        </Modal>

        <div className="my-5 p-4 border border-2">
          <div className="row justify-content-center align-items-center">
            <div className="col-lg-12 col-md-6 col-12">
              <div className="container">
                <div className="row">
                  <div className="col-md-6 col-12">
                    <div className="row align-items-center">
                      <div className="col-3 text-center">
                        <div
                          className="rounded-circle bg-success"
                          style={{
                            width: "60px",
                            height: "60px",
                            display: "flex",
                            justifyContent: "center",
                            alignItems: "center",
                          }}
                        >
                          <i className="bi bi-check fs-1 text-white"></i>
                        </div>
                      </div>
                      <div className="col-9">
                        <h6 className="text-primary">
                          Transparent Pricing
                        </h6>
                        <p className="w-100">
                          Our prices are straight forward and guaranteed no hidden fees, just secure payments.
                        </p>
                      </div>
                    </div>
                  </div>
                  <div className="col-md-6 col-12">
                    <div className="row align-items-center">
                      <div className="col-3 text-center">
                        <div
                          className="rounded-circle bg-success-emphasis p-3"
                          style={{
                            backgroundColor: "grey",
                            width: "60px",
                            height: "60px",
                            display: "flex",
                            justifyContent: "center",
                            alignItems: "center",
                          }}
                        >
                          <i className="bi bi-telephone-plus-fill fs-4 text-white"></i>
                        </div>
                      </div>
                      <div className="col-9">
                        <h6 className="text-primary">Customer Services</h6>
                        <p className="shipment-contact-box-details">
                          <strong>Phone:</strong>{" "}
                          <a href={`tel:${contactDetails.phone_no}`}>{contactDetails.phone_no}</a>
                          <br/>
                          <strong>Email:</strong>{" "}
                          <a href={`mailto:${contactDetails.email}`}>{contactDetails.email}</a>
                        </p>
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
    </main>
  );
};

export default TrackShipment;
