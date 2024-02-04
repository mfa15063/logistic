import { Response } from "../models";
import { API_SERVER } from "./constants";

export const fetchUserProfile = async () => {
    window.sessionStorage.authToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI1IiwianRpIjoiZDFiNWI2NGI2NWY2OGQ2ZWIxYjM4YWE2OGJhNDBkYzRjODRkNDM4N2JiMDdkNjU4YzI1Mjg5NmI2MWUyNTA4NTBiNzc4M2I0MGFjYzg5NzkiLCJpYXQiOjE3MDcwNTIyNjMuNzU1Njc5LCJuYmYiOjE3MDcwNTIyNjMuNzU1Njg0LCJleHAiOjE3Mzg2NzQ2NjIuOTkyMDYyLCJzdWIiOiIxMiIsInNjb3BlcyI6WyIqIl19.ipZgXZKg-foAWP9Nc91iJNr2D2Ah8yhrd1zgUmAXuydzXuhQUxSI9LDyXcRPWVYqV-3SKXjv5-TV_NaJoHmoWxYkuiktKi04aFTc0VhIsW9VQpDLC_A0GlReCBgmmW3EKeAhN4ansnn4uDZQ-OZDl9QHxfbk5xAEJni8bHKvjij02jLSBUcZ_Y2handksF0FuJOh4ehrFm8TgwR1M9yKMdxHi3AziKE-ZyL2omehq1e7L4wTdTTY3no6kOhpsQtuBfc5BqiOEkEC5i08sz25LcFj0v2E_qc54ssG3kiRBRexCdhvOWQiJ-gYHD4W8HMO2_bXo9dzeM_TEKL9toSFHO9oZNvO_7BAn4gHkjGFo_9PUA827cyxmnFtTaZUuuc71k84axcCKlFp-27YPnY8RMrE2HeRxWK6xcOdlEEstjlElH0bksYtMpt1O2bGcXFB-QXIlDWoGppTE8xU7okT0TUqnaN88Q9gy7E5uR_SW3zRNKlNs0G70fWzvKJbapzDl8Se3O9a1oSVTvuKjMv1nsElraCxw8G8Apc1Y1POjB1iWeMiuZ5AHAiuVgz3zn-Soqdk190cwsnDGC_xjFPucuyAsLwMIv8BvscD_oAtgXmhkf5uTWuOQgiMdZEqVNScIoWiIT1hrhWlQukHzQ7RwBXGOCY1c3ke6cjvteWw94c";
    try {
        const response = await fetch(API_SERVER + "/profile", {
            method: "GET",
            headers: {
                "Authorization": `Bearer ${window.sessionStorage.authToken}`,
                "Content-Type": "application/json"
            }
        });

        if (response.status !== 200) {
            Response.error = true;
            Response.message = response.message;
            return Response;
        }
        const res = await response.json();
        
        Response.success = true;
        Response.message = res.message;
        Response.data = res.data;
        return Response;
    } catch (error) {
        Response.error = true;
        Response.message = error.message;
        return Response;
    }
};
