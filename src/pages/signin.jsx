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
import '../styles/form.scss';
import { useEffect } from 'react';

export default function SignIn(props) {
  const {user, setUser, cameFrom} = props.all;
  const navigate = useNavigate();
  const location = useLocation();
  useEffect(()=>{
    if (user?.isLoggedIn) navigate(cameFrom);
  }, [user, location, navigate, cameFrom]);
  return (
    <MDBContainer fluid className='d-flex align-items-center justify-content-center bg-image' style={{height: '90vh', backgroundImage: 'url(https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp)'}}>
      <div className='mask gradient-custom-3'></div>
      <MDBCard className='m-5' style={{maxWidth: '600px'}}>
        <MDBCardBody className='px-5'>
          <h2 className="text-uppercase text-center mb-5">Sign In</h2>
          <label htmlFor="email">Email:</label>
          <MDBInput wrapperClass='mb-4' size='lg' id='email' type='email'/>
          <label htmlFor="password">Password:</label>
          <MDBInput wrapperClass='mb-4' size='lg' id='password' type='password'/>
          <div className='d-flex flex-row mb-4'>
            <MDBCheckbox name='flexCheck' id='flexCheckDefault' label='Remember Me' />
          </div>
          <MDBBtn className='mb-4 w-100 gradient-custom-4' size='lg'>Sign In</MDBBtn>
        </MDBCardBody>
      </MDBCard>
    </MDBContainer>
  );
}