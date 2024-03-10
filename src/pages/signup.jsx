import { Link, useNavigate, useLocation } from 'react-router-dom';
import {
  MDBBtn,
  MDBContainer,
  MDBCard,
  MDBCardBody,
  MDBInput,
  MDBCheckbox
}
from 'mdb-react-ui-kit';
import { useEffect, useState } from 'react';

export default function SignUp(props) {
  const {user, setUser, cameFrom} = props.all;
  const navigate = useNavigate();
  const location = useLocation();
  const [loading, setLoading] = useState(false);
  useEffect(()=>{
    if (user?.isLoggedIn) navigate(cameFrom);
  }, [user, location, navigate, cameFrom]);
  return (
    <MDBContainer fluid className='d-flex align-items-center justify-content-center bg-image'>
      <div className='mask gradient-custom-3'></div>
      <MDBCard className='m-5' style={{maxWidth: '600px'}}>
        <MDBCardBody className='px-5'>
          <h2 className="text-uppercase text-center mb-5">Create an account</h2>
          <MDBInput wrapperClass='mb-4' label='Your Name' size='lg' id='form1' type='text'/>
          <MDBInput wrapperClass='mb-4' label='Your Email' size='lg' id='form2' type='email'/>
          <MDBInput wrapperClass='mb-4' label='Password' size='lg' id='form3' type='password'/>
          <MDBInput wrapperClass='mb-4' label='Repeat your password' size='lg' id='form4' type='password'/>
          <div className='d-flex flex-row justify-content-center mb-4'>
            <MDBCheckbox name='flexCheck' id='flexCheckDefault' label='I agree all statements in Terms of service' />
          </div>
          <MDBBtn
            outline
            color="dark"
            className="d-flex justify-content-center w-100"
            style={{ overflow: "visible" }}
            size="lg"
            // onClick={handleLogin}
            disabled={loading}
          >
            {(!loading && "Register") || "Loading..."}
          </MDBBtn>
        </MDBCardBody>
      </MDBCard>
    </MDBContainer>
  );
}