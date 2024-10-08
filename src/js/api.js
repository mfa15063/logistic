import { API_SERVER } from "./constants";

export const fetchUserProfile = async () => {
    try {
        const response = await fetch(API_SERVER + "/profile", {
            method: "GET",
            headers: {
                "Authorization": `Bearer ${window.sessionStorage.authToken || ''}`,
                "Content-Type": "application/json"
            }
        });

        if (response.status !== 200) {
            const errorData = await response.json();
            return {
                success: false,
                message: errorData.message
            };
        }
        const res = await response.json();
        return {
            success: true,
            message: res.message,
            data: res.data
        }
    } catch (error) {
        return {
            success: false,
            message: error.message
        }
    }
};

export const fetchShipmentDetails = async (id) => {
    try {
        if (!id) throw Error("Please Enter ID");
        const response = await fetch(API_SERVER + "/order/by-id?id=" + id);

        if (response.status !== 200) {
            const errorData = await response.json();
            return {
                success: false,
                message: errorData.message
            };
        }
        const res = await response.json();
        return {
            success: true,
            message: res.message,
            data: res.data
        }
    } catch (error) {
        return {
            success: false,
            message: error.message
        }
    }
};

export const fetchContactDetails = async () => {
    try {
        const response = await fetch(API_SERVER + "/admin/contact-details");

        if (response.status !== 200) {
            const errorData = await response.json();
            return {
                success: false,
                message: errorData.message
            };
        }
        const res = await response.json();
        localStorage.contactDetails = JSON.stringify(res.data);
        return {
            success: true,
            message: res.message,
            data: res.data
        }
    } catch (error) {
        return {
            success: false,
            message: error.message
        }
    }
};

export const fetchInquiries = async () => {
    try {
        const response = await fetch(API_SERVER + "/inquiries");

        if (response.status !== 200) {
            const errorData = await response.json();
            return {
                success: false,
                message: errorData.message
            };
        }
        const res = await response.json();
        localStorage.inquiries = JSON.stringify(res.data);
        return {
            success: true,
            message: res.message,
            data: res.data
        }
    } catch (error) {
        return {
            success: false,
            message: error.message
        }
    }
};

export const submitContactForm = async (request) => {
    try {
        const response = await fetch(API_SERVER + "/contact-us", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(request)
        });

        if (response.status !== 200) {
            const errorData = await response.json();
            return {
                success: false,
                message: errorData.message
            };
        }
        const res = await response.json();
        return {
            success: true,
            message: res.message
        }
    } catch (error) {
        return {
            success: false,
            message: error.message
        }
    }
};

export const logoutUser = async () => {
    try {
        const response = await fetch(API_SERVER + "/logout", {
            method: "POST",
            headers: {
                "Authorization": `Bearer ${window.sessionStorage.authToken }`,
                "Content-Type": "application/json"
            }
        });

        if (response.status !== 200) {
            return {
                success: false,
                message: "Not LoggedOut! Status: " + response.status
            }
        }
        const res = await response.json();


        window.localStorage.removeItem('authToken');
        window.sessionStorage.removeItem('authToken');
        return {
            success: true,
            message: res.message
        }
    } catch (error) {
        return {
            success: false,
            message: "Logout Fails"
        }
    }
};

export const loginUser = async (email, password, remember = false) => {
    try {
        const response = await fetch(API_SERVER + "/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                email,
                password
            })
        });

        if (response.status !== 200) {
            const errorData = await response.json();
            return {
                success: false,
                message: errorData.message
            };
        }

        const res = await response.json();
        window.sessionStorage.authToken = res.data.token;
        if (remember) {
            window.localStorage.authToken = res.data.token;
        }
        delete res.data.token;
        delete res.data.is_admin;
        delete res.email_verified_at;
        delete res.created_at;
        delete res.updated_at;
        delete res.status;
        console.log(res)
        return {
            success: true,
            message: res.message,
            data: res.data
        };
    } catch (error) {
        return {
            success: false,
            message: error.message
        };
    }
};

export const signupUser = async (name, email, password, password_confirmation) => {
    try {
        const response = await fetch(API_SERVER + "/register", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                name,
                email,
                password,
                password_confirmation
            })
        });

        if (response.status !== 200) {
            const errorData = await response.json();
            return {
                success: false,
                message: errorData.message
            };
        }

        const res = await response.json();
        window.sessionStorage.authToken = res.data.token;
        delete res.data.token;
        delete res.data.is_admin;
        delete res.email_verified_at;
        delete res.created_at;
        delete res.updated_at;
        delete res.status;
        return {
            success: true,
            message: res.message,
            data: res.data
        };
    } catch (error) {
        return {
            success: false,
            message: error.message
        };
    }
};

export const updateUserProfile = async (profileData, profileImage) => {
    const formData = new FormData();
    for (const key in profileData) {
        formData.append(key, profileData[key]);
    }
    if (profileImage) {
        formData.append('profile_image', profileImage);
    }

    try {
        const response = await fetch(API_SERVER + "/profile-update", {
            method: "POST",
            headers: {
                "Authorization": `Bearer ${window.sessionStorage.authToken}` // Remove 'Content-Type': 'application/json'
            },
            body: formData
        });

        if (response.status !== 200) {
            const errorData = await response.json();
            return {
                success: false,
                message: errorData.message || "Failed to update profile"
            };
        }

        const res = await response.json();
        return {
            success: true,
            message: 'Profile updated successfully',
            data: res.data
        };
    } catch (error) {
        return {
            success: false,
            message: error.message
        };
    }
};

export const placeOrder = async (orderData, productPic, paymentReceipt) => {
    const formData = new FormData();
    for (const key in orderData) {
        formData.append(key, orderData[key]);
    }
    if (productPic) {
        formData.append('product_pic', productPic);
    }
    if (paymentReceipt) {
        formData.append('payment_receipt', paymentReceipt);
    }

    try {
        console.log(window.sessionStorage.authToken);
        const response = await fetch(API_SERVER + "/order/store", {
            method: "POST",
            headers: {
                "Authorization": `Bearer ${window.sessionStorage.authToken}` // No need for 'Content-Type' as FormData handles it.
            },
            body: formData
        });

        if (response.status !== 200) {
            const errorData = await response.json();
            return {
                success: false,
                message: errorData.message || "Failed to place order"
            };
        }

        const res = await response.json();
        return {
            success: true,
            message: 'Order placed successfully',
            data: res.data
        };
    } catch (error) {
        return {
            success: false,
            message: error.message
        };
    }
};
