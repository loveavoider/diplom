import axios from "axios";
import {API} from "@/app/constants";

export async function getClientData(inn, setJurData) {
    axios.get(`${API}/api/companyData/${inn}`)
        .then(res => {
            const data = JSON.parse(res.data).suggestions[0];
            // console.log(data);
            setJurData(data);
        });
}

export async function getPurchaseData(number, setPurchase) {
    axios.get(`${API}/api/aucData/${number}`)
        .then(res => {
            const data = JSON.parse(res.data);
            // console.log(data);
            setPurchase(data);
        });
}