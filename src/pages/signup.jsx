import {Link, useNavigate, useLocation} from 'react-router-dom';
import {
    MDBBtn,
    MDBContainer,
    MDBCard,
    MDBCardBody,
    MDBInput,
    MDBCheckbox, MDBIcon
}
    from 'mdb-react-ui-kit';
import React, {useEffect, useState} from 'react';
import {loginUser, signupUser} from "../js/api";

export default function SignUp(props) {
    const {user, setUser, cameFrom} = props.all;
    const navigate = useNavigate();
    const location = useLocation();
    const [loading, setLoading] = useState(false);
    const [showPassword, setPasswordVisibility] = useState(false);

    const handleSignup = async (e) => {
        e.preventDefault();
        try {
            setLoading(true);
            const signupData = await signupUser(user.name, user.email, user.password, user.confirm_password);

            if (signupData.success) {
                setUser({
                    ...signupData.data,
                    isLoggedIn: true,
                });
                navigate(cameFrom);
            } else {
                alert(signupData.message);
            }
        } catch (error) {
            alert(error.message);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        if (user?.isLoggedIn) navigate(cameFrom);
    }, [user, location, navigate, cameFrom]);
    return (
        <>
            <div className='profile-header position-relative'></div>
            <MDBContainer fluid className='d-flex align-items-center justify-content-center bg-image'>
                <div className='mask gradient-custom-3'></div>
                <MDBCard className='m-5' style={{maxWidth: '600px'}}>
                    <MDBCardBody className='px-5'>
                        <h2 className="text-uppercase text-center mt-3 mb-5">Create an account</h2>
                        <MDBInput value={user.name} disabled={loading}
                                  onKeyDown={(e) => {
                                      e.key === "Enter" && handleSignup(e);
                                  }}
                                  onChange={(e) => setUser({...user, name: e.target.value})}
                                  wrapperClass='mb-4' label='Your Name: ' size='lg' id='name' type='text'/>
                        <MDBInput value={user.email} disabled={loading}
                                  onKeyDown={(e) => {
                                      e.key === "Enter" && handleSignup(e);
                                  }}
                                  onChange={(e) => setUser({...user, email: e.target.value})}
                                  wrapperClass='mb-4' label='Your Email: ' size='lg' id='email' type='email'/>
                        <div className="input-group mb-4">
                            <MDBInput
                                size="lg"
                                id="password"
                                style={{paddingRight: "50px"}}
                                type={showPassword ? "text" : "password"}
                                label="Password: "
                                value={user.password}
                                onChange={(e) => setUser({...user, password: e.target.value})}
                                disabled={loading}
                                onKeyDown={(e) => {
                                    e.key === "Enter" && handleSignup(e);
                                }}
                            />
                            <button
                                disabled={loading}
                                onClick={() => setPasswordVisibility(!showPassword)}
                                className="input-group-text px-3"
                                style={{
                                    height: "45px",
                                    position: "absolute",
                                    right: "0",
                                    background: "transparent",
                                    border: "transparent",
                                    outline: "none"
                                }}
                            >
                                <MDBIcon display-if={showPassword} icon="eye-slash"/>
                                <MDBIcon display-if={!showPassword} icon="eye"/>
                            </button>
                        </div>
                        <div className="input-group mb-4">
                            <MDBInput
                                size="lg"
                                id="confirm_password"
                                style={{paddingRight: "50px"}}
                                type={showPassword ? "text" : "password"}
                                label="Repeat your password: "
                                value={user.confirm_password}
                                onChange={(e) => setUser({...user, confirm_password: e.target.value})}
                                disabled={loading}
                                onKeyDown={(e) => {
                                    e.key === "Enter" && handleSignup(e);
                                }}
                            />
                            <button
                                disabled={loading}
                                onClick={() => setPasswordVisibility(!showPassword)}
                                className="input-group-text px-3"
                                style={{
                                    height: "45px",
                                    position: "absolute",
                                    right: "0",
                                    background: "transparent",
                                    border: "transparent",
                                    outline: "none"
                                }}
                            >
                                <MDBIcon display-if={showPassword} icon="eye-slash"/>
                                <MDBIcon display-if={!showPassword} icon="eye"/>
                            </button>
                        </div>
                        <MDBBtn
                            outline
                            color="dark"
                            className="d-flex justify-content-center w-100"
                            style={{overflow: "visible"}}
                            size="lg"
                            onClick={handleSignup}
                            disabled={loading}
                        >
                            {(!loading && "Register") || "Loading..."}
                        </MDBBtn>
                        <center className="d-block my-3">
                            If you already have Account! &nbsp;
                            <Link to="/signin">
                                Login here
                            </Link>
                        </center>
                    </MDBCardBody>
                </MDBCard>
            </MDBContainer>
        </>
    );
}