import React, { useState } from 'react';
import ReactDOM from 'react-dom/client';
import './index.scss';
import 'mdb-react-ui-kit/dist/css/mdb.min.css';
import "@fortawesome/fontawesome-free/css/all.min.css";
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import {
  Home,
  Portfolio,
  About,
  Contact,
  Profile,
  SignIn,
  SignUp,
  EditProfile,
  FourZeroFour,
  TrackShipment,
  Services,
  Policies,
  PlaceOrder
} from './pages/exports';
import { LayoutWithHeader, LayoutWithOutHeader, LayoutSideBar } from './layouts/exports';
import { User } from './models';

const root = ReactDOM.createRoot(document.getElementById('root'));
if (window.localStorage.authToken !== undefined)
  window.sessionStorage.authToken = window.localStorage.authToken;

function Main() {
  const [cameFrom, setCameFrom] = useState('/profile');
  const [user, setUser] = useState(User);

  return (
    <React.StrictMode>
      <BrowserRouter>
        <Routes>
          <Route path='/' element={<LayoutWithHeader />} >
            <Route index element={<Home />} />
            <Route path='portfolio' element={<Portfolio />} />
            <Route path='about' element={<About />} />
            <Route path='services' element={<Services />} />
            <Route path='contact' element={<Contact />} />
            <Route path='policies' element={<Policies />} />
            <Route path='track-shipment' >
              <Route index element={<TrackShipment />} />
              <Route path=':clientID' element={<TrackShipment />} />
            </Route>
            <Route path='signup' element={<SignUp all={{ cameFrom, user, setUser }} />} />
            <Route path='signin' element={<SignIn all={{ cameFrom, user, setUser }} />} />
          </Route>
          <Route path='/' element={<LayoutSideBar  all={{ user, setUser }} />} >
              <Route path='/profile' element={<Profile all={{ user, setUser }} />} />
              <Route path='/edit-profile' element={<EditProfile all={{ user, setUser }} />} />
              <Route path='/place-order' element={<PlaceOrder all={{ user, setUser }} />} />
          </Route>
          <Route path='*' element={<LayoutWithOutHeader />} >
            <Route path='*' element={<FourZeroFour />} />
          </Route>
        </Routes>
      </BrowserRouter>
    </React.StrictMode>
  );
}

root.render(<Main />);
