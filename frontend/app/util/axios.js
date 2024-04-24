import axios from "axios";
import {API} from "@/app/constants";

export async function sendRequest(method, data, url, isPrivate = false) {
    let headers = {};

    if (isPrivate) {
        headers['Authorization'] = `Bearer ${localStorage.getItem('jwt')}`;
    }

    const instance = axios.create(
        {headers: headers}
    )

    if (method === 'post') {
        return instance.post(`${API}/api/${url}`, data);
    }

    if (method === 'get') {
        return instance.get(`${API}/api/${url}`);
    }
}
