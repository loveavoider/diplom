import axios from "axios";
import { API } from "@/app/constants";
import {setTokens} from "@/app/util/auth";

const ERR_BAD_REQUEST = 'ERR_BAD_REQUEST';

function setup(isPrivate) {
    let headers = {};

    if (isPrivate) {
        headers['Authorization'] = `Bearer ${localStorage.getItem('jwt')}`;
    }

    return axios.create(
        {headers: headers}
    )
}

export async function sendPost(data, url, isPrivate = false) {
    let instance = setup(isPrivate);

    try {
        return instance.post(`${API}/api/${url}`, data);
    } catch (e) {
        if (e.code === ERR_BAD_REQUEST) {

            const isUpdate = await updateToken();

            if (isUpdate) {
                instance = setup(true);
                return await instance.post(`${API}/api/${url}`);
            }

            location.href = '/login';
        }
    }
}

export async function sendPatch(data, url, isPrivate = false) {
    let instance = setup(isPrivate);

    try {
        return instance.patch(`${API}/api/${url}`, data);
    } catch (e) {
        if (e.code === ERR_BAD_REQUEST) {

            const isUpdate = await updateToken();

            if (isUpdate) {
                instance = setup(true);
                return await instance.post(`${API}/api/${url}`);
            }

            location.href = '/login';
        }
    }
}

export async function sendGet(url, isPrivate = false) {
    let instance = setup(isPrivate);

    try {
        return await instance.get(`${API}/api/${url}`);
    } catch (e) {
        if (e.code === ERR_BAD_REQUEST) {

            const isUpdate = await updateToken();

            if (isUpdate) {
                instance = setup(true);
                return await instance.get(`${API}/api/${url}`);
            }
            //
            location.href = '/login';
            // return {data: [{id: 1, title: 'Test'}]};
        }
    }
}

async function updateToken() {
    try {
        const res = await axios.post(`${API}/api/auth/token/refresh`, { refresh_token: localStorage.getItem('refresh') });

        setTokens(res.data.token, res.data.refresh_token);
        return true;
    } catch (e) {
        return false;
    }
}