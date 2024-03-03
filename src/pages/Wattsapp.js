import React from 'react';

const Wattsapp = () => {
  return (
    <div className="fixed-bottom p-3 z-3">
      <a
        href="https://api.whatsapp.com/send?phone=YOUR_PHONE_NUMBER"
        target="_blank"
        rel="noopener noreferrer"
        className="text-white rounded-circle d-flex justify-content-center align-items-center position-fixed"
        style={{ height: "45px", width: "45px", right: "13px", bottom: "70px", background: "green" }}
      >
        <i className="bi bi-whatsapp fs-4" style={{ borderRadius: "50%" }}></i>
      </a>
    </div>
  );
};

export default Wattsapp;
