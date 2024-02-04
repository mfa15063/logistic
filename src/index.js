import React, { useState } from 'react';
import ReactDOM from 'react-dom/client';
import './index.scss';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import {Home, Portfolio, About, Contact, Profile, SignIn, SignUp, FourZeroFour} from './pages/exports';
import {LayoutWithHeader, LayoutWithOutHeader, SideBar} from './layouts/exports';
import { Globals, User } from './models';

const root = ReactDOM.createRoot(document.getElementById('root'));

function Main() {
  const [globals, setGlobals] = useState(Globals);
  const [user, setUser] = useState(User);
  return (
    <React.StrictMode>
      <BrowserRouter>
        <Routes>
          <Route path='/' element={<LayoutWithHeader />} >
            <Route index element={<Home />} />
            <Route path='portfolio' element={<Portfolio />} />
            <Route path='about' element={<About />} />
            <Route path='profile' element={<SideBar all={{ globals }} />} >
              <Route index element={<Profile all={{ globals, setGlobals, user }} />} />
            </Route>
            <Route path='signup' element={<SideBar all={{ globals }} />} >
              <Route index element={<SignUp all={{ globals, user, setUser }} />} />
            </Route>
            <Route path='signin' element={<SideBar all={{ globals }} />} >
              <Route index element={<SignIn all={{ globals, user, setUser }} />} />
            </Route>
          </Route>
          <Route path='*' element={<LayoutWithOutHeader />} >
            <Route path='*' element={<FourZeroFour />} />
            <Route path='contact' element={<Contact />} />
          </Route>
        </Routes>
      </BrowserRouter>
    </React.StrictMode>
  );
}

root.render(<Main/>);
