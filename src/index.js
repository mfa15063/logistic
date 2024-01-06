import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Home from './pages/home';
import Portfolio from './pages/portfolio';
import About from './pages/about';
import Contact from './pages/contact';
import FourZeroFour from './pages/404';
import LayoutWithHeader from './layouts/layout-header';
import LayoutWithOutHeader from './layouts/layout-noheader';

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <BrowserRouter>
      <Routes>
        <Route path='/' element={<LayoutWithHeader />} >
          <Route index element={<Home />} />
          <Route path='portfolio' element={<Portfolio />} />
          <Route path='about' element={<About />} />
          {/* <Route path='contact' element={<Contact />} /> */}
        </Route>
        <Route path='*' element={<LayoutWithOutHeader />} >
          <Route path='*' element={<FourZeroFour />} />
          <Route path='contact' element={<Contact />} />
        </Route>
      </Routes>
    </BrowserRouter>
  </React.StrictMode>
);
