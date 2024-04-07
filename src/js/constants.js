export const API_SERVER = 'http://localhost:8000/api';
export const SERVER_IMAGE_PATH = "http://localhost:8000/admin/img/profile/";

export const getMapUrl = (mapCode) => {
    let parser = new DOMParser();
    mapCode = parser.parseFromString(mapCode, 'text/html');
    return mapCode?.querySelector('iframe')?.getAttribute('src') || "https://www.google.com/maps/";
}
