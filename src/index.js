import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom/client';
import './index.scss';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import { Home, Portfolio, About, Contact, Profile, SignIn, SignUp, FourZeroFour } from './pages/exports';
import { LayoutWithHeader, LayoutWithOutHeader, SideBar } from './layouts/exports';
import { User } from './models';
import { fetchUserProfile } from './js/api';

const root = ReactDOM.createRoot(document.getElementById('root'));

function Main() {
  const [cameFrom, setCameFrom] = useState('/profile');
  const [user, setUser] = useState(User);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const userData = await fetchUserProfile();
        if (userData.success) {
          setUser({
            ...userData.data,
            isLoggedIn: true
          });
        }
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, [user]);

  if(loading) return <LayoutWithHeader />

  return (
    <React.StrictMode>
      <BrowserRouter>
        <Routes>
          <Route path='/' element={<LayoutWithHeader />} >
            <Route index element={<Home />} />
            <Route path='portfolio' element={<Portfolio />} />
            <Route path='about' element={<About />} />
            <Route path='profile' element={<SideBar all={{ user }} />} >
              <Route index element={<Profile all={{ user }} />} />
            </Route>
            <Route path='signup' element={<SideBar all={{ user }} />} >
              <Route index element={<SignUp all={{ cameFrom, user, setUser }} />} />
            </Route>
            <Route path='signin' element={<SideBar all={{ user }} />} >
              <Route index element={<SignIn all={{ cameFrom, user, setUser }} />} />
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

root.render(<Main />);
