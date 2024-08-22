import {useNavigate} from 'react-router-dom';
import {MDBBtn, MDBContainer, MDBCard, MDBCardBody, MDBInput, MDBRow, MDBCol} from 'mdb-react-ui-kit';
import {useState, useEffect} from 'react';
import {placeOrder} from '../js/api';

export default function PlaceOrder(props) {
    const {user, setCameFrom} = props.all;
    const navigate = useNavigate();
    const [loading, setLoading] = useState(false);
    const [orderData, setOrderData] = useState({
        receiver_name: '',
        received_country: '',
        received_city: '',
        received_address: '',
        delivered_country: '',
        delivered_city: '',
        delivered_address: '',
        location: '',
    });
    const [productPic, setProductPic] = useState(null);
    const [paymentReceipt, setPaymentReceipt] = useState(null);

    const handlePlaceOrder = async (e) => {
        e.preventDefault();
        try {
            setLoading(true);
            const response = await placeOrder(orderData, productPic, paymentReceipt);

            if (response.success) {
                navigate('/track-shipment/'+response.data.order_id);
            } else {
                alert(response.message);
            }
        } catch (error) {
            alert(error.message);
        } finally {
            setLoading(false);
        }
    };

    const handleFileChange = (e, setFile) => {
        const files = e.target.files;
        if (files.length > 0) {
            setFile(files[0]);
        }
    };

    useEffect(() => {
        if (!user?.isLoggedIn) {
            setCameFrom("/place-order");
            navigate("/signin");
        }
    }, [user, navigate]);

    return (
        <MDBContainer fluid className='d-flex align-items-center place-order justify-content-center bg-image'>
            <div className='mask gradient-custom-3'></div>
            <MDBCard className='m-5' style={{maxWidth: '1100px', width: '100%'}}>
                <MDBCardBody className='px-5 row'>
                    <h2 className="text-uppercase text-center mt-4 mb-5 col-lg-12">Place Order</h2>
                    <h4>Order Picked from:</h4>
                    <div className="col-lg-6">
                        <MDBInput value={orderData.received_country} disabled={loading}
                                  onChange={(e) => setOrderData({...orderData, received_country: e.target.value})}
                                  wrapperClass='mb-4' label='Country *' required size='lg' id='received_country' type='text'/>
                    </div>
                    <div className="col-lg-6">
                        <MDBInput value={orderData.received_city} disabled={loading}
                                  onChange={(e) => setOrderData({...orderData, received_city: e.target.value})}
                                  wrapperClass='mb-4' label='City *' required size='lg' id='received_city' type='text'/>
                    </div>
                    <div className="col-lg-12">
                        <MDBInput value={orderData.received_address} disabled={loading}
                                  onChange={(e) => setOrderData({...orderData, received_address: e.target.value})}
                                  wrapperClass='mb-4' label='Address *' required size='lg' id='received_address' type='text'/>
                    </div>
                    <h4>Order Delivered to:</h4>
                    <div className="col-lg-6">
                        <h6>Product Picture <small style={{fontSize: "10px"}}>(optional)</small></h6>
                        <MDBInput disabled={loading}
                                  onChange={(e) => handleFileChange(e, setProductPic)}
                                  wrapperClass='mb-4' label='Product Picture' size='lg' id='product_pic' type='file'/>
                    </div>
                    <div className="col-lg-6">
                        <h6>&nbsp;</h6>
                        <MDBInput value={orderData.receiver_name} disabled={loading}
                                  onChange={(e) => setOrderData({...orderData, receiver_name: e.target.value})}
                                  wrapperClass='mb-4' label='Person Name' size='lg' id='receiver_name' type='text'/>
                    </div>
                    <div className="col-lg-6">
                        <MDBInput value={orderData.delivered_country} disabled={loading}
                                  onChange={(e) => setOrderData({...orderData, delivered_country: e.target.value})}
                                  wrapperClass='mb-4' label='Country *' required size='lg' id='delivered_country' type='text'/>
                    </div>
                    <div className="col-lg-6">
                        <MDBInput value={orderData.delivered_city} disabled={loading}
                                  onChange={(e) => setOrderData({...orderData, delivered_city: e.target.value})}
                                  wrapperClass='mb-4' label='City *' required size='lg' id='delivered_city' type='text'/>
                    </div>
                    <div className="col-lg-12">
                        <MDBInput value={orderData.delivered_address} disabled={loading}
                                  onChange={(e) => setOrderData({...orderData, delivered_address: e.target.value})}
                                  wrapperClass='mb-4' label='Address *' required size='lg' id='delivered_address' type='text'/>
                    </div>
                    <div className="col-lg-6 mt-3 mx-auto">
                        <MDBBtn
                            outline
                            color="dark"
                            className="d-flex justify-content-center w-100"
                            style={{overflow: "visible"}}
                            size="lg"
                            onClick={handlePlaceOrder}
                            disabled={loading}
                        >
                            {(!loading && "Place Order") || "Placing Order..."}
                        </MDBBtn>
                    </div>
                </MDBCardBody>
            </MDBCard>
        </MDBContainer>
    );
}
