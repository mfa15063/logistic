import {Link, useLocation, useNavigate} from 'react-router-dom';
import {MDBBtn, MDBContainer, MDBCard, MDBCardBody, MDBInput, MDBRow, MDBCol, MDBCheckbox} from 'mdb-react-ui-kit';
import {useEffect, useState} from 'react';
import {updateUserProfile} from '../js/api';
import {PROFILE_IMAGE_PATH} from "../js/constants"; // API method to update user profile

export default function EditProfile(props) {
    const {user, setUser, setCameFrom} = props.all;
    const navigate = useNavigate();
    const location = useLocation();
    const [loading, setLoading] = useState(false);
    const [userImage, setUserImage] = useState(null);

    const handleUpdateProfile = async (e) => {
        e.preventDefault();
        try {
            setLoading(true);
            const profileData = await updateUserProfile(user, userImage);

            if (profileData.success) {
                setUser({
                    ...profileData.data,
                    isLoggedIn: true,
                });
                navigate('/profile');
            } else {
                alert(profileData.message);
            }
        } catch (error) {
            alert(error.message);
        } finally {
            setLoading(false);
        }
    };

    const handleFileChange = (files) => {
        if (files.length > 0) {
            const selectedFile = files[0];
            setUserImage(selectedFile);

            // Update image preview
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById("image-preview").src = e.target.result;
            };
            reader.readAsDataURL(selectedFile);
        }
    };

    useEffect(() => {
        if (!user?.isLoggedIn) {
            setCameFrom("/edit-profile");
            navigate("/signin");
        }
    }, [user, location, navigate]);
    return (
        <MDBContainer fluid className='d-flex align-items-center justify-content-center bg-image'>
            <div className='mask gradient-custom-3'></div>
            <MDBCard className='m-5' style={{maxWidth: '1100px', width: '100%'}}>
                <MDBCardBody className='px-5 row'>
                    <h2 className="text-uppercase text-center mt-4 mb-5 col-lg-12">Edit User Profile</h2>
                    <div className="col-lg-6">
                        <MDBInput value={user.name} disabled={loading}
                                  onKeyDown={(e) => {
                                      e.key === "Enter" && handleUpdateProfile(e);
                                  }}
                                  onChange={(e) => setUser({...user, name: e.target.value})}
                                  wrapperClass='mb-4' label='Your Name' size='lg' id='name' type='text'/>
                    </div>
                    <div className="col-lg-6 d-flex">
                        <MDBInput disabled={loading}
                                  onChange={(e) => handleFileChange(e.target.files)}
                                  className='mb-4' id='profile_img' type='file'/>
                        <label htmlFor="profile_img" style={{cursor: "pointer"}}>
                        <img
                            className="image-profile img-thumbnail edit-profile"
                            src={(user?.profile_img && PROFILE_IMAGE_PATH + user?.profile_img) || "./assets/img/avatar.svg"}
                            alt="Profile Preview" id="image-preview"
                        />
                        </label>
                    </div>
                    <div className="col-lg-6">
                        <MDBInput value={user.contact_no} disabled={loading}
                                  onKeyDown={(e) => {
                                      e.key === "Enter" && handleUpdateProfile(e);
                                  }}
                                  onChange={(e) => setUser({...user, contact_no: e.target.value})}
                                  wrapperClass='mb-4' label='Your Phone' size='lg' id='contact_no' type='tel'/>
                    </div>
                    <div className="col-lg-6">
                        <MDBInput value={user.email} disabled={true}
                                  wrapperClass='mb-4' label='Your Email'
                                  size='lg' id='email' type='email'/>
                    </div>
                    <div className="col-lg-6">
                        <MDBInput value={user.city} disabled={loading}
                                  onKeyDown={(e) => {
                                      e.key === "Enter" && handleUpdateProfile(e);
                                  }}
                                  onChange={(e) => setUser({...user, city: e.target.value})}
                                  wrapperClass='mb-4' label='City' size='lg' id='city' type='text'/>
                    </div>
                    <div className="col-lg-6">
                        <MDBInput value={user.country} disabled={loading}
                                  onKeyDown={(e) => {
                                      e.key === "Enter" && handleUpdateProfile(e);
                                  }}
                                  onChange={(e) => setUser({...user, country: e.target.value})}
                                  wrapperClass='mb-4' label='Country' size='lg' id='country' type='text'/>
                    </div>
                    <div className="col-lg-12">
                        <MDBInput value={user.address} disabled={loading}
                                  onKeyDown={(e) => {
                                      e.key === "Enter" && handleUpdateProfile(e);
                                  }}
                                  onChange={(e) => setUser({...user, address: e.target.value})}
                                  wrapperClass='mb-4' label='Street Address' size='lg' id='address' type='text'/>
                    </div>
                    <div className="col-lg-6 mt-3 mx-auto">
                        <MDBBtn
                            outline
                            color="dark"
                            className="d-flex justify-content-center w-100"
                            style={{overflow: "visible"}}
                            size="lg"
                            onClick={handleUpdateProfile}
                            disabled={loading}
                        >
                            {(!loading && "Update") || "Updating..."}
                        </MDBBtn>
                    </div>
                </MDBCardBody>
            </MDBCard>
        </MDBContainer>
    );
}
