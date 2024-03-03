import React from 'react';

const Wattsapp = () => {
  return (
    <div className="fixed-bottom p-3 z-3" style={{ bottom: '1px', right: '0px', textAlign: 'right' }}>
      <a
        href="https://api.whatsapp.com/send?phone=YOUR_PHONE_NUMBER"
        target="_blank"
        rel="noopener noreferrer"
        className="text-white rounded-circle"
        style={{ height: "60px", width: "60px", display: "inline-block" }}
      >
        <i className="bi bi-whatsapp fs-3" style={{ background: "green", borderRadius: "50%", padding: "10px" }}></i>
      </a>
    </div>
  );
};

export default Wattsapp;
