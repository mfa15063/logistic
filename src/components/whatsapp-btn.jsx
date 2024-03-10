import React from 'react';

const WhatsappBtn = () => {
  return (
    <div className="whatsapp-btn d-flex position-fixed rounded-circle align-items-center justify-content-center">
      <a
        href="https://api.whatsapp.com/send?phone=YOUR_PHONE_NUMBER"
        target="_blank"
        rel="noopener noreferrer"
        className="text-white d-flex align-items-center justify-content-center"
      >
        <i className="bi d-flex bi-whatsapp fs-4" style={{ borderRadius: "50%" }}></i>
      </a>
    </div>
  );
};

export default WhatsappBtn;
