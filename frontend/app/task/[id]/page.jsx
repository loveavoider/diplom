'use client';

import {Box} from "@chakra-ui/react";
import {sendGet} from "@/app/util/axios";
import {useState, useEffect} from "react";
import CreateForm from "@/app/components/CreateForm";
import { getClientData, getPurchaseData } from "@/app/util/jurData";

function prepareTaskData(rawData, id) {
    return {
        title: rawData.title,
        type: rawData.type,
        has_prepaid: rawData.hasPrepaid ? '1' : '2',
        auc: rawData.auc,
        sum_deal: rawData.sumDeal,
        sum_bg: rawData.sumBg,
        multi_lot: rawData.multiLot ? '2' : '1',
        inn: rawData.inn,
        id: id
    }
}

export default function Task({ params }) {

    const [taskData, setTaskData] = useState({});
    const [jurData, setJurData] = useState({});
    const [purchase, setPurchase] = useState({});

    useEffect(() => {
        (async () => {
            const {data} = await sendGet(`task/${params.id}`, true);
            setTaskData(prepareTaskData(data, params.id));
            // console.log(data);
            getClientData(data.inn, setJurData);
            getPurchaseData(data.auc, setPurchase);
        })()
    }, []);

    // console.log(taskData, purchase);

    return (
        jurData?.value ?
        <CreateForm jurData={jurData} defaultFormData={taskData} propPurchase={purchase} isCreate={false} /> : ''
    );
}