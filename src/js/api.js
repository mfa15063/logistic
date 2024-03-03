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
        const response = await fetch(API_SERVER + "/order/by-id", {
            method: "GET",
            data: {
                id: id
            },
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

export const signupUser = async (name, email, password, confirm_password) => {
    try {
        const response = await fetch(API_SERVER + "/register", {
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
