const User = {
    isLoggedIn: false,
    address: "",
    city: "",
    contact_no: "",
    country: "",
    created_at: "",
    email: "",
    email_verified_at: null,
    id: 0,
    is_admin: 0,
    name: "",
    profile_img: null,
    status: 0,
    updated_at: ""
}

const Response = {
    error: false,
    success: false,
    message: "",
    data: null
}

export { User, Response };
