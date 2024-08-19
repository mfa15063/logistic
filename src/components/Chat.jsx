import React, { useState } from 'react';
import { Button, Modal, InputGroup, FormControl } from 'react-bootstrap';
import '../styles/chat.scss'; // You can add custom styles here

function Chat() {
  const [show, setShow] = useState(false);
  const [message, setMessage] = useState('');
  const [messages, setMessages] = useState([]);

  const handleShow = () => setShow(true);
  const handleClose = () => setShow(false);

  const sendMessage = () => {
    if (message.trim()) {
      setMessages([...messages, message]);
      setMessage('');
    }
  };

  return (1) || (
      <div className="chat-popup">
        <Button variant="warning" className="rounded-circle chat-btn" onClick={handleShow}>
          <i className="fas fa-comments"></i>
        </Button>

        <Modal show={show} onHide={handleClose} centered>
          <Modal.Header className="bg-warning text-white">
            <Modal.Title>Chat with Us</Modal.Title>
            <Button variant="close" aria-label="Close" onClick={handleClose}></Button>
          </Modal.Header>
          <Modal.Body className="chat-body bg-light">
            <div className="chat-content">
              {messages.map((msg, index) => (
                  <div key={index} className="chat-message bg-white text-dark p-2 mb-2 rounded">
                    {msg}
                  </div>
              ))}
            </div>
          </Modal.Body>
          <Modal.Footer>
            <InputGroup>
              <FormControl
                  placeholder="Type a message..."
                  value={message}
                  onChange={(e) => setMessage(e.target.value)}
                  onKeyDown={(e) => e.key === 'Enter' && sendMessage()}
              />
              <Button variant="warning" onClick={sendMessage}>Send</Button>
            </InputGroup>
          </Modal.Footer>
        </Modal>
      </div>
  );
}

export default Chat;
