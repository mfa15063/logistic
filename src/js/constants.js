// export const API_SERVER = 'http://127.0.0.1:8000/api';
// export const IMAGE_SERVER = 'http://127.0.0.1:8000';
// export const PROFILE_IMAGE_PATH = "http://127.0.0.1:8000/clients/img/";
export const IMAGE_SERVER = 'https://admin.carryshipment.com';
export const PROFILE_IMAGE_PATH = "https://admin.carryshipment.com/clients/img/";
export const API_SERVER = 'https://admin.carryshipment.com/api';

export const scrollToTop = () => {
    window.scrollTo(0, 0);
}

export const scrollToElement = (e) => {
    let scrollElement = document.querySelector(e.target.getAttribute('scroll-to'));
    if (scrollElement) {
        scrollElement.scrollIntoView({ behavior: 'smooth' });
    } else window.scrollTo(0, 350);
}
